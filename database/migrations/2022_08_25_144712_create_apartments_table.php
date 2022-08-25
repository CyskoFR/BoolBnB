<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            //fk users
             $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // fk categories **** da fixare cascade => set null ****
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->tinyInteger('rooms')->unsigned(); // da 0 a 255
            $table->tinyInteger('beds')->unsigned();
            $table->tinyInteger('bathrooms')->unsigned();
            $table->text('description');
            $table->smallInteger('size')->unsigned(); // fino a 65k m2
            $table->string('full_address');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('image');
            $table->boolean('is_visible');
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
        Schema::table('apartments', function(Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['category_id']);
            $table->dropIfExists('apartments');
        });
    }
}
