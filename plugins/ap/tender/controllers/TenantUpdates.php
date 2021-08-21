<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Ap\Tender\Models\Update;
use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Backend\Facades\BackendMenu;
use Flash;
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
        'ap_tender_is_commercial'
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
        $this->addCss('/plugins/ap/tender/assets/css/custom-field-checkboxlist-scrollable.css', 'Ap.Tender');
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
        if ($user->hasPermission('ap_tender_is_tenant')) {
            return $query->where('user_id', $user->id);
        }

        // if ($user->hasPermission('ap_tender_is_commercial')) {
        //     return $query->where('status', 'request_update');
        // }

        return $query;
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

            if ($this->user->hasPermission('ap_tender_is_tenant')) {

                if ($model->status != 'short_listed') {
                    $fields['updates']->disabled = true;
                }
            }



            if ($this->user->hasPermission('ap_tender_is_commercial')) {

                $fields['updates']->disabled = true;

                if ($model->status != 'request_update') {
                    $fields['_approve']->hidden = true;
                }
            }
        }
    }

    public function update($recordId = null)
    {
        $user = $this->user;
        if (isset($recordId)) {
            return $this->asExtension('FormController')->update($recordId);
        }

        if ($user->hasPermission('ap_tender_is_tenant')) {
            $tenant = Tenant::where('user_id', $user->id)->first();

            if (empty($tenant)) {
                return Redirect::to(Backend::url('backend'));
            }
            return Redirect::to(Backend::url('ap/tender/tenantupdates/update/' . $tenant->id));
        }

        return Redirect::to(Backend::url('backend'));
    }


    public function formBeforeSave($model)
    {

        if (
            $model->status == 'short_listed' && $this->user->hasPermission('ap_tender_is_tenant')
        ) {
            $count = $model->updates->count();
            if ($count > 0) {
                $model->status = 'request_update';
            }
        }

        if (
            $model->status == 'request_update' && $this->user->hasPermission('ap_tender_is_commercial')
        ) {

            $approve = post('TenantUpdate[_approve]');


            if($approve){
                // $model->updates = null;
                $model->status = 'request_update_approved';

            }else {
                $model->updates = null;
                $model->status = 'short_listed';
            }

  
        }
    }
}
