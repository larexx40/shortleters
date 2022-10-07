<?php include "header.php"; ?>
    <title>Room List</title>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div id="admin" v-cloak>
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
                                                <h3 class="nk-block-title page-title">Apartment List</h3>
                                                <div class="nk-block-des text-soft">
                                                    <p>Here is our various Apartments.</p>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="nk-block-head-content">
                                                <ul class="nk-block-tools g-3">
                                                    <li>
                                                        <div>
                                                            <a href="./features.php" class="btn btn-primary"><em class="icon ni ni-eye"></em>Features</a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div>
                                                            <a href="./facilities.php" class="btn btn-primary"><em class="icon ni ni-eye"></em>View Facilities</a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div>
                                                            <a href="./apartment_images.php" class="btn btn-primary"><em class="icon ni ni-eye"></em>View All Apartment Images</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- .nk-block-head-content -->
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
                                                                        <option value="change">Change Status</option>
                                                                    </select>
                                                                </div>
                                                                <div class="btn-wrap">
                                                                    <span class="d-none d-md-block"><button class="btn btn-dim btn-outline-light disabled">Apply</button></span>
                                                                    <span class="d-md-none"><button class="btn btn-dim btn-outline-light btn-icon disabled"><em class="icon ni ni-arrow-right"></em></button></span>
                                                                </div>
                                                            </div> -->
                                                            <!-- .form-inline -->
                                                        </div><!-- .card-tools -->
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
                                                                        </div><!-- .toggle-wrap -->
                                                                </li><!-- li -->
                                                            </ul><!-- .btn-toolbar -->
                                                        </div><!-- .card-tools -->
                                                    </div><!-- .card-title-group -->
                                                    <div class="card-search search-wrap" data-search="search">
                                                        <div class="card-body">
                                                            <div class="search-content">
                                                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                                <input type="text" v-model="search" @keyup="getAllApartments(4)" class="form-control border-transparent form-focus-none" placeholder="Search by room no or type">
                                                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-search -->
                                                </div><!-- .card-inner -->
                                                    <div v-if="all_apartments" class="card-inner p-0">
                                                        <div class="nk-tb-list nk-tb-ulist">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <!-- <div class="nk-tb-col nk-tb-col-check">
                                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                        <input type="checkbox" class="custom-control-input" id="uid">
                                                                        <label class="custom-control-label" for="uid"></label>
                                                                    </div>
                                                                </div> -->
                                                                <div class="nk-tb-col tb-col-mb"><span class="sub-text">ID</span></div>
                                                                <div class="nk-tb-col"><span class="sub-text">Apartment Name</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Apartment Title</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Apartment Address</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Apartment State</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Apartment Currency</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Apartment Status</span></div>
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
                                                            <div v-for="(item, index) in all_apartments" class="nk-tb-item">
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
                                                                    <span>{{item.title}} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span>{{item.apartment_address}} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span>{{item.apartment_state}} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span>{{item.listing_currency_name}} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-md">
                                                                    <span v-if="item.apartment_status_code == 1" class="tb-status text-success">{{item.apartment_status}}</span>
                                                                    <span v-if="item.apartment_status_code == 2" class="tb-status text-warning">{{item.apartment_status}}</span>
                                                                    <span v-if="item.apartment_status_code == 3" class="tb-status text-light">{{item.apartment_status}}</span>
                                                                    <span v-if="item.apartment_status_code == 4" class="tb-status text-danger">{{item.apartment_status}}</span>
                                                                </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li>
                                                                            <div class="drodown">
                                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                                    <ul class="link-list-opt no-bdr">
                                                                                        <li @click="changeApartStatus(item.id, 4)" v-if="item.apartment_status_code < 4" class="tb-status text-danger"><a ><em class="icon ni ni-edit"></em><span>Deactivate</span></a></li>
                                                                                        <li @click="changeApartStatus(item.id, 1)" v-if="item.apartment_status_code != 1" class="tb-status text-success"><a ><em class="icon ni ni-edit"></em><span>Activate / List</span></a></li>
                                                                                        <li @click="setApartId(item.id)"><a href="./apartment-details.php"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                        <!-- <li @click="getItemIndex(index)"><a data-bs-toggle="modal" href="#edit-stock"><em class="icon ni ni-edit"></em><span>Edit</span></a></li> -->
                                                                                        <li @click="getItemIndex(index)"><a data-bs-toggle="modal" href="#modalDelete"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div><!-- .nk-tb-item  -->
                                                        </div><!-- .nk-tb-list -->
                                                    </div>

                                                    <div v-if="!all_apartments" class="card-inner p-0">
                                                        <div class="nk-tb-list nk-tb-ulist">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col tb-col-mb"><span class="sub-text">ID</span></div>
                                                                <div class="nk-tb-col"><span class="sub-text">Apartment Name</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Apartment Title</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Apartment Address</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Apartment State</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Apartment Currency</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Apartment Status</span></div>
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
                                                <!-- .card-inner -->
                                                    
                                                
                                                <div v-if="all_apartments" class="card">
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
        <!-- Add Room-->
        <div class="modal fade" tabindex="-1" role="dialog" id="add-room">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="modal-title">Add Room</h5>
                        <form action="#" class="mt-2">
                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="room-no-add">Room No</label>
                                        <input type="number" class="form-control" id="room-no-add" placeholder="Room No">
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Room Type</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2">
                                                <option value="default_option">Room Type</option>
                                                <option value="option_select_room_type">Delux</option>
                                                <option value="option_select_room_type">Super Delux</option>
                                                <option value="option_select_room_type">Single</option>
                                                <option value="option_select_room_type">Double</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Air Conditon</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2">
                                                <option value="default_option">AC</option>
                                                <option value="option_select_ac">Non AC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="bed-no-add">Bed Capacity</label>
                                        <input type="number" class="form-control" id="bed-no-add" placeholder="Bed Capacity">
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Meal</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2" data-placeholder="Select multiple options">
                                                <option value="default_option">None</option>
                                                <option value="option_select_meal">Breakfast</option>
                                                <option value="option_select_meal">Lunch</option>
                                                <option value="option_select_meal">Dinner</option>
                                                <option value="option_select_meal">Two</option>
                                                <option value="option_select_meal">All</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="rent-add">Rent</label>
                                        <input type="number" class="form-control" id="rent-add" placeholder="0.00 USD">
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2" data-placeholder="Select multiple options">
                                                <option value="default_option">Open</option>
                                                <option value="option_select_status">Inactive</option>
                                                <option value="option_select_status">Booked</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <button class="btn btn-primary" data-bs-dismiss="modal">Add Room</button>
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
        <!-- Add Room-->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit-room">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="modal-title">Edit Room</h5>
                        <form action="#" class="mt-2">
                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="room-no-edit">Room No</label>
                                        <input type="number" class="form-control" id="room-no-edit" value="107" placeholder="Room No">
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Room Type</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2">
                                                <option value="default_option">Room Type</option>
                                                <option value="option_select_room_type">Delux</option>
                                                <option value="option_select_room_type">Super Delux</option>
                                                <option value="option_select_room_type">Single</option>
                                                <option value="option_select_room_type">Double</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Air Conditon</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2">
                                                <option value="default_option">AC</option>
                                                <option value="option_select_ac">Non AC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="bed-no-edit">Bed Capacity</label>
                                        <input type="number" class="form-control" id="bed-no-edit" placeholder="Bed Capacity">
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Meal</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2" data-placeholder="Select multiple options">
                                                <option value="default_option">None</option>
                                                <option value="option_select_meal">Breakfast</option>
                                                <option value="option_select_meal">Lunch</option>
                                                <option value="option_select_meal">Dinner</option>
                                                <option value="option_select_meal">Two</option>
                                                <option value="option_select_meal">All</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="rent-edit">Rent</label>
                                        <input type="number" class="form-control" id="rent-edit" value="38.99" placeholder="0.00 USD">
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2" data-placeholder="Select multiple options">
                                                <option value="default_option">Open</option>
                                                <option value="option_select_status">Inactive</option>
                                                <option value="option_select_status">Booked</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--col-->
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <button class="btn btn-primary" data-bs-dismiss="modal">Update Room</button>
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
    <?php include "./vue-script.php"; ?>
</body>

</html>