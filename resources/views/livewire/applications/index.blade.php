<div>
    <div class="container mx-auto p-5 rounded-md shadow-md my-5 dark:shadow-gray-300">
        <h3 class="text-2xl font-semibold mb-5">My Job Applications</h3>
        @if($applications->count() > 0)
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-2 py-1.5">Job Title</th>
                        <th class="border border-gray-300 px-2 py-1.5">Company</th>
                        <th class="border border-gray-300 px-2 py-1.5">Applied Date</th>
                        <th class="border border-gray-300 px-2 py-1.5">Status</th>
                        <th class="border border-gray-300 px-2 py-1.5">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                        <tr wire:key="{{ $application->id }}">
                            <td class="border border-gray-300 px-2 py-1.5">{{ $application->job->title }}</td>
                            <td class="border border-gray-300 px-2 py-1.5">{{ $application->job->company->name }}</td>
                            <td class="border border-gray-300 px-2 py-1.5">{{ $application->created_at->format('M d, Y') }}</td>
                            <td class="border border-gray-300 px-2 py-1.5">
                                @if($application->status == 'pending')
                                    <span class="px-1 py-1 rounded bg-yellow-600 text-white">Pending</span>
                                @elseif($application->status == 'reviewing')
                                    <span class="px-1 py-1 rounded bg-orange-600 text-white">Reviewing</span>
                                @elseif($application->status == 'interviewed')
                                    <span class="px-1 py-1 rounded bg-blue-600 text-white">Interviewed</span>
                                @elseif($application->status == 'accepted')
                                    <span class="px-1 py-1 rounded bg-green-600 text-white">Accepted</span>
                                @elseif($application->status == 'rejected')
                                    <span class="px-1 py-1 rounded bg-red-600 text-white">Rejected</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-2 py-1.5">
                                <a href="{{ route('applications.show', ['id' => $application->id]) }}" wire:navigate>
                                    <x-primary-button>{{ __('View') }}</x-primary-button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500 dark:text-white">No job applications.</p>
        @endif
        <div class="mt-4">
            {{ $applications->links() }}
        </div>
    </div>
</div>