<?php

namespace App\Repositories;

use App\Interfaces\AddressRepositoryInterface;
use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;

class AddressRepository implements AddressRepositoryInterface
{
    protected $model;

    /**
     * AddressRepository constructor.
     */
    public function __construct(Address $model)
    {
        $this->model = $model;
    }

    /**
     * Return all the Address
     */
    public function getAllAddresses(?array $relationNames = []): Collection
    {
        return $this->model
            ->when(! empty($relationNames), function ($query) use ($relationNames) {
                return $query->with($relationNames);
            })
            ->get();
    }

    /**
     * Create new Address and return the Address object
     */
    public function createAddress(array $addressDetails): Address
    {
        return $this->model->create($addressDetails);
    }

    /**
     * Find Address by ID and return the Address object
     */
    public function getAddressById(int $addressID, ?array $relationNames = []): Address
    {
        return $this->model->when(! empty($relationNames), function ($query) use ($relationNames) {
            return $query->with($relationNames);
        })->where('id', $addressID)->latest()->first();
    }

    /**
     * Update Address
     */
    public function updateAddress(object $address, array $newDetails): bool
    {
        return $address->update($newDetails);
    }

    /**
     * Delete a Address
     */
    public function deleteAddress(object $address): bool
    {
        return $address->delete();
    }

    /**
     * Get address by user id
     */
    public function getAddressesByUser(string $userID): Collection
    {
        return $this->model->where('user_id', $userID)->get();
    }
}
