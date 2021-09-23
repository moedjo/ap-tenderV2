<?php

namespace Ap\Tender\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Ap\Tender\Models\TenderWinnerSelection;

class TenderWinnerSelections extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\RelationController'
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = [
        'ap_tender_is_tenant'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = "Pemilihan Pemenang";
        BackendMenu::setContext('Ap.Tender', 'tender', 'tender-winnerselection');
    }

    public function formBeforeSave($model)
    {
        $model->is_candidate_winner = 1;
    }
}