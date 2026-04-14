<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tbl_contact', function (Blueprint $table) {
            $table->id('contactId');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('message')->nullable();
            $table->char('isReply', 1)->default('n');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('tbl_contact');
    }
};
