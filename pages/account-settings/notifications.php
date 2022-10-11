<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Notifications</title>
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
			crossorigin="anonymous" />
         <link rel="stylesheet" href="../../assets/fonts/bootstrap-icons.css">
      <link rel="stylesheet" href="../../assets/css/layout.css">
      <link rel="stylesheet" href="../../assets/css/footer.css">
      <link rel="stylesheet" href="../../assets/css/nav.css">
	</head>
	<body>
		<style>
         .container{
            max-width: 1140px;
         }
         main.container{
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            row-gap: 2rem;
            width: 100%;
         }
         .page-title h2{
            font-weight: bold;
         }
         .page-inner{
            width: 100%;
            margin-top: 2rem;
         }
         .page-inner .form-wrapper{
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            row-gap: 10px;
         }
         .page-inner h4{
            font-weight: 600;
         }
         .page-inner form{
            width: 100%;
            margin-top: 2rem;
         }
         .page-inner > .row {
            row-gap: 3rem;
         }

         /* content wrapper */
         .content-wrapper{
            border: 1px solid rgb(228, 228, 228) ;
            padding: 24px;
            border-radius: 9px;
         }
         .content-wrapper-inner{
            margin: 0px;
            background-color: rgb(255, 255, 255);
            min-height: 100px;
         }
         .content-wrapper-inner .each-content{
            display: flex;
            align-items: flex-start;
            row-gap: 1em;
            flex-direction: column;
         }
         .each-content .form-select{
            color: #7A7171;
            font-size: 15px;
            min-height: 3.2rem;
            border-radius: 8px;
         }
         .form-select:focus{
            border: 2px solid #000;
            box-shadow: none;
         }
         .content-wrapper-inner .each-content a{
            text-decoration: underline;
            color: #000;
         }
         .content-wrapper-inner .each-content h5{
            font-size: 1.2rem;
            font-weight: 600;
         }
         .each-content * .sub-text{
            color: #717171;
         }
         .each-content .body{
            margin-top: 1.5rem;
         }
         :is(.breadcrumb-item, .breadcrumb-item a){
            color: #484871;
         }
         .breadcrumb-item a{
            font-weight: 600;
            letter-spacing: .3px;
         }
         .breadcrumb-item a:hover{
            text-decoration: underline;
         }
         .form-wrapper .nav-pills {
            border-bottom: 2px solid #EBEBEB;
            padding-bottom:.5px;
            width: 100%;
         }
         .form-wrapper .nav-pills .nav-link{
            border-radius: 0;
            padding: 0;
            display: inline-block;
            margin-right: 2rem;
            padding-bottom: .5rem;
            color: #bbb;
            font-size: 15px;
         }
         .form-wrapper .nav-pills .nav-link.active{
            background-color: unset;
            color: #000;
            font-weight: 600;
            border-bottom: 2px solid #000;
         }
         .tab-pane .sub-text{
            color: #717171;
            font-size: 15px;
         }
         .tab-pane-inner.one{
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            row-gap: 2.2rem;
         }
         .tab-pane-inner.one .tab-body{
            display: flex;
            align-items: flex-start;
            row-gap: 2.5rem;
            flex-direction: column;
         }
         .tab-pane-inner.one .tab-body button{
            font-size: 1.05rem;
            color: #000;
            font-weight: 600;
            display: flex;
            align-items: center;
         }
         .tab-pane-inner.one .tab-body button em{
            display: flex;
         }
         .tab-pane-inner.one .tab-body button span:has(em){
            margin-left: 6px;
         }
         .each-inner-tab-pane{
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgb(228, 228, 228);
            margin-top: 1.5rem; 
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            row-gap: 1rem;
         }
         .each-inner-tab-pane .tab-title > button{
            font-size: 1.1rem;
         }
         .each-inner-tab-pane .tab-title > button .form-check-input{
            width: 1.8rem;
            height: 1.8rem;
         }
         .each-inner-tab-pane .sub-text{
            color: #717171;
            font-size: 15px;
         }
         .each-inner-tab-pane .tab-body .top .text{
            color: #222222;
            font-size: 1.05rem;
         }
         .each-inner-tab-pane .bottom{
            margin-top: 1.5rem;
         }
         .each-inner-tab-pane .tab-title > button .form-check-label{
            line-height: 2.5rem;
         }

         /* modal */
         .modal.unsubscribe .modal-header button{
            margin: 0;
            width: max-content;
         }
         .modal.unsubscribe .modal-title {
            flex-grow: 1;
            display: flex;
            justify-content: center;
         }
         .modal.unsubscribe .modal-header h5{
            font-weight: 600;
            font-size: 1.1rem;
         }
        .no-border-modal .modal-header{
         border: none;
        }
        .form-switch .form-check-input:checked[type="checkbox"] {
            background-color: var(--active-clr);
            border: 1px solid var(--active-clr);
         }

         .form-switch .form-check-input:focus[type="checkbox"] {
            box-shadow: none;
            border: 1px solid var(--active-clr);
            filter: grayscale(1);
         }

         .form-check .form-check-label {
            margin-left: 15px;
         }
         .form-switch .form-check-input {
            height: 2.1rem;
            width: 3.5em;
            margin-left: -2.5em;
            border-radius: 2em;
         }

      </style>
      <div class="body-wrapper">
        <header>
            <div class="header-inner">
                <div class="row col-12 m-0 align-items-center justify-content-between justify-content-md-around">
                    <div class="p-0 col-md-1 col-lg-2 logo text-md-start d-none d-md-inline-flex">
                        <div class="lg-screen-logo d-none d-lg-inline-flex">
                            <a href="#">
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
                                <li class="nav-item d-none d-md-inline-flex" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Anywhere</button>
                                </li>
                                <span class="bar d-none d-md-inline-flex"></span>
                                <li class="nav-item d-none d-md-inline-flex" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Any week</button>
                                </li>
                                <span class="bar d-none d-md-inline-flex"></span>
                                <li class="nav-item d-none d-md-inline-flex" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Add Guest</button>
                                </li>
                                <li class="nav-item d-none d-md-inline-flex" role="presentation">
                                    <button class="nav-link search-icon" id="pills-search-tab" data-bs-toggle="pill" data-bs-target="#pills-search" type="button" role="tab" aria-controls="pills-search" aria-selected="false">
                              <em class="bi bi-search"></em>
                           </button>
                                </li>
                                <li class="nav-item mobile d-md-none">
                                    <button>
                              <div class="icon-search"><em class="bi bi-search"></em></div>
                              <div class="where-to">
                                 <span>Where to?</span>
                                 <div>
                                    <a href="#">Anywhere</a>
                                    <span class="dot"></span>
                                    <a href="#">Any week</a>
                                    <span class="dot"></span>
                                    <a href="#">Add guests</a>
                                 </div>
                              </div>
                           </button>
                                </li>
                                <li class="filter-icon d-md-none">
                                    <button>
                              <span><svg xmlns="http://www.w3.org/2000/svg" width="32" height="preserveAspectRatio="
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
                                <a href="#" class="host-icon"><em class="bi bi-globe"></em></a>
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
                                        <li><a class="dropdown-item" href="#">Messages</a></li>
                                        <li><a class="dropdown-item" href="#">Notifications</a></li>
                                        <li><a class="dropdown-item" href="#">Trips</a></li>
                                        <li><a class="dropdown-item" href="#">Wishlists</a></li>
                                        <div class="sub-menu-links">
                                            <li><a class="dropdown-item" href="#">Host your Home</a></li>
                                            <li><a class="dropdown-item" href="#">Host an experience</a></li>
                                            <li><a class="dropdown-item" href="#">Account</a></li>
                                        </div>
                                        <div class="sub-menu-links">
                                            <li><a class="dropdown-item" href="#">Help</a></li>
                                            <li><a class="dropdown-item" href="#">Log out</a></li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="container justify-content-center" style="margin: auto;margin-bottom: 60px;margin-top: 120px;">
            <!-- bread crumbs -->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="#">Account</a></li>
               <li class="breadcrumb-item active" aria-current="page">Notifications</li>
            </ol>
            </nav>
            <!-- breadcrumbs end -->
            <div class="page-title">
               <h2>Notifications</h2>
            </div>
            <div class="page-inner">
               <div class="row align-items-start justify-content-between m-0">
                  <div class="form-wrapper col-md-6 p-0">
                     <ul class="nav nav-pills mb-1" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                           <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Offers and updates</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Account</button>
                        </li>
                     </ul>
                     <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                           <div class="tab-pane-inner">
                              <!-- each tab inner pane -->
                              <div class="each-inner-tab-pane">
                                 <div class="tab-title">
                                    <h4>Travel tips and offers</h4>
                                    <div>
                                       <span class="sub-text">Inspire your next trip with personalized recommendations and special offers.</span>
                                    </div>
                                 </div>
                                 <div class="tab-body">
                                    <div class="top mt-4">
                                       <span class="text">Inspiration and offers</span>
                                       <div><span class="sub-text">On: Email</span></div>
                                       <button type="button" data-bs-toggle="modal" data-bs-target="#inspiration" style="text-decoration: underline; color: #000; font-size: 1rem;">Edit</button>
                                    </div>
                                    <div class="top mt-4">
                                       <span class="text">Trip planning</span>
                                       <div><span class="sub-text">On: Email</span></div>
                                       <button type="button" data-bs-toggle="modal" data-bs-target="#trip-planning" style="text-decoration: underline; color: #000; font-size: 1rem;">Edit</button>
                                    </div>
                                 </div>
                              </div>
                              <!-- end of each inner tab pane -->

                              <!-- each tab inner pane -->
                              <div class="each-inner-tab-pane">
                                 <div class="tab-title">
                                    <h4>Airbnb updates</h4>
                                    <div>
                                       <span class="sub-text">Stay up to date on the latest news from Airbnb, and let us know how we can improve.</span>
                                    </div>
                                 </div>
                                 <div class="tab-body">
                                    <div class="top my-4">
                                       <span class="text">News and programs</span>
                                       <div><span class="sub-text">On: Email</span></div>
                                       <button type="button" data-bs-toggle="modal" data-bs-target="#news" style="text-decoration: underline; color: #000; font-size: 1rem;">Edit</button>
                                    </div>
                                    <div class="top my-4">
                                       <span class="text">Feedback</span>
                                       <div><span class="sub-text">On: Email</span></div>
                                       <button type="button" data-bs-toggle="modal" data-bs-target="#feedback" style="text-decoration: underline; color: #000; font-size: 1rem;">Edit</button>
                                    </div>
                                    <div class="top my-4">
                                       <span class="text">Travel regulations</span>
                                       <div><span class="sub-text">On: Email</span></div>
                                       <button type="button" data-bs-toggle="modal" data-bs-target="#travel-regulations" style="text-decoration: underline; color: #000; font-size: 1rem;">Edit</button>
                                    </div>
                                 </div>
                              </div>
                              <!-- end of each inner tab pane -->

                              <!-- each tab inner pane -->
                              <div class="each-inner-tab-pane" style="border-bottom: none;">
                                 <div class="tab-title">
                                    <!-- Button trigger modal -->
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                       <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                          <label class="form-check-label" for="flexCheckDefault">Unsubscribe from all marketing emails</label>
                                       </div>
                                    </button>
                                 </div>
                              </div>
                              <!-- end of each inner tab pane -->
                           </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                           <div class="tab-pane-inner">
                              <!-- each tab inner pane -->
                              <div class="each-inner-tab-pane">
                                 <div class="tab-title">
                                    <h4>Account activity and policies</h4>
                                    <div>
                                       <span class="sub-text">Confirm your booking and account activity, and learn about important Airbnb policies.</span>
                                    </div>
                                 </div>
                                 <div class="tab-body">
                                    <div class="top mt-3">
                                       <span class="text">Account activity</span>
                                       <div><span class="sub-text">On: Email and SMS</span></div>
                                       <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" style="text-decoration: underline; color: #000; font-size: 1rem;">Edit</button>
                                    </div>
                                    <div class="top mt-3">
                                       <span class="text">Guest policies</span>
                                       <div><span class="sub-text">On: Email and SMS</span></div>
                                       <button type="button" data-bs-toggle="modal" data-bs-target="#guest-policy" style="text-decoration: underline; color: #000; font-size: 1rem;">Edit</button>
                                    </div>
                                 </div>
                              </div>
                              <!-- end of each inner tab pane -->

                              <!-- each tab inner pane -->
                              <div class="each-inner-tab-pane">
                                 <div class="tab-title">
                                    <h4>Reminders</h4>
                                    <div>
                                       <span class="sub-text">Get important reminders about your reservations, listings, and account activity.</span>
                                    </div>
                                 </div>
                                 <div class="tab-body mt-3">
                                    <div class="top">
                                       <span class="text">Reminders</span>
                                       <div><span class="sub-text">On: Email and SMS</span></div>
                                       <button type="button" data-bs-toggle="modal" data-bs-target="#reminder" style="text-decoration: underline; color: #000; font-size: 1rem;">Edit</button>
                                    </div>
                                 </div>
                              </div>
                              <!-- end of each inner tab pane -->

                              <!-- each tab inner pane -->
                              <div class="each-inner-tab-pane" style="border-bottom: none;">
                                 <div class="tab-title">
                                    <h4>Guest and Host messages</h4>
                                    <div>
                                       <span class="sub-text">Keep in touch with your Host or guests before and during your trip.</span>
                                    </div>
                                 </div>
                                 <div class="tab-body mt-3">
                                    <div class="top">
                                       <span class="text">Messages</span>
                                      <div><span class="sub-text">On: Email and SMS</span></div>
                                       <button type="button" data-bs-toggle="modal" data-bs-target="#messages" style="text-decoration: underline; color: #000; font-size: 1rem;">Edit</button>
                                    </div>
                                 </div>
                              </div>
                              <!-- end of each inner tab pane -->
                           </div>
                        </div>
                     </div>
                  </div>

                   <!-- other div -->
                  <div class="content-wrapper col-md-4 d-none d-md-inline">
                     <div class="content-wrapper-inner">
                        <div class="each-content">
                           <div class="title">
                              <h5>Where would you like to get text messages?</h5>
                              <div>
                                 <span class="sub-text">By checking an SMS box, you agree to receive autodialed promotional texts from Airbnb and Airbnb's partners at:</span>
                              </div>
                              <div class="dropdown-select-form">
                                 <form action="">
                                    <select class="form-select" aria-label="Default select example">
                                       <option selected>Choose a phone number</option>
                                       <option value="1">One</option>
                                       <option value="2">Two</option>
                                       <option value="3">Three</option>
                                    </select>
                                 </form>
                              </div>
                           </div>
                           <div class="body"><span class="sub-text">For more info, text HELP to 247262. To cancel mobile notifications, reply STOP to 247262. Message and data rates may apply.</div>
                        </div>
                     </div>
                  </div>




                  <!-- ! START OF ALL MODALSSS -->

                  <!-- Unsubscribe modal -->
                  <div class="modal fade unsubscribe" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              <h5 class="modal-title" id="exampleModalLabel">Are your sure?</h5>
                           </div>
                           <div class="modal-body">
                              <span style="color: #7A7A7A;">You’ll be unsubscribing from all marketing emails from Airbnb. This includes recommendations, travel inspiration and deals, things to do in your home city, how Airbnb works, invites and referrals, surveys and research studies, airbnb for work updates, home hosting tips and promotions and experience hosting tips and promotions.</span>
                           </div>
                           <div class="modal-footer d-flex justify-content-between">
                              <button type="button" style="color: #000; text-decoration: underline; font-size: 15px; font-weight: 600" data-bs-dismiss="modal">Cancel</button>
                              <button type="button" style="padding: 13px 2rem; background-color: #222222; border-radius: 7px; color: #fff; font-size: 1rem; font-weight: 600;">Unsubscribe</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- unsubscribe end -->

                  <!-- MODAL 1 -->
                  <div class="modal fade no-border-modal" id="inspiration" tabindex="-1" aria-labelledby="inspiration" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <div class="title-modal">
                                 <h4>Inspiration and offers</h4>
                                 <small style="color: #929292">Inspiring stays, experiences, and deals.</small>
                              </div>
                              <div class="modal-body-inner">
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>Email</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    </div>
                                 </div>
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>SMS</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    </div>
                                 </div>
                                 <div class="each-switch mt-4">
                                    <h6>Browser notifications</h6>
                                    <div class="d-flex justify-content-between">
                                       <div class="small">Push notifications are off. To enable this feature, turn on notifications.</div>
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- MODAL 1 END -->

                  <!-- MODAL 2 -->
                  <div class="modal fade" id="trip-planning" tabindex="-1" aria-labelledby="trip-planning" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <div class="title-modal">
                                 <h4>Inspiration and offers</h4>
                                 <small style="color: #929292">Inspiring stays, experiences, and deals.</small>
                              </div>
                              <div class="modal-body-inner">
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>Email</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    </div>
                                 </div>
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>SMS</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    </div>
                                 </div>
                                 <div class="each-switch mt-4">
                                    <h6>Browser notifications</h6>
                                    <div class="d-flex justify-content-between">
                                       <div class="small">Push notifications are off. To enable this feature, turn on notifications.</div>
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- MODAL 2 END -->

                  <!-- MODAL 3 -->
                  <div class="modal fade" id="news" tabindex="-1" aria-labelledby="news" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <div class="title-modal">
                                 <h4>Inspiration and offers</h4>
                                 <small style="color: #929292">Inspiring stays, experiences, and deals.</small>
                              </div>
                              <div class="modal-body-inner">
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>Email</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    </div>
                                 </div>
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>SMS</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    </div>
                                 </div>
                                 <div class="each-switch mt-4">
                                    <h6>Browser notifications</h6>
                                    <div class="d-flex justify-content-between">
                                       <div class="small">Push notifications are off. To enable this feature, turn on notifications.</div>
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- MODAL 3 END -->

                  <!-- MODAL 4 -->
                  <div class="modal fade" id="account" tabindex="-1" aria-labelledby="account" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <div class="title-modal">
                                 <h4>Inspiration and offers</h4>
                                 <small style="color: #929292">Inspiring stays, experiences, and deals.</small>
                              </div>
                              <div class="modal-body-inner">
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>Email</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    </div>
                                 </div>
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>SMS</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    </div>
                                 </div>
                                 <div class="each-switch mt-4">
                                    <h6>Browser notifications</h6>
                                    <div class="d-flex justify-content-between">
                                       <div class="small">Push notifications are off. To enable this feature, turn on notifications.</div>
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- MODAL 4 END -->

                  <!-- MODAL 5 -->
                  <div class="modal fade" id="guest-policies" tabindex="-1" aria-labelledby="guest-policies" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <div class="title-modal">
                                 <h4>Inspiration and offers</h4>
                                 <small style="color: #929292">Inspiring stays, experiences, and deals.</small>
                              </div>
                              <div class="modal-body-inner">
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>Email</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    </div>
                                 </div>
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>SMS</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    </div>
                                 </div>
                                 <div class="each-switch mt-4">
                                    <h6>Browser notifications</h6>
                                    <div class="d-flex justify-content-between">
                                       <div class="small">Push notifications are off. To enable this feature, turn on notifications.</div>
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- MODAL 5 END -->
                  
                  <!-- MODAL 6 -->
                  <div class="modal fade" id="reminder" tabindex="-1" aria-labelledby="reminder" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <div class="title-modal">
                                 <h4>Inspiration and offers</h4>
                                 <small style="color: #929292">Inspiring stays, experiences, and deals.</small>
                              </div>
                              <div class="modal-body-inner">
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>Email</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    </div>
                                 </div>
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>SMS</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    </div>
                                 </div>
                                 <div class="each-switch mt-4">
                                    <h6>Browser notifications</h6>
                                    <div class="d-flex justify-content-between">
                                       <div class="small">Push notifications are off. To enable this feature, turn on notifications.</div>
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- MODAL 6 END -->
                  
                  <!-- MODAL 7 -->
                  <div class="modal fade" id="message" tabindex="-1" aria-labelledby="message" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <div class="title-modal">
                                 <h4>Inspiration and offers</h4>
                                 <small style="color: #929292">Inspiring stays, experiences, and deals.</small>
                              </div>
                              <div class="modal-body-inner">
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>Email</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    </div>
                                 </div>
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>SMS</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    </div>
                                 </div>
                                 <div class="each-switch mt-4">
                                    <h6>Browser notifications</h6>
                                    <div class="d-flex justify-content-between">
                                       <div class="small">Push notifications are off. To enable this feature, turn on notifications.</div>
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- MODAL 7 END -->

                  <!-- MODAL 8 -->
                  <div class="modal fade" id="travel-regulations" tabindex="-1" aria-labelledby="travel-regulations" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <div class="title-modal">
                                 <h4>Inspiration and offers</h4>
                                 <small style="color: #929292">Inspiring stays, experiences, and deals.</small>
                              </div>
                              <div class="modal-body-inner">
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>Email</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    </div>
                                 </div>
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>SMS</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    </div>
                                 </div>
                                 <div class="each-switch mt-4">
                                    <h6>Browser notifications</h6>
                                    <div class="d-flex justify-content-between">
                                       <div class="small">Push notifications are off. To enable this feature, turn on notifications.</div>
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- MODAL 8 END -->
                  <!-- MODAL 9 -->
                  <div class="modal fade" id="feedback" tabindex="-1" aria-labelledby="feedback" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <div class="title-modal">
                                 <h4>Inspiration and offers</h4>
                                 <small style="color: #929292">Inspiring stays, experiences, and deals.</small>
                              </div>
                              <div class="modal-body-inner">
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>Email</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    </div>
                                 </div>
                                 <div class="each-switch d-flex justify-content-between mt-4">
                                    <h6>SMS</h6>
                                    <div class="form-check form-switch">
                                       <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    </div>
                                 </div>
                                 <div class="each-switch mt-4">
                                    <h6>Browser notifications</h6>
                                    <div class="d-flex justify-content-between">
                                       <div class="small">Push notifications are off. To enable this feature, turn on notifications.</div>
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- MODAL 9 END -->

                  <!-- END OF ALL MODALS -->

                 
               </div>
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
        <footer class="pt-5 mb-0 mt-5 position-static d-none d-md-block" style="background-color: #F7F7F7;border-top: 1px solid #DDDDDD;">
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




        <!-- modalllllllsssssssss -->

        <!--delete account modal -->
         <div class="modal fade" id="del-acct" tabindex="-1" aria-labelledby="del-acct-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="del-acct-modal">Preferred Lanugage</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <form action="" method="">
                        <div class="form-input">
                           <select class="form-select" aria-label="Default select example">
                              <option selected>Open this select menu</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                           </select>
                        </div>
                        <div class="submit-btn">
                           <button>Save</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
        <!-- request data Modal -->
         <div class="modal fade" id="request-data" tabindex="-1" aria-labelledby="request-data-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                  <div class="modal-header">
                  <h4 class="modal-title" id="request-data-modal">Request your personal data</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <div class="sub-text"><span>Before we get you a copy of your data, we’ll just need you to answer a few questions.</span></div>
                     <form action="" method="">
                        <div class="form-input">
                           <label for="country" class="form-label"></label>
                           <select class="form-select" id="country" aria-label="Default select example">
                              <option selected>Country/Region</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                           </select>
                        </div>
                        <div class="form-input">
                           <label for="data-copy" class="form-label">Why are you requesting a copy of your data?</label>
                           <select class="form-select" id="data-copy" aria-label="Default select example">
                              <option selected>Select reason (optional)</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                           </select>
                        </div>
                        <div class="submit-btn">
                           <button>Request data</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>


    </div>
		<script src="../../assets/js/bootstrap.min.js"></script>
		<script src="../../assets/js/bootstrap.bundle.min.js"></script>
		<script src="../../assets/js/jquery-3.6.1.min.js"></script>
		<script src="../../assets/js/custom.js"></script>
	</body>
</html>
