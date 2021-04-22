@extends('layouts.app')

@section('content')
    <h1>Test Page</h1>
    <script src="https://cdn.tiny.cloud/1/21wmjgvo3uldi678zp5poa3pc2pn0n8cu7rw8iwmp8c3r3n9/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
  
    <textarea>
		Welcome to TinyMCE!
	</textarea>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
        });
    </script>

	<h2>Captcha</h2>
@endsection