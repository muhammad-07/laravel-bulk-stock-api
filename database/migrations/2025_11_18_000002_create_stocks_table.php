<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table){
            $table->id();
            $table->string('item_code');
            $table->string('item_name');
            $table->integer('quantity')->default(0);
            $table->string('location')->nullable();
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->date('in_stock_date');
            $table->enum('status',['pending','in-stock','out-of-stock'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
