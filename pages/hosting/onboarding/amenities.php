<?php include "../includes/header.php"; ?>
    <title>Amenities</title>
</head>

<style>
    .video-container ul li {
        min-height: 88px;
        max-width: 75%;
        align-items: center;
        width: 150px;
        justify-content: center;
        /* margin: auto; */
        display: inline-grid;
        border: 1px solid #DDDDDD;
        margin-bottom: 15px;
        border-radius: 10px;
        padding-right: 15px;
        padding-left: 15px;
        text-align: center;
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
            gap: 20px;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
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
                        <h1 class="_1eg7jkhx text-white">Which of these best describes your place?</h1>
                    </div>

                </div>
                <a href="../index.html" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 160px;">Back</a>
                <a href="../index.html" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Save and Exit</a>

            </div>
            <div class="col-md-6 video-container p-0 pt-md-5 position-relative" style="background-color: white !important;">
                <div class="w-md-100 w-auto pt-5 px-4">
                    <h3><b>Do you have any standout amenities?</b></h3>
                    <ul class="question-tag">


                        <li class="mt-4">
                            <div class="d-grid">
                                <svg preserveAspectRatio="xMidYMid meet" aria-hidden="true" role="presentation" focusable="false" viewBox="0 0 100 100" style="display: block; height: 52px; width: 52px; fill: currentcolor;"><g id="IcSystemJacuzzi32__R_G"><g id="IcSystemJacuzzi32__R_G_L_0_G" transform=" translate(50, 50) scale(2, 2) translate(-40, -40)"><g id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" transform=" translate(40, 40)"><g id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G" transform=" translate(60, 59.999) translate(-40, -39.999)"><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_0_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M55 37 C55,37 55,39 55,39 C55,39 53,39 53,39 C53,39 53,53 53,53 C53,54.05 52.19,54.92 51.15,55 C51.15,55 51,55 51,55 C51,55 29,55 29,55 C27.95,55 27.08,54.19 27.01,53.15 C27.01,53.15 27,53 27,53 C27,53 27,39 27,39 C27,39 25,39 25,39 C25,39 25,37 25,37 C25,37 55,37 55,37z  M51 39 C51,39 29,39 29,39 C29,39 29,53 29,53 C29,53 51,53 51,53 C51,53 51,39 51,39z "></path><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_1_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M47.18 29.07 C47.18,29.07 46.74,29.53 46.74,29.53 C45.34,31.03 44.5,32.96 44.35,35 C44.35,35 42.35,35 42.35,35 C42.51,32.32 43.65,29.78 45.55,27.88 C46.33,27.11 46.83,26.09 46.98,25 C46.98,25 48.99,25 48.99,25 C48.85,26.52 48.22,27.95 47.18,29.07z  M49.8 32.12 C49.02,32.9 48.52,33.91 48.37,35 C48.37,35 46.36,35 46.36,35 C46.5,33.49 47.14,32.06 48.17,30.94 C48.17,30.94 48.61,30.48 48.61,30.48 C50.01,28.98 50.85,27.04 50.99,25 C50.99,25 53,25 53,25 C52.84,27.69 51.7,30.22 49.8,32.12z "></path><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_2_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M33.5 26 C35.99,26 38,28.02 38,30.5 C38,31.52 37.66,32.5 37.03,33.3 C37.64,33.51 38.2,33.85 38.69,34.28 C38.69,34.28 38.88,34.46 38.88,34.46 C38.88,34.46 46.71,42.29 46.71,42.29 C46.71,42.29 45.29,43.71 45.29,43.71 C45.29,43.71 37.46,35.88 37.46,35.88 C36.95,35.36 36.27,35.06 35.54,35.01 C35.54,35.01 35.34,35 35.34,35 C35.34,35 34.5,35 34.5,35 C34.5,35 34.5,32.79 34.5,32.79 C35.76,32.24 36.34,30.77 35.79,29.5 C35.24,28.24 33.76,27.66 32.5,28.21 C31.23,28.76 30.66,30.24 31.21,31.5 C31.46,32.08 31.92,32.54 32.5,32.79 C32.5,32.79 32.5,35 32.5,35 C32.5,35 32,35 32,35 C30.41,35 29.1,36.24 29.01,37.82 C29.01,37.82 29,38 29,38 C29,38 27,38 27,38 C27,35.99 28.2,34.17 30.06,33.39 C28.46,31.49 28.71,28.65 30.61,27.05 C31.42,26.37 32.44,26 33.5,26z "></path></g></g></g></g><g id="IcSystemJacuzzi32_time_group"></g><defs><animateTransform repeatCount="0" dur="3.3333333333333335" begin="0s" xlink:href="#IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" fill="freeze" attributeName="transform" from="1 1" to="1 1" type="scale" additive="sum" keyTimes="0;0.025;0.17;0.505;0.53;0.675;1" values="1 1;0.75 0.75;1 1;1 1;0.75 0.75;1 1;1 1" keySplines="0.167 0.167 0 1;0.54 0 0.207 1;0.167 0 0.833 1;0.167 0.167 0 1;0.54 0 0.207 1;0 0 0 0" calcMode="spline" data-original-duration="3.3333333333333335s" max="3.3333333333333335"></animateTransform><animateTransform repeatCount="0" dur="3.3333333333333335" begin="0s" xlink:href="#IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" fill="freeze" attributeName="transform" from="-60 -60" to="-60 -60" type="translate" additive="sum" keyTimes="0;1" values="-60 -60;-60 -60" keySplines="0 0 1 1" calcMode="spline" data-original-duration="3.3333333333333335s" max="3.3333333333333335"></animateTransform><animate attributeType="XML" attributeName="opacity" dur="3" from="0" to="1" xlink:href="#IcSystemJacuzzi32_time_group" data-original-duration="3s" repeatCount="0" max="3"></animate></defs></svg>
                                <b>Pool</b>
                            </div>
                        </li>
                        <li class="mt-4">
                            <div class="d-grid">
                                <svg preserveAspectRatio="xMidYMid meet" aria-hidden="true" role="presentation" focusable="false" viewBox="0 0 100 100" style="display: block; height: 52px; width: 52px; fill: currentcolor;"><g id="IcSystemJacuzzi32__R_G"><g id="IcSystemJacuzzi32__R_G_L_0_G" transform=" translate(50, 50) scale(2, 2) translate(-40, -40)"><g id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" transform=" translate(40, 40)"><g id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G" transform=" translate(60, 59.999) translate(-40, -39.999)"><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_0_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M55 37 C55,37 55,39 55,39 C55,39 53,39 53,39 C53,39 53,53 53,53 C53,54.05 52.19,54.92 51.15,55 C51.15,55 51,55 51,55 C51,55 29,55 29,55 C27.95,55 27.08,54.19 27.01,53.15 C27.01,53.15 27,53 27,53 C27,53 27,39 27,39 C27,39 25,39 25,39 C25,39 25,37 25,37 C25,37 55,37 55,37z  M51 39 C51,39 29,39 29,39 C29,39 29,53 29,53 C29,53 51,53 51,53 C51,53 51,39 51,39z "></path><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_1_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M47.18 29.07 C47.18,29.07 46.74,29.53 46.74,29.53 C45.34,31.03 44.5,32.96 44.35,35 C44.35,35 42.35,35 42.35,35 C42.51,32.32 43.65,29.78 45.55,27.88 C46.33,27.11 46.83,26.09 46.98,25 C46.98,25 48.99,25 48.99,25 C48.85,26.52 48.22,27.95 47.18,29.07z  M49.8 32.12 C49.02,32.9 48.52,33.91 48.37,35 C48.37,35 46.36,35 46.36,35 C46.5,33.49 47.14,32.06 48.17,30.94 C48.17,30.94 48.61,30.48 48.61,30.48 C50.01,28.98 50.85,27.04 50.99,25 C50.99,25 53,25 53,25 C52.84,27.69 51.7,30.22 49.8,32.12z "></path><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_2_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M33.5 26 C35.99,26 38,28.02 38,30.5 C38,31.52 37.66,32.5 37.03,33.3 C37.64,33.51 38.2,33.85 38.69,34.28 C38.69,34.28 38.88,34.46 38.88,34.46 C38.88,34.46 46.71,42.29 46.71,42.29 C46.71,42.29 45.29,43.71 45.29,43.71 C45.29,43.71 37.46,35.88 37.46,35.88 C36.95,35.36 36.27,35.06 35.54,35.01 C35.54,35.01 35.34,35 35.34,35 C35.34,35 34.5,35 34.5,35 C34.5,35 34.5,32.79 34.5,32.79 C35.76,32.24 36.34,30.77 35.79,29.5 C35.24,28.24 33.76,27.66 32.5,28.21 C31.23,28.76 30.66,30.24 31.21,31.5 C31.46,32.08 31.92,32.54 32.5,32.79 C32.5,32.79 32.5,35 32.5,35 C32.5,35 32,35 32,35 C30.41,35 29.1,36.24 29.01,37.82 C29.01,37.82 29,38 29,38 C29,38 27,38 27,38 C27,35.99 28.2,34.17 30.06,33.39 C28.46,31.49 28.71,28.65 30.61,27.05 C31.42,26.37 32.44,26 33.5,26z "></path></g></g></g></g><g id="IcSystemJacuzzi32_time_group"></g><defs><animateTransform repeatCount="0" dur="3.3333333333333335" begin="0s" xlink:href="#IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" fill="freeze" attributeName="transform" from="1 1" to="1 1" type="scale" additive="sum" keyTimes="0;0.025;0.17;0.505;0.53;0.675;1" values="1 1;0.75 0.75;1 1;1 1;0.75 0.75;1 1;1 1" keySplines="0.167 0.167 0 1;0.54 0 0.207 1;0.167 0 0.833 1;0.167 0.167 0 1;0.54 0 0.207 1;0 0 0 0" calcMode="spline" data-original-duration="3.3333333333333335s" max="3.3333333333333335"></animateTransform><animateTransform repeatCount="0" dur="3.3333333333333335" begin="0s" xlink:href="#IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" fill="freeze" attributeName="transform" from="-60 -60" to="-60 -60" type="translate" additive="sum" keyTimes="0;1" values="-60 -60;-60 -60" keySplines="0 0 1 1" calcMode="spline" data-original-duration="3.3333333333333335s" max="3.3333333333333335"></animateTransform><animate attributeType="XML" attributeName="opacity" dur="3" from="0" to="1" xlink:href="#IcSystemJacuzzi32_time_group" data-original-duration="3s" repeatCount="0" max="3"></animate></defs></svg>
                                <b>Pool</b>
                            </div>
                        </li>
                        <li class="mt-4">
                            <div class="d-grid">
                                <svg preserveAspectRatio="xMidYMid meet" aria-hidden="true" role="presentation" focusable="false" viewBox="0 0 100 100" style="display: block; height: 52px; width: 52px; fill: currentcolor;"><g id="IcSystemJacuzzi32__R_G"><g id="IcSystemJacuzzi32__R_G_L_0_G" transform=" translate(50, 50) scale(2, 2) translate(-40, -40)"><g id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" transform=" translate(40, 40)"><g id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G" transform=" translate(60, 59.999) translate(-40, -39.999)"><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_0_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M55 37 C55,37 55,39 55,39 C55,39 53,39 53,39 C53,39 53,53 53,53 C53,54.05 52.19,54.92 51.15,55 C51.15,55 51,55 51,55 C51,55 29,55 29,55 C27.95,55 27.08,54.19 27.01,53.15 C27.01,53.15 27,53 27,53 C27,53 27,39 27,39 C27,39 25,39 25,39 C25,39 25,37 25,37 C25,37 55,37 55,37z  M51 39 C51,39 29,39 29,39 C29,39 29,53 29,53 C29,53 51,53 51,53 C51,53 51,39 51,39z "></path><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_1_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M47.18 29.07 C47.18,29.07 46.74,29.53 46.74,29.53 C45.34,31.03 44.5,32.96 44.35,35 C44.35,35 42.35,35 42.35,35 C42.51,32.32 43.65,29.78 45.55,27.88 C46.33,27.11 46.83,26.09 46.98,25 C46.98,25 48.99,25 48.99,25 C48.85,26.52 48.22,27.95 47.18,29.07z  M49.8 32.12 C49.02,32.9 48.52,33.91 48.37,35 C48.37,35 46.36,35 46.36,35 C46.5,33.49 47.14,32.06 48.17,30.94 C48.17,30.94 48.61,30.48 48.61,30.48 C50.01,28.98 50.85,27.04 50.99,25 C50.99,25 53,25 53,25 C52.84,27.69 51.7,30.22 49.8,32.12z "></path><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_2_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M33.5 26 C35.99,26 38,28.02 38,30.5 C38,31.52 37.66,32.5 37.03,33.3 C37.64,33.51 38.2,33.85 38.69,34.28 C38.69,34.28 38.88,34.46 38.88,34.46 C38.88,34.46 46.71,42.29 46.71,42.29 C46.71,42.29 45.29,43.71 45.29,43.71 C45.29,43.71 37.46,35.88 37.46,35.88 C36.95,35.36 36.27,35.06 35.54,35.01 C35.54,35.01 35.34,35 35.34,35 C35.34,35 34.5,35 34.5,35 C34.5,35 34.5,32.79 34.5,32.79 C35.76,32.24 36.34,30.77 35.79,29.5 C35.24,28.24 33.76,27.66 32.5,28.21 C31.23,28.76 30.66,30.24 31.21,31.5 C31.46,32.08 31.92,32.54 32.5,32.79 C32.5,32.79 32.5,35 32.5,35 C32.5,35 32,35 32,35 C30.41,35 29.1,36.24 29.01,37.82 C29.01,37.82 29,38 29,38 C29,38 27,38 27,38 C27,35.99 28.2,34.17 30.06,33.39 C28.46,31.49 28.71,28.65 30.61,27.05 C31.42,26.37 32.44,26 33.5,26z "></path></g></g></g></g><g id="IcSystemJacuzzi32_time_group"></g><defs><animateTransform repeatCount="0" dur="3.3333333333333335" begin="0s" xlink:href="#IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" fill="freeze" attributeName="transform" from="1 1" to="1 1" type="scale" additive="sum" keyTimes="0;0.025;0.17;0.505;0.53;0.675;1" values="1 1;0.75 0.75;1 1;1 1;0.75 0.75;1 1;1 1" keySplines="0.167 0.167 0 1;0.54 0 0.207 1;0.167 0 0.833 1;0.167 0.167 0 1;0.54 0 0.207 1;0 0 0 0" calcMode="spline" data-original-duration="3.3333333333333335s" max="3.3333333333333335"></animateTransform><animateTransform repeatCount="0" dur="3.3333333333333335" begin="0s" xlink:href="#IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" fill="freeze" attributeName="transform" from="-60 -60" to="-60 -60" type="translate" additive="sum" keyTimes="0;1" values="-60 -60;-60 -60" keySplines="0 0 1 1" calcMode="spline" data-original-duration="3.3333333333333335s" max="3.3333333333333335"></animateTransform><animate attributeType="XML" attributeName="opacity" dur="3" from="0" to="1" xlink:href="#IcSystemJacuzzi32_time_group" data-original-duration="3s" repeatCount="0" max="3"></animate></defs></svg>
                                <b>Pool</b>
                            </div>
                        </li>
                        <li class="mt-4">
                            <div class="d-grid">
                                <svg preserveAspectRatio="xMidYMid meet" aria-hidden="true" role="presentation" focusable="false" viewBox="0 0 100 100" style="display: block; height: 52px; width: 52px; fill: currentcolor;"><g id="IcSystemJacuzzi32__R_G"><g id="IcSystemJacuzzi32__R_G_L_0_G" transform=" translate(50, 50) scale(2, 2) translate(-40, -40)"><g id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" transform=" translate(40, 40)"><g id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G" transform=" translate(60, 59.999) translate(-40, -39.999)"><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_0_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M55 37 C55,37 55,39 55,39 C55,39 53,39 53,39 C53,39 53,53 53,53 C53,54.05 52.19,54.92 51.15,55 C51.15,55 51,55 51,55 C51,55 29,55 29,55 C27.95,55 27.08,54.19 27.01,53.15 C27.01,53.15 27,53 27,53 C27,53 27,39 27,39 C27,39 25,39 25,39 C25,39 25,37 25,37 C25,37 55,37 55,37z  M51 39 C51,39 29,39 29,39 C29,39 29,53 29,53 C29,53 51,53 51,53 C51,53 51,39 51,39z "></path><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_1_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M47.18 29.07 C47.18,29.07 46.74,29.53 46.74,29.53 C45.34,31.03 44.5,32.96 44.35,35 C44.35,35 42.35,35 42.35,35 C42.51,32.32 43.65,29.78 45.55,27.88 C46.33,27.11 46.83,26.09 46.98,25 C46.98,25 48.99,25 48.99,25 C48.85,26.52 48.22,27.95 47.18,29.07z  M49.8 32.12 C49.02,32.9 48.52,33.91 48.37,35 C48.37,35 46.36,35 46.36,35 C46.5,33.49 47.14,32.06 48.17,30.94 C48.17,30.94 48.61,30.48 48.61,30.48 C50.01,28.98 50.85,27.04 50.99,25 C50.99,25 53,25 53,25 C52.84,27.69 51.7,30.22 49.8,32.12z "></path><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_2_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M33.5 26 C35.99,26 38,28.02 38,30.5 C38,31.52 37.66,32.5 37.03,33.3 C37.64,33.51 38.2,33.85 38.69,34.28 C38.69,34.28 38.88,34.46 38.88,34.46 C38.88,34.46 46.71,42.29 46.71,42.29 C46.71,42.29 45.29,43.71 45.29,43.71 C45.29,43.71 37.46,35.88 37.46,35.88 C36.95,35.36 36.27,35.06 35.54,35.01 C35.54,35.01 35.34,35 35.34,35 C35.34,35 34.5,35 34.5,35 C34.5,35 34.5,32.79 34.5,32.79 C35.76,32.24 36.34,30.77 35.79,29.5 C35.24,28.24 33.76,27.66 32.5,28.21 C31.23,28.76 30.66,30.24 31.21,31.5 C31.46,32.08 31.92,32.54 32.5,32.79 C32.5,32.79 32.5,35 32.5,35 C32.5,35 32,35 32,35 C30.41,35 29.1,36.24 29.01,37.82 C29.01,37.82 29,38 29,38 C29,38 27,38 27,38 C27,35.99 28.2,34.17 30.06,33.39 C28.46,31.49 28.71,28.65 30.61,27.05 C31.42,26.37 32.44,26 33.5,26z "></path></g></g></g></g><g id="IcSystemJacuzzi32_time_group"></g><defs><animateTransform repeatCount="0" dur="3.3333333333333335" begin="0s" xlink:href="#IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" fill="freeze" attributeName="transform" from="1 1" to="1 1" type="scale" additive="sum" keyTimes="0;0.025;0.17;0.505;0.53;0.675;1" values="1 1;0.75 0.75;1 1;1 1;0.75 0.75;1 1;1 1" keySplines="0.167 0.167 0 1;0.54 0 0.207 1;0.167 0 0.833 1;0.167 0.167 0 1;0.54 0 0.207 1;0 0 0 0" calcMode="spline" data-original-duration="3.3333333333333335s" max="3.3333333333333335"></animateTransform><animateTransform repeatCount="0" dur="3.3333333333333335" begin="0s" xlink:href="#IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" fill="freeze" attributeName="transform" from="-60 -60" to="-60 -60" type="translate" additive="sum" keyTimes="0;1" values="-60 -60;-60 -60" keySplines="0 0 1 1" calcMode="spline" data-original-duration="3.3333333333333335s" max="3.3333333333333335"></animateTransform><animate attributeType="XML" attributeName="opacity" dur="3" from="0" to="1" xlink:href="#IcSystemJacuzzi32_time_group" data-original-duration="3s" repeatCount="0" max="3"></animate></defs></svg>
                                <b>Pool</b>
                            </div>
                        </li>
                        <li class="mt-4">
                            <div class="d-grid">
                                <svg preserveAspectRatio="xMidYMid meet" aria-hidden="true" role="presentation" focusable="false" viewBox="0 0 100 100" style="display: block; height: 52px; width: 52px; fill: currentcolor;"><g id="IcSystemJacuzzi32__R_G"><g id="IcSystemJacuzzi32__R_G_L_0_G" transform=" translate(50, 50) scale(2, 2) translate(-40, -40)"><g id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" transform=" translate(40, 40)"><g id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G" transform=" translate(60, 59.999) translate(-40, -39.999)"><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_0_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M55 37 C55,37 55,39 55,39 C55,39 53,39 53,39 C53,39 53,53 53,53 C53,54.05 52.19,54.92 51.15,55 C51.15,55 51,55 51,55 C51,55 29,55 29,55 C27.95,55 27.08,54.19 27.01,53.15 C27.01,53.15 27,53 27,53 C27,53 27,39 27,39 C27,39 25,39 25,39 C25,39 25,37 25,37 C25,37 55,37 55,37z  M51 39 C51,39 29,39 29,39 C29,39 29,53 29,53 C29,53 51,53 51,53 C51,53 51,39 51,39z "></path><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_1_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M47.18 29.07 C47.18,29.07 46.74,29.53 46.74,29.53 C45.34,31.03 44.5,32.96 44.35,35 C44.35,35 42.35,35 42.35,35 C42.51,32.32 43.65,29.78 45.55,27.88 C46.33,27.11 46.83,26.09 46.98,25 C46.98,25 48.99,25 48.99,25 C48.85,26.52 48.22,27.95 47.18,29.07z  M49.8 32.12 C49.02,32.9 48.52,33.91 48.37,35 C48.37,35 46.36,35 46.36,35 C46.5,33.49 47.14,32.06 48.17,30.94 C48.17,30.94 48.61,30.48 48.61,30.48 C50.01,28.98 50.85,27.04 50.99,25 C50.99,25 53,25 53,25 C52.84,27.69 51.7,30.22 49.8,32.12z "></path><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_2_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M33.5 26 C35.99,26 38,28.02 38,30.5 C38,31.52 37.66,32.5 37.03,33.3 C37.64,33.51 38.2,33.85 38.69,34.28 C38.69,34.28 38.88,34.46 38.88,34.46 C38.88,34.46 46.71,42.29 46.71,42.29 C46.71,42.29 45.29,43.71 45.29,43.71 C45.29,43.71 37.46,35.88 37.46,35.88 C36.95,35.36 36.27,35.06 35.54,35.01 C35.54,35.01 35.34,35 35.34,35 C35.34,35 34.5,35 34.5,35 C34.5,35 34.5,32.79 34.5,32.79 C35.76,32.24 36.34,30.77 35.79,29.5 C35.24,28.24 33.76,27.66 32.5,28.21 C31.23,28.76 30.66,30.24 31.21,31.5 C31.46,32.08 31.92,32.54 32.5,32.79 C32.5,32.79 32.5,35 32.5,35 C32.5,35 32,35 32,35 C30.41,35 29.1,36.24 29.01,37.82 C29.01,37.82 29,38 29,38 C29,38 27,38 27,38 C27,35.99 28.2,34.17 30.06,33.39 C28.46,31.49 28.71,28.65 30.61,27.05 C31.42,26.37 32.44,26 33.5,26z "></path></g></g></g></g><g id="IcSystemJacuzzi32_time_group"></g><defs><animateTransform repeatCount="0" dur="3.3333333333333335" begin="0s" xlink:href="#IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" fill="freeze" attributeName="transform" from="1 1" to="1 1" type="scale" additive="sum" keyTimes="0;0.025;0.17;0.505;0.53;0.675;1" values="1 1;0.75 0.75;1 1;1 1;0.75 0.75;1 1;1 1" keySplines="0.167 0.167 0 1;0.54 0 0.207 1;0.167 0 0.833 1;0.167 0.167 0 1;0.54 0 0.207 1;0 0 0 0" calcMode="spline" data-original-duration="3.3333333333333335s" max="3.3333333333333335"></animateTransform><animateTransform repeatCount="0" dur="3.3333333333333335" begin="0s" xlink:href="#IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" fill="freeze" attributeName="transform" from="-60 -60" to="-60 -60" type="translate" additive="sum" keyTimes="0;1" values="-60 -60;-60 -60" keySplines="0 0 1 1" calcMode="spline" data-original-duration="3.3333333333333335s" max="3.3333333333333335"></animateTransform><animate attributeType="XML" attributeName="opacity" dur="3" from="0" to="1" xlink:href="#IcSystemJacuzzi32_time_group" data-original-duration="3s" repeatCount="0" max="3"></animate></defs></svg>
                                <b>Pool</b>
                            </div>
                        </li>
                        <li class="mt-4">
                            <div class="d-grid">
                                <svg preserveAspectRatio="xMidYMid meet" aria-hidden="true" role="presentation" focusable="false" viewBox="0 0 100 100" style="display: block; height: 52px; width: 52px; fill: currentcolor;"><g id="IcSystemJacuzzi32__R_G"><g id="IcSystemJacuzzi32__R_G_L_0_G" transform=" translate(50, 50) scale(2, 2) translate(-40, -40)"><g id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" transform=" translate(40, 40)"><g id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G" transform=" translate(60, 59.999) translate(-40, -39.999)"><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_0_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M55 37 C55,37 55,39 55,39 C55,39 53,39 53,39 C53,39 53,53 53,53 C53,54.05 52.19,54.92 51.15,55 C51.15,55 51,55 51,55 C51,55 29,55 29,55 C27.95,55 27.08,54.19 27.01,53.15 C27.01,53.15 27,53 27,53 C27,53 27,39 27,39 C27,39 25,39 25,39 C25,39 25,37 25,37 C25,37 55,37 55,37z  M51 39 C51,39 29,39 29,39 C29,39 29,53 29,53 C29,53 51,53 51,53 C51,53 51,39 51,39z "></path><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_1_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M47.18 29.07 C47.18,29.07 46.74,29.53 46.74,29.53 C45.34,31.03 44.5,32.96 44.35,35 C44.35,35 42.35,35 42.35,35 C42.51,32.32 43.65,29.78 45.55,27.88 C46.33,27.11 46.83,26.09 46.98,25 C46.98,25 48.99,25 48.99,25 C48.85,26.52 48.22,27.95 47.18,29.07z  M49.8 32.12 C49.02,32.9 48.52,33.91 48.37,35 C48.37,35 46.36,35 46.36,35 C46.5,33.49 47.14,32.06 48.17,30.94 C48.17,30.94 48.61,30.48 48.61,30.48 C50.01,28.98 50.85,27.04 50.99,25 C50.99,25 53,25 53,25 C52.84,27.69 51.7,30.22 49.8,32.12z "></path><path id="IcSystemJacuzzi32__R_G_L_0_G_L_0_G_D_2_P_0" fill="#222222" fill-opacity="1" fill-rule="nonzero" d=" M33.5 26 C35.99,26 38,28.02 38,30.5 C38,31.52 37.66,32.5 37.03,33.3 C37.64,33.51 38.2,33.85 38.69,34.28 C38.69,34.28 38.88,34.46 38.88,34.46 C38.88,34.46 46.71,42.29 46.71,42.29 C46.71,42.29 45.29,43.71 45.29,43.71 C45.29,43.71 37.46,35.88 37.46,35.88 C36.95,35.36 36.27,35.06 35.54,35.01 C35.54,35.01 35.34,35 35.34,35 C35.34,35 34.5,35 34.5,35 C34.5,35 34.5,32.79 34.5,32.79 C35.76,32.24 36.34,30.77 35.79,29.5 C35.24,28.24 33.76,27.66 32.5,28.21 C31.23,28.76 30.66,30.24 31.21,31.5 C31.46,32.08 31.92,32.54 32.5,32.79 C32.5,32.79 32.5,35 32.5,35 C32.5,35 32,35 32,35 C30.41,35 29.1,36.24 29.01,37.82 C29.01,37.82 29,38 29,38 C29,38 27,38 27,38 C27,35.99 28.2,34.17 30.06,33.39 C28.46,31.49 28.71,28.65 30.61,27.05 C31.42,26.37 32.44,26 33.5,26z "></path></g></g></g></g><g id="IcSystemJacuzzi32_time_group"></g><defs><animateTransform repeatCount="0" dur="3.3333333333333335" begin="0s" xlink:href="#IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" fill="freeze" attributeName="transform" from="1 1" to="1 1" type="scale" additive="sum" keyTimes="0;0.025;0.17;0.505;0.53;0.675;1" values="1 1;0.75 0.75;1 1;1 1;0.75 0.75;1 1;1 1" keySplines="0.167 0.167 0 1;0.54 0 0.207 1;0.167 0 0.833 1;0.167 0.167 0 1;0.54 0 0.207 1;0 0 0 0" calcMode="spline" data-original-duration="3.3333333333333335s" max="3.3333333333333335"></animateTransform><animateTransform repeatCount="0" dur="3.3333333333333335" begin="0s" xlink:href="#IcSystemJacuzzi32__R_G_L_0_G_L_0_G_N_3_T_0" fill="freeze" attributeName="transform" from="-60 -60" to="-60 -60" type="translate" additive="sum" keyTimes="0;1" values="-60 -60;-60 -60" keySplines="0 0 1 1" calcMode="spline" data-original-duration="3.3333333333333335s" max="3.3333333333333335"></animateTransform><animate attributeType="XML" attributeName="opacity" dur="3" from="0" to="1" xlink:href="#IcSystemJacuzzi32_time_group" data-original-duration="3s" repeatCount="0" max="3"></animate></defs></svg>
                                <b>Pool</b>
                            </div>
                        </li>



                    </ul>
                    <div class=" hovvvv justify-content-evenly">
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar" role="progressbar" style="width: 55%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-evenly" style="padding-top: 10px;">
                            <a href="./floor-plan.html" class="btn _kaq6tx w-120" style="background-color: transparent;background-image: none !important;color: black;">Back</a>
                            <a href="./photos.html" class="btn _kaq6tx  w-120" style="background-color: #dddddd;background-image: none !important;">Next</a>
                        </div>

                    </div>
                    <a href="../index.html" class="btn  d-none d-md-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 160px;">Back</a>
                    <a href="../index.html" class="btn  d-none d-md-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Save and Exit</a>
                </div>

            </div>

        </div>
    </div>
    
    <?php include "../includes/vue-script.php"; ?>
</body>

</html>