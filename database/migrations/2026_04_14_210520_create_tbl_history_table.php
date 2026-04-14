<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_history', function (Blueprint $table) {
            $table->id('historyId');
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('tourId')->nullable();
            $table->string('actionType')->nullable();
            $table->dateTime('timestamp')->nullable();

            $table->foreign('userId')->references('userId')->on('tbl_users')->onDelete('cascade');
            $table->foreign('tourId')->references('tourId')->on('tbl_tours')->onDelete('set null');
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_history');
    }
};
