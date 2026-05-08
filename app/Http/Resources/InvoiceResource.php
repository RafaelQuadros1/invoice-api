<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    private array $types = ['C' =>'cartao', 'B' => 'boleto', 'P' => 'pix'];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'paid' => $this->is_paid ? 'pago' : 'pendiente',
            'type' => $this->types[$this->type] ?? 'Desconhecido',
            'PaymentDate' => $this->is_paid ? Carbon::parse($this->payment_date)->format('d-m-y h:i:s') : null,
            'PaymentSince' => $this->is_paid ? carbon::parse($this->payment_date)->diffForHumans() : null ,
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
