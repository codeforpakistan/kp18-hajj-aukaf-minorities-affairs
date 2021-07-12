
<a href="{{ route('admin.disciplines.show', [$id]) }}"><i class="glyphicon glyphicon-eye-open"></i></a>
<a href="{{ route('admin.disciplines.edit', [$id]) }}"><i class="glyphicon glyphicon-edit"></i></a>
<a href="#" onclick="event.preventDefault(); deleteAlert({{ $id }});"><i class="glyphicon glyphicon-trash"></i></a>
{!! Form::open(['route' => ['admin.disciplines.destroy', [$id]], 'method' => 'DELETE', 'style' => "display:none;", 'id' => "delete-row-" . $id]) !!}
{!! Form::close() !!}