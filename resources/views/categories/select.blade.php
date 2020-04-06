<option value="{{$child_category->id}}">{{ $prefix }} {{$child_category->name}}</option>
@if ($child_category->categories)
	@foreach ($child_category->categories as $childCategory)
		@include('categories/select', ['child_category' => $childCategory,'prefix' => $prefix.'-'])
	@endforeach
@endif