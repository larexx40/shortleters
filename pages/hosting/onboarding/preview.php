<?php include "../includes/header.php"; ?>
    <title>Preview</title>
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
                height: 300px;
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
        
        ._e5xjym4 {
            text-align: left !important;
            max-width: 480px !important;
            padding-left: 15px;
        }
        
        ._192g50s {
            border: 1px solid rgb(235, 235, 235) !important;
            box-shadow: rgb(0 0 0 / 12%) 0px 6px 16px !important;
            width: 336px !important;
            max-width: 90% !important;
            height: 100% !important;
            margin: auto;
            overflow-x: auto;
            min-height: 400px;
            padding: 12px;
            border-radius: 32px;
            background-color: rgb(255, 255, 255) !important;
        }
        
        @media all and (max-width:769px) {
            ._192g50s {
                width: 100% !important;
                max-width: 95% !important;
                height: 100% !important;
                margin: auto;
                overflow-x: auto !important;
                min-height: auto !important;
                margin-bottom: 30px !important;
            }
        }
    </style>
</head>



<body>
    <div id="user" v-cloak>
        <?php include "../includes/loading.php"; ?>
        <div class="body-wrapper row m-0 p-0 position-relative">
            <div class="col-md-6 video-container p-0 position-relative" style="background-image: linear-gradient(rgb(28 107 164), rgb(35 167 57));">

                <div style="height: 100%;display:flex;align-items: center;justify-content: center;">
                    <div class="_e5xjym4 text-start">
                        <h1 class="_1eg7jkhx text-white">Check out your listing!</h1>
                        <h3 class="text-white">This listing will be visible to guests 24 hours after you publish. You can add more info or make changes anytime.</h3>
                    </div>

                </div>
                <a href="../index.php" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 160px;">Back</a>
                <a href="../index.php" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Save and Exit</a>

            </div>
            <div class="col-md-6 video-container p-0 pt-md-5 position-relative" style="background-color: white !important;">

                <div v-if='apartment_details' class="w-md-100 w-auto pt-5" style="display:flex;align-items: center;justify-content: center;">
                    <ul class="question-tag container">
                        <div class="card _192g50s container">
                            <div class="image-list">
                                <img v-if='apartment_details.image' class="_91slf2a w-100" aria-hidden="true" alt="Cover photo" :src="apartment_details.image" style="object-fit: cover; border-radius: 24px 24px 0px 0px;">
                                <img v-if='!apartment_details.image' class="_91slf2a w-100" aria-hidden="true" alt="Cover photo" src="https://a0.muscache.com/im/pictures/miso/Hosting-718921680261877081/original/21c4bcf5-6d59-457a-b45f-6e499e5f195b.jpeg?aki_policy=x_medium" style="object-fit: cover; border-radius: 24px 24px 0px 0px;">
                            </div>
                            <h3 class="my-2 mt-4"><b style="font-weight: 900;">{{apartment_details.title}}</b></h3>
                            <hr>
                            <div class="_12halnnq d-flex align-item w-100">
                                <h5 class="_15epaj9" style="width: calc(100% - 40px);"><b>{{apartment_details.space_type_name}} hosted by {{apartment_details.agent_name}}</b></h5>
                                <div class="_1h6n1zu" role="img" aria-busy="false" style="display: inline-block; vertical-align: bottom; height: 40px; width: 40px; min-height: 1px; border-radius: 50px;">
                                    <img class="_9ofhsl" aria-hidden="true" alt="Profile photo" src="https://a0.muscache.com/defaults/user_pic-68x68.png?v=3" style="object-fit: cover; vertical-align: bottom; border-radius: 50px;width: 100%;">
                                </div>
                            </div>
                            <hr>
                            <div class="_uhouic5">
                                {{apartment_details.max_guest}} guests 
                                <div v-if='apartment_details.apartment_facilities' v-for='(item, index) in apartment_details.apartment_facilities'>
                                    {{item.number}} {{item.facility_name}}
                                </div>
                            </div>
                            <hr>
                            <p>{{apartment_details.description}}</p>
                            <hr>
                            <b class="mb-3">Amenities</b>
                            <div v-if='apartment_details.amenities_ids' v-for='(item, index) in apartment_details.amenities_ids' class="d-flex align-items-center justify-content-between mb-3">
                                <p>{{item.name}}</p>
                                <i :class="item.icon" aria-hidden="true"></i>
                                <!-- <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: black;"><path d="M10 5a2 2 0 0 1 1.995 1.85L12 7v8h8V7a2 2 0 0 1 1.85-1.995L22 5h2a2 2 0 0 1 1.995 1.85L26 7v2h2a2 2 0 0 1 1.995 1.85L30 11v4h2v2h-2v4a2 2 0 0 1-1.85 1.995L28 23h-2v2a2 2 0 0 1-1.85 1.995L24 27h-2a2 2 0 0 1-1.995-1.85L20 25v-8h-8v8a2 2 0 0 1-1.85 1.995L10 27H8a2 2 0 0 1-1.995-1.85L6 25v-2H4a2 2 0 0 1-1.995-1.85L2 21v-4H0v-2h2v-4a2 2 0 0 1 1.85-1.995L4 9h2V7a2 2 0 0 1 1.85-1.995L8 5zm14 2h-2v18h2zM10 7H8v18h2zm18 4h-2v10h2zM6 11H4v10h2z"></path></svg> -->
                            </div>
                            <hr>
                            <b class="mb-3">Location</b>
                            <p>{{apartment_details.apartment_address, apartment_details.apartment_city, apartment_details.apartment_country}}</p>
                            <small>We’ll only share your address with guests who are booked as outlined in our privacy policy.</small>
                            <hr>
                        </div>

                    </ul>

                    <div class=" hovvvv justify-content-evenly">
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-evenly" style="padding-top: 10px;">
                            <a href="./index.php" class="_kaq6tx w-120">Back</a>
                            <a href="./property-type.php" class="_kaq6tx  w-120">Publish</a>
                        </div>

                    </div>
                    <a href="../index.php" class="btn  d-none d-md-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 160px;">Back</a>
                    <a href="../index.php" class="btn  d-none d-md-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Save and Exit</a>
                </div>

            </div>

        </div>
    </div>


    <?php include "../includes/vue-script.php"; ?>   


</body>

</html>