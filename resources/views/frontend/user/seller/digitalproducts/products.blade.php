@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-4">
      <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Products') }}</h1>
        </div>
      </div>
    </div>

    <div class="row gutters-10 justify-content-center">
        @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)
            <div class="col-md-4 mx-auto mb-3" >
                <div class="bg-grad-1 text-white rounded-lg overflow-hidden">
                  <span class="size-30px rounded-circle mx-auto bg-soft-primary d-flex align-items-center justify-content-center mt-3">
                      <i class="las la-upload la-2x text-white"></i>
                  </span>
                  <div class="px-3 pt-3 pb-3">
                      <div class="h4 fw-700 text-center">{{ max(0, Auth::user()->seller->remaining_digital_uploads) }}</div>
                      <div class="opacity-50 text-center">{{  translate('Remaining Uploads') }}</div>
                  </div>
                </div>
            </div>
        @endif


        <div class="col-md-4 mx-auto mb-3" >
            <a href="{{ route('seller.digitalproducts.upload')}}">
              <div class="p-3 rounded mb-3 c-pointer text-center bg-white shadow-sm hov-shadow-lg has-transition">
                  <span class="size-60px rounded-circle mx-auto bg-secondary d-flex align-items-center justify-content-center mb-3">
                      <i class="las la-plus la-3x text-white"></i>
                  </span>
                  <div class="fs-18 text-primary">{{ translate('Add New Digital Product') }}</div>
              </div>
            </a>
        </div>

        @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)
        @php
            $seller_package = \App\SellerPackage::find(Auth::user()->seller->seller_package_id);
        @endphp
            <div class="col-md-4">
                <a href="{{ route('seller_packages_list') }}" class="text-center bg-white shadow-sm hov-shadow-lg text-center d-block p-3 rounded">
                    @if($seller_package != null)
                        <img src="{{ uploaded_asset($seller_package->logo) }}" height="44" class="mw-100 mx-auto">
                        <span class="d-block sub-title mb-2">{{ translate('Current Package')}}: {{ $seller_package->getTranslation('name') }}</span>
                    @else
                        <i class="la la-frown-o mb-2 la-3x"></i>
                        <div class="d-block sub-title mb-2">{{ translate('No Package Found')}}</div>
                    @endif
                    <div class="btn btn-outline-primary py-1">{{ translate('Upgrade Package')}}</div>
                </a>
            </div>
        @endif
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
                        <th width="30%">{{ translate('Name')}}</th>
                        <th data-breakpoints="md">{{ translate('Category')}}</th>
                        <th data-breakpoints="md">{{ translate('Base Price')}}</th>
                        <th data-breakpoints="md">{{ translate('Published')}}</th>
                       
                        <th>{{ translate('Options')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><a href="{{ route('product', $product->slug) }}" target="_blank">{{   $product->getTranslation('name')  }}</a></td>
                            <td>
                                @if ($product->category != null)
                                    {{ $product->category->getTranslation('name') }}
                                @endif
                            </td>
                            <td>{{ $product->unit_price }}</td>
                            <td><label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->published == 1) echo "checked";?> >
                                <span class="slider round"></span></label>
                            </td>
                            
                            <td class="text-right">
                                <a href="{{route('seller.digitalproducts.edit',  ['id'=>$product->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" class="btn btn-soft-info btn-icon btn-circle btn-sm" title="{{ translate('Edit') }}">
                                  <i class="las la-edit"></i>
                                </a>
                                <a class="btn btn-soft-success btn-icon btn-circle btn-sm" href="{{route('digitalproducts.download', encrypt($product->id))}}" title="{{ translate('Download') }}">
                                    <i class="las la-download"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('digitalproducts.destroy', $product->id)}}" title="{{ translate('Delete') }}">
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
        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Featured products updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Published products updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
