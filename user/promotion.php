<?php  
    include "./header.php"; 
?>

  <title>Package</title>

</head>
<body>

<div id="user">

    <?php
        include "sidebar_navbar.php";
    ?>

    <div class="main">
        <div class="main__inner">
            <div class="row col-12 m-0 align-items-stretch">
                <div class="col-md-7 section__one p-0">
                    <div class="section__one__inner section">
                        <div class="referral">
                            <div class="row col-12 align-items-center m-0">
                                <div class="p-0" style="display:flex;width:340px;">
                                    <div class="ref">
                                        <a href="">
                                            <div class="image"><img src="../assets/images/referral-nav.svg" alt=""></div>
                                            <div class="text">Referrals</div>
                                        </a>
                                    </div>
                                    <div class="cashback">
                                        <div class="image"><img src="../assets/images/cashback-nav.svg" alt=""></div>
                                        <div class="text">Cashback (Coming soon)</div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="share__link">
                            <div><small>SHARE THE REFERRAL LINK</small></div>
                            <div><span>Share this link with your friends and invite them to join Heroshe</span></div>
                        </div>
                        <div class="link">
                            <div class="text__link">
                                <input 
                                    v-on:focus="$event.target.select()"
                                    type="text" 
                                    v-if='ref_link' 
                                    v-model="ref_link" 
                                    class="form-control" 
                                    id="" ref="myinput" 
                                    readonly
                                >
                            </div>
                            <div  @click="copyText" class="copy__link">
                                <div class="image" style="display:flex;">
                                    <img src="../assets/images/copy-icon.svg" alt="">
                                    <span style="white-space:nowrap;">Copy link</span>
                                </div>
                            </div>
                        </div>
                        <div class="social__icons">
                            <div class="icon"><a href=""><img src="../assets/images/twitter.svg" alt=""></a></div>
                            <div class="icon"><a href=""><img src="../assets/images/facebook.svg" alt=""></a></div>
                            <div class="icon"><a href=""><img src="../assets/images/whatsapp.svg" alt=""></a></div>
                            <div class="icon"><a href=""><img src="../assets/images/linkedin.svg" alt=""></a></div>
                            <div class="icon"><a href=""><img src="../assets/images/email.svg" alt=""></a></div>
                        </div>
                        <div class="voucher">
                            <div><small>VOUCHER RECEIVED</small></div>
                            <div class="image">
                                <div class="image__container">
                                    <img src="../assets/images/empty-wallet.svg" alt="" class="img-fluid">
                                </div>
                                <span>The vouchers you received <br class="d-none d-md-block"> will appear here.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 section__two p-0">
                    <div class="section__two__inner section">
                        <div class="top"><small>HOW REFERRALS WORKS</small></div>
                        <div class="to__do">
                            <div class="each">
                                <div class="image"><img src="../assets/images/send-invitation.svg" alt=""></div>
                                <div class="text">
                                    <small>Send Invitation</small>
                                    <span>Send your referral link to your friends and family via social media or email.</span>
                                </div>
                            </div>
                            <div class="each">
                                <div class="image"><img src="../assets/images/registration.svg" alt=""></div>
                                <div class="text">
                                    <small>Registration</small>
                                    <span>Get your friends to register using your referral link.</span>
                                </div>
                            </div>
                            <div class="each">
                                <div class="image"><img src="../assets/images/ship-a-package.svg" alt=""></div>
                                <div class="text">
                                    <small>Ship a package</small>
                                    <span>You receive a voucher when your friends pay for a shipment after signing up with your referral link.</span>
                                </div>
                            </div>
                            <div class="each">
                                <div class="image"><img src="../assets/images/redeem-voucher.svg" alt=""></div>
                                <div class="text">
                                    <small>Redeem Voucher</small>
                                    <span>You and your friend both receive $5 vouchers</span>
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
    </script>
</body>
</html>