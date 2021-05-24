
<a href="{{ route('admin.institute-types.show', [$id]) }}"><i class="glyphicon glyphicon-eye-open"></i></a>
<a href="{{ route('admin.institute-types.edit', [$id]) }}"><i class="glyphicon glyphicon-edit"></i></a>
<a href="#" onclick="event.preventDefault(); deleteAlert{{ $id }}();"><i class="glyphicon glyphicon-trash"></i></a>
{!! Form::open(['route' => ['admin.institute-types.destroy', [$id]], 'method' => 'DELETE', 'style' => "display:none;", 'id' => "delete-row-" . $id]) !!}
{!! Form::close() !!}
<script>
    function deleteAlert{{ $id }}() {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                document.getElementById('delete-row-{{ $id }}').submit()
            } else {
                swal("You canceled deleting the record!");
            }
        });
    }
</script>