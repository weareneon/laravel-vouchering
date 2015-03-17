<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherEntriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('voucher_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('hash')->unique();
            $table->integer('campaign_id');
            $table->boolean('is_redeemed')->default('0');
            $table->datetime('redeemed_at')->default('0000-00-00 00:00:00');
            $table->boolean('is_expired')->default('0');
            $table->datetime('expired_at')->default('0000-00-00 00:00:00');
            $table->boolean('is_valid')->default('1');

            $table->index('hash');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('voucher_entries');
	}

}
