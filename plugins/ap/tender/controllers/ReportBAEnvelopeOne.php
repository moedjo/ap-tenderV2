<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tender;
use Backend\Classes\Controller;
use BackendMenu;
use Renatio\DynamicPDF\Classes\PDF;

class ReportBAEnvelopeOne extends Controller
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
        'ap_tender_access_tenders'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'reporting', 'report-baenvelopeone');
    }

    public function print($model)
    {
        $tender = Tender::findOrFail($model);

        $data['tender'] = $tender;

        return PDF::loadTemplate('ap.tender::pdf.report-baenvelopeone', $data)
        ->stream();
    }
}
