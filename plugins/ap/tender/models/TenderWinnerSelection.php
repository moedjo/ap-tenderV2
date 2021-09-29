<?php

namespace Ap\Tender\Models;

use Model;
use Ap\Tender\Models\TenderTenant;
use Db;

class TenderWinnerSelection extends Tender
{


    public function __construct()
    {
        parent::__construct();
    }

    public function getTenantWinnersOptions()
    {
        $tenantTenders = TenderTenant::where('tender_id', $this->id)
            ->whereIn('status',['last_negotiation','winner_candidate'])
            ->orderBy('last_total_price',"ASC")->get();

        $result = [];
        foreach ($tenantTenders as $tenantTender) {
            $result[$tenantTender->tenant->id] = 
            [
                $tenantTender->tenant->name,  
                "Penawaran Akhir -> Rp " . number_format($tenantTender->last_total_price, 0, ",", ".")
            ];
        }

        return $result;
    }


    public function afterSave()
    {

        trace_sql();
        $ids = $this->tenant_winners->pluck('id');

        TenderTenant::whereHas('tenant', function ($query) use ($ids) {
            $query->whereIn('id', $ids);
        })
        ->where('status','last_negotiation')
        ->where('tender_id',$this->id)
        ->update(['status' => 'winner_candidate']);

        TenderTenant::whereHas('tenant', function ($query) use ($ids) {
            $query->whereNotIn('id', $ids);
        })
        ->where('status','winner_candidate')
        ->where('tender_id',$this->id)
        ->update(['status' => 'last_negotiation']);

    


    }

}
