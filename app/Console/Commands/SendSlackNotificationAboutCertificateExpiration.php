<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\CertificateExpiring;

class SendSlackNotificationAboutCertificateExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendSlackNotificationAboutCertificateExpiration:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Slack notification about certificates that are about to expire.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $certificates = \App\Certificate::all();

        foreach ($certificates as $key => $certificate) {
            $expiration = date_create($certificate['expiration']);
            $today = date_create("now");
            $diff = date_diff($today,$expiration);

            if ($diff->format("%a") < 60) {
                $certificate->notify(new CertificateExpiring($certificate));
            }
        } 
    }
}
