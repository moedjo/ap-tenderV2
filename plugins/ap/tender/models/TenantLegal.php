<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class TenantLegal extends Tenant
{

    public $rules = [
        'name' => 'required',
        'npwp' => 'required',
        'konsorsium' => 'required',
        'address' => 'required',
        'region' => 'required',
        'phone_number' => 'required|digits_between:10,13',
        'fax_number' => 'required|digits_between:7,13',
        'email' => 'required|email',
        'website' => 'required|url',
        'directors' => 'required',
        'commissioners' => 'required',
        'business_fields' => 'required',
        'business_activity' => 'required',
        'business_kbli' => 'required',
        'contact_full_name' => 'required',
        'contact_position' => 'required',
        'contact_phone_number' => 'required|digits_between:10,13',
        'contact_email' => 'required|email',
        'pic_full_name' => 'required',
        'pic_position' => 'required',
        'pic_phone_number' => 'required|digits_between:10,13',
        'pic_ktp' => 'required',
        'pic_email' => 'required|email',

        'doc_legal_akta' => 'required',
        'doc_legal_nib' => 'required',
        'doc_legal_tdp' => 'required',
        'doc_legal_domisili' => 'required',
        'doc_legal_npwp' => 'required',
        'doc_legal_ktp' => 'required',
        'doc_legal_sk' => '',
    ];


    public function beforeValidate()
    {
        if ($this->konsorsium) {
            $this->rules['konsorsium_role'] = "required";
            $this->rules['konsorsium_total'] = "required|numeric";
            $this->rules['konsorsium_name'] = "required";
            $this->rules['konsorsium_function'] = "required";
            $this->rules['doc_legal_konsorsium'] = "required";
        }

        if($this->business_entity->name == 'CV') {
            $this->rules['doc_legal_cv'] = "required";
        }
    }
}
