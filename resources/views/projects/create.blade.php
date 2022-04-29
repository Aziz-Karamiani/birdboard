@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="/projects" method="POST" class="container form-control">
            @csrf
            <label>
                <input name="title">
            </label>
            <label>
                <textarea name="description" placeholder="description"></textarea>
            </label>
            <button class="submit" type="submit">Submit</button>
        </form>
    </div>
@endsection
