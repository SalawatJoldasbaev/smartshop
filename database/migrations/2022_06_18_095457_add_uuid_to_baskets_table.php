<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up():void
    {
        Schema::table('baskets', function (Blueprint $table) {
            $table->uuid()->after('status')->nullable()->unique();
        });
    }

    public function down():void
    {
        Schema::table('baskets', function (Blueprint $table) {
            //
        });
    }
};