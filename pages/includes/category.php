<div class="sub-header">
    <div class="sub-header-inner">
        <div class="container p-0">
            <div class="d-flex align-items-center justify-content-between">
                <div v-if="apartment_category" class="navigation-wrapper">
                    <button v-for="(item, index) in apartment_category" :key="index">
                        <div @click="getApartmentsInaCategory(item.category_id, 5)" >
                            <span class="c1m2z0bj c1w8ohg7">
                                <img src="https://a0.muscache.com/pictures/8e507f16-4943-4be9-b707-59bd38d56309.jpg" alt="" width="24" height="24">
                                <div>
                                    <span >{{item.name}}</span>
                                </div>
                            </span>
                        </div>
                    </button>  
                </div>
                <div class="filter-btn d-none d-md-inline-flex">
                    <!-- triggers a modal -->
                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropfilter">
                        <span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="preserveAspectRatio="xMidYMid meet viewBox="0 0 21 21">
                                    <g transform="rotate(90 10.5 10.5)">
                                        <g fill="none" fill-rule="evenodd" stroke="currentColor"
                                            stroke-linecap="rou    stroke-linejoin=" round>
                                                <path d="M14.5 9V2.5m0 16V14" />
                                                <circle cx="14.5" cy="11.5" r="2.5" />
                                                <path d="M6.5 5V2.5m0 16V10" />
                                                <circle cx="6.5" cy="7.5" r="2.5" />
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            <span>Filters</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>