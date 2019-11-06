<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('products_id');
            $table->string('user_id');
            $table->string('fullname');
            $table->integer('qty');
            $table->string('email1');
            $table->string('email2')->nullable();
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('country');
            $table->string('city_province');
            $table->string('zip');
            $table->string('_token');
            $table->float('subtotal');
            $table->float('total');
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
        Schema::dropIfExists('products_user');
    }
}
