<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained();
            $table->string('page')->nullable();
            $table->string('text');
            $table->string('rule');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->unique([
                'domain_id',
                'page',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('popups');
    }
};
