<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class TenantInvite extends Tenant
{

    public $rules = [
       'invite_name' => 'required',
       'invite_description' => 'required',
       'invite_location' => 'required',
       'invite_pic_name' => 'required',
       'invite_pic_phone_number' => 'required|digits_between:10,13',
       'invite_pic_email' => 'required|email',
       'invite_date' => 'required|date|after:today',
       'invite_hour_start' => 'required|date',
       'invite_hour_end' => 'required|date|after:invite_hour_start',
    ];


}
