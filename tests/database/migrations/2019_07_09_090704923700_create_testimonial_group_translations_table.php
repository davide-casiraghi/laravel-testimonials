<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialGroupTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('testimonial_group_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('testimonial_group_id')->unsigned();

            $table->string('title')->nullable();

            $table->string('locale')->index();
            $table->unique(['testimonial_group_id', 'locale']);
            $table->foreign('testimonial_group_id', 'tg_id_foreign')->references('id')->on('testimonial_groups')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('testimonial_group_translations');
    }
}
