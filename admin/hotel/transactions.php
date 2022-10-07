<?php include "header.php"; ?>
    <title>Transaction Details</title>
</head>

<style>
    :hover{
        color: var(--hover-color);
    }
</style>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div id="admin" v-cloak>
        <?php include "./loading.php" ?>
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
                                        <div class="nk-block-between g-3">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Transaction</h3>
                                                <div class="nk-block-des text-soft">
                                                    <p>Here is our various Transaction.</p>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="nk-block-head-content">
                                                <div class="toggle-wrap nk-block-tools-toggle">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                    <div class="toggle-expand-content" data-content="pageMenu">
                                                        <ul class="nk-block-tools g-3">
                                                            <li>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-right">
                                                                        <em class="icon ni ni-search"></em>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="default-04" @keyup='getAllTransactions(4)' v-model ='search' placeholder="Quick search by transaction">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-bs-toggle="dropdown">Status</a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-check">
                                                                            <li v-if="sort == null" class="" :class="{active: class_active}" @click.prevent ="noSort(0)"><a href="#">Show All</a></li>
                                                                            <li v-if="sort != null" class=""  @click.prevent="noSort(0)"><a href="#">Show All</a></li>
                                                                            <li v-if="sort == 1" :class="{active: class_active}"  @click.prevent="sortByStatus(1)" class=""><a href="#">Successful</a></li>
                                                                            <li v-if="sort != 1" class=""  @click.prevent="sortByStatus(1)"><a href="#">Successful</a></li>
                                                                            <li v-if="sort == 0" :class="{active: class_active}" @click.prevent="sortByStatus(0)" class=""><a href="#">Pending</a></li>
                                                                            <li v-if="sort != 0" class=""  @click.prevent="sortByStatus(0)"><a href="#">Pending</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-bs-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-filter-alt"></em><span><span class="d-none d-md-inline"></span>Type </span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                        <li v-if="transactionType == null" class="" :class="{active: class_active_type}" @click.prevent ="noSort(0)"><a href="#">Show All</a></li>
                                                                            <li v-if="transactionType != null" class=""  @click.prevent="noSort(0)"><a href="#">Show All</a></li>
                                                                            <li v-if="transactionType == 1" :class="{active: class_active_type}"  @click.prevent="sortByTransactionType(1)" class=""><a href="#">Fund Wallet</a></li>
                                                                            <li v-if="transactionType != 1" class=""  @click.prevent="sortByTransactionType(1)"><a href="#">Fund Wallet</a></li>
                                                                            <li v-if="transactionType == 2" :class="{active: class_active_type}" @click.prevent="sortByTransactionType(2)" class=""><a href="#">Pay Agent</a></li>
                                                                            <li v-if="transactionType != 2" class=""  @click.prevent="sortByTransactionType(2)"><a href="#">Pay Agent</a></li>
                                                                            <li v-if="transactionType == 3" :class="{active: class_active_type}" @click.prevent="sortByTransactionType(3)" class=""><a href="#">Book Apartment</a></li>
                                                                            <li v-if="transactionType != 3" class=""  @click.prevent="sortByTransactionType(3)"><a href="#">Book Apartment</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div><!-- .toggle-wrap -->
                                            </div><!-- .nk-block-head-content -->
                                            <!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="card card-bordered card-stretch">
                                            <div class="card-inner-group">
                                                
                                                <div v-if="transactions" class="card-inner p-0">
                                                    <div class="nk-tb-list nk-tb-ulist">
                                                        <div class="nk-tb-item nk-tb-head">
                                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">ID</span></div>
                                                            <div class="nk-tb-col"><span class="sub-text">User Fullname</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Transaction ID</span></div>
                                                            <div class="nk-tb-col tb-col-sm"><span class="sub-text">Transaction Type</span></div>
                                                            <div class="nk-tb-col tb-col-sm"><span class="sub-text">Total Amount</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                                            <div class="nk-tb-col nk-tb-col-tools text-end">
                                                                <!-- <div class="dropdown">
                                                                    <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle" data-bs-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                        <ul class="link-tidy sm no-bdr">
                                                                            <li>
                                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" checked="" id="avil">
                                                                                    <label class="custom-control-label" for="avil">Available</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" checked="" id="low">
                                                                                    <label class="custom-control-label" for="low">Low</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="out">
                                                                                    <label class="custom-control-label" for="out">Out of Stock</label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div v-for="(item, index) in transactions" class="nk-tb-item">
                                                            <!-- <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                                                    <label class="custom-control-label" for="uid1"></label>
                                                                </div>
                                                            </div> -->
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span><a href="#">{{parseInt(index) + 1}}</a></span>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <span>{{item.username}}<span class="dot dot-success d-md-none ms-1"></span></span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span>{{item.transactionid}}</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-sm" data-order="30.00">
                                                                <span class="tb-amount text-success">{{item.type}}<span class="currency"></span></span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span class="tb-status">{{item.amttopay}}</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span v-if="item.statusCode > 0" class="tb-status text-success">{{item.status}}</span>
                                                                <span v-if="item.statusCode < 1" class="tb-status text-warning">{{item.status}}</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li style="--hover-color: var(--bs-success)" v-if="item.statusCode < 1" @click="changeTransactionStatus(item.transactionid, 1)"><a><em class="icon fa-solid fa-toggle-on"></em><span>Approve Transaction</span></a></li>
                                                                                    <li @click="getItemIndex(index)"><a data-bs-toggle="modal" href="#edit-stock"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item  -->
                                                    </div><!-- .nk-tb-list -->
                                                </div><!-- .card-inner -->
                                                <div v-if="!transactions" class="card-inner p-0">
                                                    <div class="nk-tb-list nk-tb-ulist">
                                                        <div class="nk-tb-item nk-tb-head">
                                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">ID</span></div>
                                                            <div class="nk-tb-col"><span class="sub-text">User Fullname</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Transaction ID</span></div>
                                                            <div class="nk-tb-col tb-col-sm"><span class="sub-text">Approval Type</span></div>
                                                            <div class="nk-tb-col tb-col-sm"><span class="sub-text">Total Amount</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                                            <div class="nk-tb-col nk-tb-col-tools text-end">
                                                                <!-- <div class="dropdown">
                                                                    <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle" data-bs-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                        <ul class="link-tidy sm no-bdr">
                                                                            <li>
                                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" checked="" id="avil">
                                                                                    <label class="custom-control-label" for="avil">Available</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" checked="" id="low">
                                                                                    <label class="custom-control-label" for="low">Low</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="out">
                                                                                    <label class="custom-control-label" for="out">Out of Stock</label>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div class="nk-tb-item">
                                                            <!-- <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                                                    <label class="custom-control-label" for="uid1"></label>
                                                                </div>
                                                            </div> -->
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span>No Records Found</a></span>
                                                            </div>
                                                        </div><!-- .nk-tb-item  -->
                                                    </div><!-- .nk-tb-list -->
                                                </div>
                                                <div v-if="transactions" class="card-inner">
                                                    <div class="nk-block-between-md g-3">
                                                        <div class="g">
                                                        <ul class="pagination justify-content-end">
                                                            <li v-if="currentPage == 1" class="page-item disabled">
                                                                <a class="page-link"><em class="icon ni ni-chevrons-left"></em></a>
                                                            </li>
                                                            <li v-else class="page-item">
                                                                <a @click.prevent="previousPage()" class="page-link"><em class="icon ni ni-chevrons-left"></em></a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link">{{currentPage}} of {{totalPage}}</a></li>
                                                            <li v-if="currentPage < totalPage" class="page-item">
                                                                <a v-on:click.prevent="nextPage()" class="page-link"><em class="icon ni ni-chevrons-right"></em></a>
                                                            </li>
                                                            <li v-else class="page-item disabled">
                                                                <a class="page-link"><em class="icon ni ni-chevrons-right"></em></a>
                                                            </li>
                                                        </ul><!-- .pagination -->
                                                        </div>
                                                        <!-- <div class="g">
                                                            <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                                                <div>Page</div>
                                                                <div>
                                                                    <select class="form-select js-select2" data-search="on" data-dropdown="xs center">
                                                                        <option value="page-1">1</option>
                                                                        <option value="page-2">2</option>
                                                                        <option value="page-4">4</option>
                                                                        <option value="page-5">5</option>
                                                                        <option value="page-6">6</option>
                                                                        <option value="page-7">7</option>
                                                                        <option value="page-8">8</option>
                                                                        <option value="page-9">9</option>
                                                                        <option value="page-10">10</option>
                                                                        <option value="page-11">11</option>
                                                                        <option value="page-12">12</option>
                                                                        <option value="page-13">13</option>
                                                                        <option value="page-14">14</option>
                                                                        <option value="page-15">15</option>
                                                                        <option value="page-16">16</option>
                                                                        <option value="page-17">17</option>
                                                                        <option value="page-18">18</option>
                                                                        <option value="page-19">19</option>
                                                                        <option value="page-20">20</option>
                                                                    </select>
                                                                </div>
                                                                <div>OF 102</div>
                                                            </div>
                                                        </div>.pagination-goto -->
                                                    </div><!-- .nk-block-between -->
                                                </div><!-- .card-inner -->
                                                <!-- .card-inner -->
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
        <div class="modal fade" tabindex="-1" role="dialog" id="edit-stock">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div v-if="transaction" class="modal-body modal-body-md">
                        <h5 class="modal-title">View Transaction Details</h5>

                        <div v-if="transaction" class="modal-body">
                            <div class="card h-100">
                                <div class="nk-tb-list is-compact">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span>User Fullname</span></div>
                                        <div class="nk-tb-col text-end"><span>{{transaction.username}}</span></div>
                                    </div>
                                                                        
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-sub"><span>Transaction ID</span></span>
                                        </div>
                                        <div class="nk-tb-col text-end">
                                            <span class="tb-sub tb-amount"><span>{{transaction.transactionid}}</span></span>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-sub"><span>Transaction Type</span></span>
                                        </div>
                                        <div class="nk-tb-col text-end">
                                            <span class="tb-sub tb-amount"><span>{{transaction.type  }}</span></span>
                                        </div>
                                    </div><!-- .nk-tb-item -->

                                    <div v-if="transaction.transaction_type == 3" class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-sub"><span>Booking ID</span></span>
                                        </div>
                                        <div class="nk-tb-col text-end">
                                            <span class="tb-sub tb-amount"><span>{{transaction.booking_id}}</span></span>
                                        </div>
                                    </div><!-- .nk-tb-item -->

                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-sub"><span>Approval Type</span></span>
                                        </div>
                                        <div class="nk-tb-col text-end">
                                            <span class="tb-sub tb-amount"><span>{{transaction.approvaltypeName}}</span></span>
                                        </div>
                                    </div>
                                                        
                                    <div v-if="transaction.approvaltype == 1" class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-sub"><span>Approved By</span></span>
                                        </div>
                                        <div class="nk-tb-col text-end">
                                            <span class="tb-sub tb-amount"><span>{{transaction.adminname}}</span></span>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-sub"><span>Order time</span></span>
                                        </div>
                                        <div class="nk-tb-col text-end">
                                            <span class="tb-sub tb-amount"><span>{{transaction.ordertime}}</span></span>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-sub"><span>Transaction Amount</span></span>
                                        </div>
                                        <div class="nk-tb-col text-end">
                                            <span class="tb-sub tb-amount"><span>{{transaction.amttopay}}</span></span>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    
                                </div>                                            
                                                    
                            <!-- .nk-tb-list -->
                            </div>
                        </div>
                        
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div>
    </div>
    <!-- Add Stock-->
    <!-- JavaScript -->
    <script src="../assets/js/bundle.js?ver=3.0.3"></script>
    <script src="../assets/js/scripts.js?ver=3.0.3"></script>
    <?php include "./vue-script.php"; ?>
</body>

</html>