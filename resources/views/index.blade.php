@extends("template")

@section("content")
<div class="container">
    <div class="row">
        <div class="jumbotron">
            <h1 class="display-4">Lyrical</h1>
            <p class="lead">A website created to be able to easily search for lyrics by parts of lyrics or title of the song.
            </p>
            <hr class="my-4">
            <p>This website's data is created by people for people</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="/aboutus" role="button">Learn more</a>
            </p>
        </div>
    </div>
    <h1 class="display-7">Songs:</h1>
    <hr>
    <div class="row mb-3">
    @foreach($songs as $song)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$song->name}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$song->singer}}</h6>
                    <p class="card-text small">Written By:<br> {{$song->written_by}}</p>
                    <a href="/{{$song->id}}" class="card-link">Show Lyrics</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    @if($songs->total() > $songs->perPage())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="{{ ($songs->currentPage() == 1) ? ' disabled page-item' : 'page-item' }}">
                <a class="page-link" href="{{ $songs->url($songs->currentPage()-1) }}" tabindex="-1">Previous</a>
            </li>
            <li class="page-item disabled"><d class="page-link">{{$songs->currentPage()}} of {{$songs->lastPage()}}</d></li>
            <li class="{{ ($songs->currentPage() == $songs->lastPage()) ? ' disabled page-item' : 'page-item' }}">
                <a class="page-link" href="{{ $songs->url($songs->currentPage()+1) }}">Next</a>
            </li>
        </ul>
    </nav>
    @endif
</div>
@endsection