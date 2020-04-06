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
  
	<div class="row">
		<div class="col-md-4">
			<form action="{{ route('transactions.index')}}" method="get">
				@csrf
				<input type="text" name="search" value="{{$search}}">&nbsp;
				<button class="btn btn-default" type="submit">Search</button>
			</form>
		</div>
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<select class="categories_list" name="categories">
				<option value="">Please Select</option>
				@if ($categories)
					@foreach ($categories as $cat)
						<option value="{{$cat->id}}">{{$cat->name}}</option>						
						@if ($cat->childrenCategories)
							@foreach ($cat->childrenCategories as $childCategory)
								@include('categories/select', ['child_category' => $childCategory,'prefix' => '-'])
							@endforeach
						@endif
					@endforeach
				@endif
			</select>
			&nbsp;
			<button class="btn btn-default assign-categories" type="submit">Assign</button>
		</div>
	</div>
	
  
  <table class="table table-striped transactions_list">
    <thead>
        <tr>
          <td><input type="checkbox" class="check_all_btn"></td>
          <td>Category</td>
          <td>Description</td>
          <td>Amount</td>
          <td>Time</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
        <tr>
            <td><input type="checkbox" class="check_this" name="checked" value="{{$transaction->id}}"></td>
            <td>{{App\Category::get_name_by_id($transaction->category_id)}}</td>
            <td>{{$transaction->description}}</td>
            <td>{{$transaction->amount}}</td>
            <td>{{$transaction->transaction_time}}</td>
            <td>
                
            </td>
        </tr>			
        @endforeach
    </tbody>
  </table>
<div>
<script type="text/javascript">
jQuery(function(){	
	jQuery(".check_all_btn").change(function(){
		
		if(jQuery(this).prop('checked')) 
		{
			jQuery(".check_this").prop('checked',true);
		} 
		else 
		{
			jQuery(".check_this").prop('checked',false);
		}
		
	});
	
	jQuery(".check_this").change(function(){
		
		var relation = jQuery(this).data('rel');
		
		var tot = jQuery(".check_this").length;
		var checked = jQuery(".check_this:checked").length;

		if(tot==checked) 
		{
			jQuery(".check_all_btn").prop('checked',true);
		}
		else
		{
			jQuery(".check_all_btn").prop('checked',false);
		}

	});
	
	jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
	
	jQuery(".assign-categories").click(function(e){
		
		e.preventDefault();
		
		var cat = jQuery(".categories_list").val();
		
		if(cat=='') return;
		
		var transactions = jQuery('.transactions_list').find('.check_this:checked');
		var transactions = [];
        jQuery('.transactions_list').find('.check_this:checked').each(function(i){
          transactions[i] = jQuery(this).val();
        });
		console.log(transactions);
		//transactions = transactions.serialize();
		
		jQuery.ajax({
			type:'POST',
			url:'transactions/assign',
			data:{cat:cat, transactions:transactions},
			success:function(data){
				console.log(data);
			}
        });
		
		return false;
	});

});
</script>
@endsection