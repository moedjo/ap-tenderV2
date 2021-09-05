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
