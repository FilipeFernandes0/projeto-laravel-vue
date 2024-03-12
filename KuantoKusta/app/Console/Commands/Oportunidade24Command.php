<?php

namespace App\Console\Commands;

use App\Models\Categorie;
use App\Models\Product;
use Goutte\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class Oportunidade24Command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:oportunidade24';

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

        // Call the crawlerSite function with the URL you want to crawl
        $this->crawlerSite('https://www.euronics.pt/pt/');
    }

    private function crawlerSite($url): void
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $this->handleData($crawler);

        $crawler->filter('a')->each(function (Crawler $node) use ($client, $url) {
            $link = $node->attr('href');
            if (strpos($link, 'http') !== 0) {
                $parsedUrl = parse_url($url);
                $link = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . $link;
            }
            if (parse_url($link, PHP_URL_HOST) === parse_url($client->getRequest()->getUri(), PHP_URL_HOST)) {
                $crawler = $client->request('GET', $link);
                $this->handleData($crawler);
            }
        });
    }

    private function handleData(Crawler $crawler): void
    {

        $products = $crawler->filter('.layout-column')->each(function ($node) {
            $productName = $node->filter('.name')->text();
            $productImage = $node->filter('.img-default')->attr('src');
            $productPrice = $node->filter('.current')->text();
            $productUrl = $node->filter('a')->attr('href');

            // Extracting category from the product URL
            $urlParts = explode('/', $productUrl);
            $category = $urlParts[count($urlParts) - 3];

            $productPrice = preg_replace('/[^0-9,]/', '', $productPrice);
            $productPrice = str_replace(',', '.', $productPrice);
            $productPrice = (float) $productPrice;

            return compact('productName', 'productImage', 'productPrice', 'category');

        });

        foreach ($products as $productData) {
            $category = Categorie::firstOrCreate(['name' => $productData['category']]);
            dump($productData['productName']);
            dump($productData['productImage']);
            dump($productData['productPrice']);


            $product = Product::firstOrNew(['name' => $productData['productName']]);
            $product->image = $productData['productImage'];
            $product->price = $productData['productPrice'];
            $product->category_id = $category->id;
            $product->save();
        }
        }
    }