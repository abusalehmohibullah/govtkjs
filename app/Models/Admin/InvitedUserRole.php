<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitedUserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'role_id',
    ];

    public $timestamps = false;

}
