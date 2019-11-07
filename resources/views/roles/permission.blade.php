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
	<h3>{{$roles->name}}</h3>
	<form method="post" action="{{ route('roles.permissions', $roles->id) }}">
	@csrf
		<table class="table table-striped">
			<thead>
				<tr>
				<th></th>
				<th>Controllers</th>
				<th>Alias</th>
				<th>Routes</th>
				<th>Method</th>
				</tr>
			</thead>
			<tbody>
				@foreach($controllers as $c_key => $c_val)
					@if(count($c_val) == 0)
						@continue
					@endif
					<tr>
						<td><input type="checkbox" class="check_all_btn" data-rel="{{$c_key}}" id="{{$c_key}}"></td>           
						<td><label for="{{$c_key}}">{{$c_key}}</label></td>           
						<td></td>           
						<td></td>           
						<td></td>           
					</tr>
					
						@foreach($c_val as $a_key => $a_val)
							<tr>
								<td></td>           
								<td style='text-align:right;'><input type="checkbox" class="check_this" data-rel="{{$c_key}}"  name="role_permission[{{$a_key}}]" id="permission_{{$a_key}}" {{ (in_array($a_key, $role_permissions))?"checked":"" }}></td>           
								<td><label for="permission_{{$a_key}}">{{$a_key}}</label></td>           
								<td><label for="permission_{{$a_key}}">{{$a_val['router_group']}}</label></td>           
								<td><label for="permission_{{$a_key}}">{{$a_val['method']}}</label></td>           
							</tr>
						@endforeach					
				@endforeach
			</tbody>
		</table>
		<button type="submit" class="btn btn-primary">Update Permissions</button>
	</form>
<div>
@endsection


@section('page-script')
<script type="text/javascript">
jQuery(function(){	
	jQuery(".check_all_btn").change(function(){
		
		var relation = jQuery(this).data('rel');
		if(jQuery(this).prop('checked')) 
		{
			jQuery(".check_this[data-rel="+relation+"]").prop('checked',true);
		} 
		else 
		{
			jQuery(".check_this[data-rel="+relation+"]").prop('checked',false);
		}
		
	});
	
	jQuery(".check_this").change(function(){
		
		var relation = jQuery(this).data('rel');
		
		var tot = jQuery(".check_this[data-rel="+relation+"]").length;
		var checked = jQuery(".check_this[data-rel="+relation+"]:checked").length;

		if(tot==checked) 
		{
			jQuery(".check_all_btn[data-rel="+relation+"]").prop('checked',true);
		}
		else
		{
			jQuery(".check_all_btn[data-rel="+relation+"]").prop('checked',false);
		}

	});

});
</script>
@endsection