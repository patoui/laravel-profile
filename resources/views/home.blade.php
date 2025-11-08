@extends('layouts.app')

@section('meta')
<meta name="description" content="A small blog by humble developer Patrique Ouimet primarily working with PHP and JavaScript" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Patrique Ouimet" />
<meta property="og:description" content="A small blog by humble developer Patrique Ouimet primarily working with PHP and JavaScript" />
<meta property="og:image" content="{{ Request::root() . '/img/black-white-profile.png' }}" />
@endsection

@section('title', 'Patrique Ouimet')

@section('content')
<h1 class="w-full block mt-3 mb-2 font-bold text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl">Hi there 👋, I'm Pat! 😄</h1>
<p class="block mb-5 leading-relaxed">I'm a Senior Backend Software Engineer primarily working in/with TypeScript/NodeJS but love discovering/trying new technologies!</p>

<h2 class="w-full block mt-3 mb-2 font-bold text-base sm:text-lg md:text-xl lg:text-xl xl:text-2xl">About me</h2>
<ul class="w-full block list-disc ml-5">
    <li>
        <p class="block mb-2 leading-relaxed">🛢 I enjoy working with large datasets as I find the challenges, technologies, and strategies facinating. I've finished reading <a class="text-blue-600 visited:text-purple-600" href="https://dataintensive.net/">Designing Data Intensive Applications - Martin Kleppmann</a> on this topic and gained some valuable knowledge and insights, I highly recommend this book</p>
    </li>
    <li>
        <p class="block mb-2 leading-relaxed">📖 I'm currently reading <a class="text-blue-600 visited:text-purple-600" href="https://nodejsdesignpatterns.com/">Node.js Design Patterns!</a></p>
    </li>
    <li>
        <p class="block mb-2 leading-relaxed">🎥 I'm currently refreshing my knowledge of NodeJS with <a class="text-blue-600 visited:text-purple-600" href="https://www.udemy.com/course/nodejs-the-complete-guide/">NodeJS - The Complete Guide course!</a></p>
    </li>
    <li>
        <p class="block mb-2 leading-relaxed">🏠 Fascinated by <a class="text-blue-600 visited:text-purple-600" href="https://clickhouse.com/">ClickHouse</a> and always looking for excuses to use it!</p>
    </li>
    <li>
        <p class="block mb-2 leading-relaxed">🦕 Intrigued by the <a class="text-blue-600 visited:text-purple-600" href="https://deno.com" title="Deno">Deno</a> runtime, looking for excuses to build something with it!</p>
    </li>
    <li>
        <p class="block mb-2 leading-relaxed">✌️ I'm looking to collaborate on anything OSS but haven't quite found something I'm very interested in yet (open to suggestions!)</p>
    </li>
    <li>
        <p class="block mb-2 leading-relaxed">❤️ Beer🍺️, Coffee ☕️, Badminton 🏸, Cycling 🚴‍♂️️, Hiking 🗻️</p>
    </li>
</ul>

<h2 class="w-full block mt-5 mb-2 font-bold text-base sm:text-lg md:text-xl lg:text-xl xl:text-2xl">📫 Where to find me</h2>

<ul class="w-full block list-disc ml-5">
    <li class="mb-2">🐙️&nbsp;<a class="text-blue-600 visited:text-purple-600" href="https://github.com/patoui" title="GitHub">GitHub</a></li>
    <li class="mb-2">𝐗&nbsp;<a class="text-blue-600 visited:text-purple-600" href="https://x.com/patoui2" title="X">X</a></li>
    <li class="mb-2">📸️&nbsp;<a class="text-blue-600 visited:text-purple-600" href="https://instagram.com/patoui2" title="Instagram">Instagram</a></li>
    <li class="mb-2">👨‍💻&nbsp;<a class="text-blue-600 visited:text-purple-600" href="https://linkedin.com/in/patrique-ouimet-8b2aa969" title="LinkedIn">LinkedIn</a></li>
    <li class="mb-2">🐘️&nbsp;<a class="text-blue-600 visited:text-purple-600" href="https://phpc.social/web/accounts/106705262503935129" title="PHP Social">PHP Social</a></li>
    <li class="mb-2">🦋&nbsp;<a class="text-blue-600 visited:text-purple-600" href="https://bsky.app/profile/patoui.bsky.social" title="Bluesky">Bluesky</a></li>
</ul>

<h2 class="w-full block mt-5 mb-2 font-bold text-base sm:text-lg md:text-xl lg:text-xl xl:text-2xl">🔭️ Technologies</h2>

<p class="w-full block mb-2">Not listed in any particular order and likely missing a few 😅️</p>

<ul class="w-full block list-disc ml-5">
    <li class="mb-2">💻 &nbsp; PHP | Go | Laravel | JavaScript | Vue | React | React Native | Java</li>
    <li class="mb-2">🌐 &nbsp; HTML | CSS | SASS | Bootstrap | Tailwind</li>
    <li class="mb-2">🛢 &nbsp; MySQL | Redis | Typescript | ClickHouse | SQLite | Mongo | AWS DynamoDB | AWS Glue</li>
    <li class="mb-2">🔧 &nbsp; PHPStorm | Sublime Text | Visual Studio Code | Zed | Neovim | Git</li>
    <li class="mb-2">🖥 &nbsp; Nginx | Apache | Caddy | Docker | Vagrant</li>
    <li class="mb-2">🛸️ &nbsp; Linux | Bash | AWS | Digital Ocean</li>
</ul>

@endsection

@include('vendor.flash.message')
