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

                <div class="content-header" style="display:flex;justify-content:space-between;">
                    <h3>Address</h3>
                    <div class="popup">
                        <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal3"> <em class="bi bi-plus" style="font-size:24px;"></em> </button>
                    </div>
                </div>
                <div class="modal fade " id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delivery Address</h5>
                                                </div>
                                                <div class="modal-body">
                                                <form action="" @submit.prevent='addDeliveryAddress()' class="personal__info">
                                                    <div class="each__form">
                                                        <label class="form-label">Full Name</label>
                                                        <input type="text"   v-model="fullname" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="each__form">
                                                        <label class="form-label">Address</label>
                                                        <input type="text"  v-model="address" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="each__form">
                                                        <label class="form-label">Address No</label>
                                                        <input type="text"  v-model="addressno" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="each__form">
                                                        <label class="form-label">Phone number</label>
                                                        <input type="text"  v-model="phoneno" class="form-control" placeholder="eg. 2349073734025">
                                                    </div>
                                                    <div class="each__form">
                                                        <label class="form-label">LGA</label>
                                                        <input type="text"  v-model="lga" class="form-control">
                                                    </div>
                                                    <div class="each__form">
                                                        <label class="form-label">State</label>
                                                        <input type="text"  v-model="state" class="form-control">
                                                    </div>
                                                    <div class="each__form">
                                                        <label class="form-label">Zip Code</label>
                                                        <input type="text"  v-model="zipcode" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="each__form">
                                                        <label class="form-label">Country</label>
                                                        <input type="text"  v-model="country" class="form-control">
                                                    </div>
                                                    <div class="each__form proceed">
                                                        <button type="submit">Submit</button>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="button" class="" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                    <header class="card-header">
                        <div class="row align-items-center justify-content-evenly">
                            <div class="col-lg-4  title col-sm-4 col-6 ">
                                <small>Address </small>
                            </div>
                            <div class="col-lg-1 status col-sm-2 col-6 mb-md-0 ">
                                <small>View</small>
                            </div>
                            <div class="col-lg-1  tracking col-sm-2 col-6">
                                <small>Edit</small>
                            </div>
                            <div class="col-lg-1 weight col-sm-2 col-6">
                                <small>Delete</small>
                            </div>
                            <div class="col-lg-2 weight col-sm-2 col-6">
                                <small>Default Address</small>
                            </div>
                        </div>
                    </header> <!-- card-header end// -->
                    
                    <div class="card-body">
                        <article v-if= 'addresses' v-for= "(address, index) in addresses" class="itemlist" >
                            <div class="row align-items-center justify-content-evenly">
                                <div class="col-lg-4 col-sm-4 col-7 col-name">
                                    <a class="itemside" href="#">
                                        <div class="info">
                                            <h6 class="mb-0">{{address.addressno}}, {{address.address}}</h6>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-lg-1 col-sm-2 col-5 col-status">
                                    <span class="" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal4" @click='display(address.id)'>View</span>
                                </div>
                                
                                <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <small>Address Information</small>
                                            </div>

                                            <div class="modal-body">
                                                <div class="body">
                                                    <div class="each__activity one" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>Address: </p>
                                                                </div>
                                                            </div>
                                                            <div v-if="address_details"><h6>{{address_details.addressno}}, {{address_details.address}}</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="each__activity one" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>FULL NAME</p>
                                                                </div>
                                                            </div>
                                                            <div v-if="address_details"><h6>{{address_details.fullname}}</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="each__activity two" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>LGA</p>
                                                                </div>
                                                            </div>
                                                            <div v-if="address_details"><h6>{{address_details.lga}}</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="each__activity one" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>PHONE NUMBER</p>
                                                                </div>
                                                            </div>
                                                            <div v-if="address_details"><h6>{{address_details.phoneno}}</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="each__activity one" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>ZIP CODE</p>
                                                                </div>
                                                            </div>
                                                            <div v-if="address_details"><h6>{{address_details.zipcode}}</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="each__activity two" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>COUNTRY</p>
                                                                </div>
                                                            </div>
                                                            <div><h6 v-if="address_details">{{address_details.country}}</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="each__activity two" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>ADDRESS NO</p>
                                                                </div>
                                                            </div>
                                                            <div v-if="address_details"><h6>{{address_details.addressno}}</h6></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                <div @click='display(address.id)' class="col-lg-1 col-sm-2 col-6 col-track-id">
                                    <span class="pointer" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i class="bi bi-pencil-square" ></i> Edit</span>
                                </div>
                                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3>Update Address </h3>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" @submit.prevent='updateAddress(address_details)' class="personal__info">
                                                    <div class="each__form">
                                                        <label class="form-label">Full Name</label>
                                                        <input type="text"  v-if='address_details' v-model="address_details.fullname" class="form-control" placeholder="">
                                                        <input type="text"  v-else class="form-control" placeholder="">
                                                    </div>
                                                    <div class="each__form">
                                                        <label class="form-label">Address: </label>
                                                        <input type="text" v-if='address_details' v-model="address_details.address" class="form-control" placeholder="">
                                                        <input type="text"  v-else class="form-control" placeholder="">
                                                    </div>
                                                    <div class="each__form">
                                                        <label class="form-label">Address No</label>
                                                        <input type="text" v-if='address_details' v-model="address_details.addressno" class="form-control" placeholder="">
                                                        <input type="text"  v-else class="form-control" placeholder="">
                                                    </div>
                                                    <div class="each__form">
                                                        <label class="form-label">Phone number</label>
                                                        <input type="text" v-if='address_details' v-model="address_details.phoneno" class="form-control" placeholder="eg. 2349073734025">
                                                        <input type="text"  v-else class="form-control" placeholder="">
                                                    </div>
                                                    <div class="each__form">
                                                        <label class="form-label">Zip Code</label>
                                                        <input type="text" v-if='address_details' v-model="address_details.zipcode" class="form-control" placeholder="">
                                                        <input type="text"  v-else class="form-control" placeholder="">
                                                    </div>
                                                    <div class="each__form">
                                                        <label class="form-label">State</label>
                                                        <input type="text" v-if='address_details' v-model="address_details.state" class="form-control">
                                                        <input type="text"  v-else class="form-control" placeholder="">
                                                    </div>
                                                    <div class="each__form">
                                                        <label class="form-label">Country</label>
                                                        <input type="text" v-if='address_details' v-model="address_details.country" class="form-control">
                                                        <input type="text"  v-else class="form-control" placeholder="">
                                                    </div>
                                                    <div class="each__form proceed">
                                                        <button data-bs-dismiss="modal" type="submit">Submit</button>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="button" class="" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div @click='deleteDeliveryAddress(address.id)' class="col-lg-1 col-sm-2 col-6 col-weight">
                                    <span class="pointer" ><i class="bi bi-trash-fill"></i> Delete </span>
                                </div>
                                <div v-if='address.defultaddress > 0' class="col-lg-1 col-sm-2 col-6 col-weight">
                                    <button class="pointer btn"><i class="bi"></i> Default  </button>
                                </div>
                                <div v-if='address.defultaddress < 1' class="col-lg-1 col-sm-2 col-7 col-weight">
                                    <button @click="setDefaultAddress(address.id)" style="width: max-content; background-color: var(--bs-success) ;" class="pointer btn">Set As Default </button>
                                </div>
                            </div> <!-- row .// -->
                        </article>  <!-- itemlist  .// -->

                        <article v-else class="itemlist" >
                            <div class="row align-items-center justify-content-evenly">No address found</div>
                        </article>
                        
                    

                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
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


<script src="https://unpkg.com/vue@3"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../vuecode/user.js" ></script>
<script src="../assets/js/toasteur.min.js"></script>




<!-- Custom JS -->
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