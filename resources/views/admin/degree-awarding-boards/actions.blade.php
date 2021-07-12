
<a href="{{ route('admin.degree-awarding-boards.show', [$id]) }}"><i class="glyphicon glyphicon-eye-open"></i></a>
<a href="{{ route('admin.degree-awarding-boards.edit', [$id]) }}"><i class="glyphicon glyphicon-edit"></i></a>
<a href="#" onclick="event.preventDefault(); deleteAlert({{ $id }});"><i class="glyphicon glyphicon-trash"></i></a>
{!! Form::open(['route' => ['admin.degree-awarding-boards.destroy', [$id]], 'method' => 'DELETE', 'style' => "display:none;", 'id' => "delete-row-" . $id]) !!}
{!! Form::close() !!}