<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'group_id',
        'name',
        'description'
    ];
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class,'card_id');
    }

}
