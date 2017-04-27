@extends('jellies::foundation.app.foundationApp')

@section('body')
    <section class="content-header">
      <h1>
        @yield('title')
      </h1>
    </section>

    <div class="content">
        @yield('main')
    </div>
@endsection
