<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Sector;
use App\Models\Region;
use App\Models\PermitType;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    
    // protected $primaryKey = 'ProfileID';
    
    protected $fillable = [
    		'user_id',
    		'CompanyName',
    		'CompanyRegistrationNo',
            'sector_id',
    		'BusinessType',
            'permit_type_id',
    		'PermitNo',
            'PermittedDate',
            'CommercializationDate',
            'LandNo',
            'LandSurveyDistrictNo',
            'IndustrialZone',
            'Township',
            'region_id',
            'StaffLocalProposal',
            'StaffForeignProposal',
            'StaffLocalSurplus',
            'StaffForeignSurplus',
            'StaffLocalAppointed',
            'StaffForeignAppointed',
            'AttachPermit',
            'AttachProposal',
            'AttachAppointed',
            'AttachIncreased',
            'Status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function permit_type()
    {
        return $this->belongsTo(PermitType::class);
    }
}
