<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkSpace extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'owner_id'
    ];

 
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class,'workspace_id');
    }

    public function setOwnerIdAttribute($value)
    {

         $this->attributes['owner_id'] =  auth()->user()->id;

    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }
   

    public function members() {
        return $this->belongsToMany(User::class, 'user_work_space');
    }

}
