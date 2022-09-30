@role('admin|store')
<x-store-products :products="$products" />
@else
<x-user-products :products="$products" />
@endrole
