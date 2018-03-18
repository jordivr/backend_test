<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\CrawlerRepository as CrawlerRepo;
use App\Sites;

class talentierTest extends Command
{
    protected $CrawlerRepo;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'talentier:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Backend';

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
        $urlStart = 'https://www.isdin.com';
        $this->info("Checking ".$urlStart. " is alive");
        $crawlerRepo = new CrawlerRepo();
        if ($crawlerRepo->isLiveUrl($urlStart)) {
            $siteObj=Sites::where('url', $urlStart)->firstOrCreate(['url' => $urlStart]);
            $this->info("Starting... ".$urlStart);
            $crawlerRepo->talentier($siteObj);
        }
    }
}
