<?php include "../includes/header.php"; ?>
    <title>Become a host</title>
</head>


<body>

    
    <div id="user" v-cloak>
        <?php include "../includes/loading.php"; ?>
        <div class="body-wrapper row m-0 p-0">
            <div class="col-md-6 video-container p-0 position-relative" style="overflow:hidden;">
                <video class="_e2l2kr" autoplay muted loop aria-label="A Host waves from their living room and adjusts their sofa. Another Host takes a photo in their plant-filled space. Finally, two Hosts sit beside each other and wave hello." crossorigin="anonymous"
                    playsinline="" preload="auto" style="object-fit: cover; object-position: 0px 25%;"><source src="https://a0.muscache.com/v/8b/04/8b0456c7-13f8-54bc-889a-7cf549f144a3/8b0456c713f854bc889a7cf549f144a3_4000k_1.mp4?imformat=h265" type="video/mp4; codecs=hevc"><source src="https://a0.muscache.com/v/8b/04/8b0456c7-13f8-54bc-889a-7cf549f144a3/8b0456c713f854bc889a7cf549f144a3_4000k_1.mp4" type="video/mp4"></video>

                <a href="../index.php" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn close _qa0cc5 position-absolute" style="bottom:20px !important; left:20px;">Watch full Video</a>
                <!-- Button trigger modal -->
                <a href="../index.php" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Exit</a>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: black;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="height: 100vh;">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="height: calc(100vh - 100px);">
                                <video controls autoplay muted loop aria-label="A Host waves from their living room and adjusts their sofa. Another Host takes a photo in their plant-filled space. Finally, two Hosts sit beside each other and wave hello." crossorigin="anonymous" playsinline=""
                                    preload="auto" style="object-fit: cover; object-position: 0px 25%;"><source src="https://a0.muscache.com/v/8b/04/8b0456c7-13f8-54bc-889a-7cf549f144a3/8b0456c713f854bc889a7cf549f144a3_4000k_1.mp4?imformat=h265" type="video/mp4; codecs=hevc"><source src="https://a0.muscache.com/v/8b/04/8b0456c7-13f8-54bc-889a-7cf549f144a3/8b0456c713f854bc889a7cf549f144a3_4000k_1.mp4" type="video/mp4"></video>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 video-container p-0 pt-md-5 position-relative" style="background-color: rgb(0, 0, 0) !important;
            color: rgb(255, 255, 255) !important;">
                <div style="height: 100%;display:flex;align-items: center;justify-content: center;">
                    <div class="_e5xjym4">
                        <h1 class="_1eg7jkhx">Become a Host in 10 easy steps</h1>
                        <div class="_qnr0t6x"><span class="ll4r2nl dir dir-ltr">Join us. We'll help you every step of the way.</span></div>
                    </div>
                    <div @click.prevent = 'addApartmentStep1' class="position-absolute hovvvv">
                        <a href="property-type-group.php" class="btn _kaq6tx ">Lets Go</a>

                    </div>
                    <a href="../index.php" class="btn  d-none d-md-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Exit</a>
                </div>

            </div>
        </div>

    </div>

    <?php include "../includes/vue-script.php"; ?>
</body>

</html>