<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_invoice', function (Blueprint $table) {
            $table->id('invoiceId');
            $table->unsignedBigInteger('bookingId');
            $table->double('amount')->default(0);
            $table->date('dateIssued')->nullable();
            $table->text('details')->nullable();

            $table->foreign('bookingId')->references('bookingId')->on('tbl_booking')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_invoice');
    }
};
