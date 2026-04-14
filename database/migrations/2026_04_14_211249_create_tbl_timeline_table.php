<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_timeline', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tourId');
            $table->string('day')->nullable();
            $table->text('description')->nullable();

            $table->foreign('tourId')->references('tourId')->on('tbl_tours')->onDelete('cascade');
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_timeline');
    }
};
