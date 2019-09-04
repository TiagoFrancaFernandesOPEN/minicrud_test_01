@php ($logged = false)
@isset($login)
@php ($logged = true)
@switch ($login['user_profile'])            
    @case(1)
    @php ($profile_type = 'ADMIN')
        @break

    @case(2)
    @php ($profile_type = 'MANAGER')
        @break

    @default
    @case(2)
    @php ($profile_type = 'USER')
@endswitch
@endisset

<li><a href="{{ route('site.home') }}">Home</a></li>

@if($logged)
<li><a href="{{ route('users.list') }}">Users list</a></li>
<li>{{ $login['user_fullname'] }} ({{ $profile_type }})</li>
<li><a href="{{ route('auth.logout') }}" class="dropdown-trigger btn">Logout</a></li>
@else
<li><a href="{{ route('login.form') }}" class="dropdown-trigger btn">Login</a></li>
@endif