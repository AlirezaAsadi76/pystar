<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Transaction;
use App\Models\User;
class TransactionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($item){
                if($item->status=='FAILED')
                   {
                       return new TransactionFailed($item->statusable);
                }
                else
                {
                    return new TransactionDone($item->statusable);
                }

            }),

        ];
    }
}

