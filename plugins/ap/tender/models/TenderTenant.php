<?php

namespace Ap\Tender\Models;

use Illuminate\Support\Facades\Mail;
use Model;

/**
 * Model
 */
class TenderTenant extends Model
{
    use \October\Rain\Database\Traits\Validation;


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
        ]
    ];

    public $attachOne = [
        'pic_payment_rfp' => ['System\Models\File', 'public' => false],

        'doc_envelope1_score' => ['System\Models\File', 'public' => false],
        'doc_envelope2_score' => ['System\Models\File', 'public' => false],
    ];

    public $attachMany = [
        'doc_offers' => ['System\Models\File', 'public' => false],
        
        'doc_envelope1_others' => ['System\Models\File', 'public' => false],
        'doc_envelope2_others' => ['System\Models\File', 'public' => false],
    ];

    protected $jsonable = [];


    public function beforeValidate()
    {
        if ($this->status == 'submit_document') {
            $this->rules = [
                'documents' => 'required',
                'total_price' => 'required',
                'doc_offers' => 'required',
            ];
        }

        if ($this->status == 'submit_payment') {
            $this->rules = [
                'pic_payment' => 'required',
            ];
        }
    }

    public function afterUpdate()
    {

        if ($this->title !== $this->original['status']) {

            $this->load('tenant');
            $this->load('tender');

            $tenant = $this->tenant;



            Mail::queue('ap.tender::mail.tender-tenant-status-update', $this->toArray(), function ($message) use ($tenant) {

                // $tos = array();

                // if(isset($tenant->email)){
                //     $tos[] = $tenant->email;
                // }

                // if(isset($tenant->contact_email)){
                //     $tos[] = $tenant->contact_email;
                // }

                $message->to( $tenant->email, $tenant->name);
            });

        }
    }
}
