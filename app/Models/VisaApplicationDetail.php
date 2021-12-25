<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nationality;
use App\Models\PersonType;
use App\Models\VisaType;
use App\Models\StayType;
use App\Models\LabourCardType;
use App\Models\LabourCardDuration; //htet
use App\Models\RelationShip;
use App\Models\VisaApplicationDetailAttachment;

class VisaApplicationDetail extends Model
{
    use HasFactory;

    protected $table = 'visa_application_details';
    
    // protected $primaryKey = 'VisaApplicationDetailID';
    
    protected $fillable = [
    		'visa_application_head_id',
    		'nationality_id',
    		'PersonName',
            'PassportNo',
            'StayAllowDate',
            'StayExpireDate',
            'person_type_id',
            'DateOfBirth',
            'Gender',
            'visa_type_id',
            'stay_type_id',
            'labour_card_type_id',
            'labour_card_duration_id',
            'relation_ship_id',
            'Remark',
    ];

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function person_type()
    {
        return $this->belongsTo(PersonType::class);
    }

    public function visa_type()
    {
        return $this->belongsTo(VisaType::class);
    }

    public function stay_type()
    {
        return $this->belongsTo(StayType::class);
    }

    public function labour_card_type()
    {
        return $this->belongsTo(LabourCardType::class);
    }

    // htet
    public function labour_card_duration()
    {
        return $this->belongsTo(LabourCardDuration::class);
    }

    public function relation_ship()
    {
        return $this->belongsTo(RelationShip::class);
    }

    public function visa_detail_attachments()
    {
        return $this->hasMany(VisaApplicationDetailAttachment::class);
    }
}
