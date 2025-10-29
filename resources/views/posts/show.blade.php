<x-app-layout>
    <x-slot:title>Post</x-slot>

        <div class="container mx-auto mt-10 bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between border-b pb-4">
                <div>
                    <h2 class="font-bold text-xl text-gray-800">
                        <h2> {{ $post->user->first_name }} {{ $post->user->last_name }} </h2>
                    </h2>
                    <p class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y h:i A') }}</p>
                </div>
            </div>
            <div class="mt-6">
                <p class="text-gray-800 text-lg font-bold leading-relaxed capitalize">
                    {{ $post->title }}
                </p>
                <p class="text-gray-800 text-lg font-medium leading-relaxed capitalize my-3">
                    {{ $post->description }}
                </p>
                <div class='prose max-w-none'>{!! $post->html_content !!}</div>
            </div>
        </div>
</x-app-layout>