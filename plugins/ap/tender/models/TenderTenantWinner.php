<?php

namespace Ap\Tender\Models;

use Model;
use Ap\Tender\Models\TenderTenant;

class TenderTenantWinner extends Model
{
    use \October\Rain\Database\Traits\Purgeable;

    public $table = 'ap_tender_tenders';

    public $belongsTo = [
        'tenant' => [
            'Ap\Tender\Models\Tenant',
            'key' => 'tenant_id'
        ],
        'business_field' => [
            'Ap\Tender\Models\BusinessField',
            'key' => 'business_field_id',
        ],
        'airport' => [
            'Ap\Tender\Models\Airport',
            'key' => 'airport_id',
        ],
    ];

    public $belongsToMany = [
        'tender_tenants' => [
            'Ap\Tender\Models\TenderTenant',
            'table' => 'ap_tender_tenders_tenants',
            'key'      => 'tender_id',
        ],
    ];

    public $rules = [
        'doc_spk' => 'required'
    ];

    public $attachOne = [
        'doc_spk' => ['System\Models\File', 'public' => true],
    ];

    protected $purgeable = ['tender_tenant_winner', 'tender_winner_publish'];

    public function getTenderTenantWinnerOptions()
    {
        $tenantTenders = TenderTenant::where('tender_id', $this->id)->get();
        $result = [];
        foreach ($tenantTenders as $tenantTender) {
            if ($tenantTender->is_candidate_winner === 1) {
                $result[$tenantTender->id] = [$tenantTender->tenant->name];
            }
        }

        return $result;
    }
}
