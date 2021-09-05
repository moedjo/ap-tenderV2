<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class TenderTenantRFPDocuments extends Controller
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
        'ap_tender_is_tenant'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'tender', 'rfp-document');
    }

    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;

        if ($context == 'update') {

            $fields['_section3']->hidden = true;
            $fields['tender[doc_rfp]']->hidden = true;

            if (!($model->status == 'submit_document' || $model->status == 'payment_reject')) {
                foreach ($fields as $field) {
                    $field->disabled = true;
                    $field->config['disabled'] = true;
                    $this->vars['disabled_' . $field->fieldName] = true;
                };
            }


            if($model->status == 'payment_approve') {
                $fields['_section3']->hidden = false;
                $fields['tender[doc_rfp]']->hidden = false;
            }

            if($model->status == 'payment_reject') {
        
            }



        }
    }

    public function extendQuery($query)
    {
        $user = $this->user;
        $tenant = Tenant::where('user_id', $user->id)->first();

        return $query->where('tenant_id', $tenant->id);
    }

    public function listExtendQuery($query)
    {
        return $this->extendQuery($query);
    }

    public function formExtendQuery($query)
    {
        return $this->extendQuery($query);
    }

    public function formBeforeSave($model)
    {
        if ($model->status == 'submit_document') {
            $model->status = 'submit_payment';
        }

        if ($model->status == 'payment_reject') {
            $model->status = 'submit_payment';
        }
    }


    public function index_onDelete()
    {
        return Response::make(View::make('backend::access_denied'), 403);
    }
    public function update_onDelete($recordId = null)
    {
        return Response::make(View::make('backend::access_denied'), 403);
    }

    public function create($context = null)
    {
        return Response::make(View::make('backend::access_denied'), 403);
    }

    public function preview($recordId = null, $context = null)
    {
        return Response::make(View::make('backend::access_denied'), 403);
    }
}
