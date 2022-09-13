<?php include "header.php"; ?>
    <title>Customer's Dashboard</title>
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
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Customer's Lists</h3>
                                                <div class="nk-block-des text-soft">
                                                    <p>You have total 2,595 customer's.</p>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="nk-block-head-content">
                                                <div class="toggle-wrap nk-block-tools-toggle">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                    <div class="toggle-expand-content" data-content="pageMenu">
                                                        <ul class="nk-block-tools g-3">
                                                            <li><a href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                                                            <li class="nk-block-tools-opt">
                                                                <div class="drodown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a data-bs-toggle="modal" href="#add-customer"><span>Add Customer</span></a></li>
                                                                            <li><a href="#"><span>Import Customer</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div><!-- .toggle-wrap -->
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
                                                                        <option value="email">Send Email</option>
                                                                        <option value="group">Change Group</option>
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
                                                                                                <span class="sub-title dropdown-title">Filter Users</span>
                                                                                                <div class="dropdown">
                                                                                                    <a href="#" class="btn btn-sm btn-icon">
                                                                                                        <em class="icon ni ni-more-h"></em>
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="dropdown-body dropdown-body-rg">
                                                                                                <div class="row gx-6 gy-3">
                                                                                                    <div class="col-12">
                                                                                                        <div class="custom-control custom-control-sm custom-checkbox">
                                                                                                            <input type="checkbox" class="custom-control-input" id="hasEmail">
                                                                                                            <label class="custom-control-label" for="hasEmail"> Email Verified</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-6">
                                                                                                        <div class="form-group">
                                                                                                            <label class="overline-title overline-title-alt">Package</label>
                                                                                                            <select class="form-select js-select2 js-select2-sm">
                                                                                                                <option value="any">Any Package</option>
                                                                                                                <option value="continental">Continental</option>
                                                                                                                <option value="strater">Strater</option>
                                                                                                                <option value="vacation">Vacation</option>
                                                                                                                <option value="spring ">Spring </option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-6">
                                                                                                        <div class="form-group">
                                                                                                            <label class="overline-title overline-title-alt">Group</label>
                                                                                                            <select class="form-select js-select2 js-select2-sm">
                                                                                                                <option value="any">Any Group</option>
                                                                                                                <option value="platinam">Platinam</option>
                                                                                                                <option value="dimond">Dimond</option>
                                                                                                                <option value="gold">Gold</option>
                                                                                                                <option value="Silver">silver</option>
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
                                                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email">
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
                                                            <div class="nk-tb-col"><span class="sub-text">User</span></div>
                                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Last Package</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span></div>
                                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Verified</span></div>
                                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Last Check Out</span></div>
                                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Group</span></div>
                                                            <div class="nk-tb-col nk-tb-col-tools text-end">
                                                                <div class="dropdown">
                                                                    <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle" data-bs-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                        <ul class="link-tidy sm no-bdr">
                                                                            <li>
                                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" checked="" id="gp">
                                                                                    <label class="custom-control-label" for="gp">Group</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" checked="" id="ph">
                                                                                    <label class="custom-control-label" for="ph">Phone</label>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="vri">
                                                                                    <label class="custom-control-label" for="vri">Verified</label>
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
                                                                <a href="#">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar bg-primary">
                                                                            <span>AB</span>
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span class="tb-lead">Abu Bin Ishtiyak <span class="dot dot-success d-md-none ms-1"></span></span>
                                                                            <span>info@softnio.com</span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span>Continental</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span>+811 847-4958</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <ul class="list-status">
                                                                    <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span>10 Feb 2020</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span class="tb-status text-dark">Dimond</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                                            <em class="icon ni ni-mail-fill"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Edit</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div class="nk-tb-item">
                                                            <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid2">
                                                                    <label class="custom-control-label" for="uid2"></label>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <div class="user-card">
                                                                    <div class="user-avatar">
                                                                        <img src="../imagess/avatar/a-sm.jpg" alt="">
                                                                    </div>
                                                                    <div class="user-info">
                                                                        <span class="tb-lead">Ashley Lawson <span class="dot dot-warning d-md-none ms-1"></span></span>
                                                                        <span>ashley@softnio.com</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span>Strater </span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span>+124 394-1787</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <ul class="list-status">
                                                                    <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span>07 Feb 2021</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span class="tb-status text-primary">Silver</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                                            <em class="icon ni ni-mail-fill"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Edit</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div class="nk-tb-item">
                                                            <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid3">
                                                                    <label class="custom-control-label" for="uid3"></label>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <a href="#">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar bg-dark">
                                                                            <span>MM</span>
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span class="tb-lead">Micheal Murphy <span class="dot dot-success d-md-none ms-1"></span></span>
                                                                            <span>info@niosoft.com</span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span>All Suit</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span>+811 569-6523</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <ul class="list-status">
                                                                    <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span>10 Jan 2021</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span class="tb-status text-orange">Platinum</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                                            <em class="icon ni ni-mail-fill"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Edit</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div class="nk-tb-item">
                                                            <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid4">
                                                                    <label class="custom-control-label" for="uid4"></label>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <div class="user-card">
                                                                    <div class="user-avatar">
                                                                        <img src="../imagess/avatar/b-sm.jpg" alt="">
                                                                    </div>
                                                                    <div class="user-info">
                                                                        <span class="tb-lead">Eliana Stout <span class="dot dot-warning d-md-none ms-1"></span></span>
                                                                        <span>Eliana@softnio.com</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span>Vacation</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span>+124 394-1787</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <ul class="list-status">
                                                                    <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span>07 Feb 2021</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span class="tb-status text-warning">Gold</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                                            <em class="icon ni ni-mail-fill"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Edit</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div class="nk-tb-item">
                                                            <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid5">
                                                                    <label class="custom-control-label" for="uid5"></label>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <a href="#">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar bg-warning">
                                                                            <span>LH</span>
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span class="tb-lead">Luukas Haapala<span class="dot dot-success d-md-none ms-1"></span></span>
                                                                            <span>Luukas@niosoft.com</span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span>Honeymoon</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span>+811 569-6523</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <ul class="list-status">
                                                                    <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span>02 May 2021</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span class="tb-status text-grey">Basic</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                                            <em class="icon ni ni-mail-fill"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Edit</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div class="nk-tb-item">
                                                            <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid6">
                                                                    <label class="custom-control-label" for="uid6"></label>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <div class="user-card">
                                                                    <div class="user-avatar">
                                                                        <img src="../imagess/avatar/c-sm.jpg" alt="">
                                                                    </div>
                                                                    <div class="user-info">
                                                                        <span class="tb-lead">Azul Baldwin<span class="dot dot-warning d-md-none ms-1"></span></span>
                                                                        <span>Azul@softnio.com</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span>Vacation</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span>+124 156-8756</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <ul class="list-status">
                                                                    <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span>07 Jan 2021</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span class="tb-status text-warning">Gold</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                                            <em class="icon ni ni-mail-fill"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Edit</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div class="nk-tb-item">
                                                            <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid7">
                                                                    <label class="custom-control-label" for="uid7"></label>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <a href="#">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar bg-primary">
                                                                            <span>DL</span>
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span class="tb-lead">Dasia Lovell<span class="dot dot-success d-md-none ms-1"></span></span>
                                                                            <span>dasia@softnio.com</span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span>Continental</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span>+811 963-4759</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <ul class="list-status">
                                                                    <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span>10 Feb 2020</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span class="tb-status text-dark">Dimond</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                                            <em class="icon ni ni-mail-fill"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Edit</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div class="nk-tb-item">
                                                            <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid8">
                                                                    <label class="custom-control-label" for="uid8"></label>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <div class="user-card">
                                                                    <div class="user-avatar">
                                                                        <img src="../imagess/avatar/d-sm.jpg" alt="">
                                                                    </div>
                                                                    <div class="user-info">
                                                                        <span class="tb-lead">Novalee Spicer<span class="dot dot-warning d-md-none ms-1"></span></span>
                                                                        <span>Novalee@softnio.com</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span>Strater </span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span>+124 394-1787</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <ul class="list-status">
                                                                    <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span>07 Feb 2021</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span class="tb-status text-primary">Silver</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                                            <em class="icon ni ni-mail-fill"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Edit</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div class="nk-tb-item">
                                                            <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid9">
                                                                    <label class="custom-control-label" for="uid9"></label>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <a href="#">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar bg-dark">
                                                                            <span>Cl</span>
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span class="tb-lead">Cielo Luna<span class="dot dot-success d-md-none ms-1"></span></span>
                                                                            <span>cielo@niosoft.com</span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span>All Suit</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span>+811 569-6523</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <ul class="list-status">
                                                                    <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span>10 Jan 2021</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span class="tb-status text-orange">Platinum</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                                            <em class="icon ni ni-mail-fill"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Edit</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div class="nk-tb-item">
                                                            <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid10">
                                                                    <label class="custom-control-label" for="uid10"></label>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col">
                                                                <a href="#">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar bg-danger">
                                                                            <span>MY</span>
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span class="tb-lead">Makiyah Yeager<span class="dot dot-success d-md-none ms-1"></span></span>
                                                                            <span>makiyah@niosoft.com</span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span>Honeymoon</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span>+811 569-6523</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <ul class="list-status">
                                                                    <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                                                </ul>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span>02 May 2021</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span class="tb-status text-grey">Basic</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                                                            <em class="icon ni ni-mail-fill"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                                                    <li class="divider"></li>
                                                                                    <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Edit</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
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
        <!-- Add Customer-->
        <div class="modal fade" tabindex="-1" role="dialog" id="add-customer">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="modal-title">Add Customer</h5>
                        <form action="#" class="mt-2">
                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="first-name">First Name</label>
                                        <input type="text" class="form-control" id="first-name" placeholder="First name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="last-name">Last Name</label>
                                        <input type="text" class="form-control" id="last-name" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="phone-no">Phone Number</label>
                                        <input type="text" class="form-control" id="phone-no" value="+880" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address">Address</label>
                                        <input type="text" class="form-control" id="address" value="2337 Kildeer Drive">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="package">Last Package</label>
                                        <select class="form-select js-select2" id="package">
                                            <option>Strater</option>
                                            <option>Honeymoon</option>
                                            <option>Vacation</option>
                                            <option>Continental</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="group">Group</label>
                                        <select class="form-select js-select2" id="group">
                                            <option>Dimond</option>
                                            <option>Silver</option>
                                            <option>Platinum</option>
                                            <option>Gold</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <button class="btn btn-primary">Add Customer</button>
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
</body>

</html>