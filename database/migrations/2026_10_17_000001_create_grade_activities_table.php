<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradeActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('grade_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->string('type');
            $table->decimal('grade', 5, 2);
            $table->date('date');
            $table->timestamps();

            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('grade_activities');
    }
}
