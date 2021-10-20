@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        {{-- Login Alert --}}
            @if ($loginAlert != NULL)
                <div id="login_alert" style="position:fixed; top:0; right:0; width:20%;">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $loginAlert }}
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        {{-- Title and Breadcrumbs --}}
            <div class="row">
                {{-- Title --}}
                <h5 class="display-5 text-center">Welcome, Admin!</h5>
                {{-- Breadcrumbs --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item active" aria-current="page">
                            Home
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col">
                    <div id="calendar"></div>
                </div>
            </div>
            

        </div>
    </div>
</div>
@endsection
@push('scripts')

    {{-- Calendar --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css"/>

@endpush

@section('scripts')

    <script type="text/javascript">
        {{-- FullCalendar JS --}}
        var calendar;
        document.addEventListener("DOMContentLoaded", function(event) { 
            var calendarEl = document.getElementById('calendar')
            calendar = new FullCalendar.Calendar(calendarEl,
            {
                "headerToolbar":
                    {
                        "start": 'title',
                        "center": '',
                        "end": "today prev,next dayGridMonth timeGridWeek timeGridDay",
                        
                    },
                "footerToolbar":
                    {
                        "center": 'today prev,next dayGridMonth timeGridWeek timeGridDay',
                        
                    },
                "eventLimit":true,
                "timeZone": "local",
                "locale":"en",
                "firstDay": 0,
                "displayEventTime":true,
                "selectable":true,
                "initialView":"dayGridMonth",
                
                "events":
                        JSON.parse('{{ $calendarEvents }}'.replace(/(&quot;)+/g, '"')),

                        
            },);
            calendar.render();
        });
    </script>

    <script type="text/javascript">
        {{-- LOGIN ALERT TIMEOUT --}}
        window.setTimeout(function() {
            $("#login_alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 3000);
    </script>
    
@endsection