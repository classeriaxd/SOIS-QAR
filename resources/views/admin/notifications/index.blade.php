@extends('layouts.admin-app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-10">
            {{-- Success Alert --}}
                @if (session()->has('success'))
                    <div class="flex-row text-center" id="success_alert">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            {{-- Error Alert --}}
                @if (session()->has('error'))
                    <div class="flex-row text-center" id="success_alert">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            {{-- Title and Breadcrumbs --}}
            <div class="row">
                {{-- Title --}}
                <h2 class="display-2 text-center">Notifications</h2>
                {{-- Breadcrumbs --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.home')}}" class="text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Notifications
                        </li>
                    </ol>
                </nav>
            </div>
        	<div class="row justify-content-center pb-1">
        		<div class="col-md-8">
                    <div class="flex-row my-2 text-center">
                        <a href="{{route('admin.notifications.create')}}"
                        class="btn btn-secondary text-white my-1"
                        role="button">
                            Create Notification
                        </a>
                    </div>

                    <div class="card">
                        <h5 class="card-header card-title text-center bg-maroon text-white fw-bold">All Notifications</h5>
                        <div class="card-body">
                        @if($allNotifications->isNotEmpty())
                        <div class="row mb-2">
                            <div class="col text-center">
                                <form method="POST" action="{{route('admin.notifications.markAllAsRead')}}">
                                    <button type="submit" class="btn btn-primary text-white">Mark all as Read</button>
                                    @csrf
                                </form>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            {{ $allNotifications->links() }}
                        </div>
                        
                        @foreach($allNotifications as $notification)
                            <a href="
                                    @if($notification->type == 4)
                                        {{-- Accomplishment Reports --}}
                                        {{route('admin.accomplishmentReports.redirectFromNotification', ['accomplishmentReportUUID' => $notification->link])}}
                                    @else
                                        #
                                    @endif" 
                            class="text-decoration-none text-dark">
                                <div class="row m-2 p-1 border border-dark">
                                    <div class="col">
                                        <h5 class="text-center font-weight-bold">
                                            {{$notification->title}}
                                            @if($notification->read_at == NULL)
                                            <span class="badge rounded-pill bg-primary text-white">New</span>
                                            @endif
                                        </h5>
                                        <p class="text-center">{{$notification->description}}</p>
                                        <p class="text-center">{{date_format(date_create($notification->created_at), 'F d, Y - h:i A')}}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        <div class="row justify-content-center">
                            {{ $allNotifications->links() }}
                        </div>
                        @else
                            <h6 class="text-center">No notifications found!</h6>
                        @endif
                        </div>
                    </div>
        		</div>
        	</div>

        	<hr>

        	<div class="flex-row my-2 text-center">
                    <a href="{{route('admin.home')}}"
                    class="btn btn-secondary text-white"
                    role="button">
                        <i class="fas fa-home"></i> Go Home
                    </a>
            </div>
        </div>
    </div>
</div>
@endsection
