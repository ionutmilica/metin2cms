<?php namespace Metin2CMS\Http\Controllers\Site;

use Metin2CMS\Services\HighscoreService;

class HighscoreController extends BaseController {

    const PLAYERS_PER_PAGE = 2;
    const GUILDS_PER_PAGE = 2;
    /**
     * @var \Metin2CMS\Services\HighscoreService
     */
    private $highscoreService;

    public function __construct(HighscoreService $highscoreService)
    {
        parent::__construct();

        $this->highscoreService = $highscoreService;
    }

    /**
     * Display the players
     *
     * @return mixed
     */
    public function players()
    {
        $players = $this->highscoreService->players(self::PLAYERS_PER_PAGE);

        return $this->view('highscore.players', compact('players'));
    }

    /**
     * Search for a player and display the data
     *
     * @return mixed
     */
    public function searchPlayer()
    {
        return $this->view('highscore.players');
    }

    /**
     * Display the guilds
     *
     * @return mixed
     */
    public function guilds()
    {
        $guilds = $this->highscoreService->guilds(self::GUILDS_PER_PAGE);

        return $this->view('highscore.guilds', compact('guilds'));

    }

    /**
     * Search for a guild and display the rank
     *
     * @return mixed
     */
    public function searchGuild()
    {
        return $this->view('highscore.guilds');
    }
}