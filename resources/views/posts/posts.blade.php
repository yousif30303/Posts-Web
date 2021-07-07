@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
            @auth        
            <form action="{{ route('posts') }}" method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>

                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                </div>
            </form>
            @endauth
            
            @foreach ($posts as $post)

            <div class="mb-4">
                <a href="{{route('ShowProfile',$post)}}" class="font-bold">{{$post->user->name}}</a> 
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


@endsection