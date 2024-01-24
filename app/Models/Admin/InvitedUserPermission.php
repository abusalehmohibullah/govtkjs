<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitedUserPermission extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'invitation_id',
        'permission_id',
    ];
    
    public $timestamps = false;


}
