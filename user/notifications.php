<?php  
    include "./header.php"; 
?>

  <title>Package</title>

</head>
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
<body>

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
                    <h3>Notifications</h3>
                </div>

                <div class="card mb-4">
                    <header class="card-header">
                        <div class="row align-items-center justify-content-evenly">
                            <div class="col-lg-3 title col-sm-4 col-6 ">
                                <small>Text </small>
                            </div>
                            <div class="col-lg-2  status col-sm-2 col-6">
                                <small>Type</small>
                            </div>
                            <div class="col-lg-2  tracking col-sm-2 col-6">
                                <small>Status</small>
                            </div>
                            <div class="col-lg-2  weight col-sm-2 col-6">
                            <small>Date</small>
                            </div>
                        </div>
                    </header> <!-- card-header end// -->
                    
                    <div class="card-body">
                        <article v-if="notifications" v-for="item in notifications" class="itemlist">
                            <div class="row align-items-center justify-content-evenly">
                                <div class="col-lg-3 col-sm-4 col-8 col-name">
                                    <a class="itemside" href="#">
                                        <div class="info">
                                            <h6 class="mb-0">{{item.text}}</h6>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-lg-2 text-center col-sm-2 col-4 col-status">
                                    <span class="">{{item.type}}</span>
                                </div>
                                <div class="col-lg-2 col-sm-2 col-6 col-track-id">
                                    <span>{{item.read_status}}</span>
                                </div>
                                <div class="col-lg-2 col-sm-2 col-6 col-weight">
                                    <span style="white-space: initial !important;">{{item.date}}</span>
                                </div>
                            </div> <!-- row .// -->
                        </article>

                        <article v-else>
                            <div style="text-align: center;">No Notifications</div>
                        </article>
                        
                        <!-- itemlist  .// -->
                        
                    

                        <nav v-if="notifications" aria-label="Page navigation example">
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

                        <nav v-else></nav>

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
</body>
</html>