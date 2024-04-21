@extends('layouts.app')

@section('content')
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url(assets/img/slide/slide-1.jpg)">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Sailor</span></h2>
                            <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui
                                aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem
                                mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti
                                vel. Minus et tempore modi architecto.</p>
                            <a href="/" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read
                                More</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item" style="background-image: url(assets/img/slide/slide-2.jpg)">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">Lorem Ipsum Dolor</h2>
                            <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui
                                aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem
                                mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti
                                vel. Minus et tempore modi architecto.</p>
                            <a href="/" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read
                                More</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item" style="background-image: url(assets/img/slide/slide-3.jpg)">
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animate__animated animate__fadeInDown">Sequi ea ut et est quaerat</h2>
                            <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui
                                aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem
                                mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti
                                vel. Minus et tempore modi architecto.</p>
                            <a href="/" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read
                                More</a>
                        </div>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </section>

    <main id="main">
        <section id="portfolio" class="portfolio">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            {{-- <li data-filter="*" class="filter-active">Home</li> --}}
                            <li data-filter=".filter-app" class="filter-active">Home</li>
                            <li data-filter=".filter-card">Info Penerimaan</li>
                            <li data-filter=".filter-web">Login Admin</li>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container services">
                    <div class="container">
                        <div class="col-lg-12 col-md-12 portfolio-item filter-app">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="icon-box">
                                        <i class="bi bi-briefcase"></i>
                                        <h4><a href="#">Lorem Ipsum</a></h4>
                                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
                                            occaecati cupiditate non provident</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-card-checklist"></i>
                                        <h4><a href="#">Dolor Sitema</a></h4>
                                        <p>Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo
                                            consequat tarad limino ata</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-bar-chart"></i>
                                        <h4><a href="#">Sed ut perspiciatis</a></h4>
                                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                            fugiat
                                            nulla pariatur</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-binoculars"></i>
                                        <h4><a href="#">Nemo Enim</a></h4>
                                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt mollit
                                            anim id est laborum</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-brightness-high"></i>
                                        <h4><a href="#">Magni Dolore</a></h4>
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium
                                            voluptatum deleniti atque</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-calendar4-week"></i>
                                        <h4><a href="#">Eiusmod Tempor</a></h4>
                                        <p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum
                                            soluta
                                            nobis est eligendi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row portfolio-container services">
                    <div class="container">
                        <div class="col-lg-12 col-md-12 portfolio-item filter-card">
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="icon-box">
                                        <i class="bi bi-briefcase"></i>
                                        <h4><a href="#">Lorem Ipsum</a></h4>
                                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
                                            occaecati cupiditate non provident</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-card-checklist"></i>
                                        <h4><a href="#">Dolor Sitema</a></h4>
                                        <p>Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo
                                            consequat tarad limino ata</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-bar-chart"></i>
                                        <h4><a href="#">Sed ut perspiciatis</a></h4>
                                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                            fugiat
                                            nulla pariatur</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-binoculars"></i>
                                        <h4><a href="#">Nemo Enim</a></h4>
                                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt mollit
                                            anim id est laborum</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-brightness-high"></i>
                                        <h4><a href="#">Magni Dolore</a></h4>
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium
                                            voluptatum deleniti atque</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-calendar4-week"></i>
                                        <h4><a href="#">Eiusmod Tempor</a></h4>
                                        <p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum
                                            soluta
                                            nobis est eligendi</p>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="row portfolio-container services">
                    <div class="container">
                        <div class="col-lg-12 col-md-12 portfolio-item filter-web">
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="icon-box">
                                        <i class="bi bi-briefcase"></i>
                                        <h4><a href="#">Lorem Ipsum</a></h4>
                                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
                                            occaecati cupiditate non provident</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-card-checklist"></i>
                                        <h4><a href="#">Dolor Sitema</a></h4>
                                        <p>Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo
                                            consequat tarad limino ata</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-bar-chart"></i>
                                        <h4><a href="#">Sed ut perspiciatis</a></h4>
                                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                            fugiat
                                            nulla pariatur</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-binoculars"></i>
                                        <h4><a href="#">Nemo Enim</a></h4>
                                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt mollit
                                            anim id est laborum</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-brightness-high"></i>
                                        <h4><a href="#">Magni Dolore</a></h4>
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                                            praesentium
                                            voluptatum deleniti atque</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4 mt-md-0">
                                    <div class="icon-box">
                                        <i class="bi bi-calendar4-week"></i>
                                        <h4><a href="#">Eiusmod Tempor</a></h4>
                                        <p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum
                                            soluta
                                            nobis est eligendi</p>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Portfolio Section -->

    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection
