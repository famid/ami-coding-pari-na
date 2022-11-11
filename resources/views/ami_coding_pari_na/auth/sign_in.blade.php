@extends('ami_coding_pari_na.auth.layouts.base_auth')
@section('title', __('Sign In'))
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
@endsection
@section('content')
    <div class="container">
        <form action="{{ route('web.auth.sign_in') }}" method="POST">
            @csrf

            <h1>Sign In</h1>

            <fieldset>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

            </fieldset>
            <button type="submit">Sign In</button>
        </form>
    </div>
@endsection
