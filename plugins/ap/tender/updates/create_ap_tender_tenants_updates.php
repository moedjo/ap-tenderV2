<?php namespace Ap\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateApTenderTenantsUpdates extends Migration
{
    public function up()
    {
        Schema::create('ap_tender_tenants_updates', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')->references('id')
            ->on('ap_tender_tenants');

            $table->integer('update_id')->unsigned();
            $table->foreign('update_id')->references('id')
            ->on('ap_tender_updates');


            $table->primary(['tenant_id', 'update_id'], 'tenant_update');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ap_tender_tenants_updates');
    }
}
