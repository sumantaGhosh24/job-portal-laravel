<nav class="bg-blue-800 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="#" class="text-2xl font-bold" wire:navigate>Logo</a>
        <ul class="flex items-center space-x-4">
            @guest
                <li>
                    <a href="{{ route('welcome') }}" wire:navigate
                        wire:current.exact="font-bold underline underline-offset-[8px]">Home</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" wire:navigate
                        wire:current.exact="font-bold underline underline-offset-[8px]">Register</a>
                </li>
                <li>
                    <a href="{{ route('login') }}" wire:navigate
                        wire:current.exact="font-bold underline underline-offset-[8px]">Login</a>
                </li>
            @endguest

            @auth('web')
                <li>
                    <a href="{{ route('home') }}" wire:navigate
                        wire:current.exact="font-bold underline underline-offset-[8px]">Home</a>
                </li>
                <div class="dropdown inline-block relative">
                    <button
                        class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center cursor-pointer dark:bg-gray-700 dark:text-white">
                        <span class="mr-1">Profile</span>
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </button>
                    <ul class="dropdown-menu absolute hidden text-gray-700 pt-1 dark:text-white">
                        <li>
                            <a class="bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-no-wrap dark:bg-gray-500 hover:dark:bg-gray-600"
                                href="{{ route('profile', ['id' => $user_id]) }}" wire:navigate
                                wire:current.exact="bg-gray-300 dark:bg-gray-600">Profile</a>
                        </li>
                        <li>
                            <a class="bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-no-wrap dark:bg-gray-500 hover:dark:bg-gray-600"
                                href="{{ route('applications.index') }}" wire:navigate
                                wire:current.exact="bg-gray-300 dark:bg-gray-600">My Applications</a>
                        </li>
                    </ul>
                </div>
                <li><a href="{{ route('jobs.index') }}" wire:navigate
                        wire:current.exact="font-bold underline underline-offset-[8px]">Jobs</a></li>
                @if ($company_id)
                    <div class="dropdown inline-block relative">
                        <button
                            class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center cursor-pointer dark:bg-gray-700 dark:text-white">
                            <span class="mr-1">Manage Company</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </button>
                        <ul class="dropdown-menu absolute hidden text-gray-700 pt-1 dark:text-white">
                            <li>
                                <a class="bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-no-wrap dark:bg-gray-500 hover:dark:bg-gray-600"
                                    href="{{ route('companies.show', ['id' => $company_id]) }}" wire:navigate
                                    wire:current.exact="bg-gray-300 dark:bg-gray-600">My Company</a>
                            </li>
                            <li>
                                <a class="bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-no-wrap dark:bg-gray-500 hover:dark:bg-gray-600"
                                    href="{{ route('applications.manage') }}" wire:navigate
                                    wire:current.exact="bg-gray-300 dark:bg-gray-600">Manage Applications</a>
                            </li>
                        </ul>
                    </div>
                @else
                    <li>
                        <a href="{{ route('companies.create') }}" wire:navigate
                            wire:current.exact="font-bold underline underline-offset-[8px]">Create Company</a>
                    </li>
                @endif
                <li><a href="#" wire:click.prevent="logout" wire:navigate>Logout</a></li>
            @endauth
            <li id="themeToggle" class="cursor-pointer text-xl"></li>
        </ul>
    </div>
</nav>