<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


//postalCodeبيخليني اتحكم في الاسم بتاع الحاجه اغيره عن الي في الداتا بيز او امنعه من انه يتعرض و اعرضه بشكل مختلف زي مثلا
class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ['id' => $this->id ,
        'name'=>$this->name,
        'type'=>$this->type,
        'email'=>$this->email,
        'address'=>$this->address,
        'city'=>$this->city,
        'state'=>$this->state,
        'postalCode'=>$this->postal_code,
        'invoices'=>InvoiceResource::collection($this->whenLoaded('invoices')), //3shan include invoices
    ];}
}
