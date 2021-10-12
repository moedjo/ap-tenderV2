<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class TenantShortForm extends Tenant
{

    public $rules = [
        'business_entity' => 'required',
        'verification_office' => 'required',
        'contact_position' => 'required',
        'region' => 'required',
        'collaborate' => 'required',
        'name' => 'required',
        'address' => 'required',
        'fax_number' => 'digits_between:7,13',
        'contact_full_name' => 'required',
        'email' => 'required|email',
        'npwp' => 'required|digits_between:1,15',
        'contact_phone_number' => 'required|digits_between:10,13',
        'phone_number' => 'required|digits_between:10,13'
    ];
}
