<?php

use Illuminate\Database\Seeder;
use App\configHeaders;

class configHeadersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	configHeaders::truncate();
        $obj = new configHeaders();
        $obj->name="X-Generator";
        $obj->save();
        
        $obj = new configHeaders();
        $obj->name="Cache-Control";
        $obj->save();
    }
}
