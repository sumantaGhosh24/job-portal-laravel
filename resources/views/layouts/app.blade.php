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

<body class="bg-white dark:bg-black text-black dark:text-white">
    <nav class="bg-blue-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold">Logo</a>
            <ul class="flex items-center space-x-4">
                @guest
                    <li><a href="{{ route('welcome') }}">Home</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endguest

                @auth('web')
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <div class="dropdown inline-block relative">
                        <button class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center cursor-pointer dark:bg-gray-700 dark:text-white">
                            <span class="mr-1">Profile</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </button>
                        <ul class="dropdown-menu absolute hidden text-gray-700 pt-1 dark:text-white">
                            <li>
                                <a class="routed-5 bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap dark:bg-gray-500 hover:dark:bg-gray-600" href="{{ route('profile', ['id' => $user_id]) }}">Profile</a>
                            </li>
                            <li>
                                <a class="routed-5 bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap dark:bg-gray-500 hover:dark:bg-gray-600" href="{{ route('applications.index') }}">My Applications</a>
                            </li>
                        </ul>
                    </div>
                    <li><a href="{{ route('jobs.index') }}">Jobs</a></li>
                    @if ($company_id)
                        <div class="dropdown inline-block relative">
                            <button class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center cursor-pointer dark:bg-gray-700 dark:text-white">
                                <span class="mr-1">Manage Company</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu absolute hidden text-gray-700 pt-1 dark:text-white">
                                <li>
                                    <a class="routed-5 bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap dark:bg-gray-500 hover:dark:bg-gray-600" href="{{ route('companies.show', ['id' => $company_id]) }}">My Company</a>
                                </li>
                                <li>
                                    <a class="routed-5 bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap dark:bg-gray-500 hover:dark:bg-gray-600" href="{{ route('applications.manage') }}">Manage Applications</a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <li><a href="{{ route('companies.create') }}">Create Company</a></li>
                    @endif
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @endauth
                <li id="themeToggle" class="cursor-pointer text-xl"></li>
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