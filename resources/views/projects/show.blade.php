@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $project->title }}</h1>
        <div>{{ $project->description }}</div>

        <a href="/projects">Go Back</a>
    </div>
@endsection
