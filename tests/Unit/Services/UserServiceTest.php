<?php

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

it('can retrieve all users with optional relations', function () {
    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $usersPaginated = new LengthAwarePaginator([], 0, 10);
    $userRepoMock->shouldReceive('getAllUsers')->once()->andReturn($usersPaginated);

    $userService = new App\Services\UserService($userRepoMock);
    $result = $userService->getAllUsers();

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class);
});

it('can create a new user', function () {
    $userDetails = ['name' => 'John Doe', 'email' => 'john@example.com'];
    $user = new User($userDetails);

    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $userRepoMock->shouldReceive('createUser')->once()->with($userDetails)->andReturn($user);

    $userService = new App\Services\UserService($userRepoMock);
    $result = $userService->createUser($userDetails);

    expect($result)->toBeInstanceOf(User::class);
    expect($result->name)->toEqual('John Doe');
});

it('can find a user by ID', function () {
    $userDetails = ['name' => 'John Doe', 'email' => 'john@example.com'];
    $user = new User($userDetails);

    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $userRepoMock->shouldReceive('getUserById')->once()->with($user->id, [], null)->andReturn($user);

    $userService = new App\Services\UserService($userRepoMock);
    $result = $userService->getUserById($user->id);

    expect($result)->toBeInstanceOf(User::class);
    expect($result->id)->toEqual($user->id);
});

it('can update a user', function () {
    $user = Mockery::mock(User::class);
    $newDetails = ['name' => 'Jane Doe Updated'];

    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $userRepoMock->shouldReceive('updateUser')
        ->once()
        ->with($user, $newDetails)
        ->andReturn(true);

    $userService = new App\Services\UserService($userRepoMock);
    $result = $userService->updateUser($user, $newDetails);

    expect($result)->toBeTrue();
});

it('can delete a user', function () {
    $user = Mockery::mock(User::class);

    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $userRepoMock->shouldReceive('deleteUser')
        ->once()
        ->with($user)
        ->andReturn(true);

    $userService = new App\Services\UserService($userRepoMock);
    $result = $userService->deleteUser($user);

    expect($result)->toBeTrue();
});

it('can restore a deleted user', function () {
    $user = Mockery::mock(User::class);

    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $userRepoMock->shouldReceive('restore')
        ->once()
        ->with($user)
        ->andReturn(true);

    $userService = new App\Services\UserService($userRepoMock);
    $result = $userService->restore($user);

    expect($result)->toBeTrue();
});

it('can permanently delete a user', function () {
    $user = Mockery::mock(User::class);

    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $userRepoMock->shouldReceive('forceDelete')
        ->once()
        ->with($user)
        ->andReturn(true);

    $userService = new App\Services\UserService($userRepoMock);
    $result = $userService->forceDelete($user);

    expect($result)->toBeTrue();
});

it('can restore all deleted users', function () {
    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $userRepoMock->shouldReceive('restoreAll')
        ->once()
        ->andReturn(true);

    $userService = new App\Services\UserService($userRepoMock);
    $result = $userService->restoreAll();

    expect($result)->toBeTrue();
});

it('can retrieve all deleted users', function () {
    $paginatedDeletedUsers = new LengthAwarePaginator([], 0, 10);

    $userRepoMock = Mockery::mock(UserRepositoryInterface::class);
    $userRepoMock->shouldReceive('trash')
        ->once()
        ->andReturn($paginatedDeletedUsers);

    $userService = new App\Services\UserService($userRepoMock);
    $result = $userService->trash();

    expect($result)->toBeInstanceOf(LengthAwarePaginator::class);
});
