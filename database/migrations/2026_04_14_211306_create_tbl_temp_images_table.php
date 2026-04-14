<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_temp_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tourId');
            $table->string('imageURL');
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_temp_images');
    }
};
