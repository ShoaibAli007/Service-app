<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'sender_id', 'reciever_id','subject','body'
    ];

    public function Sender()
    {
        return $this->belongsTo(User::class,'sender_id');
    }


    public function Reciever()
    {
        return $this->belongsTo(User::class,'reciever_id');
    }
}
