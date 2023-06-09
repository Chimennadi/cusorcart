@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-4">
      <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('Add Your Product') }}</h1>
        </div>
      </div>
    </div>
    <form class="" action="{{route('customer_products.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
        @csrf
        <input type="hidden" name="added_by" value="{{ Auth::user()->user_type }}">
        <input type="hidden" name="status" value="available">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('General')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Product Name')}} <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name" placeholder="{{ translate('Product Name')}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Product Category')}} <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <select class="form-control aiz-selectpicker" data-placeholder="{{ translate('Select a Category')}}" id="categories" name="category_id" data-live-search="true" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
                                @foreach ($category->childrenCategories as $childCategory)
                                    @include('categories.child_category', ['child_category' => $childCategory])
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Product Brand')}} <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <select class="form-control aiz-selectpicker" data-placeholder="{{ translate('Select a brand')}}" data-live-search="true"  id="brands" name="brand_id">
                            <option value=""></option>
                            @foreach (\App\Brand::all() as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->getTranslation('name') }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Product Unit')}} <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="unit" placeholder="{{ translate('Product unit')}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Condition')}} <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <select class="form-control selectpicker" data-placeholder="{{ translate('Select a condition')}}" id="conditon" name="conditon" required>
                            <option value="new">{{ translate('New')}}</option>
                            <option value="used">{{ translate('Used')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Location')}} <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="location" placeholder="{{ translate('Location')}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{ translate('Product Tag')}} <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control aiz-tag-input" name="tags[]" placeholder="{{ translate('Type & hit enter')}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Images')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Gallery Images')}} <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="photos" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Thumbnail Image')}} <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="thumbnail_img" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Videos')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Video From')}}</label>
                    <div class="col-md-10">
                        <select class="form-control aiz-selectpicker" data-minimum-results-for-search="Infinity" name="video_provider">
                            <option value="youtube">{{ translate('Youtube')}}</option>
                            <option value="dailymotion">{{ translate('Dailymotion')}}</option>
                            <option value="vimeo">{{ translate('Vimeo')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Video URL')}}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="video_link" placeholder="{{ translate('Video link')}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Meta Tags')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Meta Title')}}</label>
                    <div class="col-md-10">
                        <input type="text" name="meta_title" class="form-control" placeholder="{{ translate('Meta Title')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{translate('Description')}}</label>
                    <div class="col-md-10">
                        <textarea name="meta_description" rows="8" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{ translate('Meta Image')}}</label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="meta_img" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Price')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{ translate('Unit Price')}} <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <input type="number" lang="en" min="0" step="0.01" class="form-control" name="unit_price" placeholder="{{ translate('Unit Price')}} ({{ translate('Base Price')}})" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Description')}} <span class="text-danger">*</span></h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{ translate('Description')}}</label>
                    <div class="col-md-10">
                        <div class="mb-3">
                            <textarea class="aiz-text-editor" name="description" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('PDF Specification')}}</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-from-label">{{ translate('PDF')}}</label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="document">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="pdf" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mar-all text-right">
            <button type="submit" name="button" class="btn btn-primary">{{ translate('Save Product') }}</button>
        </div>
    </form>

@endsection
