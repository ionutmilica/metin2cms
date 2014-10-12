<?php namespace Metin2CMS\Site\Controllers;

class HighscoreController extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }

    public function players()
    {
        return $this->view('highscore.players');
    }

    public function guilds()
    {
        return $this->view('highscore.guilds');
    }
}