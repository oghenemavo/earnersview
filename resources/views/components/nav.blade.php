<div class="gen-account-holder">
    <a href="javascript:void(0)" id="gen-user-btn"><i class="fa fa-user"></i></a>
    <div class="gen-account-menu">
        <ul class="gen-account-menu">
            <!-- Pms Menu -->
            <li>
                <a href="{{ route('user.profile') }}"><i class="fa fa-user"></i>
                    Profile
                </a>
            </li>
            <li>
                <a href="library.html"><i class="fa fa-list"></i>
                    Earnings 
                </a>
            </li>
            <li>
                <a href="library.html"><i class="fa fa-list"></i>
                    Transactions History 
                </a>
            </li>
            <!-- Library Menu -->
            <li>
                <a href="{{ route('user.settings') }}"><i class="fa fa-cog"></i>
                    Settings 
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                    <i class="fas fa-sign-out-alt"></i>
                    Log out 
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    </div>
</div>