<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSitesUrls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites_urls', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('site_id');
            $table->string('url',255);
            $table->integer('visited')->default(0);
            $table->json('url_headers');
            $table->date('url_headers_date');
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
        Schema::drop('sites_urls');
    }
}
