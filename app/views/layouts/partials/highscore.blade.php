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
                        <tr>
                            <td width="5">1</td>
                            <td>Ionut</td>
                            <td width="10">
                                <img src="{{ asset('assets/img/kindoms/red.png') }}" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td width="5">2</td>
                            <td>Gabi</td>
                            <td width="10">
                                <img src="{{ asset('assets/img/kindoms/blue.png') }}" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td width="5">3</td>
                            <td>Mihai</td>
                            <td width="10">
                                <img src="{{ asset('assets/img/kindoms/yellow.png') }}" alt="">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="span7 text-center">
                        <a href="#" class="btn btn-primary btn-xs">TOP 100</a>
                    </div>
                    </p>
                </div>
                <div class="tab-pane fade active in" id="guilds">
                    <p>
                    <table class="table table-striped table-bordered">
                        <tbody>
                        <tr>
                            <td width="5">1</td>
                            <td>InStyle</td>
                            <td width="10">
                                <img src="{{ asset('assets/img/kindoms/blue.png') }}" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td width="5">2</td>
                            <td>7UP</td>
                            <td width="10">
                                <img src="{{ asset('assets/img/kindoms/red.png') }}" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td width="5">3</td>
                            <td>TheRulers</td>
                            <td width="10">
                                <img src="{{ asset('assets/img/kindoms/yellow.png') }}" alt="">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="span7 text-center">
                        <a href="#" class="btn btn-primary btn-xs">TOP 100</a>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>