@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All Flash Deals')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('flash_deals.create') }}" class="btn btn-circle btn-info">
				<span>{{translate('Create New Flash Deal')}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Flash Deals')}}</h5>
        <div class="pull-right clearfix">
            <form class="" id="sort_flash_deals" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0" >
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th>{{translate('Title')}}</th>
                    <th data-breakpoints="lg">{{ translate('Banner') }}</th>
                    <th data-breakpoints="lg">{{ translate('Start Date') }}</th>
                    <th data-breakpoints="lg">{{ translate('End Date') }}</th>
                    <th data-breakpoints="lg">{{ translate('Status') }}</th>
                    <th data-breakpoints="lg">{{ translate('Featured') }}</th>
                    <th data-breakpoints="lg">{{ translate('Page Link') }}</th>
                    <th class="text-right">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flash_deals as $key => $flash_deal)
                    <tr>
                        <td>{{ ($key+1) + ($flash_deals->currentPage() - 1)*$flash_deals->perPage() }}</td>
                        <td>{{ $flash_deal->getTranslation('title') }}</td>
                        <td><img src="{{ uploaded_asset($flash_deal->banner) }}" alt="banner" class="h-50px"></td>
                        <td>{{ date('d-m-Y H:i:s', $flash_deal->start_date) }}</td>
                        <td>{{ date('d-m-Y H:i:s', $flash_deal->end_date) }}</td>
                        <td>
							<label class="aiz-switch aiz-switch-success mb-0">
								<input onchange="update_flash_deal_status(this)" value="{{ $flash_deal->id }}" type="checkbox" <?php if($flash_deal->status == 1) echo "checked";?> >
								<span class="slider round"></span>
							</label>
						</td>
						<td>
							<label class="aiz-switch aiz-switch-success mb-0">
								<input onchange="update_flash_deal_feature(this)" value="{{ $flash_deal->id }}" type="checkbox" <?php if($flash_deal->featured == 1) echo "checked";?> >
								<span class="slider round"></span>
							</label>
						</td>
						<td>{{ url('flash-deal/'.$flash_deal->slug) }}</td>
						<td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('flash_deals.edit', ['id'=>$flash_deal->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('flash_deals.destroy', $flash_deal->id)}}" title="{{ translate('Delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $flash_deals->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        function update_flash_deal_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('flash_deals.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    location.reload();
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
        function update_flash_deal_feature(el){
            if(el.checked){
                var featured = 1;
            }
            else{
                var featured = 0;
            }
            $.post('{{ route('flash_deals.update_featured') }}', {_token:'{{ csrf_token() }}', id:el.value, featured:featured}, function(data){
                if(data == 1){
                    location.reload();
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
