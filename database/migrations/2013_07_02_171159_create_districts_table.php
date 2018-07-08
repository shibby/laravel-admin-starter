<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('slug', 50)->nullable()->index();
            $table->integer('city_id')->unsigned()->index();
            $table->foreign('city_id')->on('cities')->references('id');
            $table->integer('company_count')->default(0);
        });

        $districts = \File::get(database_path('districts.csv'));
        $districts = explode("\n", $districts);
        \DB::beginTransaction();
        $cityId = 0;
        $currentCityId = 0;
        foreach ($districts as $district) {
            $district = explode(',', $district);

            if ($currentCityId != $district[2]) {
                $cityId = $cityId + 1;
                $currentCityId = $district[2];
            }

            $d = new \App\Model\District();
            $d->name = $district[1];
            $d->slug = str_slug($district[1]);
            $d->city_id = $cityId;
            $d->save();
        }
        \DB::commit();
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
