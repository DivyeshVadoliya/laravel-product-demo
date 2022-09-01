@extends('layouts.adminPenal')
@section('container')
    <div class="tab-empty">
        <h2 class="display-4">No tab selected!</h2>
    </div>
    <script>
        @if(session('success'))
            alert("{{session('success')}}");
        @endif
    </script>
@endsection
