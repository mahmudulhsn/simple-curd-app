<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users List') }}
            <button class="float-right bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">Add new
                user</button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block w-full py-2 sm:px-6 lg:px-8">
                        <div>
                            <table class="w-full text-left text-sm font-light text-surface">
                                <thead class="border-b border-neutral-200 font-medium ">
                                    <tr class="border-b border-neutral-200">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">#</td>
                                        <td class="whitespace-nowrap px-6 py-4">Name</td>
                                        <td class="whitespace-nowrap px-6 py-4">Email</td>
                                        <td class="whitespace-nowrap px-6 py-4">Address</td>
                                        <td class="whitespace-nowrap px-6 py-4 float-right">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="border-b border-neutral-200">
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">1</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $user->name }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $user->email }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $user->adddress }}</td>
                                            <td class="whitespace-nowrap px-6 py-4 float-right">
                                                <button
                                                    class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">
                                                    Edit
                                                </button>
                                                <button
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
