<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settingEmergency = new Setting;
        $settingEmergency->key = 'emergency';
        $settingEmergency->value = json_encode(['isEmergency' => true, 'emergencyHeader' => 'This is just a test']);
        $settingEmergency->save();

    }
}
