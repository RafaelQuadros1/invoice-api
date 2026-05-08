<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(Invoice $invoice)
    {
        return InvoiceResource::collection($invoice->all()->load('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request)
    {
        try {
            $invoice = Invoice::create($request->validated());

            return $this->success(
                'Invoice created success',
                new InvoiceResource($invoice->load('user')),
                201
            );
        } catch (\Exception $e) {
            return $this->errors(
                'Invoice created failed',
                ['error' => $e->getMessage()],
                500
            );
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new InvoiceResource(Invoice::findOrFail($id)->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
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
