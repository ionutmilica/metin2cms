<?php namespace Metin2CMS\Core\Repositories;

interface PlayerRepositoryInterface {

    /**
     * Get players for page $page with a given number of players per page
     *
     * @param $page
     * @param int $perPage
     * @return array
     */
    public function highscoreForPage($page, $perPage = 10);

    /**
     * Find player by name
     *
     * @param $login
     * @return mixed
     */
    public function findByName($login);
}