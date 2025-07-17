<x-app-layout>
    <x-slot:title>Redirect</x-slot>
    
    <div class='h-screen w-full flex items-center justify-center'>
        <div class='h-[500px] w-[80%] rounded-md shadow-md flex items-center justify-center flex-col gap-5'>
            <h1 class='text-3xl font-bold'>Unauthorized</h1>
            <p class='text-gray-600'>Only authenticated users can access this page.</p>
            <div class='flex items-center gap-5'>
                <a href="{{ route('user.login') }}" class='btn'>User Login</a>
                <a href="{{ route('employer.login') }}" class='btn'>Employer Login</a>
            </div>
        </div>
    </div>
</x-app-layout>