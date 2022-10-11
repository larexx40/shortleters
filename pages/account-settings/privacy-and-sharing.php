<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Privacy and Sharing</title>
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
         .content-wrapper-inner .each-content a{
            text-decoration: underline;
            color: #000;
         }
         .content-wrapper-inner .each-content h5{
            font-size: 1.2rem;
            font-weight: 600;
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
            row-gap: 3rem;
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
         :is(.modal#request-data, .modal#del-acct) .form-select{
            font-size: 15px;
            min-height: 3.1rem;
         }
         :is(.modal#request-data, .modal#del-acct) .form-select:focus{
            border: 2px solid #000;
            box-shadow: none;
         }
         .modal#del-acct .list-of-reasons{
            list-style-type: disc  !important;
         }
         .modal#del-acct .list-of-reasons li{
            position: relative ;
            display: block;
            margin: 10px 0;
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
               <li class="breadcrumb-item active" aria-current="page">Privacy & sharing</li>
            </ol>
            </nav>
            <!-- breadcrumbs end -->
            <div class="page-title">
               <h2>Privacy and sharing</h2>
            </div>
            <div class="page-inner">
               <div class="row align-items-start justify-content-between m-0">
                  <div class="form-wrapper col-md-6 p-0">
                     <ul class="nav nav-pills mb-1" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                           <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Sharing</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Services</button>
                        </li>
                     </ul>
                     <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                           <div class="tab-pane-inner one">
                              <div class="tab-title">
                                 <h4>Manage your account data</h4>
                                 <div>
                                    <span class="sub-text">You can make a request to download or delete your personal data from Airbnb.</span>
                                 </div>
                              </div>
                              <div class="tab-body">
                                 <div class="options">
                                    <div class="top">
                                       <button type="button" data-bs-toggle="modal" data-bs-target="#request-data">
                                          <span class="text">Request your personal data</span>
                                          <span><em class="bi bi-chevron-right"></em></span>
                                       </button>
                                    </div>
                                    <div class="bottom"><span class="sub-text">We’ll create a file for you to download your personal data.</span></div>
                                 </div>
                                 <div class="options">
                                    <div class="top">
                                       <button type="button" data-bs-toggle="modal" data-bs-target="#del-acct">
                                          <span class="text">Delete your account data</span>
                                          <span><em class="bi bi-chevron-right"></em></span>
                                       </button>
                                    </div>
                                    <div class="bottom"><span class="sub-text">This will permanently delete your account and your data, in accordance with applicable law.</span></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                           <div class="tab-pane-inner">
                              <div class="each-inner-tab-pane">
                                 <div class="tab-title">
                                    <h4>Manage your account data</h4>
                                    <div>
                                       <span class="sub-text">You can make a request to download or delete your personal data from Airbnb.</span>
                                    </div>
                                 </div>
                                 <div class="tab-body">
                                    <div class="top">
                                       <span class="text">Include my profile and listing in search engines</span>
                                       <div><span class="sub-text">Turning this on means search engines, like Google, will display your profile and listing pages in search results.</span></div>
                                    </div>
                                    <div class="bottom">
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- each tab inner pane -->
                              <div class="each-inner-tab-pane">
                                 <div class="tab-title">
                                    <h4>Data sharing</h4>
                                    <div>
                                       <span class="sub-text">You can make a request to download or delete your personal data from Airbnb.</span>
                                    </div>
                                 </div>
                                 <div class="tab-body">
                                    <div class="top">
                                       <span class="text">Use my first name and profile photo to help fight discrimination</span>
                                       <div>
                                          <span class="sub-text">Leaving this on means that you’re helping us further studies to help identify and prevent discrimination from happening on Airbnb <a href="" style="color: #000; text-decoration: underline; font-size: 1rem;">Learn more</a></span>
                                       </div>
                                    </div>
                                    <div class="bottom">
                                       <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- end of each inner tab pane -->
                           </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                           <div class="tab-pane-inner">
                              <div class="tab-title">
                                 <h4>Connected services</h4>
                                 <div><span class="sub-text">View services that you’ve connected to your Airbnb account</span></div>
                              </div>
                              <div class="tab-body  mt-4">
                                 <span>No services connected at the moment</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="content-wrapper col-md-4 d-none d-md-inline">
                     <div class="content-wrapper-inner">
                       <div class="each-content">
                        <div class="title"><h5>Committed to privacy</h5></div>
                        <div class="body"><span>Airbnb is committed to keeping your data protected. See details in our <a href="">Privacy Policy</a></span></div>
                       </div>
                     </div>
                  </div>
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
                  <h5 class="modal-title" id="del-acct-modal">Delete your account</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <span class="my-2">Submit a request to delete your personal data. To confirm you're the true owner of this account, we may contact you at yahos25916@dineroa.com. We will only be able to proceed with your request once you follow the steps set out in the email.</span>
                     <div class="about-deletion my-4">
                        <strong>About account deletion requests:</strong>
                        <ul class="list-of-reasons">
                           <li>If you have a checkout (as a guest or a host) within the past 60 days, your deletion request can’t be processed until the 60-day claim period has elapsed.</li>
                           <li>Once your request is processed, your personal data will be deleted (except for certain information that we are legally required or permitted to retain, as outlined in our <a href="" style="text-decoration: underline; color: #000; font-size: 16px;">Privacy Policy</a> ).</li>
                           <li>If you want to use Airbnb in the future, you’ll need to set up a new account.</li>
                           <li>If you have any future reservations as a host or guest, they must first be cancelled in accordance with the applicable host cancellation policy before submitting your deletion request. Cancellation fees may apply. More information about cancellations can be found on our <a href="" style="text-decoration: underline; color: #000; font-size: 16px;">Help Center</a>.</li>
                        </ul>
                     </div>
                     <form action="" method="">
                        <div class="form-input">
                           <label for="country" style="font-weight: 900;" class="form-label">Where do you reside?</label>
                           <select class="form-select" id="country" aria-label="Default select example">
                              <option selected>Country/Region</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                           </select>
                        </div>
                        <div class="form-input">
                           <label for="" style="font-weight: 900;" class="form-label">Why are you deleting your account?</label>
                           <select class="form-select" aria-label="Default select example">
                              <option selected>Open this select menu</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                           </select>
                        </div>
                        <div class="submit-btn mt-4">
                           <button  style="background-color: #000; font-size: 1rem; color: #fff; padding: 13px 2rem; border-radius: 5px;">Save</button>
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
                        <div class="form-input mt-5">
                           <label for="data-copy" class="form-label"style="font-size: 15px">Why are you requesting a copy of your data?</label>
                           <select class="form-select" id="data-copy" aria-label="Default select example">
                              <option selected>Select reason (optional)</option>
                              <option value="1">I want to know what Airbnb knows about me</option>
                              <option value="1">I want to file a support ticket</option>
                              <option value="1">I want to move my data to another service</option>
                              <option value="1">I plan to delete or deactivate my account soon</option>
                              <option value="2">I need to access specific data for legal reasons</option>
                              <option value="3">Other</option>
                           </select>
                        </div>
                        <div class="submit-btn mt-4">
                           <button  style="background-color: #000; font-size: 1rem; color: #fff; padding: 13px 2rem; border-radius: 5px;">Request data</button>
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
