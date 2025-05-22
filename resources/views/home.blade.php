@extends('layout.default', [
    'appClass' => 'app-content-full-height',
    'appContentClass' => 'p-0',
])

@section('title', 'Calendar')

@push('css')
    <!-- Los estilos de SweetAlert2 vienen en el CSS compilado -->
@endpush

@push('js')
    <script src="/assets/plugins/moment/moment.js"></script>
    <script src="/assets/plugins/@fullcalendar/core/index.global.min.js"></script>
    <script src="/assets/plugins/@fullcalendar/daygrid/index.global.min.js"></script>
    <script src="/assets/plugins/@fullcalendar/timegrid/index.global.min.js"></script>
    <script src="/assets/plugins/@fullcalendar/list/index.global.min.js"></script>
    <script src="/assets/plugins/@fullcalendar/bootstrap/index.global.min.js"></script>
    <script src="/assets/plugins/@fullcalendar/interaction/index.global.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="/assets/js/d1/calendar.js"></script>
@endpush

@section('content')
    <!-- BEGIN calendar -->
    <div class="calendar">
        <!-- BEGIN calendar-body -->
        <div class="calendar-body">
            <div id="calendar"></div>
        </div>
        <!-- END calendar-body -->
    </div>
    <!-- END calendar -->
@endsection
