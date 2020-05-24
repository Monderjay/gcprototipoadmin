<?php

use Illuminate\Database\Seeder;
use App\Clasification;

class ClasificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Clasification::create(array('name' => 'Noticias','icon'=>'fas fa-newspaper'));
        Clasification::create(array('name' => 'Reseñas','icon'=>'fas fa-quote-right'));
        Clasification::create(array('name' => 'Retro','icon'=>'fas fa-rocket'));
        //Clasification::create(array('name' => 'Especiales','icon'=>'fas fa-heart'));
        //Clasification::create(array('name' => 'Podcast','icon'=>'fab fa-spotify'));
        //Clasification::create(array('name' => 'Unboxings','icon'=>'fas fa-box-open'));
    }
}
