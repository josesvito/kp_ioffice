@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                        <br><br>
                    You will be redirect to home in <span id="counter">3</span> seconds
                    {{-- <meta http-equiv = "refresh" content = "3; url = /" /> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    setInterval(function() {
        var div = document.querySelector("#counter");
        var count = div.textContent * 1 - 1;
        div.textContent = count;
        if (count <= 0) {
            window.location.replace("/");
        }
    }, 1000);
</script>

