<?php namespace Ap\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateApTenderTenders extends Migration
{
    public function up()
    {
        Schema::create('ap_tender_tenders', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->string('status')->nullable();

            $table->string('name')->nullable();
            $table->string('package')->nullable();
            $table->text('description')->nullable();

            $table->integer('business_field_id')->unsigned()->nullable();
            $table->foreign('business_field_id')->references('id')
                ->on('ap_tender_business_fields');

            $table->integer('airport_id')->unsigned()->nullable();
            $table->foreign('airport_id')->references('id')
                ->on('ap_tender_airports');

            $table->json('rooms')->nullable();

            $table->string('pic_full_name')->nullable();
            $table->string('pic_phone_number')->nullable();
            $table->string('pic_email')->nullable();

            $table->string('invite_name')->nullable();
            $table->string('invite_description')->nullable();
            $table->string('invite_location')->nullable();
            $table->string('invite_pic_phone_number')->nullable();
            $table->timestamp('invite_date')->nullable();
            $table->timestamp('invite_hour_start')->nullable();
            $table->timestamp('invite_hour_end')->nullable();

        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ap_tender_tenders');
    }
}
