@extends('layouts.app')

@section('content')
    <h1>Test Page</h1>
    {{ date("H:i:s") }}
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
    <!-- https://www.bestjquery.com/2017/07/clientsidecaptcha-pure-client-side-javascript-captcha/ -->
	<div id="captcha">
		<div class="controls">
			<input class="user-text" placeholder="Type here" type="text" />
			<button class="validate">Submit</button>
			<button class="refresh">Refresh</button>
		</div>
	</div>
    <script src="{{ asset('js/captcha/client_captcha.js') }}" defer></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var captcha = new $.Captcha({
            onFailure: function() {
                alert("WRONG!!!");
            },

            onSuccess: function() {
                alert("CORRECT!!!");
            }
        });

        captcha.generate();
    });
    </script>
@endsection