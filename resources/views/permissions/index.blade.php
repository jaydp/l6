@extends('layouts.app')

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
	<form method="post" action="{{ route('permissions.update') }}">
		<table class="table table-striped">
		<thead>
			<tr>          
				<th>Active</th>
				<th>Controllers</th>
				<th>Alias</th>
				<th>Methods</th>
				<th>Routes</th>
			</tr>
		</thead>
		<tbody>
			@foreach($controllers as $c_key => $c_val)
					@if(count($c_val) == 0)
						@continue
					@endif
					<tr>
						<td><input type="checkbox" ></td>           
						<td>{{$c_key}}</td>           
						<td></td>           
						<td></td>           
						<td></td>           
					</tr>			
						@foreach($c_val as $a_key => $a_val)
							<tr>
								<td></td> 
								<td><input type="checkbox" {{ (in_array($a_key, $permissions))?'checked':'' }} name="action[{{$c_key}}][{{$a_key}}]" value=""></td>
								<td>{{$a_key}}</td>           
								<td>{{$a_val['method']}}</td>           
								<td>{{$a_val['router_group']}}</td>           
							</tr>
						@endforeach				
					
			@endforeach
		</tbody>
		</table>
		 <button type="submit" class="btn btn-primary">Update</button>
	</form>
<div>
@endsection