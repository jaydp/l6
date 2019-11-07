@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <a href="{{ route('roles.refresh_permissions')}}"  class="btn btn-danger">Refresh Permissions</a>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Description</td>
          <td colspan="3">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>
            <td>{{$role->description}}</td>
            <td><a href="{{ route('roles.edit',$role->id)}}" class="btn btn-primary">Edit</a></td>
            <td><a href="{{ route('roles.permissions',$role->id)}}" class="btn btn-primary">Permissions</a></td>
            <td>
                <form action="{{ route('roles.destroy', $role->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection