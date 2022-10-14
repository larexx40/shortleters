<?php include "./includes/header.php"; ?>
    <title>Home Page</title>
</head>
<style>
    .tab-content input,
    .tab-content select {
        background-clip: padding-box !important;
        border: 1px solid #969696 !important;
        box-shadow: none !important;
        height: 55px;
        outline: none !important;
        border-radius: 25px;
    }
    
    .tab-content input:focus,
    .tab-content select:focus {
        border: 2px solid #969696 !important;
    }
    
    ._ul9u8c {
        -webkit-box-pack: center !important;
        -webkit-box-align: center !important;
        -webkit-box-flex: 0 !important;
        width: 32px !important;
        height: 32px !important;
        flex-grow: 0 !important;
        flex-shrink: 0 !important;
        cursor: pointer !important;
        display: inline-flex !important;
        margin: 0px !important;
        padding: 0px !important;
        text-align: center !important;
        text-decoration: none !important;
        border-width: 1px !important;
        border-style: solid !important;
        border-color: rgb(176, 176, 176) !important;
        color: rgb(113, 113, 113) !important;
        font-family: inherit !important;
        outline: none !important;
        touch-action: manipulation !important;
        align-items: center !important;
        justify-content: center !important;
        background: rgb(255, 255, 255) !important;
        border-radius: 50% !important;
    }
    
    .title h4 {
        font-weight: 800;
    }
</style>

<body>

    <div id="user" v-cloak>
        <?php include "./includes/loading.php"; ?>
        <div class="body-wrapper">
            <?php include "./includes/search_and_logo.php"; ?>

            <!-- TODO <======== FILTER MODAL START =========> -->
            <div class="modal fade filter" id="staticBackdropfilter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <h6 class="modal-title" id="staticBackdropLabel">Filters</h6>
                            <div style="background-color: transparent; width: 2rem;height: 2px"></div>
                        </div>
                        <div class="modal-body">
                            <div class="price-range">
                                <div class="title">
                                    <h4>Price range
                                    </h4>
                                    <span>The average nightly price is $79</span>
                                </div>
                                <div class="my-3">
                                    <label for="customRange3" class="form-label">Example range</label>
                                    <input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3">
                                </div>

                            </div>
                            <div class="type-of-place">
                                <div class="title">
                                    <h4>Type of place</h4>
                                </div>
                                <div class="type-of-place-wrapper">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-1">
                                        <label class="form-check-label" for="flexCheckDefault-2">
                                <h6>Entire room</h6>
                                <span>A place to all yourself</span>
                            </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-2">
                                        <label class="form-check-label" for="flexCheckDefault-2">
                                <h6>Private room</h6>
                                <span>Your own room in a home or hotel, plus some shared common spaces</span>
                            </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-3">
                                        <label class="form-check-label" for="flexCheckDefault-3">
                                <h6>Shared room</h6>
                                <span>A sleeping space and common areas that may be shared with others</span>
                            </label>
                                    </div>
                                </div>
                            </div>
                            <div class="rooms-and-bed">
                                <div class="title">
                                    <h4>Rooms and beds</h4>
                                </div>
                                <div class="each-room">
                                    <div class="top"><span>Bedrooms</span></div>
                                    <div class="main" >
                                        <div class="bottom">
                                            <button class="active">Any</button>
                                            <button>1</button>
                                            <button>2</button>
                                            <button>3</button>
                                            <button>4</button>
                                            <button>5</button>
                                            <button>6</button>
                                            <button>7</button>
                                            <button>8+</button>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="each-room">
                                    <div class="top"><span>Bed</span></div>
                                    <div class="main" >
                                        <div class="bottom">
                                            <button class="active">Any</button>
                                            <button>1</button>
                                            <button>2</button>
                                            <button>3</button>
                                            <button>4</button>
                                            <button>5</button>
                                            <button>6</button>
                                            <button>7</button>
                                            <button>8+</button>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="each-room">
                                    <div class="top"><span>Bathrooms</span></div>
                                    <div class="main" >
                                        <div class="bottom">
                                            <button class="active">Any</button>
                                            <button>1</button>
                                            <button>2</button>
                                            <button>3</button>
                                            <button>4</button>
                                            <button>5</button>
                                            <button>6</button>
                                            <button>7</button>
                                            <button>8+</button>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="property-type">
                                <div class="title">
                                    <h4>Property type</h4>
                                </div>
                                <div class="property-wrap">
                                    <a href="#" class="each-property">
                                        <div class="logo"><img src="../assets/images/property1.jpg" alt="" class="img-fluid"></div>
                                        <div class="property-name"><span>House</span></div>
                                    </a>
                                    <a href="#" class="each-property">
                                        <div class="logo"><img src="../assets/images/property2.jpg" alt="" class="img-fluid"></div>
                                        <div class="property-name"><span>Apartment</span></div>
                                    </a>
                                    <a href="#" class="each-property">
                                        <div class="logo"><img src="../assets/images/property3.jpg" alt="" class="img-fluid"></div>
                                        <div class="property-name"><span>Guesthouse</span></div>
                                    </a>
                                    <a href="#" class="each-property">
                                        <div class="logo"><img src="../assets/images/property4.jpg" alt="" class="img-fluid"></div>
                                        <div class="property-name"><span>Hotel</span></div>
                                    </a>
                                </div>
                            </div>
                            <div class="amenities">
                                <div class="title">
                                    <h4>Amenities</h4>
                                </div>
                                <div class="amenities-inner">
                                    <div class="amenities-inner-one">
                                        <div class="top"><b>Essentials</b></div>
                                        <div class="body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-1">
                                                <label class="form-check-label" for="flexCheckDefault-1">
                                        Wifi
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-2">
                                                <label class="form-check-label" for="flexCheckDefault-2">
                                        Kitchen
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-3">
                                                <label class="form-check-label" for="flexCheckDefault-3">
                                        Washer
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-4">
                                                <label class="form-check-label" for="flexCheckDefault-4">
                                        Dryer
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-4">
                                                <label class="form-check-label" for="flexCheckDefault-4">
                                        Air Conditioning
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                                <label class="form-check-label" for="flexCheckDefault-6">
                                        Heating
                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="amenities-inner-two">
                                        <div class="top"><b>Features</b></div>
                                        <div class="body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-1">
                                                <label class="form-check-label" for="flexCheckDefault-1">
                                        Pool
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-2">
                                                <label class="form-check-label" for="flexCheckDefault-2">
                                        Hothub
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-3">
                                                <label class="form-check-label" for="flexCheckDefault-3">
                                        Free perking on premises
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-4">
                                                <label class="form-check-label" for="flexCheckDefault-4">
                                        EV Charger
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-4">
                                                <label class="form-check-label" for="flexCheckDefault-4">
                                        Crib
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                                <label class="form-check-label" for="flexCheckDefault-6">
                                        Gym
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                                <label class="form-check-label" for="flexCheckDefault-6">
                                        BBQ grill
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                                <label class="form-check-label" for="flexCheckDefault-6">
                                        Breakfast
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                                <label class="form-check-label" for="flexCheckDefault-6">
                                        Indoor Fireplace
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                                <label class="form-check-label" for="flexCheckDefault-6">
                                        Smoking allowed
                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="amenities-inner-three">
                                        <div class="top"><b>Location</b></div>
                                        <div class="body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-1">
                                                <label class="form-check-label" for="flexCheckDefault-1">
                                        Beachfront
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-2">
                                                <label class="form-check-label" for="flexCheckDefault-2">
                                        Waterfront
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-3">
                                                <label class="form-check-label" for="flexCheckDefault-3">
                                        Ski-in/Ski-out
                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="amenities-inner-three">
                                        <div class="top"><b>Safety</b></div>
                                        <div class="body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-1">
                                                <label class="form-check-label" for="flexCheckDefault-1">
                                        Smoke alarm
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-2">
                                                <label class="form-check-label" for="flexCheckDefault-2">
                                        Carbon monoxide alarm
                                    </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="show-hide"><a href="#">Show less</a></div>
                            </div>
                            <div class="booking-options">
                                <div class="title">
                                    <h4>Booking options</h4>
                                </div>
                                <div class="body">
                                    <div>
                                        <div class="left">
                                            <div class="top">
                                                <h6>Instant Book</h6>
                                            </div>
                                            <div class="bottom"><span>Listings you can book without waiting for Host approval</span>
                                            </div>
                                        </div>
                                        <div class="right">
                                            <div class="toggle">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="left">
                                            <div class="top">
                                                <h6>Self check-in</h6>
                                            </div>
                                            <div class="bottom"><span>Easy access to the property once you arrive</span></div>
                                        </div>
                                        <div class="right">
                                            <div class="toggle">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accessibility">
                                <div class="title">
                                    <h4>Accessibility features</h4>
                                </div>
                                <div class="sub-text">
                                    <p>This info was provided by the Host and reviewed by Airbnb.</p>
                                </div>
                                <div class="accessibility-inner-one">
                                    <div class="top"><b>Guest entrance and parking</b></div>
                                    <div class="body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-1">
                                            <label class="form-check-label" for="flexCheckDefault-1">
                                    Step-free guest entrance
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-2">
                                            <label class="form-check-label" for="flexCheckDefault-2">
                                    Guest entrance wider than 32 inches
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-3">
                                            <label class="form-check-label" for="flexCheckDefault-3">
                                    Accessible parking spot
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-4">
                                            <label class="form-check-label" for="flexCheckDefault-4">
                                    Step-free path to guest entrance
                                </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="accessibility-inner-two">
                                    <div class="top"><b>Bedroom</b></div>
                                    <div class="body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-5">
                                            <label class="form-check-label" for="flexCheckDefault-5">
                                    Step-free bedroom access
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                            <label class="form-check-label" for="flexCheckDefault-6">
                                    Bedroom entrance wider than 32 inches
                                </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="accessibility-inner-three">
                                    <div class="top"><b>Bathroom</b></div>
                                    <div class="body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-7">
                                            <label class="form-check-label" for="flexCheckDefault-7">
                                    Step-free bathroom entrance
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-8">
                                            <label class="form-check-label" for="flexCheckDefault-8">
                                    Bathroom entrance wider than 32 inches
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-9">
                                            <label class="form-check-label" for="flexCheckDefault-9">
                                    Shower grab Bar
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-10">
                                            <label class="form-check-label" for="flexCheckDefault-10">
                                    Toilet grab Bar
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-11">
                                            <label class="form-check-label" for="flexCheckDefault-11">
                                    Step-free shower
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-12">
                                            <label class="form-check-label" for="flexCheckDefault-12">
                                    Shower or bath chair
                                </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="accessibility-inner-four">
                                    <div class="top"><b>Adaptive Equipment</b></div>
                                    <div class="body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-13">
                                            <label class="form-check-label" for="flexCheckDefault-13">
                                    Ceiling or mobile hoist
                                </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="show-hide">
                                    <a href="#">Show more</a>
                                </div>
                            </div>
                            <div class="top-tiers">
                                <div class="title">
                                    <h4>Top tier stays</h4>
                                </div>
                                <div class="top-tiers-inner">
                                    <div class="left">
                                        <div class="top"><span>Superhost</span></div>
                                        <div class="middle"><span>Stay with recognized Hosts</span></div>
                                        <div class="link"><span><a href="#">Learn more</a></span></div>
                                    </div>
                                    <div class="right">
                                        <div class="toggle">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="host-language">
                                <div class="title">
                                    <h4>Host langugae</h4>
                                </div>
                                <form action="">
                                    <div class="host-language-inner">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                            <label class="form-check-label" for="flexCheckDefault1">English</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                            <label class="form-check-label" for="flexCheckDefault2">French</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                            <label class="form-check-label" for="flexCheckDefault3">German</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">
                                            <label class="form-check-label" for="flexCheckDefault4">Italian</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- <form class="form-floating">
                        <input type="email" class="form-control" id="floatingInputValue" placeholder="name@example.com"
                            value="test@example.com">
                        <label for="floatingInputValue">Input with value</label>
                    </form> -->

                        </div>
                        <div class="modal-footer">
                            <a href="#" class="cancel">Cancel all</a>
                            <a href="#" class="show">Show 1,000+ homes</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <======= FILTER MODAL ENDS ========> -->

            <!-- TODO <======== SEARCH BAR MODAL START =========> -->
            <div class="modal fade filter" id="staticBackdropfilter1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <h6 class="modal-title" id="staticBackdropLabel">Start Your Search</h6>
                            <div style="background-color: transparent; width: 2rem;height: 2px"></div>
                        </div>
                        <div class="modal-body">

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Stays
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Experiences</button>
                                </li>
                                <!--
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Online Experiences</button>
                                </li>-->
                            </ul>
                            <div class="tab-content" id="pills-tabContent" class="mb-0">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <form class="row">
                                        <div class="mb-3">
                                            <label class="form-label"><b>Destinations</b></label>
                                            <select class="form-select">
                                            <option>Disabled select</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="exampleInputPassword1" class="form-label"><b>Check In Date</b></label>
                                            <input type="text" class="form-control datepicker" placeholder="Choose Date">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="exampleInputPassword1" class="form-label"><b>Check out Date</b></label>
                                            <input type="text" class="form-control datepicker" placeholder="Choose Date">
                                        </div>
                                        <div class="col-12 mb-3 ">
                                            <small>Guests</small>
                                            <div class="dropdown ">
                                                <button class="btn dropdown-toggle d-block show" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true" style="width: calc(100% - 30px);border: 1px solid #969696 !important;border-radius:25px;border: 2px solid;
                                                border-radius: 25px;
                                                height: 39px;" type="button">
                                                1 Guests
                                                </button>
                                                <ul class="dropdown-menu w-100 " data-popper-placement="bottom-start">
                                                    <li>
                                                        <a class="dropdown-item">
                                                            <div role="group" class="d-flex justify-content-between px-2">
                                                                <div class="_bc4egv d-grid py-1">
                                                                    <div class="_1ynrq4v"><b>Adults</b></div>
                                                                    <div class="_1wh7hnv">Age 13+</div>
                                                                </div>
                                                                <div class="_jro6t0 d-flex align-items-center">
                                                                    <div class="d-flex gap-3 align-items-center">
                                                                        <span class="_ul9u8c prev">-</span>
                                                                        <span class="counter">8</span>
                                                                        <span class="_ul9u8c next">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div role="group" class="d-flex justify-content-between px-2" aria-labelledby="GuestPicker-book_it-form-adults" aria-describedby="GuestPicker-book_it-form-adults-subtitle">
                                                                <div class="_bc4egv d-grid py-1">
                                                                    <div class="_1ynrq4v"><b>Adults</b></div>
                                                                    <div class="_1wh7hnv">Age 13+</div>
                                                                </div>
                                                                <div class="_jro6t0 d-flex align-items-center">
                                                                    <div class="d-flex gap-3 align-items-center">
                                                                        <span class="_ul9u8c prev">-</span>
                                                                        <span class="counter">5</span>
                                                                        <span class="_ul9u8c next">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div role="group" class="d-flex justify-content-between px-2" aria-labelledby="GuestPicker-book_it-form-adults" aria-describedby="GuestPicker-book_it-form-adults-subtitle">
                                                                <div class="_bc4egv d-grid py-1">
                                                                    <div class="_1ynrq4v"><b>Adults</b></div>
                                                                    <div class="_1wh7hnv">Age 13+</div>
                                                                </div>
                                                                <div class="_jro6t0 d-flex align-items-center">
                                                                    <div class="d-flex gap-3 align-items-center">
                                                                        <span class="_ul9u8c prev">-</span>
                                                                        <span class="counter">5</span>
                                                                        <span class="_ul9u8c next">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="modal-footer p-0 pt-4" style="border: none;">
                                                <a href="#" class="show d-flex align-items-center w-100 " data-bs-dismiss="modal" aria-label="Close" style="background-color:rgb(230 30 77);font-weight: 600;border-radius: 25px !important;">
                                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 4; overflow: visible;"><g fill="none"><path d="m13 24c6.0751322 0 11-4.9248678 11-11 0-6.07513225-4.9248678-11-11-11-6.07513225 0-11 4.92486775-11 11 0 6.0751322 4.92486775 11 11 11zm8-3 9 9"></path></g></svg>
                                                    <span class="mx-3">Search </span>
                                                </a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <form class="row">
                                        <div class="mb-3">
                                            <label class="form-label"><b>Destinations</b></label>
                                            <select class="form-select">
                                            <option>Disabled select</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="exampleInputPassword1" class="form-label"><b>Check In Date</b></label>
                                            <input type="text" class="form-control datepicker" placeholder="Choose Date">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="exampleInputPassword1" class="form-label"><b>Check out Date</b></label>
                                            <input type="text" class="form-control datepicker" placeholder="Choose Date">
                                        </div>
                                        <div class="col-12 mb-3 ">
                                            <small>Guests</small>
                                            <div class="dropdown ">
                                                <button class="btn dropdown-toggle d-block show" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true" style="width: calc(100% - 30px);
                                                border: 1px solid #969696 !important;
                                                border-radius: 25px;
                                                height: 39px;" type="button">
                                                1 Guests
                                                </button>
                                                <ul class="dropdown-menu w-100 " data-popper-placement="bottom-start">
                                                    <li>
                                                        <a class="dropdown-item">
                                                            <div role="group" class="d-flex justify-content-between px-2">
                                                                <div class="_bc4egv d-grid py-1">
                                                                    <div class="_1ynrq4v"><b>Adults</b></div>
                                                                    <div class="_1wh7hnv">Age 13+</div>
                                                                </div>
                                                                <div class="_jro6t0 d-flex align-items-center">
                                                                    <div class="d-flex gap-3 align-items-center">
                                                                        <span class="_ul9u8c prev">-</span>
                                                                        <span class="counter">8</span>
                                                                        <span class="_ul9u8c next">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div role="group" class="d-flex justify-content-between px-2" aria-labelledby="GuestPicker-book_it-form-adults" aria-describedby="GuestPicker-book_it-form-adults-subtitle">
                                                                <div class="_bc4egv d-grid py-1">
                                                                    <div class="_1ynrq4v"><b>Adults</b></div>
                                                                    <div class="_1wh7hnv">Age 13+</div>
                                                                </div>
                                                                <div class="_jro6t0 d-flex align-items-center">
                                                                    <div class="d-flex gap-3 align-items-center">
                                                                        <span class="_ul9u8c prev">-</span>
                                                                        <span class="counter">5</span>
                                                                        <span class="_ul9u8c next">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div role="group" class="d-flex justify-content-between px-2" aria-labelledby="GuestPicker-book_it-form-adults" aria-describedby="GuestPicker-book_it-form-adults-subtitle">
                                                                <div class="_bc4egv d-grid py-1">
                                                                    <div class="_1ynrq4v"><b>Adults</b></div>
                                                                    <div class="_1wh7hnv">Age 13+</div>
                                                                </div>
                                                                <div class="_jro6t0 d-flex align-items-center">
                                                                    <div class="d-flex gap-3 align-items-center">
                                                                        <span class="_ul9u8c prev">-</span>
                                                                        <span class="counter">5</span>
                                                                        <span class="_ul9u8c next">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="modal-footer p-0 pt-4" style="border: none;">
                                                <a href="#" class="show d-flex align-items-center w-100 " data-bs-dismiss="modal" aria-label="Close" style="background-color:rgb(230 30 77);font-weight: 600;">
                                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 4; overflow: visible;"><g fill="none"><path d="m13 24c6.0751322 0 11-4.9248678 11-11 0-6.07513225-4.9248678-11-11-11-6.07513225 0-11 4.92486775-11 11 0 6.0751322 4.92486775 11 11 11zm8-3 9 9"></path></g></svg>
                                                    <span class="mx-3">Search </span>
                                                </a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- <======= SEARCH BAR MODAL ENDS ========> -->

            <main>
                <div class="main-inner">
                    <div v-if="apartments" class="container p-0">
                        <!-- card wrapper -->
                        <div class="image-content-wrapper">
                            <!-- card item -->
                            <a v-for="(item, index) in apartments" :key="index" href="rooms.php" class="card-item">
                                <div @click="setApartmentId(item.id)" class="card">
                                    <div class="card-image">
                                        <div class="icon-love">
                                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="fill: rgba(0, 0, 0, 0.5); height: 24px; width: 24px; stroke-width: 2; overflow: visible;">
                                                <path
                                                    d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                </path>
                                            </svg>
                                        </div>
                                        <!-- carousel-start -->

                                        <div v-if="item.images" :id="'carouselExampleIndicators' + index" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                <button v-for="(image, each) in item.images.length" :key="each" type="button" data-bs-target="'#carouselExampleIndicators' + index" :data-bs-slide-to="each" class="active" aria-current="true" :aria-label="'Slide' + ( parseInt(each) + 1 )"></button>
                                                <!-- <button v-if="image > 1" type="button" data-bs-target="#carouselExampleIndicators" :data-bs-slide-to="each" :aria-label="'Slide' + ( parseInt(each) + 1 )"></button> -->
                                                <!-- <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button> -->
                                            </div>

                                            <div v-if="item.images.length > 1" class="carousel-inner">
                                                <div  class="carousel-item active">
                                                    <img :src="item.images[0].image" class="card-img-top d-block w-100" alt="...">
                                                </div>
                                                <div v-for="(image, each) in item.images.slice(1)" :key="each" class="carousel-item">
                                                    <img :src="image.image" class="card-img-top d-block w-100" alt="...">
                                                </div>
                                            </div>
                                            <button class="carousel-control-prev" type="button" :data-bs-target="'#carouselExampleIndicators' + index" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                                <em class="bi bi-chevron-left"></em>
                                                </span>
                                                <span class="visually-hidden"></span>
                                            </button>
                                            <button class="carousel-control-next" type="button" :data-bs-target="'#carouselExampleIndicators'+ index" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true">
                                                <em class="bi bi-chevron-right"></em>
                                                </span>
                                                <span class="visually-hidden"></span>
                                            </button>
                                        </div>
                                        <!-- carousel-end -->
                                    </div>
                                    <div class="card-body">

                                        <div class="card-body-inner">
                                            <div class="left">
                                                <div class="location">
                                                    <h6>{{item.apartment_city}}, {{item.apartment_country}}</h6>
                                                </div>
                                                <div class="kilometre"><span>3,340 kilometre</span></div>
                                                <div class="date"><span>Jan 3 - 8</span></div>
                                                <div class="price"><span><b>{{item.listing_currency_symbol}}{{item.price}}</b> night</span></div>
                                            </div>
                                            <div class="right">
                                                <div class="rating">
                                                    <span class="icon"><em class="bi bi-star-fill"></em></span>
                                                    <span class="rate-value">New</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <!-- card item end -->

                        </div>
                        <!-- card wrapper ends -->
                    </div>
                </div>
            </main>
            <!-- main end -->


            <!-- footer start -->
            <footer>
                <div class="footer-inner">
                    <!-- map -->
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="currentColor" d="M48.17 113.34A32 32 0 0 0 32 141.24V438a32 32 0 0 0 47 28.37c.43-.23.85-.47 1.26-.74l84.14-55.05a8 8 0 0 0 3.63-6.72V46.45a8 8 0 0 0-12.51-6.63Zm164.19-74.03A8 8 0 0 0 200 46v357.56a8 8 0 0 0 3.63 6.72l96 62.42A8 8 0 0 0 312 466V108.67a8 8 0 0 0-3.64-6.73Zm252.17 7.16a31.64 31.64 0 0 0-31.5-.88a12.07 12.07 0 0 0-1.25.74l-84.15 55a8 8 0 0 0-3.63 6.72v357.46a8 8 0 0 0 12.52 6.63l107.07-73.46a32 32 0 0 0 16.41-28v-296a32.76 32.76 0 0 0-15.47-28.21Z"/></svg> -->
                    <div class="container p-0">
                        <!-- mobile view footer -->
                        <div class="row col-12 m-0 align-items-center justify-content-center d-md-none mobile-view">
                            <div class="p-0 col-2 each-link">
                                <a href="#" class="active">
                                    <div class="svg-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396l1.414-1.414l-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8s3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6s-6-2.691-6-6s2.691-6 6-6z" />
                            </svg>
                                    </div>
                                    <div class="text"><small>Explore</small></div>
                                </a>
                            </div>
                            <div class="p-0 col-2 each-link">
                                <a href="#">
                                    <div class="svg-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36">
                                <path fill="currentColor"
                                    d="M18 32.43a1 1 0 0 1-.61-.21C11.83 27.9 8 24.18 5.32 20.51C1.9 15.82 1.12 11.49 3 7.64c1.34-2.75 5.19-5 9.69-3.69A9.87 9.87 0 0 1 18 7.72a9.87 9.87 0 0 1 5.31-3.77c4.49-1.29 8.35.94 9.69 3.69c1.88 3.85 1.1 8.18-2.32 12.87c-2.68 3.67-6.51 7.39-12.07 11.71a1 1 0 0 1-.61.21ZM10.13 5.58A5.9 5.9 0 0 0 4.8 8.51c-1.55 3.18-.85 6.72 2.14 10.81A57.13 57.13 0 0 0 18 30.16a57.13 57.13 0 0 0 11.06-10.83c3-4.1 3.69-7.64 2.14-10.81c-1-2-4-3.59-7.34-2.65a8 8 0 0 0-4.94 4.2a1 1 0 0 1-1.85 0a7.93 7.93 0 0 0-4.94-4.2a7.31 7.31 0 0 0-2-.29Z"
                                    class="clr-i-outline clr-i-outline-path-1" />
                                <path fill="none" d="M0 0h36v36H0z" />
                            </svg>
                                    </div>
                                    <div class="text"><small>Wishlists</small></div>
                                </a>
                            </div>
                            <div class="p-0 col-2 each-link">
                                <a href="#">
                                    <div class="svg-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256">
                                <path fill="currentColor"
                                    d="M232 128a104 104 0 1 0-174.2 76.7l1.3 1.2a104 104 0 0 0 137.8 0l1.3-1.2A103.7 103.7 0 0 0 232 128Zm-192 0a88 88 0 1 1 153.8 58.4a79.2 79.2 0 0 0-36.1-28.7a48 48 0 1 0-59.4 0a79.2 79.2 0 0 0-36.1 28.7A87.6 87.6 0 0 1 40 128Zm56-8a32 32 0 1 1 32 32a32.1 32.1 0 0 1-32-32Zm-21.9 77.5a64 64 0 0 1 107.8 0a87.8 87.8 0 0 1-107.8 0Z" />
                            </svg>
                                    </div>
                                    <div class="text"><small>Log in</small></div>
                                </a>
                            </div>
                        </div>
                        <!-- end of mobile footer view -->
                        <!-- large screen footer -->
                        <div class="row col-12 m-0 align-items-center justify-content-center justify-content-md-between d-none d-md-inline-flex">
                            <div class="p-0 left col-md-4">
                                <div class="inner">
                                    <span>&copy; Airbnb, Inc.</span>
                                    <span class="dot"></span>
                                    <a href="">Privacy</a>
                                    <span class="dot"></span>
                                    <a href="">Terms</a>
                                    <span class="dot"></span>
                                    <a href="">Sitemap</a>
                                    <span class="dot"></span>
                                    <a href="">Destinations</a>
                                </div>
                            </div>
                            <div class="p-0 right col-md-4">
                                <div class="inner">
                                    <!-- ! ======== button for language ========== -->
                                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            <div class="svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M8.5 1a6.5 6.5 0 1 1 0 13a6.5 6.5 0 0 1 0-13zm4.894 4a5.527 5.527 0 0 0-3.053-2.676c.444.84.765 1.74.953 2.676h2.1zm.582 2.995A5.11 5.11 0 0 0 14 7.5a5.464 5.464 0 0 0-.213-1.5h-2.342c.032.331.055.664.055 1a10.114 10.114 0 0 1-.206 2h2.493c.095-.329.158-.665.19-1.005zm-3.535 0l.006-.051A9.04 9.04 0 0 0 10.5 7a8.994 8.994 0 0 0-.076-1H6.576A8.82 8.82 0 0 0 6.5 7a8.98 8.98 0 0 0 .233 2h3.534c.077-.332.135-.667.174-1.005zM10.249 5a8.974 8.974 0 0 0-1.255-2.97C8.83 2.016 8.666 2 8.5 2a3.62 3.62 0 0 0-.312.015l-.182.015L8 2.04A8.97 8.97 0 0 0 6.751 5h3.498zM5.706 5a9.959 9.959 0 0 1 .966-2.681A5.527 5.527 0 0 0 3.606 5h2.1zM3.213 6A5.48 5.48 0 0 0 3 7.5A5.48 5.48 0 0 0 3.213 9h2.493A10.016 10.016 0 0 1 5.5 7c0-.336.023-.669.055-1H3.213zm2.754 4h-2.36a5.515 5.515 0 0 0 3.819 2.893A10.023 10.023 0 0 1 5.967 10zM8.5 12.644A8.942 8.942 0 0 0 9.978 10H7.022A8.943 8.943 0 0 0 8.5 12.644zM11.033 10a10.024 10.024 0 0 1-1.459 2.893A5.517 5.517 0 0 0 13.393 10h-2.36z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="text" style="margin-left: 7px;"><span>English (US)</span></div>
                            </button>

                                    <!-- * ========== button for currency pair ========= -->
                                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                            <span>$ USD</span>
                            </button>

                                    <!-- ? ========= button for bottom offcanvas ========== -->
                                    <button class="" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                            <div class="text" style="margin-right: 7px;"><span>Support & Resources</span></div>
                            <div class="svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m4 15l8-8l8 8" />
                                </svg>
                            </div>
                            </button>
                                </div>
                            </div>
                        </div>
                        <!-- end of large screen footer -->
                    </div>
                </div>

                <!-- &middot; -->
            </footer>
            <!-- footer end -->

        </div>


        <!-- !<======= MODALSSSS ========> -->

        <!-- ? <====== CANVAS FROM BOTTOM ======> -->
        <div class="offcanvas offcanvas-bottom resources" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="container p-0">
                    <div class="row col-12 m-0 align-items-start justify-content-evenly">
                        <div class="p-0 col-md-3">
                            <div class="inner">
                                <div class="title"><small><b>Support</b></small></div>
                                <div class="body">
                                    <ul>
                                        <li><a href="#">Help Center</a></li>
                                        <li><a href="#">AirCover</a></li>
                                        <li><a href="#">Safety information</a></li>
                                        <li><a href="#">Supporting people with disabilites</a></li>
                                        <li><a href="#">Cancellation options</a></li>
                                        <li><a href="#">Our COVID-19 Response</a></li>
                                        <li><a href="#">Report a neighborhood concern</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="p-0 col-md-3">
                            <div class="inner">
                                <div class="title"><small><b>Community</b></small></div>
                                <div class="body">
                                    <ul>
                                        <li><a href="#">Airbnb.org: disaster relief housing</a></li>
                                        <li><a href="#">Support Afghan refugees</a></li>
                                        <li><a href="#">Combating discrimination</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="p-0 col-md-3">
                            <div class="inner">
                                <div class="title"><small><b>Hosting</b></small></div>
                                <div class="body">
                                    <ul>
                                        <li><a href="#">Try Hosting</a></li>
                                        <li><a href="#">Aircover for hosting</a></li>
                                        <li><a href="#">Explore hosting Resources</li>
                                        <li><a href="#">Visit our conmmunity forum</a></li>
                                        <li><a href="#">How to host responsibly</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="p-0 col-md-3">
                            <div class="inner">
                                <div class="title"><small><b>Airbnb</b></small></div>
                                <div class="body">
                                    <ul>
                                        <li><a href="#">Newsroom</a></li>
                                        <li><a href="#">Learn about new features</a></li>
                                        <li><a href="#">Letter from our founders</a></li>
                                        <li><a href="#">Careers</a></li>
                                        <li><a href="#">Investors</a></li>
                                        <li><a href="#">Gift Cards</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../assets/js/jquery-ui.min.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
        $('.next').click(function() {
            let no = $(this).prev().text();
            $(this).prev().text(parseInt(no) + 1);
        });
        $('.prev').click(function() {
            let no = $(this).next().text();
            if (no == 0) {
                $(this).next().text(0);
            } else {
                $(this).next().text(parseInt(no) - 1);
            }

        });
    </script>
    <?php include "./includes/vue-script.php"; ?>
</body>

</html>