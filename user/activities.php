<?php  
    include "./header.php"; 
?>

  <title>Package</title>

</head>
<body>

    <style>
        small{
            white-space: nowrap;
        }
        .itemlist span{
            white-space: nowrap;
        }
        .button.alt:hover {
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

    <?php 
        include "sidebar_navbar.php";
    ?>
        


    <div class="main">
        
        <div class="main__inner">
            <section class="content-main" style="min-height: 100vh; background-color: white;
            border-radius: 5px;">

                <div class="content-header">
                    <h3>Activities</h3>
                </div>

                <div class="card mb-4">
                    <header class="card-header">
                        <div class="row align-items-center justify-content-evenly">
                            <div class="col-lg-2 title col-sm-6 col-6">
                                <small>Activity </small>
                            </div>
                            <div class="col-lg-2   status col-sm-6 col-6 ">
                                <small>Email</small>
                            </div>
                            <div class="col-lg-2   status col-sm-6 col-6 ">
                                <small>Browser</small>
                            </div>
                            <div class="col-lg-2  tracking col-sm-6 col-6">
                                <small>Ip Address</small>
                            </div>
                            <div class="col-lg-2  weight col-sm-6 col-6">
                            <small>Activity Date</small>
                            </div>
                        </div>
                    </header> <!-- card-header end// -->
                    
                    <div class="card-body">
                        <article v-if="activities" v-for="item in activities" class="itemlist">
                            <div class="row align-items-center justify-content-evenly">
                                <div class="col-lg-2 col-sm-6 col-6 col-name">
                                    <a class="itemside" href="#">
                                        <div class="info">
                                            <h6 class="mb-0">{{item.activity}}</h6>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-2 text-center">
                                    <span class="">{{item.email}}</span>
                                </div>
                                
                                <div class="col-lg-2 text-center col-sm-6 col-6 col-status">
                                    <span class="">{{item.browser.split(" ")[0]}}</span>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-6 col-track-id">
                                    <span>{{item.ip}}</span>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-6 col-weight">
                                    <span>{{item.date}}</span>
                                </div>
                            </div>
                            
                            <!-- row .// -->
                        </article>

                        <article v-else class="itemList" >
                            <div style="text-align: center;" class="row align-items-center justify-content-evenly">
                               No Activity Found
                            </div> 
                        </article>
                        
                        <!-- itemlist  .// -->
                        
                    

                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                <li v-if="currentPage == 1" class="page-item disabled">
                                    <a class="page-link">Previous</a>
                                </li>
                                <li v-else class="page-item">
                                    <a @click.prevent="decreasePage()" class="page-link">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link">{{currentPage}} of {{total_page}}</a></li>
                                <li v-if="currentPage < total_page" class="page-item">
                                    <a v-on:click.prevent="increasePage()" class="page-link">Next</a>
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


<script src="https://unpkg.com/vue@3"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../vuecode/user.js" ></script>
<script src="../assets/js/toasteur.min.js"></script>

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