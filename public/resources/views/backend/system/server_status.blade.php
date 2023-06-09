@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-10 col-xxl-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="h6 mb-0">{{ translate('Server information') }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped aiz-table">
                    <thead>
                        <tr>
                            <th>{{ translate('Name') }}</th>
                            <th data-breakpoints="lg">{{ translate('Current Version') }}</th>
                            <th data-breakpoints="lg">{{ translate('Required Version') }}</th>
                            <th>{{ translate('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Php versions</td>
                            <td>{{ phpversion() }}</td>
                            <td>7.2 or 7.3</td>
                            <td>
                                @if (floatval(phpversion()) >= 7.2 && floatval(phpversion()) < 7.4)
                                <i class="las la-check text-success"></i>
                                @else
                                <i class="las la-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>MySQL</td>
                            <td>
                                @php
                                $results = DB::select( DB::raw("select version()") );
                                $mysql_version =  $results[0]->{'version()'};
                                @endphp
                                {{ $mysql_version }}
                            </td>
                            <td>5.6+</td>
                            <td>
                                @if ($mysql_version >= 5.6)
                                <i class="las la-check text-success"></i>
                                @else
                                <i class="las la-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="h6 mb-0">{{ translate('php.ini Config') }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped aiz-table">
                    <thead>
                        <tr>
                            <th>{{ translate('Config Name') }}</th>
                            <th data-breakpoints="lg">{{ translate('Current') }}</th>
                            <th data-breakpoints="lg">{{ translate('Recommended') }}</th>
                            <th>{{ translate('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>file_uploads</td>
                            <td>
                                @if(ini_get('file_uploads') == 1)
                                On
                                @else
                                Off
                                @endif
                            </td>
                            <td>On</td>
                            <td>
                                @if (ini_get('file_uploads') == 1)
                                <i class="las la-check text-success"></i>
                                @else
                                <i class="las la-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>max_file_uploads</td>
                            <td>
                                {{ ini_get('max_file_uploads') }}
                            </td>
                            <td>20+</td>
                            <td>
                                @if (ini_get('max_file_uploads') >= 20)
                                <i class="las la-check text-success"></i>
                                @else
                                <i class="las la-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>upload_max_filesize</td>
                            <td>
                                {{ ini_get('upload_max_filesize') }}
                            </td>
                            <td>128M+</td>
                            <td>
                                @if (str_replace(['M','G'],"", ini_get('upload_max_filesize')) >= 128)
                                <i class="las la-check text-success"></i>
                                @else
                                <i class="las la-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>post_max_size</td>
                            <td>
                                {{ ini_get('post_max_size') }}
                            </td>
                            <td>128M+</td>
                            <td>
                                @if (str_replace(['M','G'],"", ini_get('post_max_size')) >= 128)
                                <i class="las la-check text-success"></i>
                                @else
                                <i class="las la-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>allow_url_fopen</td>
                            <td>
                                @if(ini_get('allow_url_fopen') == 1)
                                On
                                @else
                                Off
                                @endif
                            </td>
                            <td>On</td>
                            <td>
                                @if (ini_get('allow_url_fopen') == 1)
                                <i class="las la-check text-success"></i>
                                @else
                                <i class="las la-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>max_execution_time</td>
                            <td>
                                @if(ini_get('max_execution_time') == '-1')
                                Unlimited
                                @else
                                {{ ini_get('max_execution_time') }}
                                @endif
                            </td>
                            <td>600+</td>
                            <td>
                                @if (ini_get('max_execution_time') == -1 || ini_get('max_execution_time') >= 600)
                                <i class="las la-check text-success"></i>
                                @else
                                <i class="las la-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>max_input_time</td>
                            <td>
                                @if(ini_get('max_input_time') == '-1')
                                Unlimited
                                @else
                                {{ ini_get('max_input_time') }}
                                @endif
                            </td>
                            <td>120+</td>
                            <td>
                                @if (ini_get('max_input_time') == -1 || ini_get('max_input_time') >= 120)
                                <i class="las la-check text-success"></i>
                                @else
                                <i class="las la-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>max_input_vars</td>
                            <td>
                                {{ ini_get('max_input_vars') }}
                            </td>
                            <td>1000+</td>
                            <td>
                                @if (ini_get('max_input_vars') >= 1000)
                                <i class="las la-check text-success"></i>
                                @else
                                <i class="las la-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>memory_limit</td>
                            <td>
                                @if(ini_get('memory_limit') == '-1')
                                Unlimited
                                @else
                                {{ ini_get('memory_limit') }}
                                @endif
                            </td>
                            <td>256M+</td>
                            <td>
                                @php
                                    $memory_limit = ini_get('memory_limit');
                                    if (preg_match('/^(\d+)(.)$/', $memory_limit, $matches)) {
                                        if ($matches[2] == 'G') {
                                            $memory_limit = $matches[1] * 1024 * 1024 * 1024; // nnnM -> nnn GB
                                        } else if ($matches[2] == 'M') {
                                            $memory_limit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
                                        } else if ($matches[2] == 'K') {
                                            $memory_limit = $matches[1] * 1024; // nnnK -> nnn KB
                                        }
                                    }
                                @endphp
                                @if (ini_get('memory_limit') == -1 || $memory_limit >= (256 * 1024 * 1024))
                                <i class="las la-check text-success"></i>
                                @else
                                <i class="las la-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>				
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="h6 mb-0">{{ translate('Extensions information') }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ translate('Extension Name') }}</th>
                            <th>{{ translate('Status') }}</th>
                        </tr>
                    </thead>
                    @php
                    $loaded_extensions = get_loaded_extensions();
                    $required_extensions = ['bcmath', 'ctype', 'json', 'mbstring', 'zip', 'zlib', 'openssl', 'tokenizer', 'xml', 'dom',  'curl', 'fileinfo', 'gd', 'pdo_mysql']
                    @endphp
                    <tbody>
                        @foreach ($required_extensions as $extension)
                        <tr>
                            <td>{{ $extension }}</td>
                            <td>
                                @if(in_array($extension, $loaded_extensions))
                                <i class="las la-check text-success"></i>
                                @else
                                <i class="las la-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="h6 mb-0">{{ translate('Filesystem Permissions') }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ translate('File or Folder') }}</th>
                            <th>{{ translate('Status') }}</th>
                        </tr>
                    </thead>
                    @php
                    $required_paths = ['.env', 'public', 'app/Providers', 'app/Http/Controllers', 'storage', 'resources/views']
                    @endphp
                    <tbody>
                        @foreach ($required_paths as $path)
                        <tr>
                            <td>{{ $path }}</td>
                            <td>
                                @if(is_writable(base_path($path)))
                                <i class="las la-check text-success"></i>
                                @else
                                <i class="las la-times text-danger"></i>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
