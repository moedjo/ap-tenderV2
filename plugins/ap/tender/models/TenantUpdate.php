<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class TenantUpdate extends Tenant
{

    public $rules = [];


    public function buildUpdates($type){
        $result = [];
        
        $updates = Update::where('type',$type)
            ->get();

        foreach ($updates as $update) {
            $result[$update->id] = [
                e(trans('ap.tender::lang.tenant.'.$update->field)), 
                $update->description
            ];
        }

        return $result;
    }

    public function getUpdateLegalsOptions()
    {
        return $this->buildUpdates('legal');
    }

    public function getUpdateFinancesOptions()
    {

        return $this->buildUpdates('finance');
    }

    public function getUpdateCommercialsOptions()
    {
        return $this->buildUpdates('commercial');
    }
}
