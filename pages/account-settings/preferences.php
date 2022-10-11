<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Preferences</title>
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
         }
         .content-wrapper-inner{
            margin: 0px;
            background-color: rgb(255, 255, 255);
            display: flex;
            align-items: flex-start;
            row-gap: 2em;
            flex-direction: column;
         }
         .each-content{
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            -ms-flex-direction: column;
            row-gap: 1.5rem;
         }
         .each-form-content{
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            -ms-flex-direction: column;
            row-gap: .7rem;
            width: 100%;
            border-bottom:1px solid #EBEBEB;
            padding-bottom: 1.3rem;
            margin-top: .8rem;
         }.each-form-content strong{
            font-size: 1.1rem;
         }
         .each-form-content.translator{
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
            display: flex;
         }
         .each-form-content.translator .title-button{
            all: unset;
            align-items: flex-start;
            flex-direction: column;
            display: flex;
         }
         .each-form-content .title-button {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
         }
         .each-form-content .title-button button{
            font-size: 1rem;
            color: #008489;
            font-weight: 600;
         }
         .each-form-content .title-button button:hover{
            text-decoration: underline;
         }
         .each-form-content:nth-child(2) button{
            text-decoration: underline;
         }
         :is(.breadcrumb-item, .breadcrumb-item a){
            color: #484871;
         }
         .breadcrumb-item a{
            font-weight: 600;
            color: #000;
            font-size: 1rem;
         }
         .breadcrumb-item a:hover{
            text-decoration: underline;
         }
         /* modal form */
         .modal-body form{
            margin-top: 3rem;
         }
         .modal-body .form-select{
            min-height: 3rem;
            border-radius: 6px;
            font-size: 15px;
         }
         .modal-body .form-select:focus{
            box-shadow: none;
            border: 2px solid #008489;
         }
         .modal-body form .submit-btn{
            padding-top: 2rem;
         }
         .modal-body form button{
            background: rgba(0, 132, 137, 0.3);
            border-color: transparent;
            color: rgb(255, 255, 255);
            display: inline-block;
            padding: 10px 22px;
            min-width: 71.1935px;
            border-style: solid;
            border-color: transparent;
            border-radius: 4px;
            display: flex;
            align-items: center;
            font-weight: 600;
            justify-content: center;
         }
         .modal-body form button:hover{
            background:#008489;
            color: #fff;
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
               <li class="breadcrumb-item active" aria-current="page">Global preferences</li>
            </ol>
            </nav>
            <!-- breadcrumbs end -->
            <div class="page-title">
               <h2>Global preferences</h2>
            </div>
            <div class="page-inner">
               <div class="row align-items-start justify-content-between m-0">
                  <div class="form-wrapper col-md-6 p-0">
                     <div class="each-form-content">
                        <div class="title-button">
                           <strong>Preferred language</strong>
                           <button type="button" class="" data-bs-toggle="modal" data-bs-target="#language">Edit</button>
                        </div>
                        <div class="value"><span>English</span></div>
                     </div>
                     <div class="each-form-content translator d-md-none">
                        <div class="title-button">
                           <strong>Preferred language</strong>
                           <span>Automatically translate other languages to English.</span>
                        </div>
                        <div class="form-check form-switch">
                           <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        </div>
                     </div>
                     <div class="each-form-content">
                        <div class="title-button">
                           <strong>Preferred currency</strong>
                           <button type="button" class="" data-bs-toggle="modal" data-bs-target="#currency">Edit</button>
                        </div>
                        <div class="value"><span>United States dollar</span></div>
                     </div>
                     <div class="each-form-content">
                        <div class="title-button">
                           <strong>Time zone</strong>
                           <button type="button" class="" disabled data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                        </div>
                     </div>
                  </div>
                  <div class="content-wrapper col-md-5">
                     <div class="content-wrapper-inner">
                       <div class="each-content">
                         <div class="icon-wrapper">
                           <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true" focusable="false" style="height: 40px; width: 40px; display: block; fill: rgb(255, 180, 0);"><path d="m21.31 5.91a1.31 1.31 0 1 1 -1.31-1.31 1.31 1.31 0 0 1 1.31 1.31zm-8.31 9.69a1.31 1.31 0 1 0 1.31 1.31 1.31 1.31 0 0 0 -1.31-1.31zm-7-11a1.31 1.31 0 1 0 1.31 1.31 1.31 1.31 0 0 0 -1.31-1.31z"></path><path d="m22 6.5a2.5 2.5 0 0 1 -2 2.45v13.55a.5.5 0 0 1 -1 0v-13.55a2.5 2.5 0 0 1 0-4.9v-2.55a.5.5 0 0 1 1 0v2.56a2.44 2.44 0 0 1 .33.09.5.5 0 0 1 -.33.94h-.01a1.45 1.45 0 0 0 -.99.01 1.49 1.49 0 0 0 0 2.82 1.4 1.4 0 0 0 1 0 1.5 1.5 0 0 0 1-1.41 1.48 1.48 0 0 0 -.09-.52.5.5 0 0 1 .94-.35 2.5 2.5 0 0 1 .16.87zm-7.8 9.83a.5.5 0 0 0 -.29.64 1.48 1.48 0 0 1 .09.52 1.5 1.5 0 0 1 -1 1.41 1.4 1.4 0 0 1 -1 0 1.49 1.49 0 0 1 0-2.82 1.48 1.48 0 0 1 .5-.09 1.52 1.52 0 0 1 .5.08h.01a.5.5 0 0 0 .32-.94 2.46 2.46 0 0 0 -.32-.08v-13.56a.5.5 0 0 0 -1 0v13.55a2.5 2.5 0 0 0 0 4.9v2.55a.5.5 0 0 0 1 0v-2.55a2.5 2.5 0 0 0 1.84-3.32.5.5 0 0 0 -.64-.29zm-7-11a .5.5 0 0 0 -.29.64 1.48 1.48 0 1 1 -1.41-.98 1.47 1.47 0 0 1 .49.08h.01a.5.5 0 0 0 .33-.94 2.44 2.44 0 0 0 -.33-.09v-2.56a.5.5 0 0 0 -1 0v2.55a2.5 2.5 0 0 0 0 4.9v13.55a.5.5 0 0 0 1 0v-13.55a2.5 2.5 0 0 0 1.84-3.32.5.5 0 0 0 -.64-.29z" fill="#484848"></path></svg>
                        </div>
                        <div class="title"><strong>Your global preferences</strong></div>
                        <div class="body"><span>Changing your currency updates how you see prices. You can change how you get payments in your payments & payouts preferences.</span></div>
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

        <!--Language Modal -->
         <div class="modal fade" id="language" tabindex="-1" aria-labelledby="lang-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="lang-modal">Preferred Lanugage</h5>
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
        <!-- Currency Modal -->
         <div class="modal fade" id="currency" tabindex="-1" aria-labelledby="currency-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="currency-modal">Preference currency</h5>
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

         <!-- timezone Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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

    </div>
		<script src="../../assets/js/bootstrap.min.js"></script>
		<script src="../../assets/js/bootstrap.bundle.min.js"></script>
		<script src="../../assets/js/jquery-3.6.1.min.js"></script>
		<script src="../../assets/js/custom.js"></script>
	</body>
</html>
