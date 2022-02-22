<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionFailed extends JsonResource
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
            'status'=>$this->transactions->status,
            'trackId'=>$this->transactions->trackId,
            'error'=>['code'=>$this->code,
            'message'=>$this->message]
        ];
    }
}
