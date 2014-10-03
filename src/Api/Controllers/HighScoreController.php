<?php namespace Metin2CMS\Api\Controllers;

use Illuminate\Support\Facades\Input;
use Metin2CMS\Core\Services\HighscoreService;

class HighScoreController extends ApiController {

    /**
     * @var \Metin2CMS\Core\Services\HighscoreService
     */
    private $highscoreService;

    public function __construct(HighscoreService $highscoreService)
    {

        $this->highscoreService = $highscoreService;
    }

    /**
     * Return players
     *
     * @return mixed
     */
    public function players()
    {
        $perPage = Input::get('perPage');
        $page = Input::get('page');

        $transformer = app('Metin2CMS\Api\Transformers\PlayerHighScoreTransformer');

        return $transformer->transformPagination($this->highscoreService->players($perPage, $page));
    }

    /**
     * Return guilds
     *
     * @return array
     */
    public function guilds()
    {
        $perPage = Input::get('perPage');
        $page = Input::get('page');

        $transformer = app('Metin2CMS\Api\Transformers\GuildHighScoreTransformer');

        return $transformer->transformPagination($this->highscoreService->guilds($perPage, $page));
    }
}