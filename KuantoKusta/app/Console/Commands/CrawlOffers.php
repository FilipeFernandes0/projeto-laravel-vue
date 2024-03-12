<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Offer;
use Illuminate\Console\Command;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class CrawlOffers extends Command
{
    protected $signature = 'scrape:offers';
    protected $description = 'Scrape offers from a source and save them into the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->crawlAndSaveOffers('https://www.greatdeal.pt/');
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

        $offers = $crawler->filter('.thumbnail-container')->each(function ($node) {
            $linkStore = $node->filter('.product-thumbnail')->attr('href');
            $price = $node->filter('.price')->text();

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
                $offer->store = 'GREATDEAL ELECTRONICS';
                $offer->link_store = $offerData['linkStore'];
                $offer->price = $offerData['price'];
                $offer->product_id = $product->id;
                $offer->save();
            }
        }
    }
}

            

     