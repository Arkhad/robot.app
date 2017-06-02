<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRobotsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('robots', function (Blueprint $table) {
            $table->increments('id'); // PK
            $table->unsignedInteger('category_id')->nullable(); //
            $table->unsignedInteger('user_id')->nullable();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('link', 100)->nullable();
            $table->string('slug', 100)->nullable();
            $table->dateTime('published_at')->nullable();
            $table->enum('status', ['published', 'unpublished'])->default('unpublished'); // chaine de caractères à valeur déterminée
            // category_id attribut de cette table, référencé sur id de la table categories + option sur la clé si on supprime une catégorie alors on mettra NULL pour les anciens
            // id de catégorie se trouvant dans cette table
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL'); // FK
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->tinyInteger('power')->default(0);
            $table->char('type', 5);
            $table->timestamps(); // Eloquent pour le Model de Laravel
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('robots');
    }
}
