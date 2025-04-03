@auth
<script>
    window.location.href = "/homepage/{{ Auth::user()->id }}";
</script>
<!-- <a href="/homepage/{{ Auth::user()->id }}">Home Page</a> -->
@endauth


@guest



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

                    <!--  -->


                    <p style="color: red;">Please Login for the further Process</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@endguest