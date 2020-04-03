@extends('layouts.app')

@section('meta')
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Storm the House"/>
    <meta property="og:description" content="Storm the House"/>
    <meta property="og:image" content="{{ Request::root() . '/img/black-white-profile.png' }}"/>
    <meta property="keywords" content="storm the house, storm, house"/>
@endsection

@section('title', 'Storm the House')

@section('content')
    <div class="flex flex-col w-full justify-center align-middle">
        <canvas id="game_canvas" style="display: block; width: 800px; height: 600px; margin: 0 auto;"></canvas>
    </div>
@endsection

@section('javascript')
    <script src="//cdn.jsdelivr.net/npm/phaser@3.22.0/dist/phaser.js"></script>
    <script src="/js/storm-the-house/game.js"></script>
@endsection