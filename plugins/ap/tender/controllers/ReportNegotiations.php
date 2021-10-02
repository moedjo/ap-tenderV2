<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\TenderTenant;
use Ap\Tender\Models\Tender;
use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Mail;
use Renatio\DynamicPDF\Classes\PDF;

class ReportNegotiations extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'ap_tender_access_tenders', 'ap_tender_is_finance', 'ap_tender_is_legal', 'ap_tender_is_commercial'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'reporting', 'report-negotiation');
    }

    public function onPreview($model)
    {
        $this->addJs('/modules/backend/formwidgets/richeditor/assets/js/build-plugins-min.js');
        $tender_tenant = TenderTenant::find($model);

        $data['tender_tenant'] = $tender_tenant;
        $day = date('D');
        $dayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );
        $data['hari'] = $dayList[$day];

        $storagePath =  storage_path('app/uploads/');
        $pdf_file_name =  'ba_negosiasi.pdf';
        $pdf_file_name_directory =  $storagePath . $pdf_file_name;

        PDF::loadTemplate('ap.tender::pdf.report-form1', $data)->save($pdf_file_name_directory);

        return $baseUrl = url('storage/app/uploads') . '/' . $pdf_file_name;
    }

    public function onSendEmailForm()
    {
        $this->addCss('/modules/backend/formwidgets/fileupload/assets/css/fileupload.css');
        $config = $this->makeConfig('$/ap/tender/models/report/send_email_fields.yaml');

        $config->model = new \Ap\Tender\Models\TenderTenant;

        $widget = $this->makeWidget('Backend\Widgets\Form', $config);

        $this->vars['recordId'] = $this->params[0];
        $this->vars['widget'] = $widget;

        $tender_tenant = TenderTenant::find($this->params[0]);
        $tender = Tender::findOrFail($tender_tenant->tender_id);

        $data['tender'] = $tender;
        $storagePath =  storage_path('app/uploads/');
        $pdf_file_name =  'ba_negosiasi.pdf';
        $pdf_file_name_directory =  $storagePath . $pdf_file_name;
        $baseUrl = url('storage/app/uploads') . '/' . $pdf_file_name;

        $this->vars['file_name'] = $pdf_file_name;
        $this->vars['file'] = $baseUrl;

        PDF::loadTemplate('ap.tender::pdf.report-form1', $data)->save($pdf_file_name_directory);

        return $this->makePartial('sendEmail');
    }

    public function onSendEmail()
    {
        $this->asExtension('FormController')->update_onSave(post('record_id'));

        $data = post();

        Mail::send('ap.tender::mail.tenant-invite2', $data, function ($message) {
            $message->to('mrezza.ramadhan@gmail.com', 'John Doe');
            $message->cc('jmrezza.ramadhan@gmail.com', 'John Doe');
            $message->bcc('mrezza.ramadhan@gmail.com', 'John Doe');
            $message->subject('Berita Acara Negosiasi Langsung');
            $message->attach(storage_path('app/uploads/') . post('file_name'));
        });

        return $this->listRefresh();
    }
}
