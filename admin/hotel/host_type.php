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
                                                <h3 class="nk-block-title page-title">Host Type Details</h3>
                                                <div class="nk-block-des text-soft">
                                                    <p>Here is our various Hosts Type.</p>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="nk-block-head-content">
                                                <ul class="nk-block-tools g-3">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a data-bs-toggle="modal" href="#add-stock"><span>Add Host Type</span></a></li>
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
                                                                                                <div class="row gx-6 gy-3">
                                                                                                    <div class="col-6">
                                                                                                        <div class="form-group">
                                                                                                            <label class="overline-title overline-title-alt">Status</label>
                                                                                                            <select v-model="sort" class="form-select js-select2 js-select2-sm">
                                                                                                                <option value="null">Any Status</option>
                                                                                                                <option value="1">Active</option>
                                                                                                                <option value="0">Inactive</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <!-- <div class="col-6">
                                                                                                        <div class="form-group">
                                                                                                            <label class="overline-title overline-title-alt">Date</label>
                                                                                                            <select class="form-select js-select2 js-select2-sm">
                                                                                                                <option value="any">All Time</option>
                                                                                                                <option value="week">Last 7 Days</option>
                                                                                                                <option value="month">Last 30 Days</option>
                                                                                                                <option value="six">Last 6 Months</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div> -->
                                                                                                    <div class="col-12">
                                                                                                        <div class="form-group">
                                                                                                            <button @click.prevent="getAllHosttype(4)" type="button" class="btn btn-secondary">Filter</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
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
                                                                                                <li class="active"><a href="#">10</a></li>
                                                                                                <li><a href="#">20</a></li>
                                                                                                <li><a href="#">50</a></li>
                                                                                            </ul>
                                                                                            <ul class="link-check">
                                                                                                <li><span>Order</span></li>
                                                                                                <li class="active"><a href="#">DESC</a></li>
                                                                                                <li><a href="#">ASC</a></li>
                                                                                            </ul>
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
                                                                <input @keyup="getAllHosttype(4)" v-model="search" type="text" class="form-control border-transparent form-focus-none" placeholder="Search by product name or id">
                                                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-search -->
                                                </div><!-- .card-inner -->
                                                <div v-if="all_host_type" class="card-inner p-0">
                                                    <div class="nk-tb-list nk-tb-ulist">
                                                        <div class="nk-tb-item nk-tb-head">
                                                            <!-- <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                                    <label class="custom-control-label" for="uid"></label>
                                                                </div>
                                                            </div> -->
                                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">ID</span></div>
                                                            <div class="nk-tb-col"><span class="sub-text">Host Type</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                                            <!-- <div class="nk-tb-col nk-tb-col-tools text-end">
                                                                <div class="dropdown">
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
                                                                </div>
                                                            </div> -->
                                                        </div><!-- .nk-tb-item -->
                                                        <div v-for="(item, index) in all_host_type" class="nk-tb-item">
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
                                                                                    <li @click="changeHostTypeStatus(item.id, 0)" v-if="item.status_code > 0" class="tb-status text-danger"><a ><em class="icon ni ni-edit"></em><span>Deactivate</span></a></li>
                                                                                    <li @click="changeHostTypeStatus(item.id, 1)" v-if="item.status_code < 1" class="tb-status text-success"><a ><em class="icon ni ni-edit"></em><span>Activate</span></a></li>
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
                                                <div v-if="!all_host_type" class="card-inner p-0">
                                                    <div class="nk-tb-list nk-tb-ulist">
                                                        <div class="nk-tb-item nk-tb-head">
                                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">ID</span></div>
                                                            <div class="nk-tb-col"><span class="sub-text">Host Type</span></div>
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
                                                            <ul class="pagination justify-content-center justify-content-md-start">
                                                                <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                                                                <li class="page-item"><a class="page-link" href="#">6</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">7</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                            </ul><!-- .pagination -->
                                                        </div>
                                                        <div class="g">
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
                                                        </div><!-- .pagination-goto -->
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
                        <h5 class="modal-title">Add Amenities Details</h5>
                        <form @submit.prevent="addHostType" class="mt-2">
                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-add">Host Type Name</label>
                                        <input v-model="host_type_name" type="text" class="form-control" id="product-name-add" placeholder="Product Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <button class="btn btn-primary" data-bs-dismiss="modal">Add Host Type</button>
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
                    <div v-if="hosts" class="modal-body modal-body-md">
                        <h5 class="modal-title">Edit Host Type Details</h5>
                        <form @submit.prevent="updateHostType" class="mt-2">
                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-edit">Host Type Name</label>
                                        <input type="text" v-model="hosts.name" class="form-control" id="product-name-edit" placeholder="Product Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update Host Type</button>
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
                    <div v-if="hosts" class="modal-body modal-body-lg text-center">
                        <div class="nk-modal py-4"> <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                            <h4 class="nk-modal-title">Are You Sure ?</h4>
                            <div class="nk-modal-text mt-n2">
                                <p class="text-soft">This Sub Category will be removed permanently.</p>
                            </div>
                            <ul class="d-flex justify-content-center gx-4 mt-4">
                                <li>
                                    <button @click="deleteHostType(hosts.id)" data-bs-dismiss="modal" id="deleteEvent" class="btn btn-success">Yes, Delete it</button>
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