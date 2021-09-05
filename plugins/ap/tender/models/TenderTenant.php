<?php

namespace Ap\Tender\Models;

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

    public $hasMany = [
        'schedules' => [
            'Ap\Tender\Models\Schedule',
            'key' => 'tender_id'
        ],
    ];

    public $belongsToMany = [];

    public $morphMany = [
        'documents' => [
            'Ap\Tender\Models\Document',
            'key' => 'tender_tenant_id'
        ]
    ]; 

    public $attachOne = [];

    public $attachMany = [
        'doc_offers' => ['System\Models\File', 'public' => false],
    ];

    protected $jsonable = [];

}
