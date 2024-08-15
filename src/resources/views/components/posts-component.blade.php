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
</div>