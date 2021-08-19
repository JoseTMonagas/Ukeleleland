<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [''];
    /**
     * Retorna Usuarios de esa Conversacion
     *
     * @return \App\User
     */
    public function users()
    {
        return $this->belongsToMany('\App\User')->withTimestamps();
    }

    /**
     * Retorna los mensajes de esa Conversacion
     *
     * @return \App\Message
     */
    public function messages()
    {
        return $this->hasMany('\App\Message');
    }

    /**
     * Join a chat room
     * 
     * @param \App\User $user
     */
    public function join($user)
    {
        return $this->users()->attach($user);
    }   

    /**
     * Leave a chat room
     * 
     * @param \App\User $user
     */
    public function leave($user)
    {
        return $this->users()->detach($user);
    }

    /**
     * Retorna el otro usuario de esa conversacion
     *
     * @return \App\User $user
     */
    public function getOther($user)
    {
        return $this->users()->where('user_id', '!=', $user->id)->first();
    }
}
