<?php

namespace Ap\Tender\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Mail;

class TenderAanwijzings extends Controller
{
    public $implement = [
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = [
        'ap_tender_access_tenders'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'tender', 'tenders');
    }

    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;

        if ($context == 'update') {

            if ($model->status != 'registration') {
                foreach ($fields as $field) {
                    $field->disabled = true;
                    $field->config['disabled'] = true;
                };
            }
        }
    }

    public function formExtendQuery($query)
    {
        // return $query->where('status', 'registration');
        return $query;
    }

    public function formBeforeSave($model)
    {
        if ($model->status == 'registration') {
            $model->status = 'aanwijzing';
            $tender_tenants = $model->tender_tenants;
            foreach ($tender_tenants as $tender_tenant) {
                if ($tender_tenant->status == 'payment_rfp_approve') {
                    $tender_tenant->status = 'aanwijzing';
                    $tender_tenant->save();
                }
            }
        };
    }


    // public function formAfterSave($model)
    // {
    //     $tenant_invites = $model->tenant_invites;


    //     $params['tender'] = $model->toArray();

    //     foreach ($tenant_invites as $tenant_invite) {

    //         $tenant_invite->load('business_entity');

    //         $params['tenant'] = $tenant_invite->toArray();            
    //         Mail::queue('ap.tender::mail.tenant-invite2', $params, function ($message) use ( $params , $tenant_invite) {
    //             $message->to($tenant_invite->email, $tenant_invite->name);
    //          });
    //     }
    // }
}
