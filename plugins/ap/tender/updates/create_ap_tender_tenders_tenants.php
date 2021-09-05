<?php namespace Ap\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateApTenderTendersTenants extends Migration
{
    public function up()
    {
        Schema::create('ap_tender_tenders_tenants', function($table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();


            $table->integer('tender_id')->unsigned();
            $table->foreign('tender_id')->references('id')
            ->on('ap_tender_tenders');

            $table->integer('tenant_id')->unsigned();
            $table->foreign('tenant_id')->references('id')
            ->on('ap_tender_tenants');

            $table->string('status')->nullable();

            $table->unsignedDecimal('total_price',15,0)->nullable();


            $table->unique(['tender_id','tenant_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ap_tender_tenders_tenants');
    }
}
