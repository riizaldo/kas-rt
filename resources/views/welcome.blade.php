<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Monitoring Kas</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,600" rel="stylesheet" />

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            background-color: #f8fafc;
            font-family: 'Instrument Sans', sans-serif;
            color: #1f2937;
        }

        .container {
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 24px;
            /* Memberi jarak antara judul dan tombol */
        }

        .login-button {
            display: inline-block;
            padding: 12px 28px;
            font-size: 1rem;
            font-weight: 600;
            color: #ffffff;
            background-color: #2563eb;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.2s ease-in-out;
        }

        .login-button:hover {
            background-color: #1d4ed8;
        }

        /* Dark Mode Styles */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #111827;
                color: #f9fafb;
            }

            .login-button {
                background-color: #3b82f6;
            }

            .login-button:hover {
                background-color: #2563eb;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Selamat datang di sistem monitoring kas</h1>
        <a href="/dai2" class="login-button">Login</a>
    </div>
</body>

</html>