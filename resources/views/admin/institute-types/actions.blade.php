
<a href="{{ route('admin.institute-types.show', [$id]) }}"><i class="glyphicon glyphicon-eye-open"></i></a>
<a href="{{ route('admin.institute-types.edit', [$id]) }}"><i class="glyphicon glyphicon-edit"></i></a>
<a href="#" onclick="event.preventDefault(); deleteAlert({{ $id }});"><i class="glyphicon glyphicon-trash"></i></a>
{!! Form::open(['route' => ['admin.institute-types.destroy', [$id]], 'method' => 'DELETE', 'style' => "display:none;", 'id' => "delete-row-" . $id]) !!}
{!! Form::close() !!}