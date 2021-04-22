<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
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
	<form method="get" action="check.php">
		<input type="hidden" name="random" value="<?= $captchas->random () ?>" />
		Your message:
		<input name="message" value="Hello World" size="60" />
		The CAPTCHA password:
		<input name="password" size="6" />
		<?= $captchas->image () ?> <a href="javascript:captchas_image_reload('captchas.net')">Reload Image</a>
		<input type="submit" value="Submit" />
	</form>
</body>

</html>
