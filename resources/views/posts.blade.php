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
                    </div>
                </div>
            </div>
        </div>
        <br>


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> title : {{$post->title}}</div>

                    <div class="card-body">

                        <p><strong>content crypted </strong>: {{$post->content}}</p>
                        <p id="contentDcrypted"><strong>content dcrypted </strong>: {{$post->content}}</p>

                    </div>
                </div>
            </div>
        </div>

        <br>


    </div>
@endsection

<script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function () {

        var content='{{$post->content}}'

        var myPassword = localStorage.getItem('key');

        var decrypted = CryptoJS.AES.decrypt(content, myPassword);

        document.getElementById('contentDcrypted').innerText = decrypted.toString(CryptoJS.enc.Utf8);


    }, false);

</script>

