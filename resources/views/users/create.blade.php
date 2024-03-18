<x-app-layout>
    <x-slot name="extraJS">
        <script>
            function address() {
                return {
                    fields: [],
                    addNewField() {
                        this.fields.push({
                            items: null,
                        });
                    },
                    removeField(index) {
                        this.fields.splice(index, 1);
                    }
                }
            }
        </script>
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create new user
            <a href="{{ route('users.index') }}"
                class="float-right bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">
                Users List
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col" x-data="address">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block w-full py-2 sm:px-6 lg:px-8">
                        <form class="w-full mx-auto" action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="mb-5">
                                <label for="name" class="block mb-2 text-sm font-medium ">Name <sup
                                        class="text-red-500 text-sm">*</sup></label>
                                <input type="text" id="name"
                                    class="bg-white border   text-sm rounded-lg  block w-full p-2.5"
                                    placeholder="Jon Doe" name="name">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="mb-5">
                                <label for="email" class="block mb-2 text-sm font-medium">Email <sup
                                        class="text-red-500 text-sm">*</sup></label>
                                <input type="email" id="email"
                                    class="bg-white border text-sm rounded-lg  block w-full p-2.5"
                                    placeholder="email@example.com" name="email">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="mb-5">
                                <label for="email" class="block mb-2 text-sm font-medium">Address <sup
                                        class="text-red-500 text-sm">*</sup></label>
                                <div class="flex gap-4">
                                    <input type="text" id="text"
                                        class="bg-white border text-sm rounded-lg  block w-full p-2.5"
                                        name="addresses[]">
                                    <span
                                        class="w-10 bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded cursor-pointer"
                                        @click="addNewField()">
                                        +
                                    </span>
                                </div>

                                <template x-for="(field, index) in fields" :key="index">
                                    <div class="flex gap-4 my-2">
                                        <input type="text" id="text"
                                            class="bg-white border text-sm rounded-lg  block w-full p-2.5"
                                            name="addresses[]">
                                        <span
                                            class="w-10 bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded cursor-pointer"
                                            @click="removeField()">
                                            -
                                        </span>
                                    </div>
                                </template>

                                <x-input-error :messages="$errors->get('addresses')" class="mt-2" />
                            </div>
                            <div class="mb-5">
                                <label for="password" class="block mb-2 text-sm font-medium">Password <sup
                                        class="text-red-500 text-sm">*</sup></label>
                                <input type="password" id="password"
                                    class="bg-white border text-sm rounded-lg  block w-full p-2.5"
                                    placeholder="********" name="password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="mb-5">
                                <label for="password_conformation" class="block mb-2 text-sm font-medium">Confirm
                                    Password <sup class="text-red-500 text-sm">*</sup></label>
                                <input type="password" id="password_conformation"
                                    class="bg-white border text-sm rounded-lg  block w-full p-2.5"
                                    placeholder="********" name="password_confirmation">
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
