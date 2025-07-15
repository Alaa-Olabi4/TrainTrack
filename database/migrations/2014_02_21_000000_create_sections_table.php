<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('division')->nullable();
            $table->string('email')->unique();
            $table->softDeletes();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
