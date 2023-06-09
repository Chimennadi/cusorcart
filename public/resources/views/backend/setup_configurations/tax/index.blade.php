@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{translate('All Taxes')}}</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="#" data-target="#add-tax" data-toggle="modal" class="btn btn-circle btn-info">
                <span>{{translate('Add New Tax')}}</span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header row gutters-5">
        <div class="col text-center text-md-left">
            <h5 class="mb-md-0 h6">{{ translate('All Taxes') }}</h5>
        </div>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Tax Type')}}</th>
                    <th>{{translate('Status')}}</th>
                    <th class="text-right">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_taxes as $key => $tax)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tax->name }}</td>
                    
                    <td>
                        <label class="aiz-switch aiz-switch-success mb-0">
                            <input onchange="update_tax_status(this)" value="{{ $tax->id }}" type="checkbox" <?php if ($tax->tax_status == 1) echo "checked"; ?> >
                            <span class="slider round"></span>
                        </label>
                        
                    </td>
                    <td class="text-right">
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('tax.edit', $tax->id )}}" title="{{ translate('Edit') }}">
                            <i class="las la-edit"></i>
                        </a>
                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('tax.destroy', $tax->id)}}" title="{{ translate('Delete') }}">
                            <i class="las la-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>

@endsection

@section('modal')
    <!-- Tax Add Modal -->
    <div id="add-tax" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header bord-btm">
                    <h4 class="modal-title h6">{{translate('Add New Tax')}}</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                
                <form class="form-horizontal"  action="{{ route('tax.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-3 control-label" for="name">
                                    {{translate('Tax Name')}}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-styled btn-base-3" data-dismiss="modal">
                            {{translate('Close')}}
                        </button>
                        <button type="submit" class="btn btn-primary btn-styled btn-base-1">
                            {{translate('Save')}}
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        function sort_pickup_points(el){
            $('#sort_pickup_points').submit();
        }
        
        function update_tax_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('taxes.tax-status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Tax status updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
