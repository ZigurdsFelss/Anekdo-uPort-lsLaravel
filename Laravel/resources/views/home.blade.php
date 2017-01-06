@extends('layouts.app')

@section('content')
    @include('include.message')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Anekdotes</div>

                <div class="panel-body">

                    <div class="container">
                        <h2>Jūsu anekdote</h2>

                        <form action="{{route('post.create')}}" role="form" method="post">
                            <div class="form-group">
                                <label for="comment">Raksriet anekdoti šeit:</label>
                                <textarea style="max-width: 78%" name="body" class="form-control" rows="5" placeholder="Jūsu anekdote..." id="new-post"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Pievienot anekdoti</button>
                            <input type="hidden" value="{{Session::token()}}"name="_token">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="row-posts">
        <div class="col-md-6 col-md-offset-1">
            <head><h3>Anekdotes:</h3></head>
            @foreach($posts as $post)
                <article class="post" data-postid="{{$post->id}}" >
                    <p>{{$post->body}}</p>
                    <div class="info">
                        Autors: {{$post->user->name}}<br>
                        Datums: {{$post->updated_at}}
                    </div>
                    <div class="interaction">
                    @if(Auth::user()==$post->user)
                        <a href="#" class="edit">Labot</a>
                        <a href="{{route('post.delete',['post_id'=>$post->id])}}">Dzēst</a>
                        @endif
                    </div>
                </article>

                @endforeach
        </div>
    </section>

</div>

    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Raksta labošana</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Labot</label><br>
                            <textarea class="'form-control" name="post-body" id="post-body"  cols="78"rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Aizvērt</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Saglabāt</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token='{{Session::token()}}';
        var url='{{route('edit')}}';
    </script>
@endsection
