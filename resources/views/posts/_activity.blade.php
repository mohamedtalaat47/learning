<div class="container">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{__("Most Commented")}}</h5>
            <p class="card-text">{{__("What people are currently talking about")}}</p>
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($mostCommented as $post)
            <li class="list-group-item"><a href="/posts/{{$post->id}}">{{$post->title}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="card mt-5" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{__("Most Active")}}</h5>
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($mostPosts as $user)
            <li class="list-group-item">{{$user->name}}</li>
            @endforeach
        </ul>
    </div>
    <div class="card mt-5" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{__("Most Active Last Month")}}</h5>
        </div>
        <ul class="list-group list-group-flush">
            @foreach ($mostPostsLastMonth as $user)
            <li class="list-group-item">{{$user->name}}</li>
            @endforeach
        </ul>
    </div>
</div>