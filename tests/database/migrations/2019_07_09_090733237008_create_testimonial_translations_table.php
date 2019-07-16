<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('testimonial_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('testimonial_id')->unsigned();

            $table->string('name')->nullable();
            $table->text('body')->nullable();
            $table->string('profession')->nullable();

            $table->string('locale')->index();
            $table->unique(['testimonial_id', 'locale']);
            $table->foreign('testimonial_id')->references('id')->on('testimonials')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('testimonial_translations');
    }
}
