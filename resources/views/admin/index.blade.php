@include('admin.layout.header')
@include('admin.layout.navbar')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

    </div>
    <!-- /.content-header -->
    @includeif('admin.layout.message')
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
</div>
@include('admin.layout.footer')
