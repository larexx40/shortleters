<?php include "header.php"; ?>
    <!-- Page Title  -->
    <title>Blank - Layout | DashLite Admin Template</title>
    <!-- StyleSheets  -->
</head>

<style>
    :hover{
        color: var(--hover-color);
    }
</style>

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
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Customers</h3>
                                            </div>
                                            <div class="nk-block-head-content">
                                                <div class="toggle-wrap nk-block-tools-toggle">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                                                    <div class="toggle-expand-content" data-content="more-options">
                                                        <ul class="nk-block-tools g-3">
                                                            <li>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-right">
                                                                        <em class="icon ni ni-search"></em>
                                                                    </div>
                                                                    <input type="text" @keyup="getAllUsers(2)" v-model="kor_search" class="form-control" id="default-04" placeholder="Search by name">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-bs-toggle="dropdown">Status</a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a  @click="kor_remove_sort"><span>All</span></a></li>
                                                                            <li><a  @click="kor_add_sort(0)"><span>Banned</span></a></li>
                                                                            <li><a  @click="kor_add_sort(1)"><span>Active</span></a></li>
                                                                            <li><a  @click="kor_add_sort(2)"><span>Suspended</span></a></li>
                                                                            <li><a  @click="kor_add_sort(3)"><span>Frozen</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <!-- <li class="nk-block-tools-opt">
                                                                <a href="#" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                                <a class="btn btn-primary d-none d-md-inline-flex" data-bs-toggle="modal" href="#instructor-add"><em class="icon ni ni-plus"></em><span>Add</span></a>
                                                            </li> -->
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="card">
                                            <div class="card-inner-group">
                                                <div class="card-inner p-0">
                                                    <div class="nk-tb-list nk-tb-ulist">
                                                        <div class="nk-tb-item nk-tb-head">
                                                            <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                                    <label class="custom-control-label" for="uid"></label>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col"><span class="sub-text">User Fullname</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Username</span></div>
                                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Phone</span></div>
                                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Country</span></div>
                                                            <!-- <div class="nk-tb-col tb-col-mb"><span class="sub-text"></span>Active courses</div> -->
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1 my-n1">
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="#"><em class="icon ni ni-mail"></em><span>Send Email to All</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend Selected</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Seleted</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div v-if="!users" class="nk-tb-item">
                                                            <div class="nk-tb-col"></div>
                                                            <div class="nk-tb-col">No Record Found</div>
                                                        </div>
                                                        <div v-for="(item, index) in users" class="nk-tb-item">
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
                                                                            <span>{{item.firstname.charAt(0)}}{{item.lastname.charAt(0)}}</span>
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span class="tb-lead">{{item.firstname}} {{item.lastname}}<span class="dot dot-success d-md-none ms-1"></span></span>
                                                                            <span>{{item.email}}</span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span>{{item.username}}</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span>{{item.phoneno}}</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span>{{item.country}}</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span v-if="item.status_code < 1" class="tb-status text-danger">{{item.status}}</span>
                                                                <span v-if="item.status_code == 1" class="tb-status text-success">{{item.status}}</span>
                                                                <span v-if="item.status_code == 2" class="tb-status text-warning">{{item.status}}</span>
                                                                <span v-if="item.status_code == 3" class="tb-status text-light">{{item.status}}</span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul v-if="item.status_code < 1" class="link-list-opt no-bdr">
                                                                                    <li style="--hover-color: var(--bs-success)"><a @click="changeUserStatus(item.id, 1)"><em class="icon fa-solid fa-toggle-on"></em><span>Activate</span></a></li>
                                                                                    <li style="--hover-color: var(--bs-warning)"><a @click="changeUserStatus(item.id, 2)"><em class="icon fas fa-pause"></em><span>Mark as Suspended</span></a></li>
                                                                                    <li style="--hover-color: var(--bs-light)"><a @click="changeUserStatus(item.id, 3)"><em class="icon fa-solid fa-user-lock"></em><span>Mark as Frozen</span></a></li>
                                                                                    <li><a @click="setUserId(item.id)" href="./customer-details.php"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a @click="getUser(index)" data-bs-toggle="modal" href="#modalDelete" href="#"><em class="icon ni ni-activity-round"></em><span>Delete Shop</span></a></li>
                                                                                </ul>
                                                                                <ul v-if="item.status_code === 1" class="link-list-opt no-bdr">
                                                                                    <li style="--hover-color: var(--bs-danger)"><a @click="changeUserStatus(item.id, 0)"><em class="icon fas fa-ban"></em><span>Ban Shop</span></a></li>
                                                                                    <li style="--hover-color: var(--bs-warning)"><a @click="changeUserStatus(item.id, 2)"><em class="icon fas fa-pause"></em><span>Mark as Suspended</span></a></li>
                                                                                    <li style="--hover-color: var(--bs-light)"><a @click="changeUserStatus(item.id, 3)"><em class="icon fa-solid fa-user-lock"></em><span>Mark as Frozen</span></a></li>
                                                                                    <li><a @click="setUserId(item.id)" href="./customer-details.php"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a @click="getUser(index)" data-bs-toggle="modal" href="#modalDelete" href="#"><em class="icon ni ni-activity-round"></em><span>Delete Shop</span></a></li>
                                                                                </ul>
                                                                                <ul v-if="item.status_code === 2" class="link-list-opt no-bdr">
                                                                                    <li style="--hover-color: var(--bs-danger)"><a @click="changeUserStatus(item.id, 0)"><em class="icon fas fa-ban"></em><span>Ban Shop</span></a></li>
                                                                                    <li style="--hover-color: var(--bs-success)"><a @click="changeUserStatus(item.id, 1)"><em class="icon fas fa-toggle-on"></em><span>Activate</span></a></li>
                                                                                    <li style="--hover-color: var(--bs-light)"><a @click="changeUserStatus(item.id, 3)"><em class="icon fa-solid fa-user-lock"></em><span>Mark as Frozen</span></a></li>
                                                                                    <li><a @click="setUserId(item.id)" href="./customer-details.php"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a @click="getUser(index)" data-bs-toggle="modal" href="#modalDelete" href="#"><em class="icon ni ni-activity-round"></em><span>Delete Shop</span></a></li>
                                                                                </ul>
                                                                                <ul v-if="item.status_code == 3" class="link-list-opt no-bdr">
                                                                                    <li style="--hover-color: var(--bs-danger)"><a @click="changeUserStatus(item.id, 0)"><em class="icon fas fa-ban"></em><span>Ban Shop</span></a></li>
                                                                                    <li style="--hover-color: var(--bs-success)"><a @click="changeUserStatus(item.id, 1)"><em class="icon fas fa-toggle-on"></em><span>Activate</span></a></li>
                                                                                    <li style="--hover-color: var(--bs-warning)"><a @click="changeUserStatus(item.id, 2)"><em class="icon fas fa-pause"></em><span>Mark as Suspended</span></a></li>
                                                                                    <li><a @click="setUserId(item.id)" href="./customer-details.php"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a @click="getUser(index)" data-bs-toggle="modal" href="#modalDelete" href="#"><em class="icon ni ni-activity-round"></em><span>Delete Shop</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        
                                                    </div><!-- .nk-tb-list -->
                                                </div>
                                                <div v-if="users" class="card-inner">
                                                    <div class="nk-block-between-md g-3">
                                                        <div class="g">
                                                            <ul class="pagination justify-content-center justify-content-md-start">
                                                                <li v-if="kor_page == 1" class="page-item disabled"><a class="page-link" href="#"><em class="icon ni ni-chevrons-left"></em></a></li>
                                                                <li v-if="kor_page > 1" @click="nav_previousPage" class="page-item"><a class="page-link" href="#"><em class="icon ni ni-chevrons-left"></em></a></li>
                                                                    
                                                                <li class="page-item" v-for="page in kor_total_page">
                                                                    <a v-if='page < 7'  class="page-link" @click="nav_selectPage(page)">{{page}}</a>
                                                                </li>
                                                                <!-- <li>
                                                                        
                                                                </li> -->
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
                                                                        <select v-if="kor_total_page > 1" @change="nav_selectPage(kor_page)" v-model="kor_page" class="form-select js-select2" data-search="on" data-dropdown="xs center">
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
                                                <!--card inner-->
                                            </div>
                                        </div>
                                        <!--card-->
                                    </div><!-- .nk-block -->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="modalDelete" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content"> <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                                <div class="modal-body modal-body-lg text-center">
                                    <div class="nk-modal py-4"> <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                                        <h4 class="nk-modal-title">Are You Sure ?</h4>
                                        <div class="nk-modal-text mt-n2">
                                            <p class="text-soft">This User will be removed permanently.</p>
                                        </div>
                                        <ul class="d-flex justify-content-center gx-4 mt-4">
                                            <li>
                                                <button v-if="user" @click="deleteUser(user.id)" data-bs-dismiss="modal" id="deleteEvent" class="btn btn-success">Yes, Delete it</button>
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
                    <!-- content @e -->
                    <!-- footer @s -->
                    <?php include "content-footer.php"; ?>
                    <!-- footer @e -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- main @e -->
        </div>
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="../assets/js/bundle.js?ver=3.0.3"></script>
    <script src="../assets/js/scripts.js?ver=3.0.3"></script>
    <?php include "vue-script.php"; ?>
</body>

</html>