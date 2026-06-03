<?php

namespace App\Http\Controllers\api\v1;

use App\Filters\Filter;
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
    public function index(Request $request)
    {
        $query = Invoice::query()->with('user');
        $invoices = (new Filter())->filter($query, $request)->paginate();

        return InvoiceResource::collection($invoices);
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
    public function show(Invoice $invoice)
    {
        return new InvoiceResource(Invoice::findOrFail($invoice->id)->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        try {
            $invoice->update($request->all());

            if ($invoice) {
                return $this->success(
                    'Invoice updated success',
                    new InvoiceResource($invoice->load('user')),
                    200
                );
            }

        } catch (\Exception $e) {
            return $this->errors(
                'Invoice updated failed',
                ['error' => $e->getMessage()],
                404
            );
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Invoice $invoice)
    {
        try {
            $invoice = Invoice::findOrFail($invoice->id);
            $invoice->delete();
            return $this->success(
                'Invoice deleted success',
                null,
                200
            );

        } catch (\Exception) {
            return $this->errors(
                'Invoice deleted failed',
                ['error' => 'Invoice not found'],
                404
            );
        }
    }
}
