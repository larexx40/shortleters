<?php include "./includes/header.php"; ?>
    <title>Home Page</title>
</head>
<style>
    .tab-content input,
    .tab-content select {
        background-clip: padding-box !important;
        border: 1px solid #969696 !important;
        box-shadow: none !important;
        height: 55px;
        outline: none !important;
        border-radius: 25px;
    }
    
    .tab-content input:focus,
    .tab-content select:focus {
        border: 2px solid #969696 !important;
    }
    
    ._ul9u8c {
        -webkit-box-pack: center !important;
        -webkit-box-align: center !important;
        -webkit-box-flex: 0 !important;
        width: 32px !important;
        height: 32px !important;
        flex-grow: 0 !important;
        flex-shrink: 0 !important;
        cursor: pointer !important;
        display: inline-flex !important;
        margin: 0px !important;
        padding: 0px !important;
        text-align: center !important;
        text-decoration: none !important;
        border-width: 1px !important;
        border-style: solid !important;
        border-color: rgb(176, 176, 176) !important;
        color: rgb(113, 113, 113) !important;
        font-family: inherit !important;
        outline: none !important;
        touch-action: manipulation !important;
        align-items: center !important;
        justify-content: center !important;
        background: rgb(255, 255, 255) !important;
        border-radius: 50% !important;
    }
    
    .title h4 {
        font-weight: 800;
    }
</style>

<body>

    <div id="user" v-cloak>
        <?php include "./includes/loading.php"; ?>
        <div class="body-wrapper">
            <header>
                <div class="header-inner">
                    <div class="row col-12 m-0 align-items-center justify-content-between justify-content-md-around">
                        <div class="p-0 col-md-1 col-lg-2 logo text-md-start d-none d-md-inline-flex">
                            <div class="lg-screen-logo d-none d-lg-inline-flex">
                                <a href="index.php">
                                    <svg width="102" height="32" style="display: block;">
                            <path
                                d="M29.3864 22.7101C29.2429 22.3073 29.0752 21.9176 28.9157 21.5565C28.6701 21.0011 28.4129 20.4446 28.1641 19.9067L28.1444 19.864C25.9255 15.0589 23.5439 10.1881 21.0659 5.38701L20.9607 5.18316C20.7079 4.69289 20.4466 4.18596 20.1784 3.68786C19.8604 3.0575 19.4745 2.4636 19.0276 1.91668C18.5245 1.31651 17.8956 0.833822 17.1853 0.502654C16.475 0.171486 15.7005 -9.83959e-05 14.9165 4.23317e-08C14.1325 9.84805e-05 13.3581 0.171877 12.6478 0.503224C11.9376 0.834571 11.3088 1.31742 10.8059 1.91771C10.3595 2.46476 9.97383 3.05853 9.65572 3.68858C9.38521 4.19115 9.12145 4.70278 8.8664 5.19757L8.76872 5.38696C6.29061 10.1884 3.90903 15.0592 1.69015 19.8639L1.65782 19.9338C1.41334 20.463 1.16057 21.0102 0.919073 21.5563C0.75949 21.9171 0.592009 22.3065 0.448355 22.7103C0.0369063 23.8104 -0.094204 24.9953 0.0668098 26.1585C0.237562 27.334 0.713008 28.4447 1.44606 29.3804C2.17911 30.3161 3.14434 31.0444 4.24614 31.4932C5.07835 31.8299 5.96818 32.002 6.86616 32C7.14824 31.9999 7.43008 31.9835 7.71027 31.9509C8.846 31.8062 9.94136 31.4366 10.9321 30.8639C12.2317 30.1338 13.5152 29.0638 14.9173 27.5348C16.3194 29.0638 17.6029 30.1338 18.9025 30.8639C19.8932 31.4367 20.9886 31.8062 22.1243 31.9509C22.4045 31.9835 22.6864 31.9999 22.9685 32C23.8664 32.002 24.7561 31.8299 25.5883 31.4932C26.6901 31.0444 27.6554 30.3161 28.3885 29.3804C29.1216 28.4447 29.5971 27.3341 29.7679 26.1585C29.9287 24.9952 29.7976 23.8103 29.3864 22.7101ZM14.9173 24.377C13.1816 22.1769 12.0678 20.1338 11.677 18.421C11.5169 17.7792 11.4791 17.1131 11.5656 16.4573C11.6339 15.9766 11.8105 15.5176 12.0821 15.1148C12.4163 14.6814 12.8458 14.3304 13.3374 14.0889C13.829 13.8475 14.3696 13.7219 14.9175 13.7219C15.4655 13.722 16.006 13.8476 16.4976 14.0892C16.9892 14.3307 17.4186 14.6817 17.7528 15.1151C18.0244 15.5181 18.201 15.9771 18.2693 16.4579C18.3556 17.114 18.3177 17.7803 18.1573 18.4223C17.7661 20.1349 16.6526 22.1774 14.9173 24.377ZM27.7406 25.8689C27.6212 26.6908 27.2887 27.4674 26.7762 28.1216C26.2636 28.7759 25.5887 29.2852 24.8183 29.599C24.0393 29.9111 23.1939 30.0217 22.3607 29.9205C21.4946 29.8089 20.6599 29.5239 19.9069 29.0824C18.7501 28.4325 17.5791 27.4348 16.2614 25.9712C18.3591 23.3846 19.669 21.0005 20.154 18.877C20.3723 17.984 20.4196 17.0579 20.2935 16.1475C20.1791 15.3632 19.8879 14.615 19.4419 13.9593C18.9194 13.2519 18.2378 12.6768 17.452 12.2805C16.6661 11.8842 15.798 11.6777 14.9175 11.6777C14.0371 11.6777 13.1689 11.8841 12.383 12.2803C11.5971 12.6765 10.9155 13.2515 10.393 13.9589C9.94707 14.6144 9.65591 15.3624 9.5414 16.1465C9.41524 17.0566 9.4623 17.9822 9.68011 18.8749C10.1648 20.9993 11.4748 23.384 13.5732 25.9714C12.2555 27.4348 11.0845 28.4325 9.92769 29.0825C9.17468 29.5239 8.34007 29.809 7.47395 29.9205C6.64065 30.0217 5.79525 29.9111 5.0162 29.599C4.24581 29.2852 3.57092 28.7759 3.05838 28.1217C2.54585 27.4674 2.21345 26.6908 2.09411 25.8689C1.97932 25.0334 2.07701 24.1825 2.37818 23.3946C2.49266 23.0728 2.62663 22.757 2.7926 22.3818C3.0274 21.851 3.27657 21.3115 3.51759 20.7898L3.54996 20.7197C5.75643 15.9419 8.12481 11.0982 10.5894 6.32294L10.6875 6.13283C10.9384 5.64601 11.1979 5.14267 11.4597 4.6563C11.7101 4.15501 12.0132 3.68171 12.3639 3.2444C12.6746 2.86903 13.0646 2.56681 13.5059 2.35934C13.9473 2.15186 14.4291 2.04426 14.9169 2.04422C15.4047 2.04418 15.8866 2.15171 16.3279 2.35911C16.7693 2.56651 17.1593 2.86867 17.4701 3.24399C17.821 3.68097 18.1242 4.15411 18.3744 4.65538C18.6338 5.13742 18.891 5.63623 19.1398 6.11858L19.2452 6.32315C21.7097 11.0979 24.078 15.9415 26.2847 20.7201L26.3046 20.7631C26.5498 21.2936 26.8033 21.8419 27.042 22.382C27.2082 22.7577 27.3424 23.0738 27.4566 23.3944C27.7576 24.1824 27.8553 25.0333 27.7406 25.8689Z"
                                fill="currentcolor"></path>
                            <path
                                d="M41.6847 24.1196C40.8856 24.1196 40.1505 23.9594 39.4792 23.6391C38.808 23.3188 38.2327 22.8703 37.7212 22.2937C37.2098 21.7172 36.8263 21.0445 36.5386 20.3078C36.2509 19.539 36.123 18.7062 36.123 17.8093C36.123 16.9124 36.2829 16.0475 36.5705 15.2787C36.8582 14.51 37.2737 13.8373 37.7852 13.2287C38.2966 12.6521 38.9039 12.1716 39.6071 11.8513C40.3103 11.531 41.0455 11.3708 41.8765 11.3708C42.6756 11.3708 43.3788 11.531 44.0181 11.8833C44.6574 12.2037 45.1688 12.6841 45.5843 13.2927L45.6802 11.7232H48.6209V23.7992H45.6802L45.5843 22.0375C45.1688 22.6781 44.6254 23.1906 43.9222 23.575C43.2829 23.9274 42.5158 24.1196 41.6847 24.1196ZM42.4519 21.2367C43.0272 21.2367 43.5386 21.0765 44.0181 20.7882C44.4656 20.4679 44.8172 20.0515 45.1049 19.539C45.3606 19.0265 45.4884 18.4179 45.4884 17.7452C45.4884 17.0725 45.3606 16.4639 45.1049 15.9514C44.8492 15.4389 44.4656 15.0225 44.0181 14.7022C43.5706 14.3818 43.0272 14.2537 42.4519 14.2537C41.8765 14.2537 41.3651 14.4139 40.8856 14.7022C40.4382 15.0225 40.0866 15.4389 39.7989 15.9514C39.5432 16.4639 39.4153 17.0725 39.4153 17.7452C39.4153 18.4179 39.5432 19.0265 39.7989 19.539C40.0546 20.0515 40.4382 20.4679 40.8856 20.7882C41.3651 21.0765 41.8765 21.2367 42.4519 21.2367ZM53.6392 8.4559C53.6392 8.80825 53.5753 9.12858 53.4154 9.38483C53.2556 9.64109 53.0319 9.86531 52.7442 10.0255C52.4565 10.1856 52.1369 10.2497 51.8173 10.2497C51.4976 10.2497 51.178 10.1856 50.8903 10.0255C50.6026 9.86531 50.3789 9.64109 50.2191 9.38483C50.0592 9.09654 49.9953 8.80825 49.9953 8.4559C49.9953 8.10355 50.0592 7.78323 50.2191 7.52697C50.3789 7.23868 50.6026 7.04649 50.8903 6.88633C51.178 6.72617 51.4976 6.66211 51.8173 6.66211C52.1369 6.66211 52.4565 6.72617 52.7442 6.88633C53.0319 7.04649 53.2556 7.27072 53.4154 7.52697C53.5433 7.78323 53.6392 8.07152 53.6392 8.4559ZM50.2191 23.7672V11.6911H53.4154V23.7672H50.2191V23.7672ZM61.9498 14.8623V14.8943C61.79 14.8303 61.5982 14.7982 61.4383 14.7662C61.2466 14.7342 61.0867 14.7342 60.895 14.7342C60 14.7342 59.3287 14.9904 58.8812 15.535C58.4018 16.0795 58.178 16.8483 58.178 17.8413V23.7672H54.9817V11.6911H57.9223L58.0182 13.517C58.3379 12.8763 58.7214 12.3958 59.2648 12.0435C59.7762 11.6911 60.3835 11.531 61.0867 11.531C61.3105 11.531 61.5342 11.563 61.726 11.595C61.8219 11.6271 61.8858 11.6271 61.9498 11.6591V14.8623ZM63.2283 23.7672V6.72617H66.4247V13.2287C66.8722 12.6521 67.3836 12.2036 68.0229 11.8513C68.6622 11.531 69.3654 11.3388 70.1645 11.3388C70.9635 11.3388 71.6987 11.4989 72.3699 11.8193C73.0412 12.1396 73.6165 12.588 74.128 13.1646C74.6394 13.7412 75.0229 14.4139 75.3106 15.1506C75.5983 15.9194 75.7261 16.7522 75.7261 17.6491C75.7261 18.546 75.5663 19.4109 75.2787 20.1796C74.991 20.9484 74.5755 21.6211 74.064 22.2297C73.5526 22.8063 72.9453 23.2867 72.2421 23.6071C71.5389 23.9274 70.8037 24.0875 69.9727 24.0875C69.1736 24.0875 68.4704 23.9274 67.8311 23.575C67.1918 23.2547 66.6804 22.7742 66.2649 22.1656L66.169 23.7352L63.2283 23.7672ZM69.3973 21.2367C69.9727 21.2367 70.4841 21.0765 70.9635 20.7882C71.411 20.4679 71.7626 20.0515 72.0503 19.539C72.306 19.0265 72.4339 18.4179 72.4339 17.7452C72.4339 17.0725 72.306 16.4639 72.0503 15.9514C71.7626 15.4389 71.411 15.0225 70.9635 14.7022C70.5161 14.3818 69.9727 14.2537 69.3973 14.2537C68.822 14.2537 68.3106 14.4139 67.8311 14.7022C67.3836 15.0225 67.032 15.4389 66.7443 15.9514C66.4886 16.4639 66.3608 17.0725 66.3608 17.7452C66.3608 18.4179 66.4886 19.0265 66.7443 19.539C67 20.0515 67.3836 20.4679 67.8311 20.7882C68.3106 21.0765 68.822 21.2367 69.3973 21.2367ZM76.9408 23.7672V11.6911H79.8814L79.9773 13.2607C80.3289 12.6841 80.8084 12.2357 81.4157 11.8833C82.023 11.531 82.7262 11.3708 83.5253 11.3708C84.4203 11.3708 85.1874 11.595 85.8267 12.0115C86.4979 12.4279 87.0094 13.0365 87.361 13.8053C87.7126 14.574 87.9043 15.5029 87.9043 16.56V23.7992H84.708V16.9764C84.708 16.1436 84.5162 15.4709 84.1326 14.9904C83.7491 14.51 83.2376 14.2537 82.5664 14.2537C82.0869 14.2537 81.6714 14.3498 81.2878 14.574C80.9362 14.7982 80.6486 15.0865 80.4248 15.503C80.2011 15.8873 80.1052 16.3678 80.1052 16.8483V23.7672H76.9408V23.7672ZM89.5025 23.7672V6.72617H92.6989V13.2287C93.1464 12.6521 93.6578 12.2036 94.2971 11.8513C94.9364 11.531 95.6396 11.3388 96.4387 11.3388C97.2378 11.3388 97.9729 11.4989 98.6442 11.8193C99.3154 12.1396 99.8907 12.588 100.402 13.1646C100.914 13.7412 101.297 14.4139 101.585 15.1506C101.873 15.9194 102 16.7522 102 17.6491C102 18.546 101.841 19.4109 101.553 20.1796C101.265 20.9484 100.85 21.6211 100.338 22.2297C99.8268 22.8063 99.2195 23.2867 98.5163 23.6071C97.8131 23.9274 97.0779 24.0875 96.2469 24.0875C95.4478 24.0875 94.7446 23.9274 94.1053 23.575C93.466 23.2547 92.9546 22.7742 92.5391 22.1656L92.4432 23.7352L89.5025 23.7672ZM95.7035 21.2367C96.2788 21.2367 96.7903 21.0765 97.2697 20.7882C97.7172 20.4679 98.0688 20.0515 98.3565 19.539C98.6122 19.0265 98.7401 18.4179 98.7401 17.7452C98.7401 17.0725 98.6122 16.4639 98.3565 15.9514C98.1008 15.4389 97.7172 15.0225 97.2697 14.7022C96.8222 14.3818 96.2788 14.2537 95.7035 14.2537C95.1281 14.2537 94.6167 14.4139 94.1373 14.7022C93.6898 15.0225 93.3382 15.4389 93.0505 15.9514C92.7628 16.4639 92.6669 17.0725 92.6669 17.7452C92.6669 18.4179 92.7948 19.0265 93.0505 19.539C93.3062 20.0515 93.6898 20.4679 94.1373 20.7882C94.6167 21.0765 95.0962 21.2367 95.7035 21.2367Z"
                                fill="currentcolor"></path>
                            </svg>
                                </a>
                            </div>
                            <div class="sm-screen-logo d-lg-none">
                                <a href="#">
                                    <svg width="30" height="32">
                            <path
                                d="M29.3864 22.7101C29.2429 22.3073 29.0752 21.9176 28.9157 21.5565C28.6701 21.0011 28.4129 20.4446 28.1641 19.9067L28.1444 19.864C25.9255 15.0589 23.5439 10.1881 21.0659 5.38701L20.9607 5.18316C20.7079 4.69289 20.4466 4.18596 20.1784 3.68786C19.8604 3.0575 19.4745 2.4636 19.0276 1.91668C18.5245 1.31651 17.8956 0.833822 17.1853 0.502654C16.475 0.171486 15.7005 -9.83959e-05 14.9165 4.23317e-08C14.1325 9.84805e-05 13.3581 0.171877 12.6478 0.503224C11.9376 0.834571 11.3088 1.31742 10.8059 1.91771C10.3595 2.46476 9.97383 3.05853 9.65572 3.68858C9.38521 4.19115 9.12145 4.70278 8.8664 5.19757L8.76872 5.38696C6.29061 10.1884 3.90903 15.0592 1.69015 19.8639L1.65782 19.9338C1.41334 20.463 1.16057 21.0102 0.919073 21.5563C0.75949 21.9171 0.592009 22.3065 0.448355 22.7103C0.0369063 23.8104 -0.094204 24.9953 0.0668098 26.1585C0.237562 27.334 0.713008 28.4447 1.44606 29.3804C2.17911 30.3161 3.14434 31.0444 4.24614 31.4932C5.07835 31.8299 5.96818 32.002 6.86616 32C7.14824 31.9999 7.43008 31.9835 7.71027 31.9509C8.846 31.8062 9.94136 31.4366 10.9321 30.8639C12.2317 30.1338 13.5152 29.0638 14.9173 27.5348C16.3194 29.0638 17.6029 30.1338 18.9025 30.8639C19.8932 31.4367 20.9886 31.8062 22.1243 31.9509C22.4045 31.9835 22.6864 31.9999 22.9685 32C23.8664 32.002 24.7561 31.8299 25.5883 31.4932C26.6901 31.0444 27.6554 30.3161 28.3885 29.3804C29.1216 28.4447 29.5971 27.3341 29.7679 26.1585C29.9287 24.9952 29.7976 23.8103 29.3864 22.7101ZM14.9173 24.377C13.1816 22.1769 12.0678 20.1338 11.677 18.421C11.5169 17.7792 11.4791 17.1131 11.5656 16.4573C11.6339 15.9766 11.8105 15.5176 12.0821 15.1148C12.4163 14.6814 12.8458 14.3304 13.3374 14.0889C13.829 13.8475 14.3696 13.7219 14.9175 13.7219C15.4655 13.722 16.006 13.8476 16.4976 14.0892C16.9892 14.3307 17.4186 14.6817 17.7528 15.1151C18.0244 15.5181 18.201 15.9771 18.2693 16.4579C18.3556 17.114 18.3177 17.7803 18.1573 18.4223C17.7661 20.1349 16.6526 22.1774 14.9173 24.377ZM27.7406 25.8689C27.6212 26.6908 27.2887 27.4674 26.7762 28.1216C26.2636 28.7759 25.5887 29.2852 24.8183 29.599C24.0393 29.9111 23.1939 30.0217 22.3607 29.9205C21.4946 29.8089 20.6599 29.5239 19.9069 29.0824C18.7501 28.4325 17.5791 27.4348 16.2614 25.9712C18.3591 23.3846 19.669 21.0005 20.154 18.877C20.3723 17.984 20.4196 17.0579 20.2935 16.1475C20.1791 15.3632 19.8879 14.615 19.4419 13.9593C18.9194 13.2519 18.2378 12.6768 17.452 12.2805C16.6661 11.8842 15.798 11.6777 14.9175 11.6777C14.0371 11.6777 13.1689 11.8841 12.383 12.2803C11.5971 12.6765 10.9155 13.2515 10.393 13.9589C9.94707 14.6144 9.65591 15.3624 9.5414 16.1465C9.41524 17.0566 9.4623 17.9822 9.68011 18.8749C10.1648 20.9993 11.4748 23.384 13.5732 25.9714C12.2555 27.4348 11.0845 28.4325 9.92769 29.0825C9.17468 29.5239 8.34007 29.809 7.47395 29.9205C6.64065 30.0217 5.79525 29.9111 5.0162 29.599C4.24581 29.2852 3.57092 28.7759 3.05838 28.1217C2.54585 27.4674 2.21345 26.6908 2.09411 25.8689C1.97932 25.0334 2.07701 24.1825 2.37818 23.3946C2.49266 23.0728 2.62663 22.757 2.7926 22.3818C3.0274 21.851 3.27657 21.3115 3.51759 20.7898L3.54996 20.7197C5.75643 15.9419 8.12481 11.0982 10.5894 6.32294L10.6875 6.13283C10.9384 5.64601 11.1979 5.14267 11.4597 4.6563C11.7101 4.15501 12.0132 3.68171 12.3639 3.2444C12.6746 2.86903 13.0646 2.56681 13.5059 2.35934C13.9473 2.15186 14.4291 2.04426 14.9169 2.04422C15.4047 2.04418 15.8866 2.15171 16.3279 2.35911C16.7693 2.56651 17.1593 2.86867 17.4701 3.24399C17.821 3.68097 18.1242 4.15411 18.3744 4.65538C18.6338 5.13742 18.891 5.63623 19.1398 6.11858L19.2452 6.32315C21.7097 11.0979 24.078 15.9415 26.2847 20.7201L26.3046 20.7631C26.5498 21.2936 26.8033 21.8419 27.042 22.382C27.2082 22.7577 27.3424 23.0738 27.4566 23.3944C27.7576 24.1824 27.8553 25.0333 27.7406 25.8689Z"
                                fill="currentcolor"></path>
                            </svg>
                                </a>
                            </div>
                        </div>
                        <div class="p-0 col-md-7 col-lg-3 search-bar">
                            <div class="middle-tabs">
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <li class="nav-item d-none d-md-inline-flex" data-bs-target="#staticBackdropfilter1" data-bs-toggle="modal" role="presentation">
                                        <button class="nav-link" style="min-width: 300px;"><b>Start Your Search...</b></button>
                                    </li>

                                    <li class="nav-item d-none d-md-inline-flex" role="presentation">
                                        <button class="nav-link search-icon" id="pills-search-tab" data-bs-toggle="pill" data-bs-target="#pills-search" type="button" role="tab" aria-controls="pills-search" aria-selected="false">
                                <em class="bi bi-search"></em>
                            </button>
                                    </li>
                                    <li class="nav-item mobile d-md-none" style="width: calc(100% - 50px);padding: 10px 0px;" data-bs-target="#staticBackdropfilter1" data-bs-toggle="modal">
                                        <button>
                                <div class="icon-search"><em class="bi bi-search"></em></div>
                                <div class="where-to">
                                    <span>Start Your Search ...</span>
                                    
                                </div>
                            </button>
                                    </li>
                                    <li class="filter-icon d-md-none" data-bs-target="#staticBackdropfilter" data-bs-toggle="modal">
                                        <button>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height=" preserveAspectRatio="xMidYMid meet viewBox="0 0 21 21">
                                                    <g transform="rotate(90 10.5 10.5)">
                                                        <g fill="none" fill-rule="evenodd" stroke="currentColor"
                                                            stroke-linecap="rou stroke-linejoin=" round>
                                                            <path d="M14.5 9V2.5m0 16V14" />
                                                            <circle cx="14.5" cy="11.5" r="2.5" />
                                                            <path d="M6.5 5V2.5m0 16V10" />
                                                            <circle cx="6.5" cy="7.5" r="2.5" />
                                                        </g>
                                                    </g>
                                                </svg>
                                            </span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-0 col-md-4 col-lg-3 menu d-none d-md-inline-flex justify-content-md-end">
                            <div class="end-tabs">
                                <div class="host">
                                    <a href="./hosting/index.php" class="host-link"><span>Become a Host</span></a>
                                </div>
                                <div class="menu-link">
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                        d="M2 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm0 6.032a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm1 5.032a1 1 0 1 0 0 2h18a1 1 0 0 0 0-2H3Z" />
                                    </svg>
                                </div>
                                <div class="user-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 1792 1792">
                                        <path fill="currentColor"
                                        d="M1523 1339q-22-155-87.5-257.5T1251 963q-67 74-159.5 115.5T896 1120t-195.5-41.5T541 963q-119 16-184.5 118.5T269 1339q106 150 271 237.5t356 87.5t356-87.5t271-237.5zm-243-699q0-159-112.5-271.5T896 256T624.5 368.5T512 640t112.5 271.5T896 1024t271.5-112.5T1280 640zm512 256q0 182-71 347.5t-190.5 286T1245 1721t-349 71q-182 0-348-71t-286-191t-191-286T0 896t71-348t191-286T548 71T896 0t348 71t286 191t191 286t71 348z" />
                                    </svg>
                                </div>
                            </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="register.php">Sign up</a></li>
                                            <li><a class="dropdown-item" href="login.php">Log in</a></li>
                                            <div class="sub-menu-links">
                                                <li><a class="dropdown-item" href="home.php">Host your Home</a></li>
                                                <li><a class="dropdown-item" href="experience.php">Host an experience</a></li>
                                                <li><a class="dropdown-item" href="help.php">Help</a></li>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sub-header">
                    <div class="sub-header-inner">
                        <div class="container p-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="navigation-wrapper">
                                    <button>
                                        <div >
                                            <span class="c1m2z0bj c1w8ohg7">
                                                <img src="https://a0.muscache.com/pictures/8e507f16-4943-4be9-b707-59bd38d56309.jpg" alt="" width="24" height="24">
                                                <div>
                                                    <span >Islands</span>
                                                </div>
                                            </span>
                                        </div>
                                    </button>
                                    <button>
                                            <div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/8b44f770-7156-4c7b-b4d3-d92549c8652f.jpg" alt="" width="24" height="24"><div ><span >Arctic</span></div>
                                            </span>
                                    </div>
                                    </button>
                                    <button><div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/50861fca-582c-4bcc-89d3-857fb7ca6528.jpg" alt="" width="24" height="24"><div ><span >Design</span></div></span></div></button>
                                    <button>
                                        <div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/bcd1adc0-5cee-4d7a-85ec-f6730b0f8d0c.jpg" alt="" width="24" height="24"><div ><span >Beachfront</span></div>
                                        </span>
                                </div>
                                </button><button><div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/ee9e2a40-ffac-4db9-9080-b351efc3cfc4.jpg" alt="" width="24" height="24"><div ><span >Tropical</span></div></span></div></button>
                                    <button>
                                    <div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/c5a4f6fc-c92c-4ae8-87dd-57f1ff1b89a6.jpg" alt="" width="24" height="24"><div ><span >OMG!</span></div>
                                    </span>
                            </div>
                            </button><button><div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/10ce1091-c854-40f3-a2fb-defc2995bcaf.jpg" alt="" width="24" height="24"><div ><span >Beach</span></div></span></div></button>
                                    <button>
                                <div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/3fb523a0-b622-4368-8142-b5e03df7549b.jpg" alt="" width="24" height="24"><div ><span >Amazing pools</span></div>
                                </span>
                        </div>
                        </button><button><div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/5ed8f7c7-2e1f-43a8-9a39-4edfc81a3325.jpg" alt="" width="24" height="24"><div ><span >Bed &amp; breakfasts</span></div></span></div></button>
                                    <button>
                            <div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/957f8022-dfd7-426c-99fd-77ed792f6d7a.jpg" alt="" width="24" height="24"><div ><span >Surfing</span></div>
                            </span>
                    </div>
                    </button><button><div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/52c8d856-33d0-445a-a040-a162374de100.jpg" alt="" width="24" height="24"><div ><span >Shared homes</span></div></span></div></button>
                                    <button>
                        <div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/4221e293-4770-4ea8-a4fa-9972158d4004.jpg" alt="" width="24" height="24"><div ><span >Caves</span></div>
                        </span>
                </div>
                </button><button><div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/c0a24c04-ce1f-490c-833f-987613930eca.jpg" alt="" width="24" height="24"><div ><span >National parks</span></div></span></div></button>
                                    <button>
                    <div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/6ad4bd95-f086-437d-97e3-14d12155ddfe.jpg" alt="" width="24" height="24"><div ><span >Countryside</span></div>
                    </span>
                </div>
                </button><button><div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/d7445031-62c4-46d0-91c3-4f29f9790f7a.jpg" alt="" width="24" height="24"><div ><span >Earth homes</span></div></span></div></button>
                                    <button>
                <div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/732edad8-3ae0-49a8-a451-29a8010dcc0c.jpg" alt="" width="24" height="24"><div ><span >Cabins</span></div>
                </span>
                </div>
                </button><button><div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/c8e2ed05-c666-47b6-99fc-4cb6edcde6b4.jpg" alt="" width="24" height="24"><div ><span >Luxe</span></div></span></div></button>
                                    <button>
                <div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/a4634ca6-1407-4864-ab97-6e141967d782.jpg" alt="" width="24" height="24"><div ><span >Lake</span></div>
                </span>
                </div>
                </button><button><div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/35919456-df89-4024-ad50-5fcb7a472df9.jpg" alt="" width="24" height="24"><div ><span >Tiny homes</span></div></span></div></button>
                                    <button>
                    <div ><span class="c1m2z0bj"><img src="https://a0.muscache.com/pictures/1b6a8b70-a3b6-48b5-88e1-2243d9172c06.jpg" alt="" width="24" height="24"><div ><span >Castles</span></div>
                    </span>
                    </div>
                    </button>

                                </div>
                                <div class="filter-btn d-none d-md-inline-flex">
                                    <!-- triggers a modal -->
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropfilter">
                            <span>
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="32" height="preserveAspectRatio="xMidYMid meet viewBox="0 0 21 21">
                                        <g transform="rotate(90 10.5 10.5)">
                                        <g fill="none" fill-rule="evenodd" stroke="currentColor"
                                            stroke-linecap="rou    stroke-linejoin=" round>
                                            <path d="M14.5 9V2.5m0 16V14" />
                                            <circle cx="14.5" cy="11.5" r="2.5" />
                                            <path d="M6.5 5V2.5m0 16V10" />
                                            <circle cx="6.5" cy="7.5" r="2.5" />
                                        </g>
                                        </g>
                                    </svg></span>
                                <span>Filters</span>
                            </span>
                            </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- TODO <======== FILTER MODAL START =========> -->
            <div class="modal fade filter" id="staticBackdropfilter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <h6 class="modal-title" id="staticBackdropLabel">Filters</h6>
                            <div style="background-color: transparent; width: 2rem;height: 2px"></div>
                        </div>
                        <div class="modal-body">
                            <div class="price-range">
                                <div class="title">
                                    <h4>Price range
                                    </h4>
                                    <span>The average nightly price is $79</span>
                                </div>
                                <div class="my-3">
                                    <label for="customRange3" class="form-label">Example range</label>
                                    <input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3">
                                </div>

                            </div>
                            <div class="type-of-place">
                                <div class="title">
                                    <h4>Type of place</h4>
                                </div>
                                <div class="type-of-place-wrapper">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-1">
                                        <label class="form-check-label" for="flexCheckDefault-2">
                                <h6>Entire room</h6>
                                <span>A place to all yourself</span>
                            </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-2">
                                        <label class="form-check-label" for="flexCheckDefault-2">
                                <h6>Private room</h6>
                                <span>Your own room in a home or hotel, plus some shared common spaces</span>
                            </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-3">
                                        <label class="form-check-label" for="flexCheckDefault-3">
                                <h6>Shared room</h6>
                                <span>A sleeping space and common areas that may be shared with others</span>
                            </label>
                                    </div>
                                </div>
                            </div>
                            <div class="rooms-and-bed">
                                <div class="title">
                                    <h4>Rooms and beds</h4>
                                </div>
                                <div class="each-room">
                                    <div class="top"><span>Bedrooms</span></div>
                                    <div class="bottom">
                                        <button class="active">Any</button>
                                        <button>1</button>
                                        <button>2</button>
                                        <button>3</button>
                                        <button>4</button>
                                        <button>5</button>
                                        <button>6</button>
                                        <button>7</button>
                                        <button>8+</button>
                                    </div>
                                </div>
                                <div class="each-room">
                                    <div class="top"><span>Bed</span></div>
                                    <div class="bottom">
                                        <button class="active">Any</button>
                                        <button>1</button>
                                        <button>2</button>
                                        <button>3</button>
                                        <button>4</button>
                                        <button>5</button>
                                        <button>6</button>
                                        <button>7</button>
                                        <button>8+</button>
                                    </div>
                                </div>
                                <div class="each-room">
                                    <div class="top"><span>Bathrooms</span></div>
                                    <div class="bottom">
                                        <button class="active">Any</button>
                                        <button>1</button>
                                        <button>2</button>
                                        <button>3</button>
                                        <button>4</button>
                                        <button>5</button>
                                        <button>6</button>
                                        <button>7</button>
                                        <button>8+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="property-type">
                                <div class="title">
                                    <h4>Property type</h4>
                                </div>
                                <div class="property-wrap">
                                    <a href="#" class="each-property">
                                        <div class="logo"><img src="../assets/images/property1.jpg" alt="" class="img-fluid"></div>
                                        <div class="property-name"><span>House</span></div>
                                    </a>
                                    <a href="#" class="each-property">
                                        <div class="logo"><img src="../assets/images/property2.jpg" alt="" class="img-fluid"></div>
                                        <div class="property-name"><span>Apartment</span></div>
                                    </a>
                                    <a href="#" class="each-property">
                                        <div class="logo"><img src="../assets/images/property3.jpg" alt="" class="img-fluid"></div>
                                        <div class="property-name"><span>Guesthouse</span></div>
                                    </a>
                                    <a href="#" class="each-property">
                                        <div class="logo"><img src="../assets/images/property4.jpg" alt="" class="img-fluid"></div>
                                        <div class="property-name"><span>Hotel</span></div>
                                    </a>
                                </div>
                            </div>
                            <div class="amenities">
                                <div class="title">
                                    <h4>Amenities</h4>
                                </div>
                                <div class="amenities-inner">
                                    <div class="amenities-inner-one">
                                        <div class="top"><b>Essentials</b></div>
                                        <div class="body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-1">
                                                <label class="form-check-label" for="flexCheckDefault-1">
                                        Wifi
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-2">
                                                <label class="form-check-label" for="flexCheckDefault-2">
                                        Kitchen
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-3">
                                                <label class="form-check-label" for="flexCheckDefault-3">
                                        Washer
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-4">
                                                <label class="form-check-label" for="flexCheckDefault-4">
                                        Dryer
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-4">
                                                <label class="form-check-label" for="flexCheckDefault-4">
                                        Air Conditioning
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                                <label class="form-check-label" for="flexCheckDefault-6">
                                        Heating
                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="amenities-inner-two">
                                        <div class="top"><b>Features</b></div>
                                        <div class="body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-1">
                                                <label class="form-check-label" for="flexCheckDefault-1">
                                        Pool
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-2">
                                                <label class="form-check-label" for="flexCheckDefault-2">
                                        Hothub
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-3">
                                                <label class="form-check-label" for="flexCheckDefault-3">
                                        Free perking on premises
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-4">
                                                <label class="form-check-label" for="flexCheckDefault-4">
                                        EV Charger
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-4">
                                                <label class="form-check-label" for="flexCheckDefault-4">
                                        Crib
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                                <label class="form-check-label" for="flexCheckDefault-6">
                                        Gym
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                                <label class="form-check-label" for="flexCheckDefault-6">
                                        BBQ grill
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                                <label class="form-check-label" for="flexCheckDefault-6">
                                        Breakfast
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                                <label class="form-check-label" for="flexCheckDefault-6">
                                        Indoor Fireplace
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                                <label class="form-check-label" for="flexCheckDefault-6">
                                        Smoking allowed
                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="amenities-inner-three">
                                        <div class="top"><b>Location</b></div>
                                        <div class="body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-1">
                                                <label class="form-check-label" for="flexCheckDefault-1">
                                        Beachfront
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-2">
                                                <label class="form-check-label" for="flexCheckDefault-2">
                                        Waterfront
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-3">
                                                <label class="form-check-label" for="flexCheckDefault-3">
                                        Ski-in/Ski-out
                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="amenities-inner-three">
                                        <div class="top"><b>Safety</b></div>
                                        <div class="body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-1">
                                                <label class="form-check-label" for="flexCheckDefault-1">
                                        Smoke alarm
                                    </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-2">
                                                <label class="form-check-label" for="flexCheckDefault-2">
                                        Carbon monoxide alarm
                                    </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="show-hide"><a href="#">Show less</a></div>
                            </div>
                            <div class="booking-options">
                                <div class="title">
                                    <h4>Booking options</h4>
                                </div>
                                <div class="body">
                                    <div>
                                        <div class="left">
                                            <div class="top">
                                                <h6>Instant Book</h6>
                                            </div>
                                            <div class="bottom"><span>Listings you can book without waiting for Host approval</span>
                                            </div>
                                        </div>
                                        <div class="right">
                                            <div class="toggle">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="left">
                                            <div class="top">
                                                <h6>Self check-in</h6>
                                            </div>
                                            <div class="bottom"><span>Easy access to the property once you arrive</span></div>
                                        </div>
                                        <div class="right">
                                            <div class="toggle">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accessibility">
                                <div class="title">
                                    <h4>Accessibility features</h4>
                                </div>
                                <div class="sub-text">
                                    <p>This info was provided by the Host and reviewed by Airbnb.</p>
                                </div>
                                <div class="accessibility-inner-one">
                                    <div class="top"><b>Guest entrance and parking</b></div>
                                    <div class="body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-1">
                                            <label class="form-check-label" for="flexCheckDefault-1">
                                    Step-free guest entrance
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-2">
                                            <label class="form-check-label" for="flexCheckDefault-2">
                                    Guest entrance wider than 32 inches
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-3">
                                            <label class="form-check-label" for="flexCheckDefault-3">
                                    Accessible parking spot
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-4">
                                            <label class="form-check-label" for="flexCheckDefault-4">
                                    Step-free path to guest entrance
                                </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="accessibility-inner-two">
                                    <div class="top"><b>Bedroom</b></div>
                                    <div class="body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-5">
                                            <label class="form-check-label" for="flexCheckDefault-5">
                                    Step-free bedroom access
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-6">
                                            <label class="form-check-label" for="flexCheckDefault-6">
                                    Bedroom entrance wider than 32 inches
                                </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="accessibility-inner-three">
                                    <div class="top"><b>Bathroom</b></div>
                                    <div class="body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-7">
                                            <label class="form-check-label" for="flexCheckDefault-7">
                                    Step-free bathroom entrance
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-8">
                                            <label class="form-check-label" for="flexCheckDefault-8">
                                    Bathroom entrance wider than 32 inches
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-9">
                                            <label class="form-check-label" for="flexCheckDefault-9">
                                    Shower grab Bar
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-10">
                                            <label class="form-check-label" for="flexCheckDefault-10">
                                    Toilet grab Bar
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-11">
                                            <label class="form-check-label" for="flexCheckDefault-11">
                                    Step-free shower
                                </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-12">
                                            <label class="form-check-label" for="flexCheckDefault-12">
                                    Shower or bath chair
                                </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="accessibility-inner-four">
                                    <div class="top"><b>Adaptive Equipment</b></div>
                                    <div class="body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-13">
                                            <label class="form-check-label" for="flexCheckDefault-13">
                                    Ceiling or mobile hoist
                                </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="show-hide">
                                    <a href="#">Show more</a>
                                </div>
                            </div>
                            <div class="top-tiers">
                                <div class="title">
                                    <h4>Top tier stays</h4>
                                </div>
                                <div class="top-tiers-inner">
                                    <div class="left">
                                        <div class="top"><span>Superhost</span></div>
                                        <div class="middle"><span>Stay with recognized Hosts</span></div>
                                        <div class="link"><span><a href="#">Learn more</a></span></div>
                                    </div>
                                    <div class="right">
                                        <div class="toggle">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="host-language">
                                <div class="title">
                                    <h4>Host langugae</h4>
                                </div>
                                <form action="">
                                    <div class="host-language-inner">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                            <label class="form-check-label" for="flexCheckDefault1">English</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                            <label class="form-check-label" for="flexCheckDefault2">French</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                            <label class="form-check-label" for="flexCheckDefault3">German</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">
                                            <label class="form-check-label" for="flexCheckDefault4">Italian</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- <form class="form-floating">
                        <input type="email" class="form-control" id="floatingInputValue" placeholder="name@example.com"
                            value="test@example.com">
                        <label for="floatingInputValue">Input with value</label>
                    </form> -->

                        </div>
                        <div class="modal-footer">
                            <a href="#" class="cancel">Cancel all</a>
                            <a href="#" class="show">Show 1,000+ homes</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <======= FILTER MODAL ENDS ========> -->

            <!-- TODO <======== SEARCH BAR MODAL START =========> -->
            <div class="modal fade filter" id="staticBackdropfilter1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <h6 class="modal-title" id="staticBackdropLabel">Start Your Search</h6>
                            <div style="background-color: transparent; width: 2rem;height: 2px"></div>
                        </div>
                        <div class="modal-body">

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Stays
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Experiences</button>
                                </li>
                                <!--
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Online Experiences</button>
                                </li>-->
                            </ul>
                            <div class="tab-content" id="pills-tabContent" class="mb-0">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <form class="row">
                                        <div class="mb-3">
                                            <label class="form-label"><b>Destinations</b></label>
                                            <select class="form-select">
                                            <option>Disabled select</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="exampleInputPassword1" class="form-label"><b>Check In Date</b></label>
                                            <input type="text" class="form-control datepicker" placeholder="Choose Date">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="exampleInputPassword1" class="form-label"><b>Check out Date</b></label>
                                            <input type="text" class="form-control datepicker" placeholder="Choose Date">
                                        </div>
                                        <div class="col-12 mb-3 ">
                                            <small>Guests</small>
                                            <div class="dropdown ">
                                                <button class="btn dropdown-toggle d-block show" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true" style="width: calc(100% - 30px);border: 1px solid #969696 !important;border-radius:25px;border: 2px solid;
                                                border-radius: 25px;
                                                height: 39px;" type="button">
                                                1 Guests
                                                </button>
                                                <ul class="dropdown-menu w-100 " data-popper-placement="bottom-start">
                                                    <li>
                                                        <a class="dropdown-item">
                                                            <div role="group" class="d-flex justify-content-between px-2">
                                                                <div class="_bc4egv d-grid py-1">
                                                                    <div class="_1ynrq4v"><b>Adults</b></div>
                                                                    <div class="_1wh7hnv">Age 13+</div>
                                                                </div>
                                                                <div class="_jro6t0 d-flex align-items-center">
                                                                    <div class="d-flex gap-3 align-items-center">
                                                                        <span class="_ul9u8c prev">-</span>
                                                                        <span class="counter">8</span>
                                                                        <span class="_ul9u8c next">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div role="group" class="d-flex justify-content-between px-2" aria-labelledby="GuestPicker-book_it-form-adults" aria-describedby="GuestPicker-book_it-form-adults-subtitle">
                                                                <div class="_bc4egv d-grid py-1">
                                                                    <div class="_1ynrq4v"><b>Adults</b></div>
                                                                    <div class="_1wh7hnv">Age 13+</div>
                                                                </div>
                                                                <div class="_jro6t0 d-flex align-items-center">
                                                                    <div class="d-flex gap-3 align-items-center">
                                                                        <span class="_ul9u8c prev">-</span>
                                                                        <span class="counter">5</span>
                                                                        <span class="_ul9u8c next">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div role="group" class="d-flex justify-content-between px-2" aria-labelledby="GuestPicker-book_it-form-adults" aria-describedby="GuestPicker-book_it-form-adults-subtitle">
                                                                <div class="_bc4egv d-grid py-1">
                                                                    <div class="_1ynrq4v"><b>Adults</b></div>
                                                                    <div class="_1wh7hnv">Age 13+</div>
                                                                </div>
                                                                <div class="_jro6t0 d-flex align-items-center">
                                                                    <div class="d-flex gap-3 align-items-center">
                                                                        <span class="_ul9u8c prev">-</span>
                                                                        <span class="counter">5</span>
                                                                        <span class="_ul9u8c next">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="modal-footer p-0 pt-4" style="border: none;">
                                                <a href="#" class="show d-flex align-items-center w-100 " data-bs-dismiss="modal" aria-label="Close" style="background-color:rgb(230 30 77);font-weight: 600;border-radius: 25px !important;">
                                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 4; overflow: visible;"><g fill="none"><path d="m13 24c6.0751322 0 11-4.9248678 11-11 0-6.07513225-4.9248678-11-11-11-6.07513225 0-11 4.92486775-11 11 0 6.0751322 4.92486775 11 11 11zm8-3 9 9"></path></g></svg>
                                                    <span class="mx-3">Search </span>
                                                </a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <form class="row">
                                        <div class="mb-3">
                                            <label class="form-label"><b>Destinations</b></label>
                                            <select class="form-select">
                                            <option>Disabled select</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="exampleInputPassword1" class="form-label"><b>Check In Date</b></label>
                                            <input type="text" class="form-control datepicker" placeholder="Choose Date">
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="exampleInputPassword1" class="form-label"><b>Check out Date</b></label>
                                            <input type="text" class="form-control datepicker" placeholder="Choose Date">
                                        </div>
                                        <div class="col-12 mb-3 ">
                                            <small>Guests</small>
                                            <div class="dropdown ">
                                                <button class="btn dropdown-toggle d-block show" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true" style="width: calc(100% - 30px);
                                                border: 1px solid #969696 !important;
                                                border-radius: 25px;
                                                height: 39px;" type="button">
                                                1 Guests
                                                </button>
                                                <ul class="dropdown-menu w-100 " data-popper-placement="bottom-start">
                                                    <li>
                                                        <a class="dropdown-item">
                                                            <div role="group" class="d-flex justify-content-between px-2">
                                                                <div class="_bc4egv d-grid py-1">
                                                                    <div class="_1ynrq4v"><b>Adults</b></div>
                                                                    <div class="_1wh7hnv">Age 13+</div>
                                                                </div>
                                                                <div class="_jro6t0 d-flex align-items-center">
                                                                    <div class="d-flex gap-3 align-items-center">
                                                                        <span class="_ul9u8c prev">-</span>
                                                                        <span class="counter">8</span>
                                                                        <span class="_ul9u8c next">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div role="group" class="d-flex justify-content-between px-2" aria-labelledby="GuestPicker-book_it-form-adults" aria-describedby="GuestPicker-book_it-form-adults-subtitle">
                                                                <div class="_bc4egv d-grid py-1">
                                                                    <div class="_1ynrq4v"><b>Adults</b></div>
                                                                    <div class="_1wh7hnv">Age 13+</div>
                                                                </div>
                                                                <div class="_jro6t0 d-flex align-items-center">
                                                                    <div class="d-flex gap-3 align-items-center">
                                                                        <span class="_ul9u8c prev">-</span>
                                                                        <span class="counter">5</span>
                                                                        <span class="_ul9u8c next">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item">
                                                            <div role="group" class="d-flex justify-content-between px-2" aria-labelledby="GuestPicker-book_it-form-adults" aria-describedby="GuestPicker-book_it-form-adults-subtitle">
                                                                <div class="_bc4egv d-grid py-1">
                                                                    <div class="_1ynrq4v"><b>Adults</b></div>
                                                                    <div class="_1wh7hnv">Age 13+</div>
                                                                </div>
                                                                <div class="_jro6t0 d-flex align-items-center">
                                                                    <div class="d-flex gap-3 align-items-center">
                                                                        <span class="_ul9u8c prev">-</span>
                                                                        <span class="counter">5</span>
                                                                        <span class="_ul9u8c next">+</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="modal-footer p-0 pt-4" style="border: none;">
                                                <a href="#" class="show d-flex align-items-center w-100 " data-bs-dismiss="modal" aria-label="Close" style="background-color:rgb(230 30 77);font-weight: 600;">
                                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 16px; width: 16px; stroke: currentcolor; stroke-width: 4; overflow: visible;"><g fill="none"><path d="m13 24c6.0751322 0 11-4.9248678 11-11 0-6.07513225-4.9248678-11-11-11-6.07513225 0-11 4.92486775-11 11 0 6.0751322 4.92486775 11 11 11zm8-3 9 9"></path></g></svg>
                                                    <span class="mx-3">Search </span>
                                                </a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- <======= SEARCH BAR MODAL ENDS ========> -->

            <main>
                <div class="main-inner">
                    <div v-if="apartments" class="container p-0">
                        <!-- card wrapper -->
                        <div v-for="(item, index) in apartments" class="image-content-wrapper">
                            <!-- card item -->
                            <a href="rooms.php" class="card-item">
                                <div class="card">
                                    <div class="card-image">
                                        <div class="icon-love">
                                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="fill: rgba(0, 0, 0, 0.5); height: 24px; width: 24px; stroke-width: 2; overflow: visible;">
                                                <path
                                                    d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                                </path>
                                            </svg>
                                        </div>
                                        <!-- carousel-start -->

                                        <div v-if="item.images" id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                                            </div>

                                            <div v-for="(image, each) in item.images" class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img :src="image.image" class="card-img-top d-block w-100" alt="...">
                                                </div>
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                                <em class="bi bi-chevron-left"></em>
                                                </span>
                                                <span class="visually-hidden"></span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true">
                                                <em class="bi bi-chevron-right"></em>
                                                </span>
                                                <span class="visually-hidden"></span>
                                            </button>
                                        </div>
                                        <!-- carousel-end -->
                                    </div>
                                    <div class="card-body">

                                        <div class="card-body-inner">
                                            <div class="left">
                                                <div class="location">
                                                    <h6>{{item.apartment_city}}, {{item.apartment_country}}</h6>
                                                </div>
                                                <div class="kilometre"><span>3,340 kilometre</span></div>
                                                <div class="date"><span>Jan 3 - 8</span></div>
                                                <div class="price"><span><b>{{item.listing_currency_symbol}}{{item.price}}</b> night</span></div>
                                            </div>
                                            <div class="right">
                                                <div class="rating">
                                                    <span class="icon"><em class="bi bi-star-fill"></em></span>
                                                    <span class="rate-value">New</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <!-- card item end -->

                        </div>
                        <!-- card wrapper ends -->
                    </div>
                </div>
            </main>
            <!-- main end -->


            <!-- footer start -->
            <footer>
                <div class="footer-inner">
                    <!-- map -->
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="currentColor" d="M48.17 113.34A32 32 0 0 0 32 141.24V438a32 32 0 0 0 47 28.37c.43-.23.85-.47 1.26-.74l84.14-55.05a8 8 0 0 0 3.63-6.72V46.45a8 8 0 0 0-12.51-6.63Zm164.19-74.03A8 8 0 0 0 200 46v357.56a8 8 0 0 0 3.63 6.72l96 62.42A8 8 0 0 0 312 466V108.67a8 8 0 0 0-3.64-6.73Zm252.17 7.16a31.64 31.64 0 0 0-31.5-.88a12.07 12.07 0 0 0-1.25.74l-84.15 55a8 8 0 0 0-3.63 6.72v357.46a8 8 0 0 0 12.52 6.63l107.07-73.46a32 32 0 0 0 16.41-28v-296a32.76 32.76 0 0 0-15.47-28.21Z"/></svg> -->
                    <div class="container p-0">
                        <!-- mobile view footer -->
                        <div class="row col-12 m-0 align-items-center justify-content-center d-md-none mobile-view">
                            <div class="p-0 col-2 each-link">
                                <a href="#" class="active">
                                    <div class="svg-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396l1.414-1.414l-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8s3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6s-6-2.691-6-6s2.691-6 6-6z" />
                            </svg>
                                    </div>
                                    <div class="text"><small>Explore</small></div>
                                </a>
                            </div>
                            <div class="p-0 col-2 each-link">
                                <a href="#">
                                    <div class="svg-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36">
                                <path fill="currentColor"
                                    d="M18 32.43a1 1 0 0 1-.61-.21C11.83 27.9 8 24.18 5.32 20.51C1.9 15.82 1.12 11.49 3 7.64c1.34-2.75 5.19-5 9.69-3.69A9.87 9.87 0 0 1 18 7.72a9.87 9.87 0 0 1 5.31-3.77c4.49-1.29 8.35.94 9.69 3.69c1.88 3.85 1.1 8.18-2.32 12.87c-2.68 3.67-6.51 7.39-12.07 11.71a1 1 0 0 1-.61.21ZM10.13 5.58A5.9 5.9 0 0 0 4.8 8.51c-1.55 3.18-.85 6.72 2.14 10.81A57.13 57.13 0 0 0 18 30.16a57.13 57.13 0 0 0 11.06-10.83c3-4.1 3.69-7.64 2.14-10.81c-1-2-4-3.59-7.34-2.65a8 8 0 0 0-4.94 4.2a1 1 0 0 1-1.85 0a7.93 7.93 0 0 0-4.94-4.2a7.31 7.31 0 0 0-2-.29Z"
                                    class="clr-i-outline clr-i-outline-path-1" />
                                <path fill="none" d="M0 0h36v36H0z" />
                            </svg>
                                    </div>
                                    <div class="text"><small>Wishlists</small></div>
                                </a>
                            </div>
                            <div class="p-0 col-2 each-link">
                                <a href="#">
                                    <div class="svg-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256">
                                <path fill="currentColor"
                                    d="M232 128a104 104 0 1 0-174.2 76.7l1.3 1.2a104 104 0 0 0 137.8 0l1.3-1.2A103.7 103.7 0 0 0 232 128Zm-192 0a88 88 0 1 1 153.8 58.4a79.2 79.2 0 0 0-36.1-28.7a48 48 0 1 0-59.4 0a79.2 79.2 0 0 0-36.1 28.7A87.6 87.6 0 0 1 40 128Zm56-8a32 32 0 1 1 32 32a32.1 32.1 0 0 1-32-32Zm-21.9 77.5a64 64 0 0 1 107.8 0a87.8 87.8 0 0 1-107.8 0Z" />
                            </svg>
                                    </div>
                                    <div class="text"><small>Log in</small></div>
                                </a>
                            </div>
                        </div>
                        <!-- end of mobile footer view -->
                        <!-- large screen footer -->
                        <div class="row col-12 m-0 align-items-center justify-content-center justify-content-md-between d-none d-md-inline-flex">
                            <div class="p-0 left col-md-4">
                                <div class="inner">
                                    <span>&copy; Airbnb, Inc.</span>
                                    <span class="dot"></span>
                                    <a href="">Privacy</a>
                                    <span class="dot"></span>
                                    <a href="">Terms</a>
                                    <span class="dot"></span>
                                    <a href="">Sitemap</a>
                                    <span class="dot"></span>
                                    <a href="">Destinations</a>
                                </div>
                            </div>
                            <div class="p-0 right col-md-4">
                                <div class="inner">
                                    <!-- ! ======== button for language ========== -->
                                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            <div class="svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M8.5 1a6.5 6.5 0 1 1 0 13a6.5 6.5 0 0 1 0-13zm4.894 4a5.527 5.527 0 0 0-3.053-2.676c.444.84.765 1.74.953 2.676h2.1zm.582 2.995A5.11 5.11 0 0 0 14 7.5a5.464 5.464 0 0 0-.213-1.5h-2.342c.032.331.055.664.055 1a10.114 10.114 0 0 1-.206 2h2.493c.095-.329.158-.665.19-1.005zm-3.535 0l.006-.051A9.04 9.04 0 0 0 10.5 7a8.994 8.994 0 0 0-.076-1H6.576A8.82 8.82 0 0 0 6.5 7a8.98 8.98 0 0 0 .233 2h3.534c.077-.332.135-.667.174-1.005zM10.249 5a8.974 8.974 0 0 0-1.255-2.97C8.83 2.016 8.666 2 8.5 2a3.62 3.62 0 0 0-.312.015l-.182.015L8 2.04A8.97 8.97 0 0 0 6.751 5h3.498zM5.706 5a9.959 9.959 0 0 1 .966-2.681A5.527 5.527 0 0 0 3.606 5h2.1zM3.213 6A5.48 5.48 0 0 0 3 7.5A5.48 5.48 0 0 0 3.213 9h2.493A10.016 10.016 0 0 1 5.5 7c0-.336.023-.669.055-1H3.213zm2.754 4h-2.36a5.515 5.515 0 0 0 3.819 2.893A10.023 10.023 0 0 1 5.967 10zM8.5 12.644A8.942 8.942 0 0 0 9.978 10H7.022A8.943 8.943 0 0 0 8.5 12.644zM11.033 10a10.024 10.024 0 0 1-1.459 2.893A5.517 5.517 0 0 0 13.393 10h-2.36z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="text" style="margin-left: 7px;"><span>English (US)</span></div>
                            </button>

                                    <!-- * ========== button for currency pair ========= -->
                                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                            <span>$ USD</span>
                            </button>

                                    <!-- ? ========= button for bottom offcanvas ========== -->
                                    <button class="" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                            <div class="text" style="margin-right: 7px;"><span>Support & Resources</span></div>
                            <div class="svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m4 15l8-8l8 8" />
                                </svg>
                            </div>
                            </button>
                                </div>
                            </div>
                        </div>
                        <!-- end of large screen footer -->
                    </div>
                </div>

                <!-- &middot; -->
            </footer>
            <!-- footer end -->

        </div>


        <!-- !<======= MODALSSSS ========> -->

        <!-- ? <====== CANVAS FROM BOTTOM ======> -->
        <div class="offcanvas offcanvas-bottom resources" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="container p-0">
                    <div class="row col-12 m-0 align-items-start justify-content-evenly">
                        <div class="p-0 col-md-3">
                            <div class="inner">
                                <div class="title"><small><b>Support</b></small></div>
                                <div class="body">
                                    <ul>
                                        <li><a href="#">Help Center</a></li>
                                        <li><a href="#">AirCover</a></li>
                                        <li><a href="#">Safety information</a></li>
                                        <li><a href="#">Supporting people with disabilites</a></li>
                                        <li><a href="#">Cancellation options</a></li>
                                        <li><a href="#">Our COVID-19 Response</a></li>
                                        <li><a href="#">Report a neighborhood concern</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="p-0 col-md-3">
                            <div class="inner">
                                <div class="title"><small><b>Community</b></small></div>
                                <div class="body">
                                    <ul>
                                        <li><a href="#">Airbnb.org: disaster relief housing</a></li>
                                        <li><a href="#">Support Afghan refugees</a></li>
                                        <li><a href="#">Combating discrimination</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="p-0 col-md-3">
                            <div class="inner">
                                <div class="title"><small><b>Hosting</b></small></div>
                                <div class="body">
                                    <ul>
                                        <li><a href="#">Try Hosting</a></li>
                                        <li><a href="#">Aircover for hosting</a></li>
                                        <li><a href="#">Explore hosting Resources</li>
                                        <li><a href="#">Visit our conmmunity forum</a></li>
                                        <li><a href="#">How to host responsibly</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="p-0 col-md-3">
                            <div class="inner">
                                <div class="title"><small><b>Airbnb</b></small></div>
                                <div class="body">
                                    <ul>
                                        <li><a href="#">Newsroom</a></li>
                                        <li><a href="#">Learn about new features</a></li>
                                        <li><a href="#">Letter from our founders</a></li>
                                        <li><a href="#">Careers</a></li>
                                        <li><a href="#">Investors</a></li>
                                        <li><a href="#">Gift Cards</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../assets/js/jquery-ui.min.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
        $('.next').click(function() {
            let no = $(this).prev().text();
            $(this).prev().text(parseInt(no) + 1);
        });
        $('.prev').click(function() {
            let no = $(this).next().text();
            if (no == 0) {
                $(this).next().text(0);
            } else {
                $(this).next().text(parseInt(no) - 1);
            }

        });
    </script>
    <?php include "./includes/vue-script.php"; ?>
</body>

</html>