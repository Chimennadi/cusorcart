<?php

namespace App\Http\Controllers;

use App\Addon;
use App\Menu;
use Illuminate\Http\Request;
use ZipArchive;
use Auth;
use App\BusinessSetting;
use CoreComponentRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // CoreComponentRepository::instantiateShopRepository();
        return view('backend.addons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.addons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }

        if (class_exists('ZipArchive')) {
            if ($request->hasFile('addon_zip')) {
                // Create update directory.
                $dir = 'addons';
                if (!is_dir($dir))
                    mkdir($dir, 0777, true);

                $path = Storage::disk('local')->put('addons', $request->addon_zip);

                $zipped_file_name = $request->addon_zip->getClientOriginalName();

                //Unzip uploaded update file and remove zip file.
                $zip = new ZipArchive;
                $res = $zip->open(base_path('public/' . $path));

                $random_dir = Str::random(10);

                $dir = trim($zip->getNameIndex(0), '/');

                if ($res === true) {
                    $res = $zip->extractTo(base_path('temp/' . $random_dir . '/addons'));
                    $zip->close();
                } else {
                    dd('could not open');
                }

                $str = file_get_contents(base_path('temp/' . $random_dir . '/addons/' . $dir . '/config.json'));
                $json = json_decode($str, true);

                //dd($random_dir, $json);

                if (BusinessSetting::where('type', 'current_version')->first()->value >= $json['minimum_item_version']) {
                    if (count(Addon::where('unique_identifier', $json['unique_identifier'])->get()) == 0) {
                        $addon = new Addon;
                        $addon->name = $json['name'];
                        $addon->unique_identifier = $json['unique_identifier'];
                        $addon->version = $json['version'];
                        $addon->activated = 1;
                        $addon->image = $json['addon_banner'];
                        $addon->save();

                        // Create new directories.
                        if (!empty($json['directory'])) {
                            //dd($json['directory'][0]['name']);
                            foreach ($json['directory'][0]['name'] as $directory) {
                                if (is_dir(base_path($directory)) == false) {
                                    mkdir(base_path($directory), 0777, true);

                                } else {
                                    echo "error on creating directory";
                                }

                            }
                        }

                        // Create/Replace new files.
                        if (!empty($json['files'])) {
                            foreach ($json['files'] as $file) {
                                copy(base_path('temp/' . $random_dir . '/' . $file['root_directory']), base_path($file['update_directory']));
                            }

                        }

                        // Run sql modifications
                        $sql_path = base_path('temp/' . $random_dir . '/addons/' . $dir . '/sql/update.sql');
                        if (file_exists($sql_path)) {
                            DB::unprepared(file_get_contents($sql_path));
                        }

                        flash(translate('Addon nstalled successfully'))->success();
                        return redirect()->route('addons.index');
                    } else {
                        // Create new directories.
                        if (!empty($json['directory'])) {
                            //dd($json['directory'][0]['name']);
                            foreach ($json['directory'][0]['name'] as $directory) {
                                if (is_dir(base_path($directory)) == false) {
                                    mkdir(base_path($directory), 0777, true);

                                } else {
                                    echo "error on creating directory";
                                }

                            }
                        }

                        // Create/Replace new files.
                        if (!empty($json['files'])) {
                            foreach ($json['files'] as $file) {
                                copy(base_path('temp/' . $random_dir . '/' . $file['root_directory']), base_path($file['update_directory']));
                            }

                        }

                        $addon = Addon::where('unique_identifier', $json['unique_identifier'])->first();

                        for ($i = $addon->version + 0.1; $i <= $json['version']; $i = $i + 0.1) {
                            // Run sql modifications
                            $sql_path = base_path('temp/' . $random_dir . '/addons/' . $dir . '/sql/' . $i . '.sql');
                            if (file_exists($sql_path)) {
                                DB::unprepared(file_get_contents($sql_path));
                            }
                        }

                        $addon->version = $json['version'];
                        $addon->save();

                        flash(translate('This addon is updated successfully'))->success();
                        return redirect()->route('addons.index');
                    }
                } else {
                    flash(translate('This version is not capable of installing Addons, Please update.'))->error();
                    return redirect()->route('addons.index');
                }
            }
        }
        else {
            flash(translate('Please enable ZipArchive extension.'))->error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Addon $addon
     * @return \Illuminate\Http\Response
     */
    public function show(Addon $addon)
    {
        //
    }

    public function list()
    {
        //return view('backend.'.Auth::user()->role.'.addon.list')->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Addon $addon
     * @return \Illuminate\Http\Response
     */
    public function edit(Addon $addon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Addon $addon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Addon $addon
     * @return \Illuminate\Http\Response
     */
    public function activation(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return 0;
        }
        $addon = Addon::find($request->id);
        //$menu  = Menu::where('displayed_name', $addon->unique_identifier)->first();
        $addon->activated = $request->status;

        $addon->save();
        //$menu->save();

        // $data = array(
        //     'status' => true,
        //     'notification' => translate('addon_status_updated_successfully')
        // );
        // return $data;

        return 1;
    }
}
