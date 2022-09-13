<?php  
    include "header.php"; 
?>

  <title>Package</title>

</head>
<body>

    <style>
        small{white-space: nowrap;}
        .itemlist span{
            white-space: nowrap;
            }.button.alt:hover {
            color: #000;
            background-color: #f7f7f7;
        }

        .button.alt {
            color: #000;
            background-color: #f2f2f2;
            border-color: #f2f2f2;
        }
    </style>

<div id="user" v-cloak>
    <div class="loadingScreen" v-if="loading">
        <div class="fa-5x" style="color: darkolivegreen">
            <i class="fas fa-spinner fa-pulse"></i>
        </div>
    </div>

    <?php include "sidebar_navbar.php"; ?>
   
    <div class="main">
        
        <div class="main__inner">
            <section class="content-main" style="min-height: 100vh; background-color: white;
            border-radius: 5px;">

                <div class="content-header">
                    <div><button @click.prevent = 'allCart()' id="all" class="active">All</button></div>
                    <div><button @click.prevent ="sortByOrderStatus(6)" id="pend">Pending</button></div>
                    <div><button @click.prevent ="sortByOrderStatus(2)" id="pro">Processed</button></div>
                    <div><button @click.prevent ="sortByOrderStatus(0)" id="pack">Packing</button></div>
                    <div><button @click.prevent ="sortByOrderStatus(3)" id="ship">Shipped</button></div>
                    <div><button @click.prevent ="sortByOrderStatus(5)" id="arr">Arrive</button></div>
                    <div><button @click.prevent ="sortByOrderStatus(4)" id="disp">Dispatch</button></div>
                    <div><button @click.prevent ="sortByOrderStatus(1)" id="deli">Delivered</button></div>
                </div>

                <div class="card mb-4">
                    <header class="card-header">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-3 title col-sm-4 col-8 col-check ">
                                <small>Title</small>
                            </div>
                            <div class="col-lg-2 text-center status col-sm-2 col-4 mb-md-0 mb-3">
                                <small>Status</small>
                            </div>
                            <div class="col-lg-2 text-center tracking col-sm-2 col-4">
                                <small>Tracking #</small>
                            </div>
                            <div class="col-lg-2 text-center weight col-sm-2 col-4">
                            <small>Weight</small>
                            </div>
                            <div class="col-lg-1 amount col-sm-2 col-4">
                            <small>Amount</small>
                            </div>
                            <div class="col-lg-1 empty col-sm-2 col-4">
                            <small></small>
                            </div>
                        </div>
                    </header> <!-- card-header end// -->
                    
                    <!---loop through cart array-->
                    <div class="card-body">
                        <article v-if = 'carts' class="itemlist">
                            <div v-for="(cart, index) in carts" class="row align-items-center justify-content-between">
                                <div class="col-lg-3 col-sm-4 col-8 col-name">
                                    <a class="itemside" href="#">
                                        <div class="left">
                                            <img src="../assets/images/icon-shipment-noimage.svg" class="img-sm img-thumbnail" alt="Item">
                                        </div>
                                        <div class="info">
                                            <h6 class="mb-0"> {{cart.orderRefno}}</h6>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-lg-2 text-center col-sm-2 col-4 col-status">
                                    <span class="">{{cart.orderStatusid}}</span>
                                </div>
                                <div class="col-lg-2 col-sm-2 col-4 col-track-id">
                                    <span>{{cart.trackid}}</span>
                                </div>
                                <div class="col-lg-2 col-sm-2 col-4 col-weight">
                                    <span>{{cart.totalweightlbs}}</span>
                                </div>
                                <div class="col-lg-1 col-sm-2 col-4 col-price"> <span>${{cart.totalPaid}}</span> </div>
                                <div @click.prevent= "redirectOrder('shipment1.php',cart.orderRefno, cart.trackid, index)"  class="col-lg-1 col-sm-12 col-12 p-0 col-action">
                                    <div class="dropdown d-sm-none d-none d-lg-block">
                                        <a href="shipment1.php" class="">
                                            <div class="chevron"></div>
                                        </a>
                                    </div> <!-- dropdown // -->
                                    <a href="shipment1.php" class="button d-sm-block d-md-block d-lg-none block alt view-details" style="margin-top: 10px;">
                                        View Details
                                    </a>
                                </div>
                            </div> <!-- row .// -->
                        </article>  <!-- itemlist  .// -->

                        <article v-else class="itemlist">
                            <div style="justify-content: center !important;"  class="row align-items-center justify-content-between">No cart found</div>
                        </article>

                        <nav aria-label="Page navigation example">
                            <ul v-if ='currentPage > 0' class="pagination justify-content-end">
                                <li v-if="currentPage == 1" class="page-item disabled">
                                    <a class="page-link">Previous</a>
                                </li>
                                <li v-else class="page-item">
                                    <a @click.prevent="previousPage()" class="page-link">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link">{{currentPage}} of {{total_page}}</a></li>
                                <li v-if="currentPage < total_page" class="page-item">
                                    <a v-on:click.prevent="nextPage()" class="page-link">Next</a>
                                </li>
                                <li v-else class="page-item disabled">
                                    <a class="page-link">Next</a>
                                </li>
                            </ul>
                        </nav>
                        
                    </div> <!-- card-body end// -->
                </div> <!-- card end// -->


            </section> <!-- content-main end// -->
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

<script>
    const pend = document.getElementById("pend");
    const all = document.getElementById("all");
    const pro = document.getElementById("pro");
    const pack = document.getElementById("pack");
    const ship = document.getElementById("ship");
    const arr = document.getElementById("arr");
    const disp = document.getElementById("disp");
    const deli = document.getElementById("deli");

    const tags = [pend, all, pro, pack, ship, arr, disp, deli];

    for (let i = 0; i < tags.length; i++){
        tags[i].addEventListener("click", () => {
            if (!tags[i].classList.contains("active")){
                for (let j = 0; j < tags.length; j++){
                    if (tags[j].classList.contains("active")){
                        tags[j].classList.remove("active");
                    }
                }
                tags[i].classList.add("active");
            }
        })
    }

    
</script>


</body>
</html>