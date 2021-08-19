<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'conversation_id',
        'user_id'
    ];
    protected $appends =['name'];
    /**
     * Conversacion asociada a ese Mensaje
     *
     * @return \App\Conversation
     */
    public function conversation()
    {
        return $this->belongsTo('\App\Conversation');
    }
    
    /**
     * A message belong to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retorna el nombre del usuario que envio el mensaje
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->user->name;
    }
    
}
