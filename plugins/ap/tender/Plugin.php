<?php

namespace Ap\Tender;

use Backend\Models\User;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function registerListColumnTypes()
    {
        return [
            'currency_idr' => function ($value) {
                return "Rp " . number_format($value, 0, ",", ".");
            }
        ];
    }


    public function registerMailTemplates()
    {
        return [
            'ap.tender::mail.tenant-short-form',
            'ap.tender::mail.tenant-pre-register',
            'ap.tender::mail.tenant-register',
            'ap.tender::mail.tenant-invite',
            'ap.tender::mail.tenant-short-listed',
            'ap.tender::mail.tenant-reject',

            'ap.tender::mail.tenant-invite2',
            'ap.tender::mail.tender-tenant-status-update',
        ];
    }

    public function registerMailLayouts()
    {
        return [
            'ap.tender::mail.layouts.default' => 'ap.tender::mail.layouts.default',
        ];
    }

    public function registerMailPartials()
    {
    }


    public function registerPDFTemplates()
    {
        return [
            'ap.tender::pdf.tenant-reject',
        ];
    }


    public function registerPDFLayouts()
    {
        return [
            'ap.tender::pdf.layouts.default',
        ];
    }


    public function boot(){
        User::extend(function ($model) {
            $model->hasOne ['tenant'] =  [
                'Ap\Tender\Models\Tenant'
            ];
        });
    
    }
}

