<?php

namespace App\Listeners;

use App\Http\Controllers\Admin\ParserController;
use App\Models\News;
use App\Services\ParserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateNewsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $parsedNews = (new ParserService)->parse('https://news.yandex.ru/music.rss');

        foreach ($parsedNews['news'] as $item) {
            $temporary_news = $event->news::firstOrNew(['guid' => $item['guid']]);
            $temporary_news->title = $item['title'];
            $temporary_news->description = $item['description'];
            $temporary_news->guid = $item['guid'];
            $temporary_news->category_id = 1;
            $temporary_news->source_id = 1;
            $temporary_news->created_at = $item['pubDate'];
            $temporary_news->save();
        }

    }
}
