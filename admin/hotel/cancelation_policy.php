<?php include "header.php"; ?>
    <title>Cancelation Policy</title>
</head>

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
                                                <h3 class="nk-block-title page-title">Cancelation Policy</h3>
                                                <div class="nk-block-des text-soft">
                                                    <p>Here are policies to cancel your booking.</p>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="nk-block-head-content">
                                                <ul class="nk-block-tools g-3">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a data-bs-toggle="modal" href="#add-stock"><span>Add Cancelation Policy</span></a></li>
                                                                    <!-- <li><a href="#"><span>View Amenities</span></a></li>
                                                                    <li><a href="#"><span>Delete Amenities</span></a></li> -->
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div><!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="card card-bordered card-stretch">
                                            <div class="card-inner-group">
                                                <div class="card-inner position-relative card-tools-toggle">
                                                    <div class="card-title-group">
                                                        <div class="card-tools">
                                                            <!-- <div class="form-inline flex-nowrap gx-3">
                                                                <div class="form-wrap w-150px">
                                                                    <select class="form-select js-select2 js-select2-sm" data-search="off" data-placeholder="Bulk Action">
                                                                        <option value="">Bulk Action</option>
                                                                        <option value="edit">Edit Selected</option>
                                                                        <option value="delete">Delete Selected</option>
                                                                    </select>
                                                                </div>
                                                                <div class="btn-wrap">
                                                                    <span class="d-none d-md-block"><button class="btn btn-dim btn-outline-light disabled">Apply</button></span>
                                                                    <span class="d-md-none"><button class="btn btn-dim btn-outline-light btn-icon disabled"><em class="icon ni ni-arrow-right"></em></button></span>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                        <!-- .form-inline -->
                                                        <!-- .card-tools -->
                                                        <div class="card-tools me-n1">
                                                            <ul class="btn-toolbar gx-1">
                                                                <li>
                                                                    <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                                                </li><!-- li -->
                                                                <li class="btn-toolbar-sep"></li><!-- li -->
                                                                <li>
                                                                    <div class="toggle-wrap">
                                                                        <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
                                                                        <div class="toggle-content" data-content="cardTools">
                                                                            <ul class="btn-toolbar gx-1">
                                                                                <li class="toggle-close">
                                                                                    <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-arrow-left"></em></a>
                                                                                </li><!-- li -->
                                                                                <li>
                                                                                    <div class="dropdown">
                                                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                                                            <div class="dot dot-primary"></div>
                                                                                            <em class="icon ni ni-filter-alt"></em>
                                                                                        </a>
                                                                                        <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                                                                            <div class="dropdown-head">
                                                                                                <span class="sub-title dropdown-title">Filter Report</span>
                                                                                                <div class="dropdown">
                                                                                                    <a href="#" class="btn btn-sm btn-icon">
                                                                                                        <em class="icon ni ni-more-h"></em>
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="dropdown-body dropdown-body-rg">
                                                                                                <ul class="link-check">
                                                                                                    <li v-if="sort == null" class="" :class="{active: class_active}" @click.prevent ="noSort(0)"><a href="#">Show All</a></li>
                                                                                                    <li v-if="sort != null" class=""  @click.prevent="noSort(0)"><a href="#">Show All</a></li>
                                                                                                    <li v-if="sort == 1" :class="{active: class_active}"  @click.prevent="sortByStatus(1)" class=""><a href="#">Active</a></li>
                                                                                                    <li v-if="sort != 1" class=""  @click.prevent="sortByStatus(1)"><a href="#">Active</a></li>
                                                                                                    <li v-if="sort == 0" :class="{active: class_active}" @click.prevent="sortByStatus(0)" class=""><a href="#">Inactive</a></li>
                                                                                                    <li v-if="sort != 0" class=""  @click.prevent="sortByStatus(0)"><a href="#">Inactive</a></li>
                                                                                                </ul>
                                                                                            </div>

                                                                                            <div class="dropdown-foot between">
                                                                                                <a class="clickable" href="#">Reset Filter</a>
                                                                                                <a href="#">Save Filter</a>
                                                                                            </div>
                                                                                        </div><!-- .filter-wg -->
                                                                                    </div><!-- .dropdown -->
                                                                                </li><!-- li -->
                                                                                <li>
                                                                                    <div class="dropdown">
                                                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                                                            <em class="icon ni ni-setting"></em>
                                                                                        </a>
                                                                                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                                            
                                                                                            <ul class="link-check">
                                                                                                <li><span>Show</span></li>
                                                                                                <li v-if="per_page == 10" class="" :class="{active: class_active}" @click.prevent="setNoPerPage(10)"><a href="#">10</a></li>
                                                                                                <li v-if="per_page != 10" class=""  @click.prevent="setNoPerPage(10)"><a href="#">10</a></li>
                                                                                                <li v-if="per_page == 20" :class="{active: class_active}"  @click.prevent="setNoPerPage(20)" class=""><a href="#">20</a></li>
                                                                                                <li v-if="per_page != 20" class=""  @click.prevent="setNoPerPage(20)"><a href="#">20</a></li>
                                                                                                <li v-if="per_page == 50" :class="{active: class_active}" @click.prevent="setNoPerPage(50)" class=""><a href="#">50</a></li>
                                                                                                <li v-if="per_page != 50" class=""  @click.prevent="setNoPerPage(50)"><a href="#">50</a></li>
                                                                                            </ul>
                                                                                            <!-- <ul class="link-check">
                                                                                                <li><span>Order</span></li>
                                                                                                <li class="active"><a href="#">DESC</a></li>
                                                                                                <li><a href="#">ASC</a></li>
                                                                                            </ul> -->
                                                                                        </div>
                                                                                    </div><!-- .dropdown -->
                                                                                </li><!-- li -->
                                                                            </ul><!-- .btn-toolbar -->
                                                                        </div><!-- .toggle-content -->
                                                                    </div><!-- .toggle-wrap -->
                                                                </li><!-- li -->
                                                            </ul><!-- .btn-toolbar -->
                                                        </div><!-- .card-tools -->
                                                    </div><!-- .card-title-group -->
                                                    <div class="card-search search-wrap" data-search="search">
                                                        <div class="card-body">
                                                            <div class="search-content">
                                                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                                <input type="text" class="form-control border-transparent form-focus-none"  @keyup='getAllCancelationPolicy(4)' v-model ='search' placeholder="Search by charges name">
                                                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-search -->
                                                </div><!-- .card-inner -->
                                                <div v-if="cancelationPolicies" class="card-inner p-0">
                                                    <div class="nk-tb-list nk-tb-ulist">
                                                        <div class="nk-tb-item nk-tb-head">
                                                            <!-- <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                                    <label class="custom-control-label" for="uid"></label>
                                                                </div>
                                                            </div> -->
                                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">ID</span></div>
                                                            <div class="nk-tb-col"><span class="sub-text"> Name</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Description</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Read more url</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">status</span></div>
                                                            <div class="nk-tb-col nk-tb-col-tools text-end">
                                                                
                                                            </div> 
                                                        </div><!-- .nk-tb-item -->
                                                        <div v-for="(item, index) in cancelationPolicies" class="nk-tb-item">
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
                                                                <span>{{item.name}} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <span>{{item.description}} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <span>{{item.readMoreUrl}} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span v-if="item.statusCode > 0" class="tb-status text-success">{{item.status}}</span>
                                                                <span v-if="item.statusCode < 1" class="tb-status text-danger">{{item.status}}</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li @click.prevent = 'getIndex(index)'><a data-bs-toggle="modal" href="#edit-stock"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                                                    <li @click.prevent = 'changeCancelationPolicyStatus(item.policyid, 1)' v-if='item.statusCode == 0 '><a href="#"><em class="icon ni ni-report-profit"></em><span>Set Active</span></a></li>
                                                                                    <li @click.prevent = 'changeCancelationPolicyStatus(item.policyid, 0)' v-if='item.statusCode == 1  ' ><a href="#"><em class="icon ni ni-report-profit"></em><span>Set Inactive</span></a></li>
                                                                                    <li @click.prevent= 'deleteByid(item.policyid)'><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item  -->
                                                    </div><!-- .nk-tb-list -->
                                                </div><!-- .card-inner -->

                                                <!-- Table when record not found -->
                                                <div v-if="!cancelationPolicies" class="card-inner p-0">
                                                    <div class="nk-tb-list nk-tb-ulist">
                                                        <div class="nk-tb-item nk-tb-head">
                                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">ID</span></div>
                                                            <div class="nk-tb-col"><span class="sub-text">Policy Name</span></div>
                                                            <div class="nk-tb-col"><span class="sub-text">Description</span></div>
                                                            <div class="nk-tb-col"><span class="sub-text">Read More Url</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div  class="nk-tb-item">
                                                            <!-- <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                                                    <label class="custom-control-label" for="uid1"></label>
                                                                </div>
                                                            </div> -->
                                                            <div class="nk-tb-col">
                                                                <span>No records Found <span class="dot dot-success d-md-none ms-1"></span></span>
                                                            </div>
                                                        </div><!-- .nk-tb-item  -->
                                                    </div><!-- .nk-tb-list -->
                                                </div>
                                                
                                                <div class="card-inner">
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
        <!-- Add Stock-->
        <div class="modal fade" tabindex="-1" role="dialog" id="add-stock">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="modal-title">Add Policy</h5>
                        <form @submit.prevent="addCancelationPolicy" class="mt-2">
                            <div class="row g-gs">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-add"> Name</label>
                                        <input v-model="name" type="text" class="form-control" id="product-name-add" placeholder="policy name eg, non-refundable">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-add"> Description</label>
                                        <input v-model="description" type="text" class="form-control" id="product-name-add" placeholder="Describe the policy">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-add"> Readmore url</label>
                                        <input v-model="readMoreUrl" type="text" class="form-control" id="product-name-add" placeholder="url to read more">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <button class="btn btn-primary" data-bs-dismiss="modal">Add Policy</button>
                                        </li>
                                        <li>
                                            <a href="#" class="link" data-bs-dismiss="modal">Cancel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div><!-- .modal -->
        <!-- Edit Stock-->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit-stock">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="modal-title">Edit Cancelation Policy</h5>
                        <form @submit.prevent="updateCancelationPolicy"  action="#" class="mt-2">
                            <div v-if='itemDetails' class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-edit"> Name</label>
                                        <input type="text" class="form-control" id="name-edit" v-model="itemDetails.name">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label" for="product-name-edit"> Description</label>
                                    <input type="text" class="form-control" id="name-edit" v-model="itemDetails.description">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="product-name-edit"> Read More Url</label>
                                    <input type="text" class="form-control" id="name-edit" v-model="itemDetails.readMoreUrl" >
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <button class="btn btn-primary" data-bs-dismiss="modal">Update Policy</button>
                                        </li>
                                        <li>
                                            <a href="#" class="link" data-bs-dismiss="modal">Cancel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div><!-- .modal -->
    </div>
    <!-- JavaScript -->
    <script src="../assets/js/bundle.js?ver=3.0.3"></script>
    <script src="../assets/js/scripts.js?ver=3.0.3"></script>
    <?php include "./vue-script.php" ?>
</body>

</html>