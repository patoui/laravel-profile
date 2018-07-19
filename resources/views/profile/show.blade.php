@extends('layouts.app')

@section('title', 'Profile: ' . $user->name)

@section('hero-body')
<div class="hero-body">
    <div class="container has-text-centered">
        <h1 class="title">{{ $user->name }}</h1>
        <h3>{{ $user->email }}</h3>
    </div>
</div>
@endsection

@section('content')
<section class="section">
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Content</th>
                    <th style="text-align: right;">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                <tr>
                    <td>{{ $activity->human_type }}</td>
                    <td><a href="{{ $activity->subject_url }}" alt="Link to Relevant Activity">{{ $activity->short_content }}</a></td>
                    <td style="text-align: right;">{{ $activity->short_created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
