<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Droptables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::dropIfExists('accessories');
        Schema::dropIfExists('ads');
        Schema::dropIfExists('attribute_products');
        Schema::dropIfExists('attribute_types');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('attributes_subcategory');
        Schema::dropIfExists('auction_transactions');
        Schema::dropIfExists('auctions');
        Schema::dropIfExists('b_products');
        Schema::dropIfExists('banner_types');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('barcode_movements');
        Schema::dropIfExists('barcodes');
        Schema::dropIfExists('chats');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('competitions');
        Schema::dropIfExists('coupons');
        Schema::dropIfExists('digital_products');
        Schema::dropIfExists('icons');
        Schema::dropIfExists('links');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('product_color');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('shapes');
        Schema::dropIfExists('sliders');
        Schema::dropIfExists('social_accounts');
        Schema::dropIfExists('social_acounts');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('user_competitions');
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('views');
        Schema::dropIfExists('visits');
        Schema::dropIfExists('wishes');
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
