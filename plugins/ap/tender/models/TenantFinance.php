<?php namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class TenantFinance extends Tenant
{
 
    public $rules = [
        'finances' => 'required|size:3',
        
        'doc_finance_sppkp' => 'required',
        'doc_finance_spt' => 'required',
        'doc_finance_blp' => 'required',
        'doc_finance_bsp' => 'required',
        'doc_finance_sklp' => 'required',
        'doc_finance_other' => '',
    ];

    public $customMessages = [
        'finances.size' => 'Mohon isi kemampuan keuangan 3 tahun terakhir',
    ];


    
    public function beforeValidate()
    {
        if ($this->collaborate) {
            $this->rules['doc_finance_collaborate'] = "required";
        }
    }

}
