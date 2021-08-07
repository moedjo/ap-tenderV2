<?php

namespace Ap\Tender;

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
            'ap.tender::mail.tenant-invite',
            'ap.tender::mail.tenant-short-listed',
            'ap.tender::mail.tenant-reject',
        ];
    }

    public function registerMailLayouts()
    {
        return [
            'ap-tender-registration' => 'ap.tender::layouts.default',
        ];
    }

    public function registerMailPartials()
    {
    }
}
