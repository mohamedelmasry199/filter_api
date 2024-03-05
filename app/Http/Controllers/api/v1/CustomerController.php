<?php

namespace App\Http\Controllers\Api\v1;
use App\Models\Customer;
use App\Http\Requests\v1\StoreCustomerRequest;
use App\Http\Requests\v1\UpdateCustomerRequest;
use App\Http\Controllers\controller;
use App\filters\ApiFilters;
use App\Http\Resources\v1\CustomerCollection;
use App\Http\Resources\v1\CustomerResource;
use App\filters\v1\CustomerFilter;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, CustomerFilter $filter)
    {
        $filter =new CustomerFilter();
        $filterItems =$filter->transform($request);
        $includeInvoices=$request->query('includeInvoices');
        // if(count($filterItems)==0){
        //     return new CustomerCollection(Customer::paginate());
        // }
        // else{
            $customers= Customer::where($filterItems);
            if($includeInvoices){
               $customers = $customers->with('invoices');
            }
            return new CustomerCollection($customers->paginate()->appends($request->query())); //to make query done in the links also  to become "links": {
                // "first": "http://127.0.0.1:8000/api/v1/customers?type%5Beq%5D=i&page=1",
                // "last": "http://127.0.0.1:8000/api/v1/customers?type%5Beq%5D=i&page=6",
                // "prev": null,
                // "next": "http://127.0.0.1:8000/api/v1/customers?type%5Beq%5D=i&page=2"
                // },
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $includeInvoices=request()->query('includeInvoices');
        if($includeInvoices){
            return new CustomerResource($customer->loadMissing('invoices'));  //loadMissing('invoices'): The loadMissing method is used in Laravel to eager load relationships. In this case, it's eager loading the 'invoices' relationship for the $customer model. This can help to optimize database queries by loading related data along with the main model.
        }
        return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
