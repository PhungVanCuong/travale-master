<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_tours', function (Blueprint $table) {
            $table->id('tourId');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('quantity')->default(50);
            $table->double('priceAdult')->default(0);
            $table->double('priceChild')->default(0);
            $table->string('destination')->nullable();
            $table->char('domain', 1)->default('n')->comment('b: Bắc, t: Trung, n: Nam');
            $table->boolean('availability')->default(1);
            $table->string('time', 100)->default('1 Ngày');
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_tours');
    }
};
