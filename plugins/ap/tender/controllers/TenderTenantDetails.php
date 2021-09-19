<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Mail;
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
        'ap_tender_is_admin_tender',
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
        $user = $this->user;

        if ($context == 'update') {

            if ($model->status == 'payment_rfp') {

                if ($user->hasPermission('ap_tender_is_finance')) {
                    $fields['is_payment_rfp']->disabled = false;
                    $fields['is_payment_rfp']->config['disabled'] = false;
                }
            }

            if ($model->status == 'submit_document') {

                if ($user->hasPermission('ap_tender_is_admin_envelope1')) {
                    $fields['is_envelope1']->disabled = false;
                    $fields['is_envelope1']->config['disabled'] = false;

                    $fields['envelope1_score']->disabled = false;
                    $fields['envelope1_score']->config['disabled'] = false;

                    $fields['doc_envelope1_score']->disabled = false;
                    $fields['doc_envelope1_score']->config['disabled'] = false;

                    $fields['doc_envelope1_others']->disabled = false;
                    $fields['doc_envelope1_others']->config['disabled'] = false;
                } 
            }

            if ($model->status == 'envelope1_approve') {
                if ($user->hasPermission('ap_tender_is_admin_envelope2')) {
                    $fields['is_envelope2']->disabled = false;
                    $fields['is_envelope2']->config['disabled'] = false;

                    $fields['envelope2_score']->disabled = false;
                    $fields['envelope2_score']->config['disabled'] = false;

                    $fields['doc_envelope2_score']->disabled = false;
                    $fields['doc_envelope2_score']->config['disabled'] = false;

                    $fields['doc_envelope2_others']->disabled = false;
                    $fields['doc_envelope2_others']->config['disabled'] = false;
                }
            }

            if($model->status == 'aanwijzing'){
                if ($user->hasPermission('ap_tender_is_admin_tender')) {
                    $fields['invite_name']->disabled = false;
                    $fields['invite_location']->disabled = false;
                    $fields['invite_pic_phone_number']->disabled = false;
                    $fields['invite_date']->disabled = false;
                    $fields['invite_hour_start']->disabled = false;
                    $fields['invite_hour_end']->disabled = false;
                    $fields['invite_description']->disabled = false;

                    $fields['invite_name']->config['disabled'] = false;
                    $fields['invite_location']->config['disabled'] = false;
                    $fields['invite_pic_phone_number']->config['disabled'] = false;
                    $fields['invite_date']->config['disabled'] = false;
                    $fields['invite_hour_start']->config['disabled'] = false;
                    $fields['invite_hour_end']->config['disabled'] = false;
                    $fields['invite_description']->config['disabled'] = false;
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
            return $query->whereIn('status', ['submit_document', 'envelope1_reject', 'envelope1_approve']);
        } else if ($user->hasPermission('ap_tender_is_admin_envelope2')) {
            return $query->whereIn('status', ['envelope2_reject', 'envelope2_approve', 'envelope1_approve']);
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


       
    }

    public function formAfterSave($model)
    {

        $user = $this->user;
        if ($user->hasPermission('ap_tender_is_finance')) {
            if ($model->status == 'payment_rfp') {
                if ($model->is_payment_rfp == 1) {
                    $model->status = 'payment_rfp_approve';
                } else {
                    $model->pic_payment_rfp->delete();
                    $model->status = 'payment_rfp_reject';
                }
            }
        } else if ($user->hasPermission('ap_tender_is_admin_envelope1')) {

            if ($model->status == 'submit_document') {
                if ($model->is_envelope1 == 1) {
                    $model->status = 'envelope1_approve';
                } else {
                    $model->status = 'envelope1_reject';
                }
            }
        } else if ($user->hasPermission('ap_tender_is_admin_envelope2')) {
            if ($model->status == 'envelope1_approve') {
                if ($model->is_envelope2 == 1) {
                    $model->status = 'envelope2_approve';
                } else {
                    $model->status = 'envelope2_reject';
                }
            }
        } else if ($user->hasPermission('ap_tender_is_admin_tender')) {
            if ($model->status == 'aanwijzing') {
                $model->status = 'clarification';
            }
        }

        $model->save();

        // $model->load('tenant');
        // $model->load('tender');

        // $tenant = $model->tenant;
        
        // Mail::queue('ap.tender::mail.tender-tenant-status-update', $model->toArray(), function ($message) use (  $tenant ) {
        //     $message->to([$tenant->email,$tenant->contact_email], $tenant->name);
        //  });
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
