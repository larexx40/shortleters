<?php include "../includes/header.php"; ?>
    <title>Legal</title>
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
</head>



<body>
    <div id="user" v-cloak>
        <?php include "../includes/loading.php"; ?>
        <div class="body-wrapper row m-0 p-0 position-relative">
            <div class="col-md-6 video-container p-0 position-relative" style="background-image: linear-gradient(rgb(28 107 164), rgb(35 167 57));">

                <div style="height: 100%;display:flex;align-items: center;justify-content: center;">
                    <div class="_e5xjym4">
                        <h1 class="_1eg7jkhx text-white">Just a few last questions...</h1>
                    </div>

                </div>
                <a href="../index.php" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 160px;">Back</a>
                <a href="../index.php" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Save and Exit</a>

            </div>
            <div class="col-md-6 video-container p-0 pt-md-5 position-relative" style="background-color: white !important;">

                <div class="container w-md-100 w-auto pt-5" style="display:flex;align-items: center;justify-content: center;">
                    <ul class="question-tag">
                        <h3 class="_atr2bu"><b>How are you hosting on Airbnb?</b></h3>
                        <div v-if='all_host_type'  v-for='(item, index) in all_host_type' class="form-check d-flex p-0 justify-content-between my-3 align-items-center">
                            <label class="form-check-label " for="exampleRadios1">
                                {{item.name}}
                            </label>
                            <input class="form-check-input"  v-model='host_type_id' type="radio" :name="item.name" :value='item.id'>

                        </div>
                        
                        <br>
                        <h3 class="_atr2bu"><b>Do you have any of these at your place??</b></h3>
                        <div v-if='guestSafeties' v-for='(item, index) in guestSafeties' class="form-check d-flex p-0 justify-content-between my-3 align-items-center">
                            <label class="form-check-label " :for='item.guestSafetyid'>{{item.name}}
                            </label>
                            <input :id='item.guestSafetyid' class="form-check-input" v-model='guest_safety_ids' type="checkbox" :name='item.guestSafetyid' :value='item.guestSafetyid'>

                            <!-- <input type="checkbox" id="jack" value="Jack" v-model="checkedNames" />
                            <label for="jack">Jack</label> -->
                        </div>
                        
                        <br>
                        <h3 class="_atr2bu"><b>Some important things to know ?</b></h3>
                        <p>Be sure to comply with your local laws and review Airbnb's nondiscrimination policy and guest and Host fees. Update your cancellation policy after you publish.</p>
                    </ul>

                    <div class=" hovvvv justify-content-evenly">
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-evenly" style="padding-top: 10px;">
                            <a href="./index.php" class="_kaq6tx w-120">Back</a>
                            <a @click.prevent='addApartmentStep13(4)' href="./property-type.php" class="_kaq6tx  w-120">Review</a>
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