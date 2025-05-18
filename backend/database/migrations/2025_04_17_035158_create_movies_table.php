<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_movies_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('thumbnail')->nullable();
            $table->string('link')->nullable();

            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
