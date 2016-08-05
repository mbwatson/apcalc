@extends('layouts.master')

@section('title', $discussion->title)

@section('breadcrumbs', Breadcrumbs::render('discussions.show', $discussion))

@section('content')

<div class="container">

    <!-- Discussion -->

    <div class="panel panel-default" id="post">
        <div class="panel-heading">
            {{ $discussion->title }}
            <div class="btn-group pull-right">
                @if ($discussion->user == Auth::user() || Auth::user()->admin)
                    <div class="btn-group pull-right post-options" style="opacity: 0.2;">
                        <!-- Edit -->
                        <a href="{{ route('discussions.edit', $discussion->id) }}" role="button" class="btn btn-sm btn-link" style="padding-top: 14px;">
                            <i class="glyphicon glyphicon-edit"></i></a>
                        <!-- Delete -->
                        {!! Form::open(['route' => ['discussions.destroy', $discussion], 'method' => 'delete', 'style' => 'display: inline;']) !!}
                            <button type="submit" class="btn btn-sm btn-link"><i class="glyphicon glyphicon-remove"></i></button>
                        {!! Form::close() !!}
                    </div>
                @endif
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="user-info {{ $discussion->user->isOnline() ? 'active-' : '' }}user text-center">
                        <a href="{{ route('users.show', $discussion->user) }}">
                            <img class="avatar" src="{{ url('/') }}/avatars/{{ $discussion->user->avatar }}"><br />
                            <span class="username">{{ $discussion->user->name }}</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-10">
                    {{ $discussion->body }}
                </div>
            </div>
        </div>
        <div class="panel-footer meta">
            <span class="glyphicon glyphicon-calendar"></span>{{ $discussion->created_at->diffForHumans() }}
        </div>
    </div>

    <!-- Responses List -->

    @if (count($discussion->responses) > 0)
        @foreach ($discussion->responses as $response)
            @include('partials.response', $response)
        @endforeach
    @endif

    <!-- New Response Form -->

    {!! Form::open(['route' => 'responses.store']) !!}
    {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'I\'ve got something to say!']) !!}
    {!! Form::hidden('discussion_id', $discussion->id) !!}
    <br />
    {!! Form::submit('Post Response', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

</div>

@endsection

@section('footer')
<script type="text/javascript">
    $("#post").hover(function(){
        $(".post-options").fadeTo("fast", 1, "swing");
    },
    function(){
        $(".post-options").fadeTo("fast", 0.2, "swing");
    });
</script>
@endsection