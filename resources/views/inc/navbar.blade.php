<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        @php
        $warnedTerms = DB::select('SELECT * FROM perjanjian
        WHERE datediff(current_date(), tanggal_akhir) >= -150 AND
        datediff(current_date(), tanggal_akhir) <= 0'); $expiredTerms=DB::select('SELECT * FROM perjanjian WHERE tanggal_akhir < current_date()'); @endphp <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Table</a>
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Notifikasi</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="warning">
                            {{ count($warnedTerms) }} Warning Perjanjian
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="warning">
                            {{ count($expiredTerms) }} Expired Perjanjian
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
    {{-- <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <li>
                    <a href="/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="/charts"><i class="fa fa-bar-chart-o fa-fw"></i> Charts</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-table fa-fw"></i> Tables<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="/perjanjian">Perjanjian</a>
                        </li>
                        <li>
                            <a href="/dokumen">Dokumen</a>
                        </li>
                        <li>
                            <a href="/mitra">Mitra</a>
                        </li>
                        <li>
                            <a href="/peserta">Peserta</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div> --}}
    <!-- /.navbar-static-side -->
</nav>

{{-- <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
</div>

<!--/navbar-right-->
<ul class="nav navbar-top-links navbar-right">
    <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
</ul>
<!--#/navbar-right-->





</nav> --}}