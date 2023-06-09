@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class=" align-items-center">
       <h1 class="h3">{{translate('Product Wish Report')}}</h1>
	</div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('wish_report.index') }}" method="GET">
                    <div class="form-group row offset-lg-2">
                        <label class="col-md-3 col-form-label">{{ translate('Sort by Category') }}:</label>
                        <div class="col-md-5">
                            <select id="demo-ease" class="from-control aiz-selectpicker" name="category_id" required>
                                @foreach (\App\Category::all() as $key => $category)
                                    <option value="{{ $category->id }}" @if($category->id == $sort_by) selected @endif>{{ $category->getTranslation('name') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">{{ translate('Filter') }}</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Product Name') }}</th>
                            <th>{{ translate('Number of Wish') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            @if($product->wishlists != null)
                                <tr>
                                    <td>{{ $product->getTranslation('name') }}</td>
                                    <td>{{ $product->wishlists->count() }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
