<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("payments", function (Blueprint $table) {
            $table->id();
            $table->string("trx");
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->foreignId("cart_id")->constrained()->onDelete("cascade");
            $table->enum("status", ["Paid", "Unpaid"])->default("Unpaid");
            $table->string("snap_token")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("payments");
    }
};
