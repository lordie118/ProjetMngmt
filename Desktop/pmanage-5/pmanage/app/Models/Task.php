<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'card_id',
        'name',
        'done',
        'description'
    ];
    protected $casts = ['done' => 'boolean'];
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

}
