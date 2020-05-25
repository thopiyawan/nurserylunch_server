<div id="header">
    <!-- <div class="color-line"></div> -->
    <nav role="navigation">
        <div id="logo" class="light-version">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/navbar-logo.png') }}">
            </a>
        </div>
        @guest

        @else
        
        <div class="navbar-right">
            <ul class="nav navbar-nav no-borders">
                <li class="">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{url('/')}}" >
                        <!-- <i class="fa fa-address-book" aria-hidden="true"></i> -->
                        <i class="fas fa-calendar-alt"></i>
                        <span>สำรับของฉัน</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link  {{ Request::is('kids') ? 'active' : '' }}" href="{{ url('/kids')}}" >
                        <i class="fas fa-users"></i>
                        <span>ข้อมูลเด็ก</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link  {{ Request::is('download') ? 'active' : '' }}" href="{{ url('/download')}}" >
                        <i class="fas fa-file-download"></i>
                        <span>รายงาน</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle {{ Request::is('setting') ? 'active' : '' }}" 
                    href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('/setting')}}">
                            <span>ตั้งค่าระบบ</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('ออกจากระบบ') }}
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
