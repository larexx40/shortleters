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