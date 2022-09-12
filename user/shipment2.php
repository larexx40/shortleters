<?php  
    include "header.php"; 
?>
<link href="../assets/css/shipment2.css" rel="stylesheet" />
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
                <div class="topper">
                    <div class="row col-12 m-0 align-items-center justify-content-lg-between">
                        <div class="p-0 col-md-6 one">
                            <div class="chevron"><a href="#"></a></div>
                            <div class="text">Shipment<span> > Details</span></div>
                        </div>
                        <div class="p-0 col-md-6 two text-start text-md-end">
                            <div  class="me-4"><span>{{track_id}}</span></div>
                            <div><em class="bi bi-clipboard"></em></div>
                        </div>
                    </div>
                </div>
                <div class="neck">
                    <div class="container p-0">
                        <div class="neck__inner">
                            <div class="image text-center">
                                <img src="../assets/images/heroshe-logo.svg" alt="" class="img-fluid">
                                <span>On it's way</span>
                            </div>
                            <div class="plane text-center">
                                <img src="../assets/images/icon-shipped-illustration.svg" alt="">
                            </div>
                            <div class="process">
                                <div class="text pro">PROCESSED <div class="span"></div></div>
                                <div class="btw"></div>
                                <div class="text dev"><div class="span"></div>DELIVERED</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section_one col-md-8">
                    <div class="section_inner">
                        <div class="top">
                            <div class="text">Latest Update</div>
                        </div>
                        
                        <div class="neck">
                            <h5>{{order_status}}</h5>
                            <div v-if="order_status === 'Dispatched'" class="p">Shipment has been dispatched and headed to your delivery address</div>
                            <div v-else-if="order_status === 'Shipped'" class="p">Shipment has been shipped and headed to Lagos, Nigeria</div>
                            <div v-else-if="order_status === 'Arrived'" class="p">Shipment has been Arrived Lagos, Nigeria, awaiting collection</div>
                            <div v-else-if="order_status === 'Processed'" class="p"> Package has been received and processed at the warehouse </div>
                            <div v-else-if="order_status === 'Delivered'" class="p">Shipment has been delivered to your address</div>
                            <div v-else-if="order_status === 'Packing'" class="p">Shipment has been paid for and ready for outbound ship out</div>
                            <div v-else-if="order_status === 'Pending'" class="p">Shipment is Pending awaiting approval</div>
                        </div>
                        <div class="bottom">
                            <div class="date">Thursday, 07 July 2022</div>
                            <div class="jump"><a href="#tracking_history">Jump to tracking history</a></div>
                        </div>
                    </div>
                </div>

                <div class="section_two col-md-8 mx-auto">
                    <div class="section_inner">
                        <div class="row col-12 m-0 align-items-stretch justify-content-between">
                            <div class="p-0 col-md-6">
                                <div class="top"><h6>Details</h6></div>
                                <div class="body">Item(s): <span v-for ="(order, index) in orders">{{order.quantity}} - {{order.productName}}</span>  | Store(S): Amazon | Other Info: N/A | Other Tracking Number(S): N/A</div>
                                <!-- <div class="val">{{order.weight}} lbs</div> -->
                            </div>
                            <div class="p-0 col-md-6">
                                <div class="top"><h6>Home Delivery Address</h6></div>
                                <div class="body">
                                    <div v-if="defaultAddress">{{defaultAddress.fullname}}</div>
                                    <div v-if="defaultAddress">{{defaultAddress.addressno}}. {{defaultAddress.address}}</div>
                                    <div v-if="defaultAddress">{{defaultAddress.state}}, {{defaultAddress.country}}</div>
                                </div>
                                <div v-if="defaultAddress" class="val">{{defaultAddress.phoneno}}</div>

                                <div v-if="!defaultAddress">Kindly Add Your Default Delivery Address</div>

                                </div>
                            </div>
                        </div>
                        <div class="images">
                            <div><img src="../assets/images/package.jfif" alt="" class="img-fluid"></div>
                            <div><img src="../assets/images/package.jfif" alt="" class="img-fluid"></div>
                            <div><img src="../assets/images/package.jfif" alt="" class="img-fluid"></div>
                        </div>
                    </div>
                </div>

                <div id= 'tracking_history' class="section_three col-md-8 mx-auto">
                    <div class="section_inner">
                        <div class="top"><span>Tracking history</span></div>
                        <div class="date__shipment">
                            <div class="date"><span>06 Jul, 2022</span><br><small>11:52 PM</small></div>
                            <div class="span one"></div>
                            <div class="shipment">
                                <span>SHIPPED</span><br><small>Shipment has been shipped and headed to Lagos, Nigeria</small>
                            </div>
                        </div>
                        <div class="date__shipment">
                            <div class="date"><span>06 Jul, 2022</span><br><small>11:52 PM</small></div>
                            <div class="span"></div>
                            <div class="shipment">
                                <span>PACKING</span><br><small>Shipment has been paid for and ready for outbound ship out</small>
                            </div>
                        </div>
                        <div class="date__shipment">
                            <div class="date"><span>06 Jul, 2022</span><br><small>11:52 PM</small></div>
                            <div class="span"></div>
                            <div class="shipment">
                                <span>PROCESSED</span><br><small>Package has been received and processed at the warehouse</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact__help col-md-8 mx-auto">
                    <div class="contact__help__inner">
                        <div class="container text-center">
                            <div class="top"><h4>Need Help</h4></div>
                            <div><span>We are here to help. Our team is happy to answer any questions.</span></div>
                            <div class="row col-12 m-0 justify-content-evenly text-md-center">
                                <div class="col-md-6">
                                    <div class="image">
                                        <div><img src="../assets/images/chat-icon.svg" alt=""></div>
                                        <div class="link chat"><a href="">Chat with us</a></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="image">
                                        <div><img src="../assets/images/email-icon.svg" alt=""></div>
                                        <div class="link email"><a href="">Email us</a></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="image">
                                        <div> <img src="../assets/images/call-icon.svg" alt=""></div>
                                        <div class="link call"><a href="">Call us</a></div>
                                    </div>
                                </div>
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