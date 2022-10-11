<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/fonts/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <title>Wishlists</title>
</head>

<body>

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
                    <div class="p-0 col-md-7 col-lg-3 ">

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
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <style>
            ._1j8963g {
                font-size: 32px;
                line-height: 36px;
                color: rgb(0, 0, 0);
                font-weight: 600;
                margin-top: 42px;
                margin-bottom: 32px;
            }
            
            .mapouter {
                position: relative;
                text-align: right;
                height: 100vh;
                width: 100%;
            }
            
            .gmap_canvas {
                overflow: hidden;
                background: none!important;
                height: 100vh;
                width: 100%;
            }
            
            .card-item .card-image .icon-love {
                position: absolute;
                right: 6%;
                top: 5%;
                z-index: 1;
            }
            
            .card-item .card-image {
                border-radius: 9px;
                overflow: hidden;
                position: relative;
            }
            
            ._15pf4i2 {
                cursor: pointer !important;
                text-align: center !important;
                border: 1px solid rgb(221, 221, 221) !important;
                background-color: rgb(255, 255, 255) !important;
                outline: none !important;
                margin: 0px !important;
                color: rgb(34, 34, 34) !important;
                font-family: Circular, -apple-system, BlinkMacSystemFont, Roboto, "Helvetica Neue", sans-serif !important;
                position: relative !important;
                transition-property: -ms-transform, -webkit-transform, transform, background-color, border-color !important;
                transition-duration: 0.15s !important;
                transition-timing-function: ease-in-out !important;
                padding: 4px 20px !important;
                min-height: 30px !important;
                border-radius: 16px !important;
                font-size: 14px !important;
                line-height: 18px !important;
                width: 40px;
            }
            
            ._1qi0sj8::before {
                content: "" !important;
                display: block !important;
                position: absolute !important;
                top: 50% !important;
                left: 50% !important;
                transform: translate(-50%, -50%) !important;
                width: 48px !important;
                height: 48px !important;
                border-radius: 50% !important;
            }
            
            ._oda838::before {
                content: "" !important;
                display: block !important;
                position: absolute !important;
                top: 50% !important;
                left: 50% !important;
                transform: translate(-50%, -50%) !important;
                width: 32px !important;
                height: 32px !important;
                border-radius: 50% !important;
            }
            
            ._12kfhdn {
                padding: 24px !important;
                flex: 1 1 auto !important;
                overflow-y: auto !important;
                outline: none !important;
            }
            
            ._1gglzn7 {
                margin-bottom: 24px !important;
            }
            
            ._o7xaku5 {
                cursor: pointer !important;
                position: relative !important;
                touch-action: manipulation !important;
                font-family: inherit !important;
                font-size: inherit !important;
                line-height: inherit !important;
                font-weight: inherit !important;
                border-radius: 16px !important;
                outline: none !important;
                transition: box-shadow 0.2s ease 0s, -ms-transform 0.1s ease 0s, -webkit-transform 0.1s ease 0s, transform 0.1s ease 0s !important;
                -webkit-tap-highlight-color: transparent !important;
                background: transparent !important;
                border: 1px solid #c4c4c4 !important;
                color: inherit !important;
                display: block !important;
                margin: 0px !important;
                padding: 20px 7px !important;
                text-align: inherit !important;
                text-decoration: none !important;
                height: 100% !important;
                width: 100% !important;
            }
            
            .card {
                cursor: pointer;
            }
            
            ._sggpze {
                padding: 1px 15px;
            }
        </style>
        <main class="row m-0" style="margin-top: 90px;">
            <div class="col-md-6">
                <div class="col-12" style="padding-top:100px;">
                    <div class="_1i3m7nv">
                        <div class="_zrkoxc d-flex justify-content-between align-items-center">
                            <button aria-label="Back" type="button" class="_1qi0sj8">
                                <span class="_e296pg">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 4; overflow: visible;">
                                        <g fill="none"><path d="m4 16h26"></path><path d="m15 28-11.29289322-11.2928932c-.39052429-.3905243-.39052429-1.0236893 0-1.4142136l11.29289322-11.2928932"></path></g>
                                    </svg>
                                </span>
                            </button>
                            <div class="_h9dw5i">
                                <button aria-label="Share" type="button" data-bs-toggle="modal" href="#exampleModalToggle" role="button" class="_oda838">
                                    <span class="_e296pg">
                                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 4; overflow: visible;"><g fill="none"><path d="M27 18v9a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-9"></path><path d="M16 3v23V3z"></path><path d="M6 13l9.293-9.293a1 1 0 0 1 1.414 0L26 13"></path></g></svg>
                                    </span>
                                </button>


                                <button aria-label="Settings" data-testid="list-details-marquee__button-to-open-settings" type="button" class="_1qi0sj8">
                                    <span class="_e296pg"><svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 18px; width: 18px; fill: currentcolor;"><path d="M3 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm5 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm5 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"></path></svg></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel">How Do you want to share ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="_12kfhdn">
                                        <div class="_1qfon39">
                                            <div class="_1gglzn7" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">
                                                <button type="button" class="_o7xaku5">
                                                    <div class="_sggpze d-flex align-items-center gap-3">
                                                        <div class="_1eaes69">
                                                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="M21.768 5.354l9.293 9.292.116.128a2 2 0 0 1 0 2.574l-.116.127-9.293 9.293-1.414-1.414 9.292-9.293-9.292-9.293zm-11.536 0l1.414 1.414-9.292 9.293 9.292 9.293-1.414 1.414L.94 17.475a2 2 0 0 1-.116-2.701l.116-.128zM16 14.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3zm6 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3zm-12 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3z"></path></svg>
                                                        </div>
                                                        <div class="_3qymq">
                                                            <div class="_652db9"><b>Send a link</b></div>
                                                            <div class="_10rf6ea">Anyone with the link can view</div>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                            <div class="_1gglzn7" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">
                                                <button type="button" class="_o7xaku5">
                                                    <div class="_sggpze d-flex align-items-center gap-3">
                                                        <div class="_1eaes69">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="M32,25H30a8.007,8.007,0,0,0-7-7.93054V14.81573a3.00011,3.00011,0,1,0-2-.00006v2.25379a7.958,7.958,0,0,0-3.50024,1.33246A9.95129,9.95129,0,0,1,20,25H18a7.95162,7.95162,0,0,0-2-5.27905,8.057,8.057,0,0,0-1.49969-1.319A7.958,7.958,0,0,0,11,17.06946V14.81573a3.00011,3.00011,0,1,0-2-.00006v2.25379A8.007,8.007,0,0,0,2,25H0a10.01615,10.01615,0,0,1,6.54834-9.38574,5,5,0,1,1,6.90332,0A9.98322,9.98322,0,0,1,16,17.00879a9.98325,9.98325,0,0,1,2.54785-1.39453,5,5,0,1,1,6.9043,0A10.01571,10.01571,0,0,1,32,25Z"></path></svg>
                                                        </div>
                                                        <div class="_3qymq">
                                                            <div class="_652db9"><b>Invite others</b></div>
                                                            <div class="_10rf6ea">People you invite can add and edit</div>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalToggleLabel2">Send a link to your wishlist</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row py-4 g-3">
                                        <div class="col-sm-6">
                                            <div class="card d-flex gap-3 align-items-center p-4 flex-row">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px; fill: currentcolor;"><path d="M25 5a4 4 0 0 1 4 4v17a5 5 0 0 1-5 5H12a5 5 0 0 1-5-5V10a5 5 0 0 1 5-5h13zm0 2H12a3 3 0 0 0-3 3v16a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V9a2 2 0 0 0-2-2zm-3-6v2H11a6 6 0 0 0-5.996 5.775L5 9v13H3V9a8 8 0 0 1 7.75-7.996L11 1h11z"></path></svg>
                                                <b>Copy</b>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card d-flex gap-3 align-items-center p-4 flex-row">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 32px; width: 32px; stroke: currentcolor; stroke-width: 2; overflow: visible;"><g fill="none"><rect height="24" rx="4" width="28" x="2" y="4"></rect><path d="m3 6 10.416231 8.813734c1.4913834 1.2619398 3.6761546 1.2619398 5.167538 0l10.416231-8.813734"></path></g></svg><b>Email</b>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card d-flex gap-3 align-items-center p-4 flex-row">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px;"><defs><linearGradient x1="50.794%" y1="93.362%" x2="50.794%" y2="12.41%" id="imessagegradient"><stop stop-color="#0CBD2A" offset="0%"></stop><stop stop-color="#5BF675" offset="100%"></stop></linearGradient></defs><g><path d="M2 0h28a2 2 0 0 1 2 2v28a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z" fill="url(#imessagegradient)"></path><path d="M15.796 5.469c-6.404 0-11.595 4.324-11.595 9.658.005 3.39 2.143 6.528 5.633 8.27-.457 1.023-1.142 1.983-2.028 2.838 1.717-.3 3.329-.934 4.71-1.85 1.064.264 2.17.399 3.28.4 6.404 0 11.596-4.324 11.596-9.658S22.2 5.47 15.796 5.47z" fill="#FFF"></path></g></svg><b>Messages</b>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card d-flex gap-3 align-items-center p-4 flex-row">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px;"><path d="m32 0v32h-32v-32z" fill="#25d366"></path><path d="m4 28 1.695-6.163a11.824 11.824 0 0 1 -1.595-5.946c.003-6.556 5.364-11.891 11.95-11.891a11.903 11.903 0 0 1 8.453 3.488 11.794 11.794 0 0 1 3.497 8.414c-.003 6.557-5.363 11.892-11.95 11.892-2 0-3.97-.5-5.715-1.448zm6.628-3.807c1.684.995 3.292 1.591 5.418 1.592 5.474 0 9.933-4.434 9.936-9.885.002-5.462-4.436-9.89-9.928-9.892-5.478 0-9.934 4.434-9.936 9.884 0 2.225.654 3.891 1.754 5.634l-1.002 3.648 3.76-.98h-.002zm11.364-5.518c-.074-.123-.272-.196-.57-.344-.296-.148-1.754-.863-2.027-.96-.271-.1-.469-.149-.667.147-.198.295-.767.96-.94 1.157s-.346.222-.643.074c-.296-.148-1.253-.46-2.386-1.466-.881-.783-1.477-1.75-1.65-2.045s-.018-.455.13-.602c.134-.133.296-.345.445-.518.15-.17.2-.294.3-.492.098-.197.05-.37-.025-.518-.075-.147-.668-1.6-.915-2.19-.241-.577-.486-.499-.668-.508l-.569-.01a1.09 1.09 0 0 0 -.79.37c-.272.296-1.039 1.01-1.039 2.463s1.064 2.857 1.211 3.054c.15.197 2.092 3.18 5.068 4.458.708.304 1.26.486 1.69.622.712.224 1.359.193 1.87.117.57-.084 1.755-.714 2.002-1.404.248-.69.248-1.28.173-1.405z" fill="#FFF"></path></svg>
                                                <b>Whatsapp</b>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card d-flex gap-3 align-items-center p-4 flex-row">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px;"><path fill="#1877F2" d="M32 0v32H0V0z"></path><path d="M22.938 16H18.5v-3.001c0-1.266.62-2.499 2.607-2.499h2.018V6.562s-1.831-.312-3.582-.312c-3.654 0-6.043 2.215-6.043 6.225V16H9.436v4.625H13.5V32h5V20.625h3.727l.71-4.625z" fill="#FFF"></path></svg><b>Facebook</b>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card d-flex gap-3 align-items-center p-4 flex-row">
                                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 32px; width: 32px;"><path fill="#1DA1F2" d="M0 0H32V32H0z"></path><path d="M18.664 7.985a4.5 4.5 0 0 0-2.289 4.89c-3.5-.188-6.875-1.813-9.063-4.625a4.25 4.25 0 0 0 1.375 5.875c-.687 0-1.374-.125-2-.438.063 2.063 1.5 3.876 3.5 4.313-.624.188-1.312.188-2 .063.626 1.812 2.313 3.062 4.188 3.125-1.813 1.5-4.25 2.187-6.563 1.812a12.438 12.438 0 0 0 19.313-11.188c.875-.624 1.625-1.374 2.188-2.312-.75.375-1.625.625-2.5.75.937-.563 1.625-1.438 2-2.5-.875.5-1.813.875-2.813 1.063a4.5 4.5 0 0 0-5.336-.828z" fill="#FFF"></path></svg>
                                                <b>Twitter</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="_4l12l8 d-flex align-items-center     flex-wrap">As a reminder, anyone with the link can view this wishlist. <a target="_blank" href="/help/article/1236/how-do-i-manage-my-list-of-saved-homes" class="_1sikdxcl">Learn more</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="my-4"><b>Okeke Johnpaul</b></h3>
                    <div class="d-flex gap-3" role="group">
                        <div class="fczcwlc dir dir-ltr">
                            <button class="_15pf4i2" type="button">
                                <span class="c194hv19 dir dir-ltr">Dates</span>
                            </button>
                        </div>
                        <div class="fczcwlc dir dir-ltr">
                            <button class="_15pf4i2" type="button">
                                <span class="c194hv19 dir dir-ltr">Guests</span>
                            </button>
                        </div>
                    </div>
                    <!-- card item -->
                    <a href="#" class="card-item mt-5 d-block" style="max-width: 400px;">
                        <div class="card" style="border: none;">
                            <div class="card-image">
                                <div class="icon-love">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="fill: rgba(0, 0, 0, 0.5); height: 24px; width: 24px; stroke-width: 2; overflow: visible;">
                             <path
                                d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                             </path>
                          </svg>
                                </div>
                                <!-- carousel-start -->
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="../assets/images/03aea1c2-5ea3-46f0-a3ec-36e6f4dc82bd.jpg" class="card-img-top d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../assets/images/03aea1c2-5ea3-46f0-a3ec-36e6f4dc82bd.jpg" class="card-img-top d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../assets/images/03aea1c2-5ea3-46f0-a3ec-36e6f4dc82bd.jpg" class="card-img-top d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../assets/images/03aea1c2-5ea3-46f0-a3ec-36e6f4dc82bd.jpg" class="card-img-top d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../assets/images/03aea1c2-5ea3-46f0-a3ec-36e6f4dc82bd.jpg" class="card-img-top d-block w-100" alt="...">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                             <span class="carousel-control-prev-icon" aria-hidden="true">
                                <em class="bi bi-chevron-left"></em>
                             </span>
                             <span class="visually-hidden"></span>
                          </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                             <span class="carousel-control-next-icon" aria-hidden="true">
                                <em class="bi bi-chevron-right"></em>
                             </span>
                             <span class="visually-hidden"></span>
                          </button>
                                </div>
                                <!-- carousel-end -->
                            </div>
                            <div class="card-body">

                                <div class="card-body-inner">
                                    <div class="left">
                                        <div class="location">
                                            <h6>Salobrena, Spain</h6>
                                        </div>
                                        <div class="kilometre"><span>3,340 kilometre</span></div>
                                        <div class="date"><span>Jan 3 - 8</span></div>
                                        <div class="price"><span><b>$518</b> night</span></div>
                                    </div>
                                    <div class="right">
                                        <div class="rating">
                                            <span class="icon"><em class="bi bi-star-fill"></em></span>
                                            <span class="rate-value">4.67 (36)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- card item end -->
                </div>
            </div>
            <div class="col-md-6 video-container p-0 position-relative" style="background-color: white !important;">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=9&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        <a href="https://www.whatismyip-address.com/divi-discount/">divi discount</a><br>

                    </div>
                </div>
            </div>
    </div>
    </main>
    <!-- main end -->

    </div>


    <!-- !<======= MODALSSSS ========> -->




    <!-- ? <====== CANVAS FROM BOTTOM ======> -->
    <div class="offcanvas offcanvas-bottom resources" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container p-0">
                <div class="row col-12 m-0 align-items-start justify-content-evenly">
                    <div class="p-0 col-md-3">
                        <div class="inner">
                            <div class="title"><small><b>Support</b></small></div>
                            <div class="body">
                                <ul>
                                    <li><a href="#">Help Center</a></li>
                                    <li><a href="#">AirCover</a></li>
                                    <li><a href="#">Safety information</a></li>
                                    <li><a href="#">Supporting people with disabilites</a></li>
                                    <li><a href="#">Cancellation options</a></li>
                                    <li><a href="#">Our COVID-19 Response</a></li>
                                    <li><a href="#">Report a neighborhood concern</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 col-md-3">
                        <div class="inner">
                            <div class="title"><small><b>Community</b></small></div>
                            <div class="body">
                                <ul>
                                    <li><a href="#">Airbnb.org: disaster relief housing</a></li>
                                    <li><a href="#">Support Afghan refugees</a></li>
                                    <li><a href="#">Combating discrimination</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 col-md-3">
                        <div class="inner">
                            <div class="title"><small><b>Hosting</b></small></div>
                            <div class="body">
                                <ul>
                                    <li><a href="#">Try Hosting</a></li>
                                    <li><a href="#">Aircover for hosting</a></li>
                                    <li><a href="#">Explore hosting Resources</li>
                           <li><a href="#">Visit our conmmunity forum</a></li>
                                    <li><a href="#">How to host responsibly</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 col-md-3">
                        <div class="inner">
                            <div class="title"><small><b>Airbnb</b></small></div>
                            <div class="body">
                                <ul>
                                    <li><a href="#">Newsroom</a></li>
                                    <li><a href="#">Learn about new features</a></li>
                                    <li><a href="#">Letter from our founders</a></li>
                                    <li><a href="#">Careers</a></li>
                                    <li><a href="#">Investors</a></li>
                                    <li><a href="#">Gift Cards</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <script src="../assets/js/custom.js"></script>
</body>

</html>