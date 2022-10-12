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
                    <div class="lg-screen-logo " style="width:30%;">
                        <a href="#">
                            <img style="width:100%;" src="../../assets/images/GREEN_LOGO_HORIZONTAL_1.png" /> 
                        </a>
                    </div>

                </div>
                <div class="second-div">
                    <div class="end-tabs">
                        <ul class="host d-none d-lg-flex gap-5 mb-0">
                            <li>
                                <a href="./index.php" class="host-link "><span>Today</span></a>
                            </li>
                            <li>
                                <a href="./message.php" class="host-link"><span>Inbox</span></a>
                            </li>
                            <li>
                                <a href="./onboarding/index.php" class="host-link"><span>Calendar</span></a>
                            </li>
                            <li>
                                <a href="./insights.php" class="host-link"><span>Insights</span></a>
                            </li>
                            <li class="dropdown menu-link w-auto h-auto border-0 d-block" style="border: none;">
                                <a href="#" class="host-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><span>Menu</span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item active" href="./listing.php">Listing</a></li>
                                    <li><a class="dropdown-item" href="./reservations.php">Reservations</a></li>
                                    <li><a class="dropdown-item" href="./onboarding/index.php">Create a new listing</a></li>
                                    <div class="sub-menu-links">
                                        <li><a class="dropdown-item" href="./transactions.php">Transaction History</a></li>
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
                        <a target="_blank" href="./onboarding/index.php" class="_1in3zfdr">
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
                            <td><a href="./update-onboarding.php" class="_1ju7xj0j">Finish</a></td>
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

        </div>

        <!--This is Menu Bar-->
        <div class="offcanvas offcanvas-top" style="height: 100vh;" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasTopLabel">
                    <div class="sm-screen-logo " style="width:30%;">
                        <a href="#">
                            <img style="width:100%;" src="../../assets/images/GREEN_LOGO_HORIZONTAL_1.png" /> 
                        </a>
                    </div>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div role="dialog" class="_1if7r9j">
                    <ul class="_yr78ke">
                        <div class="_17rwvlx">Menu</div>
                        <a class="_1lqi869l" href="/hosting" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M13.92 1.112a3 3 0 0 1 4.017-.129l.142.13 11.307 10.871a2 2 0 0 1 .606 1.261l.008.18V27a3 3 0 0 1-2.824 2.995L27 30H5a3 3 0 0 1-2.995-2.824L2 27V13.426a2 2 0 0 1 .49-1.311l.124-.13L13.92 1.111zm2.773 1.442a1 1 0 0 0-1.293-.08l-.093.08L4 13.426V27a1 1 0 0 0 .883.993L5 28h22a1 1 0 0 0 .993-.883L28 27V13.426L16.693 2.554zM22 12.586L23.414 14 14 23.414 8.586 18 10 16.586l4 3.999 8-8z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Today</div>
                        </a>
                        <a class="_1lqi869l" href="/hosting/inbox" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M16.00049,31.0791,11.84326,26H6a5.00588,5.00588,0,0,1-5-5V7A5.00588,5.00588,0,0,1,6,2H26a5.00588,5.00588,0,0,1,5,5V21a5.00588,5.00588,0,0,1-5,5H20.1543ZM6,4A3.00328,3.00328,0,0,0,3,7V21a3.00328,3.00328,0,0,0,3,3h6.79053l3.209,3.9209L19.207,24H26a3.00328,3.00328,0,0,0,3-3V7a3.00328,3.00328,0,0,0-3-3Z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Inbox</div>
                        </a>
                        <a class="_1lqi869l" href="/calendar-router" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M28,2H22V0H20V2H12V0H10V2H4A2.002,2.002,0,0,0,2,4V25a5.00588,5.00588,0,0,0,5,5H19.58594A2.0144,2.0144,0,0,0,21,29.41406L29.41406,21A2.0144,2.0144,0,0,0,30,19.58594V4A2.00229,2.00229,0,0,0,28,2ZM20,27.58594V23a3.00328,3.00328,0,0,1,3-3h4.58594ZM28,10H4v2H28v6H23a5.00588,5.00588,0,0,0-5,5v5H7a3.00328,3.00328,0,0,1-3-3L3.99854,4H10V6h2V4h8V6h2V4h6Z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Calendar</div>
                        </a>
                        <a class="_1lqi869l" href="/progress/opportunity-hub" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m27 5h-4a2.00229 2.00229 0 0 0 -2 2v4h-4v-8a2.002 2.002 0 0 0 -2-2h-4a2.002 2.002 0 0 0 -2 2v8h-4a2.002 2.002 0 0 0 -2 2v16a2.00229 2.00229 0 0 0 2 2h22a2.0026 2.0026 0 0 0 2-2v-22a2.00229 2.00229 0 0 0 -2-2zm-18 24h-4l-.00146-16h4.00146zm6 0h-4v-16l-.00092-.00891-.00054-9.99109h4.00146zm6 0h-4v-16h4zm6 0h-4v-16l-.00073-.007-.00027-5.993h4.001z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Insights</div>
                        </a>
                        <a class="_1lqi869l" href="/hosting/listings" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m17.9772237 1.90551573.1439807.13496509 13.2525 13.25240998-1.4142088 1.4142184-.9603513-.9603098.0008557 12.5832006c0 1.0543618-.8158778 1.9181651-1.8507377 1.9945143l-.1492623.0054857h-22c-1.0543618 0-1.91816512-.8158778-1.99451426-1.8507377l-.00548574-.1492623-.00085571-12.5822006-.95878858.9593098-1.41421142-1.414217 13.25247161-13.25243161c1.1247615-1.1246896 2.9202989-1.16967718 4.0986078-.13494486zm-2.5902053 1.46599297-.0942127.08318915-10.29366141 10.29310155.00085571 14.5822006h5.9991443l.0008557-9.9966c0-1.0543764.8158639-1.9181664 1.8507358-1.9945144l.1492642-.0054856h6c1.0543764 0 1.9181664.8158639 1.9945144 1.8507358l.0054856.1492642-.0008557 9.9966h6.0008557l-.0008557-14.5832006-10.2921737-10.29212525c-.3604413-.36046438-.9276436-.38819241-1.3199522-.08316545zm3.6129816 14.9618913h-6l-.0008557 9.9963994h6z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Listings</div>
                        </a>
                        <a class="_1lqi869l" href="/hosting/reservations" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m26 6h-4v-2a2.00229 2.00229 0 0 0 -2-2h-8a2.002 2.002 0 0 0 -2 2v2h-4a5.00588 5.00588 0 0 0 -5 5v14a5.00588 5.00588 0 0 0 5 5h20a5.00588 5.00588 0 0 0 5-5v-14a5.00588 5.00588 0 0 0 -5-5zm-14.00146-2h8.00146v2h-8.00134zm-5.99854 24a3.00328 3.00328 0 0 1 -3-3v-14a3.00328 3.00328 0 0 1 3-3h4v20zm6 0-.00122-20h8.00122v20zm17-3a3.00328 3.00328 0 0 1 -3 3h-4v-20h4a3.00328 3.00328 0 0 1 3 3z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Reservations</div>
                        </a>
                        <a class="_1lqi869l" href="/manage-guidebook?s=host_profile_menu" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m1.66675 2.67728c0-1.29010774 1.19757945-2.22892485 2.43214873-1.95293212l.14254843.03728562 11.76455284 3.5293665 11.7747926-3.3852093c1.1836744-.3403064 2.3638086.45712676 2.5321485 1.63303369l.0152796.14287691.0051793.1462187v23.09468c0 .8279727-.5091718 1.5640524-1.2698418 1.8619846l-.155411.0536419-12.6207 3.7862c-.1499506.0449851-.3078242.0539821-.4609439.026991l-.1137505-.026991-12.62071315-3.786204c-.79308169-.2379357-1.35183119-.937138-1.41857691-1.7513494l-.00671274-.1642731zm1.99999664.00000464v23.24528886l12.33325336 3.6994265 12.3334-3.6994076v-23.0946724l-12.0569924 3.46639925c-.1474472.0423911-.3021582.05014891-.4521925.02334213l-.1114623-.02658488zm21.66607876 17.47821536v2.088l-9.333 2.8v-2.087zm0-6v2.088l-9.333 2.8v-2.087zm0-5.999v2.087l-9.333 2.8v-2.087z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Guidebooks</div>
                        </a>
                        <a class="_1lqi869l" href="/users/transaction_history" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m26 5c1.0543618 0 1.9181651.81587779 1.9945143 1.85073766l.0054857.14926234.0013298 11.255617c1.8127343 1.2650459 2.9986702 3.3662194 2.9986702 5.744383 0 3.8659932-3.1340068 7-7 7-3.7854517 0-6.8690987-3.0047834-6.995941-6.7593502l-.004059-.2406498h-14c-1.0543618 0-1.91816512-.8158778-1.99451426-1.8507377l-.00548574-.1492623v-15c0-1.0543618.81587779-1.91816512 1.85073766-1.99451426l.14926234-.00548574zm-2 14c-2.7614237 0-5 2.2385763-5 5s2.2385763 5 5 5 5-2.2385763 5-5-2.2385763-5-5-5zm1 1v3.464l2.5547002 1.7039497-1.1094004 1.6641006-3.4452998-2.2968665v-4.5351838zm1-13h-23v15h14.2898925c.860564-2.8915115 3.5391038-5 6.7101075-5 .695354 0 1.3670274.1013887 2.0010432.2901893zm-11.5 3c2.4852814 0 4.5 2.0147186 4.5 4.5s-2.0147186 4.5-4.5 4.5-4.5-2.0147186-4.5-4.5 2.0147186-4.5 4.5-4.5zm0 2c-1.3807119 0-2.5 1.1192881-2.5 2.5s1.1192881 2.5 2.5 2.5 2.5-1.1192881 2.5-2.5-1.1192881-2.5-2.5-2.5zm-8.5-3c.55228475 0 1 .44771525 1 1 0 .5522847-.44771525 1-1 1s-1-.4477153-1-1c0-.55228475.44771525-1 1-1z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Transaction history</div>
                        </a>
                        <div class="_1a7n56z">
                            <div class="_ipygq"></div>
                        </div>
                        <div class="_17rwvlx">Account</div>
                        <a class="_1lqi869l" href="/users/show" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m16 1a15 15 0 1 0 15 15 15.017 15.017 0 0 0 -15-15zm-9.08307 24.28351a10.93393 10.93393 0 0 1 7.08307-4.59558v-2.122a4.9975 4.9975 0 1 1 4 .0022v2.12182a10.9291 10.9291 0 0 1 7.08307 4.59339 12.95749 12.95749 0 0 1 -18.16614.00018zm19.51251-1.55615a12.90782 12.90782 0 0 0 -5.87573-4.41095 7.00008 7.00008 0 1 0 -9.1084-.001 12.91422 12.91422 0 0 0 -5.87469 4.41223 12.9918 12.9918 0 1 1 23.42938-7.72764 12.91372 12.91372 0 0 1 -2.57056 7.72736z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Your profile</div>
                        </a>
                        <a class="_1lqi869l" href="/account-settings" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 24px; width: 24px; stroke: currentcolor; stroke-width: 1.33333; overflow: visible;"><path d="m19.38 27a4.14 4.14 0 0 1 3.05-2.54 4.06 4.06 0 0 1 3.17.71 1 1 0 0 0 1.47-.33l2.11-3.64a1 1 0 0 0 -.46-1.44 4.1 4.1 0 0 1 0-7.48 1 1 0 0 0 .46-1.44l-2.11-3.66a1 1 0 0 0 -1.47-.33 4.07 4.07 0 0 1 -3.17.71 4.14 4.14 0 0 1 -3.05-2.56 4 4 0 0 1 -.27-1.87 1 1 0 0 0 -1-1.15h-4.2a1 1 0 0 0 -1 1.15 4.11 4.11 0 0 1 -3.34 4.43 4.06 4.06 0 0 1 -3.17-.71 1 1 0 0 0 -1.47.33l-2.11 3.64a1 1 0 0 0 .46 1.44 4.1 4.1 0 0 1 0 7.48 1 1 0 0 0 -.46 1.44l2.11 3.64a1 1 0 0 0 1.47.33 4.06 4.06 0 0 1 3.17-.71 4.1 4.1 0 0 1 3 2.53 4 4 0 0 1 .28 1.88 1 1 0 0 0 1 1.15h4.18a1 1 0 0 0 1-1.15 4 4 0 0 1 .35-1.85zm-7.38-11a4 4 0 1 1 4 4 4 4 0 0 1 -4-4z" vector-effect="non-scaling-stroke" transform="translate(0,0)scale(1,1)" fill="none"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Account settings</div>
                        </a>
                        <a class="_1lqi869l" href="/alerts" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><g vector-effect="non-scaling-stroke" transform="translate(0,0)scale(1,1)" fill="none" stroke="#000" stroke-width="2"><path d="m5.00135366 26c-.20958675 0-.41387603-.0658516-.58400769-.1882519-.44831611-.3225385-.55027898-.9474397-.22774044-1.3957558l2.80967332-3.9069923.00072115-7.509.00383711-.2653623c.14037147-4.84782402 4.11436019-8.7346377 8.99616289-8.7346377 4.9705627 0 9 4.02943725 9 9l-.0007211 7.508 2.8111156 3.9079923c.0979202.1361053.1596493.2940715.1804241.4591222l.0078277.1248855c0 .5522847-.4477152 1-1 1z"></path><path d="m15.3333333 30.6666667c1.4727594 0 2.6666667-1.1939074 2.6666667-2.6666667s-1.1939073-2.6666667-2.6666667-2.6666667h-1.3333333v5.3333334z" transform="matrix(0 1 -1 0 44 12)"></path><path d="m16 1v4"></path></g></svg>
                                    <div class="_1xhrozh2" aria-label="1 notification">1</div>
                                </div>
                            </div>
                            <div class="_ojs7nk">Notifications</div>
                        </a>
                        <a class="_1lqi869l" href="/become-a-host" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M31.707,15.293,29,12.58594,18.12109,1.707a3.07251,3.07251,0,0,0-4.24218,0L3,12.58594.293,15.293,1.707,16.707,3,15.41406V28a2.00229,2.00229,0,0,0,2,2H27a2.0026,2.0026,0,0,0,2-2V15.41406l1.293,1.293ZM27,28H5V13.41406l10.293-10.293a1.00142,1.00142,0,0,1,1.41406,0L27,13.41406ZM17,12v5h5v2H17v5H15V19H10V17h5V12Z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Create a new listing</div>
                        </a>
                        <div class="_1a7n56z">
                            <div class="_ipygq"></div>
                        </div>
                        <div class="_17rwvlx">Resources &amp; Support</div>
                        <a class="_1lqi869l" href="https://community.withairbnb.com/t5/Get-Local/ct-p/en_clubs" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M26 1a5 5 0 0 1 4.995 4.783L31 6v10.68a5 5 0 0 1-4.783 4.995l-.217.004a5 5 0 0 1-4.783 4.996l-.217.004-3.782-.001-3.718 4.364-3.72-4.364-3.78.001a5 5 0 0 1-4.981-4.562l-.014-.22L1 21.678V11a5 5 0 0 1 4.783-4.995L6 6a5 5 0 0 1 4.783-4.995L11 1h15zm-5 7H6a3 3 0 0 0-2.995 2.824L3 11v10.68a3 3 0 0 0 2.824 2.994L6 24.68h4.705l2.794 3.278 2.795-3.278H21a3 3 0 0 0 2.995-2.823L24 21.68V11a3 3 0 0 0-3-3zm-1 10v2H6v-2h14zm6-15H11a3 3 0 0 0-2.995 2.824L8 6h13a5 5 0 0 1 4.995 4.783L26 11v8.68a3 3 0 0 0 2.995-2.824l.005-.177V6a3 3 0 0 0-2.824-2.995L26 3zM15 13v2H6v-2h9z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Connect with Hosts near you</div>
                        </a>
                        <a class="_1lqi869l" href="/resources/hosting-homes" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M25 3a2 2 0 0 1 1.995 1.85L27 5v2h2a2 2 0 0 1 1.995 1.85L31 9v17a3 3 0 0 1-3 3H4a3 3 0 0 1-2.995-2.824L1 26V5a2 2 0 0 1 1.85-1.995L3 3zm4 6h-2v17a1 1 0 0 0 1.993.117L29 26zm-4-4H3v21a1 1 0 0 0 .883.993L4 27h21zM13 21v2H7v-2zm8 0v2h-6v-2zm-8-4v2H7v-2zm8 0v2h-6v-2zm0-8v6H7V9zm-2 2H9v2h10z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Explore hosting resources</div>
                        </a>
                        <a class="_1lqi869l" href="/help/hosting" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m16 1a15 15 0 1 0 15 15 15.017 15.017 0 0 0 -15-15zm0 28a13 13 0 1 1 13-13 13.01474 13.01474 0 0 1 -13 13zm1.5-5.5a1.5 1.5 0 1 1 -1.5-1.5 1.5 1.5 0 0 1 1.5 1.5zm4.0791-11.5c0 2.52832-1.69336 4.57764-4.57226 5.58984l-.00684 2.41309-2-.00586.01025-3.90723.73487-.20068c1.15283-.31445 3.834-1.32324 3.834-3.88916a3.189 3.189 0 0 0 -3.44775-3.16846 3.6753 3.6753 0 0 0 -3.53516 2.72071l-1.92285-.55079a5.65909 5.65909 0 0 1 5.458-4.16992 5.19687 5.19687 0 0 1 5.44774 5.16846z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Get help</div>
                        </a>
                        <div class="_1a7n56z">
                            <div class="_ipygq"></div>
                        </div>
                        <div class="_17rwvlx">Settings</div>
                        <a class="_1lqi869l" href="/account-settings/preferences" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M16 1c8.284 0 15 6.716 15 15 0 8.284-6.716 15-15 15-8.284 0-15-6.716-15-15C1 7.716 7.716 1 16 1zm4.398 21.001h-8.796C12.488 26.177 14.23 29 16 29c1.77 0 3.512-2.823 4.398-6.999zm-10.845 0H4.465a13.039 13.039 0 0 0 7.472 6.351c-1.062-1.58-1.883-3.782-2.384-6.351zm17.982 0h-5.088c-.5 2.57-1.322 4.77-2.384 6.352A13.042 13.042 0 0 0 27.535 22zM9.238 12H3.627A12.99 12.99 0 0 0 3 16c0 1.396.22 2.74.627 4h5.61A33.063 33.063 0 0 1 9 16c0-1.383.082-2.724.238-4zm11.502 0h-9.482A30.454 30.454 0 0 0 11 16c0 1.4.092 2.743.26 4.001h9.48C20.908 18.743 21 17.4 21 16a30.31 30.31 0 0 0-.26-4zm7.632 0h-5.61c.155 1.276.237 2.617.237 4s-.082 2.725-.238 4h5.61A12.99 12.99 0 0 0 29 16c0-1.396-.22-2.74-.627-4zM11.937 3.647l-.046.016A13.04 13.04 0 0 0 4.464 10h5.089c.5-2.57 1.322-4.77 2.384-6.353zM16 3l-.129.005c-1.725.133-3.405 2.92-4.269 6.995h8.796C19.512 5.824 17.77 3 16 3zm4.063.648l.037.055C21.144 5.28 21.952 7.46 22.447 10h5.089a13.039 13.039 0 0 0-7.473-6.352z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Language and translation</div>
                        </a>
                        <a class="_1lqi869l" href="/account-settings/preferences" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M25 4a2 2 0 0 1 1.995 1.85L27 6v2h2.04c1.042 0 1.88.824 1.955 1.852L31 10v16c0 1.046-.791 1.917-1.813 1.994L29.04 28H6.96c-1.042 0-1.88-.824-1.955-1.852L5 26v-2H3a2 2 0 0 1-1.995-1.85L1 22V6a2 2 0 0 1 1.85-1.995L3 4zm2 18a2 2 0 0 1-1.85 1.995L25 24H7v2h22V10h-2zM25 6H3v16h22zm-3 12a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm-8-8a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM6 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">$ USD</div>
                        </a>
                        <div class="_1a7n56z">
                            <div class="_ipygq"></div>
                        </div>
                        <div class="_23gp2n"><a href="/mobile" class="_erlr5pz">Download the app</a></div>
                        <div class="_23gp2n"><a href="/" class="_erlr5pz">Switch to traveling</a></div>
                        <div class="_23gp2n"><a href="/host/experiences" class="_erlr5pz">Host an Experience</a></div>
                        <div class="_23gp2n"><a href="/host/experiences" class="_erlr5pz">Logout</a></div>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End of Menu Bar-->        

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
    <script src="../../assets/js/jquery-3.6.1.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
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