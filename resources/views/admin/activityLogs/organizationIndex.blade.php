@extends('layouts.admin-app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- Title and Breadcrumbs --}}
            <div class="d-flex justify-content-between align-items-center mb-2">
                {{-- Title --}}
                <h2 class="display-7 text-left text-break">{{ $organization->organization_acronym }} Activity Logs</h2>

                {{-- Organization Logo --}}
                <img src="/storage/{{ $organizationLogo }}" style="max-width: 7em; max-height: 7em; min-height: 7em; min-width: 7em;">

                {{-- Breadcrumbs --}}
                <nav aria-label="breadcrumb align-items-center">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}" class="text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $organization->organization_acronym }} Activity Logs
                        </li>
                    </ol>
                </nav>
            </div>

            {{-- Event Table --}}
            <div class="row my-2">
                @if($activityLogs->isNotEmpty())

                <div class="d-flex justify-content-center">
                        {{ $activityLogs->links() }}
                </div>

                <table class="table table-striped table-hover table-bordered border border-dark" id="eventTable">
                    <thead class="text-white fw-bold bg-maroon">
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Student</th>
                        <th class="text-center" scope="col">Course</th>
                        <th class="text-center" scope="col">Details</th>
                        <th class="text-center" scope="col">Time</th>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($activityLogs as $log)
                        <tr>
                            <td scope="row" class="text-center">{{ $i }}</td>
                            <td>{{ $log->user->full_name }} <br> {{ $log->user->student_number ?? 'N/A'}} </td>
                            <td>{{ $log->user->course->organization->organization_acronym ?? 'N/A'}} - {{ $log->user->course->course_acronym ?? 'N/A'}}</td>
                            <td>{{ $log->details }}</td>
                            <td>{{ $log->elapsed_time }}</td>
                        </tr>
                        @php $i += 1; @endphp
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                        {{ $activityLogs->links() }}
                </div>

                @else
                <p class="text-center">
                    No Activity Log Found. :(
                </p>
                @endif
            </div>
        </div>
    </div>

    <hr>
    
    <div class="flex-row my-2 text-center">
        <a href="{{route('admin.activityLogs.index')}}"
        class="btn btn-secondary text-white"
        role="button">
            <i class="fas fa-arrow-left"></i> Go Back to All Activity Logs
        </a>

        <span>or</span>

        <a href="{{route('admin.home')}}"
            class="btn btn-secondary text-white"
            role="button">
                <i class="fas fa-home"></i> Go Home
        </a>    
    </div>

</div>
@endsection

@push('scripts')
    {{-- Import Datatables --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
@endpush

@section('scripts')
    <script type="module">
        // Simple-DataTables
        // https://github.com/fiduswriter/Simple-DataTables
        window.addEventListener('DOMContentLoaded', event => {
            const dataTable = new simpleDatatables.DataTable("#eventTable", {
                perPage: 30,
                searchable: true,
                labels: {
                    placeholder: "Search Logs...",
                    noRows: "No logs to display in this page or try in the next page.",
                },
            });
        });
    </script>
@endsection
