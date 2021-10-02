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



            'ap.tender::mail.tender-tenant-clarification',

            'ap.tender::mail.tender-tenant-envelope1_approve',
            'ap.tender::mail.tender-tenant-envelope1_reject',
            'ap.tender::mail.tender-tenant-envelope2_approve',
            'ap.tender::mail.tender-tenant-envelope2_reject',
            'ap.tender::mail.tender-tenant-negotiation',
            'ap.tender::mail.tender-tenant-payment_rfp_approve',
            'ap.tender::mail.tender-tenant-payment_rfp_reject',

            'ap.tender::mail.tender-tenant-payment_rfp',
            'ap.tender::mail.tender-tenant-registration',
            'ap.tender::mail.tender-tenant-winner_candidate',
            'ap.tender::mail.tender-tenant-winner_publish',
            'ap.tender::mail.tender-tenant-winner',
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

            // report template
            'ap.tender::pdf.report-form1',
            'ap.tender::pdf.report-form2',
            'ap.tender::pdf.report-qualification',
            'ap.tender::pdf.report-baenvelopeone',
            'ap.tender::pdf.report-statement',
        ];
    }


    public function registerPDFLayouts()
    {
        return [
            'ap.tender::pdf.layouts.default',
            'ap.tender::pdf.layouts.layout',
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

