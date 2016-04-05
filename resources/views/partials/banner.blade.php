<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->

    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <img src="{{asset('images/banners/test3.png')}}" alt="First slide">
            <div class="carousel-caption hidden-xs">
                <h1>Slide 1</h1>
                <h3>Aenean a rutrum nulla. Vestibulum a asd sssadasdsa sas</h3>
                <span>Read more</span>
            </div>
            <div class="carousel-caption-mobile visible-xs-block">
                <span>Read more</span>
                <b>Slide 1</b><br>
                Aenean a rutrum nulla. Vestibulum a asd sssadasdsa sas
            </div>
        </div>

        <div class="item">
            <img src="{{asset('images/banners/test3.png')}}" alt="Second slide">
            <div class="carousel-caption hidden-xs">
                <h1>Slide 2</h1>

                <h3>ARex See see kok isnag</h3>
                <span>Read more</span>
            </div>
            <div class="carousel-caption-mobile visible-xs-block">
                <span>Read more</span>
                <b>Slide 2</b><br>

                ARex See see kok isnag
            </div>
        </div>

    </div>
    <a class="left carousel-control hidden-xs" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control hidden-xs" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>