<?php

namespace Ap\Tender\Models;

use Model;
use Ap\Tender\Models\TenderTenant;

class TenderWinnerSelection extends Model
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

    protected $purgeable = ['tender_winner_selection'];

    public function getTenderWinnerSelectionOptions()
    {
        $tenantTenders = TenderTenant::all();
        $result = [];
        foreach ($tenantTenders as $tenantTender) {
            if ($this->id == $tenantTender->tender_id && $tenantTender->is_candidate_winner === 0 && $tenantTender->is_winner === 0) {
                $result[$tenantTender->id] = [$tenantTender->tenant->name];
            }
        }

        return $result;
    }
}
