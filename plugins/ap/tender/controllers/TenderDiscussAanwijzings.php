<?php

namespace Ap\Tender\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class TenderDiscussAanwijzings extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = [
        'ap_tender_is_admin_tender',
        'ap_tender_is_finance',
        'ap_tender_is_admin_envelope1',
        'ap_tender_is_admin_envelope2',
        'ap_tender_is_tenant',
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'tender', 'aanwijzing-discuss');

        // $this->addJs('/plugins/ap/tender/assets/js/disqus.js', 'Ap.Tender');
    }

    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;

        if ($context == 'update') {
        }
    }

    public function listExtendQuery($query)
    {
        return $query->where('status','aanwijzing');
    }

    public function formExtendQuery($query)
    {
        return $query->where('status','aanwijzing');
    }

    public function formBeforeSave($model)
    {
    }
}
