<?php $title = 'Error' ?>
@extends('layouts.base')

@section('content')
<!-- ======= Main Section ======= -->
<div class="container mb-5">
	<h1>Error</h1>
	<h3 class="text-danger text-center">{{ $error_title }}</h3>
	<p>
		{!! $error_msg !!}
	</p>
</div>

@endsection