<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rights_holder_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rights_holder_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign("rights_holder_id")->references("id")->on("rights_holders")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rights_holder_users');
    }
};
