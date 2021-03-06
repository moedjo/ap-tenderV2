<?php

namespace Ap\Tender\Models;

use Backend\Facades\BackendAuth;
use Illuminate\Support\Facades\Mail;
use Model;
use PHPUnit\Framework\Constraint\IsEmpty;

/**
 * Model
 */
class TenderTenant extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Revisionable;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'ap_tender_tenders_tenants';

    /**
     * @var array Validation rules
     */
    public $rules = [];

    // protected $purgeable = ['payment_status'];

    public $belongsTo = [

        'tender' => [
            'Ap\Tender\Models\Tender',
            'key' => 'tender_id',
        ],

        'tenant' => [
            'Ap\Tender\Models\Tenant',
            'key' => 'tenant_id',
        ],

    ];

    public $hasMany = [];

    public $belongsToMany = [];

    public $morphMany = [
        'documents' => [
            'Ap\Tender\Models\Document',
            'name' => 'documentable'
        ],
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];

    public $attachOne = [
        'pic_payment_rfp' => ['System\Models\File', 'public' => false],

        'doc_envelope1_score' => ['System\Models\File', 'public' => false],
        'doc_envelope2_score' => ['System\Models\File', 'public' => false],

        'doc_negotiation' => ['System\Models\File', 'public' => false],
    ];

    public $attachMany = [
        'doc_offers' => ['System\Models\File', 'public' => false],

        'doc_envelope1_others' => ['System\Models\File', 'public' => false],
        'doc_envelope2_others' => ['System\Models\File', 'public' => false],
    ];

    protected $jsonable = [];

    protected $dates = ['expired_negotiation'];



    protected $revisionable = [
        'tender_id', 'tenant_id', 'status', 'is_envelope1', 'is_envelope2', 'is_payment_rfp', 'total_price',
        'last_total_price', 'invite_name', 'invite_description', 'invite_location', 'invite_pic_phone_number',
        'invite_date','invite_hour_start','invite_hour_end','invite_negotiation_name','invite_negotiation_description','invite_negotiation_location','invite_negotiation_pic_phone_number',
        'invite_negotiation_date','invite_negotiation_hour_start','invite_negotiation_hour_end','expired_negotiation','envelope1_score','envelope2_score'
    ];

    public $revisionableLimit = 1000;
    public function getRevisionableUser()
    {
        return BackendAuth::getUser();
    }


    public function beforeValidate()
    {

        if ($this->status == 'payment_rfp') {
            $this->rules = [
                'pic_payment_rfp' => 'required',
            ];
        }

        if ($this->status == 'payment_rfp_approve' || $this->status == 'payment_rfp_reject') {
            $this->rules = [
                'is_payment_rfp' => 'required',
            ];
        }

        if ($this->status == 'envelope1_approve' || $this->status == 'envelope1_reject') {
            $this->rules = [
                'is_envelope1' => 'required',
                'envelope1_score' => 'required',
                'doc_envelope1_score' => 'required',
                // 'doc_envelope1_others' => 'required',
            ];
        }



        if ($this->status == 'envelope2_approve' ||  $this->status == 'envelope2_reject') {
            $this->rules = [
                'is_envelope2' => 'required',
                'envelope2_score' => 'required',
                'doc_envelope2_score' => 'required',
                // 'doc_envelope2_others' => 'required',
            ];
        }



        if ($this->status == 'clarification') {
            $this->rules = [
                'invite_name' => 'required',
                'invite_location' => 'required',
                'invite_pic_phone_number' => 'required|digits_between:10,13',
                'invite_date' => 'required|date|after:today',
                'invite_hour_start' => 'required|date',
                'invite_hour_end' => 'required|date|after:invite_hour_start',
                'invite_description' => 'required',

            ];
        }



        if ($this->status == 'negotiation') {
            $this->rules = [
                'invite_negotiation_name' => 'required',
                'invite_negotiation_location' => 'required',
                'invite_negotiation_pic_phone_number' => 'required|digits_between:10,13',
                'invite_negotiation_date' => 'required|date|after:today',
                'invite_negotiation_hour_start' => 'required|date',
                'invite_negotiation_hour_end' => 'required|date|after:invite_negotiation_hour_start',
                'invite_negotiation_description' => 'required',

            ];
        }

        if ($this->status == 'submit_negotiation') {
            $this->rules = [
                'expired_negotiation' => 'required|date|after:today',

            ];
        }

        if ($this->status == 'last_negotiation') {
            $this->rules = [
                'doc_negotiation' => 'required',
                'last_total_price' => 'required',

            ];
        }
    }

    public function afterCreate()
    {

        $this->load('tenant');
        $this->load('tender');
        $tenant = $this->tenant;
        Mail::queue('ap.tender::mail.tender-tenant-registration', $this->toArray(), function ($message) use ($tenant) {

            $notif = Settings::get('notif_registration');

            trace_log('ini email->'.$notif);
            if (isset($notif)) {
                $ccs =  explode(";", $notif);
                $message->to($tenant->email, $tenant->name)->cc($ccs);
            } else {
                $message->to($tenant->email, $tenant->name);
            }
        });
    }

    public function afterUpdate()
    {

        if ($this->status !== $this->original['status']) {


            if ($this->status == 'last_negotiation') {
                return;
            }

            $this->load('tenant');
            $this->load('tender');

            $tenant = $this->tenant;

            Mail::queue('ap.tender::mail.tender-tenant-' . $this->status, $this->toArray(), function ($message) use ($tenant) {
                $notif = Settings::get('notif_' . $tenant->status);
                if (isset($notif)) {
                    $ccs =  explode(";", $notif);
                    $message->to($tenant->email, $tenant->name)->cc($ccs);
                } else {
                    $message->to($tenant->email, $tenant->name);
                }
            });
        }
    }

    public function getNameAttribute()
    {
        return $this->tenant->name;
    }

    public function getDescriptionAttribute()
    {
        return "Rp " . number_format($this->last_total_price, 0, ",", ".");;
    }

    public function scopeTenantWinner($query, $tender)
    {

        $ids = $tender->tenant_winners->pluck('id');
        return $query->whereHas('tenant', function ($query) use ($ids) {
            $query->whereIn('id', $ids);
        })->where('tender_id', $tender->id);
    }
}
