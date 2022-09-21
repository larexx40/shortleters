<?php include "./header.php" ?>
    <!-- Page Title  -->
    <title>Blank - Layout | DashLite Admin Template</title>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div id="admin" v-cloak>
        <?php include "./loading.php" ?>
        <div class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                <!-- sidebar @s -->
                <?php include "./sidebar.php"; ?>
                <!-- sidebar @e -->
                <!-- wrap @s -->
                <div class="nk-wrap ">
                    <!-- main header @s -->
                    <?php include "./content-header.php"; ?>
                    <!-- main header @e -->
                    <!-- content @s -->
                    <div class="nk-content ">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div v-if="apartment_details" class="nk-content-body">
                                    <div class="nk-block-head">
                                        <div class="nk-block-between g-3">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Apartment / <strong class="text-primary small">{{apartment_details.name}}</strong></h3>
                                            </div>
                                            <div class="nk-block-head-content">
                                                <a href="./all_apartments.php" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                                <a href="./all_apartments.php" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block nk-block-lg">
                                        <div class="card card-stretch">
                                            <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#personal-info"><span>Personal information</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a @click="getOrderAndTransaction" class="nav-link" data-bs-toggle="tab" href="#profile-overview"><span>Overview</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a @click="getUserOrders(3)" class="nav-link" data-bs-toggle="tab" href="#profile-orders"><span>Bookings</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a @click="getApartmentImagesById(3)" class="nav-link" data-bs-toggle="tab" href="#profile-notifications"><span>Apartment Images</span> </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#profile-activity"><span>Apartment Safety Features</span> </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a @click="getApartmentFacilitiesById(3)" class="nav-link" data-bs-toggle="tab" href="#profile-address"><span>Apartment Facilities</span> </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a @click="getApartmentTransactions(3)" class="nav-link" data-bs-toggle="tab" href="#profile-transactions"><span>Transactions</span> </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a @click="getApartmentAdditionalChargesById(3)" class="nav-link" data-bs-toggle="tab" href="#profile-complains"><span>Additional Charges</span> </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a @click="getApartmentAdditionalChargesById(3)" class="nav-link" data-bs-toggle="tab" href="#house_rules"><span>House Rules</span> </a>
                                                </li>
                                            </ul>
                                            <div class="card-inner">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="personal-info">
                                                        <div class="nk-block">
                                                            <div class="profile-ud-list">
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Title</span>
                                                                        <span class="profile-ud-value">{{apartment_details.title}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Apartment Name</span>
                                                                        <span class="profile-ud-value">{{apartment_details.name}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Apartment Details</span>
                                                                        <span class="profile-ud-value">{{apartment_details.description}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Space Description</span>
                                                                        <span class="profile-ud-value">{{apartment_details.space_description}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Guest Access</span>
                                                                        <span class="profile-ud-value">{{apartment_details.guest_access}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Other Details</span>
                                                                        <span class="profile-ud-value">{{apartment_details.other_details}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Currency</span>
                                                                        <span class="profile-ud-value">{{apartment_details.listing_currency_name}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Location Sharing</span>
                                                                        <span class="profile-ud-value">{{apartment_details.location_sharing}}</span>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .profile-ud-list -->
                                                        </div><!-- .nk-block -->
                                                        <div class="nk-block">
                                                            <div class="nk-block-head nk-block-head-line">
                                                                <h6 class="title overline-title text-base">Apartment Additional Info</h6>
                                                            </div><!-- .nk-block-head -->
                                                            <div class="profile-ud-list">
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Created Date</span>
                                                                        <span class="profile-ud-value">{{apartment_details.created}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Status</span>
                                                                        <span v-if="apartment_details.apartment_status_code == 4" class="profile-ud-value text-danger">{{apartment_details.apartment_status}}</span>
                                                                        <span v-if="apartment_details.apartment_status_code === 1" class="profile-ud-value text-success">{{apartment_details.apartment_status}}</span>
                                                                        <span v-if="apartment_details.apartment_status_code === 2" class="profile-ud-value text-warning">{{apartment_details.apartment_status}}</span>
                                                                        <span v-if="apartment_details.apartment_status_code === 3" class="profile-ud-value text-light">{{apartment_details.apartment_status}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Apartment Address</span>
                                                                        <span class="profile-ud-value">{{apartment_details.apartment_address}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Apartment Local Government</span>
                                                                        <span class="profile-ud-value">{{apartment_details.apartment_lga}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Country</span>
                                                                        <span class="profile-ud-value">{{apartment_details.apartment_country}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">State</span>
                                                                        <span class="profile-ud-value">{{apartment_details.apartment_state}}</span>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .profile-ud-list -->
                                                        </div><!-- .nk-block -->
                                                    </div>
                                                    <!--tab pane-->
                                                    <div class="tab-pane" id="profile-overview">
                                                        <div class="nk-block-head nk-block-head-md">
                                                            <div class="nk-block-between">
                                                                <div class="nk-block-head-content">
                                                                    <h5 class="nk-block-title">Profile Overview</h5>
                                                                </div>
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-4">
                                                                    <div class="row g-gs">
                                                                        <div class="col-xxl-12 col-md-6">
                                                                            <div class="card card-full card-bordered border-light">
                                                                                <div class="nk-ecwg nk-ecwg3">
                                                                                    <div class="card-inner pb-0">
                                                                                        <div class="card-title-group">
                                                                                            <div class="card-title">
                                                                                                <h6 class="title"><a href="">Total Orders</a></h6>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="data">
                                                                                            <div class="data-group">
                                                                                                <div v-if="user_orders" class="amount">{{user_orders.length}}</div>
                                                                                                <div v-if="!user_orders" class="amount">0</div>
                                                                                                <div class="info text-end"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last week</span></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="nk-ecwg3-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                                                                        <canvas class="lms-line-chart-s1 chartjs-render-monitor" id="activeStudents" height="66" style="display: block; width: 363px; height: 66px;" width="363"></canvas>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xxl-12 col-md-6">
                                                                            <div class="card card-full card-bordered border-light">
                                                                                <div class="nk-ecwg nk-ecwg3">
                                                                                    <div class="card-inner pb-0">
                                                                                        <div class="card-title-group">
                                                                                            <div class="card-title">
                                                                                                <h6 class="title"><a href="">Total Transactions</a></h6>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="data">
                                                                                            <div class="data-group">
                                                                                                <div v-if="user_transactions" class="amount">{{user_transactions.length}}</div>
                                                                                                <div v-if="!user_transactions" class="amount">0</div>
                                                                                                <div class="info text-end"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. Yesterday</span></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="nk-ecwg3-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                                                                        <canvas class="lms-line-chart-s1 chartjs-render-monitor" id="newStudents" height="66" style="display: block; width: 363px; height: 66px;" width="363"></canvas>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- tab pane -->
                                                    <div class="tab-pane" id="profile-orders">
                                                        <div v-if="user_orders" class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">#</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Orders</span>
                                                                </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <span class="lead-text">Preview</span>
                                                                </div>
                                                            </div>
                                                            <div v-for="(item, index) in user_orders" class="nk-tb-item">
                                                                <div class="nk-tb-col"> {{parseInt(index) + 1}} </div>
                                                                <div class="nk-tb-col"> {{item.orderRefno}} </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li @click="getOrder(index)" data-bs-toggle="modal" data-bs-target="#modal_orders">
                                                                            <a href="#" class="btn btn-sm btn-icon btn-trigger me-n1"><em class="icon ni ni-eye-fill text-danger"></em></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div v-if="!user_orders" class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                            No Records Found
                                                        </div>
                                                        <br><br>
                                                        <nav>
                                                            <ul v-if="user_orders" class="pagination justify-content-end">
                                                                <li v-if="kor_page == 1" class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                                <li v-if="kor_page > 1" @click="nav_dynamic_previousPage('user_orders')" class="page-item"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                                <li v-for="page in kor_total_page" class="page-item"><a @click="nav_dynamic_selectPage('user_orders', page)" class="page-link" href="#">{{page}}</a></li>
                                                                <li v-if="kor_page < kor_total_page" @click="nav_dynamic_nextPage('user_orders')" class="page-item"><a class="page-link" href="#">Next</a></li>
                                                                <li v-if="kor_page == kor_total_page" class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <!--tab pane-->
                                                    <div class="tab-pane" id="profile-notifications">
                                                        <div v-if="apartment_images" class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">#</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Image</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Cover Photo</span>
                                                                </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <span class="lead-text">Preview</span>
                                                                </div>
                                                            </div>
                                                            <div v-for="(item, index) in apartment_images" class="nk-tb-item">
                                                                <div class="nk-tb-col"> {{parseInt(index) + 1}} </div>
                                                                <div class="nk-tb-col tb-product"> <img class="thumb" :src="item.img" alt="apartment image"> </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">{{item.cover}}</span>
                                                                </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li data-bs-toggle="modal" data-bs-target="#modal_notification">
                                                                            <a @click="getItemIndex(index)" href="#" class="btn btn-sm btn-icon btn-trigger me-n1"><em class="icon ni ni-eye-fill text-danger"></em></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div v-if="!apartment_images" class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                            No Records Found
                                                        </div>
                                                        <br><br>
                                                        <nav>
                                                            <ul v-if="apartment_images" class="pagination justify-content-end">
                                                                <li v-if="kor_page == 1" class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                                <li v-if="kor_page > 1" @click="nav_dynamic_previousPage('user_notification')" class="page-item"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                                <li v-for="page in kor_total_page" class="page-item"><a @click="nav_dynamic_selectPage('user_notification', page)" class="page-link" href="#">{{page}}</a></li>
                                                                <li v-if="kor_page < kor_total_page" @click="nav_dynamic_nextPage('user_notification')" class="page-item"><a class="page-link" href="#">Next</a></li>
                                                                <li v-if="kor_page == kor_total_page" class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <!--tab pane-->
                                                    <div v-if="apartment_details" class="tab-pane" id="profile-activity">
                                                        <div v-if="apartment_details.safety_ids" class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">#</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Safety Feature</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Icon</span>
                                                                </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <span class="lead-text">Description</span>
                                                                </div>
                                                            </div>
                                                            <div v-for="(item, index) in apartment_details.safety_ids" class="nk-tb-item">
                                                                <div class="nk-tb-col"> {{parseInt(index) + 1}} </div>
                                                                <div class="nk-tb-col"> {{item.details.name}} </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text"><em :class="'icon ' + item.details.icon" ></em></span>
                                                                </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li>
                                                                            <a href="#" class="btn btn-sm btn-icon btn-trigger me-n1">{{item.details.description}}</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div v-if="!apartment_details.safety_ids" class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">#</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Safety Feature</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Icon</span>
                                                                </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <span class="lead-text">Description</span>
                                                                </div>
                                                            </div>
                                                            <div v-for="(item, index) in user_activities" class="nk-tb-item">
                                                                No Record
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                    </div>
                                                    <!--tab pane-->

                                                    <div class="tab-pane" id="profile-address">
                                                        <div v-if="apartment_facilities"  class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">#</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Facilities</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Total Number</span>
                                                                </div>
                                                            </div>
                                                            <div v-for="(item, index) in apartment_facilities" class="nk-tb-item">
                                                                <div class="nk-tb-col"> {{parseInt(index) + 1}}  </div>
                                                                <div class="nk-tb-col"> {{item.facility_name}} </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">{{item.total_number}}</span>
                                                                </div>
                                                                <!-- <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li @click="getAddress(index)" data-bs-toggle="modal" data-bs-target="#modal-address">
                                                                            <a href="#" class="btn btn-sm btn-icon btn-trigger me-n1"><em class="icon ni ni-eye-fill text-danger"></em></a>
                                                                        </li>
                                                                    </ul>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                        <div v-if="!apartment_facilities" class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                                No Records Found
                                                        </div>
                                                        <br><br>
                                                        <nav>
                                                            <ul v-if="apartment_facilities" class="pagination justify-content-end">
                                                                <li v-if="kor_page == 1" class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                                <li v-if="kor_page > 1" @click="nav_dynamic_previousPage('user_address')" class="page-item"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                                <li v-for="page in kor_total_page" class="page-item"><a @click="nav_dynamic_selectPage('user_address', page)" class="page-link" href="#">{{page}}</a></li>
                                                                <li v-if="kor_page < kor_total_page" @click="nav_dynamic_nextPage('user_address')" class="page-item"><a class="page-link" href="#">Next</a></li>
                                                                <li v-if="kor_page == kor_total_page" class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <!--tab pane-->

                                                    <div class="tab-pane" id="profile-transactions">
                                                        <div v-if="apartment_transactions" class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">#</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Booking Id</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">User Fullname</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Amount</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Time</span>
                                                                </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <span class="lead-text">Status</span>
                                                                </div>
                                                            </div>
                                                            <div v-for="(item, index) in apartment_transactions" class="nk-tb-item">
                                                                <div class="nk-tb-col"> {{parseInt(index) + 1 }} </div>
                                                                <div class="nk-tb-col"> {{item.booking_id}} </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">{{item.user_fullname}}</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">#{{item.amttopay}}</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">{{item.ordertime}}</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span v-if="item.status_code < 1" class="lead-text text-danger">{{item.status}}</span>
                                                                    <span v-if="item.status_code > 0" class="lead-text text-success">{{item.status}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div v-if="!apartment_transactions" class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                            No Record Found
                                                        </div>
                                                        <br><br>
                                                        <nav>
                                                            <ul v-if="apartment_transactions" class="pagination justify-content-end">
                                                                <li v-if="kor_page == 1" class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                                <li v-if="kor_page > 1" @click="nav_dynamic_previousPage('user_transaction')" class="page-item"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                                <li v-for="page in kor_total_page" class="page-item"><a @click="nav_dynamic_selectPage('user_transaction', page)" class="page-link" href="#">{{page}}</a></li>
                                                                <li v-if="kor_page < kor_total_page" @click="nav_dynamic_nextPage('user_transaction')" class="page-item"><a class="page-link" href="#">Next</a></li>
                                                                <li v-if="kor_page == kor_total_page" class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <!--tab pane-->

                                                    <div class="tab-pane" id="profile-complains">
                                                        <div v-if="apartment_charges" class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">#</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Apartment Additional Charge</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Additional Charge Rate/Price</span>
                                                                </div>
                                                                <!-- <div class="nk-tb-col nk-tb-col-tools">
                                                                    <span class="lead-text">Preview</span>
                                                                </div> -->
                                                            </div>
                                                            <div v-for="(item, index) in apartment_charges" class="nk-tb-item">
                                                                <div class="nk-tb-col"> {{parseInt(index) + 1}} </div>
                                                                <div class="nk-tb-col"> {{item.add_charge_name}}  </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">{{item.price}}</span>
                                                                </div>
                                                                <!-- <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li @click="getUserComplain(index)" data-bs-toggle="modal" data-bs-target="#modal-complains">
                                                                            <a href="#" class="btn btn-sm btn-icon btn-trigger me-n1"><em class="icon ni ni-eye-fill text-danger"></em></a>
                                                                        </li>
                                                                    </ul>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                        <div v-if="!apartment_charges" class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">#</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Apartment Additional Charge</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Additional Charge Rate/Price</span>
                                                                </div>
                                                                <!-- <div class="nk-tb-col nk-tb-col-tools">
                                                                    <span class="lead-text">Preview</span>
                                                                </div> -->
                                                            </div>
                                                            <div class="nk-tb-item">
                                                                <div class="text-center">
                                                                    No Records Found    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <nav>
                                                            <ul v-if="apartment_charges" class="pagination justify-content-end">
                                                                <li v-if="kor_page == 1" class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                                <li v-if="kor_page > 1" @click="nav_dynamic_previousPage('user_complain')" class="page-item"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                                <li v-for="page in kor_total_page" class="page-item"><a @click="nav_dynamic_selectPage('user_complain', page)" class="page-link" href="#">{{page}}</a></li>
                                                                <li v-if="kor_page < kor_total_page" @click="nav_dynamic_nextPage('user_complain')" class="page-item"><a class="page-link" href="#">Next</a></li>
                                                                <li v-if="kor_page == kor_total_page" class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                                                            </ul>
                                                        </nav>
                                                    </div>

                                                    <div class="tab-pane" id="house_rules">
                                                        <div v-if="apartment_charges" class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">#</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Apartment Additional Charge</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Additional Charge Rate/Price</span>
                                                                </div>
                                                                <!-- <div class="nk-tb-col nk-tb-col-tools">
                                                                    <span class="lead-text">Preview</span>
                                                                </div> -->
                                                            </div>
                                                            <div v-for="(item, index) in apartment_charges" class="nk-tb-item">
                                                                <div class="nk-tb-col"> {{parseInt(index) + 1}} </div>
                                                                <div class="nk-tb-col"> {{item.add_charge_name}}  </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">{{item.price}}</span>
                                                                </div>
                                                                <!-- <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li @click="getUserComplain(index)" data-bs-toggle="modal" data-bs-target="#modal-complains">
                                                                            <a href="#" class="btn btn-sm btn-icon btn-trigger me-n1"><em class="icon ni ni-eye-fill text-danger"></em></a>
                                                                        </li>
                                                                    </ul>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                        <div v-if="!apartment_charges" class="nk-tb-list border border-light rounded overflow-hidden is-compact">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">#</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Apartment Additional Charge</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text">Additional Charge Rate/Price</span>
                                                                </div>
                                                                <!-- <div class="nk-tb-col nk-tb-col-tools">
                                                                    <span class="lead-text">Preview</span>
                                                                </div> -->
                                                            </div>
                                                            <div class="nk-tb-item">
                                                                <div class="text-center">
                                                                    No Records Found    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <nav>
                                                            <ul v-if="apartment_charges" class="pagination justify-content-end">
                                                                <li v-if="kor_page == 1" class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                                <li v-if="kor_page > 1" @click="nav_dynamic_previousPage('user_complain')" class="page-item"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a></li>
                                                                <li v-for="page in kor_total_page" class="page-item"><a @click="nav_dynamic_selectPage('user_complain', page)" class="page-link" href="#">{{page}}</a></li>
                                                                <li v-if="kor_page < kor_total_page" @click="nav_dynamic_nextPage('user_complain')" class="page-item"><a class="page-link" href="#">Next</a></li>
                                                                <li v-if="kor_page == kor_total_page" class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <!--tab pane-->
                                                    
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
                    <?php include "./content-footer.php"; ?>
                    <!-- footer @e -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- main @e -->
        </div>
        <!-- app-root @e -->
        <div class="modal fade" tabindex="-1" id="modal_orders" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order Details</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div v-if="user_order" class="modal-body">
                        <div class="card h-100">
                                                    
                            <div class="nk-tb-list is-compact">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span>order_refno				
                                    </span></div>
                                    <div class="nk-tb-col text-end"><span>{{user_order.orderRefno}}</span></div>
                                </div><!-- .nk-tb-head -->
                                
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Product Name</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span v-if="user_order.productName" class="tb-sub tb-amount"><span>{{user_order.productName}}</span></span>
                                        <span v-if="!user_order.productName" class="tb-sub tb-amount"><span>Product Not Found</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Quantity</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_order.quantity}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Price</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_order.price}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Total Amount</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_order.amount}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                
                            </div><!-- .nk-tb-list -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal_notification" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apartment Details</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div v-if="apartment_img" class="modal-body">
                        <div class="card h-100">
                                                    
                            <div class="nk-tb-list is-compact">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span>Apartment Name</span></div>
                                    <div class="nk-tb-col text-center"><span>{{apartment_img.aprtment_name}}</span></div>
                                </div><!-- .nk-tb-head -->
                                
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Apartment Image</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount dz-image"><img :src="apartment_img.img" alt="apartment image"></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Cover Image?</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{apartment_img.cover}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Date</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{apartment_img.created}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                            </div><!-- .nk-tb-list -->
                        </div></div>
                    <!-- <div class="modal-footer bg-light">
                        <span class="sub-text">Modal Footer Text</span>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-activity" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Activity Details</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div v-if="user_activity" class="modal-body">
                        <div class="card h-100">
                                                    
                            <div class="nk-tb-list is-compact">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span>Email		
                                    </span></div>
                                    <div class="nk-tb-col text-end"><span>{{user_activity.email}}</span></div>
                                </div><!-- .nk-tb-head -->
                                
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Browser</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_activity.browser}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Activity</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_activity.activity}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Ip Address</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_activity.ip}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Date</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_activity.date}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Location</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_activity.location}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <!-- .nk-tb-item -->
                            </div><!-- .nk-tb-list -->
                        </div></div>
                    <div class="modal-footer bg-light">
                        <span class="sub-text">Modal Footer Text</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-address" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Address Details</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div v-if="user_address" class="modal-body">
                        <div class="card h-100">
                                                    
                            <div class="nk-tb-list is-compact">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span>Fullname		
                                    </span></div>
                                    <div class="nk-tb-col text-end"><span>{{user_address.fullname}}</span></div>
                                </div><!-- .nk-tb-head -->
                                
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Phone Number</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_address.phoneno}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Address No</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_address.addressno}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Address</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_address.address}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>State</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_address.state}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Local Government</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_address.lga}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Zipcode</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_address.zipcode}}</span></span>
                                    </div>
                                </div>
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Country</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_address.country}}</span></span>
                                    </div>
                                </div>
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Default Address</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span v-if="user_address.defultaddress > 0" class="tb-sub tb-amount"><span class="text-success">Default Address</span></span>
                                        <span v-if="user_address.defultaddress < 1" class="tb-sub tb-amount"><span class="text-light">Not Default Address</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <!-- .nk-tb-item -->
                            </div><!-- .nk-tb-list -->
                        </div></div>
                    <div class="modal-footer bg-light">
                        <span class="sub-text">Modal Footer Text</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal-transactions" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Transaction Details</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div v-if="user_transaction" class="modal-body">
                        <div class="card h-100">
                                                    
                            <div class="nk-tb-list is-compact">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span>Name</span></div>
                                    <div class="nk-tb-col text-end"><span>{{user_transaction.userFullName}}</span></div>
                                </div><!-- .nk-tb-head -->
                                
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Address Sent To</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.addresssentto}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Trans Hash</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.transhash}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Live Trans Id</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.livetransid}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Order Id</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.order_id}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Order Time</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.order_time}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Approved By</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.admin_name}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Status</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span v-if="user_transaction.status < 1" class="tb-sub tb-amount"><span class="text-warning">{{user_transaction.status_meaning}}</span></span>
                                        <span v-if="user_transaction.status == 1" class="tb-sub tb-amount"><span class="text-success">{{user_transaction.status_meaning}}</span></span>
                                        <span v-if="user_transaction.status == 2" class="tb-sub tb-amount"><span class="text-warning">{{user_transaction.status_meaning}}</span></span>
                                        <span v-if="user_transaction.status == 3" class="tb-sub tb-amount"><span class="text-light">{{user_transaction.status_meaning}}</span></span>
                                        <span v-if="user_transaction.status == 4" class="tb-sub tb-amount"><span class="text-danger">{{user_transaction.status_meaning}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->

                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>System Live Wallet</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.syslivewallet}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->

                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Confirmations</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.confirmation}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->

                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Live USD Rate</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.liveusdrate}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->

                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Coiname</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.coin_name}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->

                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Manual Status</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.manualstatus}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->

                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Approval Type</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span v-if="user_transaction.approvaltype == 0" class="tb-sub tb-amount"><span class="text-light">{{user_transaction.approvalName}}</span></span>
                                        <span v-if="user_transaction.approvaltype >= 1" class="tb-sub tb-amount"><span class="text-success">{{user_transaction.approvalName}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->



                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Btc Value</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.btcvalue}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Address Sent From</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.addresssentfrm}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>The USD Value</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.theusdval}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Live Cointype</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.livecointype}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->			
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>created_at</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.created_at}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->

                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Time Updated</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.updated_at}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->

                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Our Rate</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.ourrrate}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->

                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Amount Paid</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_transaction.amttopay}}</span></span>
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

        <div class="modal fade" tabindex="-1" id="modal-complains" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Complain Details</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div v-if="user_complain" class="modal-body">
                        <div class="card h-100">
                                                    
                            <div class="nk-tb-list is-compact">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span>Name</span></div>
                                    <div class="nk-tb-col text-end"><span>{{user_complain.name}}</span></div>
                                </div><!-- .nk-tb-head -->
                                
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Complains
                                        </span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_complain.complain}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Adminseen</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_complain.admin_seen}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Status</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span v-if="user_complain.status_code > 0" class="tb-sub tb-amount"><span class="text-success">{{user_complain.status}}</span></span>
                                        <span v-if="user_complain.status_code < 1" class="tb-sub tb-amount"><span class="text-warning">{{user_complain.status}}</span></span>
                                    </div>
                                </div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-sub"><span>Date</span></span>
                                    </div>
                                    <div class="nk-tb-col text-end">
                                        <span class="tb-sub tb-amount"><span>{{user_complain.date}}</span></span>
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
    <?php include "./vue-script.php" ?>
</body>

</html>