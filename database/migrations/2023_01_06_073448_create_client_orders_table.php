<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_name')->unique();
            $table->date('date');
            $table->date('delivery_date');

            $table->foreignId("client_id")->constrained("clients")->cascadeOnUpdate();
            $table->string('order_number')->unique();
            $table->foreignId("department_id")->constrained("departments")->cascadeOnUpdate();
            $table->foreignId("payments_terms_id")->constrained("payment_terms")->cascadeOnUpdate();
            $table->foreignId("currency_id")->constrained("currencies")->cascadeOnUpdate();


            $table->double('po_total_value');
            $table->double('po_net_value');
            $table->double('po_sales_taxes_value');
            $table->double('po_add_and_discount_taxes_value');
            $table->json('po_attachments')->nullable();
            $table->mediumText('notes')->nullable();
            $table->enum('status',['In Progress','Delayed','Invoiced','Good Receive'])->default('In Progress');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_orders');
    }
}
