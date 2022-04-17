<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('store_id')->constrained('stores');
            $table->foreignId('release_id')->constrained('releases');
            $table->foreignId('order_status_id')->nullable()->constrained('orders_status');
            $table->foreignId('package_status_id')->nullable()->constrained('packages_status');
            $table->foreignId('order_priority_id')->default(1)->constrained('orders_priorities');
            $table->decimal('price', 10, 2);
            $table->foreignId('currency_id')->constrained('currencies');
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
        Schema::dropIfExists('orders');
    }
}
