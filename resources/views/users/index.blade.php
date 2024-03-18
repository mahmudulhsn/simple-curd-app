<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Users List
                </h2>
            </div>
            <div class="w-50 flex gap-2">
                <a href="{{ route('users.create') }}"
                    class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">Trash</a>
                <a href="{{ route('users.create') }}"
                    class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">Add new
                    user</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    @if ($users)
                        <div class="inline-block w-full py-2 sm:px-6 lg:px-8">
                            <table class="w-full text-left text-sm font-light text-surface">
                                <thead class="border-b border-neutral-200 font-medium ">
                                    <tr class="border-b border-neutral-200">
                                        <td class="whitespace-nowrap px-6 py-4">Name</td>
                                        <td class="whitespace-nowrap px-6 py-4">Email</td>
                                        <td class="whitespace-nowrap px-6 py-4">Address</td>
                                        <td class="whitespace-nowrap px-6 py-4 float-right">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="border-b border-neutral-200">
                                            <td class="whitespace-nowrap px-6 py-4">{{ $user->name }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $user->email }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $user->adddress }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 float-right">
                                                <button
                                                    class="bg-teal-700 hover:bg-teal-900 text-white font-bold py-2 px-4 rounded">
                                                    <a href="{{ route('users.show', $user->id) }}">
                                                        Show
                                                    </a>
                                                </button>
                                                <button
                                                    class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">
                                                    <a href="{{ route('users.edit', $user->id) }}">
                                                        Edit
                                                    </a>
                                                </button>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                                    class="inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete this?')"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $users->links() }}
                    @else
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                            <p class="font-bold">Alert!</p>
                            <p>No data found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
