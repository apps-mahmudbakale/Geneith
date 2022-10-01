<div>
@role('admin|store')
<x-sales :sales="$sales" />
@else
<x-user-sales :sales="$sales" />
@endrole
</div>
