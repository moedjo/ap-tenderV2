<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class TenantFinance extends Tenant
{

    public $rules = [
        'doc_finance_sppkp' => 'required',
        'doc_finance_blp' => 'required',

        'doc_finance_sklp' => 'required',
        'doc_finance_other' => '',

        'doc_finance_fiskal' => '',
        'doc_finance_registered' => 'required',
    ];

    public $customMessages = [
        'finances.size' => 'Mohon isi kemampuan keuangan 3 tahun terakhir',
    ];



    public function beforeValidate()
    {
        if ($this->collaborate) {
            $this->rules['doc_finance_collaborate'] = "required";
        }

        if ($this->is_age_comply) {
            $this->rules['finances'] = 'required|size:3';
            $this->rules['doc_finance_spt'] = "required";
        } else {
            $this->rules['finances'] = 'required|size:1';
            $this->rules['doc_finance_spt_monthly'] = "required";
        }
    }

    public function filterFields($fields)
    {
        if ($this->collaborate) {
            if (isset($fields->doc_finance_collaborate)) {
                $fields->doc_finance_collaborate->hidden = false;
            }
        } else {
            if (isset($fields->doc_finance_collaborate)) {
                $fields->doc_finance_collaborate->hidden = true;
            }
        }
    }
}
