<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_admin', function (Blueprint $table) {
            $table->id('adminId');
            $table->string('username');
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('role', 50)->default('admin');
            $table->dateTime('createdDate')->nullable();
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_admin');
    }
};
