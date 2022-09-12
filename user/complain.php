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
        .pointer{
            cursor:pointer;
        }
        .button.alt {
            color: #000;
            background-color: #f2f2f2;
            border-color: #f2f2f2;
        }.content-header button {
            border: none;
            font-size: 14px;
            padding: 4px 1rem;
            border-radius: 4px;
        }.each__form{
            width:100%;
            margin-bottom:15px;
            
        }
        .form-control:focus {
            box-shadow: none !important;
        }
        .each__form input, .each__form select{
            outline: 1px solid #979797;
            
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

                <div class="content-header" style="display:flex;justify-content:space-between;">
                    <h3>Complains</h3>
                    <div class="popup">
                        <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal"> <em class="bi bi-plus" style="font-size:24px;"></em> </button>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3>Make New Complaint </h3>
                                            </div>
                                            <div class="modal-body">
                                                <form @submit.prevent="makeComplain">
                                                    <div class="row col-12 m-0">
                                                        
                                                        <div class="each__form">
                                                            <label>Complaint</label>
                                                            <textarea v-model="complain" class="form-control" id="exampleFormControlInput1" style="min-height:200px"></textarea>
                                                        </div><br>
                                                    </div>
                                                        
                                                    <div class="row col-12 m-0">
                                                        <div class="col-12 proceed">
                                                            <button type="submit">Proceed</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer cancel row col-12 m-0">
                                                <div class="col-12">
                                                    <button type="button" class="" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-All-tab" @click='removeSort()' data-bs-toggle="pill" data-bs-target="#pills-All" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-home-tab" @click='setPending()' data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Pending</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab"  @click='setActive()' data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Resolved</button>
                    </li>
                </ul>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Complain</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Status</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>

                    <tbody v-if="complains">
    
                        <tr v-for="(each, index) in complains" >
                            <th scope="row">{{each.complain}}</th>
                            <td>{{each.date}}</td>
                            <td>{{each.status}}</td>
                            <td @click="getComplain(index)" data-bs-toggle="modal" data-bs-target="#exampleModal2">View</td>
                        </tr>
                    </tbody>

                    <tbody v-if='!complains'>
                        <tr>
                            <td>No Complains</td>
                        </tr>
                    </tbody>
                </table>

                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3>View Complaint </h3>
                                    </div>
                                    <div class="modal-body">
                                        <form action="">
                                            <div class="row col-12 m-0">
                                                
                                                <div class="each__form">
                                                    <label>Complaint</label>
                                                    <textarea v-if="each_complain" v-model="each_complain.complain" class="form-control" id="exampleFormControlInput1" style="min-height:200px"></textarea>
                                                </div><br>
                                            </div>
                                                
                                        </form>
                                    </div>
                                    <div class="modal-footer cancel row col-12 m-0">
                                        <div class="col-12">
                                            <button type="button" class="" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                
                        
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

                    </div> <!-- card-body end// -->       </div> <!-- card-body end// -->
                        </div>
                </div>
            </div>
                <!-- card end// -->


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