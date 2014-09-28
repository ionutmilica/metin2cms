<?php namespace Metin\Repositories;

interface GuildRepositoryInterface {

    /**
     * Get guilds for page $page with a given number of players per page
     *
     * @param $page
     * @param int $perPage
     * @return array
     */
    public function highscoreForPage($page, $perPage = 10);

    /**
     * Creates a guild
     *
     * @param array $data
     * @return array
     */
    public function create(array $data);

    /**
     * Find guild for a specific user
     *
     * @param $owner
     * @return mixed
     */
    public function findByOwner($owner);
}
