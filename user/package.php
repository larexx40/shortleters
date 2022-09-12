<?php  
    include "./header.php"; 
?>

  <title>Package</title>

</head>
<body>

<div id="user">

    <?php 
            include "sidebar_navbar.php";
        ?>
    <style>
    .search-bar [type=submit][data-v-0713d3db] {
        position: absolute;
        border-radius: 9999px !important;
        font-weight: 600 !important;
        top: 2px;
        right: 0.75rem;
        width: 35px;
        height: 1.75rem !important;
        padding: 0.1rem !important;
        line-height: normal !important;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        height: 34px !important;
        padding: 5px 10px;
        border-radius: 23px;
        background-color: #f1c34e;
        border: 1.5px solid #efbb36;
        color: #000;
        font-weight: 400;
        font-size: 16px;
        transition: all .25s ease;
        outline: none;
        line-height: 1.17;
        white-space: nowrap;
        z-index: 99999;
    }
    .search-bar .form-input {
        width: 100%;
        display: flex;
        align-items: center;
        height: 48px;
        padding: 12px 16px;
        border-radius: 4px;
        background-color: #fff;
        color: #212b36;
        font-size: 1rem;
        transition: all .25s ease;
        border: 1px solid #979797;
        outline: none;
    }.search-bar{
        position: relative;
        min-width: 12.75rem;
        width: 50%;

    }
    </style>


    <div class="main">
        <div class="main__inner">
            <div class="main__body container">
                <div class="main__body__inner">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="row col-md-10 my-0 mx-auto align-items-center">
                            <div class="col-2 image">
                                <img src="../assets/images/empty-order-boxes.svg" alt="" class="img-fluid">
                            </div>
                            <div class="col-10 text">
                                <div><small>You don’t have any shipments ready for pickup</small></div>
                                <div class="col-12 col-md-10 mt-2"><p>Once your package arrives our Lagos facilitiy and it's ready to be picked up, they'll appear here!</p></div>
                            </div>
                        </div>
                    </div>
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
<script src="../assets/js/toasteur.min.js"></script>


<!-- Custom JS -->
<script src="../assets/js/script.js"></script>
<script>
    function myFunction(x) {
      x.classList.toggle("change");
      $('.navbar-aside').toggleClass('active-d');
    }
    </script>
</body>
</html>