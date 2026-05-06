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
            'user' => new UserResource($this->whenLoaded('user')),
            'amount' => $this->amount,
            'paid' => $this->is_paid ? 'pago' : 'pendiente',
            'type' => $this->types[$this->type] ?? 'Desconhecido',
            'payment_date' => $this->is_paid ? Carbon::parse('payment_date')->format('d/m/y h:i:s'): null,

        ];
    }
}
