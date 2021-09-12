<?php namespace Ap\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateApTenderSchedules extends Migration
{
    public function up()
    {
        Schema::create('ap_tender_schedules', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->string('name');
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();

            $table->integer('schedulable_id')->unsigned()->nullable();
            $table->string('schedulable_type')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ap_tender_schedules');
    }
}
