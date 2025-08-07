<!DOCTYPE html>
<html>
<head>
    <title>Email Notification Form</title>
</head>
<body>
    <h2>Email Notification Form</h2>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('email.send') }}">
        @csrf

        <label for="username">Username:</label><br>
        <input type="text" name="username" value="{{ old('username') }}" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required><br><br>

        <button type="submit">Send Email</button>
    </form>
</body>
</html>
