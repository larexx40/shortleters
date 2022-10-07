<?php  
    include "header.php"; 
?>
  <link href="../assets/css/shipment1.css" rel="stylesheet" />
  <title>Package</title>

</head>
<body>

<div id="user" v-cloak>
    <div class="loadingScreen" v-if="loading">
        <div class="fa-5x" style="color: darkolivegreen">
            <i class="fas fa-spinner fa-pulse"></i>
        </div>
    </div>

    <?php include "sidebar_navbar.php"; ?>

    <div class="main">
        <div class="main__inner">
            <div class="row col-12 m-0 align-items-stretch justify-content-evenly justify-content-md-between">
                <div class="p-0 one col-md-7">
                    <div class="inner">
                        <div class="topper">
                            <div class="p-0 col-md-6 one">
                                <div class="chevron"><a href="#"></a></div>
                                <div class="text">
                                    <div class="p">{{refNo}}</div>
                                    <div><small>Status {{order_status}}Processed Jul 7, 2022</small></div>
                                </div>
                            </div>
                        </div>
                        <div class="neck">
                            <div class="text">SHIPMENTS &#x2022; 1</div>
                        </div>
                        <div class="bottom">
                            <div class="row col-12 align-items-center justify-content-between m-0">
                                <div class="image__content p-0 col-md-7">
                                    <div class="image"><img loading='lazy' src="../assets/images/package.jfif" alt="" class="img-fluid"></div>
                                    <div class="content">Item(s): <span v-for ="(order, index) in orders">{{order.quantity}} - {{order.productName}}</span></div>
                                </div>
                                <div class="id p-0 col-md-3"><span>{{track_id}}</span></div>
                                <div class="p-0 col-md-1"><small>{{total_weight}}</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-0 two col-md-4">
                    <div class="inner">
                        <div class="top"><h5>SUMMARY</h5></div>
                        <div class="contain">
                            <div class="contain__inner">
                                <div class="item">
                                    <div class="text">No. of Shipments</div>
                                    <div class="val">1</div>
                                </div>
                                <div class="item">
                                    <div class="text">Total weight</div>
                                    <div class="val">{{total_weight}} lbs</div>
                                </div>
                                <div class="item">
                                    <div class="text">Amount</div>
                                    <div class="val">${{total_paid}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="bottom">
                            <div><h5>PAYMENT</h5></div>
                            <div><a href="">View Receipt</a></div>
                            <div><a href="">Get Help</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>



<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/vue@3"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../vuecode/user.js" ></script>
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