@extends('layouts.master')

@section('content')

<div class="container">

    <!-- New Question Form -->

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>Create a New Question</h1>
            {!! Form::open(['route' => 'questions.store']) !!}
            <div class="panel panel-default">
                <div class="panel-heading">
                    Question
                </div>
                <div class="panel-body">
                    <section class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group" >
                                {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group" >
                                {!! Form::label('body', 'Body', ['class' => 'control-label']) !!}
                                {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('standards', 'Standards', ['class' => 'control-label']) !!}
                                <select id="standard_list" class="form-control" multiple>
                                    @foreach ($standards->where('type', 'MPAC') as $standard)
                                        <option value="{{ $standard->id }}">{{ $standard->name }} : {{ $standard->description }}</option>
                                    @endforeach
                                    @foreach ($standards->where('type', 'Learning Objective') as $standard)
                                        <option value="{{ $standard->id }}">{{ $standard->name }} : {{ $standard->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            {!! Form::submit('Post Question', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    
</div>

@endsection
