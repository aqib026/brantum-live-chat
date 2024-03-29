<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use PDO;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $file = false;
        if ($this->message['image'] != null) {
            $file = true;
        }
        return [
            'message' => $this->message['content'],
            'image' => $this->message['image'],
            'id' => $this->id,
            'type' => $this->type,
            'isfile' => $file,
            'read_at' => $this->read_at_timing($this),
            'send_at' => $this->created_at->diffForHumans()
        ];
    }
    private function read_at_timing($_this)
    {
        $read_at = $_this->type == 0 ? $_this->read_at : null;
        return $read_at ? $read_at->diffForHumans() : null;
    }
}
