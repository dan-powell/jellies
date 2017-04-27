<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

@include('jellies::foundation.components.header.header')

<body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">

        <header class="main-header">

            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">SL</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{{ config('app.name') }}</span>
            </a>

            @include('jellies::foundation.components.navigation.navigationTop')

        </header>
        <!-- Left side column. contains the logo and sidebar -->

        @include('jellies::foundation.components.navigation.navigationSide')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">

                    {!! Notification::showAll() !!}

                    @if(isset($errors) && count($errors->all()))
                        <div class="alert alert-warning">
                            <p><strong>The following errors occured:</strong></p>
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>

            @yield('body')

        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                {{ config('app.version') }}
            </div>
            <strong>Developed by <a href="http://dan-powell.uk">Dan Powell</a>.</strong>
        </footer>

        @include('jellies::foundation.components.controls.controls')

        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>

    @include('jellies::foundation.components.footer.footer')

</body>
</html>
