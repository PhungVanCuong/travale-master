<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id('userId');
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->string('phoneNumber', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('ipAddress', 50)->nullable();
            $table->boolean('isActive')->default(1);
            $table->string('status', 50)->default('active');
            $table->dateTime('createdDate')->nullable();
            $table->dateTime('updatedDate')->nullable();
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_users');
    }
};
