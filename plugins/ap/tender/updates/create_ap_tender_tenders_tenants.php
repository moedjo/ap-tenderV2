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

            $table->boolean('is_envelope1')->default(false);
            $table->boolean('is_envelope2')->default(false);
            $table->boolean('is_payment_rfp')->default(false);


            $table->boolean('is_candidate_winner')->default(false);
            $table->boolean('is_winner')->default(false);

            $table->unsignedDecimal('total_price',15,0)->nullable();

            $table->string('invite_name')->nullable();
            $table->string('invite_description')->nullable();
            $table->string('invite_location')->nullable();
            $table->string('invite_pic_phone_number')->nullable();
            $table->timestamp('invite_date')->nullable();
            $table->timestamp('invite_hour_start')->nullable();
            $table->timestamp('invite_hour_end')->nullable();


            $table->string('invite_negotiation_name')->nullable();
            $table->string('invite_negotiation_description')->nullable();
            $table->string('invite_negotiation_location')->nullable();
            $table->string('invite_negotiation_pic_phone_number')->nullable();
            $table->timestamp('invite_negotiation_date')->nullable();
            $table->timestamp('invite_negotiation_hour_start')->nullable();
            $table->timestamp('invite_negotiation_hour_end')->nullable();


            $table->unsignedDecimal('envelope1_score',15,2)->nullable();
            $table->unsignedDecimal('envelope2_score',15,2)->nullable();


            $table->unique(['tender_id','tenant_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ap_tender_tenders_tenants');
    }
}
