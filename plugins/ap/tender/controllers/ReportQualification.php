<?php

namespace Ap\Tender\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Renatio\DynamicPDF\Classes\PDF;

class ReportQualification extends Controller
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
        BackendMenu::setContext('Ap.Tender', 'reporting', 'report-qualification');
    }

    public function formAfterSave($model)
    {
        $data['description'] = post('Report[report_description]');
        $data['business_field'] = $model->business_field;
        $data['name'] = $model->name;
        $data['invite_hour_start'] = $model->invite_hour_start;
        $data['invite_hour_end'] = $model->invite_hour_end;
        $data['tender_tenants'] = $model->tender_tenants;

        $file = storage_path('reject_pdf/reject_' . strtotime("Today") . $model->id . '.pdf');

        PDF::loadTemplate('ap.tender::pdf.tenant-reject', $data)
            ->save($file);
    }
}
