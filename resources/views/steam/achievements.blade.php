@extends('layouts.master')
@section('content')
<div class="show-profile">
    @php
    if (!$player || !$achievementsStatistic) {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $userInfoPosition = count($uri) - 2;
        $steamid = $uri[$userInfoPosition];
    @endphp
        <h2>User with Steam ID: {{ $steamid }} does not play shared game or his profile have private settings !</h2>
    @php
    } else {
        $armsRaceDemolitionUnachieved = $weaponSpecialistUnachieved = $globalExpertiseUnachieved =
        $combatSkillsUnachieved = $teamTacticsUnachieved = [];
        $i = $j = 0;
        $achived = 0;
        $noAchived = [];
    @endphp
        <div class="show-profile-full">
            <img src="{{ $player->avatarmedium }}" >
            <a href="{{route('steam-user',[$player->steamid])}}"><h3>Back to profile</h3></a>
            <h5>{{ $player->personaname }} | Last online: {{ date('d.m.Y',$player->lastlogoff) }}</h5>
        </div>
        <div class="tab">
          <button class="tablinks" onclick="showAchievements(event, 'All')">All</button>
          <button class="tablinks" onclick="showAchievements(event, 'Team Tactics')">Team Tactics</button>
          <button class="tablinks" onclick="showAchievements(event, 'Combat Skills')">Combat Skills</button>
          <button class="tablinks" onclick="showAchievements(event, 'Weapon Specialist')">Weapon Specialist</button>
          <button class="tablinks" onclick="showAchievements(event, 'Global Expertise')">Global Expertise</button>
          <button class="tablinks" onclick="showAchievements(event, 'Arms Race')">Arms Race and Demolition</button>
        </div>
        <div id="All" class="tabcontent">
            @include('achievements.all-achievements')
        </div>
        <div id="Team Tactics" class="tabcontent">
            @include('achievements.team-tactics')
        </div>
        <div id="Combat Skills" class="tabcontent">
            @include('achievements.combat')
        </div>
        <div id="Weapon Specialist" class="tabcontent">
            @include('achievements.weapon')
        </div>
        <div id="Global Expertise" class="tabcontent">
            @include('achievements.global')
        </div>
        <div id="Arms Race" class="tabcontent">
            @include('achievements.arms-race-demolition')
        </div>
        <script>
        function showAchievements(evt, category) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(category).style.display = "block";
            evt.currentTarget.className += " active";
        }
        </script>
        @php
    }
    @endphp
</div>
@endsection
