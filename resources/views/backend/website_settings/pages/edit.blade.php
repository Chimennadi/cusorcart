@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col">
			<h1 class="h3">{{ translate('Edit Page Information') }}</h1>
		</div>
	</div>
</div>
<div class="card">
	<ul class="nav nav-tabs nav-fill border-light">
		@foreach (\App\Language::all() as $key => $language)
			<li class="nav-item">
				<a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('custom-pages.edit', ['id'=>$page->slug, 'lang'=> $language->code] ) }}">
					<img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
					<span>{{$language->name}}</span>
				</a>
			</li>
		@endforeach
	</ul>

	<form class="p-4" action="{{ route('custom-pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		<input type="hidden" name="_method" value="PATCH">
		<input type="hidden" name="lang" value="{{ $lang }}">

		<div class="card-header px-0">
			<h6 class="fw-600 mb-0">{{ translate('Page Content') }}</h6>
		</div>
		<div class="card-body px-0">
			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Title')}} <span class="text-danger">*</span> <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="Title" name="title" value="{{ $page->getTranslation('title',$lang) }}" required>
				</div>
			</div>


				<div class="form-group row">
					<label class="col-sm-2 col-from-label" for="name">{{translate('Link')}} <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<div class="input-group d-block d-md-flex">
							@if($page->type == 'custom_page')
								<div class="input-group-prepend"><span class="input-group-text flex-grow-1">{{ route('home') }}/</span></div>
								<input type="text" class="form-control w-100 w-md-auto" placeholder="{{ translate('Slug') }}" name="slug" value="{{ $page->slug }}">
							@else
								<input class="form-control w-100 w-md-auto" value="{{ route('home') }}/{{ $page->slug }}" disabled>
							@endif
						</div>
						<small class="form-text text-muted">{{ translate('Use character, number, hypen only') }}</small>
					</div>
				</div>

			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Add Content')}} <span class="text-danger">*</span></label>
				<div class="col-sm-10">
					<textarea
						class="aiz-text-editor form-control"
						placeholder="Content.."
						data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
						data-min-height="300"
						name="content"
						required
					>@php echo $page->getTranslation('content',$lang); @endphp</textarea>
				</div>
			</div>
		</div>

		<div class="card-header px-0">
			<h6 class="fw-600 mb-0">{{ translate('Seo Fields') }}</h6>
		</div>
		<div class="card-body px-0">

			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Title')}}</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="Title" name="meta_title" value="{{ $page->meta_title }}">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Description')}}</label>
				<div class="col-sm-10">
					<textarea class="resize-off form-control" placeholder="Description" name="meta_description">
						@php
							echo $page->meta_description
						@endphp
					</textarea>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Keywords')}}</label>
				<div class="col-sm-10">
					<textarea class="resize-off form-control" placeholder="Keyword, Keyword" name="keywords">
						@php
							echo $page->keywords
						@endphp
					</textarea>
					<small class="text-muted">{{ translate('Separate with coma') }}</small>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Image')}}</label>
				<div class="col-sm-10">
					<div class="input-group " data-toggle="aizuploader" data-type="image">
							<div class="input-group-prepend">
									<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
							</div>
							<div class="form-control file-amount">{{ translate('Choose File') }}</div>
							<input type="hidden" name="meta_image" class="selected-files" value="{{ $page->meta_image }}">
					</div>
					<div class="file-preview">
					</div>
				</div>
			</div>

			<div class="text-right">
				<button type="submit" class="btn btn-primary">{{ translate('Update Page') }}</button>
			</div>
		</div>
	</form>
</div>
@endsection
