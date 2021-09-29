<?php

namespace Ap\Tender\Models;

use Model;
use Ap\Tender\Models\TenderTenant;

class TenderTenantWinner extends Tender
{

    public $rules = [
        'doc_spk' => 'required'
    ];

    public function afterSave()
    {
        $id = $this->tenant_winner->id;
        $tenant = TenderTenant::find($id);
        $tenant->status = 'winner';

        $tenant->save();
    }
 
}
