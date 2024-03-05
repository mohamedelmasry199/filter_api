<?php

namespace App\Http\Controllers\api\v1;
use App\filters\v1\InvoiceFilter;
use App\Http\Resources\v1\InvoiceCollection;
use App\Http\Resources\v1\InvoiceResource;
use App\Models\Invoice;
use App\Http\Requests\v1\StoreInvoiceRequest;
use App\Http\Requests\v1\BulkStoreInvoiceRequest;
use App\Http\Requests\v1\UpdateInvoiceRequest;
use App\Http\Controllers\controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,InvoiceFilter $filter)
    {
        $filter = new InvoiceFilter;
        $queryItem= $filter->transform($request);
        if(count($queryItem)==0){
            return new InvoiceCollection(Invoice::paginate());
        }
        else{
            $invoices= Invoice::where($queryItem)->paginate();
            return new InvoiceCollection($invoices->appends($request->query()));
        }

    }
    public function bulkStore(BulkStoreInvoiceRequest $request)
    {
        $bulk = collect($request->data)->map(function ($arr) {
            return Arr::except($arr, ['customerId', 'billedDate', 'paidDate']);
        });

        Invoice::insert($bulk->toArray());
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
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
