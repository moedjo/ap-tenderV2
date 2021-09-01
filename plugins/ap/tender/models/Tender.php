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
        'registration_start' => 'required|date',
        'registration_end' => 'required|date|after:registration_start',

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
        
    ];

    public $belongsToMany = [
        'tenants' => [
            'Ap\Tender\Models\Tenant',
            'table' => 'ap_tender_tenders_tenants',
            'key'      => 'tender_id',
            'otherKey' => 'tenant_id',
            // 'conditions' => "status = 'short_listed'",
        ],

    ];

    public $attachOne = [
       

    ];

    public $attachMany = [
        'doc_tender' => ['System\Models\File', 'public' => false],
        'pic_flyer' => ['System\Models\File', 'public' => false],
    ];

    protected $jsonable = [
        'rooms',
    ];
}
