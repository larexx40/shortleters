<?php include "../includes/header.php"; ?>
    <title>Property Type</title>
</head>

<style>
    .video-container ul li {
        min-height: 88px;
        max-width: 75%;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        margin: auto;
        display: flex;
        border: 1px solid #DDDDDD;
        margin-bottom: 15px;
        border-radius: 10px;
        padding-right: 15px;
        padding-left: 15px;
        cursor: pointer;
    }
    
    .video-container ul li:hover {
        border: 2px solid black;
    }
    
    @media all and (max-width:769px) {
        .video-container {
            height: 250px;
        }
    }
    
    .hovvvv {
        width: 100%;
        bottom: 0;
        height: 85px;
        display: block;
        background-color: white;
        right: 0;
        border-top: 1px solid grey;
        justify-content: end;
        padding-right: 0;
        padding-top: 0;
        position: absolute;
    }
    
    .question-tag {
        width: 90%;
        height: calc(100vh - 150px);
        overflow: hidden;
        overflow: auto;
        padding-bottom: 70px;
    }
    
    @media all and (max-width:769px) {
        .hovvvv {
            position: fixed;
            left: 0;
            padding-left: 0;
        }
        .question-tag {
            height: auto;
            width: 100%;
        }
    }
</style>

<body>
    <div id="user" v-cloak>
        <?php include "../includes/loading.php"; ?>
        <div class="body-wrapper row m-0 p-0 position-relative">
            <div class="col-md-6 video-container p-0 position-relative" style="background-image: linear-gradient(#4d1ca4, #a7238f);">

                <div style="height: 100%;display:flex;align-items: center;justify-content: center;">
                    <div class="_e5xjym4">
                        <h1 class="_1eg7jkhx text-white">What kind of place will you host?</h1>
                    </div>

                </div>
                <a href="../index.php" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 160px;">Back</a>
                <a href="../index.php" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Save and Exit</a>

            </div>
            <div class="col-md-6 video-container p-0 pt-md-5 position-relative" style="background-color: white !important;">

                <div class="w-md-100 w-auto pt-5" style="display:flex;align-items: center;justify-content: center;">
                    <ul v-if='buildingTypes' class="question-tag">
                        <!-- if not click active, disable next -->
                        <li v-for='(item, index) in buildingTypes' @click.prevent='setBuildingTypeid(item.buildingTypeid)'>
                            <b>{{item.name}}</b>
                            <img :src="item.imageUrl" :width="56" :height="56" />
                        </li>
                    </ul>
                    <div class=" hovvvv justify-content-evenly">
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-evenly" style="padding-top: 10px;">
                            <a href="./index.php" class="btn _kaq6tx w-120" style="background-color: transparent;background-image: none !important;color: black;">Back</a>
                            
                            <span v-if="!buildingTypeid"><span class="btn _kaq6tx  w-120" style="background-color: #dddddd;background-image: none !important;" >Next</span></span>
                            <span v-if="buildingTypeid" @click.prevent='addApartmentStep2()'><span class="btn _kaq6tx  w-120" style="background-color: #53B561;background-image: none !important;" >Next</span></span>
                        </div>

                    </div>
                    <a href="../index.php" class="btn  d-none d-md-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 160px;">Back</a>
                    <a href="../index.php" @click.prevent='saveApartment()' class="btn  d-none d-md-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Save and Exit</a>
                </div>

            </div>

        </div>
    </div>

    <?php include "../includes/vue-script.php"; ?>   
</body>

</html>