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
  <table class="table table-striped">
    <thead>
        <tr>
          <th></th>
          <th>Controllers</th>
          <th>Alias</th>
          <th>Routes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($controllers as $c_key => $c_val)
			@if(count($c_val) == 0)
				@continue
			@endif
			<tr>
				<td><input type="checkbox"></td>           
				<td>{{$c_key}}</td>           
				<td></td>           
				<td></td>           
			</tr>
			
				@foreach($c_val as $a_key => $a_val)
					<tr>
						<td></td>           
						<td style="text-align:right;"><input type="checkbox" {{ (in_array($a_key, $permissions))?'checked':'' }}></td>           
						<td>{{$a_key}}</td>           
						<td>{{implode(", ",$a_val['router_group'])}}</td>           
					</tr>
				@endforeach				
			
        @endforeach
    </tbody>
  </table>
<div>
@endsection