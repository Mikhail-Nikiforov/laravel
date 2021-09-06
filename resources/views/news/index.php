<?php
foreach($newsList as $news): ?>
    <div>
        <h2><a href="<?=route('news.show', ['id' => $news['id']])?>"><?=$news['title']?></a></h2>
        <p><?=$news['description_short']?></p>
        <a href="<?=route('news.categories.showFiltered', ['category_id' => $news['category_id']])?>"><?=$news['category']?></a>
    </div><br>
<?php endforeach; ?>
