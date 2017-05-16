<?php

require_once '../_php/autoload.php';

$moviesAPI = new ApiMovieDB;

echo '<p>Searches</p>';

echo '<p>movie</p>';

$id_title = '550';

$movie_urls = $moviesAPI->urlMovie($id_title);

echo $movie_urls['title'] . '<br />';

echo $movie_urls['credits'] . '<br />';

echo $movie_urls['images'] . '<br />';

echo '<p>person</p>';

$id_name = '66633';

$person_urls = $moviesAPI->urlPerson($id_name);

echo $person_urls['name'] . '<br />';

echo $person_urls['credits'] . '<br />';

echo $person_urls['images'] . '<br />';

echo '<p>Searches</p>';

echo '<p>movie</p>';

$search_movie = $moviesAPI->urlSearch('general', 'movie', 'false');

echo $search_movie . '<br />';

$search_movie_adult = $moviesAPI->urlSearch('broadcast', 'movie', 'true');

echo $search_movie_adult . '<br />';

$htmlSearchMovieAdult = Tools::getHtml($search_movie_adult);

$jsonSearchMovieAdult = json_decode($htmlSearchMovieAdult, true);


echo '<pre>';
print_r($jsonSearchMovieAdult);
echo '</pre>';

echo '<p>person</p>';

$search_person = $moviesAPI->urlSearch('keaton', 'person', 'false');

echo $search_person . '<br />';

$search_person_adult = $moviesAPI->urlSearch('haven', 'person', 'true');

echo $search_person_adult . '<br />';

$htmlSearchPersonAdult = Tools::getHtml($search_person_adult);

$jsonSearchPersonAdult = json_decode($htmlSearchPersonAdult, true);


echo '<pre>';
print_r($jsonSearchPersonAdult);
echo '</pre>';

foreach($jsonSearchPersonAdult['results'] as $result)
{
    $personUrls = $moviesAPI->urlPerson($result['id']);
    echo '<p>' . $result['name'] . '</p>';
    echo '<ul>';
    echo '<li>' . $personUrls['name'] . '</li>';
    echo '<li>' . $personUrls['credits'] . '</li>';
    echo '<li>' . $personUrls['images'] . '</li>';
    echo '</ul>';
}
