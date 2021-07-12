
<a href="{{ route('admin.religions.show', [$id]) }}"><i class="glyphicon glyphicon-eye-open"></i></a>
<a href="{{ route('admin.religions.edit', [$id]) }}"><i class="glyphicon glyphicon-edit"></i></a>
<a href="#" onclick="event.preventDefault(); deleteAlert({{ $id }});"><i class="glyphicon glyphicon-trash"></i></a>
{!! Form::open(['route' => ['admin.religions.destroy', [$id]], 'method' => 'DELETE', 'style' => "display:none;", 'id' => "delete-row-" . $id]) !!}
{!! Form::close() !!}