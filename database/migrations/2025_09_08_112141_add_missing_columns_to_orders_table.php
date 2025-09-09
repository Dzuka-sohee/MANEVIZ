<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Tambah kolom yang hilang sesuai dengan controller
            if (!Schema::hasColumn('orders', 'subtotal')) {
                $table->decimal('subtotal', 10, 2)->after('status');
            }
            if (!Schema::hasColumn('orders', 'tax')) {
                $table->decimal('tax', 10, 2)->after('subtotal');
            }
            if (!Schema::hasColumn('orders', 'total')) {
                $table->decimal('total', 10, 2)->after('tax');
            }
            if (!Schema::hasColumn('orders', 'shipping_province')) {
                $table->string('shipping_province')->after('shipping_city');
            }
            if (!Schema::hasColumn('orders', 'billing_name')) {
                $table->string('billing_name')->after('shipping_postal_code');
            }
            if (!Schema::hasColumn('orders', 'billing_email')) {
                $table->string('billing_email')->after('billing_name');
            }
            if (!Schema::hasColumn('orders', 'billing_phone')) {
                $table->string('billing_phone', 20)->after('billing_email');
            }
            if (!Schema::hasColumn('orders', 'billing_address')) {
                $table->text('billing_address')->after('billing_phone');
            }
            if (!Schema::hasColumn('orders', 'billing_city')) {
                $table->string('billing_city')->after('billing_address');
            }
            if (!Schema::hasColumn('orders', 'billing_province')) {
                $table->string('billing_province')->after('billing_city');
            }
            if (!Schema::hasColumn('orders', 'billing_postal_code')) {
                $table->string('billing_postal_code', 10)->after('billing_province');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'subtotal',
                'tax', 
                'total',
                'shipping_province',
                'billing_name',
                'billing_email',
                'billing_phone',
                'billing_address',
                'billing_city',
                'billing_province',
                'billing_postal_code'
            ]);
        });
    }
};