<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/fonts/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <title>Notifications</title>
</head>

<body>

    <div class="body-wrapper">
        <header>
            <div class="header-inner">
                <div class="row col-12 m-0 align-items-center justify-content-between justify-content-md-around">
                    <div class="p-0 col-md-1 col-lg-2 logo text-md-start d-none d-md-inline-flex">
                        <div class="lg-screen-logo d-none d-lg-inline-flex">
                            <a href="index.php">
                                <img style="width:100%;" src="../assets/images/GREEN_LOGO_HORIZONTAL_1.png" /> 
                            </a>
                        </div>
                        <div class="sm-screen-logo d-lg-none">
                            <a href="#">
                                <img style="width:100%;" src="../assets/images/GREEN_LOGO_VERTICAL_1.png" />
                            </a>
                        </div>
                    </div>
                    <div class="p-0 col-md-7 col-lg-3 search-bar">
                        <div class="middle-tabs">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item d-none d-md-inline-flex" data-bs-target="#staticBackdropfilter1" data-bs-toggle="modal" role="presentation">
                                    <button class="nav-link" style="min-width: 300px;"><b>Start Your Search...</b></button>
                                </li>

                                <li class="nav-item d-none d-md-inline-flex" role="presentation">
                                    <button class="nav-link search-icon" id="pills-search-tab" data-bs-toggle="pill" data-bs-target="#pills-search" type="button" role="tab" aria-controls="pills-search" aria-selected="false">
                              <em class="bi bi-search"></em>
                           </button>
                                </li>
                                <li class="nav-item mobile d-md-none" style="width: calc(100% - 50px);padding: 10px 0px;" data-bs-target="#staticBackdropfilter1" data-bs-toggle="modal">
                                    <button>
                              <div class="icon-search"><em class="bi bi-search"></em></div>
                              <div class="where-to">
                                 <span>Start Your Search ...</span>
                                 
                              </div>
                           </button>
                                </li>
                                <li class="filter-icon d-md-none" data-bs-target="#staticBackdropfilter" data-bs-toggle="modal">
                                    <button>
                              <span><svg xmlns="http://www.w3.org/2000/svg" width="32" height="    preserveAspectRatio="
                                    xMidYMid meet" viewBox="0 0 21 21">
                                    <g transform="rotate(90 10.5 10.5)">
                                       <g fill="none" fill-rule="evenodd" stroke="currentColor"
                                          stroke-linecap="rou    stroke-linejoin=" round">
                                          <path d="M14.5 9V2.5m0 16V14" />
                                          <circle cx="14.5" cy="11.5" r="2.5" />
                                          <path d="M6.5 5V2.5m0 16V10" />
                                          <circle cx="6.5" cy="7.5" r="2.5" />
                                       </g>
                                    </g>
                                 </svg></span>
                           </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-0 col-md-4 col-lg-3 menu d-none d-md-inline-flex justify-content-md-end">
                        <div class="end-tabs">
                            <div class="host">
                                <a href="#" class="host-link"><span>Become a Host</span></a>
                            </div>
                            <div class="menu-link">
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <div class="svg">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                       d="M2 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm0 6.032a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm1 5.032a1 1 0 1 0 0 2h18a1 1 0 0 0 0-2H3Z" />
                                 </svg>
                              </div>
                              <div class="user-icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 1792 1792">
                                    <path fill="currentColor"
                                       d="M1523 1339q-22-155-87.5-257.5T1251 963q-67 74-159.5 115.5T896 1120t-195.5-41.5T541 963q-119 16-184.5 118.5T269 1339q106 150 271 237.5t356 87.5t356-87.5t271-237.5zm-243-699q0-159-112.5-271.5T896 256T624.5 368.5T512 640t112.5 271.5T896 1024t271.5-112.5T1280 640zm512 256q0 182-71 347.5t-190.5 286T1245 1721t-349 71q-182 0-348-71t-286-191t-191-286T0 896t71-348t191-286T548 71T896 0t348 71t286 191t191 286t71 348z" />
                                 </svg>
                              </div>
                           </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="register.php">Sign up</a></li>
                                        <li><a class="dropdown-item" href="login.php">Log in</a></li>
                                        <div class="sub-menu-links">
                                            <li><a class="dropdown-item" href="home.html">Host your Home</a></li>
                                            <li><a class="dropdown-item" href="experience.html">Host an experience</a></li>
                                            <li><a class="dropdown-item" href="help.html">Help</a></li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
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

        <style>
            ._1j8963g {
                font-size: 32px;
                line-height: 36px;
                color: rgb(0, 0, 0);
                font-weight: 600;
                margin-top: 42px;
                margin-bottom: 32px;
            }
            
            ._11eqlma4 {
                cursor: pointer !important;
                position: relative !important;
                touch-action: manipulation !important;
                font-family: inherit !important;
                font-size: inherit !important;
                line-height: inherit !important;
                font-weight: inherit !important;
                border-radius: 0px !important;
                outline: none !important;
                transition: box-shadow 0.2s ease 0s, -ms-transform 0.1s ease 0s, -webkit-transform 0.1s ease 0s, transform 0.1s ease 0s !important;
                -webkit-tap-highlight-color: transparent !important;
                background: transparent !important;
                border: none !important;
                color: inherit !important;
                display: block !important;
                margin: 0px !important;
                padding: 0px !important;
                text-align: inherit !important;
                text-decoration: none !important;
                height: 100% !important;
                width: 100% !important;
            }
            
            ._4n554k {
                font-weight: 600 !important;
                color: rgb(34, 34, 34) !important;
            }
            
            ._1dj2p4gk {
                cursor: pointer !important;
                display: inline-block !important;
                margin: 0px !important;
                position: relative !important;
                text-align: center !important;
                text-decoration: none !important;
                width: auto !important;
                touch-action: manipulation !important;
                font-weight: 600 !important;
                border-radius: 10px !important;
                border-width: 1px !important;
                border-style: solid !important;
                outline: none !important;
                padding: 13px 23px !important;
                transition: box-shadow 0.2s ease 0s, -ms-transform 0.1s ease 0s, -webkit-transform 0.1s ease 0s, transform 0.1s ease 0s !important;
                -webkit-tap-highlight-color: transparent !important;
                border-color: 2px solid !important;
                color: rgb(34, 34, 34) !important;
            }
            
            ._wah8ne {
                white-space: pre-line !important;
                max-width: 100% !important;
                font-size: var(--tl-font-size, 16px) !important;
                font-weight: var(--tl-font-weight, MEDIUM) !important;
                letter-spacing: var(--tl-letter-spacing, 0em) !important;
                line-height: var(--tl-line-height, 20px) !important;
                color: var(--tl-color, #000000) !important;
                -webkit-line-clamp: var(--tl-line-clamp) !important;
                margin-bottom: 20px;
            }
        </style>
        <main class="container" style="margin-top: 120px;">
            <div class="_vh5bhjv mt-4">
                <section>
                    <h1 tabindex="-1" class="_14i3z6h" elementtiming="LCP-target">
                        <div class="_1j8963g">Trips</div>
                        <hr>
                    </h1>
                    <div style="padding-top: 32px; padding-bottom: 48px;">
                        <div>
                            <div><span class="_wah8ne" style="--tl-color:#222222; --tl-font-size:22px; --tl-font-weight:600; --tl-line-height:26px;">No trips booked...yet!</span></div>
                            <div class="s1lda2l2 dir dir-ltr my-3">
                                <span class="_y9cbsa d-block" style="--tl-color:#222222; --tl-font-size:16px; --tl-font-weight:400; --tl-line-height:24px;">Time to dust off your bags and start planning your next&nbsp;adventure</span>
                            </div>
                            <div data-testid="empty-state-action" class="bn86rla dir dir-ltr"><a aria-label="Start searching" href="/?source=itinerary" class="_1dj2p4gk">Start searching</a></div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex my-3 gap-2">
                        <span class="_y9cbsa" style="color:#222222;font-size:14px;font-weight:400;line-height:18px">Can’t find your reservation&nbsp;here?</span>
                        <a aria-label="Visit the Help&nbsp;Center" href="/" class="_1sikdxcl">Visit the Help&nbsp;Center</a>
                    </div>
                </section>

            </div>
        </main>
        <!-- main end -->

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





    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <script src="../assets/js/custom.js"></script>
</body>

</html>