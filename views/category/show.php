<?php

use App\Connection;
use App\Model\{Category, Post};
use App\PaginatedQuery;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$query = $pdo->prepare('SELECT * FROM category WHERE id = :id'); // cette fois ci avec la table category
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Category::class);
/** @var Category|false */
$category = $query->fetch();

if ($category === false) {
    throw new Exception('Aucune catégorie ne correspond à cet ID');
}

if ($category->getSlug() !== $slug) { // Je verifie si le slug correspond au parametre que j'ai dans l'url, et s'il ne correspond pas je fais une redirection
    $url = $router->url('category', ['slug' => $category->getSlug(), 'id' => $id]); // une redirection vers la route qui s'appelle 'category'
    http_response_code(301);
    header('Location: ' . $url);
}

$title = "Catégorie {$category->getName()}"; // categorie suivie du nom de la categorie

$paginatedQuery = new PaginatedQuery( // comme params la requete sql et celle qui permet de faire le compteur
    "SELECT p.*
        FROM post p 
        JOIN post_category pc ON pc.post_id = p.id
        WHERE pc.category_id = {$category->getID()}
        ORDER BY created_at DESC",
    "SELECT COUNT(category_id) FROM post_category WHERE category_id = {$category->getID()}"
);
/** @var Post[] */
$posts = $paginatedQuery->getItems(Post::class); // Je recupere l'ensemble de mes elements
$link = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
?>

<h1><?= e($title) ?></h1>


<div class="row">
    <?php foreach ($posts as $post) : ?>
        <div class="col-md-3">
            <?php require dirname(__DIR__) . '/post/card.php' ?>
        </div>
    <?php endforeach ?>
</div>

<div class="d-flex justify-content-between my-4">
    <?= $paginatedQuery->previousLink($link) ?>
    <?= $paginatedQuery->nextLink($link) ?>
</div>