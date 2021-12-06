<?php

namespace Ap\Tender\Controllers;

use Backend\Classes\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Response;

class PublicTenantLegals extends Controller
{
    public $implement = [
        'Backend\Behaviors\FormController'
    ];

    public $formConfig = 'config_form.yaml';


    public $requiredPermissions = [];

    public $publicActions = [
        'update'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'public/default';
        $this->addCss('/plugins/ap/tender/assets/css/custom.css', 'Ap.Tender');
        $this->addJs('/plugins/ap/tender/assets/js/tenantlegal.js', 'Ap.Tender');
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


    public function extendQuery($query)
    {
        $tenant_id = Session::get('tenant_id');
        return $query->where('id', $tenant_id);
    }

    public function formExtendQuery($query)
    {
        return $this->extendQuery($query);
    }

    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;

        if ($context == 'update') {
            // if ($model->business_entity->name == 'CV') {
            //     $fields['doc_legal_cv']->hidden = false;
            // }
        }
    }


    public function formBeforeSave($model)
    {
        $model->status = 'long_form';
    }
}
