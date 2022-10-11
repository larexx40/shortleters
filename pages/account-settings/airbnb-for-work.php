<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Travel for work</title>
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
         @media all and (max-width: 600px){
            .page-title {
               display: none;
            }
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
         .page-inner form .form-control{
            font-size: 16px;
            line-height:24px;
            color:  #484848;
            padding: 11px;
            font-weight: normal;
            background-color: transparent;
         }
         .page-inner form .form-control:focus{
            box-shadow: none;
            border-color: #008489;
         }
         .page-inner form .submit-btn{
            padding-top: 6px;
         }
         .page-inner form button{
            background: rgba(0, 132, 137, 0.3);
            border-color: transparent;
            color: rgb(255, 255, 255);
            display: inline-block;
            padding: 10px 22px;
            min-width: 71.1935px;
            border-style: solid;
            border-color: transparent;
            border-radius: 4px;
            font-weight: 600;
         }
         .page-inner form button:hover{
            background:#008489;
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
            row-gap: 1.7em;
            flex-direction: column;
         }
         .each-content{
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            -ms-flex-direction: column;
            row-gap: .7rem;
         }.each-content strong{
            font-size: 1.1rem;
         }
         :is(.breadcrumb-item, .breadcrumb-item a){
            color: #484871;
         }
         .breadcrumb-item a:hover{
            text-decoration: underline;
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
               <li class="breadcrumb-item active" aria-current="page">Travel for work</li>
            </ol>
            </nav>
            <!-- breadcrumbs end -->
            <div class="page-title">
               <h2>Travel for work</h2>
            </div>
            <div class="page-inner">
               <div class="row align-items-start justify-content-between m-0">
                  <div class="form-wrapper col-md-6 p-0">
                     <div class="form-wrapper-title"><h4>Join Airbnb for Work</h4></div>
                     <div class="sub-title"><span>Add your work email to get seamless expensing and exclusive offers on work trips</span></div>
                     <form action="">
                        <div class="form-input">
                             <label for="exampleFormControlInput1" class="form-label">Work email address</label>
                              <input type="email" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="submit-btn"><button>Add work email</button></div>
                     </form>
                  </div>
                  <div class="content-wrapper col-md-5">
                     <div class="content-wrapper-inner">
                        <div class="each-content">
                        <div class="icon-wrapper">
                           <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true" focusable="false" style="height: 32px; width: 32px; display: block; fill: rgb(255, 90, 95);"><path d="M5,15.79289V6.5A.5.5,0,0,1,5.5,6h9.29289a.5.5,0,0,1,.35356.85355l-9.2929,9.2929A.5.5,0,0,1,5,15.79289Z"></path><path fill="#484848" d="M17.5,0H5.5A2.64711,2.64711,0,0,0,3,2.5v19A2.64716,2.64716,0,0,0,5.5,24H9a.5.5,0,0,0,0-1H5.5A1.65724,1.65724,0,0,1,4,21.5V21H7.5a.5.5,0,0,0,0-1H4V5H19v6.5a.5.5,0,0,0,1,0v-9A2.569,2.569,0,0,0,17.5,0ZM4,4V2.5A1.65719,1.65719,0,0,1,5.5,1h12A1.57151,1.57151,0,0,1,19,2.5V4Zm8-1.5a.5.5,0,1,1-.5-.5A.5.5,0,0,1,12,2.5Zm6.5,11a1.63453,1.63453,0,0,0-.80481.22974A1.64484,1.64484,0,0,0,16.25,13a1.67877,1.67877,0,0,0-1.25.50494A1.67877,1.67877,0,0,0,13.75,13a1.88315,1.88315,0,0,0-.75.1601V9.5A1.43545,1.43545,0,0,0,11.5,8,1.43545,1.43545,0,0,0,10,9.5v5.29285l-.14642-.14643c-1.09345-1.09344-2.42365-1.28344-3.20716-.5a.5.5,0,0,0-.09362.57715A59.00214,59.00214,0,0,0,9.584,20.27734C10.98157,22.72552,12.80225,24,15,24c3.18756,0,5-2.1145,5-5.5V15A1.40476,1.40476,0,0,0,18.5,13.5Zm.5,5c0,2.8645-1.40186,4.5-4,4.5-1.80225,0-3.31494-1.0589-4.56586-3.24811a54.88427,54.88427,0,0,1-2.78039-5.06378,1.73479,1.73479,0,0,1,1.49267.66541l1,1A.5.5,0,0,0,11,16h0V9.5a.5.5,0,0,1,1,0v5h.0094a.49287.49287,0,0,0,.36932.485.5.5,0,0,0,.60633-.36377A.69127.69127,0,0,1,13.75,14a.69127.69127,0,0,1,.765.62128.46769.46769,0,0,0,.02924.0614.4927.4927,0,0,0,.04492.09442.90137.90137,0,0,0,.13391.13385.489.489,0,0,0,.094.04474.46454.46454,0,0,0,.0617.02936c.00739.00183.01453-.00055.02191.001a1.08028,1.08028,0,0,0,.19874,0c.00738-.00152.01452.00086.02191-.001a.46272.46272,0,0,0,.06158-.0293.48739.48739,0,0,0,.09424-.04486.90526.90526,0,0,0,.13379-.13379.4927.4927,0,0,0,.04492-.09442.46769.46769,0,0,0,.02924-.0614.78156.78156,0,0,1,1.5299,0c.00287.01147.01105.01965.01465.03076a.70055.70055,0,0,0,.0979.173c.00769.00885.0105.02008.01892.02851a.469.469,0,0,0,.04883.03241.48729.48729,0,0,0,.08472.05627.60333.60333,0,0,0,.181.05017.48562.48562,0,0,0,.10223-.00464.47553.47553,0,0,0,.05811-.00268c.01147-.00287.01965-.011.03076-.01465a.48393.48393,0,0,0,.09021-.04291.49086.49086,0,0,0,.08282-.05505c.00885-.00769.02008-.0105.02851-.01892A.97361.97361,0,0,1,18.5,14.5c.36829,0,.5.158.5.5Zm-1-2v2a.5.5,0,0,1-1,0v-2a.5.5,0,0,1,1,0Z"></path></svg>
                        </div>
                        <div class="title">
                           <strong>Simplified expensing</strong>
                        </div>
                        <div class="body"><span>We’ll send work trip receipts to your work inbox for easy expensing.</span></div>
                     </div>
                        <div class="each-content">
                           <div class="icon-wrapper">
                              <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true" focusable="false" style="height: 32px; width: 32px; display: block; fill: rgb(255, 90, 95);"><path d="m17.3 6.54v3.32a.43.43 0 0 1 -.43.43h-1.71a.43.43 0 0 1 -.43-.43v-3.32a.21.21 0 0 1 .09-.17l1.07-.77a.21.21 0 0 1 .25 0l1.07.77a.21.21 0 0 1 .09.17zm-2.8 12.46h-2a .5.5 0 0 0 0 1h2a .5.5 0 0 0 0-1zm-4 0h-.5v-.5a.5.5 0 0 0 -1 0v .5h-.5a.5.5 0 0 0 0 1h .5v.5a.5.5 0 0 0 1 0v-.5h.5a.5.5 0 0 0 0-1zm-.16-15.96a1.18 1.18 0 1 0 1.18 1.18 1.18 1.18 0 0 0 -1.18-1.18z"></path><path d="m8.5 17a .5.5 0 1 1 .5-.5.5.5 0 0 1 -.5.5zm.5-2.5a.5.5 0 1 0 -.5.5.5.5 0 0 0 .5-.5zm1.5.5h4a .5.5 0 0 0 0-1h-4a .5.5 0 0 0 0 1zm0 2h4a .5.5 0 0 0 0-1h-4a .5.5 0 0 0 0 1zm8.5-11v5.5a.5.5 0 0 1 -.5.5h-.5v11.5a.5.5 0 0 1 -.85.35l-1.65-1.65-1.65 1.65a.5.5 0 0 1 -.71 0l-1.65-1.65-1.65 1.65a.5.5 0 0 1 -.71 0l-1.65-1.65-1.65 1.65a.5.5 0 0 1 -.85-.35v-12.5a.5.5 0 0 1 1 0v11.29l1.15-1.15a.5.5 0 0 1 .71 0l1.65 1.65 1.65-1.65a.5.5 0 0 1 .71 0l1.65 1.65 1.65-1.65a.5.5 0 0 1 .71 0l1.15 1.15v-10.29h-3.5a.5.5 0 0 1 -.5-.5v-2.5h-7.5a.5.5 0 0 1 0-1h7.5v-2a .5.5 0 0 1 .19-.39l2.5-2a .5.5 0 0 1 .62 0l2.5 2a .5.5 0 0 1 .19.39zm-1 .24-2-1.6-2 1.6v4.76h4zm-8.72.61a2.22 2.22 0 0 0 2.62-2.98.5.5 0 0 0 -.93.38 1.21 1.21 0 1 1 -.8-.71.5.5 0 0 0 .26-.97 2.21 2.21 0 1 0 -1.15 4.28zm3.22-4.85h.5v.5a.5.5 0 0 0 1 0v-.5h.5a.5.5 0 0 0 0-1h-.5v-.5a.5.5 0 0 0 -1 0v .5h-.5a.5.5 0 0 0 0 1z" fill="#484848"></path></svg>
                           </div>
                           <div class="title">
                              <strong>Trips descriptions</strong>
                           </div>
                           <div class="body"><span>Add an expense code and business purpose to work trips.</span></div>
                        </div>
                        <div class="each-content">
                           <div class="icon-wrapper">
                              <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true" focusable="false" style="height: 32px; width: 32px; display: block; fill: rgb(255, 90, 95);"><path d="m13.0429 20.4868c-.252.108-.56-.037-.56-.318l-.079-16.225c0-.327.404-.491.639-.26 1.491 1.462 4.438 2.852 6.897 3.197.161.022.288.143.316.299 1.089 6.046-2.202 11.152-7.213 13.307"></path><path d="m13.998 11.0102h-4v-2c0-1.104.896-2 2-2s2 .896 2 2zm1.5 0h-.5v-2c0-1.657-1.343-3-3-3s-3 1.343-3 3v2h-.5c-.276 0-.5.224-.5.5v5c0 .276.224.5.5.5h7c.276 0 .5-.224.5-.5v-5c0-.276-.224-.5-.5-.5z" fill="#fff"></path><path d="m12.998 10.0102h-2v-1c0-.552.448-1 1-1s1 .448 1 1zm-1-3c-1.104 0-2 .896-2 2v2h4v-2c0-1.104-.896-2-2-2zm1 6c0 .37-.201.693-.5.866v1.134c0 .276-.224.5-.5.5s-.5-.224-.5-.5v-1.134c-.299-.173-.5-.496-.5-.866 0-.552.448-1 1-1s1 .448 1 1zm3 3.5c0 .276-.224.5-.5.5h-7c-.276 0-.5-.224-.5-.5v-5c0-.276.224-.5.5-.5h.5v-2c0-1.657 1.343-3 3-3s3 1.343 3 3v2h.5c.276 0 .5.224.5.5zm0-6.415v-1.085c0-2.209-1.791-4-4-4s-4 1.791-4 4v1.085c-.583.206-1 .762-1 1.415v5c0 .828.671 1.5 1.5 1.5h7c.828 0 1.5-.672 1.5-1.5v-5c0-.653-.417-1.209-1-1.415zm-3.627 11.861c-7.206-3.07-10.097-8.274-8.751-15.741 3.612-.536 6.535-2.014 8.751-4.432 2.215 2.418 5.138 3.896 8.75 4.432 1.346 7.467-1.545 12.671-8.75 15.741zm9.684-16.294c-.042-.216-.218-.38-.436-.408-3.754-.484-6.698-2.007-8.858-4.573-.204-.242-.577-.242-.781 0-2.16 2.566-5.104 4.089-8.858 4.573-.218.028-.394.192-.436.408-1.612 8.206 1.58 14.027 9.488 17.319.126.052.267.052.392 0 7.91-3.292 11.101-9.113 9.489-17.319z" fill="#484848"></path></svg>
                           </div>
                           <div class="title">
                              <strong>Keep personal trips private</strong>
                           </div>
                           <div class="body">
                              <span>Your company can onyl get info about trips you mark for work at checkout</span>
                           </div>
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



    </div>
		<script src="../../assets/js/bootstrap.min.js"></script>
		<script src="../../assets/js/bootstrap.bundle.min.js"></script>
		<script src="../../assets/js/jquery-3.6.1.min.js"></script>
		<script src="../../assets/js/custom.js"></script>
	</body>
</html>
