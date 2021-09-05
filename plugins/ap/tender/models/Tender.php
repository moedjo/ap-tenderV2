<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class Tender extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'ap_tender_tenders';

    /**
     * @var array Validation rules
     */ 
    public $rules = [
        'name' => 'required',
        'business_field' => 'required',
        'airport' => 'required',
        'pic_full_name' => 'required',
        'pic_email' => 'required|email',
        'package' => 'required',
        'rooms' => 'required',
        'description' => 'required',
        // 'registration_start' => 'required|date',
        // 'registration_end' => 'required|date|after:registration_start',

        // 'rfq_start' => 'required|date',
        // 'rfq_end' => 'required|date|after:rfq_start',

        // 'aanwijzing_start' => 'required|date',
        // 'aanwijzing_end' => 'required|date|after:aanwijzing_start',

        // 'rfp_start' => 'required|date',
        // 'rfp_end' => 'required|date|after:rfp_start',

        // 'sampul1_start' => 'required|date',
        // 'sampul1_end' => 'required|date|after:sampul1_start',

        // 'sampul2_start' => 'required|date',
        // 'sampul2_end' => 'required|date|after:sampul2_start',

        // 'negotiation_start' => 'required|date',
        // 'negotiation_end' => 'required|date|after:negotiation_start',

        // 'winner_start' => 'required|date',
        // 'winner_end' => 'required|date|after:winner_start',
        

        'doc_support' => 'required',
        'pic_flyer' => 'required',
        'doc_rfq'=> 'required',
        'doc_rfp'=> 'required',

    ];

    public $belongsTo = [
        'business_field' => [
            'Ap\Tender\Models\BusinessField',
            'key' => 'business_field_id',
        ],

        'airport' => [
            'Ap\Tender\Models\Airport',
            'key' => 'airport_id',
        ],
    ];

    public $hasMany = [
        'schedules' => [
            'Ap\Tender\Models\Schedule',
            'key' => 'tender_id'
        ],
    ];

    public $belongsToMany = [
        'tenants' => [
            'Ap\Tender\Models\Tenant',
            'table' => 'ap_tender_tenders_tenants',
            'key'      => 'tender_id',
            'otherKey' => 'tenant_id',
        ],

    ];

    public $attachOne = [
        'doc_rfq' => ['System\Models\File', 'public' => false],
        'doc_rfp' => ['System\Models\File', 'public' => false],

    ];

    public $attachMany = [
        'doc_support' => ['System\Models\File', 'public' => false],
        'pic_flyer' => ['System\Models\File', 'public' => false],
    ];

    protected $jsonable = [
        'rooms',
    ];

    
    public function beforeValidate()
    {
        // if ($this->status == 'publish_document') {
        //     $this->rules['doc_rfq'] = "required";
        //     $this->rules['doc_rfp'] = "required";
        // } 
    }
}
