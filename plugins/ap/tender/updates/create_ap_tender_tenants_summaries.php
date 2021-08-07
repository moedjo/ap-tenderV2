<?php namespace Ap\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateApTenderTenantsSummaries extends Migration
{
    public function up()
    {
        Schema::create('ap_tender_tenants_summaries', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('tenant_id')->unsigned();
            $table->integer('summary_id')->unsigned();
            $table->primary(['tenant_id', 'summary_id'], 'tenant_summary');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ap_tender_tenants_summaries');
    }
}
