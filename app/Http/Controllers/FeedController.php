<?php

use App\Http\Controllers\Controller;
use App\Models\Artigo;

class FeedController extends Controller
{
    public function index()
    {
        try{
            $artigos = Artigo::latest()->take(10)->get();
    
            $xml = new XMLWriter();
            $xml->openMemory();
    
            $xml->startDocument('1.0', 'UTF-8');
            $xml->startElement('rss');
            $xml->writeAttribute('version', '2.0');
    
            $xml->startElement('channel');
    
            $xml->writeElement('title', 'Estratégia Digital');
            $xml->writeElement('link', config('app.url'));
            $xml->writeElement('description', 'Últimas publicações');
    
            foreach ($artigos as $artigo) {
    
                $xml->startElement('item');
    
                $xml->writeElement('title', $artigo->titulo);
                $xml->writeElement(
                    'link',
                    route('artigos.conteudo',['slug' => $artigo->slug])
                );
    
                $xml->writeElement(
                    'pubDate',
                    $artigo->created_at->toRssString()
                );
    
                $xml->endElement(); // item
            }
    
            $xml->endElement(); // channel
            $xml->endElement(); // rss
    
            return response(
                $xml->outputMemory(),
                200,
                ['Content-Type' => 'application/rss+xml']
            );
        }
        catch(Exception $e){
            return view('error.error500');
        }
    }
}