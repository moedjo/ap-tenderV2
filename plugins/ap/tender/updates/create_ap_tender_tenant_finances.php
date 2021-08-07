<?php namespace Ap\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateApTenderTenantFinances extends Migration
{
    public function up()
    {
        Schema::create('ap_tender_tenant_finances', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->unsignedInteger('year');
            $table->unsignedDecimal('total_income',15,0)->nullable();

            $table->integer('tenant_id')->unsigned()->nullable();
            $table->foreign('tenant_id')->references('id')
                ->on('ap_tender_tenants');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ap_tender_tenant_finances');
    }
}
