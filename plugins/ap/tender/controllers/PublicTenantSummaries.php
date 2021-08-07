<?php

namespace Ap\Tender\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Response;
use Illuminate\Support\Str;

class PublicTenantSummaries extends Controller
{
    public $implement = [        
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';
    
    public $requiredPermissions = [
    ];

    public $publicActions = [
        'update' ,'success'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'public/default';
        $this->addCss('/plugins/ap/tender/assets/css/custom.css', 'Ap.Tender');
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

    public function formBeforeSave($model)
    {
        $model->token = Str::random(6);
        $model->token_url = Backend::url('ap/tender/publicusers/create?token='.$model->token);
        $model->status = 'pre_register';
    }


    public function formAfterSave($model)
    {
        Event::fire('tenant.pre_register', [$model]);
    }

    public function success(){
        Session::forget('tenant_id');
    }

}
