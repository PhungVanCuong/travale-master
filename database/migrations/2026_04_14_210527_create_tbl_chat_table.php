<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_chat', function (Blueprint $table) {
            $table->id('chatID');
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('adminId')->nullable();
            $table->text('messages');
            $table->boolean('readStatus')->default(0);
            $table->dateTime('createdDate')->nullable();
            $table->string('ipAddress', 50)->nullable();

            $table->foreign('userId')->references('userId')->on('tbl_users')->onDelete('cascade');
            $table->foreign('adminId')->references('adminId')->on('tbl_admin')->onDelete('set null');
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_chat');
    }
};
