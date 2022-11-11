@extends('ami_coding_pari_na.auth.layouts.base_auth')
@section('title', __('Sign Up'))
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
@endsection
@section('content')
    <form action="{{ route('web.auth.sign_up') }}" method="POST">
        @csrf

        <h1>Sign Up</h1>

        <fieldset>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="first_name" value="{{ old('first_name') }}" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="last_name" value="{{ old('last_name') }}" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="passwordConfirm">Retype password:</label>
            <input type="password" id="passwordConfirm" name="password_confirmation" required>

            <input type="checkbox" id="development" value="interest_development" name="user_interest">
            <label class="light" for="development">Development</label><br>
        </fieldset>
        <div>Already have an account? Please <a href="{{route('web.auth.sign_in.index')}}">Login</a> </div>
        <button type="submit">Sign Up</button>
    </form>
@endsection
