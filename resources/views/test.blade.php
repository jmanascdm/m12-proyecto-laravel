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

<!-- https://www.bestjquery.com/2017/07/clientsidecaptcha-pure-client-side-javascript-captcha/ -->
	<h2>Captcha</h2>
    <div class="captcha-chat">
        <div class="captcha-container media">
            <div class="media-body">
                <p>Security Check:</p>                
            </div>
            <div id="captcha">
                <div class="controls">
                    <input class="user-text btn-common" placeholder="Type here" type="text" />
                    <button class="btn btn-success">
                        <!-- this image should be converted into inline svg -->
                        <img src="img/enter_icon.png" alt="submit icon">
                    </button>
                    <button class="btn btn-warning">
                        <!-- this image should be converted into inline svg -->
                        <img src="img/refresh_icon.png" alt="refresh icon">
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="{{ asset('js/captcha/client_captcha.js') }}" defer></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.body.scrollTop; //force css repaint to ensure cssom is ready

        var timeout; //global timout variable that holds reference to timer

        var captcha = new $.Captcha({
            onFailure: function() {

                $(".captcha-chat .wrong").show({
                    duration: 30,
                    done: function() {
                        var that = this;
                        clearTimeout(timeout);
                        $(this).removeClass("shake");
                        $(this).css("animation");
                        //Browser Reflow(repaint?): hacky way to ensure removal of css properties after removeclass
                        $(this).addClass("shake");
                        var time = parseFloat($(this).css("animation-duration")) * 1000;
                        timeout = setTimeout(function() {
                            $(that).removeClass("shake");
                        }, time);
                    }
                });

            },

            onSuccess: function() {
                alert("CORRECT!!!");
            }
        });

        captcha.generate();
    });
    </script>
@endsection