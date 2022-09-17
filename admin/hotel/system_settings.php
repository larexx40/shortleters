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
                    <div class="nk-content">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head">
                                        <div  class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title"><strong class="text-primary small">System Settings</strong></h3>
                                        </div>
                                    </div>
                                    <div class="nk-block nk-block-lg">
                                        <div class="card card-stretch">
                                            <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab"
                                                        href="#personal-info"><em
                                                            class="icon ni ni-user-circle-fill"></em><span>System
                                                            Settings</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem5"><em
                                                            class="icon ni ni-laptop"></em><span>Update settings
                                                            </span></a>
                                                </li>
                                                <!-- <li class="nav-item nav-item-trigger">
                                                    <a href="#" class="btn btn-icon btn-trigger" data-bs-toggle="modal"
                                                        data-bs-target="#modalForm"><em class="icon ni ni-edit"></em></a>
                                                </li> -->
                                            </ul>
                                            <div class="card-inner">
                                                <div class="tab-content">
                                                    <div v-if='systemSettings' class="tab-pane active" id="personal-info">
                                                        <div class="nk-block">
                                                            <div class="profile-ud-list">
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Name</span>
                                                                        <span class="profile-ud-value">{{systemSettings.name}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">IOS Version</span>
                                                                        <span class="profile-ud-value">{{systemSettings.iosversion}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Android Version</span>
                                                                        <span class="profile-ud-value">{{systemSettings.androidversion}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Web Version</span>
                                                                        <span class="profile-ud-value">{{systemSettings.webversion}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Active SMS System
                                                                            </span>
                                                                        <span class="profile-ud-value">{{systemSettings.activesmssystem}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Active Email System
                                                                            </span>
                                                                        <span class="profile-ud-value">{{systemSettings.activemailsystem}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Minimum Apartment Photo
                                                                            </span>
                                                                        <span
                                                                            class="profile-ud-value">{{systemSettings.min_apart_photo}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Maximum Apartment Highlights
                                                                            </span>
                                                                        <span
                                                                            class="profile-ud-value">{{systemSettings.max_apart_highlights}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Discount Percentage
                                                                            </span>
                                                                        <span
                                                                            class="profile-ud-value">{{systemSettings.discount_perc}}  %</span>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-ud-item">
                                                                    <div class="profile-ud wider">
                                                                        <span class="profile-ud-label">Discount Guest
                                                                            </span>
                                                                        <span
                                                                            class="profile-ud-value">{{systemSettings.discount_guest}} %</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- .profile-ud-list -->
                                                        </div>
                                                        <!-- .nk-block -->
                                                    </div>
                                                    <!-- tab pane -->
                                                    <div class="tab-pane" id="tabItem5">
                                                        <h4 class="title nk-block-title">
                                                           Update System Settings
                                                        </h4>
                 
                                                        <div class="card h-100">
                                                            <div v-if='systemSettings' class="card-inner">
                                                                <form @submit.prevent='log()' action="#" method="POST" id="changePwdForm">
                                                                    <input type="hidden" name="_token"
                                                                        value="E1eXAuR00KyTa6nB1BSSMDTvt4AN5GlPsj81YgAo" />
                                                                    <div id="formStatus"></div>
                                                                    <div class="form-group">
                                                                        <label class="form-label"  for="full-name">Name
                                                                            </label>
                                                                        <div class="form-control-wrap">
                                                                            <input v-model='systemSettings.name' type="text" class="form-control"
                                                                                required="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-label"  for="full-name">IOS Version
                                                                            </label>
                                                                        <div class="form-control-wrap">
                                                                            <input v-model='systemSettings.iosversion' type="text" class="form-control"
                                                                                required="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-label"  for="full-name">Android Version</label>
                                                                        <div class="form-control-wrap">
                                                                            <input v-model='systemSettings.androidversion' type="text" class="form-control"
                                                                                required="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-label"  for="full-name">Web Version 
                                                                            </label>
                                                                        <div class="form-control-wrap">
                                                                            <input v-model='systemSettings.webversion' type="text" class="form-control"/>
                                                                               
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-label"  for="full-name">Active SMS System: {{systemSettings.smsApi}}</label>
                                                                        <div class="form-control-wrap">
                                                                            <select class="form-select" v-model='systemSettings.activeSmsCode' aria-label="Default select example">{{systemSettings.smsApi}}
                                                                            <option value="systemSettings.activeSmsCode" selected>{{systemSettings.smsApi}}</option>
                                                                                <option v-if='systemSettings.activeSmsCode != 1' v-bind:value="1">Termi</option>
                                                                                <option v-if='systemSettings.activeSmsCode != 2' v-bind:value="2">Kudi</option>
                                                                                <option v-if='systemSettings.activeSmsCode != 3' v-bind:value="3">Smart Solution</option>
                                                                                <option v-if='systemSettings.activeSmsCode != 3' v-bind:value="99">Selected</option>
                                                                                <option  value="3">Three</option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- <div class="form-control-wrap">
                                                                            <select for='select' class="form-select js-select2 js-select2-sm" v-model="name">
                                                                                <option v-bind:value="systemSettings.activesmssystemCode" selected>{{systemSettings.activesmssystem}}</option>
                                                                                <option v-if='systemSettings.activesmssystemCode != 1' :value="{name: 'termi'}">Termi</option>
                                                                                <option v-if='systemSettings.activesmssystemCode != 2' :value="{name: 'Kudi'}">Kudi</option>
                                                                                <option v-if='systemSettings.activesmssystemCode != 3' :value="{name: 'Smart'}">Smart Solution</option>
                                                                            </select>
                                                                        </div> -->
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-label"  for="full-name">Active Email System : {{systemSettings.emailApi}}</label>
                                                                        <div class="form-control-wrap">
                                                                            <select class="form-select" v-model='systemSettings.activeEmailCode' aria-label="Default select example">{{systemSettings.emailApi}}
                                                                                <option value="systemSettings.activeEmailCode" selected>{{systemSettings.emailApi}}</option>
                                                                                <option v-if='systemSettings.activeEmailCode != 1' v-bind:value="1">SendGrid</option>
                                                                                <option v-if='systemSettings.activeEmailCode != 2' v-bind:value="2">Twilo</option>
                                                                                <option v-if='systemSettings.activeEmailCode != 3' v-bind:value="3">African Talking</option>
                                                                                <option v-if='systemSettings.activeEmailCode != 3' v-bind:value="99">Selected</option>
                                                                                <option  value="3">Three</option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- <div class="form-control-wrap">
                                                                            <select class="form-select js-select2 js-select2-sm" v-model="image">
                                                                                <option v-bind:value="systemSettings.activemailsystemCode" selected>{{systemSettings.activemailsystem}}</option>
                                                                                <option >PayStack</option>
                                                                                <option >Monify</option>
                                                                                <option >OneApp</option>
                                                                            </select>
                                                                        </div> -->
                                                                        
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-label"  for="full-name">Active Payment System
                                                                            </label>
                                                                        <div class="form-control-wrap">
                                                                            <select class="form-select" v-model='systemSettings.activePaymentCode' aria-label="Default select example" >{{systemSettings.paymentApi}}
                                                                                <option value="systemSettings.activePaymentCode" selected>{{systemSettings.paymentApi}}</option>
                                                                                <option v-if='systemSettings.activePaymentCode != 1' v-bind:value="1">PayStack</option>
                                                                                <option v-if='systemSettings.activePaymentCode != 2' v-bind:value="2">Monify</option>
                                                                                <option v-if='systemSettings.activePaymentCode != 3' v-bind:value="3">OneApp</option>
                                                                                <option v-if='systemSettings.activePaymentCode != 3' v-bind:value="99">Select</option>
                                                                                <option  value="3">Three</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-label"  for="full-name">Minimum Apartment Photo
                                                                            </label>
                                                                        <div class="form-control-wrap">
                                                                            <input v-model='systemSettings.min_apart_photo' type="text" class="form-control"
                                                                                required="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-label"  for="full-name">maximum Apartment Highlights
                                                                            </label>
                                                                        <div class="form-control-wrap">
                                                                            <input v-model='systemSettings.max_apart_highlights' type="text" class="form-control"
                                                                                required="" />
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="email-address">Discount Percentage
                                                                            </label>
                                                                        <div class="form-control-wrap">
                                                                            <input v-model='systemSettings.discount_perc' type="text" class="form-control"
                                                                                required="" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="form-label" for="email-address">Discount Guest
                                                                            </label>
                                                                        <div class="form-control-wrap">
                                                                            <input v-model='systemSettings.discount_guest' type="text" class="form-control"
                                                                                required="" />
                                                                        </div>
                                                                    </div>

                                                                    
                                                                    <div class="form-group">
                                                                        <button type="submit"
                                                                            class="btn btn-lg btn-primary changePwdBtn">
                                                                            Update Settings
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
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
                        <h5 class="modal-title">Add Sub Building Type Details</h5>
                        <form @submit.prevent="addBuildingSubType" class="mt-2">
                            <div class="row g-gs">
                                <div v-if="buildingTypes" class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-add">SelectBuilding Type</label>
                                        <select class="form-select js-select2 js-select2-sm" v-model="building_type_id" data-search="off" data-placeholder="Bulk Action">
                                            <option value="null">Select Building Type</option>
                                            <option v-for="(item, index) in buildingTypes" v-bind:value="item.buildingTypeid">{{item.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-add">Sub Building Type Name</label>
                                        <input v-model="sub_building_type_name" type="text" class="form-control" id="product-name-add" placeholder="Sub Building Type Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-add">Sub Building Type Description</label>
                                        <input v-model="sub_building_type_description" type="text" class="form-control" id="product-name-add" placeholder="Sub Building Description">
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
                    <div v-if="sub_building_type" class="modal-body modal-body-md">
                        <h5 class="modal-title">Edit Sub Building Type Details</h5>
                        <form @submit.prevent="updateBuildingSubType" class="mt-2">
                            <div class="row g-gs">
                                <div v-if="buildingTypes" class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-add">Select Building Type</label>
                                        <select class="form-select js-select2 js-select2-sm" v-model="sub_building_type.build_type" data-search="off" data-placeholder="Bulk Action">
                                            <option value="null">Select Building Type</option>
                                            <option v-for="(item, index) in buildingTypes" v-bind:value="item.buildingTypeid">{{item.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-edit">Building Sub Type Name</label>
                                        <input type="text" v-model="sub_building_type.name" class="form-control" id="product-name-edit" placeholder="Sub Building Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="product-name-edit">Building Sub Type Description</label>
                                        <input type="text" v-model="sub_building_type.description" class="form-control" id="product-name-edit" placeholder="Sub Building Description">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update Sub Building Type</button>
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
                    <div v-if="sub_building_type" class="modal-body modal-body-lg text-center">
                        <div class="nk-modal py-4"> <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                            <h4 class="nk-modal-title">Are You Sure ?</h4>
                            <div class="nk-modal-text mt-n2">
                                <p class="text-soft">This Sub Building Type will be removed permanently.</p>
                            </div>
                            <ul class="d-flex justify-content-center gx-4 mt-4">
                                <li>
                                    <button @click="deleteBuildingSubType(sub_building_type.id)" data-bs-dismiss="modal" id="deleteEvent" class="btn btn-success">Yes, Delete it</button>
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