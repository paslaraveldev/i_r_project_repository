<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
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

        .forgot-password {
            text-align: center;
            margin-top: -10px;
            margin-bottom: 15px;
        }

        .forgot-password a {
            color: #2e7d32;
            text-decoration: underline;
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
        <h1>Student Login</h1>

        @if(session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('login.student') }}">
            @csrf
            <label for="email">Email Address</label>
            <input type="email" value="{{old('email')}}" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <div class="forgot-password">
                <a href=" {{ url('forgotpassword') }}">Forgot Password?</a>
            </div>

            <button type="submit">Login</button>
        </form>

        <div class="register">
            <p>Don't have an account? <a href="{{ url('registration') }}">Register</a>
</p>
        </div>
    </div>
</body>
</html>
