@extends('frontend.layouts.app')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

@if (session()->has('from_app') && session()->get('from_app') == true)
    <link rel="stylesheet" href="/assets/css/app.css?v={{ env('APP_VERSION') }}">
@endif
@if (session()->has('theme') && session()->get('theme') == 'dark')
    <link rel="stylesheet" href="/assets/css/dark-mode.css?v={{ env('APP_VERSION') }}">
@endif
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@section('content')
    <section class="py-5">
        <div class="container">
            <div class="d-flex align-items-start">
                @include('frontend.inc.user_side_nav')
                <div class="aiz-user-panel">
                    @yield('panel_content')
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.aiz-text-editor').summernote({
                height: 300
            });
        });
    </script>
    <script>
        var fonts = ['Arial', 'Courier', 'Garamond', 'Tahoma', 'Times New Roman', 'Verdana'];

        function getFontName(font) {
            return font.toLowerCase().replace(/\s/g, "-");
        }
        var fontNames = fonts.map(font => getFontName(font));

        var fontStyles = "";
        fonts.forEach(function(font) {
            var fontName = getFontName(font);
            fontStyles += ".ql-snow .ql-picker.ql-font .ql-picker-label[data-value=" + fontName +
                "]::before, .ql-snow .ql-picker.ql-font .ql-picker-item[data-value=" + fontName + "]::before {" +
                "content: '" + font + "';" +
                "font-family: '" + font + "', sans-serif;" +
                "}" +
                ".ql-font-" + fontName + "{" +
                " font-family: '" + font + "', sans-serif;" +
                "}";
        });

        var node = document.createElement('style');
        node.innerHTML = fontStyles;
        document.body.appendChild(node);

        var Font = Quill.import('formats/font');
        Font.whitelist = fontNames;
        Quill.register(Font, true);



        var toolbarOptions = [
            ['bold', 'underline', ],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }],
            [{
                'script': 'sub'
            }, {
                'script': 'super'
            }],
            [{
                'indent': '-1'
            }, {
                'indent': '+1'
            }],
            ['link', 'image'],
            [{
                'font': fontNames
            }],
            [{
                'align': []
            }],
            ['clean']
        ];

        var quill = new Quill('.quill-text-editor', {
            modules: {
                toolbar: toolbarOptions,
                imageResize: {
                    modules: ['Resize', 'DisplaySize', 'Toolbar'],
                },
            },
            theme: 'snow'
        });
    </script>
    <script>
        $("form").on("submit", function(e) {
            $("#quill-slug").val($(".ql-editor").html());
        })
    </script>
@endsection
