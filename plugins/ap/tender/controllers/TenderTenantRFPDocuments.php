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

            if ($model->status == 'pre_registration' || $model->status == 'payment_rfp_reject') {
                $fields['pic_payment_rfp']->disabled = false;
                $fields['pic_payment_rfp']->config['disabled'] = false;
            }else if($model->status == 'payment_rfp_approve') {
                $fields['_section3']->hidden = false;
                $fields['tender[doc_rfp]']->hidden = false;
            }

        }
    }

    public function extendQuery($query)
    {
        $user = $this->user;
        $tenant = $user->tenant;
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
        if ($model->status == 'pre_registration') {
            $model->status = 'payment_rfp';
        }

        if ($model->status == 'payment_rfp_reject') {
            $model->status = 'payment_rfp';
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
