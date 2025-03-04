<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // // Drop the existing primary key if it exists
            // $table->dropPrimary(['user_id', 'annonce_id']);

            // // Add a new primary key column
            // $table->id()->first();

            // // Add a unique constraint on the combination of user_id, annonce_id, start_date, and end_date
            // $table->unique(['user_id', 'annonce_id', 'start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // // Drop the unique constraint
            // $table->dropUnique(['user_id', 'annonce_id', 'start_date', 'end_date']);

            // // Drop the new primary key column
            // $table->dropColumn('id');

            // // Restore the original primary key
            // $table->primary(['user_id', 'annonce_id']);
        });
    }
}
