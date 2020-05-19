<div id="header">
    <div class="color-line"></div>
    <nav role="navigation">
        <div id="logo" class="light-version">
            <a href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
        @guest

        @else
        
        <div class="navbar-right">
            <ul class="nav navbar-nav no-borders">
                <li class="">
                    <a class="nav-link" href="{{url('/')}}" >
                        <span>สำรับของฉัน</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link" href="{{ url('/kids')}}" >
                        <span>ข้อมูลเด็ก</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link" href="{{ url('/download')}}" >
                        <span>รายงาน</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>

        @endguest

    </nav>
</div>
