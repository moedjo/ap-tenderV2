<?php

namespace Ap\Tender\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Mail;

class Tenders extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\RelationController',
    ];

    public $listConfig = 'config_list.yaml';
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

            $reject_fields = [];

            $reject_fields = array_unique($reject_fields);
            foreach ($fields as $field) {
                $this->vars['disabled_' . $field->fieldName] = false;
                if (!in_array($field->fieldName, $reject_fields)) {
                    $field->disabled = true;
                    $field->config['disabled'] = true;
                    $this->vars['disabled_' . $field->fieldName] = true;
                }
            };
        }

        if ($context == 'create') {
            foreach ($fields as $field) {
                $this->vars['disabled_' . $field->fieldName] = false;
            };
        }
    }

    public function formBeforeCreate($model)
    {
        $model->status = 'registration';
    }


    public function formAfterSave($model)
    {
        $tenant_invites = $model->tenant_invites;

 
        $params['tender'] = $model->toArray();

        foreach ($tenant_invites as $tenant_invite) {
        
            $tenant_invite->load('business_entity');

            $params['tenant'] = $tenant_invite->toArray();            
            Mail::queue('ap.tender::mail.tenant-invite2', $params, function ($message) use ( $params , $tenant_invite) {

                $tos = array();

                if(isset($tenant_invite->email)){
                    $tos[] = $tenant_invite->email;
                }

                if(isset($tenant_invite->contact_email)){
                    $tos[] = $tenant_invite->contact_email;
                }

                $message->to($tos, $tenant_invite->name);
             });
        }
    }
}
