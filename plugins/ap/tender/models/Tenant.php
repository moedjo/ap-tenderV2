<?php

namespace Ap\Tender\Models;

use Backend\Facades\BackendAuth;
use Model;

/**
 * Model
 */
class Tenant extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Revisionable;



    /**
     * @var string The database table used by the model.
     */
    public $table = 'ap_tender_tenants';

    /**
     * @var array Validation rules
     */
    public $rules = [];

    public $belongsTo = [
        'business_entity' =>  [
            'Ap\Tender\Models\BusinessEntity',
            'key' => 'business_entity_id',
        ],
        'contact_position' => [
            'Ap\Tender\Models\Position',
            'key' => 'contact_position_id'
        ],
        'pic_position' => [
            'Ap\Tender\Models\Position',
            'key' => 'pic_position_id'
        ],
        'region' => [
            'Ap\Tender\Models\Region',
            'key' => 'region_id',
            'conditions' => "type = 'regency'"
        ],
        'verification_office' => [
            'Ap\Tender\Models\Office',
            'key' => 'verification_office_id'
        ],
        'user' => [
            'Ap\Tender\Models\User',
            'key' => 'user_id'
        ],
    ];

    public $hasMany = [
        'experiences' => [
            'Ap\Tender\Models\Experience',
            'key' => 'tenant_id'
        ],
        'finances' => [
            'Ap\Tender\Models\Finance',
            'key' => 'tenant_id'
        ],
        'tender_tenants' => [
            'Ap\Tender\Models\TenderTenant',
            'table' => 'ap_tender_tenders_tenants',
            'key'      => 'tender_id',
        ],
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

        'updates' => [
            'Ap\Tender\Models\Update',
            'table' => 'ap_tender_tenants_updates',
            'key'      => 'tenant_id',
            'otherKey' => 'update_id'
        ],

    ];

    public $attachOne = [
        'doc_legal_cooperation' => ['System\Models\File', 'public' => false],
        'doc_legal_npwp' => ['System\Models\File', 'public' => false],
        'doc_legal_ktp' => ['System\Models\File', 'public' => false],
        'doc_legal_sk' => ['System\Models\File', 'public' => false],
        'doc_legal_konsorsium' => ['System\Models\File', 'public' => false],
        'doc_legal_cv' => ['System\Models\File', 'public' => false],


        'doc_finance_sppkp' => ['System\Models\File', 'public' => false],
        'doc_finance_spt' => ['System\Models\File', 'public' => false],
        'doc_finance_blp' => ['System\Models\File', 'public' => false],

        'doc_finance_sklp' => ['System\Models\File', 'public' => false],
        'doc_finance_collaborate' => ['System\Models\File', 'public' => false],


        'doc_finance_fiskal' => ['System\Models\File', 'public' => false],
        'doc_finance_registered' => ['System\Models\File', 'public' => false],
    ];

    public $attachMany = [
        'doc_legal_akta' => ['System\Models\File', 'public' => false],
        'doc_legal_nib' => ['System\Models\File', 'public' => false],
        'doc_legal_other' => ['System\Models\File', 'public' => false],
        'doc_finance_other' => ['System\Models\File', 'public' => false],
        'doc_finance_spt_monthly' => ['System\Models\File', 'public' => false],
    ];

    protected $jsonable = [
        'commissioners',
        'directors',
        'business_kbli',
        'konsorsium_companies',
    ];

    public $morphMany = [ 
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];

    protected $revisionable = [
        'name', 'npwp', 'address', 'postal_code', 'phone_number', 'fax_number', 'email',
        'website', 'collaborate', 'has_experience', 'is_age_comply', 'contact_full_name',
        'contact_phone_number','contact_email','contact_position_id','pic_full_name','pic_phone_number','pic_email','pic_ktp',
        'pic_position_id','business_kbli','business_activity','commissioners','directors','konsorsium','konsorsium_role','konsorsium_total',
        'konsorsium_name','konsorsium_function','konsorsium_companies','status','token','token_url','on_legal_status','on_finance_status',
        'on_commercial_status','off_legal_status','off_finance_status','off_commercial_status','invite_name','invite_description','invite_location',
        'invite_pic_phone_number','invite_date','invite_hour_start','invite_hour_end','business_entity_id','verification_office_id','region_id','user_id'
    ];

    public $revisionableLimit = 1000;
    public function getRevisionableUser()
    {
        return BackendAuth::getUser();
    }


    public function scopeTenantActive($query, $tender)
    {
        $business_field = $tender->business_field;
        return $query
            ->where('status', 'short_listed')
            ->whereHas('business_fields', function ($query) use ($business_field) {
                $query->where('id', $business_field->id);
            });
    }

    public function getDisplayBusinessFieldsAttribute()
    {
        return array_pluck($this->business_fields->toArray(),'name');
    }

    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case "register":
                return 'Belum Upload Doc';
                break;
            case "short_form":
                return "Upload Doc Belum Lengkap";
                break;
            default:
                return $this->status;
        }
    }

    // public function scopeTenderTenantInvites($query, $tender)
    // {
    //     $tender_tenants = $tender->tender_tenants;

    //     return $query
    //         ->where('id', $tender->id)
    //         ->whereHas('tender_tenants', function ($query) use ($tender_tenants) {
    //             $query
    //                     ->where('is_candidate_winner', 0)
    //                     ->where('is_winner', 0);
    //         });
    // }
}
