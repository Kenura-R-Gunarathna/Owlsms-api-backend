<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionsHasUsersHasRoles extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'institution_id', 'role_id', 'details'];

    protected $hidden = ['role_id', 'user_id'];
}
