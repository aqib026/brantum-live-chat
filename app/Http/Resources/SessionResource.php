<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
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
            'id'=>$this->id,
            'open'=>false,
            'user' => [$this->user1_id,$this->user2_id],
            'unreadCount' => $this->chats->where('read_at', null)->where('type', 0)->where('user_id', '!=', auth()->id())->count(),
            'block' => !!$this->block,
            'blocked_by' => $this->blocked_by
        ];
    }
}
