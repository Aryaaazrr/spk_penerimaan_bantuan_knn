<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="/">SPK</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="index.html" class="logo me-auto"><img src="{{ asset('assets/img/logo.png') }}" alt=""
                class="img-fluid"></a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="/" class="active">Home</a></li>
                <li><a href="/">Info Penerimaan</a></li>
                <li><a href="{{ route('login') }}" class="getstarted">Login Admin</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

    </div>
</header>
