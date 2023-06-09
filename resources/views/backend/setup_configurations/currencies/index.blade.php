@extends('backend.layouts.app')

@section('content')

<div class="row">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('System Default Currency')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('System Default Currency')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <select class="form-control aiz-selectpicker" name="system_default_currency" data-live-search="true">
                                @foreach ($active_currencies as $key => $currency)
                                    <option value="{{ $currency->id }}" <?php if(get_setting('system_default_currency') == $currency->id) echo 'selected'?> >
                                        {{ $currency->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="types[]" value="system_default_currency">
                        <div class="col-lg-3">
                            <button class="btn btn-sm btn-primary" type="submit">{{translate('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Set Currency Formats')}}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="symbol_format">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Symbol Format')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <select class="form-control aiz-selectpicker" name="symbol_format">
                                <option value="1" @if(get_setting('symbol_format') == 1) selected @endif>[Symbol][Amount]</option>
                                <option value="2" @if(get_setting('symbol_format') == 2) selected @endif>[Amount][Symbol]</option>
                                <option value="3" @if(get_setting('symbol_format') == 3) selected @endif>[Symbol] [Amount]</option>
                                <option value="4" @if(get_setting('symbol_format') == 4) selected @endif>[Amount] [Symbol]</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="decimal_separator">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('Decimal Separator')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <select class="form-control aiz-selectpicker" name="decimal_separator">
                                <option value="1" @if(get_setting('decimal_separator') == 1) selected @endif>1,23,456.70</option>
                                <option value="2" @if(get_setting('decimal_separator') == 2) selected @endif>1.23.456,70</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="no_of_decimals">
                        <div class="col-lg-3">
                            <label class="control-label">{{translate('No of decimals')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <select class="form-control aiz-selectpicker" name="no_of_decimals">
                                <option value="0" @if(get_setting('no_of_decimals') == 0) selected @endif>12345</option>
                                <option value="1" @if(get_setting('no_of_decimals') == 1) selected @endif>1234.5</option>
                                <option value="2" @if(get_setting('no_of_decimals') == 2) selected @endif>123.45</option>
                                <option value="3" @if(get_setting('no_of_decimals') == 3) selected @endif>12.345</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All Currencies')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a onclick="currency_modal()" href="#" class="btn btn-circle btn-primary">
				<span>{{translate('Add New Currency')}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header row gutters-5">
        <div class="col text-center text-md-left">
            <h5 class="mb-md-0 h6">{{ translate('All Currencies') }}</h5>
        </div>
        <div class="col-md-4">
            <form class="" id="sort_currencies" action="" method="GET">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th>{{translate('Currency name')}}</th>
                    <th data-breakpoints="lg">{{translate('Currency symbol')}}</th>
                    <th data-breakpoints="lg">{{translate('Currency code')}}</th>
                    <th>{{translate('Exchange rate')}}(1 USD = ?)</th>
                    <th data-breakpoints="lg">{{translate('Status')}}</th>
                    <th class="text-right">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($currencies as $key => $currency)
                    <tr>
                        <td>{{ ($key+1) + ($currencies->currentPage() - 1)*$currencies->perPage() }}</td>
                        <td>{{$currency->name}}</td>
                        <td>{{$currency->symbol}}</td>
                        <td>{{$currency->code}}</td>
                        <td>{{$currency->exchange_rate}}</td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_currency_status(this)" value="{{ $currency->id }}" type="checkbox" <?php if($currency->status == 1) echo "checked";?> >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" onclick="edit_currency_modal('{{$currency->id}}');" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $currencies->appends(request()->input())->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')

    <!-- Delete Modal -->
    @include('modals.delete_modal')

    <div class="modal fade" id="add_currency_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

    <div class="modal fade" id="currency_modal_edit">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        function sort_currencies(el){
            $('#sort_currencies').submit();
        }

        function currency_modal(){
            $.get('{{ route('currency.create') }}',function(data){
                $('#modal-content').html(data);
                $('#add_currency_modal').modal('show');
            });
        }

        function update_currency_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }

            $.post('{{ route('currency.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Currency Status updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function edit_currency_modal(id){
            $.post('{{ route('currency.edit') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#currency_modal_edit .modal-content').html(data);
                $('#currency_modal_edit').modal('show', {backdrop: 'static'});
            });
        }
    </script>
@endsection
