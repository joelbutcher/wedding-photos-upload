<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index('uploads_uuid_index');
            $table->string('name');
            $table->string('email')->index('uploads_email_index');
            $table->string('comment')->nullable(true);
            $table->timestamps();
        });
    }
};
