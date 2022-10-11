@role('user')
    @include('user_sync')
@else
    @include('store_sync')
@endrole
