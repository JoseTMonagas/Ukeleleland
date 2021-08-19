<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Retorna la lista de Compras realizadas por ese Usuario
     *
     * @return \App\Sale
     */
    public function sales()
    {
        return $this->belongsToMany('\App\Sale');
    }

    /**
     * Retorna el Perfil de ese Usuario
     *
     * @return \App\Profile
     */
    public function profile()
    {
        return $this->hasOne('\App\Profile');
    }

    public function tutorias()
    {
        return $this->belongsToMany('\App\Tutoria')->withTimestamps();
    }

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('\App\Message');
    }

    /**
     * Retorna los Chats de ese Usuario
     *
     * @return \App\Conversation
     */
    public function conversations()
    {
        return $this->belongsToMany('\App\Conversation')->withTimestamps();
    }

    /**
     * Agrega el usuario a la conversacion
     *
     * @return \App\Conversation $conversation
     */
    public function addConversation($conversation)
    {
        return $this->conversations()->attach($conversation);
    }

    /**
     * Verifica si el Usuario tiene acceso a esa Conversacion
     *
     * @return bool
     */
    public function hasJoined($conversationId)
    {
        $room = $this->conversations->where('id', $conversationId)->first();

        return $room ? true : false;
    }

    public function hasConversationsWith(\App\User $user)
    {
        $found = $this->conversations()->whereHas('users', function($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->get();
        if($found->count() > 0){
            return $found->first();
        } else {
            return false;
        }
    }

}
