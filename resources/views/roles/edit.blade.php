@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Role
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('roles.update', $role->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="name">Name:</label>
              <input type="text" class="form-control" name="name" value="{{$role->name}}"/>
          </div>
          <div class="form-group">
              <label for="price">Description:</label>
              <input type="text" class="form-control" name="description" value="{{$role->description}}"/>
          </div>
          <button type="submit" class="btn btn-primary">Update Role</button>
      </form>
  </div>
</div>
@endsection