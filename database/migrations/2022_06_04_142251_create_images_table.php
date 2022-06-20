<?php

use App\Models\Upload;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Upload::class)->constrained('uploads');
            $table->string('hash');
            $table->string('disk');
            $table->string('path');
            $table->string('url')->nullable(true);
            $table->timestamp('uploaded_at')->nullable(true);
            $table->timestamps();
        });
    }
};
