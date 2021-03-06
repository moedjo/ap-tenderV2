<?php

namespace Ap\Tender\Models;

use Backend\Facades\BackendAuth;
use Model;

/**
 * Model
 */
class Experience extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Revisionable;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'ap_tender_tenant_experiences';


    // protected $purgeable = ['is_region_text'];

    public $dates = [

        'cooperation_period_start',
        'cooperation_period_end',

        'operational_hour_start',
        'operational_hour_end'
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'business_field' => 'required',
        // 'region' => 'required',
        'region_area' => 'required|numeric',
        'total_income' => 'required|numeric',
        'cooperation_period_start' => 'required|date',
        'cooperation_period_end' => 'required|date|after:cooperation_period_start',
        'operational_hour_start' => 'required|date',
        'operational_hour_end' => 'required|date|after:operational_hour_start',
        'doc_experience' => 'required',
    ];

    public $belongsTo = [
        'tenant' => [
            'Ap\Tender\Models\Tenant',
            'key' => 'tenant_id'
        ],
        'business_field' => [
            'Ap\Tender\Models\BusinessField',
            'table' => 'ap_tender_business_fields',
            'key'      => 'business_field_id',
        ],
        'region' => [
            'Ap\Tender\Models\Region',
            'key' => 'region_id',
            'conditions' => "type = 'regency'"
        ],
    ];

    public $attachOne = [
        'doc_experience' => ['System\Models\File', 'public' => false]
    ];

    public $morphMany = [ 
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];

    protected $revisionable = [
        'name', 'operational_hour_start', 'operational_hour_end', 'cooperation_period_start', 'cooperation_period_end', 'total_income', 'region_id',
        'region_area', 'is_region_text', 'region_text', 'tenant_id', 'business_field_id'
    ];

    public $revisionableLimit = 500;
    public function getRevisionableUser()
    {
        return BackendAuth::getUser();
    }

    public function beforeValidate()
    {
        if ($this->is_region_text) {
            $this->rules['region_text'] = "required";
        } else {
            $this->rules['region'] = "required";
        }
    }

    public function getOperationalHourAttribute()
    {

        if (isset($this->operational_hour_start) && isset($this->operational_hour_end)) {
            return $this->operational_hour_start->format('H:i') . ' - ' . $this->operational_hour_end->format('H:i');
        }
        return null;
    }

    public function getCooperationPeriodAttribute()
    {

        if (isset($this->cooperation_period_start) && isset($this->cooperation_period_end)) {
            return $this->cooperation_period_start->format('d M Y') . ' - ' . $this->cooperation_period_end->format('d M Y');
        }
        return null;
    }

    public function getDisplayRegionAttribute()
    {

        if ($this->is_region_text) {
            return $this->region_text;
        }
        return $this->region->display_name;
    }
}
