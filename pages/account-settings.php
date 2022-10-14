<?php include "./includes/header.php"; ?>
    <title>Account Settings</title>
</head>
<style>
    ._hq87c8 {
        -webkit-box-lines: multiple !important;
        display: -webkit-box !important;
        display: -moz-box !important;
        display: -ms-flexbox !important;
        display: -webkit-flex !important;
        display: flex !important;
        -webkit-flex-wrap: wrap !important;
        -ms-flex-wrap: wrap !important;
        flex-wrap: wrap !important;
        justify-content: space-evenly;
    }
    
    ._1obfcljv {
        position: relative !important;
        width: 320px !important;
        margin-left: 0% !important;
        margin-right: 0% !important;
        padding-left: 6px !important;
        padding-right: 6px !important;
    }
    
    ._15wuypg {
        display: -webkit-box !important;
        display: -moz-box !important;
        display: -ms-flexbox !important;
        display: -webkit-flex !important;
        display: flex !important;
        height: 100% !important;
    }
    
    ._1uwb2q9 {
        -webkit-box-pack: justify !important;
        -ms-flex-pack: justify !important;
        -webkit-box-direction: normal !important;
        -webkit-box-orient: vertical !important;
        display: -webkit-box !important;
        display: -moz-box !important;
        display: -ms-flexbox !important;
        display: -webkit-flex !important;
        display: flex !important;
        -webkit-flex-direction: column !important;
        -ms-flex-direction: column !important;
        flex-direction: column !important;
        -webkit-justify-content: space-between !important;
        justify-content: space-between !important;
        width: 100% !important;
        min-height: 156px !important;
        box-shadow: 0px 6px 16px rgb(0 0 0 / 12%) !important;
        margin: 8px 0 !important;
        padding: 16px !important;
        border-radius: 12px !important;
        text-decoration: none !important;
    }
    
    ._4i4nwv {
        font-size: 16px !important;
        line-height: 20px !important;
        color: #222222 !important;
        font-weight: 600 !important;
        height: auto !important;
        margin-bottom: 8px !important;
    }
    
    ._1c02cnn {
        font-size: 14px !important;
        line-height: 18px !important;
        color: #717171 !important;
        font-weight: 400 !important;
    }
</style>

<body>
    <div id="user" v-cloak>
        <?php include "./includes/loading.php"; ?>
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
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height=" preserveAspectRatio="xMidYMid meet viewBox="0 0 21 21">
                                                    <g transform="rotate(90 10.5 10.5)">
                                                        <g fill="none" fill-rule="evenodd" stroke="currentColor"
                                                            stroke-linecap="rou stroke-linejoin=" round>
                                                            <path d="M14.5 9V2.5m0 16V14" />
                                                            <circle cx="14.5" cy="11.5" r="2.5" />
                                                            <path d="M6.5 5V2.5m0 16V10" />
                                                            <circle cx="6.5" cy="7.5" r="2.5" />
                                                        </g>
                                                    </g>
                                                </svg>
                                            </span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-0 col-md-4 col-lg-3 menu d-none d-md-inline-flex justify-content-md-end">
                            <div class="end-tabs">
                                <div class="host">
                                    <a href="./hosting/index.php" class="host-link"><span>Become a Host</span></a>
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
                                            <li v-if='!userDetails'><a class="dropdown-item" href="register.php">Sign up</a></li>
                                            <li v-if='!userDetails'><a class="dropdown-item" href="login.php">Log in</a></li>
                                            <li v-if='userDetails'><a class="dropdown-item" href="account-settings.php">Account</a></li>
                                            <li v-if='userDetails'><a class="dropdown-item" href="login.php">Manage Listings</a></li>
                                            <div class="sub-menu-links">
                                                <li><a class="dropdown-item" href="home.php">Host your Home</a></li>
                                                <li><a class="dropdown-item" href="help.php">Help</a></li>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main v-if='userDetails' class="container justify-content-center row" style="margin: auto;margin-bottom: 60px;margin-top: 120px;">
                <div class="my-4">
                    <h2><b>Account Settings</b></h2>
                    <b>{{userDetails.fullname}}, {{userDetails.Email}} · <a href="profile.php">Go to profile</a></b>
                </div>
                <div class="_hq87c8 my-md-5">
                    <div class="_1obfcljv">
                        <div class="_15wuypg">
                            <a href="./account-settings/personal-info.php" class="_1uwb2q9">
                                <div style="margin-bottom: 16px;"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="m29 5c1.0543618 0 1.9181651.81587779 1.9945143 1.85073766l.0054857.14926234v18c0 1.0543618-.8158778 1.9181651-1.8507377 1.9945143l-.1492623.0054857h-26c-1.0543618 0-1.91816512-.8158778-1.99451426-1.8507377l-.00548574-.1492623v-18c0-1.0543618.81587779-1.91816512 1.85073766-1.99451426l.14926234-.00548574zm0 2h-26v18h26zm-3 12v2h-8v-2zm-16-8c1.6568542 0 3 1.3431458 3 3 0 .6167852-.1861326 1.1900967-.5052911 1.6668281 1.4972342.8624949 2.5052911 2.4801112 2.5052911 4.3331719h-2c0-1.3058822-.8343774-2.4168852-1.9990993-2.8289758l-.0009007-3.1710242c0-.5522847-.4477153-1-1-1-.51283584 0-.93550716.3860402-.99327227.8833789l-.00672773.1166211.00008893 3.1706743c-1.16523883.4118113-2.00008893 1.5230736-2.00008893 2.8293257h-2c0-1.8530607 1.00805693-3.470677 2.50570706-4.3343854-.3195745-.4755179-.50570706-1.0488294-.50570706-1.6656146 0-1.6568542 1.34314575-3 3-3zm16 4v2h-8v-2zm0-4v2h-8v-2z"></path></svg></div>
                                <div>
                                    <div class="_4i4nwv">Personal info</div>
                                    <div class="_1c02cnn">Provide personal details and how we can reach you</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="_1obfcljv">
                        <div class="_15wuypg">
                            <a href="./account-settings/login-and-security.php" class="_1uwb2q9">
                                <div style="margin-bottom: 16px;"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="M16 .798l.555.37C20.398 3.73 24.208 5 28 5h1v12.5C29 25.574 23.21 31 16 31S3 25.574 3 17.5V5h1c3.792 0 7.602-1.27 11.445-3.832L16 .798zm-1 3.005c-3.2 1.866-6.418 2.92-9.648 3.149L5 6.972V17.5c0 6.558 4.347 10.991 10 11.459zm2 0V28.96c5.654-.468 10-4.901 10-11.459V6.972l-.352-.02c-3.23-.23-6.448-1.282-9.647-3.148z"></path></svg></div>
                                <div>
                                    <div class="_4i4nwv">Login &amp; security</div>
                                    <div class="_1c02cnn">Update your password and secure your account</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="_1obfcljv">
                        <div class="_15wuypg">
                            <a href="./account-settings/payment-methods.php" class="_1uwb2q9">
                                <div style="margin-bottom: 16px;"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="M25 4a2 2 0 0 1 1.995 1.85L27 6v2h2.04c1.042 0 1.88.824 1.955 1.852L31 10v16c0 1.046-.791 1.917-1.813 1.994L29.04 28H6.96c-1.042 0-1.88-.824-1.955-1.852L5 26v-2H3a2 2 0 0 1-1.995-1.85L1 22V6a2 2 0 0 1 1.85-1.995L3 4zm2 18a2 2 0 0 1-1.85 1.995L25 24H7v2h22V10h-2zM25 6H3v16h22zm-3 12a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm-8-8a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM6 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path></svg></div>
                                <div>
                                    <div class="_4i4nwv">Payments &amp; payouts</div>
                                    <div class="_1c02cnn">Review payments, payouts, coupons, gift cards, and taxes</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="_1obfcljv">
                        <div class="_15wuypg">
                            <a href="./account-settings/notifications.php" class="_1uwb2q9">
                                <div style="margin-bottom: 16px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="M30.82812,3.72656A2.00276,2.00276,0,0,0,28.1875,2.71143L11.78772,10H7a5.99987,5.99987,0,0,0-.25928,11.99414L11,21.99811V29h2V22.53833l15.18848,6.75073A2.0003,2.0003,0,0,0,31,27.46094V4.53857A2.01958,2.01958,0,0,0,30.82812,3.72656ZM6.81641,19.99609A4.00016,4.00016,0,0,1,7,12h4v8H7.02246ZM29,27.46094,13,20.35059V11.6499L29,4.53857Z"></path></svg></div>
                                <div>
                                    <div class="_4i4nwv">Notifications</div>
                                    <div class="_1c02cnn">Choose notification preferences and how you want to be contacted</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="_1obfcljv">
                        <div class="_15wuypg">
                            <a href="./account-settings/privacy-and-sharing.php" class="_1uwb2q9">
                                <div style="margin-bottom: 16px;"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="m16 27a15.57488 15.57488 0 0 1 -14.51758-10.05811l-.10986-.29389.13281-.52051a15.00446 15.00446 0 0 1 28.98682-.01123l.13476.53272-.10937.293a15.57682 15.57682 0 0 1 -14.51758 10.05802zm-12.53174-10.46973a13.50587 13.50587 0 0 0 25.064-.001 13.00488 13.00488 0 0 0 -25.064.001zm12.53174 4.46973a5 5 0 1 1 5-5 5.00588 5.00588 0 0 1 -5 5zm0-8a3 3 0 1 0 3 3 3.00328 3.00328 0 0 0 -3-3z"></path></svg></div>
                                <div>
                                    <div class="_4i4nwv">Privacy &amp; sharing</div>
                                    <div class="_1c02cnn">Control connected apps, what you share, and who sees it</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="_1obfcljv">
                        <div class="_15wuypg">
                            <a href="./account-settings/preferences.php" class="_1uwb2q9">
                                <div style="margin-bottom: 16px;"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="m24 31a7 7 0 0 0 0-14h-16a7 7 0 0 0 0 14zm5-7a5 5 0 1 1 -5-5 5.00588 5.00588 0 0 1 5 5zm-26 0a5.00588 5.00588 0 0 1 5-5h11.11072a6.97751 6.97751 0 0 0 0 10h-11.11072a5.00588 5.00588 0 0 1 -5-5zm21-23h-16a7 7 0 0 0 0 14h16a7 7 0 0 0 0-14zm-21 7a5 5 0 1 1 5 5 5.00588 5.00588 0 0 1 -5-5zm21 5h-11.11035a6.97836 6.97836 0 0 0 0-10h11.11035a5 5 0 0 1 0 10z"></path></svg></div>
                                <div>
                                    <div class="_4i4nwv">Global preferences</div>
                                    <div class="_1c02cnn">Set your default language, currency, and timezone</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="_1obfcljv">
                        <div class="_15wuypg">
                            <a href="./account-settings/airbnb-for-work.php" class="_1uwb2q9" data-testid="account-settings-a4w-tile">
                                <div style="margin-bottom: 16px;"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="M26 2a1 1 0 0 1 .922.612l.04.113 2 7a1 1 0 0 1-.847 1.269L28 11h-3v5h6v2h-2v13h-2l.001-2.536a3.976 3.976 0 0 1-1.73.527L25 29H7a3.982 3.982 0 0 1-2-.535V31H3V18H1v-2h5v-4a1 1 0 0 1 .883-.993L7 11h.238L6.086 8.406l1.828-.812L9.427 11H12a1 1 0 0 1 .993.883L13 12v4h10v-5h-3a1 1 0 0 1-.987-1.162l.025-.113 2-7a1 1 0 0 1 .842-.718L22 2h4zm1 16H5v7a2 2 0 0 0 1.697 1.977l.154.018L7 27h18a2 2 0 0 0 1.995-1.85L27 25v-7zm-16-5H8v3h3v-3zm14.245-9h-2.491l-1.429 5h5.349l-1.429-5z"></path></svg></div>
                                <div>
                                    <div class="_4i4nwv">Travel for work</div>
                                    <div class="_1c02cnn">Add a work email for business trip benefits</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="_1obfcljv">
                        <div class="_15wuypg">
                            <a href="/account-settings/professional-hosting" class="_1uwb2q9">
                                <div style="margin-bottom: 16px;"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="m27 5h-4a2.00229 2.00229 0 0 0 -2 2v4h-4v-8a2.002 2.002 0 0 0 -2-2h-4a2.002 2.002 0 0 0 -2 2v8h-4a2.002 2.002 0 0 0 -2 2v16a2.00229 2.00229 0 0 0 2 2h22a2.0026 2.0026 0 0 0 2-2v-22a2.00229 2.00229 0 0 0 -2-2zm-18 24h-4l-.00146-16h4.00146zm6 0h-4v-16l-.00092-.00891-.00054-9.99109h4.00146zm6 0h-4v-16h4zm6 0h-4v-16l-.00073-.007-.00027-5.993h4.001z"></path></svg></div>
                                <div>
                                    <div class="_4i4nwv">Professional hosting tools</div>
                                    <div class="_1c02cnn">Get professional tools if you manage several properties on Airbnb</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="_1obfcljv">
                        <div class="_15wuypg">
                            <a href="/invite?r=51" class="_1uwb2q9">
                                <div style="margin-bottom: 16px;"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="m28 2c1.0543618 0 1.9181651.81587779 1.9945143 1.85073766l.0054857.14926234v24c0 1.0543618-.8158778 1.9181651-1.8507377 1.9945143l-.1492623.0054857h-24c-1.0543618 0-1.91816512-.8158778-1.99451426-1.8507377l-.00548574-.1492623v-24c0-1.0543618.81587779-1.91816512 1.85073766-1.99451426l.14926234-.00548574zm-14.415 15h-9.585v11h11v-9.586l-4.2928932 4.2931068-1.41421358-1.4142136zm14.415 0h-9.585l4.2921068 4.2928932-1.4142136 1.4142136-4.2928932-4.2931068v9.586h11zm-13-13h-11v11l3.53577067.0011092c-.34073717-.5885973-.53577067-1.272077-.53577067-2.0011092 0-2.209139 1.790861-4 4-4 1.0347079 0 1.9884302.35717147 2.8159632 1.1592818.2940352.2850022.6817727.8549374 1.1838896 1.7366117zm6 7c-.5327919 0-.9841014.1690165-1.4239808.5953825-.2060299.1997004-.6246872.8766948-1.2206134 1.985144l-.247741.466282-.4926648.9531915h3.385c1.0016437 0 1.8313084-.7363297 1.9772306-1.6972257l.0172837-.153512.0054857-.1492623c0-1.1045695-.8954305-2-2-2zm7-7h-11l.0007292 7.8948717c.5018346-.8810929.889386-1.4506978 1.1833076-1.7355899.827533-.80211033 1.7812553-1.1592818 2.8159632-1.1592818 2.209139 0 4 1.790861 4 4 0 .7290322-.1950335 1.4125119-.5357707 2.0011092l3.5357707-.0011092zm-17 7c-1.1045695 0-2 .8954305-2 2l.00548574.1492623c.07634914 1.0348599.94015246 1.8507377 1.99451426 1.8507377h3.385l-.4926648-.9531915-.3645522-.6822055c-.533991-.9806703-.9115076-1.5828334-1.1038022-1.7692205-.4398794-.426366-.8911889-.5953825-1.4239808-.5953825z"></path></svg></div>
                                <div>
                                    <div class="_4i4nwv">Invite friends</div>
                                    <div class="_1c02cnn">
                                        <div class="_1p3joamp"><span aria-busy="true" style="display: inline-block; height: 1ex; width: 60%;"><span class="atm_12_q7pw6w atm_16_12c5xpv atm_u_1yy80mb atm_y_9cwzv5 atm_1c_lvmtox atm_1k_1ytfnp0 atm_2d_1r31cwp atm_9s_1ulexfb atm_mk_h2mmj6 atm_e2p1ow_glywfm atm_5rfkrh_7tcf61 dir dir-ltr" style="height: 100%; width: 100%;"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="_12to336" id="FMP-target">
                    <div style="margin-bottom: 49px;" class="d-md-flex justify-content-center align-items-center">
                        <div>
                            <div class="_101jwz9 mx-3">Need to deactivate your account?</div>
                        </div>
                        <a href="/account-delete/account" class="_1sikdxcl">Take care of that now</a></div>
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
            <footer class="pt-5 mb-0 mt-5 position-static d-none d-md-block" style="background-color: #F7F7F7 !important;border-top: 1px solid #DDDDDD !important;">
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
    </div>

    
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <script src="../assets/js/custom.js"></script>
    <?php include "./includes/vue-script.php"; ?>
</body>

</html>