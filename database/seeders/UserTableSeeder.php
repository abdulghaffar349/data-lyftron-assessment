<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $response = Http::get("https://randomuser.me/api", ["results" => 100]);
            if ($response->ok()) {
                $users = collect($response->json("results"))->unique("email")->map(function ($user) {
                    $location = Arr::flatten(Arr::only($user["location"], ["street", "city", "state", "country", "postcode"]));
                    $location = implode(array_values($location)," ");
                    return [
                        "name" => json_encode($user["name"]),
                        "gender" => $user["gender"],
                        "email" => $user["email"],
                        "phone" => $user["phone"],
                        "image" => $user["picture"]["large"],
                        "location" => $location,
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now(),
                    ];
                })->toArray();
                User::insert($users); //on bulk insert casting will not work
            }
        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }
}
