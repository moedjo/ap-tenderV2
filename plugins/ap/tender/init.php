<?php

Event::listen('tenant.short_form', function ($tenant) {
   $tenant->load('business_entity');
   Mail::queue('ap.tender::mail.tenant-short-form', $tenant->toArray(), function ($message) use ($tenant) {
      $message->to($tenant->email, $tenant->name);
   });
   
});


Event::listen('tenant.pre_register', function ($tenant) {

   Mail::queue('ap.tender::mail.tenant-pre-register', $tenant->toArray(), function ($message) use ($tenant) {
      $tenant->load('business_entity');
      $message->to($tenant->email, $tenant->name);
   });
   
});

Event::listen('company.after.register', function ($company) {

   Mail::queue('ap.tender::mail.company-after-register', $company->toArray(), function ($message) use ($company) {
      $message->to($company->email, $company->name);
   });
   
});


Event::listen('tenant.invite', function ($company) {

   $company->load('business_entity');
   Mail::queue('ap.tender::mail.tenant-invite', $company->toArray(), function ($message) use ($company) {
      $message->to($company->email, $company->name);
   });
   
});

Event::listen('tenant.short.listed', function ($company) {

   $company->load('business_entity');
   Mail::queue('ap.tender::mail.tenant-short-listed', $company->toArray(), function ($message) use ($company) {
      $message->to($company->email, $company->name);
   });
   
});


Event::listen('tenant.reject', function ($company) {

   $company->load('verifications');
   $company->load('business_entity');
   Mail::queue('ap.tender::mail.tenant-reject', $company->toArray(), function ($message) use ($company) {
      $message->to($company->email, $company->name);
   });
   
});



