<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_images', function (Blueprint $table) {
            $table->id('imageId');
            $table->unsignedBigInteger('tourId');
            $table->string('imageURL');
            $table->string('description')->nullable();
            $table->dateTime('uploadDate')->nullable();

            $table->foreign('tourId')->references('tourId')->on('tbl_tours')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_images');
    }
};
