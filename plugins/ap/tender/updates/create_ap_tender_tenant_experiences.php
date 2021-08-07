<?php

namespace Ap\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateApTenderTenantExperiences extends Migration
{
    public function up()
    {
        Schema::create('ap_tender_tenant_experiences', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->string('name');

            $table->timestamp('operational_hour_start')->nullable();
            $table->timestamp('operational_hour_end')->nullable();

            $table->timestamp('cooperation_period_start')->nullable();
            $table->timestamp('cooperation_period_end')->nullable();

            $table->unsignedDecimal('total_income', 15, 0)->nullable();

            $table->integer('region_id')->unsigned()->nullable();
            $table->foreign('region_id')->references('id')
                ->on('ap_tender_regions');

            $table->integer('region_area')->unsigned()->nullable();

            $table->integer('tenant_id')->unsigned()->nullable();
            $table->foreign('tenant_id')->references('id')
                ->on('ap_tender_tenants');

            $table->integer('business_field_id')->unsigned();
            $table->foreign('business_field_id')->references('id')
            ->on('ap_tender_business_fields');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ap_tender_tenant_experiences');
    }
}
