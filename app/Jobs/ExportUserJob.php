<?php

namespace App\Jobs;

use App\Mail\ExportUserEmail;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ExportUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fileName = $this->generateFile();
        $this->sendEmail($fileName);
    }

    /**
     * Send the email and delete the file from the storage. Later, email can be replaced with the email for requested user
     * @param $fileName
     */
    private function sendEmail($fileName)
    {
        Mail::to("xyz@example.com")->send(new ExportUserEmail($fileName));
        if (!Mail::failures()) {
            Storage::disk("public")->delete($fileName);//delete file after email sent
        }
    }

    /**
     * Generate the file inside the storage and return the file name
     * @return string
     */
    private function generateFile(): string
    {
        $userService = app(UserService::class);
        $fileName = Carbon::now()->timestamp . '-users.csv';
        $file = fopen(storage_path("app/public/") . $fileName, 'w');
        fputcsv($file, [ //csv header
            "First Name", "Last Name", "Gender", "Email", "Phone", "Address"
        ]);
        foreach ($userService->model->lazy() as $user) {
            fputcsv($file, [ //csv data
                $user->name["first"],
                $user->name["last"],
                $user->gender,
                $user->email,
                $user->phone,
                $user->location
            ]);
        }
        fclose($file);
        return $fileName;
    }
}
