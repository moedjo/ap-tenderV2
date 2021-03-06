<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
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




    public function formExtendModel($model)
    {
        $model->bindEvent('model.relation.attach', function ($relationName, $id, $insertData)  use ($model) {
            if ($relationName == 'tenant_invites') {
                $tenant = Tenant::find($id);

                $model->load('schedules');
                $params['tender'] = $model->toArray();
                $tenant->load('business_entity');
                $params['tenant'] = $tenant->toArray();

                Mail::queue('ap.tender::mail.tenant-invite2', $params, function ($message) use ( $params , $tenant) {
                    
                    $message->to($tenant->email, $tenant->name);
                 });
            }
        });
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
