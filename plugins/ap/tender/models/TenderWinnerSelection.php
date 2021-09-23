<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class TenderWinnerSelection extends Model
{
    public $table = 'ap_tender_tenders_tenants';
    
    public $rules = [
        'invite_name' => 'required',
        'invite_description' => 'required',
        'invite_location' => 'required',
        'invite_pic_phone_number' => 'required|digits_between:10,13',
        'invite_date' => 'required|date|after:today',
        'invite_hour_start' => 'required|date',
        'invite_hour_end' => 'required|date|after:invite_hour_start',
     ];
}