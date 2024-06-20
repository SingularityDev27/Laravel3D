<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teacher_subject_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('teachers');
            $table->foreignId('subject_id')->constrained('subjects');
            $table->foreignId('group_id')->constrained('groups');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_subject_group');
    }
};
