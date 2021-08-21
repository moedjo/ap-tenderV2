<?php namespace Ap\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateApTenderUpdates extends Migration
{
    public function up()
    {
        Schema::create('ap_tender_updates', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('sort_order')->default(0);

            $table->string('field');
            $table->string('type');

            $table->text('description');
            
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ap_tender_updates');
    }
}
