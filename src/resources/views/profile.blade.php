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
                                <a class="btn btn-outline-primary" href="{{ route('logout') }}">Logout</a>
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
                            
                        @else
                            Not socialnetworks.
                        @endif
                            <div class="row">
                                <div class="col-sm-12">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Posts -->
                        <div class="text-center d-flex align-items-center flex-column">
                            @foreach($posts as $post)
                                <div class="row">
                                    <div class="card" style="width: 18rem;">
                                    
                                    @if(isset($post->file))
                                        <img class="card-img-top" src="{{ $post->file }}" alt="Card image cap">
                                    @endif

                                    <div class="card-body">
                                        <a href="detal-page.html" class="btn btn-primary">{{ $post->name }}</a>
                                        <p class="card-text">{{ $post->description }}</p>
                                        <form>
                                            <button class="btn btn-primary"><i class="fa-solid fa-heart"></i>{{ $post->like }} Like</button>
                                            <button class="btn btn-secondary"><i class="fa-solid fa-comment"></i>{{ count($post->comment->toArray()) }} Comment</button>
                                        </form>

                                        <input type="hidden" id="in01" value="{{ route('home') }}" readonly>
                                        <button class="btn btn-success" id="btn01" data-clipboard-target="#in01"><i class="fa-solid fa-share"></i> Share</button>

                                    </div>
                                    </div>
                                </div>
                                <br>
                            @endforeach

                            <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Edit profile</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="text-center">
                                        <div class="row">
                                          <p>About Me:</p>
                                          <textarea name="description" id=""></textarea>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <p>Socialnetworks:</p>
                                          <p>Patreon: <input type="text" name="patreon" id=""></p>
                                          <p>GitHub: <input type="text" name="github" id=""></p>
                                          <p>Discord: <input type="text" name="discord" id=""></p>
                                          <p>Twitter: <input type="text" name="twitter" id=""></p>
                                          <p>TikTok: <input type="text" name="tiktok" id=""></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              
                                      <form action="" method="post">
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    
                    
                    </div>

                    <!-- Posts end -->
                
                </div>
            </div>
            

        </div>
    </div>
@endsection