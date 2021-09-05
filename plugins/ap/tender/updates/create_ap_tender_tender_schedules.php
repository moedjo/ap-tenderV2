<?php namespace Ap\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateApTenderTenantFinances extends Migration
{
    public function up()
    {
        Schema::create('ap_tender_tender_schedules', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->string('name');
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();

            $table->integer('tender_id')->unsigned()->nullable();
            $table->foreign('tender_id')->references('id')
                ->on('ap_tender_tenders');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ap_tender_tender_schedules');
    }
}
