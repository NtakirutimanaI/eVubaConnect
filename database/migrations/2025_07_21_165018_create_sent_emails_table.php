<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentEmailsTable extends Migration
{
    public function up()
    {
        Schema::create('sent_emails', function (Blueprint $table) {
            $table->id();
            $table->string('to_email');
            $table->string('subject');
            $table->longText('body');
            $table->json('attachments')->nullable(); // JSON array of filenames or paths
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sent_emails');
    }
}
