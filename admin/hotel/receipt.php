<?php include "header.php"; ?>
    <title>Invoice Details</title>
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
                            <div v-if='booking' class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head">
                                        <div class="nk-block-between g-3">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Payment Receipt <strong class="text-primary small">#{{booking.id}}</strong></h3>
                                                <div class="nk-block-des text-soft">
                                                    <ul class="list-inline">
                                                        <li>Created At: <span class="text-base">18 Dec, 2019 01:02 PM</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="nk-block-head-content">
                                                <a href="html/hotel/invoice-list.html" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                                <a href="html/hotel/invoice-list.html" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="invoice">
                                            <div class="invoice-action">
                                                <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary" href="html/hotel/invoice-print.html" target="_blank"><em class="icon ni ni-printer-fill"></em></a>
                                            </div><!-- .invoice-actions -->
                                            <div class="invoice-wrap">
                                                <div class="invoice-brand text-center">
                                                    <img src="../imagess/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="">
                                                </div>
                                                <div class="invoice-head">
                                                    <div class="invoice-contact">
                                                        <span class="overline-title">Receipt To</span>
                                                        <div class="invoice-contact-info">
                                                            <h4 class="title">{{booking.first_name}} {{booking.last_name}}</h4>
                                                            <ul class="list-plain">
                                                                <li><em class="icon ni ni-map-pin-fill"></em><span>{{booking.address}}</span></li>
                                                                <li><em class="icon ni ni-call-fill"></em><span>{{booking.phone}}</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="invoice-desc">
                                                        <h3 class="title">Receipt</h3>
                                                        <ul class="list-plain">
                                                            <li class="invoice-id"><span>Receipt ID</span>:<span>{{booking.id}}</span></li>
                                                            <li class="invoice-date"><span>Date</span>:<span>{{booking.updated}}</span></li>
                                                        </ul>
                                                    </div>
                                                </div><!-- .invoice-head -->
                                                <div class="invoice-bills">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th class="w-150px">Item ID</th>
                                                                    <th class="w-60">Description</th>
                                                                    <th>Price</th>
                                                                    <th>Qty/days</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>23604094</td>
                                                                    <td>6 months premium support</td>
                                                                    <td>$78.75</td>
                                                                    <td>1</td>
                                                                    <td>$78.75</td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="2"></td>
                                                                    <td colspan="2">Subtotal</td>
                                                                    <td>$435.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"></td>
                                                                    <td colspan="2">Processing fee</td>
                                                                    <td>$10.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"></td>
                                                                    <td colspan="2">TAX</td>
                                                                    <td>$43.50</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"></td>
                                                                    <td colspan="2">Grand Total</td>
                                                                    <td>$478.50</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        <div class="nk-notes ff-italic fs-12px text-soft"> Invoice was created on a computer and is valid without the signature and seal. </div>
                                                    </div>
                                                </div><!-- .invoice-bills -->
                                            </div><!-- .invoice-wrap -->
                                        </div><!-- .invoice -->
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
                                        <img src="../imagess/flags/arg.png" alt="" class="country-flag">
                                        <span class="country-name">Argentina</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/aus.png" alt="" class="country-flag">
                                        <span class="country-name">Australia</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/bangladesh.png" alt="" class="country-flag">
                                        <span class="country-name">Bangladesh</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/canada.png" alt="" class="country-flag">
                                        <span class="country-name">Canada <small>(English)</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/china.png" alt="" class="country-flag">
                                        <span class="country-name">Centrafricaine</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/china.png" alt="" class="country-flag">
                                        <span class="country-name">China</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/french.png" alt="" class="country-flag">
                                        <span class="country-name">France</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/germany.png" alt="" class="country-flag">
                                        <span class="country-name">Germany</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/iran.png" alt="" class="country-flag">
                                        <span class="country-name">Iran</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/italy.png" alt="" class="country-flag">
                                        <span class="country-name">Italy</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/mexico.png" alt="" class="country-flag">
                                        <span class="country-name">México</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/philipine.png" alt="" class="country-flag">
                                        <span class="country-name">Philippines</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/portugal.png" alt="" class="country-flag">
                                        <span class="country-name">Portugal</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/s-africa.png" alt="" class="country-flag">
                                        <span class="country-name">South Africa</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/spanish.png" alt="" class="country-flag">
                                        <span class="country-name">Spain</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/switzerland.png" alt="" class="country-flag">
                                        <span class="country-name">Switzerland</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/uk.png" alt="" class="country-flag">
                                        <span class="country-name">United Kingdom</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="../imagess/flags/english.png" alt="" class="country-flag">
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