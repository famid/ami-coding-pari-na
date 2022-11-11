<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">

    <title>Document</title>
    <style>
        .alert {
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            padding: 10px;
        }
        .alert-success {
            background: #5cb85c;
        }
        .alert-danger {
            background: #d9534f;
        }
        .d-none {
            display:none;
        }
        .nav{
            padding: 10px 20px;
            background: #ddd;
        }
        .nav-list {
            display: flex;
            justify-content: end;
            align-items: center;
        }
        .nav-item {
            list-style-type: none;
        }
        .nav-item > a{
            text-decoration: none;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100vw;
            height: 100vh;
        }
        .center {
            width: 60%;
            min-width: 500px;
            border: 5px solid #212120;
            padding: 10px;
        }
    </style>
</head>
<body>
@if(session()->has('success'))
    <div class="alert alert-success">{{session()->get('success')}}</div>
@endif
@if(session()->has('error'))
    <div class="alert alert-danger">{{session()->get('error')}}</div>
@endif
<div class="nav">
    <ul class="nav-list">
        <li class="nav-item"><a href="{{route('web.auth.sign_out')}}">Logout</a></li>
    </ul>
</div>
<div class="container">
    <div class="center">
        <fieldset>
            <div class="form-group">
                <label for="input_values">Input values</label>
                <input id="input_values" type="text" name="input_values"
                       required pattern="[0-9,]"
                       class="form-control form-control-rounded" value="{{ old('input_values') }}" >

                @error('input_values')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="search_value">Search value</label>
                <input id="search_value" type="number" name="search_value" required
                       class="form-control form-control-rounded" value="{{ old('search_value') }}" >

                @error('search_value')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <button type="button" id="submit_btn" class="btn btn-rounded btn-primary btn-block mt-2">Khoj</button>
            <div class="form-group d-none" id="result_dom">
                <span>Result: </span><span id="result"></span>
            </div>
        </fieldset>

    </div>
</div>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    let routes = []
    routes['web.khoj_the_search.store'] = '{{route('web.khoj_the_search.store')}}'
</script>
<script src="{{asset('assets/js/script.js')}}"></script>
</body>
</html>
