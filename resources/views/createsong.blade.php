@extends("template")
@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
            <h1>Create Song:</h1>
            <hr>
            <div class="vr"></div>
            <form action="/createsong" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="writer">Singer:</label>
                    <input type="text" class="form-control" id="writer" name="singer">
                    @if ($errors->has('singer'))
                    <span class="text-danger">{{ $errors->first('singer') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="writer">Song Publisher:</label>
                    <input type="text" class="form-control" id="writer" name="publisher">
                    @if ($errors->has('publisher'))
                    <span class="text-danger">{{ $errors->first('publisher') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="written_by">Song Writers:</label>
                    <input type="text" class="form-control" id="written_by" name="written_by">
                    @if ($errors->has('written_by'))
                    <span class="text-danger">{{ $errors->first('written_by') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="written_by">Album Name:</label>
                    <input type="text" class="form-control" id="written_by" name="album_name">
                    @if ($errors->has('album_name'))
                    <span class="text-danger">{{ $errors->first('album_name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="written_by">Album Image Url:</label>
                    <input type="text" class="form-control" id="written_by" name="album_img">
                    @if ($errors->has('album_img'))
                    <span class="text-danger">{{ $errors->first('album_img') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="writer">Lyrics:</label>
                    <textarea class="form-control" id="writer" name="lyrics" rows="3" style="height:200px;"></textarea>
                    @if ($errors->has('lyrics'))
                    <span class="text-danger">{{ $errors->first('lyrics') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block">Add Song</button>
            </form>
        </div>
    </div>
</div>
@endsection