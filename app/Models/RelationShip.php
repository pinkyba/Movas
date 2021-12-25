<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationShip extends Model
{
    use HasFactory;

    protected $table = 'relation_ships';
    
    // protected $primaryKey = 'RelationShipID';
    
    protected $fillable = [
    		'RelationShipName',
    		'RelationShipNameMM',
    ];
}
