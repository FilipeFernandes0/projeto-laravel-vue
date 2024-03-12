<?php

namespace App\Console\Commands;

use App\Models\Offer;
use App\Models\Product;
use Goutte\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class offersComand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:offers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->crawlAndSaveOffers('https://www.euronics.pt/pt/');
    }

    private function crawlAndSaveOffers($url): void
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $this->handleData($crawler);
    }

    private function handleData(Crawler $crawler): void
    {
        $products = Product::all();

        $offers = $crawler->filter('.layout-column')->each(function ($node) {
            $linkStore = $node->filter('.image a')->attr('href');
            $price = $node->filter('.current')->text();

            $price = preg_replace('/[^0-9,]/', '', $price);
            $price = str_replace(',', '.', $price);
            $price = (float) $price;

            return compact('linkStore', 'price');
        });

        foreach ($products as $key => $product) {
            // Assuming each product has an associated offer index
            if (isset($offers[$key])) {
                $offerData = $offers[$key];
                $offer = new Offer();
                $offer->store = 'EURONICS';
                $offer->link_store = $offerData['linkStore'];
                $offer->price = $offerData['price'];
                $offer->product_id = $product->id;
                $offer->save();
            }
        }
    }
}


