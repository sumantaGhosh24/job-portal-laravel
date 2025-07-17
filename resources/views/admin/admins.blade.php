<x-app-layout>
    <x-slot:title>Admin Manage Admins</x-slot>

    <div class="pt-8">
        <h2 class="text-2xl font-bold text-center my-5">Manage Admins</h2>
        <div class="w-[100vw] overflow-x-auto">
            <table class="max-w-[100vw] rounded-lg shadow-md mx-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Mobile Number</th>
                        <th class="py-3 px-6 text-left">First Name</th>
                        <th class="py-3 px-6 text-left">Last Name</th>
                        <th class="py-3 px-6 text-left">Username</th>
                        <th class="py-3 px-6 text-left">Image</th>
                        <th class="py-3 px-6 text-left">DOB</th>
                        <th class="py-3 px-6 text-left">Gender</th>
                        <th class="py-3 px-6 text-left">City</th>
                        <th class="py-3 px-6 text-left">State</th>
                        <th class="py-3 px-6 text-left">Country</th>
                        <th class="py-3 px-6 text-left">Zip</th>
                        <th class="py-3 px-6 text-left">Addressline</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-left">Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $user)
                        <tr>
                            <td class="py-3 px-6 text-left">{{ $user->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->mobileNumber }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->firstName }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->lastName }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->username }}</td>
                            <td class="py-3 px-6 text-left">
                                @if($user->image == "https://placehold.co/600x400.png")
                                    <img src="https://placehold.co/600x400.png" alt="avatar" class="w-12 h-12 rounded-full" />
                                @else
                                    <img src="{{ asset('storage/' . $user->image) }}" alt="avatar" class="w-12 h-12 rounded-full" />
                                @endif
                            </td>
                            <td class="py-3 px-6 text-left">{{ $user->dob }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->gender }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->city }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->state }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->country }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->zip }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->addressline }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->created_at }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->updated_at }}</td>
                        </tr>
                    @empty
                        <h2 class="text-2xl font-bold my-5">No Admins Found!</h2>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>