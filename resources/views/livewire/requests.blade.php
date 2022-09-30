<div>
    @role('store|admin')
    <x-store-requests :requests="$requests"/>
    @else
    <x-user-requests :requests="$requests"/>
    @endrole
</div>
