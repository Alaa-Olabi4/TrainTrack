<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id(); // id primary key
            $table->foreignId('inquiry_id')->constrained('inquiries')->onDelete('cascade'); // مفتاح أجنبي من جدول الاستفسارات
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // مفتاح أجنبي من جدول المستخدمين
            $table->integer('score'); // الدرجة
            $table->text('feedback_text'); // نص التقييم
            $table->timestamps(); // تاريخ الإنشاء والتعديل
        });
    }

    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
