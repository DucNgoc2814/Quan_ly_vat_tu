<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Exception;

class CustomerController extends Controller
{

    const PATH_VIEW = 'admin.components.customer.';

    public function index()
    {
        $customers = Customer::with('customerRank')->get();
        return view(self::PATH_VIEW . 'index', compact('customers'));
    }
}
