<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class JelliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        if (\App::environment('local', 'staging')) {
            // Clear existing data
            $this->clearData();
        }

        $this->call('MaterialSeeder');
        $this->call('UserSeeder');
        $this->call('RealmSeeder');

        Model::reguard();
    }

    private function clearData()
    {

        // Clear images
        // $files = glob('public/images/*'); // get all file names
        // foreach($files as $file){ // iterate files
        //     if(is_file($file))
        //         unlink($file); // delete file
        // }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();
        DB::table('user_material')->truncate();
        DB::table('messages')->truncate();
        DB::table('settings')->truncate();
        DB::table('minions')->truncate();
        DB::table('minion_material')->truncate();
        DB::table('realms')->truncate();
        DB::table('zones')->truncate();
        DB::table('zone_enemy')->truncate();
        DB::table('zone_material')->truncate();
        DB::table('enemies')->truncate();
        DB::table('enemy_material')->truncate();
        DB::table('incursions')->truncate();
        DB::table('incursion_minion')->truncate();
        DB::table('encounters')->truncate();
        DB::table('materials')->truncate();
        DB::table('material_effective')->truncate();
        DB::table('material_ineffective')->truncate();
        DB::table('modifiers')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
