<?php

namespace Ap\Tender\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class TenderDocuments extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        // 'Backend\Behaviors\RelationController',
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    // public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = [
        'ap_tender_access_tenders'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'tender', 'tender-documents');
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


    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;

        if ($context == 'update') {

            if ($model->status == 'publish_document') {
                foreach ($fields as $field) {

                    $field->disabled = true;
                    $field->config['disabled'] = true;
                };
            }
        }
    }

    public function extendQuery($query)
    {
        return $query->whereIn('status', ['registration', 'publish_document']);
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
        $model->status = 'publish_document';
    }
}
