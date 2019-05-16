@php
    $colors = array('light', 'info', 'success', 'primary', 'warning');
    $activeClass = 'btn btn-primary';
    $inactiveClass = 'btn btn-secondary';
    $active = array($filter === 0 ? $activeClass : $inactiveClass,
                    $filter === 1 ? $activeClass : $inactiveClass,
                    $filter === 2 ? $activeClass : $inactiveClass,
                    $filter === 3 ? $activeClass : $inactiveClass,
                    $filter === 4 ? $activeClass : $inactiveClass,
                    $filter === 5 ? $activeClass : $inactiveClass,
                    $filter === 6 ? $activeClass : $inactiveClass);
@endphp

<div class="container" style="margin-bottom:10px;">
    <button type="button" class="{{$active[0]}}" onclick="window.location='{{route('admin.userlisting')}}'">
        All <span class="badge badge-light">{{$user_counts[0]}}</span>
    </button>
    <button type="button" class="{{$active[1]}}" onclick="window.location='{{route('admin.regularuserlisting')}}'">
        Regular users <span class="badge badge-light">{{$user_counts[1]}}</span>
    </button>
    <button type="button" class="{{$active[2]}}" onclick="window.location='{{route('admin.moderatoruserlisting')}}'">
        Moderators <span class="badge badge-light">{{$user_counts[2]}}</span>
    </button>
    <button type="button" class="{{$active[3]}}" onclick="window.location='{{route('admin.adminuserlisting')}}'">
        Administrators <span class="badge badge-light">{{$user_counts[3]}}</span>
    </button>
    <button type="button" class="{{$active[4]}}" onclick="window.location='{{route('admin.politicianuserlisting')}}'">
        Active Politicians <span class="badge badge-light">{{$user_counts[4]}}</span>
    </button>
    <button type="button" class="{{$active[5]}}" onclick="window.location='{{route('admin.pendingpoliticianuserlisting')}}'">
        Pending politicians <span class="badge badge-light">{{$user_counts[5]}}</span>
    </button>
    <button type="button" class="{{$active[6]}}" onclick="window.location='{{route('admin.nonRegisteredPoliticianslisting')}}'">
        Non registered politicians <span class="badge badge-light">{{$user_counts[6]}}</span>
    </button>
</div>

<table class="container table table-bordered table-hover table-responsive table">
    <thead style="background-color: rgba(0,179,255,0.26)">
        <th class="">@sortablelink('id')</th>
        <th class="">@sortablelink('user_name','User Name')</th>
        <th class="">@sortablelink('first_name', 'First Name')</th>
        <th class="">@sortablelink('last_name', 'Last Name')</th>
        <th class="">@sortablelink('email', 'Email')</th>
        <th class="">@sortablelink('user_type', 'User Type')</th>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr class="{{ $colors[$user->user_type - 1] }}" onclick="window.location.href='view/user/{{ $user->id }}'" style="cursor:pointer;">
                <td class="">{{ $user->id }}</td>
                <td class="">{{ ucwords($user->user_name) }}</td>
                <td class="">{{ ucwords($user['first_name']) }}</td>
                <td class="">{{ ucwords($user->last_name) }}</td>
                <td class="">{{ $user->email }}</td>
                <td class="">{{ $user->getUserType() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="container">
    {{ $users->links() }}
</div>