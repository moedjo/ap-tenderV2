<?php namespace Ap\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateApTenderTenantsBusinessFields extends Migration
{
    public function up()
    {
        Schema::create('ap_tender_tenants_business_fields', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('tenant_id')->unsigned();
            $table->integer('business_field_id')->unsigned();
            $table->primary(['tenant_id', 'business_field_id'], 'tenant_business_field');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ap_tender_tenants_business_fields');
    }
}
