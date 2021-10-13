<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class TenderTenantNegotiations extends Controller
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
        'ap_tender_is_admin_tender',
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'tender', 'expired-nego');
    }

    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;
        $user = $this->user;

        if ($context == 'update') {

            if ($model->status == 'payment_rfp') {

            }

           
            

            
        }
    }

    public function extendQuery($query)
    {
        return $query->whereIn('status', ['negotiation', 'submit_negotiation']);;
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
        $model->status = 'submit_negotiation';
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
