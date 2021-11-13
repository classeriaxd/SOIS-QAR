<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AccomplishmentReport;
use App\Models\Event;
use App\Models\Organization;

use Carbon\Carbon;
use DateTime;

use App\Http\Controllers\Controller as Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $eventCount = Event::count();
        $organizationCount = Organization::count();
        $accomplishmentReportCount = AccomplishmentReport::count();
        $loginAlert = $this->showLoginAlert();

        
        
        return view('admin.home', 
            compact(
                'loginAlert',
                'eventCount',
                'organizationCount',
                'accomplishmentReportCount',
            ));
        
    }

    public function showLoginAlert()
    {
        $loginAlert = NULL;
        
        if(session()->get('showLoginAlert') == 1)
        {
            $loginAlert =  'You are logged in! :)';
            session()->decrement('showLoginAlert');
        }

        return $loginAlert;
    }

    private function calendarSample()
    {
        /*
        $calendarEvents = collect();
        $allEvents = Event::all();
        $calendarEventID = 1;
        foreach ($allEvents as $event) 
        {
            if((new DateTime($event->start_date))->diff(new DateTime($event->end_date))->d > 0)
            {
                $eventLengthInDays = (new DateTime($event->start_date))->diff(new DateTime($event->end_date))->d + 1;

                for ($i = 0; $i < $eventLengthInDays; $i++) 
                { 
                    $arr = array(
                        'id' => $calendarEventID,
                        'title' => $event->title,
                        'allDay' => false,
                        'start' => Carbon::parse(strtotime($event->start_date . $event->start_time))
                            ->setTimeZone('Asia/Manila')
                            ->addDays($i),
                        'end' => Carbon::parse(strtotime($event->start_date . $event->end_time))
                            ->setTimeZone('Asia/Manila')
                            ->addDays($i),
                        'url' => route('event.show', ['event_slug' => $event->slug]),
                    );
                    $calendarEvents->push($arr);
                    $calendarEventID+=1;
                }
            }
            else
            {
                $arr = array(
                    'id' => $calendarEventID,
                    'title' => $event->title,
                    'allDay' => false,
                    'start' => Carbon::parse(strtotime($event->start_date . $event->start_time))
                        ->setTimeZone('Asia/Manila'),
                    'end' => Carbon::parse(strtotime($event->end_date . $event->end_time))
                        ->setTimeZone('Asia/Manila'),
                    'url' => route('event.show', ['event_slug' => $event->slug]),
                );
               
                $calendarEvents->push($arr);
                $calendarEventID+=1;
            }
        }
        $calendarOptions = collect();
        // return view('', compact('calendarEvents'))
        // paste in view
        
        <div class="row">
            <div class="col">
                <div id="calendar"></div>
            </div>
        </div>

        @push('scripts')

            {{-- Calendar --}}
            <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css"/>

        @endpush
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
                    "timeZone": "Asia/Manila",
                    "locale":"en",
                    "firstDay": 0,
                    "displayEventTime":true,
                    "selectable":true,
                    "initialView":"dayGridMonth",
                    "validRange": 
                        {
                            "start": '2020-12-31',
                            "end": '2021-12-31',
                    "events":
                            JSON.parse('{{ $calendarEvents }}'.replace(/(&quot;)+/g, '"')),

                            
                },);
                calendar.render();
            });
        </script>
        */
    }
}
