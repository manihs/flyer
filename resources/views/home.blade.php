@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="nav-link ml-3 my-1" href="{{ route('community.create') }}">create community</a>
                    <a class="nav-link ml-3 my-1" href="{{ route('post.image.upload') }}">image uploading</a>
                    <a class="nav-link ml-3 my-1" href="{{ route('post.video.upload') }}">video uploading</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
        <br>
        @foreach ($posts as $post)
            <div class="card">
                {{ $post->id }}
                <br>
                {{ $post->user }}
                <br>
                {{ $post->community }}
                <br>
                {{ $post->post_type }}
                <br>
                {{ $post->src }}
                <br>
                {{ $post->caption }}
            </div>
            <br>
        @endforeach
        </div>
    </div>
</div>
@endsection
