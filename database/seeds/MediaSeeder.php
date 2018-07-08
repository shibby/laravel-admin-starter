<?php

use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $folder = storage_path('app/fake');
        if (!\File::exists($folder)) {
            \File::makeDirectory($folder);
        }

        $faker = \Faker\Factory::create('tr_TR');

        $directoryCount = count(\File::files($folder));

        for ($i = 1; $i <= 50 - $directoryCount; ++$i) {
            $faker->image($folder, 640, 480, 'food');
        }

        $files = \File::files($folder);
        foreach ($files as $file) {
            $path = str_replace(storage_path('app'), '', $file);
            $media = new \App\Model\Media();
            $media->path = $path;
            $media->title = $faker->sentence;
            $media->save();
        }
    }
}
