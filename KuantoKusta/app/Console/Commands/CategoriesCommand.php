<?php

namespace App\Console\Commands;

use App\Models\Categorie;
use Goutte\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class CategoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape data from a category and save it into the database';

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
     * @return void
     */
    public function handle()
    {
        // $client = new Client();
        // $crawler = $client->request('GET', 'https://www.radiopopular.pt/');
        
        // $names = $crawler->filter('.categories ul li')->each(function ($node) {
        //     return $node->text();
        // });
        
        // foreach ($names as $name) {
        //     // Check if the category with the same name already exists

        //         // Create new category only if it doesn't exist
        //         $category = new Categorie([
        //             'name' => $name,
        //         ]);

        //         // Save the category to the database
        //         $category->save();
        // }

        
        $client = new Client();
        $crawler = $client->request('GET', 'https://hipermercado.pt/pt/');
        
        $names = $crawler->filter('.column_title')->each(function ($node) {
            return $node->text();
        });
        
        foreach ($names as $name) {

                $category = new Categorie([
                    'name' => $name,
                ]);

                $category->save();
        }
    }
}
