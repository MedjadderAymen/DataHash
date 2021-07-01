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
                    <div class="card-header"> Create hashed post</div>

                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="title">title</label>
                                <input type="text" name="title" class="form-control" id="title"
                                       placeholder="will be hashed">
                            </div>
                            <div class="form-group">
                                <label for="content">content</label>
                                <textarea class="form-control" name="content" id="content" rows="3"
                                          placeholder="won't be hashed"></textarea>
                            </div>
                            <a onclick="addPost()" class="btn btn-primary">click</a>
                            <br>
                            <br>

                            <strong><label>Original String:</label></strong>
                            <span id="demo0"></span>

                            <br>
                            <br>

                            <strong><label>Encrypted:</label></strong>
                            <span id="demo1"></span>

                            <br>
                            <br>

                            <strong><label>Decrypted:</label></strong>
                            <span id="demo2"></span>

                            <br>
                            <br>

                            <strong><label>String after Decryption:</label></strong>
                            <span id="demo3"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

<script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>

<script type="text/javascript">

    // POST REQUEST
    async function addPost() {

        // For adding the token to axios header (add this only one time).
        var token = document.head.querySelector('meta[name="csrf-token"]');
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

        const title = document.getElementById('title').value;
        const content = document.getElementById('content').value;

        if (title.length === 0 || content.length === 0) {

            alert('Please fill data')

        } else {

            // INIT
            // INIT
            var myPassword = localStorage.getItem('key');

            // PROCESS
            var encrypted = CryptoJS.AES.encrypt(content, myPassword);
            var decrypted = CryptoJS.AES.decrypt(encrypted, myPassword);
            document.getElementById("demo0").innerHTML = content;
            document.getElementById("demo1").innerHTML = encrypted;
            document.getElementById("demo2").innerHTML = decrypted;
            document.getElementById("demo3").innerHTML = decrypted.toString(CryptoJS.enc.Utf8);

            axios.post(
                '/post',
                {
                    title: title,
                    content: encrypted.toString()
                },
            ).then(res => showData(res))
                .catch(err => console.log(err))
        }

    }

    function showData(contentCrypted){

        console.log(contentCrypted.data)

        var myPassword = localStorage.getItem('key');

        var decrypted = CryptoJS.AES.decrypt(contentCrypted.data, myPassword);

        console.log(decrypted.toString(CryptoJS.enc.Utf8))

       // window.location="/zz"

    }

</script>
