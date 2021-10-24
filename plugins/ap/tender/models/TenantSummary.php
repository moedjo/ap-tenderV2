<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class TenantSummary extends Tenant
{

    public $rules = [];


    public function getSummariesOptions()
    {
        $result = [];

        $summaries = Summary::all();

        foreach ($summaries as $summary) {
            $result[$summary->id] = [$summary->name, $summary->description];
        }

        return $result;
    }

    public function beforeValidate()
    {

        $count = Summary::count();
        $this->rules['summaries'] = "required|size:".$count;
        $this->rules['verification_office'] = "required";
    }
}
