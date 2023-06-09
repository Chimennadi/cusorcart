<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsersImport;
use App\CustomersImport;
use App\User;
use Excel;
use PDF;
use Carbon\Carbon;

class CustomerBulkUploadController extends Controller
{
    public function index()
    {
        return view('bulk_upload.customer_upload');
    }

    public function user_bulk_upload(Request $request)
    {
        if($request->hasFile('user_bulk_file')){
            Excel::import(new UsersImport, request()->file('user_bulk_file'));
        }
        flash(translate('User exported successfully'))->success();
        return back();
    }

    public function pdf_download_user()
    {
        $users = User::where('created_at','LIKE', '%'. Carbon::today()->toDateString().'%')->get();

        return PDF::loadView('backend.downloads.user',[
            'users' => $users,
        ], [], [])->download('user.pdf');
    }

    public function customer_bulk_file(Request $request)
    {
        if($request->hasFile('customer_bulk_file')){
            Excel::import(new CustomersImport, request()->file('customer_bulk_file'));
        }
        flash(translate('Customers exported successfully'))->success();
        return back();
    }
}
