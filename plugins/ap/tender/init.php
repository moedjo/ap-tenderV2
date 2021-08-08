<?php

use Renatio\DynamicPDF\Classes\PDF;

Event::listen('tenant.short_form', function ($tenant) {
   $tenant->load('business_entity');
   Mail::queue('ap.tender::mail.tenant-short-form', $tenant->toArray(), function ($message) use ($tenant) {
      $message->to($tenant->email, $tenant->name);
   });
});


Event::listen('tenant.pre_register', function ($tenant) {
   $tenant->load('business_entity');
   Mail::queue('ap.tender::mail.tenant-pre-register', $tenant->toArray(), function ($message) use ($tenant) {
      $tenant->load('business_entity');
      $message->to($tenant->email, $tenant->name);
   });
});

Event::listen('tenant.register', function ($tenant) {

   $tenant->load('user');
   Mail::queue('ap.tender::mail.tenant-register', $tenant->toArray(), function ($message) use ($tenant) {
      $message->to($tenant->email, $tenant->name);
   });
});


Event::listen('tenant.invite', function ($tenant) {

   $tenant->load('business_entity');
   Mail::queue('ap.tender::mail.tenant-invite', $tenant->toArray(), function ($message) use ($tenant) {
      $message->to($tenant->email, $tenant->name);
   });
});

Event::listen('tenant.short_listed', function ($tenant) {

   $tenant->load('business_entity');
   Mail::queue('ap.tender::mail.tenant-short-listed', $tenant->toArray(), function ($message) use ($tenant) {
      $message->to($tenant->email, $tenant->name);
   });
});


Event::listen('tenant.reject', function ($tenant) {

   $tenant->load('verifications');
   $tenant->load('business_entity');

   $data = $tenant->toArray();

   $file = storage_path('reject_pdf/reject_' . $tenant->id . '.pdf');

   PDF::loadTemplate('ap.tender::pdf.tenant-reject', $data)
      ->save($file);

   Mail::queue('ap.tender::mail.tenant-reject', $data, function ($message) use ($tenant, $file) {
      $message->to($tenant->email, $tenant->name);
      $message->attach($file);
   });
});
