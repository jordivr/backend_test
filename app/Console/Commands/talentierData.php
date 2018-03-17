<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SitesUrls;

class talentierData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'talentier:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows last 10 links';

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
        $headers=  ['Link', 'Visited','Date'];
        $sitesUrls = SitesUrls::orderby('created_at','desc')->limit(10)->get(['url','visited','created_at']);
        $this->table($headers, $sitesUrls);
    }
}
