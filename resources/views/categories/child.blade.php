<tr>
	<td>{{$child_category->id}}</td>
	<td>{{ $prefix }} {{$child_category->name}}</td>
	<td>{{$child_category->description}}</td>
	<td><a href="{{ route('categories.edit',$child_category->id)}}" class="btn btn-primary">Edit</a></td>
	<td>
		<form action="{{ route('categories.destroy', $child_category->id)}}" method="post">
		  @csrf
		  @method('DELETE')
		  <button class="btn btn-danger" type="submit">Delete</button>
		</form>
	</td>
</tr>
@if ($child_category->categories)
	@foreach ($child_category->categories as $childCategory)
		@include('categories/child', ['child_category' => $childCategory,'prefix' => $prefix.'-'])
	@endforeach
@endif