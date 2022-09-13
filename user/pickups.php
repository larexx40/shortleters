<?php  
    include "./header.php"; 
?>

  <title>Package</title>

</head>
<style>
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
    }.card.jumbotron {
        background-color: #f6f6f7;
        border-radius: 4px;
        padding: 25px;
        display: flex;
        flex-direction: inherit !important;
        align-items: center;
        height: 200px;
    }.title{
        font-style: normal;
        line-height: 1.25;
        letter-spacing: normal;
        font-size: 14px;
    }.gap-2{
        margin-left: 20px;
    }small{
        white-space: wrap !important;
    }
</style>
<body>

<div id="user">

    <?php 
        include "sidebar_navbar.php";
    ?>



    <div class="main">
        <div class="main__inner">
            <section class="content-main" style="min-height: 100vh; background-color: white;
            border-radius: 5px;">
                <div class="card mb-4 jumbotron">
                    <div  class="empty-pickup-panel"><div data-v-4be05e11="" class="d-flex justify-content-center align-items-center gap-6 p-6 sm:items-center md:p-8 max-w-screen-sm">
                        <img data-v-4be05e11="" src="https://d3bz3ebxl8svne.cloudfront.net/production/static/svg/empty-order-boxes.svg" alt="info" class="empty-pickup-img"> 
                        <div data-v-4be05e11="" class="flex-1 flex flex-col gap-2"><h3 class="title font-light">
                        You don't have any shipments ready for pickup
                    </h3> <small class="color-grey subtitle max-w-md" >
                        Once your package arrives our Lagos facilitiy and it's ready to be picked up, they'll appear here!
                    </small></div></div></div>
                </div> <!-- card end// -->
            <header class="card-header">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-3 title col-sm-4 col-8 col-check ">
                                <small>Title</small>
                            </div>
                            <div class="col-lg-2 text-center status col-sm-2 col-4 mb-md-0 ">
                                <small>Status</small>
                            </div>
                            <div class="col-lg-2 text-center tracking col-sm-2 col-4">
                                <small>Tracking #</small>
                            </div>
                            <div class="col-lg-2 text-center weight col-sm-2 col-4">
                            <small>Weight</small>
                            </div>
                            <div class="col-lg-1 text-center amount col-sm-2 col-4">
                            <small>Amount</small>
                            </div>
                            <div class="col-lg-1 empty col-sm-2 col-4">
                            <small></small>
                            </div>
                        </div>
                    </header> <!-- card-header end// -->
                    
            <div class="card-body">
                        <article class="itemlist">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-lg-3 col-sm-4 col-6 col-name">
                                    <a class="itemside" href="#">
                                        <div class="info">
                                            <h6 class="mb-0">202207079KK27</h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 text-center col-sm-2 col-6 col-status">
                                    <span class="">Jul 7, 2022 4:08 PM</span>
                                </div>
                                <div class="col-lg-2 col-sm-2 col-4 col-price"> <span>$70</span> </div>
                                <div class="col-lg-2 col-sm-2 col-4 col-track-id">
                                    <span>PAID</span>
                                </div>
                                <div class="col-lg-1 col-sm-12 col-12 p-0 col-action">
                                    <div class="dropdown d-sm-none d-none d-lg-block">
                                        <a href="shipment2.php" class="">
                                            <div class="chevron"></div>
                                        </a>
                                    </div> <!-- dropdown // -->
                                    <a href="shipment2.php" class="button d-sm-block d-md-block d-lg-none block alt view-details" style="margin-top: 10px;">
                                        View Details
                                    </a>
                                </div>
                            </div> <!-- row .// -->
                        </article>  <!-- itemlist  .// -->
                    <article class="itemlist">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-lg-3 col-sm-4 col-6 col-name">
                                    <a class="itemside" href="#">
                                        <div class="info">
                                            <h6 class="mb-0">202207079KK27</h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 text-center col-sm-2 col-6 col-status">
                                    <span class="">Jul 7, 2022 4:08 PM</span>
                                </div>
                                <div class="col-lg-2 col-sm-2 col-4 col-price"> <span>$70</span> </div>
                                <div class="col-lg-2 col-sm-2 col-4 col-track-id">
                                    <span>PAID</span>
                                </div>
                                <div class="col-lg-1 col-sm-12 col-12 p-0 col-action">
                                    <div class="dropdown d-sm-none d-none d-lg-block">
                                        <a href="shipment2.php" class="">
                                            <div class="chevron"></div>
                                        </a>
                                    </div> <!-- dropdown // -->
                                    <a href="shipment2.php" class="button d-sm-block d-md-block d-lg-none block alt view-details" style="margin-top: 10px;">
                                        View Details
                                    </a>
                                </div>
                            </div> <!-- row .// -->
                        </article>  <!-- itemlist  .// -->
                        <article class="itemlist">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-lg-3 col-sm-4 col-6 col-name">
                                    <a class="itemside" href="#">
                                        <div class="info">
                                            <h6 class="mb-0">202207079KK27</h6>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 text-center col-sm-2 col-6 col-status">
                                    <span class="">Jul 7, 2022 4:08 PM</span>
                                </div>
                                <div class="col-lg-2 col-sm-2 col-4 col-price"> <span>$70</span> </div>
                                <div class="col-lg-2 col-sm-2 col-4 col-track-id">
                                    <span>PAID</span>
                                </div>
                                <div class="col-lg-1 col-sm-12 col-12 p-0 col-action">
                                    <div class="dropdown d-sm-none d-none d-lg-block">
                                        <a href="shipment2.php" class="">
                                            <div class="chevron"></div>
                                        </a>
                                    </div> <!-- dropdown // -->
                                    <a href="shipment2.php" class="button d-sm-block d-md-block d-lg-none block alt view-details" style="margin-top: 10px;">
                                        View Details
                                    </a>
                                </div>
                            </div> <!-- row .// -->
                        </article>  <!-- itemlist  .// -->
                        <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled">
                            <a class="page-link">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                        </nav>
                    </div> <!-- card-body end// -->
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