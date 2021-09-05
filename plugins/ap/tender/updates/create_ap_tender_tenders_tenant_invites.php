<?php namespace Ap\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateApTenderTendersTenantInvites extends Migration
{
    public function up()
    {
        Schema::create('ap_tender_tenders_tenant_invites', function($table)
        {
            $table->engine = 'InnoDB';


            $table->integer('tender_id')->unsigned();
            $table->foreign('tender_id')->references('id')
            ->on('ap_tender_tenders');

            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')->references('id')
            ->on('ap_tender_tenants');


            $table->primary(['tender_id', 'tenant_id'], 'tender_tenant_invite');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ap_tender_tenders_tenant_invites');
    }
}
