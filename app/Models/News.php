<?php declare(strict_types=1);

namespace App\Models;

use Faker\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    protected $table = "news";

    public function getNews(): Collection
    {

        return DB::table($this->table)
            ->join('categories', 'categories.id', '=', 'news.category_id')
            ->select("news.*","categories.id as categoryId","categories.title as categoryTitle")
            ->whereBetween('news.id', [1,5])
            ->orderBy('news.id', 'desc')
            ->get();
    }

    public function getNewsById()
    {
        return DB::table($this->table)->find($id);
    }

   public static function functionForTest(): array
   {
       return [`t`, `e`, `s`, `t`];
   }
}
