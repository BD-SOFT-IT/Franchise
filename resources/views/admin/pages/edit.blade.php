@extends('layouts.admin')

@section('sub-title', 'Edit - ' . $page->post_title)
@section('page-description', 'Edit Pages')

@section('pages-active', 'active')

@section('admin-content')
    <div class="all-admins-container">

        @if(Session::has('status'))
            <div class="alert alert-info text-center" role="alert">
                {{ Session::get('status') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-pencil"></i> Edit</strong> - {{ $page->post_title }}
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pages.edit', ['id' => $page->post_id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="post_type" value="page">

                    <div class="form-group">
                        <label for="post_title">Title <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control @error('post_title') is-invalid @enderror" aria-describedby="titleHelp" name="post_title" id="post_title" value="{{ old('post_title', $page->post_title) }}" placeholder="Enter Page Title">
                        @error('post_title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small id="titleHelp" class="form-text text-muted">Try not to change the default page name. Otherwise change at your own risk.</small>
                    </div>

                    <div class="form-group">
                        <label for="post_description">Content <span class="text-danger">*</span> </label>
                        <textarea name="post_description" class="form-control" id="post_description">{!! old('post_description', $page->post_description) !!}</textarea>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">Update Page</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@section('custom-script')
    <script src="{{ asset('assets/RBT_EMS/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/RBT_EMS/tinymce/jquery.tinymce.min.js') }}"></script>

    <script>
        tinymce.init({
            selector: 'textarea#post_description',
            branding: false,
            plugins: 'print preview fullpage importcss searchreplace autolink autosave save directionality visualblocks visualchars ' +
                'fullscreen image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists ' +
                'wordcount imagetools textpattern noneditable help quickbars emoticons',
            menubar: 'file edit view insert format tools table',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify' +
                ' | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak' +
                ' | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl',
            autosave_ask_before_unload: true,
            autosave_interval: "30s",
            autosave_prefix: "{path}{query}-{id}-",
            autosave_restore_when_empty: false,
            autosave_retention: "2m",
            image_advtab: true,
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ],
            importcss_append: true,
            height: 700,
            file_picker_callback: function (callback, value, meta) {
                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                }
                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                }
            },
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_drawer: 'sliding',
            spellchecker_dialog: true,
            spellchecker_whitelist: ['Ephox', 'Moxiecode'],
            content_style: ".mymention{ color: green; }",
            contextmenu: "link image imagetools table configurepermanentpen"
        });
    </script>
@endsection