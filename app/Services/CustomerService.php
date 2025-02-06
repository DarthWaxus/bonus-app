<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function createCustomer(string $phone): Customer
    {
        return Customer::create(['phone' => $phone]);
    }
}
