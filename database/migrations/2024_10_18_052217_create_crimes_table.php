<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrimesTable extends Migration
{
    public function up()
    {
        Schema::create('crimes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('details'); // Add the 'details' column here
            $table->foreignId('zilla_id')->constrained('zillas')->onDelete('cascade');
            $table->foreignId('thana_id')->constrained('thanas')->onDelete('cascade');
            $table->foreignId('union_id')->constrained('unions')->onDelete('cascade');
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crimes');
    }
}
