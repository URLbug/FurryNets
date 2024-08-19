<div class="text-center d-flex align-items-center flex-column">
    @foreach($posts as $post)
        <div class="row">
            <div class="card" style="width: 18rem;">
            
            @if(isset($post->file))
                <img class="card-img-top" src="{{ $post->file }}" alt="Card image cap">
            @endif

            <div class="card-body">
                <a href="{{ route('posts', ['id' => $post->id]) }}" class="btn btn-primary">{{ $post->name }}</a>
                <p class="card-text">{{ $post->description }}</p>
                <form method="POST" action="{{ route('posts', ['id' => $post->id]) }}">
                    @csrf
                    @method('POST')
                    <button class="btn btn-primary"><i class="fa-solid fa-heart"></i>{{ count($post->like) }} Like</button>
                </form>

                <a href="{{ route('posts', ['id' => $post->id]) }}" class="btn btn-secondary"><i class="fa-solid fa-comment"></i>{{ count($post->comment->toArray()) }} Comment</a>

                <input type="hidden" id="in01" value="{{ route('posts', ['id' => $post->id]) }}" readonly>
                <button class="btn btn-success" id="btn01" data-clipboard-target="#in01"><i class="fa-solid fa-share"></i> Share</button>

            </div>
            </div>
        </div>
        <br>
    @endforeach
</div>