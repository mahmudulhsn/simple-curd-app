<?php

namespace App\Services;

use App\Interfaces\AddressRepositoryInterface;
use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;

class AddressService
{
    /**
     * AddressService constructor.
     */
    public function __construct(protected AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * Return all the Address
     */
    public function getAllAddresses(?array $relationNames = []): Collection
    {
        return $this->addressRepository->getAllAddresses($relationNames);
    }

    /**
     * Create new Address and return the Address object
     */
    public function createAddress(array $addressDetails): Address
    {
        return $this->addressRepository->createAddress($addressDetails);
    }

    /**
     * Find Address by ID and return the Address object
     */
    public function getAddressById(int $addressID, ?array $relationNames = []): Address
    {
        return $this->addressRepository->getAddressById($addressID, $relationNames);
    }

    /**
     * Update Address
     */
    public function updateAddress(object $address, array $newDetails): bool
    {
        return $this->addressRepository->updateAddress($address, $newDetails);
    }

    /**
     * Delete a single Address
     */
    public function deleteAddress(object $address): bool
    {
        return $this->addressRepository->deleteAddress($address);
    }

    /**
     * Get address by user id
     */
    public function getAddressesByUser(string $userID): Collection
    {
        return $this->addressRepository->getAddressesByUser($userID);
    }
}
