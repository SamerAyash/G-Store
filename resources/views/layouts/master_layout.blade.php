<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.header.meta_header')
    </head>
    <body style="font-family:'sans-serif !important'">
        <header>
            @include('layouts.header.header')
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
            @include('layouts.footer.footer')
        </footer>
        @include('layouts.footer.meta_footer')
    </body>
</html>
