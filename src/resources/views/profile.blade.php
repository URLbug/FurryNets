@extends('app.app')

@section('content')
    <div class="container">
        <div class="main-body">
        
                <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                        @if(!isset($user->picture))
                            <img src="{{ asset('/img/none-avatar.png') }}" class="rounded-circle" width="150">
                        @else
                            <img src="$user->picture" alt="" class="rounded-circle" width="150">
                        @endif
                        <div class="mt-3">
                            <h4>{{ $username }}</h4>
                            <p class="text-secondary mb-1">Followers: {{ count($followers->toArray()) }}</p>
                            <p class="text-muted font-size-sm">Following: {{ count($following->toArray()) }}</p>

                            @if(Auth::user()->username === $username)
                                <a class="btn btn-outline-primary href="{{ route('logout') }}">Logout</a>
                            @else
                                <form action="" method="post">
                                    @csrf
                                    
                                    <button class="btn btn-primary">Follow</button>
                                </form>
                            @endif
                        </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">About Me:</h6>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-9 text-secondary">
                            @if(isset($user->description))
                                {{ $user->description }}
                            @else
                                No description available.
                            @endif
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">My Socialnetwork:</h6>
                        </div>
                        </div>
                        @if(isset($user->socialnetworks))
                            <div class="row">
                            <div class="col-sm-3">
                                <a href="#" class="btn group-idk"><i class="fa-brands fa-patreon"></i> Patreon</a>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-3">
                                <a href="#" class="btn group-idk"><i class="fa-brands fa-github"></i> Github</a>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-3">
                                <a href="#" class="btn group-idk"><i class="fa-brands fa-discord"></i> Discord</a>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-3">
                                <a href="#" class="btn group-idk"><i class="fa-brands fa-twitter"></i> Twitter</a>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-3">
                                <a href="#" class="btn group-idk"><i class="fa-brands fa-tiktok"></i> TikTok</a>
                            </div>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
                            </div>
                            </div>
                        @else
                            Not socialnetworks.
                        @endif
                        </div>
                    </div>
                    <!-- Posts -->
                    @foreach($posts as $post)
                        <div class="row">
                            <div class="card" style="width: 18rem;">
                                @if(isset($post->file))
                                    <img class="card-img-top" src="{{ $post->file }}" alt="Card image cap">
                                @endif

                                <div class="card-body">
                                <a href="#" class="btn btn-primary">{{ $post->name }}</a>
                                <p class="card-text">
                                    {{ $post->description }}
                                </p>
                                <form>
                                    <button class="btn btn-primary"><i class="fa-solid fa-heart"></i>{{ $post->like }} Like</button>
                                    <button class="btn btn-secondary"><i class="fa-solid fa-comment"></i>{{ count($post->comment()->get()->toArray()) }} Comment</button>
                                    <button class="btn btn-success"><i class="fa-solid fa-share"></i> Share</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    
                    </div>

                    <!-- Posts end -->
                
                </div>
            </div>
            

        </div>
    </div>
@endsection