<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * Return all users
     *
     * @param  array  $relationship
     */
    public function getAllUsers(?array $relationNames = []): Collection;

    /**
     * Create a new user
     */
    public function createUser(array $userDetails): User;

    /**
     * Find user user by id and return user
     */
    public function getUserById(int $userID, ?array $relationNames = []): User;

    /**
     * Update a a user
     */
    public function updateUser(object $user, array $newDetails): bool;

    /**
     * Delete a user
     */
    public function deleteUser(object $user): bool;
}
