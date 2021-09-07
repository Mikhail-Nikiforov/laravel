<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $categoriesList = [
      ['id' => 0, 'eng' => 'sport', 'ru' => 'Спорт'],
      ['id' => 1,'eng' => 'technologies', 'ru' => 'Технологии'],
      ['id' => 2,'eng' => 'lifestyle', 'ru' => 'Образ жизни'],
      ['id' => 3,'eng' => 'health', 'ru' => 'Здоровье'],
      ['id' => 4,'eng' => 'movie', 'ru' => 'Кино'],
    ];

    protected function filterNews($category_id): array
    {
        $newsData = $this->getNews();
        if ($category_id !== null) {
            $newsData = array_filter($newsData, function ($value) use ($category_id) {
                return $value['category_id'] === $category_id;
            });
        }


        return $newsData;
    }

    protected function getNews(): array
    {
        $faker = Factory::create('ru_RU');
        $data = [];
        $countNumber = mt_rand(5,15);
        for($i=0; $i<$countNumber; $i++) {
            $categoryNumber = mt_rand(0,4);
            $data[] = [
                'id' => $i+1,
                'title' => $faker->jobTitle(),
                'description' => $faker->sentence(3),
                'description_long' => $faker->sentence(100),
                'author' => $faker->name(),
                'created_at' => now(),
                'category_id' => $categoryNumber,
                'category' => $this->categoriesList[$categoryNumber]['ru'],
            ];
        }

        return $data;
    }

    protected function getCategories(): array
    {
        return $this->categoriesList;
    }


}
