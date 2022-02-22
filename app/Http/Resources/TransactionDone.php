<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionDone extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'result'=>  ['amount'=>$this->amount,
            'description'=>$this->description,
            'destinationFirstname'=>$this->destinationFirstname,
            'destinationLastname'=>$this->destinationLastname,
            'destinationNumber'=>$this->destinationNumber,
            'inquiryDate'=>$this->inquiryDate,
            'inquirySequence'=>$this->inquirySequence,
            'inquiryTime'=>$this->inquiryTime,
            'paymentNumber'=>$this->paymentNumber,
            'refCode'=>$this->refCode,
            'sourceFirstname'=>$this->transaction->user->name,
            'sourceLastname'=>$this->transaction->user->lastname,
            'sourceNumber'=>$this->transaction->user->sourceNumber,
            'type'=>$this->transaction->type,
            'reasonDescription'=>$this->transaction->reasonDescription,
             ],
            'status'=>$this->transaction->status,
            'trackId'=>$this->transaction->trackId,
        ];
    }
}
