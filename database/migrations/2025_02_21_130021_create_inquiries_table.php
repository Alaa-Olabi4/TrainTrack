<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiriesTable extends Migration
{
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('assignee_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->foreignId('cur_status_id')->nullable()->constrained('statuses')->onDelete('cascade');
            $table->string('title');
            $table->longText('body');
            $table->longText('response')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inquiries');
    }
}
