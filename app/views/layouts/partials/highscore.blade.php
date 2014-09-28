<div class="panel panel-default">
    <div class="panel-heading">Rank</div>
    <div class="panel-body">
        <div class="bs-highscore bs-highscore-tabs">
            <ul id="highscore" class="nav nav-tabs">
                <li class="">
                    <a href="#players" data-toggle="tab">
                        <img src="{{ asset('assets/img/player.png') }}" alt="">
                    </a>
                </li>
                <li class="active">
                    <a href="#guilds" data-toggle="tab">
                        <img src="{{ asset('assets/img/guild.png') }}" alt="">
                    </a>
                </li>
            </ul>
            <div id="highscoreContent" class="tab-content">
                <div class="tab-pane fade" id="players">
                    <p>
                    <table class="table table-striped table-bordered">
                        <tbody>
                        @for ($i = 0; $i < count($playersMini); $i++)
                        <tr>
                            <td class="position" width="5">{{ $i + 1 }}</td>
                            <td class="name">{{ $playersMini[$i]['name'] }}</td>
                            <td class="empire" width="10">
                                <img src="{{ asset('assets/img/kindoms/'.$playersMini[$i]['empire'].'.png') }}" alt="">
                            </td>
                        </tr>
                        @endfor
                        </tbody>
                    </table>
                    <div class="span7 text-center">
                        <a href="/home/highscore/players" class="btn btn-primary btn-xs">TOP 100</a>
                    </div>
                    </p>
                </div>
                <div class="tab-pane fade active in" id="guilds">
                    <p>
                    <table class="table table-striped table-bordered">
                        <tbody>
                        @for ($i = 0; $i < count($guildsMini); $i++)
                            <tr>
                                <td width="5">{{ $i + 1 }}</td>
                                <td>{{ $guildsMini[$i]['guild_name'] }}</td>
                                <td width="10">
                                    <img src="{{ asset('assets/img/kindoms/'.$guildsMini[$i]['empire'].'.png') }}" alt="">
                                </td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                    <div class="span7 text-center">
                        <a href="/home/highscore/guilds" class="btn btn-primary btn-xs">TOP 100</a>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>