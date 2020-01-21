<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('testimonial_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quotes_color')->nullable();
            $table->string('title_alignment')->nullable();
            $table->integer('max_characters')->nullable();
            $table->boolean('show_title')->default(0)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('testimonial_groups');
    }
}
