@extends('layouts.app')
@section('content')
    <div class="container">
        <ul class="list-group">
            @foreach($projects as $project)
                <a href="{{ $project->path() }}">
                    <li class="list-group-item">{{ $project->title }}</li>
                </a>
            @endforeach
        </ul>
    </div>
@endsection
