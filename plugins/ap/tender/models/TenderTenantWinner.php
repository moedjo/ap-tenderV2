<?php

namespace Ap\Tender\Models;

use Model;
use Ap\Tender\Models\TenderTenant;

class TenderTenantWinner extends Tender
{

    public $rules = [
        'doc_spk' => 'required'
    ];
 
}
