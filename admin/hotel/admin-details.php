<?php 
    include "header.php";
?>
    <!-- Page Title  -->
    <title>Blank - Layout | DashLite Admin Template</title>
    <!-- StyleSheets  -->
    
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
                    <div  class="nk-content ">
                        <div  class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head">
                                        <div v-if='getAdmin_details' class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Admins/ <strong class="text-primary small">{{getAdmin_details.name}}</strong></h3>
                                        </div>
                                    </div>
                                    <div class="nk-block nk-block-lg">
                                        <div class="card card-stretch">
                                            <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#personal-info"><em class="icon ni ni-user-circle-fill"></em><span>Personal information</span></a>
                                                </li>
                                                <!-- <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#profile-overview"><em class="icon ni ni-eye-fill"></em><span>Overviews</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#profile-review"><em class="icon ni ni-thumbs-up"></em><span>Review</span> </a>
                                                </li>
                                                <li class="nav-item nav-item-trigger">
                                                    <a href="#" class="btn btn-icon btn-trigger"><em class="icon ni ni-edit"></em></a>
                                                </li> -->
                                            </ul>
                                            <div class="card-inner">
                                                <div class="tab-content">
                                                <div v-if='getAdmin_details' class="tab-pane active" id="personal-info">
                                                        <div class="nk-block">
                                                            <div class="profile-ud-list">
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Username</span>
                                                                        <span class="profile-ud-value">{{getAdmin_details.username}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Fullname</span>
                                                                        <span class="profile-ud-value">{{getAdmin_details.name}}</span>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Address</span>
                                                                        <span class="profile-ud-value">{{getAdmin_details.address}}</span>
                                                                    </div>
                                                                </div> -->
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Email
                                                                            Address</span>
                                                                        <span
                                                                            class="profile-ud-value">{{getAdmin_details.email}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Status</span>
                                                                        <span v-if='getAdmin_details.status == 1 || getAdmin_details.status == "Active"'class="profile-ud-value text-success">{{getAdmin_details.status}}</span>
                                                                        <span v-else class="profile-ud-value text-danger">{{getAdmin_details.status}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Super Admin</span>
                                                                        <span class="profile-ud-value">{{getAdmin_details.superAdmin}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- .profile-ud-list -->
                                                        </div>
                                                        <!-- .nk-block -->
                                                        <!-- .nk-block -->
                                                    </div><!-- tab pane -->
                                                    <!--tab pane-->
                                                    <div class="tab-pane" id="profile-overview">
                                                        <div class="nk-block-head nk-block-head-md">
                                                            <div class="nk-block-between">
                                                                <div class="nk-block-head-content">
                                                                    <h5 class="nk-block-title">Profile Overview</h5>
                                                                </div><!-- .nk-block-head-content -->
                                                                <div class="nk-block-head-content">
                                                                    <div class="toggle-wrap nk-block-tools-toggle">
                                                                        <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                                                        <div class="toggle-expand-content" data-content="pageMenu">
                                                                            <ul class="nk-block-tools g-3">
                                                                                <li>
                                                                                    <div class="drodown">
                                                                                        <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-bs-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span class="d-none d-md-inline">Last</span> 30 Days</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                                            <ul class="link-list-opt no-bdr">
                                                                                                <li><a href="#"><span>Last 30 Days</span></a></li>
                                                                                                <li><a href="#"><span>Last 6 Months</span></a></li>
                                                                                                <li><a href="#"><span>Last 1 Years</span></a></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div><!-- .toggle-wrap -->
                                                                </div><!-- .nk-block-head-content -->
                                                            </div>
                                                        </div><!-- .nk-block-head -->
                                                        <div class="nk-block">
                                                            <div class="row g-gs">
                                                                <div class="col-xxl-8 col-lg-12">
                                                                    <div class="card card-full card-bordered border-light">
                                                                        <div class="nk-ecwg nk-ecwg5">
                                                                            <div class="card-inner">
                                                                                <div class="card-title-group align-start pb-3 g-2">
                                                                                    <div class="card-title">
                                                                                        <h6 class="title">Total Earning</h6>
                                                                                    </div>
                                                                                    <div class="card-tools">
                                                                                        <em class="card-hint icon ni ni-help" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="Revenu of this month" aria-label="Revenu of this month"></em>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="data-group">
                                                                                    <div class="data">
                                                                                        <div class="title">Monthly</div>
                                                                                        <div class="amount amount-sm">9.28K</div>
                                                                                        <div class="change up"><em class="icon ni ni-arrow-long-up"></em>4.63%</div>
                                                                                    </div>
                                                                                    <div class="data">
                                                                                        <div class="title">Weekly</div>
                                                                                        <div class="amount amount-sm">2.69K</div>
                                                                                        <div class="change down"><em class="icon ni ni-arrow-long-down"></em>1.92%</div>
                                                                                    </div>
                                                                                    <div class="data">
                                                                                        <div class="title">Daily (Avg)</div>
                                                                                        <div class="amount amount-sm">0.94K</div>
                                                                                        <div class="change up"><em class="icon ni ni-arrow-long-up"></em>3.45%</div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="nk-ecwg5-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                                                                    <canvas class="lms-line-chart-s4 chartjs-render-monitor" id="storeVisitors" height="140" style="display: block; width: 707px; height: 140px;" width="707"></canvas>
                                                                                </div>
                                                                                <div class="chart-label-group">
                                                                                    <div class="chart-label">01 Jul, 2020</div>
                                                                                    <div class="chart-label">30 Jul, 2020</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- .card -->
                                                                </div><!-- .col -->
                                                                <div class="col-xxl-4">
                                                                    <div class="row g-gs">
                                                                        <div class="col-xxl-12 col-md-6">
                                                                            <div class="card card-full card-bordered border-light">
                                                                                <div class="nk-ecwg nk-ecwg3">
                                                                                    <div class="card-inner pb-0">
                                                                                        <div class="card-title-group">
                                                                                            <div class="card-title">
                                                                                                <h6 class="title"><a href="">Active Students</a></h6>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="data">
                                                                                            <div class="data-group">
                                                                                                <div class="amount">329</div>
                                                                                                <div class="info text-end"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last week</span></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div><!-- .card-inner -->
                                                                                    <div class="nk-ecwg3-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                                                                        <canvas class="lms-line-chart-s1 chartjs-render-monitor" id="activeStudents" height="66" style="display: block; width: 363px; height: 66px;" width="363"></canvas>
                                                                                    </div>
                                                                                </div><!-- .nk-ecwg -->
                                                                            </div><!-- .card -->
                                                                        </div><!-- .col -->
                                                                        <div class="col-xxl-12 col-md-6">
                                                                            <div class="card card-full card-bordered border-light">
                                                                                <div class="nk-ecwg nk-ecwg3">
                                                                                    <div class="card-inner pb-0">
                                                                                        <div class="card-title-group">
                                                                                            <div class="card-title">
                                                                                                <h6 class="title"><a href="">New Enrolment</a></h6>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="data">
                                                                                            <div class="data-group">
                                                                                                <div class="amount">194</div>
                                                                                                <div class="info text-end"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. Yesterday</span></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div><!-- .card-inner -->
                                                                                    <div class="nk-ecwg3-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                                                                        <canvas class="lms-line-chart-s1 chartjs-render-monitor" id="newStudents" height="66" style="display: block; width: 363px; height: 66px;" width="363"></canvas>
                                                                                    </div>
                                                                                </div><!-- .nk-ecwg -->
                                                                            </div><!-- .card -->
                                                                        </div><!-- .col -->
                                                                    </div><!-- .row -->
                                                                </div><!-- .col -->
                                                            </div><!-- .row -->
                                                        </div><!-- .nk-block -->
                                                    </div>
                                                    <!--tab pane-->
                                                    <div class="tab-pane" id="profile-review">
                                                        <div class="nk-tb-list border border-light rounded overflow-hidden">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col nk-tb-col-check">
                                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                        <input type="checkbox" class="custom-control-input" id="uid">
                                                                        <label class="custom-control-label" for="uid"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="nk-tb-col"><span class="lead-text">Student</span></div>
                                                                <div class="nk-tb-col tb-col-sm"><span class="lead-text">Course name</span></div>
                                                                <div class="nk-tb-col tb-col-md"><span class="lead-text">Rating</span></div>
                                                                <div class="nk-tb-col tb-col-lg"><span class="lead-text">Review</span></div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1 my-n1">
                                                                        <li>
                                                                            <div class="drodown">
                                                                                <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger me-n1" data-bs-toggle="dropdown" aria-expanded="false"><em class="icon ni ni-more-h"></em></a>
                                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                                    <ul class="link-list-opt no-bdr">
                                                                                        <li><a href="#"><em class="icon ni ni-mail"></em><span>Send Email to All</span></a></li>
                                                                                        <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend Selected</span></a></li>
                                                                                        <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete All</span></a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!-- .nk-tb-item -->
                                                            <div class="nk-tb-item">
                                                                <div class="nk-tb-col nk-tb-col-check">
                                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                        <input type="checkbox" class="custom-control-input" id="uid1">
                                                                        <label class="custom-control-label" for="uid1"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar bg-primary">
                                                                            <span>AB</span>
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span class="tb-lead">Abu Bin Ishtiyak</span>
                                                                            <span>info@softnio.com</span>
                                                                            <ul class="d-flex d-md-none text-warning">
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span>UI/UX Design with Adobe XD</span>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-md">
                                                                    <ul class="d-flex text-warning">
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-lg">
                                                                    <span>The instructor was very knowledgable, worked at a good peace.</span>
                                                                </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li>
                                                                            <a href="#" class="btn btn-sm btn-icon btn-trigger me-n1"><em class="icon ni ni-trash-alt text-danger"></em></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!-- .nk-tb-item -->
                                                            <div class="nk-tb-item">
                                                                <div class="nk-tb-col nk-tb-col-check">
                                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                        <input type="checkbox" class="custom-control-input" id="uid7">
                                                                        <label class="custom-control-label" for="uid7"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar bg-warning">
                                                                            <span>VL</span>
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span class="tb-lead">Victoria Lynch</span>
                                                                            <span>victoria@example.com</span>
                                                                            <ul class="d-flex d-md-none text-warning">
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span>UI/UX Design with Adobe XD</span>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-md">
                                                                    <ul class="d-flex text-warning">
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-lg">
                                                                    <span> I will highly recommend this type of instructor.</span>
                                                                </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li>
                                                                            <a href="#" class="btn btn-sm btn-icon btn-trigger me-n1"><em class="icon ni ni-trash-alt text-danger"></em></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!-- .nk-tb-item -->
                                                            <div class="nk-tb-item">
                                                                <div class="nk-tb-col nk-tb-col-check">
                                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                        <input type="checkbox" class="custom-control-input" id="uid8">
                                                                        <label class="custom-control-label" for="uid8"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar bg-success">
                                                                            <span>PN</span>
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span class="tb-lead">Patrick Newman</span>
                                                                            <span>patrick@example.com</span>
                                                                            <ul class="d-flex d-md-none text-warning">
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span>Learn Android Development with project</span>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-md">
                                                                    <ul class="d-flex text-warning">
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-lg">
                                                                    <span>I look forward to taking more classes from here.</span>
                                                                </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li>
                                                                            <a href="#" class="btn btn-sm btn-icon btn-trigger me-n1"><em class="icon ni ni-trash-alt text-danger"></em></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!-- .nk-tb-item -->
                                                            <div class="nk-tb-item">
                                                                <div class="nk-tb-col nk-tb-col-check">
                                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                        <input type="checkbox" class="custom-control-input" id="uid9">
                                                                        <label class="custom-control-label" for="uid9"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar">
                                                                            <img src="../images/avatar/d-sm.jpg" alt="">
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span class="tb-lead">Jane Harris</span>
                                                                            <span>harris@example.com</span>
                                                                            <ul class="d-flex d-md-none text-warning">
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                                <li><em class="icon ni ni-star-fill"></em></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span>Learn Android Development with project</span>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-md">
                                                                    <ul class="d-flex text-warning">
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-lg">
                                                                    <span>This was my first time it far exceeded my expectations.</span>
                                                                </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li>
                                                                            <a href="#" class="btn btn-sm btn-icon btn-trigger me-n1"><em class="icon ni ni-trash-alt text-danger"></em></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!-- .nk-tb-item -->
                                                        </div>
                                                        <br><br>
                                                        <nav>
                                                            <ul class="pagination justify-content-end">
                                                                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </div>
                                                <!--tab content-->
                                            </div>
                                            <!--card inner-->
                                        </div>
                                        <!--card-->
                                    </div>
                                    <!--nk block lg-->
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
        <div class="modal fade" tabindex="-1" id="modal_details" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Details</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="nk-block">
                            <div class="card">
                                <div class="card-inner">
                                    <div class="row pb-5">
                                        <div class="col-lg-6">
                                            <div class="product-gallery me-xl-1 me-xxl-5">
                                                <img src="../images/product/lg-a.jpg" class="rounded w-100" alt="">
                                            </div><!-- .product-gallery -->
                                        </div><!-- .col -->
                                        <div class="col-lg-6">
                                            <div class="product-info mt-5 me-xxl-5">
                                                <h4 class="product-price text-primary">$78.00 <small class="text-muted fs-14px">$98.00</small></h4>
                                                <h2 class="product-title">Classy Modern Smart watch</h2>
                                                <div class="product-rating">
                                                    <ul class="rating">
                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                        <li><em class="icon ni ni-star-fill"></em></li>
                                                        <li><em class="icon ni ni-star-half"></em></li>
                                                    </ul>
                                                    <div class="amount">(2 Reviews)</div>
                                                </div><!-- .product-rating -->
                                                <div class="product-excrept text-soft">
                                                    <p class="lead">I must explain to you how all this mistaken idea of denoun cing ple praising pain was born and I will give you a complete account of the system, and expound the actual teaching.</p>
                                                </div>
                                                <div class="product-meta">
                                                    <ul class="d-flex g-3 gx-5">
                                                        <li>
                                                            <div class="fs-14px text-muted">Type</div>
                                                            <div class="fs-16px fw-bold text-secondary">Watch</div>
                                                        </li>
                                                        <li>
                                                            <div class="fs-14px text-muted">Model Number</div>
                                                            <div class="fs-16px fw-bold text-secondary">Forerunner 290XT</div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .product-info -->
                                        </div><!-- .col -->
                                    </div><!-- .row -->
                                    <hr class="hr border-light">
                                    <div class="row g-gs flex-lg-row-reverse pt-5">
                                        
                                        <div class="col-lg-12">
                                            <h3>Reviews</h3>
                                            <div class="card card-bordered">
                                                <div class="card-inner border-bottom bg-lighter py-3">
                                                    <div class="d-sm-flex align-items-sm-center justify-content-sm-between">
                                                        <div class="pb-1 pb-sm-0">
                                                            <h5 class="title">Feature Quality</h5>
                                                            <div class="d-sm-flex">
                                                                <span class="m-0 pe-2">by <a href="#">softnio</a></span>
                                                                <span>6 days ago</span>
                                                            </div>
                                                        </div>
                                                        <ul class="rating">
                                                            <li><em class="icon ni ni-star-fill"></em></li>
                                                            <li><em class="icon ni ni-star-fill"></em></li>
                                                            <li><em class="icon ni ni-star-fill"></em></li>
                                                            <li><em class="icon ni ni-star-half-fill"></em></li>
                                                            <li><em class="icon ni ni-star"></em></li>
                                                        </ul><!-- .rating -->
                                                    </div>
                                                </div>
                                                <div class="card-inner">
                                                    <p class="text-soft">I've been using Dashlite for months now and with every update, update it's just becoming more and more better it's just becoming better. Thank you for such a great design touch. Further I definitely cooperate with your product . Highly appriciate it. Really love it</p>
                                                </div>
                                            </div>
                                            <div class="card card-bordered">
                                                <div class="card-inner border-bottom bg-lighter py-3">
                                                    <div class="d-sm-flex align-items-sm-center justify-content-sm-between">
                                                        <div class="pb-1 pb-sm-0">
                                                            <h5 class="title">Feature Quality</h5>
                                                            <div class="d-sm-flex">
                                                                <span class="m-0 pe-2">by <a href="#">softnio</a></span>
                                                                <span>6 days ago</span>
                                                            </div>
                                                        </div>
                                                        <ul class="rating">
                                                            <li><em class="icon ni ni-star-fill"></em></li>
                                                            <li><em class="icon ni ni-star-fill"></em></li>
                                                            <li><em class="icon ni ni-star-fill"></em></li>
                                                            <li><em class="icon ni ni-star-half-fill"></em></li>
                                                            <li><em class="icon ni ni-star"></em></li>
                                                        </ul><!-- .rating -->
                                                    </div>
                                                </div>
                                                <div class="card-inner">
                                                    <p class="text-soft">I've been using Dashlite for months now and with every update, update it's just becoming more and more better it's just becoming better. Thank you for such a great design touch. Further I definitely cooperate with your product . Highly appriciate it. Really love it</p>
                                                </div>
                                            </div>
                                            <div class="card card-bordered">
                                                <div class="card-inner border-bottom bg-lighter py-3">
                                                    <div class="d-sm-flex align-items-sm-center justify-content-sm-between">
                                                        <div class="pb-1 pb-sm-0">
                                                            <h5 class="title">Feature Quality</h5>
                                                            <div class="d-sm-flex">
                                                                <span class="m-0 pe-2">by <a href="#">softnio</a></span>
                                                                <span>6 days ago</span>
                                                            </div>
                                                        </div>
                                                        <ul class="rating">
                                                            <li><em class="icon ni ni-star-fill"></em></li>
                                                            <li><em class="icon ni ni-star-fill"></em></li>
                                                            <li><em class="icon ni ni-star-fill"></em></li>
                                                            <li><em class="icon ni ni-star-half-fill"></em></li>
                                                            <li><em class="icon ni ni-star"></em></li>
                                                        </ul><!-- .rating -->
                                                    </div>
                                                </div>
                                                <div class="card-inner">
                                                    <p class="text-soft">I've been using Dashlite for months now and with every update, update it's just becoming more and more better it's just becoming better. Thank you for such a great design touch. Further I definitely cooperate with your product . Highly appriciate it. Really love it</p>
                                                </div>
                                            </div>
                                            <br><br>
                                            <nav>
                                                <ul class="pagination justify-content-end">
                                                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                </ul>
                                            </nav>
                                        </div><!-- .col -->
                                    </div><!-- .row -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="logistics_price" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Details</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="card h-100">
                                                    
                            <div class="nk-tb-list is-compact">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span>Name</span></div>
                                    <div class="nk-tb-col text-end"><span>Value</span></div>
                                </div><!-- .nk-tb-head -->
                                
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>lbsweightmin</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>2,094</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>lbsweightmax</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>1,634</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>location_id</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>1,497</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>price</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>1,349</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>updated_at</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>984</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>created_at</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>879</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>status</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>598</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                            </div><!-- .nk-tb-list -->
                        </div></div>
                    <div class="modal-footer bg-light">
                        <span class="sub-text">Modal Footer Text</span>
                    </div>
                </div>
            </div>
        </div>
   </div>
    <!-- JavaScript -->
    <script src="../assets/js/bundle.js?ver=3.0.3"></script>
    <script src="../assets/js/scripts.js?ver=3.0.3"></script>
    <script src="../assets/js/charts/chart-lms.js?ver=3.0.3"></script>
    <?php include "vue-script.php"; ?>
</body>

</html>