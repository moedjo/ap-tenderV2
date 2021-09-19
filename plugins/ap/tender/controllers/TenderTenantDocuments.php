<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class TenderTenantDocuments extends Controller
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
        BackendMenu::setContext('Ap.Tender', 'tender', 'offer-document');
    }

    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;

        if ($context == 'update') {
            $this->vars['disabled_documents'] = true;
            if ($model->status == 'clarification') {

                $this->vars['disabled_documents'] = false;

                $fields['total_price']->disabled = false;
                $fields['total_price']->config['disabled'] = false;

                $fields['doc_offers']->disabled = false;
                $fields['doc_offers']->config['disabled'] = false;

                $fields['envelope1_score']->hidden = true;
                $fields['doc_envelope1_score']->hidden = true;
                $fields['doc_envelope1_others']->hidden = true;
                $fields['envelope2_score']->hidden = true;
                $fields['doc_envelope2_score']->hidden = true;
                $fields['doc_envelope2_others']->hidden = true;
            } else if ($model->status == 'envelope1_reject') {
                $this->vars['disabled_documents'] = false;
            } else if ($model->status == 'envelope2_reject') {
                
                $fields['total_price']->disabled = false;
                $fields['total_price']->config['disabled'] = false;

                $fields['doc_offers']->disabled = false;
                $fields['doc_offers']->config['disabled'] = false;
            }
        }
    }

    public function extendQuery($query)
    {
        $user = $this->user;
        $tenant = $user->tenant;
        return $query->where('tenant_id', $tenant->id);
        // ->whereIn(
        //     'status',
        //     ['payment_rfp_approve', 'submit_document', 'envelope2_reject', 'envelope1_reject', 'envelope_approve']
        // );
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
        if ($model->status == 'clarification' || $model->status == 'envelope1_reject' || $model->status == 'envelope2_reject') {
            $model->status = 'submit_document';
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
