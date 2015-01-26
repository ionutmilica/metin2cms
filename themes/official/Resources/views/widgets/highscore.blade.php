<div class="panel panel-default">
    <div class="panel-heading">Rank</div>
    <div class="panel-body">
        <div class="bs-highscore bs-highscore-tabs">
            <ul id="highscore" class="nav nav-tabs">
                <li class="">
                    <a href="#players" data-toggle="tab">
                        <img src="{{ assetTheme('img/player.png') }}" alt="">
                    </a>
                </li>
                <li class="active">
                    <a href="#guilds" data-toggle="tab">
                        <img src="{{ assetTheme('img/guild.png') }}" alt="">
                    </a>
                </li>
            </ul>
            <div id="highscoreContent" class="tab-content">
                <div class="tab-pane fade" id="players">
                    <p>
                    <table class="table table-striped table-bordered">
                        <tbody>
                        @foreach ($playersMini as $player)
                        <tr>
                            <td class="position" width="5">{{ $player['rank'] }}</td>
                            <td class="name">{{ $player['name'] }}</td>
                            <td class="empire" width="10">
                                <img src="{{ assetTheme('img/kindoms/'.$player['empire'].'.png') }}" alt="">
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="span7 text-center">
                        <a href="{{ route('highscore.players') }}" class="btn btn-primary btn-xs">TOP 100</a>
                    </div>
                    </p>
                </div>
                <div class="tab-pane fade active in" id="guilds">
                    <p>
                    <table class="table table-striped table-bordered">
                        <tbody>
                        @foreach ($guildsMini as $guild)
                            <tr>
                                <td width="5">{{ $guild['rank'] }}</td>
                                <td>{{ $guild['guild_name'] }}</td>
                                <td width="10">
                                    <img src="{{ assetTheme('img/kindoms/'.$guild['empire'].'.png') }}" alt="">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="span7 text-center">
                        <a href="{{ route('highscore.guilds') }}" class="btn btn-primary btn-xs">TOP 100</a>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>