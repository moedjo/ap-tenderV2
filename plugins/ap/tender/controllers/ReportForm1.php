<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\TenderTenant;
use Backend\Classes\Controller;
use BackendMenu;
use Exception;
use Illuminate\Support\Facades\Mail;
use Renatio\DynamicPDF\Classes\PDF;

class ReportForm1 extends Controller
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
        BackendMenu::setContext('Ap.Tender', 'reporting', 'report-form1');
    }

    public function print($model)
    {
        $tender = TenderTenant::findOrFail($model);

        $data['tender_tenant'] = $tender;
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

        return PDF::loadTemplate('ap.tender::pdf.report-form1', $data)->stream();
    }

    public function onSendEmailForm()
    {
        $this->addCss('/modules/backend/formwidgets/fileupload/assets/css/fileupload.css');
        $config = $this->makeConfig('$/ap/tender/models/report/send_email_fields.yaml');

        $config->model = new \Ap\Tender\Models\TenderTenant;

        $widget = $this->makeWidget('Backend\Widgets\Form', $config);

        $pdf = $this->savePdf($this->params[0]);

        $this->vars['recordId'] = $this->params[0];
        $this->vars['widget'] = $widget;
        $this->vars['file_name'] = $pdf['pdf_file_name'];
        $this->vars['file'] = url('storage/app/uploads') . '/' . $pdf['pdf_file_name'];

        return $this->makePartial('sendemail');
    }

    protected function savePdf($model)
    {
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
        $pdf_file_name =  $name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', "BERITA ACARA NEGOSIASI LANGSUNG"))) . '_' . date('H') . '.pdf';
        $pdf_file_name_directory =  $storagePath . $pdf_file_name;

        PDF::loadTemplate('ap.tender::pdf.report-form1', $data)->save($pdf_file_name_directory);

        return [
            'pdf_file_name' => $pdf_file_name
        ];
    }

    public function onSendEmail()
    {
        $this->asExtension('FormController')->update_onSave(post('record_id'));

        $data = post();

        Mail::send('ap.tender::mail.report', $data, function ($message) use ($data) {
            $email_to = [];
            $email_cc = [];
            $email_bcc = [];

            if (!empty($data['email_to']))
                $email_to = explode(',', $data['email_to']);

            if (!empty($data['email_cc']))
                $email_cc = explode(',', $data['email_cc']);

            if (!empty($data['email_bcc']))
                $email_bcc = explode(',', $data['email_bcc']);

            $message->to($email_to);
            $message->cc($email_cc);
            $message->bcc($email_bcc);
            $message->subject('Berita Acara Negosiasi Langsung');
            $message->attach(storage_path('app/uploads/') . post('file_name'));
        });


        return $this->listRefresh();
    }
}
