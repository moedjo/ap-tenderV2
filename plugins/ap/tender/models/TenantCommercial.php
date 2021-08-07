<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class TenantCommercial extends Tenant
{

    public $rules = [
        'experiences' => '',
    ];

    public function beforeValidate()
    {
        if ($this->has_experience) {
            $this->rules['experiences'] = "required";
        } else {
            $this->rules['experiences'] = "";
        }
    }
}
