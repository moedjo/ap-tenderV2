<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class TenderTenantDetails extends Controller
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
        'ap_tender_is_finance',
        'ap_tender_is_admin_envelope1',
        'ap_tender_is_admin_envelope2',
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'tender', 'tenant-details');
    }

    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;

        if ($context == 'update') {

            if ($model->status == 'payment_rfp') {
                if (isset($fields['_payment_status'])) {
                    $fields['_payment_status']->disabled = false;
                    $fields['_payment_status']->config['disabled'] = false;
                }
            }

            if ($model->status == 'submit_document') {

                if (isset($fields['is_envelope1'])) {
                    $fields['is_envelope1']->disabled = false;
                    $fields['is_envelope1']->config['disabled'] = false;
                }

                if (isset($fields['is_envelope2'])) {
                    $fields['is_envelope2']->disabled = false;
                    $fields['is_envelope2']->config['disabled'] = false;
                }
            }
        }
    }

    public function extendQuery($query)
    {

        $user = $this->user;
        if ($user->hasPermission('ap_tender_is_finance')) {
            return $query;
        } else if ($user->hasPermission('ap_tender_is_admin_envelope1')) {
            return $query->whereIn('status', ['submit_document', 'envelope1_reject', 'envelope_approve']);
        } else if ($user->hasPermission('ap_tender_is_admin_envelope2')) {
            return $query->whereIn('status', ['submit_document', 'envelope1_reject', 'envelope_approve']);
        }

        return $query;
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
        $user = $this->user;
        if ($user->hasPermission('ap_tender_is_admin_tender')) {
            // 0 reject 1 approve
            $payment_status = post('TenderTenant[_payment_status]');
            if ($model->status == 'payment_rfp') {
                if ($payment_status  == 0) {
                    $model->pic_payment->delete();
                    $model->status = 'payment_rfp_reject';
                } else {

                    $model->status = 'payment_rfp_approve';
                }
            }
        } else if ($user->hasPermission('ap_tender_is_admin_envelope1')) {

            if ($model->status == 'submit_document') {
                if ($model->is_envelope1 && $model->is_envelope2) {
                    $model->status = 'envelope_approve';
                }

                if (!$model->is_envelope1) {
                    $model->status = 'envelope1_reject';
                }
            }
        } else if ($user->hasPermission('ap_tender_is_admin_envelope2')) {
            if ($model->status == 'submit_document') {
                if ($model->is_envelope1 && $model->is_envelope2) {
                    $model->status = 'envelope_approve';
                }

                if (!$model->is_envelope1) {
                    $model->status = 'envelope2_reject';
                }
            }
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
