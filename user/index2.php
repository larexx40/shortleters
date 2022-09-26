<?php  
    include "./header.php"; 
?>

  
  <title>Home</title>

</head>
<body>
<style>
    form-floating > .form-control:focus, .form-floating > .form-control:not(:placeholder-shown) {
    padding-top: 1rem;
}
.form-floating > .form-control:focus ~ label, .form-floating > .form-control:not(:placeholder-shown) ~ label, .form-floating > .form-select ~ label {
    opacity: 1;
    transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    color: black;
    background-color: #f1c34e;
    border-radius: 2rem;
    height: 20px;
    padding: 0 17px;
    font-size: 13px;
}.form-control:focus, select:focus {
    color: #212529;
    background-color: #fff;
    border: 1px solid #f1c34e !important; 
    outline: 0;
    box-shadow: none !important;
}.form-input:focus-within {
    border: 1px solid #f1c34e;
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
            <div class="main__body">
                <div class="main__body__inner">
                <div class="row col-12 m-0 align-items-start justify-content-evenly">
                        <div class="col-xl-8 section__one ps-0">
                            <div class="section__inner">
                                <div class="top">
                                    <div class="top__inner">
                                        <h4 v-if="user_detais">Welcome, {{user_detais.Firstname}}</h4>
                                    </div>
                                </div>
        
                                <div class="middle">
                                    <div class="middle__top">
                                        <div class=""><p>USER DETAILS </p></div>
                                        <div class="chevron"></div>
                                    </div>
                                    
                                </div>
        
                                <div class="form__section">
                                    <div class="neck">
                                        <p>Use the information below as your shipping address when shopping online. We'll receive and process the package in your name.</p>
                                    </div><br>
                                    <form action="">
                                        <div class="mb-3">
                                            <label for="formGroupExampleInput" class="form-label">FULL NAME</label>
                                            <input type="text" v-if='user_detais' v-model="user_detais.fullname" class="form-control" id="formGroupExampleInput">
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">EMAIL </label>
                                                <input type="email" v-if='user_detais' v-model="user_detais.Email" readonly class="form-control" id="address-one">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="address-two" class="form-label">USERNAME</label>
                                                <input v-if='user_detais' v-model="user_detais.Username" type="text" readonly  class="form-control" id="address-two">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="zip" class="form-label">GENDER</label>
                                                <input type="text" v-if='user_detais' v-model="user_detais.sex" class="form-control" id="zip">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">PHONE NUMBER</label>
                                                <input type="text" v-if='user_detais' v-model="user_detais.phone" readonly  class="form-control" id="phone">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="address-one" class="form-label">ADDRESSS LINE 1</label>
                                                <input type="email" v-if='user_detais' v-model="user_detais.Addressno" readonly class="form-control" id="address-one">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="address-two" class="form-label">ADDRESSS LINE 2</label>
                                                <input type="text" v-if='user_detais' v-model="user_detais.Address" readonly  class="form-control" id="address-two">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="state/province/region" class="form-label">STATE/PROVINCE/REGION</label>
                                                <input type="text" v-if='user_detais' v-model="user_detais.State" readonly  class="form-control" id="state/province/region">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="country" class="form-label">COUNTRY</label>
                                                <input type="text" v-if='user_detais' v-model="user_detais.Country" readonly  class="form-control" id="country">
                                            </div>
                                            
                                            
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="middle">
                                    <div class="middle__top">
                                        <div class=""><p>DELIVERY ADDRESS</p></div>
                                        <div class="chevron"></div>
                                    </div>
                                    
                                </div>
        
                                <div class="form__section">
                                    <div class="neck">
                                        <p>Use the information below as your shipping address when shopping online. We'll receive and process the package in your name.</p>
                                    </div><br>
                                    <form action="">
                                        
                                        <div class="mb-3">
                                            <div class="col-md-12">
                                                <label for="state/province/region" class="form-label d-flex justify-content-between" ><span> Default Address</span> <a href="address.php">Update address</a></label>
                                                <input type="text" v-if='defaultAddress' v-model='defaultAddress.address' readonly  class="form-control" id="state/province/region">
                                            </div>
                                        </div>
                                        <div class="modal fade " id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delivery Address</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" class="personal__info">
                                                        <div class="each__form">
                                                            <label class="form-label">Full Name</label>
                                                            <input type="text" class="form-control" placeholder="">
                                                        </div>
                                                        <br>
                                                        <div class="each__form">
                                                            <label class="form-label">Address</label>
                                                            <input type="text"   class="form-control" placeholder="">
                                                        </div>
                                                        <br>
                                                        <div class="each__form">
                                                            <label class="form-label">Address No</label>
                                                            <input type="text" class="form-control" placeholder="">
                                                        </div>
                                                        <br>
                                                        <div class="each__form">
                                                            <label class="form-label">Email address</label>
                                                            <input type="email" class="form-control" placeholder="">
                                                        </div>
                                                        <br>
                                                        <div class="each__form">
                                                            <label class="form-label">Phone number</label>
                                                            <input type="text"  class="form-control" placeholder="eg. 2349073734025">
                                                        </div>
                                                        <br>
                                                        <div class="each__form">
                                                            <label class="form-label">Zip Code</label>
                                                            <input type="text"  class="form-control" placeholder="">
                                                        </div>
                                                        <br>
                                                        <div class="each__form">
                                                            <label class="form-label">State</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <br>
                                                        <div class="each__form">
                                                            <label class="form-label">Country</label>
                                                            <input type="text"  class="form-control">
                                                        </div>
                                                        <br>
                                                        <div class="each__form proceed">
                                                            <button type="submit">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="zip" class="form-label">FULL NAME</label>
                                                <input type="text" v-if='defaultAddress' v-model='defaultAddress.recipient_fullname' readonly class="form-control" id="zip">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">LGA </label>
                                                <input type="email" v-if='defaultAddress' v-model='defaultAddress.lga' readonly class="form-control" id="address-one">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="address-two" class="form-label">PHONE NUMBER</label>
                                                <input type="text" v-if='defaultAddress' v-model='defaultAddress.phone' readonly class="form-control" id="address-two">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">STATE</label>
                                                <input type="text" v-if='defaultAddress' v-model='defaultAddress.address_state' readonly class="form-control" id="phone">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="address-one" class="form-label">ZIP CODE</label>
                                                <input type="email" v-if='defaultAddress' v-model='defaultAddress.zipCode' readonly class="form-control" id="address-one">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="address-two" class="form-label">COUNTRY</label>
                                                <input type="text" v-if='defaultAddress' v-model='defaultAddress.address_country' readonly  class="form-control" id="address-two">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="state/province/region" class="form-label">ADDRESS NO</label>
                                                <input type="text" v-if='defaultAddress' v-model='defaultAddress.addressno' readonly  class="form-control" id="state/province/region">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="country" class="form-label">ADDRESS</label>
                                                <input type="text" v-if='defaultAddress' v-model='defaultAddress.address' readonly  class="form-control" id="country">
                                            </div>
                                            
                                            
                                        </div>
                                    </form>
                                </div>

                                <div class="promotion">
                                    <div class="promotion__inner">
                                        <div class="header">
                                            <div class="text">PROMOTION</div>
                                        </div>
                                        <div class="link">
                                            <a href="promotion.php">
                                            <div class="row col-12 m-0 align-items-center">
                                                <div class="p col-9 p-0">Get up to $5 by inviting friends to ship with Heroshe. Receive cashback on your next payment.</div>
                                                <div class="image col-3 text-center p-0">
                                                    <img src="../assets/images/icon-promotions-bullhorn.svg" alt="">
                                                    <div class="chevron"></div>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="resources">
                                    <div class="resources__inner">
                                        <div class="header">
                                            <div class="text">HELPFUL RESOURCES</div>
                                            <div class="chevron"></div>
                                        </div>
                                        <div class="link row col-12 m-0 align-items-center justify-content-evenly">
                                            <div class="col-md-6">
                                                <a href="">
                                                <div class="topper">
                                                    <div class="text">How to use US address</div>
                                                    <div class="chevron"></div>
                                                </div>
                                                <div class="row bottom col-12 align-items-center">
                                                    <div class="image col-4 text-center p-0">
                                                        <img src="../assets/images/icon-locate-on-map.svg" alt="">
                                                    </div>
                                                    <div class="p col-8 p-0">Get answers to questions people commonly ask about Heroshe</div>
                                                </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="">
                                                <div class="topper">
                                                    <div class="text">Crating and fragile items</div>
                                                    <div class="chevron"></div>
                                                </div>
                                                <div class="row bottom col-12 align-items-center">
                                                    <div class="image col-4 text-center p-0">
                                                        <img src="../assets/images/icon-crate.svg" alt="">
                                                    </div>
                                                    <div class="p col-8 p-0">You can choose to add extra protection to your fragile items</div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 section__two pe-0">
                            <div class="section__inner">
                                <div class="top" style="display: flex;align-items: center;justify-content: space-between;">
                                    <div>
                                        <div>
                                            <div class="p">WALLET BALANCE</div>
                                                <div class="h1"><h1>&#x24;{{total_wallet_balance}}</h1></div>
                                            </div>
                                            <div class="popup">
                                                <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <em class="bi bi-plus"></em>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div>
                                            <div>
                                                <div class="p">Naira BALANCE</div>
                                                    <div class="h1"><h1 v-if="user_detais">&#x24;{{user_detais.balance}}</h1></div>
                                                </div>
                                                <div class="popup">
                                                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        <em class="bi bi-plus"></em>
                                                    </button>
                                                </div>
                                            </div>
                                    </div>


                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <small>How do you to add to your wallet?</small>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="">
                                                        <div class="form__section">
                                                            <div class="row g-3">
                                                                <div class="country">
                                                                    <img src="../assets/images/icon-ng-flag.svg" alt="">
                                                                    <small>&nbsp;NGN</small>
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" class="form-control" name="" id="" placeholder="0">
                                                                </div>
                                                                <div class="col-12 label text-end">
                                                                    <small>&#x24;0.00 at N610 to &#x24;1</small>
                                                                </div>
                                                            </div>
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


                                    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <small>How do you to add to your wallet?</small>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="">
                                                        <div class="form__section">
                                                            <div class="row g-3">
                                                                <div class="country">
                                                                    <img src="../assets/images/icon-ng-flag.svg" alt="">
                                                                    <small>&nbsp;NGN</small>
                                                                </div>
                                                                <div class="col">
                                                                    <input type="text" class="form-control" name="" id="" placeholder="0">
                                                                </div>
                                                                <div class="col-12 label text-end">
                                                                    <small>&#x24;0.00 at N610 to &#x24;1</small>
                                                                </div>
                                                            </div>
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
                                </div>
                                
                                <div class="middle">
                                    <div><strong>SHIPPING PRICE CALCULATOR</strong></div>
                                    <div class="shipping__calculator">
                                        <div class="form-floating mb-3">
                                            <input type="number" v-model='weight' @change='calculatePrice(3)' class="form-control" id="floatingInput" placeholder="name@example.com">
                                            <label for="floatingInput">Weight of your shipment in lbs</label>
                                            <small class="color-grey-dark text-sm">Shipping rate at &#x24;5 per lbs</small>
                                        </div>
                                        <br>
                                        <div class="form-floating">
                                            <select class="form-select" @change='fetchLocation' v-model='selectedLogistics' v-if="logistics" id="floatingSelect" aria-label="Floating label select example">
                                                <option default value="">Select Available Logistics</option>
                                                <option v-for="value in logistics" v-bind:value="value.id">{{value.name}}</option>
                                            </select>

                                            <select class="form-select" disabled v-else id="floatingSelect" aria-label="Floating label select example">
                                                <option value="">No Logistics Available</option>
                                            </select>
                                            <label for="floatingSelect">Available Logistics Company</label>
                                            <small class="color-grey-dark text-sm">+$10 for delivery</small>
                                        </div>
                                        <br>
                                        <div class="form-floating">
                                            <select class="form-select" @change='calculatePrice(3)' v-model='selectedLocation' v-if="locations" id="floatingSelect" aria-label="Floating label select example">
                                                <option default value="">Select Available Location</option>  
                                                <option v-for="value in locations" v-bind:value="value.id">{{value.locationName}}</option>
                                            </select>

                                            <select class="form-select" disabled v-else id="floatingSelect" aria-label="Floating label select example">
                                                <option value="">No Available Pickup Location</option>
                                            </select>
                                            <label for="floatingSelect">Logistics Company Locations</label>
                                        </div>
                                        <br>
                                        <div class="form-floating">
                                            <select class="form-select" v-if='addresses' v-model="shipping_address" id="floatingSelect" aria-label="Floating label select example">
                                                <option value="">Select Pickup Address</option>
                                                <option v-for="item in addresses" v-bind:value="item.id">{{item.addressno}}, {{item.address}} - {{item.state}}</option>
                                            </select>

                                            <select class="form-select" disabled v-else id="floatingSelect" aria-label="Floating label select example">
                                                <option value="">Kindly Add a Pickup Address</option>
                                            </select>
                                            <label for="floatingSelect">Your Addresses</label>
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <label for="city" class="form-label">Total to Pay</label>
                                            <input type="text" v-model="price" readonly class="form-control bbb" id="city">
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="preference">
                                    <div><strong>PREFERENCES</strong></div>
                                    <div class="preference__inner">
                                        <div clas="each__div" style="margin-bottom: 30px;">
                                            <div class="color-grey-dark text-sm span"><small>Currency</small></div>
                                            <div class="row m-0">
                                                <select class="form-select" aria-label="Default select example">
                                                <option selected>Open this select menu</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <div clas="each__div">
                                            <div  class="color-grey-dark text-sm span"><small>Time Zones</small></div>
                                            <div class="row m-0">
                                                <select class="form-select" aria-label="Default select example">
                                                <option selected>Open this select menu</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div clas="each__div">
                                            <div class="color-grey-dark text-sm span"><p>Heroshe Beta Program</p></div>
                                            <div class="toggler d-flex">
                                                <div><small style="font-size: 0.875rem;
                                                    line-height: 1.25rem;">Experience Heroshe's new experimental features before they are made publicly available</small></div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
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


<script src="https://unpkg.com/vue@3"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../vuecode/user.js" ></script>
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
    $('.middle').on('click', function(){
        $(this).next().slideToggle();
    });
    </script>
</body>
</html>