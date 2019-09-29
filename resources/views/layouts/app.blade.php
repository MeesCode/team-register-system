<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body>
    <div id="app">
        
        @include('includes.navbar')

        <main class="py-4">
            <div class="container card p-5">
                @yield('content')  
            </div>
        </main>

        @include('includes.footer')
    </div>
</body>
</html>
