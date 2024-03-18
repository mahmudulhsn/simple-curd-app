<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    protected $userService;

    /**
     * User controller constructor
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('users.index', [
            'users' => $this->userService->getAllUsers([]),
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
        $this->userService->createUser($request->validated());

        return redirect(route('users.index'))->with('success', 'User has been created successfully.');
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
            $this->userService->updateUser($user, $request->validated());

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
            $this->userService->forceDelete($user);

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

            return redirect(route('users.index'))->with('success', 'User has been deleted permanently.');
        }

        return redirect(route('users.index'))->with('error', 'Something went wrong!');
    }

    /**
     * Restore all archived users
     */
    public function restoreAll(): RedirectResponse
    {
        $this->userService->restoreAll();

        return redirect(route('users.index'))->with('success', 'All deleted users has been restored successfully.');
    }
}
