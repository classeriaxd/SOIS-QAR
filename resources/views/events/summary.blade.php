@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-10">
            <div>
                <a href="/e/{{$year}}/summary/download"><button>Download PDF</button></a>
            </div>
    		<h2 class="display-6 text-center">{{ $year }}</h2>
@php
    $i = 0;
@endphp
@foreach($events as $event)
@php
    $i += 1;
@endphp
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" colspan="3">{{ $event->title }}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Date</th>
                  <td>{{ $event->date }}</td>
                </tr>
                <tr>
                  <th scope="row">Description</th>
                  <td>{{ $event->description }}</td>
                </tr>
                <tr>
                  <th scope="row">Objective</th>
                  <td>{{ $event->objective }}</td>
                </tr>
              </tbody>
            </table>
@php
    if ($i > 3): 
@endphp
            <div class="page-break"></div>
@php
    endif;
@endphp
@endforeach
        </div>
    </div>
</div>
@endsection
