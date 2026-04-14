<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_checkout', function (Blueprint $table) {
            $table->id('checkoutId');
            $table->unsignedBigInteger('bookingId');
            $table->string('paymentMethod', 50)->nullable();
            $table->dateTime('paymentDate')->nullable();
            $table->double('amount')->default(0);
            $table->string('paymentStatus', 50)->default('unpaid');
            $table->string('transactionId')->nullable();

            $table->foreign('bookingId')->references('bookingId')->on('tbl_booking')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_checkout');
    }
};
