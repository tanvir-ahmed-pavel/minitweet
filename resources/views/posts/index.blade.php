@extends("layouts.app")

@section('content')

    <div style="padding-left: 7%; padding-right: 7%;">
        <div class="row">

            {{--            Create Post Section--}}

            @include('posts.include.createPost')

            {{--            Index Page Right Sidebar--}}

            @include('posts.include.indexRight')

            {{--            post section--}}

            @include('posts.include.post')

            {{--            Pagination Link--}}

            <div class="col-md-12">{{$posts->links()}}</div>

        </div>
    </div>
@endsection
