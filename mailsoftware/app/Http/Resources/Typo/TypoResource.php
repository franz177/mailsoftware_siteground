<?php

namespace App\Http\Resources\Typo;

use Illuminate\Http\Resources\Json\JsonResource;

class TypoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'tx_mask_p_old_uid' => $this->tx_mask_p_old_uid,
            'uid' => $this->uid,
            'header' => $this->header,
        ];
    }
}
