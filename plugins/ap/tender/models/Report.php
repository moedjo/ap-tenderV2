<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class Report extends Model
{
    use \October\Rain\Database\Traits\Purgeable;

    public function __construct()
    {
        parent::__construct();
    }

    public $rules = [
        'email_to' => 'required'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ap_tender_tenders';

    public $belongsTo = [
        'business_field' => [
            'Ap\Tender\Models\BusinessField',
            'key' => 'business_field_id',
        ],
    ];

    public $hasMany = [
        'tender_tenants' => [
            'Ap\Tender\Models\TenderTenant',
            'table' => 'ap_tender_tenders_tenants',
            'key'      => 'tender_id',
        ],
    ];

    public $belongsToMany = [
            'tenant_invites' => [
                'Ap\Tender\Models\Tenant',
                'table' => 'ap_tender_tenders_tenant_invites',
                'key'      => 'tender_id',
                'otherKey' => 'tenant_id',
            ]
    ];

    protected $purgeable = ['report_description'];
}
