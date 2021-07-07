@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12">
    <div class="p-6">
        <h1 class="text-2xl font-medium mb-1">{{$name}}</h1>
        <p>posted {{count($posts)}} posts and received {{count($likes)}} likes</p>
    </div>
    <div class="w-8/12 bg-white p-6 rounded-lg">
    @foreach ($posts as $post)
            <div class="mb-4">
                <a href="" class="font-bold">{{$name}}</a> 
                <p class="mb-2">{{$post->body}}</p>
                    @can('delete', $post)
                    <form action="{{route('destroy',$post)}}" method="post">
                        @csrf
                        <button type="submit" class="text-blue-500">Delete</button>
                    </form>
                    @endcan
            </div>
            @auth     
            <div class="flex items-center">
                @if (!$post->likes()->get()->contains('user_id',auth()->user()->id))
                <form action="{{route('store',$post)}}" method="post" class="  mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>

                @else
                <form action="{{route('destroyLike',$post)}}" method="post" class="  mr-1">
                    @method('delete')
                    @csrf
                    <button type="submit" class="text-blue-500">UnLike</button>
                </form>
                @endif

            </div>
            @endauth
            <span>{{count($post->likes()->get())}} Likes</span>
            @endforeach
        </div>
    </div>
</div>
@endsection