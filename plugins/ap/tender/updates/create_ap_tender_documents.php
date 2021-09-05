<?php namespace Ap\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateApTenderDocuments extends Migration
{
    public function up()
    {
        Schema::create('ap_tender_documents', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->string('name');

            $table->integer('tender_tenant')->unsigned()->nullable();
            // $table->foreign('tender_tenant')->references('id')
            //     ->on('ap_tender_tenders');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ap_tender_tender_tenant_documents');
    }
}
