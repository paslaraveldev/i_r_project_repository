<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Supervisor Dashboard')</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Header Styles */
        header {
            background-color: #2d3e50; /* Dark Blue */
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        /* Navigation Styles */
        nav {
            background-color: #ffeb3b; /* Yellow */
            padding: 12px 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav a {
            color: #333;
            text-decoration: none;
            padding: 12px 20px;
            margin: 0 15px;
            border-radius: 5px;
            font-weight: 600;
            text-transform: uppercase;
            transition: background-color 0.3s, color 0.3s;
        }

        nav a:hover {
            background-color: #4CAF50; /* Green */
            color: white;
        }

        /* Profile Styles */
        .profile {
            display: flex;
            align-items: center;
            margin: 20px 0;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            flex-grow: 1;
        }

        .profile-info h3 {
            margin: 0;
            font-size: 1.6rem;
            color: #2d3e50;
        }

        .profile-info p {
            margin: 5px 0;
            color: #777;
        }

        .profile-actions {
            text-align: right;
        }

        .profile-actions .btn {
            padding: 10px 20px;
            margin-left: 10px;
        }

        /* Main Content Styles */
        main {
            padding: 40px 20px;
        }

        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .card-header h4 {
            margin: 0;
            font-size: 1.6rem;
            color: #2d3e50;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 1rem;
        }

        .table th {
            background-color: #f4f4f4;
            font-weight: 600;
            color: #333;
        }

        .table td {
            color: #555;
        }

        .table a {
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            transition: background-color 0.3s;
        }

        .table a:hover {
            background-color: #45a049;
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        footer {
            background-color: #2d3e50;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .table th, .table td {
                font-size: 0.9rem;
                padding: 8px;
            }

            header h1 {
                font-size: 2rem;
            }

            nav a {
                padding: 10px;
                font-size: 0.9rem;
            }

            .card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>@yield('header', 'Supervisor Dashboard')</h1>
</header>

<nav>
    <a href="{{ route('supervisor.proposals.index') }}">Proposals</a>
    <a href="{{ route('supervisor.reports.index') }}">Reports</a> 
    <a href="#">Settings</a>
</nav>

<main>
    <!-- Profile Section -->
    <div class="profile">
        <div class="profile-image">
            <img src="{{ asset('images/users/' . Auth::user()->image) }}" alt="Profile Image">
        </div>
        <div class="profile-info">
            <h3>{{ Auth::user()->name }}</h3>
            <p>Email: {{ Auth::user()->email }}</p>
            <p>Role: {{ ucfirst(Auth::user()->role) }}</p>
        </div>
       
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    @yield('content')
</main>

<footer>
    <p>&copy; 2025 Supervisor Dashboard</p>
</footer>

</body>
</html>
