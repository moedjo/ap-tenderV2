<?php

namespace Ap\Tender\Classes;

use Backend\Models\User;

class MailHelper
{


    public static function getAdminTenderMails()
    {
        return User::whereHas('role', function ($query) {
            $query->where('code', 'admin-tender');
        })->get()->pluck('email');
    }

    
    public static function getAdminEnvelope1Mails()
    {
        return User::whereHas('role', function ($query) {
            $query->where('code', 'admin-envelope1');
        })->get()->pluck('email');
    }

    public static function getAdminEnvelope2Mails()
    {
        return User::whereHas('role', function ($query) {
            $query->where('code', 'admin-envelope2');
        })->get()->pluck('email');
    }

    public static function getFinanceMails()
    {
        return User::whereHas('role', function ($query) {
            $query->where('code', 'finance');
        })->get()->pluck('email');
    }

    public static function getTenantMails()
    {
        return User::whereHas('role', function ($query) {
            $query->where('code', 'tenant');
        })->get()->pluck('email');
    }
}
