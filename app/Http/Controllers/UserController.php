<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Address;
use App\Models\User;
use App\Services\AddressService;
use App\Services\MediaService;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * UserController constructor
     */
    public function __construct(protected UserService $userService, protected AddressService $addressService, protected MediaService $mediaService)
    {
        $this->userService = $userService;
        $this->mediaService = $mediaService;
        $this->addressService = $addressService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('users.index', [
            'users' => $this->userService->getAllUsers(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $file = null;

                if ($request->hasFile('avatar')) {
                    $file = $this->mediaService->uploadMedia($request->avatar, 'public/avatar');
                }

                $user = $this->userService->createUser([
                    'name' => $request->name,
                    'email' => $request->email,
                    'avatar' => $file,
                    'password' => $request->password,
                ]);

                if ($user instanceof User) {
                    foreach ($request->addresses as $address) {
                        $this->addressService->createAddress([
                            'user_id' => $user->id,
                            'address' => $address,
                        ]);
                    }
                }
            }, 5);

            return redirect(route('users.index'))->with('success', 'User has been created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong!');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('users.show', [
            'user' => $this->userService->getUserById($id, []),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('users.edit', [
            'user' => $this->userService->getUserById($id, []),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = $this->userService->getUserById($id);
        if ($user instanceof User) {
            $userData = $request->only(['name', 'email', 'password']);

            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    $this->mediaService->deleteMedia($user->avatar);
                }
                $file = $this->mediaService->uploadMedia($request->avatar, 'public/avatar');
                $userData['avatar'] = $file;
            }

            $this->userService->updateUser($user, $userData);

            if (isset($request->addresses)) {
                foreach ($request->addresses['id'] as $key => $addressID) {
                    if ($addressID !== null) {
                        $address = $this->addressService->getAddressById($addressID);
                        if ($address instanceof Address) {
                            $this->addressService->updateAddress($address, ['address' => $request->addresses['address'][$key]]);
                        }
                    } else {
                        $this->addressService->createAddress([
                            'user_id' => $id,
                            'address' => $request->addresses['address'][$key],
                        ]);
                    }
                }
            }

            return redirect(route('users.index'))->with('success', 'User has been deleted successfully.');
        }

        return redirect(route('users.index'))->with('error', 'Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userService->getUserById($id);
        if ($user instanceof User) {
            $this->userService->deleteUser($user);

            return redirect(route('users.index'))->with('success', 'User has been deleted successfully.');
        }

        return redirect(route('users.index'))->with('error', 'Something went wrong!');
    }

    /**
     *  Restore user data
     */
    public function restore($id): RedirectResponse
    {
        $user = $this->userService->getUserById($id, [], 'withTrashed');
        if ($user instanceof User) {
            $this->userService->restore($user);

            return redirect(route('users.index'))->with('success', 'User has been restored successfully.');
        }

        return redirect(route('users.index'))->with('error', 'Something went wrong!');
    }

    /**
     * Force delete user data
     */
    public function forceDelete(string $id): RedirectResponse
    {
        $user = $this->userService->getUserById($id, [], 'withTrashed');
        if ($user instanceof User) {
            $this->userService->forceDelete($user);

            return redirect()->back()->with('success', 'User has been deleted permanently.');
        }

        return redirect()->back()->with('error', 'Something went wrong!');
    }

    /**
     * Restore all archived users
     */
    public function restoreAll(): RedirectResponse
    {
        $this->userService->restoreAll();

        return redirect(route('users.index'))->with('success', 'All deleted users has been restored successfully.');
    }

    /**
     * Restore all archived users
     */
    public function trash(): View
    {
        $this->userService->trash();

        return view('users.index', [
            'users' => $this->userService->trash(),
        ]);
    }
}
