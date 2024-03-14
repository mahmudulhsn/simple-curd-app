<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    /**
     * UserRepository constructor.
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Return all the user
     */
    public function getAllUsers(?array $relationNames = []): Collection
    {
        return $this->model
            ->when(!empty($relationNames), function ($query) use ($relationNames) {
                return $query->with($relationNames);
            })
            ->oldest('name')
            ->get();
    }

    /**
     * Create new user and return the user object
     */
    public function createUser(array $userDetails): User
    {
        return $this->model->create($userDetails);
    }

    /**
     * Find user by ID and return the user object
     */
    public function getUserById(int $userID, ?array $relationNames = []): User
    {
        return $this->model->when(!empty($relationNames), function ($query) use ($relationNames) {
            return $query->with($relationNames);
        })->where('id', $userID)->latest()->first();
    }

    /**
     * Update user
     */
    public function updateUser(object $user, array $newDetails): bool
    {
        return $user->update($newDetails);
    }

    /**
     * Delete a single user
     */
    public function deleteUser(object $user): bool
    {
        return $user->delete();
    }
}
