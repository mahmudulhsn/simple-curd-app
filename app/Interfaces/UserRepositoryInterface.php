<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    /**
     * Return all users
     *
     * @param  array  $relationship
     */
    public function getAllUsers(?array $relationNames = []): LengthAwarePaginator;

    /**
     * Create a new user
     */
    public function createUser(array $userDetails): User;

    /**
     * Find user user by id and return user
     */
    public function getUserById(string $userID, ?array $relationNames = [], ?string $withTrashed = null): User;

    /**
     * Update a a user
     */
    public function updateUser(object $user, array $newDetails): bool;

    /**
     * Temporary delete a user
     */
    public function deleteUser(object $user): bool;

    /**
     * Restore a user
     */
    public function restore(object $user): bool;

    /**
     * Force delete a user
     */
    public function forceDelete(object $user): bool;

    /**
     * Restore all deleted users
     */
    public function restoreAll(): bool;
    /**
     * Restore all deleted users
     */
    public function trash(): LengthAwarePaginator;
}
