<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invitation extends Model {
    use HasFactory,Notifiable;

    protected $fillable = [
        'email', 'workspace_id', 'invited_by', 'token'
    ];

    public function workspace() {
        return $this->belongsTo(Workspace::class,'workspace_id');
    }

    public function inviter() {
        return $this->belongsTo(User::class, 'invited_by');
    }
}
