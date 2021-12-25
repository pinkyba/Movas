<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaApplicationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_application_details', function (Blueprint $table) {
            $table->id();
            $table->integer('visa_application_head_id');
            $table->integer('nationality_id');
            $table->text('PersonName');
            $table->text('PassportNo');
            $table->date('StayAllowDate');
            $table->date('StayExpireDate');
            $table->integer('person_type_id');
            $table->date('DateOfBirth');
            $table->text('Gender');
            $table->integer('visa_type_id')->nullable();
            $table->integer('stay_type_id');
            $table->integer('labour_card_type_id');
            $table->integer('labour_card_duration_id');
            $table->integer('relation_ship_id')->nullable();
            $table->text('Remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visa_application_details');
    }
}
