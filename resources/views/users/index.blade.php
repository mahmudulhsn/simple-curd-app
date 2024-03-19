<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Users List
                </h2>
            </div>
            <div class="w-50 flex gap-2">
                @if (Route::is('users.trash'))
                    <form action="{{ route('users.restore-all') }}" method="post" class="inline">
                        @csrf
                        <button onclick="return confirm('Are you sure you want to restore all the data?')"
                            class="bg-teal-600 hover:bg-teal-800 text-white font-bold py-2 px-4 rounded">
                            Restore
                        </button>
                    </form>
                @endif
                <a href="{{ route('users.trash') }}"
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
                                        <td class="whitespace-nowrap px-6 py-4">Avatar</td>
                                        <td class="whitespace-nowrap px-6 py-4">Email</td>
                                        <td class="whitespace-nowrap px-6 py-4 float-right">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="border-b border-neutral-200">
                                            <td class="whitespace-nowrap px-6 py-4">{{ $user->name }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">
                                                @if ($user->avatar)
                                                    <img class="rounded h-10 w-10"
                                                        src="{{ Storage::url($user->avatar) }}"
                                                        alt="{{ $user->name }}">
                                                @endif
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $user->email }}</td>
                                            <td
                                                class="whitespace-nowrap py-4 float-right px-6 flex justify-center items-center">
                                                @if (Route::is('users.trash'))
                                                    <div class="flex justify-between gap-4">
                                                        <form action="{{ route('users.restore', $user->id) }}"
                                                            method="post" class="inline">
                                                            @csrf
                                                            <button
                                                                onclick="return confirm('Are you sure you want to restore this?')"
                                                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                                Restore
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('users.force-delete', $user->id) }}"
                                                            method="post" class="inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                onclick="return confirm('Are you sure you want to restore this?')"
                                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                                Permanent Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <div class="flex justify-between gap-4">
                                                        <a class="bg-teal-700 hover:bg-teal-900 text-white font-bold py-2 px-4 rounded"
                                                            href="{{ route('users.show', $user->id) }}">
                                                            Show
                                                        </a>
                                                        <a class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded"
                                                            href="{{ route('users.edit', $user->id) }}">
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                            method="post" class="inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                onclick="return confirm('Are you sure you want to delete this?')"
                                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
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
