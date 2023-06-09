@extends('backend.layouts.app')

@section('content')

    <div class="card">
        <div class="card-header row gutters-5">
         <div class="col text-center text-md-left">
           <h5 class="mb-md-0 h6">{{ $language->name }}</h5>
         </div>
         <div class="col-md-4">
           <form class="" id="sort_keys" action="" method="GET">
             <div class="input-group input-group-sm">
                 <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type key & Enter') }}">
             </div>
           </form>
         </div>
       </div>
        <form class="form-horizontal" action="{{ route('languages.key_value_store') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $language->id }}">
            <div class="card-body">
                <table class="table table-striped table-bordered demo-dt-basic" id="tranlation-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="45%">{{translate('Key')}}</th>
                            <th width="45%">{{translate('Value')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lang_keys as $key => $translation)
                            <tr>
                                <td>{{ ($key+1) + ($lang_keys->currentPage() - 1)*$lang_keys->perPage() }}</td>
                                <td class="key">{{ $translation->lang_key }}</td>
                                <td>
                                    <input type="text" class="form-control value" style="width:100%" name="values[{{ $translation->lang_key }}]" @if (($traslate_lang = \App\Translation::where('lang', $language->code)->where('lang_key', $translation->lang_key)->first()) != null)
                                        value="{{ $traslate_lang->lang_value }}"
                                    @endif>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                   {{ $lang_keys->appends(request()->input())->links() }}
                </div>

                <div class="form-group mb-0 text-right">
                    <button type="button" class="btn btn-primary" onclick="copyTranslation()">{{ translate('Copy Translations') }}</button>
                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        //translate in one click
        function copyTranslation() {
            $('#tranlation-table > tbody  > tr').each(function (index, tr) {
                $(tr).find('.value').val($(tr).find('.key').text());
            });
        }

        function sort_keys(el){
            $('#sort_keys').submit();
        }
    </script>
@endsection
