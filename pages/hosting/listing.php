<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/fonts/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/nav.css">
    <link rel="stylesheet" href="../../assets/css/footer.css">
    <link rel="stylesheet" href="../../assets/css/layout.css">
    <link rel="stylesheet" href="../../assets/css/hosting.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <title>Account Settings</title>
</head>
<style>
    ._19mplim {
        -webkit-box-lines: multiple;
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }
    
    ._7v384n {
        padding-right: 24px;
        padding-bottom: 24px;
        -webkit-flex: 1 0 50%;
        -ms-flex: 1 0 50%;
        flex: 1 0 50%;
    }
    
    ._131n1yh {
        background: transparent;
        border: none;
        color: inherit;
        cursor: pointer;
        display: block;
        margin: 0px;
        padding: 0px;
        text-align: inherit;
        text-decoration: none;
        height: 100%;
        width: 100%;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
    }
    
    ._1tp1o9s {
        -webkit-box-align: center;
        -ms-flex-align: center;
        font-size: 16px;
        line-height: 20px;
        color: #222222;
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
    }
    
    ._5a8dj0 {
        position: relative;
        background-color: #DDDDDD;
        overflow: hidden;
        border-radius: 12px;
        -webkit-flex: 0 0 72px;
        -ms-flex: 0 0 72px;
        flex: 0 0 72px;
        height: 72px;
        margin-right: 16px;
    }
    
    ._9ofhsl {
        height: 100%;
        width: 100%;
        position: static;
    }
    
    ._1so8oxv {
        -webkit-box-direction: normal;
        -webkit-box-orient: vertical;
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        -webkit-flex-grow: 1;
        flex-grow: 1;
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
    }
    
    @media all and (max-width:600px) {
        ._7v384n {
            flex: 100%;
        }
    }
    
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #303030;
        background-color: transparent;
        font-weight: 700;
        border-bottom: 2.5px solid;
        border-radius: 0;
    }
    
    .nav-link {
        color: #9b9b9b;
    }
    
    ._wqsl5eu {
        font-size: 14px !important;
        font-weight: 800 !important;
        width: 100% !important;
        margin-bottom: 0px !important;
        line-height: 20px !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
    }
    
    ._1w2y0lnj {
        -webkit-box-align: center !important;
        -webkit-box-pack: center !important;
        min-width: 56px !important;
        height: 40px !important;
        width: 56px !important;
        border-radius: 4px !important;
        overflow: hidden !important;
        margin-right: 12px !important;
        background: rgb(176, 176, 176) !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        color: rgb(255, 255, 255) !important;
    }
    
    ._1ju7xj0j {
        cursor: pointer !important;
        display: inline-block !important;
        margin: 0px !important;
        position: relative !important;
        text-align: center !important;
        text-decoration: none !important;
        width: auto !important;
        touch-action: manipulation !important;
        font-weight: 600 !important;
        border-radius: 9px !important;
        border-width: 1px !important;
        border-style: solid !important;
        outline: none !important;
        padding: 7px 15px !important;
        transition: box-shadow 0.2s ease 0s, -ms-transform 0.1s ease 0s, -webkit-transform 0.1s ease 0s, transform 0.1s ease 0s !important;
        -webkit-tap-highlight-color: transparent !important;
        border-color: black;
    }
    
    td {
        vertical-align: middle;
    }
    
    ._1in3zfdr {
        width: unset !important;
        height: 40px !important;
        padding-left: 16px !important;
        padding-right: 16px !important;
        border-radius: 8px !important;
    }
    
    ._1in3zfdr {
        -webkit-box-pack: center !important;
        -webkit-box-align: center !important;
        cursor: pointer !important;
        margin: 0px !important;
        position: relative !important;
        text-align: center !important;
        text-decoration: none !important;
        touch-action: manipulation !important;
        font-size: 14px !important;
        line-height: 18px !important;
        font-weight: 600!important;
        border-radius: 8px;
        border-width: 1px !important;
        border-style: solid !important;
        outline: none !important;
        transition: box-shadow 0.2s ease 0s, -ms-transform 0.1s ease 0s, -webkit-transform 0.1s ease 0s, transform 0.1s ease 0s !important;
        -webkit-tap-highlight-color: transparent !important;
        border-color: black;
        color: black !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 5px 20px;
    }
    
    .dropdown-toggle::after {
        display: none;
    }
</style>

<body>

    <div class="body-wrapper">
        <header class="d-flex align-items-center">
            <div class="header-inner d-flex align-items-center w-100 justify-content-between px-md-5 px-3">
                <div class="first-div">
                    <div class="lg-screen-logo ">
                        <a href="#">
                            <img style="width:100%;" src="../assets/images/GREEN_LOGO_HORIZONTAL_1.png" /> 
                        </a>
                    </div>

                </div>
                <div class="second-div">
                    <div class="end-tabs">
                        <ul class="host d-none d-lg-flex gap-5 mb-0">
                            <li>
                                <a href="./index.html" class="host-link "><span>Today</span></a>
                            </li>
                            <li>
                                <a href="./message.html" class="host-link"><span>Inbox</span></a>
                            </li>
                            <li>
                                <a href="./onboarding/index.html" class="host-link"><span>Calendar</span></a>
                            </li>
                            <li>
                                <a href="./insights.html" class="host-link"><span>Insights</span></a>
                            </li>
                            <li class="dropdown menu-link w-auto h-auto border-0 d-block p-0 " style="border: none;">
                                <a href="#" class="host-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><span>Menu</span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item active" href="./listing.html">Listing</a></li>
                                    <li><a class="dropdown-item" href="./reservations.html">Reservations</a></li>
                                    <li><a class="dropdown-item" href="./onboarding/index.html">Create a new listing</a></li>
                                    <div class="sub-menu-links">
                                        <li><a class="dropdown-item" href="./transactions.html">Transaction History</a></li>
                                        <li><a class="dropdown-item" href="./community.html">Connect with Hosts near you.</a></li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="third-div">
                    <div class="end-tabs d-flex gap-3 align-items-center">
                        <div class="menu-link d-none d-lg-flex">
                            <div class="dropdown">
                                <a href="#" class="host-icon" class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><em class="bi bi-bell" style="font-size: 20px;"></em></a>
                                <ul class="dropdown-menu" style="min-height: 300px;">

                                </ul>
                            </div>
                        </div>
                        <div class="menu-link d-none d-lg-flex">
                            <div class="dropdown">
                                <button class="dropdown-toggle _1u0z83f5 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <div class="user-icon mx-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 1792 1792">
                                                                <path fill="currentColor"
                                                                d="M1523 1339q-22-155-87.5-257.5T1251 963q-67 74-159.5 115.5T896 1120t-195.5-41.5T541 963q-119 16-184.5 118.5T269 1339q106 150 271 237.5t356 87.5t356-87.5t271-237.5zm-243-699q0-159-112.5-271.5T896 256T624.5 368.5T512 640t112.5 271.5T896 1024t271.5-112.5T1280 640zm512 256q0 182-71 347.5t-190.5 286T1245 1721t-349 71q-182 0-348-71t-286-191t-191-286T0 896t71-348t191-286T548 71T896 0t348 71t286 191t191 286t71 348z" />
                                                            </svg>
                                                        </div>
                                                    </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Sign up</a></li>
                                    <li><a class="dropdown-item" href="#">Log in</a></li>
                                    <div class="sub-menu-links">
                                        <li><a class="dropdown-item" href="#">Host your Home</a></li>
                                        <li><a class="dropdown-item" href="#">Host an experience</a></li>
                                        <li><a class="dropdown-item" href="#">Help</a></li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <div class="menu-link d-flex d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                            <div class="svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                        d="M2 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm0 6.032a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm1 5.032a1 1 0 1 0 0 2h18a1 1 0 0 0 0-2H3Z" />
                                                    </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main class="p-0 mx-0 justify-content-center row" style="margin-top: 80px;">
            <div class="container px-5 my-5">
                <div class="d-flex justify-content-between mb-4 align-items-center">
                    <b>2 listings</b>
                    <div class="d-flex gap-2">
                        <a target="_blank" href="./onboarding/index.html" class="_1in3zfdr">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 16px; width: 16px; fill: rgb(34, 34, 34);"><path d="M18 4v10h10v4H18v10h-4V18H4v-4h10V4z"></path></svg>
                            <span class="_1pviq42">Create listing</span>
                        </a>
                    </div>
                </div>
                <table id="example" class="table mt-4 responsive nowrap table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Listing </th>
                            <th>Status</th>
                            <th>To Do</th>
                            <th>Instant Book</th>
                            <th>Bedrooms</th>
                            <th>Beds</th>
                            <th>Baths</th>
                            <th>Location</th>
                            <th>Last Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="_1w2y0lnj"><svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 16px; width: 16px; fill: currentcolor;"><path d="M8.602 1.147l.093.08 7.153 6.914-.696.718L14 7.745V14.5a.5.5 0 0 1-.41.492L13.5 15H10V9.5a.5.5 0 0 0-.41-.492L9.5 9h-3a.5.5 0 0 0-.492.41L6 9.5V15H2.5a.5.5 0 0 1-.492-.41L2 14.5V7.745L.847 8.86l-.696-.718 7.153-6.915a1 1 0 0 1 1.297-.08z"></path></svg></div>
                                    <span class="_wqsl5eu">Tiger Nixon</span>
                                </div>
                            </td>
                            <td>In progress</td>
                            <td><a href="./update-onboarding.html" class="_1ju7xj0j">Finish</a></td>
                            <td>On</td>
                            <td>1</td>
                            <td>2</td>
                            <td>1</td>
                            <td>Lagos, Nigeria</td>
                            <td>Yesterday</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="_1w2y0lnj"><svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 16px; width: 16px; fill: currentcolor;"><path d="M8.602 1.147l.093.08 7.153 6.914-.696.718L14 7.745V14.5a.5.5 0 0 1-.41.492L13.5 15H10V9.5a.5.5 0 0 0-.41-.492L9.5 9h-3a.5.5 0 0 0-.492.41L6 9.5V15H2.5a.5.5 0 0 1-.492-.41L2 14.5V7.745L.847 8.86l-.696-.718 7.153-6.915a1 1 0 0 1 1.297-.08z"></path></svg></div>
                                    <span class="_wqsl5eu">Tiger Nixon</span>
                                </div>
                            </td>
                            <td>In progress</td>
                            <td><span class="_1ju7xj0j">Finish</span></td>
                            <td>On</td>
                            <td>1</td>
                            <td>2</td>
                            <td>1</td>
                            <td>Lagos, Nigeria</td>
                            <td>Yesterday</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="_1w2y0lnj"><svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 16px; width: 16px; fill: currentcolor;"><path d="M8.602 1.147l.093.08 7.153 6.914-.696.718L14 7.745V14.5a.5.5 0 0 1-.41.492L13.5 15H10V9.5a.5.5 0 0 0-.41-.492L9.5 9h-3a.5.5 0 0 0-.492.41L6 9.5V15H2.5a.5.5 0 0 1-.492-.41L2 14.5V7.745L.847 8.86l-.696-.718 7.153-6.915a1 1 0 0 1 1.297-.08z"></path></svg></div>
                                    <span class="_wqsl5eu">Tiger Nixon</span>
                                </div>
                            </td>
                            <td>In progress</td>
                            <td><span class="_1ju7xj0j">Finish</span></td>
                            <td>On</td>
                            <td>1</td>
                            <td>2</td>
                            <td>1</td>
                            <td>Lagos, Nigeria</td>
                            <td>Yesterday</td>
                        </tr>

                    </tbody>

                </table>
            </div>

        </main>

        <!-- mobile view footer -->
        <footer>
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
        </footer>

        <!-- end of mobile footer view -->
        <footer class="pt-5 mb-0 mt-0 position-static d-none d-md-block" style="background-color: #F7F7F7 ;border-top: 1px solid #DDDDDD ;">
            <div class="container px-3">
                <div class="row m-0">
                    <div class="col-lg-3">
                        <h5>Support</h5>
                        <ul class="nav row flex-lg-column">
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Newsroom</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Learn about new features</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Letter from our founders</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Careers</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Investors</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3">
                        <h5>Community</h5>
                        <ul class="nav row flex-lg-column">
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Newsroom</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Learn about new features</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Letter from our founders</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Careers</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Investors</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3">
                        <h5>Hosting</h5>
                        <ul class="nav row flex-lg-column">
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Newsroom</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Learn about new features</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Letter from our founders</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Careers</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Investors</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3">
                        <h5>Hosting</h5>
                        <ul class="nav row flex-lg-column">
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Newsroom</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Learn about new features</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Letter from our founders</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Careers</a></li>
                            <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Investors</a></li>
                        </ul>
                    </div>
                </div>


            </div>
            <div class="d-flex px-4 justify-content-between py-4 mt-4 border-top">
                <p>© 2021 Company, Inc. All rights reserved.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
                    <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
                </ul>
            </div>
        </footer>



    </div>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/jquery-3.6.1.min.js"></script>
    <script src="../../assets/js/custom.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>