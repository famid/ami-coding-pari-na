<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
    <title>Sign Up Form</title>
</head>
<body>

<form action="{{ route('web.auth.sign_up') }}" method="POST">
    @csrf

    <h1>Sign Up</h1>

    <fieldset>
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="first_name" required>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="last_name" required>

        <label for="username">Last Name:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <label for="passwordConfirm">Retype password:</label>
        <input type="password" id="passwordConfirm" name="password_confirmation">

        <input type="checkbox" id="development" value="interest_development" name="user_interest">
        <label class="light" for="development">Development</label><br>
    </fieldset>
    <button type="submit">Sign Up</button>
</form>

</body>
</html>
