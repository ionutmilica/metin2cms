<?php namespace Metin2CMS\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Metin2CMS\Services\Admin\PlayerService;

class PlayerController extends BaseController {
    /**
     * @var PlayerService
     */
    private $player;

    /**
     * @param PlayerService $player
     */
    public function __construct(PlayerService $player)
    {
        $this->player = $player;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $players = $this->player->search(Input::all());

        return $this->view('player.index', compact('players'));
    }
}
