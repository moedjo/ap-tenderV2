<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tender;
use Backend\Classes\Controller;
use BackendMenu;
use Renatio\DynamicPDF\Classes\PDF;
use Illuminate\Support\Facades\Mail;

class ReportForm6 extends Controller
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
        BackendMenu::setContext('Ap.Tender', 'reporting', 'report-form6');
    }

    public function print($model)
    {
        $tender = Tender::findOrFail($model);

        $data['tender'] = $tender;
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

        return PDF::loadTemplate('ap.tender::pdf.report-form6', $data)
        ->stream();
    }

    public function onSendEmailForm()
    {
        $this->addCss('/modules/backend/formwidgets/fileupload/assets/css/fileupload.css');
        $config = $this->makeConfig('$/ap/tender/models/report/send_email_fields.yaml');

        $config->model = new \Ap\Tender\Models\Tender;

        $widget = $this->makeWidget('Backend\Widgets\Form', $config);

        $pdf = $this->savePdf($this->params[0]);

        $this->vars['recordId'] = $this->params[0];
        $this->vars['widget'] = $widget;
        $this->vars['file_name'] = $pdf['pdf_file_name'];
        $this->vars['file'] = url('storage/app/uploads/report') . '/' . $pdf['pdf_file_name'];

        return $this->makePartial('send_email');
    }

    protected function savePdf($model)
    {
        $tender_tenant = Tender::find($model);

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

        $storagePath =  storage_path('app/uploads/report/');
        $pdf_file_name =  $name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', "BERITA ACARA HASIL PENILAIAN ENVELOPE I"))) . '_' . date('H') . '.pdf';
        $pdf_file_name_directory =  $storagePath . $pdf_file_name;

        PDF::loadTemplate('ap.tender::pdf.report-form6', $data)->save($pdf_file_name_directory);

        return [
            'pdf_file_name' => $pdf_file_name
        ];
    }

    public function onSendEmail()
    {
        $data = post();

        Mail::send('ap.tender::mail.report', $data, function ($message) use ($data) {
            $email_to = [];
            $email_cc = [];
            $email_bcc = [];

            if (!empty($data['email_to']))
                $email_to = explode(',', preg_replace('/\s+/','',$data['email_to']));

            if (!empty($data['email_cc']))
                $email_cc = explode(',', preg_replace('/\s+/', '', $data['email_cc']));

            if (!empty($data['email_bcc']))
                $email_bcc = explode(',', preg_replace('/\s+/', '', $data['email_bcc']));

            $message->to($email_to);
            $message->cc($email_cc);
            $message->bcc($email_bcc);
            $message->subject('Berita Acara Hasil Penilaian Envelope I');
            $message->attach(storage_path('app/uploads/report/') . post('file_name'));
        });

        return $this->listRefresh();
    }
}
