<?php

namespace Ap\Tender\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Backend\Facades\BackendMenu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Redirect;
use Response;

class TenantCommercials extends Controller
{
    public $implement = [
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';

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
            $sub_menu = 'my-tenant';
        }

        BackendMenu::setContext('Ap.Tender', 'tenant', $sub_menu);
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

    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;

        if ($context == 'update') {

            $reject_fields = [];
            if ($model->status == 'register' && $model->on_commercial_status == 'reject') {
                $verifications = $model->verification_commercials;
                foreach ($verifications as $verification) {
                    if (!$verification->pivot->on_check) {
                        $v_fields = explode(",", $verification->fields);
                        foreach ($v_fields as $v_field) {
                            $reject_fields[] =  $v_field;
                        }
                    }
                }
            }

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
    }

    public function formBeforeSave($model)
    {

        if (
            $model->status == 'register' &&
            $model->on_legal_status == 'reject' &&
            $model->on_commercial_status == 'reject' &&
            $model->on_finance_status == 'reject'
        ) {

            $model->on_legal_status = NULL;
            $model->on_commercial_status = NULL;
            $model->on_finance_status = NULL;
        }
    }

    public function update_onSave($recordId)
    {
        return $this->asExtension('FormController')->update_onSave($recordId);
    }
}
