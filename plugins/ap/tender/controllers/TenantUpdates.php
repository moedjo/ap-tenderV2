<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Ap\Tender\Models\Update;
use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Backend\Facades\BackendMenu;
use Illuminate\Support\Facades\View;
use Redirect;
use Response;

class TenantUpdates extends Controller
{
    public $implement = [
        'Backend\Behaviors\FormController'
    ];

    public $formConfig = 'config_form.yaml';


    public $requiredPermissions = [
        'ap_tender_is_tenant',
        'ap_tender_access_tenants'
    ];


    public function __construct()
    {
        parent::__construct();


        $user = $this->user;
        $sub_menu = 'tenants';
        if ($user->hasPermission('ap_tender_is_tenant')) {
            $sub_menu = 'request-update';
        } else if ($user->is_superuser) {
            $sub_menu = 'tenants';
        }

        BackendMenu::setContext('Ap.Tender', 'tenant', $sub_menu);
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

        $user = $this->user;
        if ($user->hasPermission('ap_tender_access_tenants')) {
            return $query;
        }

        if ($user->hasPermission('ap_tender_is_tenant')) {
            return $query->where('user_id', $user->id);
        }
    }

    public function formExtendQuery($query)
    {
        return $this->extendQuery($query);
    }


    public function formExtendModel($model)
    {
        // $updates = Update::all();
        // $model->updates = $updates;
        // $model->save();
    }


    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;

        if ($context == 'update') {
            $reject_fields = [];

            
        }
    }

    public function update($recordId = null)
    {

        $user = $this->user;

        if(isset($recordId)){
            return $this->asExtension('FormController')->update($recordId);
        }

        if ($user->hasPermission('ap_tender_is_tenant')) {
            $tenant = Tenant::where('user_id', $user->id)->first();

            if(empty($tenant)){
                return Redirect::to(Backend::url('ap/tender/tenants'));
            }

            return Redirect::to(Backend::url('ap/tender/tenantupdates/update/'.$tenant->id));
        } 

        return Redirect::to(Backend::url('ap/tender/tenants'));
    }
}
