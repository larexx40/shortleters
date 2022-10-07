<?php  
    include "./header.php"; 
?>

  <title>Sample title - Ecommerce admin dashboard template</title>

</head>
<body>


<div id="user">

    <b class="screen-overlay"></b>

    <aside class="navbar-aside" id="offcanvas_aside">

    <div class="aside-top">
    <a href="page-index-1.html" class="brand-wrap">
        <img src="../assets/images/Cardify Logo Variant.png" height="46" class="logo" alt="Ecommerce dashboard template">
    </a>
    <div>
        <button class="btn btn-icon btn-aside-minimize"></button>
    </div>
    </div> <!-- aside-top.// -->

    <nav>
    <ul class="menu-aside">
        <li class="menu-item"> 
            <a class="menu-link" href="">
                <span class="text">Dashboard</span> 
            </a> 
        </li>
        <li class="menu-item has-submenu"> 
            <a class="menu-link" href="">
                <span class="text">Products</span> 
            </a> 
        </li>
        <li class="menu-item has-submenu"> 
            <a class="menu-link" href="">
                <span class="text">Orders</span> 
            </a>
        </li>
        <li class="menu-item has-submenu"> 
            <a class="menu-link" href="">
                <span class="text">Sellers</span> 
            </a> 
        </li>
        <li class="menu-item has-submenu"> 
            <a class="menu-link" href="">  
                <span class="text">Add product</span> 
            </a> 
        </li>
    </ul>
    <hr>
    <ul class="menu-aside">
        <li class="menu-item has-submenu"> 
        <a class="menu-link" href="#">  
            <span class="text">Settings</span> 
        </a>
        <div class="submenu">
            <a href="">Setting sample 1</a>
            <a href="">Setting sample 2</a>
        </div>
        </li>
        <li class="menu-item active">
        <a class="menu-link" href=""> 
            <span class="text"> Starter page </span>
        </a> 
        </li>
    </ul>
    <br>
    <br>
    </nav>
    </aside>

    <main class="main-wrap">
    <header class="main-header navbar">
    
        <div class="col-search">
            <form class="searchform">
                <div class="input-group">
                <input list="search_terms" type="text" class="form-control" placeholder="Search term">
                <button class="btn btn-light bg" type="button"> <i class="material-icons md-search"></i> </button>
                </div>
                <datalist id="search_terms">
                <option value="Products">
                <option value="New orders">
                <option value="Apple iphone">
                <option value="Ahmed Hassan">
                </datalist>
            </form>
        </div>
        
    <div class="col-nav">
        <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"> <i class="md-28 material-icons md-menu"></i> </button>
        <ul class="nav">
        <li class="nav-item">
            <a class="nav-link btn-icon" onclick="darkmode(this)" title="Dark mode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-icon" href="#"> <i class="material-icons md-notifications_active"></i> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"> English </a>
        </li>
        <li class="dropdown nav-item">
            <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#"> <img class="img-xs rounded-circle" src="images/people/avatar1.jpg" alt="User"></a>
            <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="#">My profile</a>
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item text-danger" href="#">Exit</a>
            </div>
        </li>
        </ul> 
    </div>
    </header>


    <div class="main">
    <div class="main__inner">
        <div class="main__header text-center text-lg-start">
            <h3>Tunde Buremo</h3>
            <small>aderemiibrahimtunde@gmail.com</small>
        </div>
        <div class="main__body">
            <div class="main__body__inner row col-12 m-0">
                <div class="each__card col-lg-3">
                    <a href="">
                        <div class="each__card__inner">
                            <div class="top">
                                <div class="icon"><em class="bi bi-person-fill"></em> </div>
                            </div>
                            <div class="bottom">
                                <span>Personal Information</span>
                                <div class="p">Edit your name, phone number and other personal info.</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="each__card col-lg-3">
                    <a href="">
                        <div class="each__card__inner">
                            <div class="top">
                                <div class="icon"><em class="bi bi-lock-fill"></em> </div>
                            </div>
                            <div class="bottom">
                                <span>Login & Security</span>
                                <div class="p">Update your password. Keep your account safe.</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="each__card col-lg-3">
                    <a href="">
                        <div class="each__card__inner">
                            <div class="top">
                                <div class="icon"><em class="bi bi-journal"></em> </div>
                            </div>
                            <div class="bottom">
                                <span>Address Book</span>
                                <div class="p">Edit, delete and add new addresses.</div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- <div class="each__card col-lg-3">
                    <a href="">
                        <div  iv class="each__card__inner">
                            <div class="top">
                                <div class="icon"><em class="bi bi-hdd-rack-fill"></em> </div>
                            </div>
                            <div class="bottom">
                                <span>General Preferences</span>
                                <div class="p">Set your notifications and other preferences.</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="each__card col-lg-3">
                    <a href="">
                        <div class="each__card__inner">
                            <div class="top">
                                <div class="icon"><em class="bi bi-question-circle-fill"></em> </div>
                            </div>
                            <div class="bottom">
                                <span>Help & Support</span>
                                <div class="p">Visit our help center. We are always happy to help.</div>
                            </div>
                        </div>
                    </a>
                </div> -->
            </div>
        </div>
    </div>
    </div>

        


    </main>

</div>

<script>
	if(localStorage.getItem("darkmode")){
		var body_el = document.body;
		body_el.className += 'dark';
	}
</script>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>


<!-- Custom JS -->
<script src="js/script.js?v=1.0"></script>

</body>
</html>