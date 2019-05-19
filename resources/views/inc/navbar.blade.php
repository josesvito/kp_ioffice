<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/charts') }}">Charts</a>
                </li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Table</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/perjanjian">Perjanjian</a>
                        <a class="dropdown-item" href="/dokumen">Dokumen</a>
                        <a class="dropdown-item" href="/mitra">Mitra</a>
                        <a class="dropdown-item" href="/peserta">Peserta</a>
                    </div>
                </li>
                @endauth
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="log">Action Log</a>
                </li>

                @php
                $perjanjianController = App::make('\App\Http\Controllers\PerjanjianController');
                $warningPerjanjian = 0;
                $expiredPerjanjian = 0;
                foreach($perjanjianController->warningPerjanjian() as $p){
                    if($p->tanggal_akhir < date('Y-m-d')){
                        $expiredPerjanjian++;
                    } else {
                        $warningPerjanjian++;
                    }
                }
                @endphp

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Notifikasi</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="warning">
                            {{ $warningPerjanjian }}
                            Peringatan Perjanjian
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="warning">
                            {{ $expiredPerjanjian }}
                            Expired Perjanjian
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>