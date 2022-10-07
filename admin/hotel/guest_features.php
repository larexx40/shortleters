<?php include "header.php"; ?>
    <title>Booking Reports</title>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div id="admin">
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
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Booking Report</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>Here is our booking report</p>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <ul class="nk-block-tools g-3">
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><span>Import Booking Report</span></a></li>
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
                                                        <div class="form-inline flex-nowrap gx-3">
                                                            <div class="form-wrap w-150px">
                                                                <select class="form-select js-select2 js-select2-sm" data-search="off" data-placeholder="Bulk Action">
                                                                    <option value="">Bulk Action</option>
                                                                    <option value="edit">Edit Selected</option>
                                                                </select>
                                                            </div>
                                                            <div class="btn-wrap">
                                                                <span class="d-none d-md-block"><button class="btn btn-dim btn-outline-light disabled">Apply</button></span>
                                                                <span class="d-md-none"><button class="btn btn-dim btn-outline-light btn-icon disabled"><em class="icon ni ni-arrow-right"></em></button></span>
                                                            </div>
                                                        </div><!-- .form-inline -->
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
                                                                                                        <label class="overline-title overline-title-alt">Room Name</label>
                                                                                                        <select class="form-select js-select2 js-select2-sm">
                                                                                                            <option value="any">Any Name</option>
                                                                                                            <option value="single">Single</option>
                                                                                                            <option value="double">Double</option>
                                                                                                            <option value="delux">Delux</option>
                                                                                                            <option value="sdelux">Super Delux</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-6">
                                                                                                    <div class="form-group">
                                                                                                        <label class="overline-title overline-title-alt">Date</label>
                                                                                                        <select class="form-select js-select2 js-select2-sm">
                                                                                                            <option value="any">All Time</option>
                                                                                                            <option value="week">Last 7 Days</option>
                                                                                                            <option value="month">Last 30 Days</option>
                                                                                                            <option value="six">Last 6 Months</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group">
                                                                                                        <button type="button" class="btn btn-secondary">Filter</button>
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
                                                            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by room name">
                                                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                                        </div>
                                                    </div>
                                                </div><!-- .card-search -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner p-0">
                                                <div class="nk-tb-list nk-tb-ulist">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid">
                                                                <label class="custom-control-label" for="uid"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col"><span class="sub-text">Room ID</span></div>
                                                        <div class="nk-tb-col tb-col-mb"><span class="sub-text">Room Type</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">From</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">To</span></div>
                                                        <div class="nk-tb-col"><span class="sub-text">Total Amount</span></div>
                                                        <div class="nk-tb-col nk-tb-col-tools text-end">
                                                            <div class="dropdown">
                                                                <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle" data-bs-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                    <ul class="link-tidy sm no-bdr">
                                                                        <li>
                                                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="single">
                                                                                <label class="custom-control-label" for="single">Single</label>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" checked="" id="double">
                                                                                <label class="custom-control-label" for="double">Double</label>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                                                <input type="checkbox" class="custom-control-input" id="suit">
                                                                                <label class="custom-control-label" for="suit">Suit</label>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- .nk-tb-item -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid1">
                                                                <label class="custom-control-label" for="uid1"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="text-primary">565601</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb">
                                                            <span>Single</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>01 Jan 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>01 Fab 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col" data-order="1229.99">
                                                            <span class="tb-amount">1229.99 <span class="currency"> USD</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="modal" data-bs-target="#viewModal" data-bs-placement="top" title="View">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item  -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid2">
                                                                <label class="custom-control-label" for="uid2"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="text-primary">658742</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb">
                                                            <span>Double</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>11 Jan 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>01 Fab 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col" data-order="10229.99">
                                                            <span class="tb-amount">10229.99 <span class="currency"> USD</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="modal" data-bs-target="#viewModal" data-bs-placement="top" title="View">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item  -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid3">
                                                                <label class="custom-control-label" for="uid3"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="text-primary">658882</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb">
                                                            <span>Delux</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>25 Jan 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>01 Fab 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col" data-order="3229.99">
                                                            <span class="tb-amount">3229.99 <span class="currency"> USD</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="modal" data-bs-target="#viewModal" data-bs-placement="top" title="View">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item  -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid4">
                                                                <label class="custom-control-label" for="uid4"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="text-primary">659982</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb">
                                                            <span>Super Delux</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>29 Jan 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>01 Fab 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col" data-order="4229.99">
                                                            <span class="tb-amount">4229.99 <span class="currency"> USD</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="modal" data-bs-target="#viewModal" data-bs-placement="top" title="View">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item  -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid5">
                                                                <label class="custom-control-label" for="uid5"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="text-primary">657782</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb">
                                                            <span>Suit</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>30 Jan 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>02 Fab 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col" data-order="4339.99">
                                                            <span class="tb-amount">4339.99 <span class="currency"> USD</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="modal" data-bs-target="#viewModal" data-bs-placement="top" title="View">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item  -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid6">
                                                                <label class="custom-control-label" for="uid6"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="text-primary">653482</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb">
                                                            <span>Super Delux</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>01 Fab 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>02 Fab 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col" data-order="4339.99">
                                                            <span class="tb-amount">4339.99 <span class="currency"> USD</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="modal" data-bs-target="#viewModal" data-bs-placement="top" title="View">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item  -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid7">
                                                                <label class="custom-control-label" for="uid7"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="text-primary">643482</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb">
                                                            <span>Super Delux</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>30 Jan 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>02 Fab 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col" data-order="3639.99">
                                                            <span class="tb-amount">3639.99 <span class="currency"> USD</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="modal" data-bs-target="#viewModal" data-bs-placement="top" title="View">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item  -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid8">
                                                                <label class="custom-control-label" for="uid8"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="text-primary">743482</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb">
                                                            <span>Suit</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>28 Jan 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>02 Fab 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col" data-order="6934.20">
                                                            <span class="tb-amount">6934.20 <span class="currency"> USD</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="modal" data-bs-target="#viewModal" data-bs-placement="top" title="View">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item  -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid9">
                                                                <label class="custom-control-label" for="uid9"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="text-primary">843482</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb">
                                                            <span>Delux</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>03 Fab 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>15 Fab 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col" data-order="6120.20">
                                                            <span class="tb-amount">6120.20 <span class="currency"> USD</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="modal" data-bs-target="#viewModal" data-bs-placement="top" title="View">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item  -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid10">
                                                                <label class="custom-control-label" for="uid10"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="text-primary">943482</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb">
                                                            <span>Double</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>26 Jan 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>20 Fab 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col" data-order="7120.20">
                                                            <span class="tb-amount">7120.20 <span class="currency"> USD</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="modal" data-bs-target="#viewModal" data-bs-placement="top" title="View">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item  -->
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input type="checkbox" class="custom-control-input" id="uid11">
                                                                <label class="custom-control-label" for="uid11"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="text-primary">103482</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb">
                                                            <span>Single</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>20 Jan 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>23 Jan 2021</span>
                                                        </div>
                                                        <div class="nk-tb-col" data-order="720.20">
                                                            <span class="tb-amount">720.20 <span class="currency"> USD</span></span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="modal" data-bs-target="#viewModal" data-bs-placement="top" title="View">
                                                                        <em class="icon ni ni-eye"></em>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item  -->
                                                </div><!-- .nk-tb-list -->
                                            </div><!-- .card-inner -->
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
    <!-- View Details Booking Report-->
    <div class="modal fade" tabindex="-1" role="dialog" id="viewModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Details</h5>
                    <div class="nk-block mt-2">
                        <div class="card card-bordered">
                            <div class="card-inner p-0">
                                <div class="nk-tb-list nk-tb-ulist">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span class="sub-text">ID</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span class="sub-text">Booking</span></div>
                                        <div class="nk-tb-col tb-col-mb"><span class="sub-text">Package</span></div>
                                        <div class="nk-tb-col tb-col-mb"><span class="sub-text">Payment</span></div>
                                        <div class="nk-tb-col"><span class="sub-text">Amount</span></div>
                                    </div><!-- .nk-tb-item -->
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="text-primary">AB-357</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-status text-success">Active</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-mb">
                                            <span>Continental</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-mb">
                                            <span class="tb-status text-success">Paid</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-amount">229.99<span class="currency"> USD</span></span>
                                        </div>
                                    </div><!-- .nk-tb-item  -->
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="text-primary">AB-332</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-status text-warning">Pending</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-mb">
                                            <span>Delux</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-mb">
                                            <span class="tb-status text-success">Paid</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-amount">329.99<span class="currency"> USD</span></span>
                                        </div>
                                    </div><!-- .nk-tb-item  -->
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="text-primary">AB-349</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-status text-success">Active</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-mb">
                                            <span>Super Delux</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-mb">
                                            <span class="tb-status text-success">Paid</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-amount">549.99<span class="currency"> USD</span></span>
                                        </div>
                                    </div><!-- .nk-tb-item  -->
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="text-primary">AB-277</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-status text-success">Active</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-mb">
                                            <span>Continental</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-mb">
                                            <span class="tb-status text-success">Paid</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-amount">249.49<span class="currency"> USD</span></span>
                                        </div>
                                    </div><!-- .nk-tb-item  -->
                                </div><!-- .nk-tb-list -->
                            </div><!-- .card-inner -->
                        </div>
                    </div>
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->

    </div>
   
    <!-- JavaScript -->
    <script src="../assets/js/bundle.js?ver=3.0.3"></script>
    <script src="../assets/js/scripts.js?ver=3.0.3"></script>
</body>

</html>