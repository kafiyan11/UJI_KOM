<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background styling */
        body {
            background: linear-gradient(135deg, #e0f7fa, #80deea);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        /* Login container styling */
        .login-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }
        /* Title styling */
        .login-container h3 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 700;
            color: #00796b;
        }
        /* Input styling */
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid #b2dfdb;
        }
        .form-control:focus {
            border-color: #00796b;
            box-shadow: 0 0 5px rgba(0, 121, 107, 0.5);
        }
        /* Button styling */
        .btn-primary {
            background-color: #00796b;
            border-color: #00796b;
            font-weight: bold;
            border-radius: 8px;
            padding: 0.75rem;
            width: 100%;
            font-size: 1rem;
        }
        .btn-primary:hover {
            background-color: #004d40;
            border-color: #004d40;
        }
        /* Success alert styling */
        .alert-success {
            border-radius: 8px;
            color: #004d40;
            background-color: #b2dfdb;
            padding: 0.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }
        /* Label styling */
        .form-label {
            font-weight: 600;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3>Login</h3>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required autofocus>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password &nbsp;</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
