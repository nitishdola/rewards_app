<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_points', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('package_id', false, true);
            $table->decimal('min_points', 40, 2);
            $table->decimal('max_points', 40, 2)->nullable();
            $table->decimal('percentage', 10, 2);

            $table->foreign('package_id')->references('id')->on('packages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_points');
    }
}
