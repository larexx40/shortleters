<b class="screen-overlay"></b>
    <aside class="navbar-aside" id="offcanvas_aside">
        <nav>
            <ul class="menu-aside">
                <a class="nav-brand nav-desktop" style="margin-bottom: 15px;">
                    <img class="nav-desktop" src="../assets/images/logomark-primary.svg" />
                </a>
                
                <b v-if="user_detais" class="nav-desktop">Hi {{user_detais.Firstname}}</b>
                <!-- <b class="nav-desktop">Hi Okeke</b> -->
                <hr class="nav-desktop">
                <li class="menu-item"> 
                    <a class="menu-link active" href="index.php">
                    <div class="image"><img src="../assets/images/icon-home.svg" alt="" class="img-fluid"></div>
                    <div class="text"><span>Home</span></div>
                    </a> 
                </li>
                <div style="margin: 5px;"></div>
                <li class="menu-item" > 
                    <a class="menu-link" href="wallet.php">
                        <div class="image"><img src="../assets/images/icon-wallet (1).svg" alt="" class="img-fluid"></div>
                    <div class="text"><span>Wallet</span></div>
                    </a> 
                </li>
        
                    <br>
        
                <li class="menu-item"> 
                    <a class="menu-link" href="shipment.php">
                        <div class="image"><img src="../assets/images/icon-shipments.svg" alt="" class="img-fluid"></div>
                        <div class="text"><span>Shipments</span></div>
                    </a>
                </li>
                <li class="menu-item"> 
                    <a class="menu-link" href="orders.php">
                        <div class="image"><img src="../assets/images/icon-orders.svg" alt="" class="img-fluid"></div>
                        <div class="text"><span>Orders</span></div>
                    </a> 
                </li>
                <li class="menu-item "> 
                    <a class="menu-link" href="pickups.php">  
                        <div class="image"><img src="../assets/images/icon-time.svg" alt="" class="img-fluid"></div>
                        <div class="text"><span>Pickups</span></div> 
                    </a> 
                </li>
            <br>
                <li class="menu-item"> 
                    <a class="menu-link" href="promotion.php">  
                        <div class="image"><img src="../assets/images/icon-referral.svg" alt="" class="img-fluid"></div>
                        <div class="text"><span>Promotion</span></div> 
                    </a> 
                </li>
                <br>
                <li class="menu-item"> 
                    <a class="menu-link" href="complain.php">  
                        <div class="image"><i class="bi bi-chat-dots-fill"></i></div>
                        <div class="text"><span>Complains</span></div> 
                    </a> 
                </li>
                <li class="menu-item"> 
                    <a class="menu-link" href="notifications.php">  
                        <div class="image"><i class="bi bi-bell-fill"></i></div>
                        <div class="text"><span>Notifications</span></div> 
                    </a> 
                </li>
                <li class="menu-item"> 
                    <a class="menu-link" href="activities.php">  
                        <div class="image"><i class="bi bi-activity"></i></div>
                        <div class="text"><span>Activities</span></div> 
                    </a> 
                </li>
                <li class="menu-item"> 
                    <a class="menu-link" href="address.php">  
                        <div class="image"><i class="bi bi-map-fill"></i></div>
                        <div class="text"><span>Address</span></div> 
                    </a> 
                </li>
                <li class="menu-item"> 
                    <a class="menu-link" href="setting.php">  
                        <div class="image"><img src="../assets/images/icon-settings.svg" alt="" class="img-fluid"></div>
                        <div class="text"><span>Settings</span></div> 
                    </a> 
                </li>
                <li class="menu-item nav-desktop"> 
                    <a class="menu-link">  
                        <div class="image"><img src="https://d3bz3ebxl8svne.cloudfront.net/production/static/svg/icon-signout.svg" alt="" class="img-fluid"></div>
                        <div class="text"><span>Sign out</span></div> 
                    </a> 
                </li>
                <hr class="nav-desktop">
                <li class="menu-item nav-desktop" > 
                    <div data-v-682aa723="" class="d-flex " style="justify-content:space-between;align-items:center;font-size: 11px;">
                        <div >
                            <div >Currency Here</div> 
                            <div class="color-dark-blue text-xs mt-1">
                                Tap to change to NGN
                            </div>
                        </div> 
                        <button data-v-0574ca14="" data-v-682aa723="" class="selected-currency-button">
                            <span data-v-0574ca14=""> 🇺🇸 USD</span>
                        </button>
                    </div>
                </li>
                <hr class="nav-desktop">
                <ul data-v-682aa723="" class="nav-desktop">
                    <li data-v-682aa723="" class="resource-item">
                        
                        <a data-v-682aa723="" href="https://vimeo.com/showcase/8774408" target="_blank" rel="noopener noreferrer" class="">
                            <span data-v-682aa723="">Get quick help</span>
                        </a> 
                    </li>
                    <li data-v-682aa723="" class="resource-item">
                        <a data-v-682aa723="" href="https://vimeo.com/showcase/8774408" target="_blank" rel="noopener noreferrer" class="">
                            <span data-v-682aa723="">Video tutorials</span>
                        </a> 
                    </li>
                    <li data-v-682aa723="" class="resource-item">
                        <a data-v-682aa723="" href="https://vimeo.com/showcase/8774408" target="_blank" rel="noopener noreferrer" class="">
                            <span data-v-682aa723="">Blog</span>
                        </a> 
                    </li>
                </ul>
            </ul>
        
        <br>
        <br>
        <div class="bottom position-fixed" style="display: none;">
            <div class="bottom__inner">
                <div><small>About us</small></div>
                <div class="p">Privacy policy &nbsp; &#x2022; &nbsp; Terms</div>
                <div class="text">&copy; Heroshe 2022</div>
            </div>
        </div>
        </nav>
    </aside>

    <main class="main-wrap">
    <header class="main-header navbar">
        <a class="nav-brand">
            <img src="../assets/images/logomark-primary.svg" />
        </a>
        <div class="col-search">
            <form class="searchform">
                <div class="input-group search-bar">
                <input list="search_terms" type="text" class="form-control" placeholder="Search Shipments ..." style="padding-right: 2.75rem;">
                <button data-v-0713d3db="" type="submit" class="button slim">
                    <img data-v-0713d3db="" src="https://d3bz3ebxl8svne.cloudfront.net/production/static/svg/bg/icon-search-bar-submit.svg" alt=">" style="height: 0.9rem;">
                </button>
                </div>
            </form>
        </div>
        
        <div class="col-nav">
            <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"> <i class="md-28 material-icons md-menu"></i> </button>
            <ul class="nav">
                <li class="nav-item dropdown">
                    <a class="nav-link btn-icon dropdown-toggle" data-bs-toggle="dropdown" href="#"><span class="data-hide"> Resources</span>  <img  src="https://d3bz3ebxl8svne.cloudfront.net/production/static/svg/icon-info-white.svg" alt="..."></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">Get Quick Help</a>
                        <a class="dropdown-item" href="#">Video Tutorials</a>
                        <a class="dropdown-item text-danger" href="../blog.php">Blog</a>
                    </div>
                </li>
                <li class="nav-item dropdown select-o d-flex">
                    <a class="nav-link btn-icon " data-bs-toggle="dropdown" href="#"> <span class="data-hide"> Currency</span> </a>
                    <select class="select-currency">
                        <option><small>us</small> USD</option>
                        <option><small>ng</small> NGN</option>
                    </select>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link btn-icon"  href="#"><span class="data-hide"> Cart</span>  <img data-v-56821547="" data-v-dfdf1a68="" src="https://d3bz3ebxl8svne.cloudfront.net/production/static/svg/icon-cart.svg" alt="..."></a>
                
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link btn-icon d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown" href="#"> <span v-if='user_detais' class="profile-initials">{{user_detais.Firstname.charAt(0)}} {{user_detais.Lastname.charAt(0)}}</span> <span v-if='user_detais' class="data-hide">{{user_detais.Username}}</span></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="setting.php">Profile</a>
                        <a class="dropdown-item" @click="logout">Sign out</a>
                        <hr class="dropdown-divider" />
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </li>
                <li class="nav-item icon-menu nav-desktop">
                    <div class="container containerd" onclick="myFunction(this)">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                </li>
                
            </ul> 
        </div>
    </header>