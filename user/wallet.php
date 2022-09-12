<?php  
    include "./header.php"; 
?>

  <title>Package</title>

</head>
<style>
        .popup button{
            border: 1px solid var(--border-dark);
        padding: 1px 8px;
        background-color: var(--white);
        border-radius: 3px;
        }.flex_it{
            display:flex;
            align-items:center;
            justify-content:space-between;
        }.each__inner__activity .flow {
        margin-right: 0.5rem;
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

    <?php
        include "sidebar_navbar.php";
    ?>

    <div class="loadingScreen" v-if="loading">
        <div class="fa-5x" style="color: darkolivegreen">
            <i class="fas fa-spinner fa-pulse"></i>
        </div>
    </div>


    <div class="main">
        <div class="main__inner">
            <div class="main__body container p-0">
                <div class="main__body__inner">
                    <div class="row col-12 m-0 align-items-stretch justify-content-evenly sections">
                        <div class="col-lg-6 section__one section">
                            <div class="top"><small>WALLET BALANCE</small></div>
                            <div class="neck">
                                <div class="sub__neck">
                                    <div><h2>${{total_wallet_balance}}</h2></div>
                                    <!-- <div><small>$1.96</small></div> -->
                                </div>
                                <div><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Fund Wallet</a></div>
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
                            </div>

                            <div class="top"><small>Naira Account Balance</small></div>
                            <div class="neck">
                                <div class="sub__neck">
                                    <div><h2 v-if="user_detais" >₦{{user_detais.balance}}</h2></div>
                                </div>
                                <div><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Fund Wallet</a></div>
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
                            </div>
                            <div class="pre__body"><p>ACTIVITY</p></div>
                            <div class="body" v-if="transactions">
                                <div class="each__activity one" v-for="(item, index) in transactions " data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                    <div class="each__inner__activity">
                                        <div>
                                            <div class="flow"><img src="../assets/images/wallet-icon-arrow-outflow.svg" alt=""></div>
                                            <div>
                                                <p>Payment For Order 202207079KK27</p>
                                                <small>Jul 7, 2022 4:08 PM</small>
                                            </div>
                                        </div>
                                        <div class="color"><h6>-₦48,200</h6></div>
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
                                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <small>Transaction Summary</small>
                                            </div>
                                            <div class="modal-body">
                                                <div class="body">
                                                    <div class="each__activity one" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>Amount</p>
                                                                </div>
                                                            </div>
                                                            <div class="color"><h6>-₦48,200</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="each__activity one" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>Type</p>
                                                                </div>
                                                            </div>
                                                            <div class="color"><h6>Debt</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="each__activity two" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>Date</p>
                                                                </div>
                                                            </div>
                                                            <div class="color"><h6>Jul 7, 2022</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="each__activity three" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>Reference</p>
                                                                </div>
                                                            </div>
                                                            <div ><h6>BF9832B21C914995AD73F285310496EA</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="each__activity three" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>Purpose</p>
                                                                </div>
                                                            </div>
                                                            <div ><h6>Payment For Order 202207079KK27</h6></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="body" v-if="!transactions">
                                <div>No Recent Transactions</div>
                            </div>
                        </div>


                        <div class="col-lg-5 d-md-block section__two section">
                            <div class="top flex_it" >
                            <small>ABOUT WALLETS</small>
                            <div class="popup">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                    <em class="bi bi-plus" style="font-size: 25px;"></em>
                                </button>
                            </div>
                            </div>
                            <div class="neck">
                                <div class="wallet__icon">
                                    <img src="../assets/images/icon-wallet.svg" alt="" class="img-fluid">
                                </div>
                                <div class="text">
                                    <small>Pay for all your shipments with your Heroshe wallet. Add money to your wallet via cards or bank transfer in 2 simple stepsc</small>
                                </div>
                            </div>
                            <div v-if="wallets">
                                <div v-for="(item, inde) in wallets" class="each__activity two" >
                                    <div class="each__inner__activity"  data-bs-toggle="modal" data-bs-target="#exampleModal3">
                                        <div>
                                            <div class="flow"><img src="http://i.imgur.com/xYX6Tsy.png" alt=""></div>
                                            <div>
                                                <p> Coin Name </p>
                                                <small>Mushin, Lagos, Nigeria.</small>
                                            </div>
                                        </div>
                                        <div class="color"><h6>active</h6></div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="!wallets">No Wallet Added</div>
                            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <small>Wallet Information</small>
                                            </div>
                                            <div class="modal-body">
                                                <div class="body">
                                                    <div class="each__activity one" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>Address</p>
                                                                </div>
                                                            </div>
                                                            <div><h6>Mushin, Lagos Nigeria</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="each__activity one" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>QR Code</p>
                                                                </div>
                                                            </div>
                                                            <div><h6>Debt</h6></div>
                                                        </div>
                                                    </div>
                                                    <div class="each__activity two" >
                                                        <div class="each__inner__activity">
                                                            <div>
                                                                <div>
                                                                    <p>Coin Name</p>
                                                                </div>
                                                            </div>
                                                            <div><h6>Jul 7, 2022</h6></div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                <nav v-if="wallets" aria-label="Page navigation example">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3>Add New Wallet </h3>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    <div class="row col-12 m-0">
                                                        
                                                        <div class="each__form">
                                                            <label>Wallet Name</label>
                                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Wallet Name">
                                                        </div><br>
                                                        <div class=" each__form">
                                                            <label>Wallet Type</label>
                                                            <select class="form-control" id="exampleFormControlInput1" placeholder="RWallet">
                                                                <option> Crypto </option>
                                                        </select>
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

    </main>

</div>

<script src="https://unpkg.com/vue@3"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../vuecode/user.js" ></script>
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