<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Session;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'profile_pic' => $this->founderProfilePic($this->profile_pic),
            'online' => false,
            'session' =>$this->session_details($this->id)
        ];
    }
    private function founderProfilePic($profile_pic,$cssClass=null){
        if($profile_pic != ''){
           return '<img src="/uploads/'.$profile_pic.'" class="rounded-circle user_img" />';
        }else{
            return '<img src="../../../assets/images/user-img-2.jpg" class="img-thumbnail" />';
        }
    }
    private function session_details($id){
        $session = Session::whereIn('user1_id',[auth()->id(),$id])
                            ->whereIn('user2_id',[auth()->id(),$id])
                            ->first();
        return new SessionResource($session);                    
    }
}
