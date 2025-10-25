<x-app-layout>
    <x-slot:title>Home</x-slot>

        @if (session('message'))
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ session('message') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class='flex items-center justify-center h-screen'>
            <div class='h-[500px] w-[60%] gap-5 shadow-md rounded-md shadow-black text-center'>
                <h1 class='text-4xl font-bold capitalize mt-36'>Welcome to job search portal</h1>
                <p class='text-xl my-20'>This website still in development phase, stay tuned for future updates</p>
            </div>
        </div>
</x-app-layout>