<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('lastname_p', 64);
            $table->string('lastname_m', 64);
            $table->unsignedInteger('age');
            $table->string('degree', 128);
            $table->string('email', 128)->unique();
            $table->string('phone', 12)->unique();
            $table->date('birthdate'); 
            $table->foreignId('group_id')->constrained('groups');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
