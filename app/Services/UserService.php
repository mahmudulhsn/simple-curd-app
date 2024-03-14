<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

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
    public function getAllUsers(?array $relationNames = []): Collection
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
    public function getUserById(int $userID, ?array $relationNames = []): User
    {
        return $this->userRepository->getUserById($userID, $relationNames);
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
}
