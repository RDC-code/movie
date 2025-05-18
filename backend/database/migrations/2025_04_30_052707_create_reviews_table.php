<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_reviews_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
  // database/migrations/xxxx_xx_xx_create_reviews_table.php
public function up()
{
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('movie_id')->constrained()->onDelete('cascade');
        $table->tinyInteger('rating'); // star rating 1-5
        $table->text('review_text')->nullable();  // can be null for star only
        $table->timestamps();
    });
}



    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
