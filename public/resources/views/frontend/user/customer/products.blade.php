@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-4">
      <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Products') }}</h1>
        </div>
      </div>
    </div>

    <div class="row gutters-10">
        <div class="col-md-4 mx-auto mb-3" >
            <div class="bg-grad-1 text-white rounded-lg overflow-hidden">
              <span class="size-30px rounded-circle mx-auto bg-soft-primary d-flex align-items-center justify-content-center mt-3">
                  <i class="las la-upload la-2x text-white"></i>
              </span>
              <div class="px-3 pt-3 pb-3">
                  <div class="h4 fw-700 text-center">{{ max(0, Auth::user()->remaining_uploads) }}</div>
                  <div class="opacity-50 text-center">{{  translate('Remaining Uploads') }}</div>
              </div>
            </div>
        </div>

        <div class="col-md-4 mx-auto mb-3" >
            <a href="{{ route('customer_products.create')}}">
              <div class="p-3 rounded mb-3 c-pointer text-center bg-white shadow-sm hov-shadow-lg has-transition">
                  <span class="size-60px rounded-circle mx-auto bg-secondary d-flex align-items-center justify-content-center mb-3">
                      <i class="las la-plus la-3x text-white"></i>
                  </span>
                  <div class="fs-18 text-primary">{{ translate('Add New Product') }}</div>
              </div>
            </a>
        </div>

        @php
            $customer_package = \App\CustomerPackage::find(Auth::user()->customer_package_id);
        @endphp
        <div class="col-md-4">
            <a href="{{ route('customer_packages_list_show') }}" class="text-center bg-white shadow-sm hov-shadow-lg text-center d-block p-3 rounded">
                @if($customer_package != null)
                    <img src="{{ uploaded_asset($customer_package->logo) }}" height="44" class="mw-100 mx-auto">
                    <span class="d-block sub-title mb-2">{{ translate('Current Package')}}: {{ $customer_package->getTranslation('name') }}</span>
                @else
                    <i class="la la-frown-o mb-1 la-3x"></i>
                    <div class="d-block sub-title mb-2">{{ translate('No Package Found')}}</div>
                @endif
                <div class="btn btn-outline-primary py-1">{{ translate('Upgrade Package')}}</div>
            </a>
        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">{{ translate('All Products') }}</h5>
            </div>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ translate('Name')}}</th>
                        <th data-breakpoints="lg">{{ translate('Price')}}</th>
                        <th data-breakpoints="lg">{{ translate('Available Status')}}</th>
                        <th data-breakpoints="lg">{{ translate('Admin Status')}}</th>
                        <th class="text-right">{{ translate('Options')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $key => $product)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><a href="{{ route('customer.product', $product->slug) }}">{{ $product->name }}</a></td>
                        <td>{{ single_price($product->unit_price) }}</td>
                        <td><label class="aiz-switch aiz-switch-success mb-0">
                            <input onchange="update_status(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->status == 1) echo "checked";?> >
                            <span class="slider round"></span></label>
                        </td>
                        <td>
                            @if ($product->published == '1')
                                <span class="badge badge-inline badge-success">{{ translate('PUBLISHED')}}</span>
                            @else
                                <span class="badge badge-inline badge-info">{{ translate('PENDING')}}</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('customer_products.edit', ['id'=>$product->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}">
							   <i class="las la-edit"></i>
						    </a>
                            {{-- <a href="{{route('customer_products.edit',encrypt($product->id))}}" class="btn btn-soft-info btn-icon btn-circle btn-sm" title="{{ translate('Edit') }}">
                              <i class="las la-edit"></i>
                            </a> --}}
                            <a href="javascript:void(0)" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('customer_products.destroy', $product->id)}}" title="{{ translate('Delete') }}">
                              <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $products->links() }}
          	</div>
        </div>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">

        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('customer_products.update.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Status has been updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

    </script>
@endsection
