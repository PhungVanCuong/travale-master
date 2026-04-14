<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_promotion', function (Blueprint $table) {
            $table->string('promotionID', 50)->primary();
            $table->string('description')->nullable();
            $table->double('discount')->default(0);
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->integer('quantity')->default(100);
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_promotion');
    }
};
