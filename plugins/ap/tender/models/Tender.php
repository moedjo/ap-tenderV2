<?php

namespace Ap\Tender\Models;

use Backend\Facades\BackendAuth;
use Model;

/**
 * Model
 */
class Tender extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Revisionable;



    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ap_tender_tenders';

    /**
     * @var array Validation rules
     */
    public $rules = [];

    public $belongsTo = [
        'business_field' => [
            'Ap\Tender\Models\BusinessField',
            'key' => 'business_field_id',
        ],

        'airport' => [
            'Ap\Tender\Models\Airport',
            'key' => 'airport_id',
        ],

        'tenant_winner' => [
            'Ap\Tender\Models\TenderTenant',
            'key' => 'winner_tender_tenant_id',
        ],
    ];

    public $hasMany = [
        'tender_tenants' => [
            'Ap\Tender\Models\TenderTenant',
            'table' => 'ap_tender_tenders_tenants',
            'key'      => 'tender_id',
        ],
    ];

    public $morphMany = [
        'schedules' => [
            'Ap\Tender\Models\Schedule',
            'name' => 'schedulable'
        ],
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];

    public $belongsToMany = [
        'tenant_invites' => [
            'Ap\Tender\Models\Tenant',
            'table' => 'ap_tender_tenders_tenant_invites',
            'key'      => 'tender_id',
            'otherKey' => 'tenant_id',
        ],

        'tenant_winners' => [
            'Ap\Tender\Models\Tenant',
            'table' => 'ap_tender_tenders_tenant_winners',
            'key'      => 'tender_id',
            'otherKey' => 'tenant_id',
        ],

    ];

    public $attachOne = [
        'doc_rfq' => ['System\Models\File', 'public' => true],
        'doc_rfp' => ['System\Models\File', 'public' => false],
        'doc_spk' => ['System\Models\File', 'public' => true],

    ];

    public $attachMany = [
        'doc_support' => ['System\Models\File', 'public' => true],
        'pic_flyer' => ['System\Models\File', 'public' => true],

        'doc_winner_support' => ['System\Models\File', 'public' => true],
    ];

    protected $jsonable = [
        'rooms',
    ];



    protected $revisionable = [
        'status', 'name', 'package', 'description', 'business_field_id', 'airport_id', 'rooms',
        'pic_full_name', 'pic_phone_number', 'pic_email', 'invite_name', 'invite_description', 'invite_location', 'invite_pic_phone_number',
        'invite_date', 'invite_hour_start', 'invite_hour_end', 'tenant_winner_id'
    ];

    public $revisionableLimit = 500;
    public function getRevisionableUser()
    {
        return BackendAuth::getUser();
    }


    public function beforeValidate()
    {
        if ($this->status == 'aanwijzing') {
            $this->rules = [
                'invite_name' => 'required',
                'invite_description' => 'required',
                'invite_location' => 'required',
                'invite_pic_phone_number' => 'required|digits_between:10,13',
                'invite_date' => 'required|date|after:today',
                'invite_hour_start' => 'required|date',
                'invite_hour_end' => 'required|date|after:invite_hour_start',
            ];
        }

        if ($this->status == 'registration') {
            $this->rules = [
                'name' => 'required',
                'business_field' => 'required',
                'airport' => 'required',
                'pic_full_name' => 'required',
                'pic_email' => 'required|email',
                'package' => 'required',
                'rooms' => 'required',
                'description' => 'required',
                'pic_flyer' => 'required',
                'doc_rfq' => 'required',
                'doc_rfp' => 'required',
            ];
        }
    }

    public function afterCreate()
    {

        //    $test =  $this->tenant_invites()->withDeferred(post('_session_key'))->get();

        //    trace_log($test);
    }
}
