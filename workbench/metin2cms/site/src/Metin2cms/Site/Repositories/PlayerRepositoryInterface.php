<?php namespace Metin2cms\Site\Repositories;

interface PlayerRepositoryInterface {

    /**
     * Get players for page $page with a given number of players per page
     *
     * @param $page
     * @param int $perPage
     * @return array
     */
    public function highscoreForPage($page, $perPage = 10);
}