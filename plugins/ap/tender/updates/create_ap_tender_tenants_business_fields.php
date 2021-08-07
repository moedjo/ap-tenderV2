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
            $table->foreign('tenant_id')->references('id')
            ->on('ap_tender_tenants');


            $table->integer('business_field_id')->unsigned();
            $table->foreign('business_field_id')->references('id')
            ->on('ap_tender_business_fields');


            $table->primary(['tenant_id', 'business_field_id'], 'tenant_business_field');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ap_tender_tenants_business_fields');
    }
}
