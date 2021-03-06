<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('receipt_no')->nullable();
            $table->decimal('amount', 11, 2);
            $table->string('reference');
            $table->enum('status', ['pending', 'completed', 'successful', 'reversed', 'failed'])->default('pending');
            $table->string('message')->nullable();
            $table->enum('is_notified', ['0', '1'])->default(0);
            $table->integer('attempts')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payouts');
    }
}
