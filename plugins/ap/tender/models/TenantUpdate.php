<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class TenantUpdate extends Tenant
{
    public function getUpdatesOptions()
    {
        $result = [];
        $updates = Update::all();
        foreach ($updates as $update) {
            $result[$update->id] = [

                e(trans('ap.tender::lang.tenant.' . $update->field)),
            ];
        }

        return $result;
    }
}
