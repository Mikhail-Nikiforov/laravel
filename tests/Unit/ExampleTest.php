<?php

namespace Tests\Unit;

use App\Models\News;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_check_empty_news_list()
    {
		$news = News::getNews();
        $this->assertEquals($news, []);
    }

    public function test_function()
    {
        $test = News::functionForTest();
        $this->assertEquals($test, [`t`, `e`, `s`, `t`]);
    }
}
