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
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('slug');
            $table->integer('brand_id');
            $table->integer('type_id');
            $table->integer('sub_type_id');
            $table->string('thumbnail')->nullable();
            $table->integer('main_price');
            $table->integer('offer_price')->nullable();
            $table->text('description')->nullable();
            $table->integer('total_stock')->nullable();
            $table->string('status');
            $table->string('is_published');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
