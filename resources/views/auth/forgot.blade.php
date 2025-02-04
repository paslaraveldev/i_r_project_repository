<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fffde7;
            color: #2e7d32;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9fbe7;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, button {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #c5e1a5;
            border-radius: 5px;
            font-size: 1rem;
        }

        input:focus {
            border-color: #2e7d32;
            outline: none;
        }

        button {
            background-color: #2e7d32;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #1b5e20;
        }

        .error {
            color: red;
            font-size: 0.9rem;
        }

        .success {
            color: green;
            font-size: 0.9rem;
        }

        .register {
            text-align: center;
            margin-top: 15px;
        }

        .register a {
            color: #2e7d32;
            text-decoration: underline;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Forgot Password</h1>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif
        @if($errors->any())
            <ul class="error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="forgot_post">
            @csrf
            <label for="email">Email Address</label>
            <input type="email" value="{{old('email')}}" id="email" name="email" placeholder="Enter your email address" required>

            <button type="submit">Send Password Reset Link</button>
        </form>

        <div class="register">
            <p>Remembered your password? <a href="{{ url('login') }}">Login</a></p>
        </div>
    </div>
</body>
</html>
