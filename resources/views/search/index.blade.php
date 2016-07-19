@extends('layouts.master')

@section('content')

<div class="container">
    
    <header>Search</header>
    
    <!-- Search Form -->

    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route' => ['search.results'], 'class' => 'search-form']) !!}
            <div class="input-group" >
            	{!! Form::text('query', null, ['class' => 'form-control', 'placeholder' => 'Search Query']) !!}
				<div class="input-group-btn">
					<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            	</div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
