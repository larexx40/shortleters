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
      <link rel="stylesheet" href="../admin/assets/css/toasteur-default.min.css">
    <title>Reset Password</title>
</head>

<body>
    
    <div id="auth" v-cloak>
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

                        </div>

                    </div>
                </div>
            </div>
            <!-- <======= SEARCH BAR MODAL ENDS ========> -->


            <main class="container justify-content-center row " style="margin: auto;margin-bottom: 70px;">
                <!-- change password screen -->
                <div v-if='token' class="card col-md-7 p-0" style="max-width: 500px;margin-top:120px;">
                    <b class="text-center pt-3"> Change your password</b>
                    <hr>
                    <form @submit.prevent='resetUserPassword()' class="p-3 pt-3">
                        <h3 class="mb-3"><b>Enter new password</b></h3>
                        
                        <div class="form-floating mb-3">
                            <input type="password" v-model='password' class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" v-model='password1' class="form-control"  placeholder="Password">
                            <label for="floatingPassword">Verify Password</label>
                        </div>
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block p-2 mb-2" style="width: calc(100% - 30px);">Continue</button>

                    </form>
                </div>

                <!-- OTP Screen -->
                <div v-if='!token' class="card col-md-7 p-0" style="max-width: 500px;margin-top:120px;">
                    <b class="text-center pt-3"> Verify OTP </b>
                    <hr>
                    <form @submit.prevent='loginUser()' class="p-3 pt-3">
                        <h3 class="mb-3"><b>Enter OTP sent to your email or phone</b></h3>
                        
                        <div class="form-floating mb-3">
                            <input type="password" v-model='password' class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">6 digit OTP</label>
                        </div>
                        
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block p-2 mb-2" style="width: calc(100% - 30px);">Continue</button>

                    </form>
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

            <!-- Forgot password modal -->
            <div class="modal fade" id="forgotPassword" tabindex="-1" aria-labelledby="password-modal" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                     <div class="modal-header">
                     <h5 class="modal-title" id="password-modal">Password Reset</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body" >
                        <form action="" @submit.prevent='changePassword()' method="">
                            <span>To reset your password, enter the email address you registered with.</span><br>
                           <div>
                              <input type="email" v-model= 'password' class="form-control" placeholder="Enter email address">
                           </div>

                           <div style="display:flex; justify-content:center;border:none;padding:20px 0px" >
                                <div class="submit-btn">
                                    <button class="btn" style="background-color: #000; color: #fff; padding: 14px 1.8rem">Send Reset Link</button>
                                </div>                         
                            </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>

             <!-- Reset password modal -->
             <div class="modal fade" id="resetPassword" tabindex="-1" aria-labelledby="password-modal" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                     <div class="modal-header">
                     <h5 class="modal-title" id="password-modal">Password Reset</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body" >
                        <form action="" @submit.prevent='changePassword()' method="">
                            <span>To reset your password, enter the email address you registered with.</span><br>
                           <div>
                              <input type="email" v-model= 'password' class="form-control" id="prev-password" placeholder="Enter email address">
                           </div>

                           <div style="display:flex; justify-content:center;border:none;padding:20px 0px" >
                                <div class="submit-btn">
                                    <button class="btn" style="background-color: #000; color: #fff; padding: 14px 1.8rem">Send Reset Link</button>
                                </div>                         
                            </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>

            <!-- waleotpModal -->
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



        </div>
    </div>

    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <script src="../assets/js/custom.js"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./js/toasteur.min.js"></script>
    <script src="../vuecode/auth.js" ></script>
</body>

</html>