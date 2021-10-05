<?php declare(strict_types=1);

namespace App\Services;

use App\Contract\Parser;
use App\Models\News;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserService implements Parser
{

    public function parse(string  $link): void
    {
        $xml = XmlParser::load($link);
        $data = $xml->parse([
            'title' => [
                'uses' => 'channel.title'
            ],
            'link' => [
                'uses' => 'channel.link'
            ],
            'description' => [
                'uses' => 'channel.description'
            ],
            'image' => [
                'uses' => 'channel.image.url'
            ],
            'news' => [
                'uses' => 'channel.item[title,link,description,guid,pubDate]'
            ]
        ]);

        foreach ($data['news'] as $item) {
            $temporary_news = News::create([
                'guid' => $item['guid'],
                'title' => $item['title'],
                'description' => $item['description'],
                'category_id' => 1,
                'source_id' => 3,
                'created_at' => $item['pubDate']
            ]);
            $temporary_news->save();
        }

    }
}
