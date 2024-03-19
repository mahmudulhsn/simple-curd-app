<?php

namespace App\Services;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    protected $userRepository;

    /**
     * UserService constructor.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Return all the user
     */
    public function getAllUsers(?array $relationNames = []): LengthAwarePaginator
    {
        return $this->userRepository->getAllUsers($relationNames);
    }

    /**
     * Create new user and return the user object
     */
    public function createUser(array $userDetails): User
    {
        return $this->userRepository->createUser($userDetails);
    }

    /**
     * Find user by ID and return the user object
     */
    public function getUserById(string $userID, ?array $relationNames = [], ?string $withTrashed = null): User
    {
        return $this->userRepository->getUserById($userID, $relationNames, $withTrashed);
    }

    /**
     * Update user
     */
    public function updateUser(object $user, array $newDetails): bool
    {
        return $this->userRepository->updateUser($user, $newDetails);
    }

    /**
     * Delete a single user
     */
    public function deleteUser(object $user): bool
    {
        return $this->userRepository->deleteUser($user);
    }

    /**
     * Restore a user
     */
    public function restore(object $user): bool
    {
        return $this->userRepository->restore($user);
    }

    /**
     * Force delete a user
     */
    public function forceDelete(object $user): bool
    {
        return $this->userRepository->forceDelete($user);
    }

    /**
     * Restore all deleted users
     */
    public function restoreAll(): bool
    {
        return $this->userRepository->restoreAll();
    }

    /**
     * Return all deleted users
     */
    public function trash(): LengthAwarePaginator
    {
        return $this->userRepository->trash();
    }
}
