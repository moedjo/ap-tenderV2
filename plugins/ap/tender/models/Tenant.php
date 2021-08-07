<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class Tenant extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'ap_tender_tenants';

    /**
     * @var array Validation rules
     */
    public $rules = [];

    public $belongsTo = [
        'business_entity' => 'Ap\Tender\Models\BusinessEntity',
        'contact_position' => 'Ap\Tender\Models\Position',
        'pic_position' => 'Ap\Tender\Models\Position',
        'region' => [
            'Ap\Tender\Models\Region',
            'key' => 'region_id',
            'conditions' => "type = 'regency'"
        ],
        'verification_office' => 'Ap\Tender\Models\Office',
        'user' => ['Ap\Tender\Models\User', 'key' => 'user_id'],
    ];

    public $hasMany = [
        'experiences' => [
            'Ap\Tender\Models\Experience',
            'key' => 'tenant_id'
        ],
        'finances' => [
            'Ap\Tender\Models\Finance',
            'key' => 'tenant_id'
        ]
    ];

    public $belongsToMany = [
        'summaries' => [
            'Ap\Tender\Models\Summary',
            'table' => 'ap_tender_tenants_summaries',
            'key'      => 'tenant_id',
            'otherKey' => 'summary_id'
        ],
        'business_fields' => [
            'Ap\Tender\Models\BusinessField',
            'table' => 'ap_tender_tenants_business_fields',
            'key'      => 'tenant_id',
            'otherKey' => 'business_field_id'
        ],
        'verifications' => [
            'Ap\Tender\Models\Verification',
            'table' => 'ap_tender_tenants_verifications',
            'key'      => 'tenant_id',
            'otherKey' => 'verification_id',
            'timestamps' => true,
            'pivot' => [
                'on_note',
                'on_check',
                'off_note',
                'off_check',
            ]
        ],
        'verification_legals' => [
            'Ap\Tender\Models\Verification',
            'table' => 'ap_tender_tenants_verifications',
            'key'      => 'tenant_id',
            'otherKey' => 'verification_id',
            'conditions' => "type = 'legal'",
            'timestamps' => true,
            'pivot' => [
                'on_note',
                'on_check',
                'off_note',
                'off_check',
            ]
        ],
        'verification_finances' => [
            'Ap\Tender\Models\Verification',
            'table' => 'ap_tender_tenants_verifications',
            'key'      => 'tenant_id',
            'otherKey' => 'verification_id',
            'conditions' => "type = 'finance'",
            'timestamps' => true,
            'pivot' => [
                'on_note',
                'on_check',
                'off_note',
                'off_check',
            ]
        ],
        'verification_commercials' => [
            'Ap\Tender\Models\Verification',
            'table' => 'ap_tender_tenants_verifications',
            'key'      => 'tenant_id',
            'otherKey' => 'verification_id',
            'conditions' => "type = 'commercial'",
            'timestamps' => true,
            'pivot' => [
                'on_note',
                'on_check',
                'off_note',
                'off_check',
            ]
        ],
        
    ];

    public $attachOne = [
        'doc_legal_cooperation' => ['System\Models\File', 'public' => false],  
        'doc_legal_npwp' => ['System\Models\File', 'public' => false],
        'doc_legal_ktp' => ['System\Models\File', 'public' => false],
        'doc_legal_sk' => ['System\Models\File', 'public' => false],
        'doc_legal_other' => ['System\Models\File', 'public' => false],
        'doc_legal_konsorsium' => ['System\Models\File', 'public' => false],
        'doc_legal_cv' => ['System\Models\File', 'public' => false],


        'doc_finance_sppkp' => ['System\Models\File', 'public' => false],
        'doc_finance_spt' => ['System\Models\File', 'public' => false],
        'doc_finance_blp' => ['System\Models\File', 'public' => false],
        'doc_finance_bsp' => ['System\Models\File', 'public' => false],
        'doc_finance_sklp' => ['System\Models\File', 'public' => false],
        'doc_finance_other' => ['System\Models\File', 'public' => false],
        'doc_finance_collaborate' => ['System\Models\File', 'public' => false],


    ];

    public $attachMany = [
        'doc_legal_akta' => ['System\Models\File', 'public' => false],
        'doc_legal_siup' => ['System\Models\File', 'public' => false],
        'doc_legal_tdp' => ['System\Models\File', 'public' => false],
        'doc_legal_domisili' => ['System\Models\File', 'public' => false],
    ];

    protected $jsonable = [
        'commissioners',
        'directors',
        'business_kbli'
    ]; 

}
