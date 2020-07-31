@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Create post</h1>
                <form action="{{action("PostsController@store")}}" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="content">Description</label>
                        <textarea rows="5" class="form-control" name="content" ></textarea>
                    </div>
                    <div class="custom-file mb-3">
                            <input type="file" name="img" id="img" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>

@endsection
