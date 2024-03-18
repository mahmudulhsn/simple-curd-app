<?php

namespace App\Interfaces;

use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;

interface AddressRepositoryInterface
{
    /**
     * Return all Addresses
     *
     * @param  array  $relationship
     */
    public function getAllAddresses(?array $relationNames = []): Collection;

    /**
     * Create a new Address
     */
    public function createAddress(array $addressDetails): Address;

    /**
     * Find Address Address by id and return Address
     */
    public function getAddressById(int $addressID, ?array $relationNames = []): Address;

    /**
     * Update a a Address
     */
    public function updateAddress(object $address, array $newDetails): bool;

    /**
     * Delete a Address
     */
    public function deleteAddress(object $address): bool;

    /**
     * Get address by user id
     */
    public function getAddressesByUser(string $userID): Collection;
}
