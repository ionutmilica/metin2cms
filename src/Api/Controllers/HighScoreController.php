<?php namespace Metin2CMS\Api\Controllers;

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

    public function players()
    {
        return $this->highscoreService->playersTopMini();
    }

    public function guilds()
    {
        return $this->highscoreService->guildsTopMini();
    }
}