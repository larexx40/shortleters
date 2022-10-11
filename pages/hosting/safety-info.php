<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../../assets/fonts/bootstrap-icons.css" />
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../assets/css/nav.css" />
    <link rel="stylesheet" href="../../assets/css/footer.css" />
    <link rel="stylesheet" href="../../assets/css/layout.css" />
    <link rel="stylesheet" href="../../assets/css/hosting.css" />
    <title>Account Settings</title>
</head>
<style>
    ._15rpys7s {
        font-size: inherit;
        font-family: inherit;
        font-style: inherit;
        font-variant: inherit;
        line-height: inherit;
        appearance: none;
        background: transparent;
        border: 0px;
        cursor: pointer;
        margin: 0px;
        padding: 0px;
        user-select: auto;
        color: rgb(34, 34, 34);
        text-decoration: underline;
        border-radius: 4px;
        font-weight: 600;
        text-align: inherit;
        outline: none;
    }
    
    .d-grid b {
        font-weight: 400;
        margin-bottom: 10px;
    }
    
    .checker>button {
        -webkit-box-align: center;
        -webkit-box-pack: center;
        display: flex;
        cursor: pointer;
        color: rgb(113, 113, 113);
        border-width: 1px;
        border-style: solid;
        border-color: rgb(176, 176, 176);
        height: 32px;
        width: 32px;
        contain: layout;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        background: rgb(255, 255, 255);
    }
    
    .checker>button.active {
        background-color: black;
        color: white;
    }
    
    ._zwx78zm {
        cursor: pointer;
        display: inline-block;
        margin: 0px;
        position: relative;
        text-align: center;
        text-decoration: none;
        width: auto;
        touch-action: manipulation;
        font-weight: 600;
        border-radius: 10px;
        outline: none;
        padding: 16px 32px;
        transition: box-shadow 0.2s ease 0s, -ms-transform 0.1s ease 0s, -webkit-transform 0.1s ease 0s, transform 0.1s ease 0s;
        -webkit-tap-highlight-color: transparent;
        border: none;
        background: black;
        color: white;
    }
</style>

<body>
    <div class="body-wrapper">
        <header class="d-flex align-items-center">
            <div class="header-inner d-flex align-items-center w-100 justify-content-between px-md-5 px-3">
                <div class="first-div">
                    <div class="lg-screen-logo">
                        <a href="#">
                            <img style="width:100%;" src="../assets/images/GREEN_LOGO_HORIZONTAL_1.png" /> 
                        </a>
                    </div>
                </div>
                <div class="second-div">
                    <div class="end-tabs">
                        <ul class="host d-none d-lg-flex gap-5">
                            <li>
                                <a href="./index.html" class="host-link"><span>Today</span></a>
                            </li>
                            <li>
                                <a href="./message.html" class="host-link"><span>Inbox</span></a>
                            </li>
                            <li>
                                <a href="./onboarding/index.html" class="host-link"><span>Calendar</span></a>
                            </li>
                            <li>
                                <a href="./insights.html" class="host-link"><span>Insights</span></a>
                            </li>
                            <li class="dropdown menu-link w-auto h-auto border-0 d-block p-0" style="border: none">
                                <a href="#" class="host-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><span>Menu</span></a
									>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="./listing.html">Listing</a></li>
                            <li><a class="dropdown-item active" href="./reservations.html">Reservations</a></li>
                            <li><a class="dropdown-item" href="./onboarding/index.html">Create a new listing</a></li>
                            <div class="sub-menu-links">
                                <li><a class="dropdown-item" href="./transactions.html">Transaction History</a></li>
                                <li><a class="dropdown-item" href="./community.html">Connect with Hosts near you.</a></li>
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
                                <a href="#" class="host-icon" class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><em class="bi bi-bell" style="font-size: 20px"></em
									></a>
                                <ul class="dropdown-menu" style="min-height: 300px"></ul>
                            </div>
                        </div>
                        <div class="menu-link d-none d-lg-flex">
                            <div class="dropdown">
                                <button class="dropdown-toggle _1u0z83f5" type="button" data-bs-toggle="dropdown" aria-expanded="false">
										<div class="user-icon mx-0">
											<svg
												xmlns="http://www.w3.org/2000/svg"
												width="32"
												height="32"
												preserveAspectRatio="xMidYMid meet"
												viewBox="0 0 1792 1792">
												<path
													fill="currentColor"
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
										<path
											fill="currentColor"
											d="M2 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm0 6.032a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm1 5.032a1 1 0 1 0 0 2h18a1 1 0 0 0 0-2H3Z" />
									</svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main class="py-5 mx-auto container justify-content-center row" style="margin-top: 60px;max-width: 800px;">
            <span class="d-flex gap-2 align-items-center">
                <span class="atm_h0_1y44olf dir dir-ltr"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 4; overflow: visible;"><g fill="none"><path d="m20 28-11.29289322-11.2928932c-.39052429-.3905243-.39052429-1.0236893 0-1.4142136l11.29289322-11.2928932"></path></g></svg></span>
            <span class="_15rpys7s">Back to editing hhhhh</span>
            </span>
            <div class="my-4">
                <div class="_mf1jwf">
                    <h1 tabindex="-1" style="font-size: 1.7rem;
                    font-weight: 900;">Highlight safety and property info</h1>
                </div>
                <div class="_1epbewz">This covers questions a guest may have before they’re ready to book—and helps avoid surprises later on
                    <div class="_b1aaqf" style="margin-top: 16px;"><button type="button" class="_15rpys7s"><span class="_lo9vot">How will this info be shown to guests?</span></button></div>
                </div>
            </div>
            <div class="my-3">
                <h1 class="my-5" style="font-size: 1.3rem;
                    font-weight: 900;">Safety Questions</h1>
                <ul class="policies">
                    <li>
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-grid">
                                <b>Pool/hot tub without a gate or lock</b>
                                <small>Guests will have direct, unrestricted access to any permanent natural or artificial body of water located directly on or next to the property. Ex: ocean/beach, pond, creek, wetlands.</small>
                                <a href="#" class="d-block mt-3">
                                    <span class="_lo9vot _15rpys7s">Learn More</span>
                                </a>
                            </div>
                            <div class="d-flex mx-2 gap-2 align-items-center checker">
                                <button class="active"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg></button>
                                <button><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg></button>
                            </div>
                        </div>
                    </li>
                    <hr>
                    <li>
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-grid">
                                <b>Cancellation policy</b>
                                <small>Guests will have direct, unrestricted access to any permanent natural or artificial body of water located directly on or next to the property. Ex: ocean/beach, pond, creek, wetlands.</small>
                            </div>
                            <div class="d-flex mx-2 gap-2 align-items-center checker">
                                <button class="active"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg></button>
                                <button><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg></button>
                            </div>
                        </div>
                    </li>
                    <hr>
                    <li>
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-grid">
                                <b>Nearby lake, river, other body of water</b>
                                <small>Guests will have direct, unrestricted access to any permanent natural or artificial body of water located directly on or next to the property. Ex: ocean/beach, pond, creek, wetlands.</small>
                            </div>
                            <div class="d-flex mx-2 gap-2 align-items-center checker">
                                <button class="active"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg></button>
                                <button><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg></button>
                            </div>
                        </div>
                    </li>
                    <hr>
                    <li>
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-grid">
                                <b>Climbing or play structure</b>
                                <small>Guests (including children) will have access to structures or items intended for climbing or playing on. Ex: swing, slide, playset, climbing ropes.</small>
                            </div>
                            <div class="d-flex mx-2 gap-2 align-items-center checker">
                                <button class="active"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg></button>
                                <button><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg></button>
                            </div>
                        </div>
                    </li>
                    <hr>
                </ul>
                <h1 class="my-5" style="font-size: 1.3rem;
                    font-weight: 900;">Safety Devices</h1>
                <ul class="policies">
                    <li>
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-grid">
                                <b>Security cameras/audio recording devices</b>
                                <small>The property has a security camera or recording device capable of recording or sending video, audio, or still images. Airbnb requires hosts to inform guests of any such camera or device located in a common area—even if it will be turned off during a guest’s stay. Airbnb prohibits security cameras or recording devices in private spaces like bedrooms, bathrooms, or sleeping areas..</small>
                                <a href="#" class="d-block mt-3">
                                    <span class="_lo9vot _15rpys7s">Learn More</span>
                                </a>
                            </div>
                            <div class="d-flex mx-2 gap-2 align-items-center checker">
                                <button class="active"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg></button>
                                <button><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg></button>
                            </div>
                        </div>
                    </li>
                    <hr>
                    <li>
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-grid">
                                <b>Carbon monoxide alarm</b>
                                <small>The property has an alarm that detects and warns about the presence of carbon monoxide gas. Check your local laws for specific requirements.</small>
                                <a href="#" class="d-block mt-3">
                                    <span class="_lo9vot _15rpys7s">Learn More</span>
                                </a>
                            </div>
                            <div class="d-flex mx-2 gap-2 align-items-center checker">
                                <button class="active"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg></button>
                                <button><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg></button>
                            </div>
                        </div>
                    </li>
                    <hr>
                    <li>
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-grid">
                                <b>Smoke alarm</b>
                                <small>The property has an alarm that detects and warns about the presence of smoke and fire. Check your local laws for specific requirements.</small>
                            </div>
                            <div class="d-flex mx-2 gap-2 align-items-center checker">
                                <button class="active"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg></button>
                                <button><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg></button>
                            </div>
                        </div>
                    </li>
                    <hr>
                    <li>
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-grid">
                                <b>Climbing or play structure</b>
                                <small>Guests (including children) will have access to structures or items intended for climbing or playing on. Ex: swing, slide, playset, climbing ropes.</small>
                            </div>
                            <div class="d-flex mx-2 gap-2 align-items-center checker">
                                <button class="active"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg></button>
                                <button><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg></button>
                            </div>
                        </div>
                    </li>
                    <hr>
                </ul>

                <h1 class="my-5" style="font-size: 1.3rem;
                    font-weight: 900;">Property Info</h1>
                <ul class="policies">
                    <li>
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-grid">
                                <b>Pool/hot tub without a gate or lock</b>
                                <small>Guests will have direct, unrestricted access to any permanent natural or artificial body of water located directly on or next to the property. Ex: ocean/beach, pond, creek, wetlands.</small>
                            </div>
                            <div class="d-flex mx-2 gap-2 align-items-center checker">
                                <button class="active"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg></button>
                                <button><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg></button>
                            </div>
                        </div>
                    </li>
                    <hr>
                    <li>
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-grid">
                                <b>Cancellation policy</b>
                                <small>Guests will have direct, unrestricted access to any permanent natural or artificial body of water located directly on or next to the property. Ex: ocean/beach, pond, creek, wetlands.</small>
                            </div>
                            <div class="d-flex mx-2 gap-2 align-items-center checker">
                                <button class="active"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg></button>
                                <button><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg></button>
                            </div>
                        </div>
                    </li>
                    <hr>
                    <li>
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-grid">
                                <b>Nearby lake, river, other body of water</b>
                                <small>Guests will have direct, unrestricted access to any permanent natural or artificial body of water located directly on or next to the property. Ex: ocean/beach, pond, creek, wetlands.</small>
                            </div>
                            <div class="d-flex mx-2 gap-2 align-items-center checker">
                                <button class="active"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg></button>
                                <button><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg></button>
                            </div>
                        </div>
                    </li>
                    <hr>
                    <li>
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-grid">
                                <b>Climbing or play structure</b>
                                <small>Guests (including children) will have access to structures or items intended for climbing or playing on. Ex: swing, slide, playset, climbing ropes.</small>
                            </div>
                            <div class="d-flex mx-2 gap-2 align-items-center checker">
                                <button class="active"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path d="m6 6 20 20"></path><path d="m26 6-20 20"></path></svg></button>
                                <button><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 3; overflow: visible;"><path fill="none" d="m4 16.5 8 8 16-16"></path></svg></button>
                            </div>
                        </div>
                    </li>
                    <hr>
                </ul>
            </div>
        </main>

        <!-- mobile view footer -->
        <footer>
            <div class="row col-12 m-0 py-2 align-items-center justify-content-evenly  mobile-view">
                <div class="p-0 col-2 each-link">
                    <a href="#">
                        <span class="_lo9vot _15rpys7s">Cancel</span>
                    </a>
                </div>
                <div class="p-0 col-2 each-link">
                    <button class="_zwx78zm ">Save</button>
                </div>

            </div>
        </footer>


    </div>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/jquery-3.6.1.min.js"></script>
    <script src="../../assets/js/custom.js"></script>
    <script>
        $('.checker button').click(function() {
            $(this).parent('.checker').children('button').removeClass('active');
            $(this).addClass('active');
        });
    </script>
</body>

</html>