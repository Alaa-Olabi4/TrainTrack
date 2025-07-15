<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // مفتاح رئيسي
            $table->foreignId('inquiry_id')->constrained('inquiries')->onDelete('cascade'); // مفتاح أجنبي من جدول الاستفسارات
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // مفتاح أجنبي من جدول المستخدمين
            $table->string('message'); // نص الرسالة
            $table->enum('status', ['unread', 'read'])->default('unread'); // حالة الإشعار
            $table->timestamps(); // تاريخ الإنشاء والتعديل
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
