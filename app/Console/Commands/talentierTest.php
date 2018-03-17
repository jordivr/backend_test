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
    public function __construct( CrawlerRepo $CrawlerRepo)
    {
        $this->CrawlerRepo   = $CrawlerRepo;
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
        if(!Sites::where('url',$urlStart)->first()){
            $newSite = new Sites();
            $newSite->url = $urlStart;
            $newSite->save();
        }
        else $newSite = Sites::where('url',$urlStart)->first();
        if($this->CrawlerRepo->isLiveUrl($urlStart)){
            $this->CrawlerRepo->talentier($newSite);
        }
        
    }


}
