<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Backend\Facades\BackendMenu;
use Illuminate\Support\Facades\View;
use Redirect;
use Response;

class TenantLegals extends Controller
{
    public $implement = [
        'Backend\Behaviors\FormController'
    ];

    public $formConfig = 'config_form.yaml';


    public $requiredPermissions = [
        'ap_tender_is_tenant'
    ];


    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Ap.Tender', 'tenant', 'my-tenant');
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

    public function view()
    {
        $user = $this->user;
        $tenant = Tenant::where('user_id', $user->id)->first();
        return Redirect::to(Backend::url('ap/tender/tenantlegals/update/' . $tenant->id));
    }


    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;

        if ($context == 'update') {

            $disabled = true;
            $this->vars['disabled'] = $disabled;
            foreach ($fields as $field) {
                $field->disabled = $disabled;
            };

            // if ($model->business_entity->name == 'CV') {
            //     $fields['doc_legal_cv']->hidden = false;
            // }
        }
    }

    public function update_onSave($recordId)
    {

        return Redirect::to(Backend::url('ap/tender/tenantcommercials/update/' . $recordId));

        // TODO if
        $this->asExtension('FormController')->create_onSave($recordId);
    }
}
