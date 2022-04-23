<div class="container">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Most commented posts</h5>
            <p class="card-text">What people talk about</p>
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($mostCommented as $post)
            <li class="list-group-item"><a href="/posts/{{$post->id}}">{{$post->title}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="card mt-5" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Most active users</h5>
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($mostPosts as $user)
            <li class="list-group-item">{{$user->name}}</li>
            @endforeach
        </ul>
    </div>
    <div class="card mt-5" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Most active users last Month</h5>
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($mostPostsLastMonth as $user)
            <li class="list-group-item">{{$user->name}}</li>
            @endforeach
        </ul>
    </div>
</div>