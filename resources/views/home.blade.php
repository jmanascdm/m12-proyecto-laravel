@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ======= Main Section ======= -->
<section id="pagaments" class="section-bg">
    <div class="container">

        <div class="section-title">
            <span>Pagaments INS Camí de Mar</span>
            <h2>Pagaments INS Camí de Mar</h2>
            <p>Aquesta és la pàgina principal dels pagaments online de l'INS Camí de Mar de Calafell, per a procedir a
            realitzar un pagament, escull el curs al menú de la barra blava superior i fes clic al nom del pagament que
            vulguis realitzar per a continuar amb el tràmit.</p>
        </div>

    </div>
</section><!-- End Services Section -->
@endsection
