<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'workspace_id',
        'name',
        'description',
        'start_date',
        'end_date'
    ];
    public function workSpace()
    {
        return $this->belongsTo(WorkSpace::class,'workspace_id');
    }
    public function groups():HasMany
    {
        return $this->hasMany(Group::class,'project_id');
    }

    public function setWorkSpaceIdAttribute($value)
    {

         $this->attributes['workspace_id'] =  Filament::getTenant()->id;

    }


}
