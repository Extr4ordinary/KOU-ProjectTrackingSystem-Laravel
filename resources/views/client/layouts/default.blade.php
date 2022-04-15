@include('client.layouts.header')
<sidebar-comp></sidebar-comp>
@yield('content')



@stack('scripts')
@include('client.layouts.footer')