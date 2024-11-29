<nav class="homepage-navbar">
    <a href="{{ route('landingpage') }}" style="color: rgb(71, 71, 71)"><h1>OJT Portal | <span class="red">BatStateU</span></h1></a>
    <ul>
        <li>
            <a href="{{ route('landingpage') }}" class="{{ request()->route()->getName() == 'landingpage' ? 'red' : '' }}">HOME</a>
        </li>
        <li>
            <a href="{{ route('joblist') }}" class="{{ request()->route()->getName() == 'joblist' ? 'red' : '' }}">JOB LIST</a>
        </li>
        <li>
            @if(Auth::check())
                <a href="{{ route('login') }}" class="{{ request()->route()->getName() == 'login' ? 'red' : '' }}">DASHBOARD</a>
            @else
            <a href="{{ route('login') }}" class="{{ request()->route()->getName() == 'login' ? 'red' : '' }}">LOGIN</a>
            @endif
        </li>
    </ul>
</nav>
