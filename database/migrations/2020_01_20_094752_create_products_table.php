<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price')->default('0.00');
            $table->decimal('average_rating')->default('0.00');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')
                ->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
