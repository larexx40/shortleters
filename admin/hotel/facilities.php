<?php include "header.php"; ?>
    <title>Stock Details</title>
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
                                                <h3 class="nk-block-title page-title">Facilities Details</h3>
                                                <div class="nk-block-des text-soft">
                                                    <p>Here is our verious facilities details.</p>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="nk-block-head-content">
                                                <ul class="nk-block-tools g-3">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a data-bs-toggle="modal" href="#add-stock"><span>Add Facility</span></a></li>
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
                                                                                                <span class="sub-title dropdown-title">Filter Result</span>
                                                                                                <div class="dropdown">
                                                                                                    <a href="#" class="btn btn-sm btn-icon">
                                                                                                        <em class="icon ni ni-more-h"></em>
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="dropdown-body dropdown-body-rg">
                                                                                                <ul class="link-check">
                                                                                                    <li v-if="kor_sort == null" class="" :class="{active: class_active}" @click.prevent="setSort(null)"><a href="#">Show All</a></li>
                                                                                                    <li v-if="kor_sort != null" class=""  @click.prevent="setSort(null)"><a href="#">Show All</a></li>
                                                                                                    <li v-if="kor_sort == 1" :class="{active: class_active}"  @click.prevent="setSort(1)" class=""><a href="#">Active</a></li>
                                                                                                    <li v-if="kor_sort != 1" class=""  @click.prevent="setSort(1)"><a href="#">Active</a></li>
                                                                                                    <li v-if="kor_sort == 0" :class="{active: class_active}" @click.prevent="setSort(0)" class=""><a href="#">Inactive</a></li>
                                                                                                    <li v-if="kor_sort != 0" class=""  @click.prevent="setSort(0)"><a href="#">Inactive</a></li>
                                                                                                </ul>
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
                                                                                                <li v-if="kor_per_page == 10" class="" :class="{active: class_active}" @click.prevent="setPerPage(10)"><a href="#">10</a></li>
                                                                                                <li v-if="kor_per_page != 10" class=""  @click.prevent="setPerPage(10)"><a href="#">10</a></li>
                                                                                                <li v-if="kor_per_page == 20" :class="{active: class_active}"  @click.prevent="setPerPage(20)" class=""><a href="#">20</a></li>
                                                                                                <li v-if="kor_per_page != 20" class=""  @click.prevent="setPerPage(20)"><a href="#">20</a></li>
                                                                                                <li v-if="kor_per_page == 50" :class="{active: class_active}" @click.prevent="setPerPage(50)" class=""><a href="#">50</a></li>
                                                                                                <li v-if="kor_per_page != 50" class=""  @click.prevent="setPerPage(50)"><a href="#">50</a></li>
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
                                                                    </div>
                                                                    <!-- .toggle-wrap -->
                                                                </li><!-- li -->
                                                            </ul><!-- .btn-toolbar -->
                                                        </div><!-- .card-tools -->
                                                    </div><!-- .card-title-group -->
                                                    <div class="card-search search-wrap" data-search="search">
                                                        <div class="card-body">
                                                            <div class="search-content">
                                                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                                <input @keyup="getAllFacilities(4)" v-model="search" type="text" class="form-control border-transparent form-focus-none" placeholder="Search by product name or id">
                                                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-search -->
                                                </div><!-- .card-inner -->
                                                <div v-if="all_facilities" class="card-inner p-0">
                                                    <div class="nk-tb-list nk-tb-ulist">
                                                        <div class="nk-tb-item nk-tb-head">
                                                            <!-- <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                                    <label class="custom-control-label" for="uid"></label>
                                                                </div>
                                                            </div> -->
                                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">ID</span></div>
                                                            <div class="nk-tb-col"><span class="sub-text">Facility Name</span></div>
                                                            <div class="nk-tb-col"><span class="sub-text">Facility Description</span></div>
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
                                                        <div v-for="(item, index) in all_facilities" class="nk-tb-item">
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
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span v-if="item.status_code > 0" class="tb-status text-success">{{item.status}}</span>
                                                                <span v-if="item.status_code < 1" class="tb-status text-danger">{{item.status}}</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li @click="changeFacilityStatus(item.id, 0)" v-if="item.status_code > 0" class="tb-status text-danger"><a ><em class="icon fa-solid fa-toggle-on"></em><span>Deactivate</span></a></li>
                                                                                    <li @click="changeFacilityStatus(item.id, 1)" v-if="item.status_code < 1" class="tb-status text-success"><a ><em class="icon fa-solid fa-toggle-off"></em><span>Activate</span></a></li>
                                                                                    <li @click="getItemIndex(index)"><a data-bs-toggle="modal" href="#edit-stock"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                                                    <li @click="getItemIndex(index)"><a data-bs-toggle="modal" href="#modalDelete"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
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
                                                <div v-if="!all_facilities" class="card-inner p-0">
                                                    <div class="nk-tb-list nk-tb-ulist">
                                                        <div class="nk-tb-item nk-tb-head">
                                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">ID</span></div>
                                                            <div class="nk-tb-col"><span class="sub-text">Facility Name</span></div>
                                                            <div class="nk-tb-col"><span class="sub-text">Facility Description</span></div>
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
                                                
                                                <div v-if="all_facilities" class="card">
                                                    <div class="card-inner">
                                                        <div class="nk-block-between-md g-3">
                                                            <div class="g">
                                                                <ul class="pagination justify-content-center justify-content-md-start">
                                                                    <li v-if="kor_page == 1" class="page-item disabled"><a class="page-link" href="#"><em class="icon ni ni-chevrons-left"></em></a></li>
                                                                    <li v-if="kor_page > 1" @click="nav_previousPage" class="page-item"><a class="page-link" href="#"><em class="icon ni ni-chevrons-left"></em></a></li>
                                                                    
                                                                    <li class="page-item" v-for="page in kor_total_page">
                                                                        <a v-if='page < 7'  class="page-link" @click="nav_selectPage(page)">{{page}}</a>
                                                                    </li>
                                                                    <li>
                                                                        
                                                                    </li>
                                                                    <span v-if="kor_total_page > 7" class="page-link"><em class="icon ni ni-more-h"></em></span>
                                                                    <li class="page-item" v-for="page in kor_total_page">
                                                                        <a v-if='page > 13'  class="page-link" @click="nav_selectPage(page)">{{page}}</a>
                                                                    </li>
                                                                    
                                                                    <li v-if="kor_page < kor_total_page"  class="page-item" @click="nav_nextPage"><a class="page-link"><em class="icon ni ni-chevrons-right"></em></a></li>
                                                                    <li v-if="kor_page == kor_total_page" class="page-item disabled"><a  class="page-link" href="#"><em class="icon ni ni-chevrons-right"></em></a></li>
                                                                </ul><!-- .pagination -->
                                                            </div>
                                                            <div class="g">
                                                                <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                                                    <div>Page</div>
                                                                    <div>
                                                                        <select v-if="kor_total_page > 1" @change="selectPage(kor_page)" v-model="kor_page" class="form-select js-select2" data-search="on" data-dropdown="xs center">
                                                                            <option v-for="page in kor_total_page" v-bind:value="page">{{page}}</option>
                                                                        </select>
                                                                        <select v-if="kor_total_page == 1" class="form-select js-select2 " data-search="on" data-dropdown="xs center">
                                                                            <option value="1">1</option>
                                                                        </select>
                                                                    </div>
                                                                    <div>OF {{kor_total_page}}</div>
                                                                </div>
                                                            </div><!-- .pagination-goto -->
                                                        </div><!-- .nk-block-between -->
                                                    </div>
                                                </div>
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
        <!-- Add Stock-->
        <div class="modal fade" tabindex="-1" role="dialog" id="add-stock">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="modal-title">Add Facility Details</h5>
                        <form @submit.prevent="addFacility" class="mt-2">
                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-add">Facility Name</label>
                                        <input v-model="facilty_name" type="text" class="form-control" id="product-name-add" placeholder="Facility Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-add">Facility Description</label>
                                        <input v-model="facility_description" type="text" class="form-control" id="product-name-add" placeholder="Facility Description">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <button class="btn btn-primary" data-bs-dismiss="modal">Add Facility</button>
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
                    <div v-if="facility" class="modal-body modal-body-md">
                        <h5 class="modal-title">Edit Facility Details</h5>
                        <form @submit.prevent="updateFacility" class="mt-2">
                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-edit">Facility Name</label>
                                        <input type="text" v-model="facility.name" class="form-control" id="product-name-edit" placeholder="Facility Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-edit">Facility Description</label>
                                        <input type="text" v-model="facility.description" class="form-control" id="product-name-edit" placeholder="Facility Description">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update Facility</button>
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
        <div class="modal fade" id="modalDelete" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content"> <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div v-if="facility" class="modal-body modal-body-lg text-center">
                        <div class="nk-modal py-4"> <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                            <h4 class="nk-modal-title">Are You Sure ?</h4>
                            <div class="nk-modal-text mt-n2">
                                <p class="text-soft">This Facility will be removed permanently.</p>
                            </div>
                            <ul class="d-flex justify-content-center gx-4 mt-4">
                                <li>
                                    <button @click="deleteFacility(facility.id)" data-bs-dismiss="modal" id="deleteEvent" class="btn btn-success">Yes, Delete it</button>
                                </li>
                                <li>
                                    <button data-bs-dismiss="modal" class="btn btn-danger btn-dim">Cancel</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="../assets/js/bundle.js?ver=3.0.3"></script>
    <script src="../assets/js/scripts.js?ver=3.0.3"></script>
    <?php include "./vue-script.php" ?>
</body>

</html>