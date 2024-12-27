<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'name',
        'description'
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    public function cards(): HasMany
    {
        return $this->hasMany(Card::class,'group_id');
    }


}
