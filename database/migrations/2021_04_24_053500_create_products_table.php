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
            $table->string('product_name');
            $table->longText('product_description')->nullable();
            $table->string('product_image')->nullable();
            $table->string('sku')->unique();
            $table->string('actual_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->bigInteger('brand_id')->default(0);
            $table->bigInteger('qty')->default(0);
            $table->enum('status', ['1', '0'])->default('1');
            $table->bigInteger('created_by')->nullable();
            $table->timestamps();
        });


        Schema::create('product_galleries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->default(0);
            $table->string('image_path');
            $table->timestamps();
        });

        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('attribute_id')->default(0);
            $table->bigInteger('product_id')->default(0);
            $table->bigInteger('language_id')->default(1);
            $table->string('attribute_value');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->bigInteger('parent_id')->default(0);
            $table->bigInteger('created_by')->nullable();
            $table->timestamps();
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('attribute_name')->comment('Storage,RAM,ROM,etc..');
            $table->bigInteger('created_by')->nullable();
            $table->timestamps();
        });

        Schema::create('categorie_attributes', function (Blueprint $table) {
            $table->bigInteger('categorie_id');
            $table->bigInteger('attribute_id');
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->bigInteger('created_by')->nullable();
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
        Schema::drop('product_galleries');
        Schema::dropIfExists('product_attributes');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('categorie_attributes');
        Schema::dropIfExists('brands');

    }
}
