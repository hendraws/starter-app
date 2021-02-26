@include('backend.layout.header')
@include('backend.layout.navbar')
@include('backend.layout.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('front')}}"><i class="fas fa-fw fa-home"></i></a></li>
                    <?php $link = "" ?>
                    @for($i = 1; $i <= count(Request::segments()); $i++) @if($i < count(Request::segments()) & $i> 0)
                        <?php
                            if ($i > 1) {
                                $link .= "/" . Request::segment($i);
                            } else {
                                $link .= route('front') . "/" . Request::segment($i);
                            }
                        ?>
                        <li class="breadcrumb-item"><a href="<?= $link ?>">{{ ucwords(str_replace('-',' ',Request::segment($i)))}}</a></li>
                    @else <li class="breadcrumb-item active">{{ucwords(str_replace('-',' ',Request::segment($i)))}}</li>
                    @endif
                    @endfor
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            @yield('content')
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('backend.layout.footer')