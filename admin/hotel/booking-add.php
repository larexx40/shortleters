<?php include "header.php"; ?>
    <title>Add Booking</title>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div id="admin" v-cloak>
        <?php include "loading.php"; ?>
        <div class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                <!-- sidebar @s -->
                <?php include "sidebar.php"; ?>
                <!-- sidebar @e -->
                <!-- wrap @s -->
                <div class="nk-wrap ">
                    <!-- main header @s -->
                    <?php include "content-header.php"; ?>
                    <!-- main header @e -->
                    <!-- content @s -->
                    <div class="nk-content ">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Add Booking</h3>
                                            </div><!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <form @submit.prevent="addBooking" class="row gy-4">
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="first-name">First Name</label>
                                                            <input type="text" v-model="first_name"  class="form-control" id="first-name" placeholder="First Name" required>
                                                        </div>
                                                    </div>
                                                    <!--col-->
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="last-name">Last Name</label>
                                                            <input type="text" v-model="last_name" class="form-control" id="last-name" placeholder="Last Name">
                                                        </div>
                                                    </div>
                                                    <!--col-->
                                                    <div v-if="gender_options" class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Gender {{gender}}</label>
                                                            <div class="form-control-wrap">
                                                                <select v-model="gender" class="form-select">
                                                                    <option value="null" >Select Gender</option>
                                                                    <option v-for="(item, index) in gender_options" v-bind:value="item" >{{item}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="phone-no">Phone</label>
                                                            <input type="tel" v-model="phone" class="form-control" id="phone-no" placeholder="Phone no">
                                                        </div>
                                                    </div>
                                                    <!--col-->
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="email">Email Address</label>
                                                            <input type="email" v-model="email" class="form-control" id="email" placeholder="Email Address">
                                                        </div>
                                                    </div>
                                                    <!--col-->
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="address">Adddress</label>
                                                            <input type="text"v-model="address" class="form-control" id="address" placeholder="Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="occupation_or_work">Occupation / WorkPlace</label>
                                                            <input type="text" v-model="occupation_or_work" class="form-control" id="occupation_or_work" placeholder="Occupation / Workplace">
                                                        </div>
                                                    </div>
                                                    <!--col-->
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Upload Photo of I.d</label>
                                                            <div class="form-control-wrap">
                                                                <div class="form-file">
                                                                    <input type="file" @change="changeImage($event)" class="form-file-input" id="customFile">
                                                                    <label class="form-file-label" for="customFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--col-->
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Select an Verification Type</label>
                                                            <div class="form-control-wrap">
                                                                <select v-model="identification_type" class="form-select" data-placeholder="Select multiple options">
                                                                    <option value="null">Select an Identity Card</option>
                                                                    <option value="NIMC">NIN Slip / Card</option>
                                                                    <option value="Voters Card">Voters Card</option>
                                                                    <option value="Valid Id card">Valid Id card</option>
                                                                    <option value="International Passport">International Passport</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div v-if="all_apartments" class="form-group">
                                                            <label class="form-label">Select Apartment</label>
                                                            <div class="form-control-wrap">
                                                                <select v-model="apartment_details" @change="fetchPriceAndId" class="form-select js-select2">
                                                                    <option value="null">Select Preffered Apartment</option>
                                                                    <option v-for="(item, index) in all_apartments" v-bind:value="item">{{item.name}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Apartment Price</label>
                                                            <div class="form-control-wrap">
                                                                <div class="form-icon form-icon-right">
                                                                    <em class="icon ni ni-money"></em>
                                                                </div>
                                                                <input type="text" v-model="apartment_price" class="form-control" readonly placeholder="Select an Apartment">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div v-if="all_apartments" class="form-group">
                                                            <label class="form-label">Payment Status</label>
                                                            <div class="form-control-wrap">
                                                                <select v-model="payment_status" class="form-select js-select2">
                                                                    <option value="null">Select Payment Status</option>
                                                                    <option value="0">Not Paid</option>
                                                                    <option value="1">Paid</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="total-person">Total Person</label>
                                                            <input type="number" v-model="no_of_people" class="form-control" id="total-person" placeholder="Total Person">
                                                        </div>
                                                    </div>
                                                    <!--col-->
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Arrived Date</label>
                                                            <div class="form-control-wrap">
                                                                <div class="form-icon form-icon-right">
                                                                    <em class="icon"></em>
                                                                </div>
                                                                <input type="date" v-model="preferred_check_in" class="form-control" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Depart Date</label>
                                                            <div class="form-control-wrap">
                                                                <div class="form-icon form-icon-right">
                                                                    <em class="icon"></em>
                                                                </div>
                                                                <input type="date" @change="fetchPriceAndId" v-model="prefferred_check_out" class="form-control" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Total Cost</label>
                                                            <div class="form-control-wrap">
                                                                <div class="form-icon form-icon-right">
                                                                    <em class="icon"></em>
                                                                </div>
                                                                <input type="text" readonly v-model="total_payment" class="form-control" placeholder="Total Amount">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--col-->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="default-textarea">Note</label>
                                                            <div class="form-control-wrap">
                                                                <textarea v-model="customer_note" class="form-control no-resize" id="default-textarea">Large text area content</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary">Add Booking</button>
                                                        </div>
                                                    </div>
                                                    <!--col-->
                                                </form>
                                                <!--row-->
                                            </div><!-- .card-inner-group -->
                                        </div><!-- .card -->
                                    </div><!-- .nk-block -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content @e -->
                    <!-- footer @s -->
                    <?php include "content-footer.php"; ?>
                    <!-- footer @e -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- main @e -->
        </div>
        <!-- app-root @e -->
        <!-- select region modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="region">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="title mb-4">Select Your Country</h5>
                        <div class="nk-country-region">
                            <ul class="country-list text-center gy-2">
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/arg.png" alt="" class="country-flag">
                                        <span class="country-name">Argentina</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/aus.png" alt="" class="country-flag">
                                        <span class="country-name">Australia</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/bangladesh.png" alt="" class="country-flag">
                                        <span class="country-name">Bangladesh</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/canada.png" alt="" class="country-flag">
                                        <span class="country-name">Canada <small>(English)</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/china.png" alt="" class="country-flag">
                                        <span class="country-name">Centrafricaine</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/china.png" alt="" class="country-flag">
                                        <span class="country-name">China</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/french.png" alt="" class="country-flag">
                                        <span class="country-name">France</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/germany.png" alt="" class="country-flag">
                                        <span class="country-name">Germany</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/iran.png" alt="" class="country-flag">
                                        <span class="country-name">Iran</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/italy.png" alt="" class="country-flag">
                                        <span class="country-name">Italy</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/mexico.png" alt="" class="country-flag">
                                        <span class="country-name">México</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/philipine.png" alt="" class="country-flag">
                                        <span class="country-name">Philippines</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/portugal.png" alt="" class="country-flag">
                                        <span class="country-name">Portugal</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/s-africa.png" alt="" class="country-flag">
                                        <span class="country-name">South Africa</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/spanish.png" alt="" class="country-flag">
                                        <span class="country-name">Spain</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/switzerland.png" alt="" class="country-flag">
                                        <span class="country-name">Switzerland</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/uk.png" alt="" class="country-flag">
                                        <span class="country-name">United Kingdom</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../images/flags/english.png" alt="" class="country-flag">
                                        <span class="country-name">United State</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- .modal-content -->
            </div><!-- .modla-dialog -->
        </div><!-- .modal -->
    </div>
    <!-- JavaScript -->
    <script src="../assets/js/bundle.js?ver=3.0.3"></script>
    <script src="../assets/js/scripts.js?ver=3.0.3"></script>
    <?php include "./vue-script.php" ?>
</body>

</html>