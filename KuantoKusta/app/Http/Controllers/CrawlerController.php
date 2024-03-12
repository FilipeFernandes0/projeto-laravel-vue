<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Goutte\Client;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\Exception\TransportException;

class CrawlerController extends Controller
{
    public function getAdidasProducts()
    {
        $client = new Client();
    
        $html = $client->request('GET', 'https://www.greatdeal.pt/');
        
        // $name = $html->filter('.text-sm-left')->each(function ($node) {
        //      dump($node->text());
        // });

        $image = $html->filter('.image a')->each(function ($node) {
            $src = $node->attr('href');
            if (!empty($src)) {
                dump($src);
            }
        });
        
        
        // $html->filter('.price')->each(function ($node) {
        //     $brand = $node->text();
        //     dump($brand);
        // });
        // $html->filter('.thumbnail')->each(function ($node) {
        //     $price = $node->text();
        //     dump($price);
        // });


    }
}


