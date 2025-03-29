@extends('layouts.app')

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
                    @auth
                    <a href="/homepage?">Home Page</a>
                    @endauth

                    @guest
                    <p style="color: red;">Please Login for the further Process</p>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection