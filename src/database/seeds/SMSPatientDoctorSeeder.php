<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Patient;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SMSPatientDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $companyNumber = config('company.phone', '+380123456789');
        
        $patient = Patient::first();
        $users = User::take(3)->get();

        $patientPhoneNumber = $patient->cell_phone ?? $patient->home_phone ?? $patient->work_phone;

        for ($i = 0; $i < 20; $i++) {
            DB::table('messages')->insert([
                'user_id' => null, 
                'patient_id' => $patient->id,

                'number_from' => $companyNumber, 
                'number_to' => $patient,

                'direction' => 'inbound', 
                'message_text' => 'Повідомлення від пацієнта: ' . Str::random(10),
                'created_at' => Carbon::now()->subMinutes(rand(1, 1440)),
                'updated_at' => Carbon::now()
            ]);
    }
    for ($i = 0; $i < 10; $i++) {

    $randomUser = $users->random();

            DB::table('messages')->insert([
                'user_id' => $randomUser->id,
                'patient_id' => $patient->id,
                'number_from' => $companyNumber,
                'number_to' => $patient,
                'direction' => 'outbound',
                'message_text' => 'Повідомлення від системи: ' . Str::random(10),
                'created_at' => Carbon::now()->subMinutes(rand(1, 1440)),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}   

?>
