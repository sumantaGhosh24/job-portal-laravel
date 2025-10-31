<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="author" content="sumanta ghosh" />
    <meta name="description" content="best travel service in your country" />
    <meta name="keywords" content="travel, foreign trip, international vacation" />

    <!--==================== favicon ====================-->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="msapplication-TileColor" content="#000000" />
    <meta name="theme-color" content="#000000" />

    <!--==================== canonical ====================-->
    <link rel="canonical" href="http://example.com/home" />

    <!--==================== fontawesome cdn ====================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />

    <title>{{ $title }} | {{ config('app.name', 'Job Portal') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <nav class="bg-blue-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold">Logo</a>
            <ul class="flex space-x-4">
                @guest
                    <li><a href="{{ route('welcome') }}">Home</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endguest

                @auth('web')
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('profile', ['id' => $user_id]) }}">Profile</a></li>
                    @if ($company_id)
                        <li><a href="{{ route('companies.show', ['id' => $company_id]) }}">My Company</a></li>
                    @else
                        <li><a href="{{ route('companies.create') }}">Create Company</a></li>
                    @endif
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <!--==================== add noscript ====================-->
    <noscript>please enable JavaScript in your website.</noscript>
</body>

</html>