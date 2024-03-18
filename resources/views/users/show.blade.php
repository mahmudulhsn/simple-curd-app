<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Details
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
                        <div class="mb-5">
                            <label for="name" class="block mb-2 text-sm font-medium ">Name </label>
                            <input type="email" id="email"
                                class="bg-white border text-sm rounded-lg block w-full p-2.5" disabled name="email"
                                value="{{ $user->name }}">
                        </div>
                        <div class="mb-5">
                            <label for="email" class="block mb-2 text-sm font-medium">Email </label>
                            <input type="email" id="email"
                                class="bg-white border text-sm rounded-lg block w-full p-2.5" disabled name="email"
                                value="{{ $user->email }}">
                        </div>
                        @if ($user->addresses->count() > 0)
                            <div class="mb-5">
                                <label for="email" class="block mb-2 text-sm font-medium">Address </label>
                                @foreach ($user->addresses as $key => $address)
                                    <input type="email" id="email"
                                        class="bg-white border text-sm rounded-lg block w-full p-2.5 my-2" disabled
                                        name="email" value="{{ $address->address }}">
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
