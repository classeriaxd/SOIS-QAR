@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{route('accomplishmentreports.finalizeReport')}}" method="POST" enctype="multipart/form-data" id="reportChecklistForm">
                {{-- Title and Breadcrumbs --}}
                <div class="d-flex justify-content-between align-items-center">
                    {{-- Title --}}
                    <h2 class="display-7 text-left text-break">{{ $organization->organization_acronym }} Organization Report</h2>
                    {{-- Breadcrumbs --}}
                    <nav aria-label="breadcrumb align-items-center">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item">
                                <a href="{{route('home')}}" class="text-decoration-none">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('accomplishmentreports.index')}}" class="text-decoration-none">
                                    Accomplishment Reports
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Checklist
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="row text-center">
                    <p>All Events and Accomplishment for</p>
                    <p>{{ $range }}</p>
                </div>

                {{-- Checklist Page --}}
                <div class="row my-1">
                    <div class="col">
                        <div class="card card-body table-responsive">
                            <table class="table-hover table-bordered mx-auto w-100">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" colspan="6" class="align-middle bg-maroon text-white fw-bold fs-3">Event and Accomplishment Checklist</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th scope="col" style="width: 5%;">#</th>
                                        <th scope="col" style="width: 20%;">Page</th>
                                        <th scope="col" style="width: 25%;">Entry</th>
                                        <th scope="col" style="width: 20%;">Supporting<br>Documents</th>
                                        <th scope="col" style="width: 10%;">Toggle<br>Single</th>
                                        <th scope="col" style="width: 20%;">Toggle Select All</th>
                                    </tr>                       
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    <tr>
                                        <td scope="row" class="text-center">{{ $i }}</td>
                                        <td scope="row">Title Page</td>
                                        <td scope="row">&nbsp;</td>
                                        <td scope="row">&nbsp;</td>
                                        <td scope="row">&nbsp;</td>
                                        <td scope="row" class="text-center">
                                            <input type="checkbox" id="titlePage" name="titlePage" value="titlePage" disabled checked>
                                        </td>
                                    </tr>
                                    @php $i += 1; @endphp
                                    <tr>
                                        <td scope="row" class="text-center">{{ $i }}</td>
                                        <td scope="row">Officer Signatory</td>
                                        <td scope="row">&nbsp;</td>
                                        <td scope="row">&nbsp;</td>
                                        <td scope="row">&nbsp;</td>
                                        <td scope="row" class="text-center">
                                            <input type="checkbox" id="officerSignatory" name="officerSignatory" value="officerSignatory" disabled checked>
                                        </td>
                                    </tr>
                                    @php $i += 1; @endphp

                                    {{-- Events Row --}}
                                    @if($events->count() > 0)
                                        <tr>
                                            <td scope="row" colspan="6">
                                                <table class="w-100 table-bordered">
                                                    <tr class="table-primary">
                                                        <th scope="col" class="text-center" style="width: 5%;">{{ $i }}</td>
                                                        <td scope="col" style="width: 20%;">
                                                            Events
                                                            <input type="checkbox" id="parentEvent" onchange="eventToggleChildAndGrandchild(this)">
                                                        </td>
                                                        <td scope="col" style="width: 25%;">&nbsp;</td>
                                                        <td scope="col" style="width: 20%;">&nbsp;</td>
                                                        <td scope="col" style="width: 10%;">&nbsp;</td>
                                                        <td scope="col" class="text-center" style="width: 20%;">Go to Event</td>
                                                    </tr>
                                                    <tbody class="eventParentDraggable">
                                                        @php $j = 0; @endphp
                                                            @foreach($events as $event)
                                                                <tr class="text-center">
                                                                    <td scope="row">&nbsp;</td>
                                                                    <td scope="row">
                                                                        <span class="badge rounded-pill" style="background-color:{{$event->eventRole->background_color}}; color:{{$event->eventRole->text_color}};">
                                                                            {{$event->eventRole->event_role}}
                                                                        </span>
                                                                        |
                                                                        <span class="badge rounded-pill" style="background-color:{{$event->eventCategory->background_color}}; color:{{$event->eventCategory->text_color}};">
                                                                            {{$event->eventCategory->category}}
                                                                        </span>
                                                                    </td>
                                                                    <td scope="row">{{ $event->title }}</td>
                                                                    <td scope="row">
                                                                        <table class="w-100">
                                                                            <tr>
                                                                                <td>Event Details</td>
                                                                                <td><input type="checkbox" id="grandchildevent{{$j}}details" name="event{{$j}}details"></td>
                                                                            </tr>
                                                                            @if($event->eventImages->count() > 0)
                                                                                <tr>
                                                                                    <td>Images ({{ $event->event_images_count }})</td>
                                                                                    <td>
                                                                                        <input type="checkbox" id="grandchildevent{{$j}}images" name="event{{$j}}images" onchange="toggleChild(this,'images')">
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                            @if($event->eventDocuments->count() > 0)
                                                                                <tr>
                                                                                    <td>Documents ({{ $event->event_documents_count }})</td>
                                                                                    <td>
                                                                                        <input type="checkbox" id="grandchildevent{{$j}}documents" name="event{{$j}}documents" onchange="toggleChild(this,'documents')">
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        </table>
                                                                    </td>
                                                                    <td scope="row">
                                                                        <input type="checkbox" id="childevent{{$j}}" onchange="eventToggleGrandchild(this)">
                                                                    </td>
                                                                    <td scope="row">
                                                                        <a class="btn btn-primary text-white" href="{{route('event.show', ['event_slug' => $event->slug])}}" role="button" target="_blank"><span class="fas fa-external-link-alt"></span></a>
                                                                    </td>
                                                                </tr>
                                                                @php $j += 1; @endphp
                                                            @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        @php $i += 1; @endphp
                                    @else
                                        <tr>
                                            <td scope="row" class="text-center">{{ $i }}</td>
                                            <td scope="row">NO EVENTS FOUND</td>
                                            <td scope="row">&nbsp;</td>
                                            <td scope="row">&nbsp;</td>
                                            <td scope="row">&nbsp;</td>
                                            <td scope="row">&nbsp;</td>
                                        </tr>
                                        @php $i += 1; @endphp
                                    @endif

                                    {{-- Student Accomplishments Row --}}
                                    @if($studentAccomplishments->count() > 0)
                                        <tr>
                                            <td scope="row" colspan="6">
                                                <table class="w-100 table-bordered">
                                                    <tr class="table-primary">
                                                        <th scope="col" class="text-center" style="width: 5%;">{{ $i }}</td>
                                                        <td scope="col" style="width: 20%;">
                                                            Student<br>Accomplishments
                                                            <input type="checkbox" id="parentAccomplishment" onchange="accomplishmentToggleChildAndGrandchild(this)">
                                                        </td>
                                                        <td scope="col" style="width: 25%;">&nbsp;</td>
                                                        <td scope="col" style="width: 20%;">&nbsp;</td>
                                                        <td scope="col" style="width: 10%;"></td>
                                                        <td scope="col" class="text-center" style="width: 20%;">Go to<br>Accomplishment</td>
                                                    </tr>
                                                    <tbody class="studentAccomplishmentDraggable">
                                                        @php $j = 0; @endphp
                                                        @foreach($studentAccomplishments as $accomplishment)
                                                            <tr class="text-center">
                                                                <td scope="row">&nbsp;</td>
                                                                <td scope="row">{{ $accomplishment->student->full_name }}</td>
                                                                <td scope="row">{{ $accomplishment->title }}</td>
                                                                <td scope="row">
                                                                    <table class="w-100">
                                                                        <tr>
                                                                            <td>Accomplishment<br>Details</td>
                                                                            <td><input type="checkbox" id="grandchildaccomplishment{{$j}}details" name="accomplishment{{$j}}details"></td>
                                                                        </tr>
                                                                        @if($accomplishment->accomplishment_files_count > 0)
                                                                            <tr>
                                                                                <td>Evidences ({{ $accomplishment->accomplishmentFiles->count() }})</td>
                                                                                <td>
                                                                                    <input type="checkbox" id="grandchildaccomplishment{{$j}}files" name="accomplishment{{$j}}files" onchange="toggleChild(this,'files')">
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    </table>
                                                                </td>
                                                                <td scope="row">
                                                                    <input type="checkbox" id="childaccomplishment{{$j}}" onchange="accomplishmentToggleGrandchild(this)">
                                                                </td>
                                                                <td scope="row">
                                                                    <a class="btn btn-primary text-white" href="{{route('studentAccomplishment.show', ['accomplishmentUUID' => $accomplishment->accomplishment_uuid])}}" role="button" target="_blank">
                                                                        <span class="fas fa-external-link-alt"></span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @php $j += 1; @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td scope="row" class="text-center">{{ $i }}</td>
                                            <td scope="row">NO ACCOMPLISHMENT FOUND</td>
                                            <td scope="row">&nbsp;</td>
                                            <td scope="row">&nbsp;</td>
                                            <td scope="row">&nbsp;</td>
                                            <td scope="row">&nbsp;</td>
                                        </tr>
                                        @php $i += 1; @endphp
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

        <div class="col">
            <div class="card mb-3">
                <h4 class="card-header card-title text-center bg-maroon text-white fw-bold">Report Details</h4>
                    <div class="card-body">
                            {{-- Accomplishment Report Title --}}
                            <div class="form-group justify-content-center row my-1">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="title" class="col-md-4 col-form-label">Title <span class="required">*</span></label>
                                        <input id="title" 
                                            type="text" 
                                            class="form-control"
                                            name="title"
                                            placeholder="Report Title" 
                                            required>
                                    </div>
                                </div>  
                            </div>

                            {{-- Accomplishment Report Description --}}
                            <div class="form-group justify-content-center row my-1">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="description" class="col-md-4 col-form-label">Description</label>    
                                        <textarea id="description" 
                                            class="form-control" 
                                            name="description" 
                                            placeholder="Report Description">
                                        </textarea>
                                    </div>
                                </div>                                
                            </div>

                            {{-- Accomplishment Report Types --}}
                            <div class="form-group justify-content-center row my-1">
                                <div class="col-md-8">
                                       <label for="radioARFormatGroup" class="col-md-4 col-form-label">Select Format</label> <br>
                                       <div class="col" id="radioARFormatGroup">
                                          @foreach($accomplishmentReportTypes as $accomplishmentReportType)
                                              <div class="form-check">
                                                  <input type="radio" id="{{$accomplishmentReportType->accomplishment_report_type}}" name="ar_format" class="form-check-input" value="{{$accomplishmentReportType->accomplishment_report_type_id}}" required autocomplete="off">
                                                  <label class="form-check-label" for="{{$accomplishmentReportType->accomplishment_report_type}}">{{$accomplishmentReportType->accomplishment_report_type}}</label>
                                              </div>
                                          @endforeach
                                       </div>
                                </div>
                            </div>
                            @error('ar_format')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="flex-row my-2 text-center">
                                <button class="btn btn-primary text-white" type="submit">Submit Checklist</button>
                                @csrf
                                <input type="hidden" name="start_date" value="{{$start_date}}">
                                <input type="hidden" name="end_date" value="{{$end_date}}">
                                <input type="hidden" name="range_title" value="{{$rangeTitle}}">
                            </div>
                        </form>
                    </div>         
                </div>
            </div>
        </div>
	</div>

    <div class="flex-row my-2 text-center">
        <a href="{{ route('accomplishmentreports.create') }}"
            class="btn btn-secondary text-white"
            role="button">
                Go Back
        </a>
    </div>
    
</div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js" defer></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
@endpush
@section('scripts')
    <script type="text/javascript">
        // Checkbox JS
        function eventToggleChildAndGrandchild(parent)
        {
            const parentState = (parent.checked == true) ? true : false;
            const children = document.querySelectorAll('input[id*="event"]');
            children.forEach((checkbox) => {
                checkbox.checked = parentState;
            });
        }
        function eventToggleGrandchild(child)
        {
            const childState = (child.checked == true) ? true : false;
            const grandchildren = document.querySelectorAll('input[id*="grand'+child.id+'"]');
            grandchildren.forEach((checkbox) => {
                checkbox.checked = childState;
            });
        }

        function toggleChild(grandchild, attribute)
        {
            let child = grandchild.id;
            child = child.replace(attribute, 'details');
            const parentChildCheckbox = document.querySelector('input[id*="'+child+'"]');
            parentChildCheckbox.checked = true;
        }
        
        function accomplishmentToggleChildAndGrandchild(parent)
        {
            const parentState = (parent.checked == true) ? true : false;
            const children = document.querySelectorAll('input[id*="accomplishment"]');
            children.forEach((checkbox) => {
                checkbox.checked = parentState;
            });
        }
        function accomplishmentToggleGrandchild(child)
        {
            const childState = (child.checked == true) ? true : false;
            const grandchildren = document.querySelectorAll('input[id*="grand'+child.id+'"]');
            grandchildren.forEach((checkbox) => {
                checkbox.checked = childState;
            });
        }     
    </script>

    <script type="module">
        // Sortable JS
        const dragArea1 = document.querySelector('.eventParentDraggable');
        const dragArea2 = document.querySelector('.studentAccomplishmentDraggable');
        var sortable1 = Sortable.create(dragArea1);
        var sortable2 = Sortable.create(dragArea2);
    </script>

@endsection