<?php

use App\Models\Etat;
use App\Models\Visibilite;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('sujet');
            $table->string('image')->nullable();
            $table->text('contenu');
            $table->timestamps();
            $table->softDeletes();

            $table->foreignIdFor(Visibilite::class);
            $table->foreignIdFor(Etat::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
