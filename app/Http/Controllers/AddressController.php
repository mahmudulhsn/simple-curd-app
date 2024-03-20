<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class AddressController extends Controller
{
    /**
     * UserController constructor
     */
    public function __construct(protected AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $address = $this->addressService->getAddressById($id);
        if ($address instanceof Address) {
            $this->addressService->deleteAddress($address);

            return redirect()->back()->with('success', 'Address deleted successfully');
        }

        return redirect()->back()->with('error', 'Something went wrong!');
    }

    public function getAddressesByUser(string $userID): JsonResponse
    {
        return response()->json([
            'addresses' => $this->addressService->getAddressesByUser($userID),
        ]);
    }
}
