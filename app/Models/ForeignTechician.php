<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignTechician extends Model
{
    use HasFactory;

    protected $table = 'foreign_techicians';

    protected $fillable = [
        'Image',
        'Name',
        'Rank',
        'Gender',
        'DateOfBirth',
        'PassportNo',
        'Status',
        'profile_id',
        
    ];
}
