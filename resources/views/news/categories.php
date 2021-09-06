<h1>Новости по категориям:</h1>
<ul>
<?php

foreach($categoriesList as $category): ?>
    <li>
        <a href="<?=route('news.categories.showFiltered', ['category_id' => $category['id']])?>"><?=$category['ru']?></a>
    </li>
    <?php endforeach; ?>
</ul>

