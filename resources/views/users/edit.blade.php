@extends('layouts.app')

@section('profile_edit')
	<div class="text-center">
		<h3>edit your profile</h3>
	</div>

	<div class="row">
		<div class="col-sm-6 offset-sm-3">	
		{!! Form::open(['route' => ['profile.edit', $id], 'method' => 'update']) !!}
			<div class="form-group">
				{!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
				{!! Form::submit('Update', ['class' => 'btn btn-success btn-block']) !!}
			</div>
		{!! Form::close() !!}
		</div>
	</div>
@endsection
