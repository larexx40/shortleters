<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/fonts/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Layout Page</title>

    <style>

    </style>


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


        <main class="container justify-content-center row" style="margin: auto;">
            <div class="card col-md-7 p-0" style="max-width: 500px;margin-top:120px;">
                <b class="text-center pt-3"> Log in or sign up</b>
                <hr>
                <form class="p-3 pt-3">
                    <h3 class="mb-3"><b>Welcome to Airbnb.</b></h3>
                    <!-- Email input -->
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                      
                      <option value="93AF">Afghanistan (+93)</option><option value="358AX">Åland Islands (+358)</option><option value="355AL">Albania (+355)</option><option value="213DZ">Algeria (+213)</option><option value="1AS">American Samoa (+1)</option><option value="376AD">Andorra (+376)</option><option value="244AO">Angola (+244)</option><option value="1AI">Anguilla (+1)</option><option value="1AG">Antigua &amp; Barbuda (+1)</option><option value="54AR">Argentina (+54)</option><option value="374AM">Armenia (+374)</option><option value="297AW">Aruba (+297)</option><option value="61AU">Australia (+61)</option><option value="43AT">Austria (+43)</option><option value="994AZ">Azerbaijan (+994)</option><option value="1BS">Bahamas (+1)</option><option value="973BH">Bahrain (+973)</option><option value="880BD">Bangladesh (+880)</option><option value="1BB">Barbados (+1)</option><option value="375BY">Belarus (+375)</option><option value="32BE">Belgium (+32)</option><option value="501BZ">Belize (+501)</option><option value="229BJ">Benin (+229)</option><option value="1BM">Bermuda (+1)</option><option value="975BT">Bhutan (+975)</option><option value="591BO">Bolivia (+591)</option><option value="599BQ">Bonaire, Sint Eustatius and Saba (+599)</option><option value="387BA">Bosnia &amp; Herzegovina (+387)</option><option value="267BW">Botswana (+267)</option><option value="55BR">Brazil (+55)</option><option value="246IO">British Indian Ocean Territory (+246)</option><option value="1VG">British Virgin Islands (+1)</option><option value="673BN">Brunei (+673)</option><option value="359BG">Bulgaria (+359)</option><option value="226BF">Burkina Faso (+226)</option><option value="257BI">Burundi (+257)</option><option value="855KH">Cambodia (+855)</option><option value="237CM">Cameroon (+237)</option><option value="1CA">Canada (+1)</option><option value="238CV">Cape Verde (+238)</option><option value="1KY">Cayman Islands (+1)</option><option value="236CF">Central African Republic (+236)</option><option value="235TD">Chad (+235)</option><option value="56CL">Chile (+56)</option><option value="86CN">China (+86)</option><option value="61CX">Christmas Island (+61)</option><option value="61CC">Cocos (Keeling) Islands (+61)</option><option value="57CO">Colombia (+57)</option><option value="269KM">Comoros (+269)</option><option value="242CG">Congo (+242)</option><option value="682CK">Cook Islands (+682)</option><option value="506CR">Costa Rica (+506)</option><option value="225CI">Côte d’Ivoire (+225)</option><option value="385HR">Croatia (+385)</option><option value="53CU">Cuba (+53)</option><option value="599CW">Curaçao (+599)</option><option value="357CY">Cyprus (+357)</option><option value="420CZ">Czechia (+420)</option><option value="243CD">Democratic Republic of the Congo (+243)</option><option value="45DK">Denmark (+45)</option><option value="253DJ">Djibouti (+253)</option><option value="1DM">Dominica (+1)</option><option value="1DO">Dominican Republic (+1)</option><option value="593EC">Ecuador (+593)</option><option value="20EG">Egypt (+20)</option><option value="503SV">El Salvador (+503)</option><option value="240GQ">Equatorial Guinea (+240)</option><option value="291ER">Eritrea (+291)</option><option value="372EE">Estonia (+372)</option><option value="268SZ">Eswatini (+268)</option><option value="251ET">Ethiopia (+251)</option><option value="500FK">Falkland Islands (Islas Malvinas) (+500)</option><option value="298FO">Faroe Islands (+298)</option><option value="679FJ">Fiji (+679)</option><option value="358FI">Finland (+358)</option><option value="33FR">France (+33)</option><option value="594GF">French Guiana (+594)</option><option value="689PF">French Polynesia (+689)</option><option value="241GA">Gabon (+241)</option><option value="220GM">Gambia (+220)</option><option value="995GE">Georgia (+995)</option><option value="49DE">Germany (+49)</option><option value="233GH">Ghana (+233)</option><option value="350GI">Gibraltar (+350)</option><option value="30GR">Greece (+30)</option><option value="299GL">Greenland (+299)</option><option value="1GD">Grenada (+1)</option><option value="590GP">Guadeloupe (+590)</option><option value="1GU">Guam (+1)</option><option value="502GT">Guatemala (+502)</option><option value="44GG">Guernsey (+44)</option>
                      <option value="224GN">Guinea (+224)</option><option value="245GW">Guinea-Bissau (+245)</option><option value="592GY">Guyana (+592)</option><option value="509HT">Haiti (+509)</option><option value="504HN">Honduras (+504)</option><option value="852HK">Hong Kong (+852)</option><option value="36HU">Hungary (+36)</option><option value="354IS">Iceland (+354)</option><option value="91IN">India (+91)</option><option value="62ID">Indonesia (+62)</option><option value="964IQ">Iraq (+964)</option><option value="353IE">Ireland (+353)</option><option value="44IM">Isle of Man (+44)</option><option value="972IL">Israel (+972)</option><option value="39IT">Italy (+39)</option><option value="1JM">Jamaica (+1)</option><option value="81JP">Japan (+81)</option><option value="44JE">Jersey (+44)</option><option value="962JO">Jordan (+962)</option><option value="7KZ">Kazakhstan (+7)</option><option value="254KE">Kenya (+254)</option><option value="686KI">Kiribati (+686)</option><option value="383XK">Kosovo (+383)</option><option value="965KW">Kuwait (+965)</option><option value="996KG">Kyrgyzstan (+996)</option><option value="856LA">Laos (+856)</option><option value="371LV">Latvia (+371)</option><option value="961LB">Lebanon (+961)</option><option value="266LS">Lesotho (+266)</option><option value="231LR">Liberia (+231)</option><option value="218LY">Libya (+218)</option><option value="423LI">Liechtenstein (+423)</option><option value="370LT">Lithuania (+370)</option><option value="352LU">Luxembourg (+352)</option><option value="853MO">Macau (+853)</option><option value="389MK">North Macedonia (+389)</option><option value="261MG">Madagascar (+261)</option><option value="265MW">Malawi (+265)</option><option value="60MY">Malaysia (+60)</option><option value="960MV">Maldives (+960)</option><option value="223ML">Mali (+223)</option><option value="356MT">Malta (+356)</option><option value="692MH">Marshall Islands (+692)</option><option value="596MQ">Martinique (+596)</option><option value="222MR">Mauritania (+222)</option><option value="230MU">Mauritius (+230)</option><option value="262YT">Mayotte (+262)</option><option value="52MX">Mexico (+52)</option><option value="691FM">Micronesia (+691)</option><option value="373MD">Moldova (+373)</option><option value="377MC">Monaco (+377)</option><option value="976MN">Mongolia (+976)</option><option value="382ME">Montenegro (+382)</option><option value="1MS">Montserrat (+1)</option><option value="212MA">Morocco (+212)</option><option value="258MZ">Mozambique (+258)</option><option value="95MM">Myanmar (+95)</option><option value="264NA">Namibia (+264)</option><option value="674NR">Nauru (+674)</option><option value="977NP">Nepal (+977)</option><option value="31NL">Netherlands (+31)</option><option value="687NC">New Caledonia (+687)</option><option value="64NZ">New Zealand (+64)</option><option value="505NI">Nicaragua (+505)</option><option value="227NE">Niger (+227)</option><option value="234NG">Nigeria (+234)</option><option value="683NU">Niue (+683)</option><option value="672NF">Norfolk Island (+672)</option><option value="1MP">Northern Mariana Islands (+1)</option><option value="47NO">Norway (+47)</option><option value="968OM">Oman (+968)</option><option value="92PK">Pakistan (+92)</option><option value="680PW">Palau (+680)</option><option value="970PS">Palestinian Territories (+970)</option><option value="507PA">Panama (+507)</option><option value="675PG">Papua New Guinea (+675)</option><option value="595PY">Paraguay (+595)</option><option value="51PE">Peru (+51)</option><option value="63PH">Philippines (+63)</option><option value="64PN">Pitcairn Islands (+64)</option><option value="48PL">Poland (+48)</option><option value="351PT">Portugal (+351)</option><option value="1PR">Puerto Rico (+1)</option><option value="974QA">Qatar (+974)</option><option value="262RE">Réunion (+262)</option><option value="40RO">Romania (+40)</option><option value="7RU">Russia (+7)</option><option value="250RW">Rwanda (+250)</option><option value="685WS">Samoa (+685)</option><option value="378SM">San Marino (+378)</option><option value="239ST">São Tomé &amp; Príncipe (+239)</option><option value="966SA">Saudi Arabia (+966)</option><option value="221SN">Senegal (+221)</option><option value="381RS">Serbia (+381)</option><option value="248SC">Seychelles (+248)</option><option value="232SL">Sierra Leone (+232)</option><option value="65SG">Singapore (+65)</option><option value="1SX">Sint Maarten (+1)</option><option value="421SK">Slovakia (+421)</option><option value="386SI">Slovenia (+386)</option><option value="677SB">Solomon Islands (+677)</option><option value="252SO">Somalia (+252)</option><option value="27ZA">South Africa (+27)</option><option value="500GS">South Georgia &amp; South Sandwich Islands (+500)</option><option value="82KR">South Korea (+82)</option><option value="211SS">South Sudan (+211)</option><option value="34ES">Spain (+34)</option><option value="94LK">Sri Lanka (+94)</option><option value="590BL">St. Barthélemy (+590)</option><option value="290SH">St. Helena (+290)</option><option value="1KN">St. Kitts &amp; Nevis (+1)</option><option value="1LC">St. Lucia (+1)</option><option value="590MF">St. Martin (+590)</option><option value="508PM">St. Pierre &amp; Miquelon (+508)</option><option value="1VC">St. Vincent &amp; Grenadines (+1)</option><option value="249SD">Sudan (+249)</option><option value="597SR">Suriname (+597)</option><option value="47SJ">Svalbard &amp; Jan Mayen (+47)</option><option value="46SE">Sweden (+46)</option><option value="41CH">Switzerland (+41)</option><option value="886TW">Taiwan (+886)</option><option value="992TJ">Tajikistan (+992)</option>
                      <option value="255TZ">Tanzania (+255)</option><option value="66TH">Thailand (+66)</option><option value="670TL">Timor-Leste (+670)</option><option value="228TG">Togo (+228)</option><option value="690TK">Tokelau (+690)</option><option value="676TO">Tonga (+676)</option><option value="1TT">Trinidad &amp; Tobago (+1)</option><option value="216TN">Tunisia (+216)</option><option value="90TR">Turkey (+90)</option><option value="993TM">Turkmenistan (+993)</option><option value="1TC">Turks &amp; Caicos Islands (+1)</option><option value="688TV">Tuvalu (+688)</option><option value="1VI">U.S. Virgin Islands (+1)</option><option value="256UG">Uganda (+256)</option><option value="380UA">Ukraine (+380)</option><option value="971AE">United Arab Emirates (+971)</option><option value="44GB">United Kingdom (+44)</option><option value="1US">United States (+1)</option><option value="598UY">Uruguay (+598)</option><option value="998UZ">Uzbekistan (+998)</option><option value="678VU">Vanuatu (+678)</option><option value="379VA">Vatican City (+379)</option><option value="58VE">Venezuela (+58)</option><option value="84VN">Vietnam (+84)</option><option value="681WF">Wallis &amp; Futuna (+681)</option><option value="212EH">Western Sahara (+212)</option><option value="967YE">Yemen (+967)</option><option value="260ZM">Zambia (+260)</option><option value="263ZW">Zimbabwe (+263)</option>
                    </select>
                        <label for="floatingSelect">Country/Region</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPhonenumber" placeholder="Phone Number">
                        <label for="floatingPhonenumber">Phone number</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <span class="d-block mb-3"><small>We’ll call or text you to confirm your number. Standard message and data rates apply.</small> <a href="#!">Privacy Policy?</a></span>
                    <!-- 2 column grid layout for inline styling -->


                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block p-2 mb-2" style="width: calc(100% - 30px);">Continue</button>

                    <div class="_16fq9mb">or</div>
                    <!-- Register buttons -->
                    <div class="social-links d-grid" style="gap:10px;">
                    <button type="button" class="btn position-relative text-center btn-floating mx-1">
                        <em class="bi bi-facebook position-absolute" style="color: rgb(24, 119, 242);"></em> <b> Continue with Facebook.</b>
                    </button>

                    <button type="button" class="btn position-relative text-center btn-floating mx-1">
                        <em class="bi bi-google position-absolute" style="color: red;"></em> <b> Continue with Google.</b>
                    </button>

                    <button type="button" class="btn position-relative text-center btn-floating mx-1">
                        <em class="bi bi-twitter position-absolute" style="color: #37afd6;"></em> <b>Continue with Twitter.</b>
                    </button>

                    <button type="button" class="btn position-relative text-center btn-floating mx-1">
                        <em class="bi bi-github position-absolute"></em> <b>Continue with Github.</b>
                    </button>
                    

                    <button type="button" class="btn position-relative text-center btn-floating mx-1 " data-bs-target="#staticBackdropfilter2" data-bs-toggle="modal">
                        <b>Launch Modal</b>
                    </button>                    

                    </div>
                </form>

            </div>

        </main>

        <!-- TODO <======== SEARCH BAR MODAL START =========> -->
        <div class="modal fade filter" id="staticBackdropfilter2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <h6 class="modal-title" id="staticBackdropLabel">Check your phone for an otp message</h6>
                        <div style="background-color: transparent; width: 2rem;height: 2px"></div>
                    </div>
                    <div class="modal-body"  style=" flex-direction:column;">
                        <div style="display:flex; justify-content:center;border:none;padding:20px 0px" >
                            <form class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
                                <input type="number" id="digit-1" name="digit-1" data-next="digit-2" />
                                <input type="number" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
                                <input type="number" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
                                <span class="splitter">&ndash;</span>
                                <input type="number" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
                                <input type="number" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" />
                                <input type="number" id="digit-6" name="digit-6" data-previous="digit-5" />
                            </form>
                        </div>
                        <div style="display:flex; justify-content:center;border:none;padding:20px 0px" >
                            <div class="submit-btn">
                                <button class="btn" style="background-color: #000; color: #fff; padding: 14px 1.8rem">Save</button>
                            </div>                         
                        </div>
                       
                    </div>

                </div>
            </div>
        </div>
        <!-- <======= SEARCH BAR MODAL ENDS ========> -->       
 

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
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <script src="../assets/js/custom.js"></script>
    <?php include "./includes/vue-script.php"; ?>

    <script>
        $(document).ready(function(){
            $('#floatingPhonenumber').focus(function(){
                if( $("#floatingPhonenumber").val() === "" ){
                    let selected = $("#floatingSelect").val();
                    var st = selected;
                    var regex = new RegExp('([0-9]+)|([a-zA-Z]+)','g');
                    var splittedArray = st.match(regex);
                    var num = splittedArray[0];              
                    $('#floatingPhonenumber').val("+"+num);                       
                }
             
            });

            $('.digit-group').find('input').each(function() {
                $(this).attr('maxlength', 1);
                $(this).on('keyup', function(e) {
                    var parent = $($(this).parent());
                    
                    if(e.keyCode === 8 || e.keyCode === 37) {
                        var prev = parent.find('input#' + $(this).data('previous'));
                        
                        if(prev.length) {
                            $(prev).select();
                        }
                    } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                        var next = parent.find('input#' + $(this).data('next'));
                        
                        if(next.length) {
                            $(next).select();
                        } else {
                            if(parent.data('autosubmit')) {
                                parent.submit();
                            }
                        }
                    }
                });
            });            

        });        
    </script>
</body>

</html>