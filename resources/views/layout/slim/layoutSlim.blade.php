@extends('jellies::foundation.app.foundationApp')

@section('body')
    <section class="content-header">
      <h1>
        @yield('title')
      </h1>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @yield('main')
            </div>
        </div>
    </div>
@endsection
