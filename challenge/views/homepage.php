<?php 
include_once "layouts/navbar.php";
?>
<div class="container mt-2" id="content">
    <div class="row ">
        <div class="col-sm-6">
            <h1 class="text-center"> Welcome to Verhicle World</h1>
            <p>A sports car is a car designed with an emphasis on dynamic performance,
                such as handling, acceleration, top speed, the thrill of driving, and racing capability.
                Sports cars originated in Europe in early 1910s and are currently produced by many manufacturers
                around the world.</p>
            <p>In the United Kingdom, early recorded usage ogf the "sports car" was in The Times newspaper in
                1919.

                The term initially described two-seat roadsters (cars without a fixed roof), however, since the
                1970s the term has also been used for cars with a fixed roof (which were previously considered
                grand tourers).</p>
            <p>We hope you enjoy this grace time!</p>
        </div>
        <div id="demo" class="col-sm-6 carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://stimg.cardekho.com/images/carexteriorimages/930x620/Porsche/718/10989/1690874880367/front-left-side-47.jpg" alt="Los Angeles" class="d-block w-100 object-fit-fill border rounded">
                </div>
                <div class="carousel-item">
                    <img src="https://car-images.bauersecure.com/wp-images/3713/090_electric_porsche_boxster.jpg" alt="Chicago" class="d-block w-100 object-fit-fill border rounded">
                </div>
                <div class="carousel-item">
                    <img src="https://imagev3.vietnamplus.vn/w1000/Uploaded/2024/bokttj/2023_03_14/PORSCHE_TAYCANGTS_911.jpg.webp" alt="New York" class="d-block w-100 object-fit-fill border rounded">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/hQYRDNl-lGI?si=4FKGoMT5oDaxmnds/?start=10&&rel=0&autoplay=0&loop=1&playlist=hQYRDNl-lGI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="col-md-6 col-sm-12 mt-5">
            <h3 class="text-center">About Us</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <button type="button" style="width:fit-content" class="btn btn-primary d-flex flex-row-reverse schedule">Get Schedule >>></button>
        </div>
    </div>
</div>

<?php include "layouts/footer.php" ?>