<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
            <a href="{{ route('users.index') }}"
                class="float-right bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">
                Users List
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block w-full py-2 sm:px-6 lg:px-8">
                        <form class="w-full mx-auto" action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-5">
                                <label for="name" class="block mb-2 text-sm font-medium ">Name <sup
                                        class="text-red-500 text-sm">*</sup></label>
                                <input type="text" id="name"
                                    class="bg-white border   text-sm rounded-lg  block w-full p-2.5"
                                    placeholder="Jon Doe" name="name" value="{{ $user->name }}">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="mb-5">
                                <label for="email" class="block mb-2 text-sm font-medium">Email <sup
                                        class="text-red-500 text-sm">*</sup></label>
                                <input type="email" id="email"
                                    class="bg-white border text-sm rounded-lg  block w-full p-2.5"
                                    placeholder="email@example.com" name="email" value="{{ $user->email }}">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
