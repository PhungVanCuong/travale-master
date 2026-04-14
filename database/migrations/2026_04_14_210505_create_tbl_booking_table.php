<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_booking', function (Blueprint $table) {
            $table->id('bookingId');
            $table->unsignedBigInteger('tourId');
            $table->unsignedBigInteger('userId');
            $table->dateTime('bookingDate')->nullable();
            $table->integer('numAdults')->default(1);
            $table->integer('numChildren')->default(0);
            $table->double('totalPrice')->default(0);
            $table->string('paymentStatus', 50)->default('unpaid');
            $table->string('bookingStatus', 50)->default('p')->comment('p: pending, f: finished, c: cancelled');
            $table->text('specialRequests')->nullable();

            $table->foreign('tourId')->references('tourId')->on('tbl_tours')->onDelete('cascade');
            $table->foreign('userId')->references('userId')->on('tbl_users')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_booking');
    }
};
