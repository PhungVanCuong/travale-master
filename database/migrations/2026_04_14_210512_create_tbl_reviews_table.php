<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_reviews', function (Blueprint $table) {
            $table->id('reviewId');
            $table->unsignedBigInteger('tourId');
            $table->unsignedBigInteger('userId');
            $table->integer('rating')->default(5);
            $table->text('comment')->nullable();
            $table->dateTime('timestamp')->nullable();

            $table->foreign('tourId')->references('tourId')->on('tbl_tours')->onDelete('cascade');
            $table->foreign('userId')->references('userId')->on('tbl_users')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_reviews');
    }
};
