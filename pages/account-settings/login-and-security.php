<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Login and Security</title>
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
			crossorigin="anonymous" />
         <link rel="stylesheet" href="../../assets/fonts/bootstrap-icons.css">
      <link rel="stylesheet" href="../../assets/css/layout.css">
      <link rel="stylesheet" href="../../assets/css/footer.css">
      <link rel="stylesheet" href="../../assets/css/nav.css">
      <link rel="stylesheet" href="../../admin/assets/css/toasteur-default.min.css">
	</head>
		<style>
         .container{
            max-width: 1140px;
         }
         main.container{
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            row-gap: 2rem;
            width: 100%;
         }
         .page-title h2{
            font-weight: bold;
         }
         .page-inner{
            width: 100%;
         }
         .page-inner .form-wrapper{
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            row-gap: 10px;
         }
         .page-inner h4{
            font-weight: 600;
         }
         .page-inner form{
            width: 100%;
            margin-top: 2rem;
         }
         .page-inner > .row {
            row-gap: 3rem;
         }

         /* content wrapper */
         .content-wrapper{
            border: 1px solid rgb(228, 228, 228) ;
            padding: 24px;
         }
         .content-wrapper-inner{
            margin: 0px;
            background-color: rgb(255, 255, 255);
            display: flex;
            align-items: flex-start;
            row-gap: 2em;
            flex-direction: column;
         }
         .each-content{
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            -ms-flex-direction: column;
            row-gap: 1.5rem;
         }
         .each-form-content{
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            -ms-flex-direction: column;
            row-gap: .7rem;
            width: 100%;
            border-bottom:1px solid #EBEBEB;
            padding-bottom: 1.3rem;
            margin-top: .8rem;
         }.each-form-content strong{
            font-size: 1.1rem;
         }
         .each-form-content.translator{
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
            display: flex;
         }
         .each-form-content.translator .title-button{
            all: unset;
            align-items: flex-start;
            flex-direction: column;
            display: flex;
         }
         .each-form-content .title-button {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
         }
         .each-form-content .title-button button{
            font-size: 1rem;
            color: #008489;
            font-weight: 600;
         }
         .each-form-content a{
            color:#008489;
            font-size: 1rem;
            font-weight: 600;
         }
         .each-form-content a:hover{
            text-decoration: underline;
         }
         .each-form-content .title-button button:hover{
            text-decoration: underline;
         }
         :is(.breadcrumb-item, .breadcrumb-item a){
            color: #484871;
         }
         .breadcrumb-item a{
            font-weight: 600;
            letter-spacing: .3px;
         }
         .breadcrumb-item a:hover{
            text-decoration: underline;
         }
         .variant{
            width: 100%
         }
         .variant-link{
            color: #008489;
            font-size: 1rem;
            font-weight: 600;
         }
         .variant-link:hover{
            color: #008489;
         }
         /* modal form */
         .modal-body form{
            margin-top: 3rem;
         }
         .modal-body .form-select{
            min-height: 3rem;
            border-radius: 6px;
            font-size: 15px;
         }
         .modal-body .form-select:focus{
            box-shadow: none;
            border: 2px solid #008489;
         }
         .modal-body form .submit-btn{
            padding-top: 2rem;
         }
         .modal-body form button{
            background: rgba(0, 132, 137, 0.3);
            border-color: transparent;
            color: rgb(255, 255, 255);
            display: inline-block;
            padding: 10px 22px;
            min-width: 71.1935px;
            border-style: solid;
            border-color: transparent;
            border-radius: 4px;
            display: flex;
            align-items: center;
            font-weight: 600;
            justify-content: center;
         }
         .modal-body form button:hover{
            background:#008489;
            color: #fff;
         }
         .top-text{
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            row-gap: 5px;
         }
         .title-button .left{
            display: flex;
            align-items: flex-start;
         }
         .title-button .left .top-text{
            padding-left: 1.1rem;

         }
         .variant .title-button{
            align-items: flex-start;
         }
         .title-button .left small{
            display: flex;
            align-items: center;
            color: #000;
            font-weight: 600;
            background: #e5e5e5;
            padding: 4px 7px;
            font-size: 10px;
            border-radius: 3px;
         }
         .title-button .left :is(span, strong){
            line-height: 1;
         }
         .title-button .left span{
            font-size: 15px;
         }

         .options{
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            row-gap: 2rem;
            padding: 1rem 0;
         }
         .options .option {
            display: flex;
            align-items: flex-start;
         }
         .options .option .sub-text{
            font-size: 14px;
         }
         .modal#improve .modal-header{
            margin: 0;
         }
      </style>
	<body>
      <div id="user" v-cloak>
         <div class="body-wrapper">
         <!-- <header>
            <div class="header-inner">
               <div class="row col-12 m-0 align-items-center justify-content-between justify-content-md-around">
                  <div class="p-0 col-md-1 col-lg-2 logo text-md-start d-none d-md-inline-flex">
                        <div class="lg-screen-logo d-none d-lg-inline-flex">
                           <a href="#">
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
                              <li class="nav-item d-none d-md-inline-flex" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Anywhere</button>
                              </li>
                              <span class="bar d-none d-md-inline-flex"></span>
                              <li class="nav-item d-none d-md-inline-flex" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Any week</button>
                              </li>
                              <span class="bar d-none d-md-inline-flex"></span>
                              <li class="nav-item d-none d-md-inline-flex" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Add Guest</button>
                              </li>
                              <li class="nav-item d-none d-md-inline-flex" role="presentation">
                                    <button class="nav-link search-icon" id="pills-search-tab" data-bs-toggle="pill" data-bs-target="#pills-search" type="button" role="tab" aria-controls="pills-search" aria-selected="false">
                              <em class="bi bi-search"></em>
                           </button>
                              </li>
                              <li class="nav-item mobile d-md-none">
                                    <button>
                              <div class="icon-search"><em class="bi bi-search"></em></div>
                              <div class="where-to">
                                 <span>Where to?</span>
                                 <div>
                                    <a href="#">Anywhere</a>
                                    <span class="dot"></span>
                                    <a href="#">Any week</a>
                                    <span class="dot"></span>
                                    <a href="#">Add guests</a>
                                 </div>
                              </div>
                           </button>
                              </li>
                              <li class="filter-icon d-md-none">
                                    <button>
                              <span><svg xmlns="http://www.w3.org/2000/svg" width="32" height="preserveAspectRatio="
                                    xMidYMid meet" viewBox="0 0 21 21">
                                    <g transform="rotate(90 10.5 10.5)">
                                       <g fill="none" fill-rule="evenodd" stroke="currentColor"
                                          stroke-linecap="rou    stroke-linejoin=" round">
                                          <path d="M14.5 9V2.5m0 16V14" />
                                          <circle cx="14.5" cy="11.5" r="2.5" />
                                          <path d="M6.5 5V2.5m0 16V10" />
                                          <circle cx="6.5" cy="7.5" r="2.5" />
                                       </g>
                                    </g>
                                 </svg></span>
                           </button>
                              </li>
                           </ul>


                        </div>

                  </div>
                  <div class="p-0 col-md-4 col-lg-3 menu d-none d-md-inline-flex justify-content-md-end">
                        <div class="end-tabs">
                           <div class="host">
                              <a href="#" class="host-link"><span>Become a Host</span></a>
                              <a href="#" class="host-icon"><em class="bi bi-globe"></em></a>
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
                                       <li><a class="dropdown-item" href="#">Messages</a></li>
                                       <li><a class="dropdown-item" href="#">Notifications</a></li>
                                       <li><a class="dropdown-item" href="#">Trips</a></li>
                                       <li><a class="dropdown-item" href="#">Wishlists</a></li>
                                       <div class="sub-menu-links">
                                          <li><a class="dropdown-item" href="#">Host your Home</a></li>
                                          <li><a class="dropdown-item" href="#">Host an experience</a></li>
                                          <li><a class="dropdown-item" href="#">Account</a></li>
                                       </div>
                                       <div class="sub-menu-links">
                                          <li><a class="dropdown-item" href="#">Help</a></li>
                                          <li><a class="dropdown-item" href="#">Log out</a></li>
                                       </div>
                                    </ul>
                              </div>
                           </div>
                        </div>
                  </div>
               </div>
            </div>
         </header> -->

         <header>
					<div class="header-inner">
						<div class="row col-12 m-0 align-items-center justify-content-around">
							<div class="p-0 col-md-1 col-lg-5 logo text-md-start d-none d-md-inline-flex">
								<div class="lg-screen-logo d-none d-lg-inline-flex">
									<a href="#">
                              <img style="width:100%;" src="../assets/images/GREEN_LOGO_HORIZONTAL_1.png" /> 
									</a>
								</div>
								<div class="sm-screen-logo d-lg-none">
									<a href="#">
                              <img style="width:100%;" src="../assets/images/GREEN_LOGO_VERTICAL_1.png" />
									</a>
								</div>
							</div>
							<div class="p-0 col-md-4 col-lg-5 menu d-none d-md-inline-flex justify-content-md-end">
								<div class="end-tabs">
									<div class="host">
										<a href="#" class="host-link"><span>Become a Host</span></a>
										<a href="#" class="host-icon"><em class="bi bi-globe"></em></a>
									</div>
									<div class="menu-link">
										<div class="dropdown">
											<button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
												<div class="svg">
													<svg
														xmlns="http://www.w3.org/2000/svg"
														width="16"
														height="16"
														preserveAspectRatio="xMidYMid meet"
														viewBox="0 0 24 24">
														<path
															fill="currentColor"
															d="M2 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm0 6.032a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm1 5.032a1 1 0 1 0 0 2h18a1 1 0 0 0 0-2H3Z" />
													</svg>
												</div>
												<div class="user-icon">
													<svg
														xmlns="http://www.w3.org/2000/svg"
														width="32"
														height="32"
														preserveAspectRatio="xMidYMid meet"
														viewBox="0 0 1792 1792">
														<path
															fill="currentColor"
															d="M1523 1339q-22-155-87.5-257.5T1251 963q-67 74-159.5 115.5T896 1120t-195.5-41.5T541 963q-119 16-184.5 118.5T269 1339q106 150 271 237.5t356 87.5t356-87.5t271-237.5zm-243-699q0-159-112.5-271.5T896 256T624.5 368.5T512 640t112.5 271.5T896 1024t271.5-112.5T1280 640zm512 256q0 182-71 347.5t-190.5 286T1245 1721t-349 71q-182 0-348-71t-286-191t-191-286T0 896t71-348t191-286T548 71T896 0t348 71t286 191t191 286t71 348z" />
													</svg>
												</div>
											</button>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="#">Messages</a></li>
												<li><a class="dropdown-item" href="#">Notifications</a></li>
												<li><a class="dropdown-item" href="#">Trips</a></li>
												<li><a class="dropdown-item" href="#">Wishlists</a></li>
												<div class="sub-menu-links">
													<li><a class="dropdown-item" href="#">Host your Home</a></li>
													<li><a class="dropdown-item" href="#">Host an experience</a></li>
													<li><a class="dropdown-item" href="#">Account</a></li>
												</div>
												<div class="sub-menu-links">
													<li><a class="dropdown-item" href="#">Help</a></li>
													<li><a class="dropdown-item" href="#">Log out</a></li>
												</div>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</header>

         <main class="container justify-content-center" style="margin: auto;margin-bottom: 60px;margin-top: 120px;">
               <!-- bread crumbs -->
               <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Account</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Login & security</li>
               </ol>
               </nav>
               <!-- breadcrumbs end -->
               <div class="page-title">
                  <h2>Login & security</h2>
               </div>
               <div class="page-inner">
                  <div class="row align-items-start justify-content-between m-0">
                     <div class="form-wrapper col-md-7 p-0">
                        <div class="sub-title" style="margin: 3rem 0;width: 100%; border-bottom: 1px solid rgb(228, 228, 228); padding-bottom: 9px;">
                           <span style="color: #008489; padding-bottom: 8px; border-bottom: 2px solid #008489">Login</span>
                        </div>
                     <div class="variant">
                           <div class="tab-title">
                              <h4>Login</h4>
                           </div>                     
                           <div class="each-form-content mt-5">
                              <div class="title-button">
                                 <strong>Password</strong>
                                 <button type="button" class="" data-bs-toggle="modal" data-bs-target="#password">Update</button>
                              </div>
                              <div class="value"><span>Last updated 4 hour ago</span></div>
                           </div>
                     </div>
                        <div class="each-form-content mt-4">
                           <div class="tab-title">
                              <h4>Social accounts</h4>
                           </div>
                           <div class="title-button mt-4">
                              <strong>Facebook</strong>
                              <a href="">Connect</a>
                           </div>
                           <div class="value"><span>Not connected</span></div>
                        </div>
                        <div class="each-form-content">
                           <div class="title-button">
                              <strong>Google</strong>
                              <a href="">Connect</a>
                           </div>
                           <div class="value"><span>Not connected</span></div>
                        </div>
                        <div class="variant mt-5 pt-3">
                           <div class="tab-title">
                              <h4>Login</h4>
                           </div>                     
                           <div class="each-form-content mt-4">
                              <div class="title-button">
                                 <div class="left">
                                    <div class="icon">
                                    <svg viewBox="0 0 24 24" role="img" aria-hidden="false" aria-label="Desktop device" focusable="false" style="height:30px;width:30px;display:block;fill:currentColor"><path d="m22.5 2h-21c-.8271484 0-1.5.6728516-1.5 1.5v14c0 .8271484.6728516 1.5 1.5 1.5h8.5v3h-5.5c-.2763672 0-.5.2236328-.5.5s.2236328.5.5.5h15c.2763672 0 .5-.2236328.5-.5s-.2236328-.5-.5-.5h-5.5v-3h8.5c.8271484 0 1.5-.6728516 1.5-1.5v-14c0-.8271484-.6728516-1.5-1.5-1.5zm-21 1h21c.2753906 0 .5.2241211.5.5v11.5h-22v-11.5c0-.2758789.2241211-.5.5-.5zm11.5 19h-2v-3h2zm9.5-4h-21c-.2758789 0-.5-.2246094-.5-.5v-1.5h22v1.5c0 .2753906-.2246094.5-.5.5z"></path></svg>
                                 </div>
                                 <div class="top-text">
                                    <strong>Windows 10.0 Chrome</strong>
                                    <small>CURRENT SESSION</small>
                                    <span class="location">Lagos, Lagos · September 20, 2022 at 18:54</span>
                                 </div>
                                 </div>                              
                                 <a href="" class="variant-link">Log out Device</a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="content-wrapper col-md-4">
                        <div class="content-wrapper-inner">
                           <div class="each-content">
                              <div class="icon-wrapper">
                                 <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true" focusable="false" style="height: 40px; width: 40px; display: block; fill: rgb(255, 180, 0);"><path d="m5 20.5a.5.5 0 0 1 -.5.5h-.5v.5a.5.5 0 0 1 -1 0v-.5h-.5a.5.5 0 0 1 0-1h .5v-.5a.5.5 0 0 1 1 0v .5h.5a.5.5 0 0 1 .5.5zm1.5 1.5a.5.5 0 1 0 .5.5.5.5 0 0 0 -.5-.5zm16-20h-.5v-.5a.5.5 0 0 0 -1 0v .5h-.5a.5.5 0 0 0 0 1h .5v.5a.5.5 0 0 0 1 0v-.5h.5a.5.5 0 0 0 0-1zm-2.58 4.87a13.41 13.41 0 0 1 -6.76-3.2.37.37 0 0 0 -.63.26l.08 16.22a.38.38 0 0 0 .55.32 11.98 11.98 0 0 0 7.07-13.31.37.37 0 0 0 -.31-.3z"></path><path d="m14.39 8.32a1.93 1.93 0 0 0 -3.66 0l-2.42 4.85a3.09 3.09 0 0 0 -.4 1.61 2.36 2.36 0 0 0 2.23 2.23 3.95 3.95 0 0 0 2.42-1.06 3.95 3.95 0 0 0 2.42 1.06 2.36 2.36 0 0 0 2.23-2.23 3.09 3.09 0 0 0 -.4-1.61zm-2.72 4.38c0-.05.01-1.23.89-1.23s.88 1.18.88 1.23a3.25 3.25 0 0 1 -.88 1.83 3.25 3.25 0 0 1 -.89-1.83zm3.31 3.31a2.92 2.92 0 0 1 -1.71-.77 4.3 4.3 0 0 0 1.17-2.54 2.02 2.02 0 0 0 -1.8-2.22l-.08-.01a2.02 2.02 0 0 0 -1.89 2.15l.01.08a4.29 4.29 0 0 0 1.17 2.54 2.92 2.92 0 0 1 -1.71.77 1.36 1.36 0 0 1 -1.23-1.23 2.13 2.13 0 0 1 .29-1.16l2.42-4.85c.33-.65.55-.76.94-.76s.61.11.94.76l2.42 4.85a2.13 2.13 0 0 1 .29 1.16 1.36 1.36 0 0 1 -1.23 1.23zm7.01-10.35a.5.5 0 0 0 -.43-.4 13.03 13.03 0 0 1 -8.68-4.57.52.52 0 0 0 -.77 0 13.03 13.03 0 0 1 -8.68 4.57.5.5 0 0 0 -.43.4c-1.58 8.19 1.55 14.02 9.3 17.31a.5.5 0 0 0 .39 0c7.75-3.29 10.87-9.11 9.3-17.31zm-9.49 16.3c-7.1-3.09-9.91-8.25-8.57-15.76a13.98 13.98 0 0 0 8.57-4.43 13.98 13.98 0 0 0 8.57 4.43c1.33 7.51-1.48 12.67-8.57 15.76z" fill="#484848"></path></svg>
                              </div>
                              <div class="title"><strong>Let's make your account more secure </strong></div>
                              <div class="title"><strong>Your account security: </strong> <span>Low</span></div>
                              <div class="body"><span>We’re always working on ways to increase safety in our community. That’s why we look at every account to make sure it’s as secure as possible.</span>
                              </div>
                                 <!-- Button trigger modal -->
                                 <a style="
                                 color: #fff;
                                 background-color: #008489;
                                 padding: 11px 2rem;
                                 border-radius: 4px;
                                 font-size: 1rem;
                                 font-weight: 600;
                                 letter-spacing: .3px;" data-bs-toggle="modal" href="#improve" role="button">Improve</a>
                        </div>
                        </div>
                     </div>
                  </div>
                     <div class="modal fade" id="improve" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-header border-0">
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <div class="icon-wrapper">
                                    <svg width="74" height="82" viewBox="0 0 74 82" fill="none" size="24"><path d="M5.214 69.03v7.247M1.682 72.654h7.063M65.254 7.435h7.064M68.786 3.812v7.246" stroke="#FFB400" stroke-width="1.5" stroke-linecap="round"></path><path d="M39.328 72.569c-.875.394-1.937-.134-1.937-1.154l-.273-58.787c0-1.184 1.395-1.776 2.21-.94C44.49 16.985 54.69 22.023 63.201 23.27a1.31 1.31 0 0 1 1.092 1.084c3.768 21.907-7.622 40.406-24.965 48.215z" fill="#FFB400"></path><path clip-rule="evenodd" d="M51.86 51.89c0-1.255 0-2.509-1.222-5.017l-8.558-17.56c-1.222-2.508-2.445-3.762-4.89-3.762s-3.667 1.255-4.89 3.763l-8.558 17.559c-1.223 2.508-1.223 3.763-1.223 5.017 0 3.762 3.668 6.27 6.113 6.27 6.113 0 13.448-8.578 13.448-13.795 0-2.509-1.222-6.272-4.89-6.272-3.667 0-4.89 3.763-4.89 6.271 0 5.218 7.335 13.797 13.448 13.797 2.445 0 6.113-2.509 6.113-6.271z" stroke="#484848" stroke-width="2.5"></path><path clip-rule="evenodd" d="M37 2c-7.77 9.662-18.366 15.399-31.786 17.21C-.202 48.077 10.394 68.307 37 79.9c26.606-11.594 37.202-31.824 31.786-60.69C55.366 17.4 44.77 11.663 37 2z" stroke="#484848" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                 </div>
                                 <div class="modal-body-inner">
                                    <h2 style="color: #484848; font-weight: 900; margin: 1.3rem 0;">Let’s make your account more secure</h2>
                                    <div class="title"><strong>Your account security: </strong> <span>Low</span></div>
                                    <div class="context my-4">
                                       <span>We’re always working on ways to increase safety in our community. That’s why we look at every account to make sure it’s as secure as possible.</span>
                                    </div>
                                    <div class="options">
                                       <div class="option">
                                          <div class="modal-div">
                                             <div class="modal-button">
                                                <button type="button" style="font-weight: 600; color:#008489; font-size:1rem;" data-bs-toggle="modal" data-bs-target="#phone-number">Add phone number</button>
                                             </div>
                                             <div class="text"><span class="sub-text">This is the number where you’ll receive security codes so you can always access your account.</span></div>
                                          </div>
                                       </div>
                                       <div class="option">
                                          <div class="modal-div">
                                             <div class="modal-button">
                                                <button style="font-weight: 600; color:#008489; font-size:1rem;" data-bs-target="#email-address" data-bs-toggle="modal">Verify email</button>
                                             </div>
                                             <div class="text"><span class="sub-text">This helps us know that you own this email account.</span></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal fade" id="email-address" aria-hidden="true" aria-labelledby="email-addr" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="email-addr">Modal 2</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="">
                                 <div class="modal-body">
                                    <div class="form-input">
                                       <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                          <option selected>Nigeria</option>
                                          <option value="1">One</option>
                                          <option value="2">Two</option>
                                          <option value="3">Three</option>
                                       </select>
                                    </div>
                                    <div class="form-input">
                                       <input class="form-control form-control-lg" type="text" placeholder="Phone number" aria-label=".form-control-lg example">
                                    </div>
                                 </div>
                                 <div class="modal-footer d-flex justify-content-between">
                                    <button data-bs-target="#improve" data-bs-toggle="modal">Back</button>
                                    <button style="
                                 color: #fff;
                                 background-color: #008489;
                                 padding: 11px 2rem;
                                 border-radius: 4px;
                                 font-size: 1rem;
                                 font-weight: 600;
                                 letter-spacing: .3px;">Submit</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="modal fade" id="phone-number" aria-hidden="true" aria-labelledby="phone-num" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="phone-num">Modal 2</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="">
                                 <div class="modal-body">
                                    <div class="form-input">
                                       <input class="form-control form-control-lg" type="text" placeholder="Phone number" aria-label=".form-control-lg example">
                                    </div>
                                 </div>
                                 <div class="modal-footer d-flex justify-content-between">
                                    <button data-bs-target="#improve" data-bs-toggle="modal">Back</button>
                                    <button style="
                                 color: #fff;
                                 background-color: #008489;
                                 padding: 11px 2rem;
                                 border-radius: 4px;
                                 font-size: 1rem;
                                 font-weight: 600;
                                 letter-spacing: .3px;">Submit</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>

                  <!-- last lap -->
                  <div class="each-form-content last mt-5">
                     <div class="tab-title">
                        <h4>Account</h4>
                     </div>
                     <div class="title-button mt-5">
                        <span>Deactivate your account</span>
                        <a href="" style="color: #D93900; font-size: 1rem;">Deactivate</a>
                     </div>
                  </div>
                  <!-- end of last lap -->
               </div>
         </main>


         <!-- mobile view footer -->
         <footer>
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
         </footer>

         <!-- end of mobile footer view -->
         <footer class="pt-5 mb-0 mt-5 position-static d-none d-md-block" style="background-color: #F7F7F7;border-top: 1px solid #DDDDDD;">
               <div class="container px-3">
                  <div class="row m-0">
                     <div class="col-lg-3">
                           <h5>Support</h5>
                           <ul class="nav row flex-lg-column">
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Newsroom</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Learn about new features</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Letter from our founders</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Careers</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Investors</a></li>
                           </ul>
                     </div>

                     <div class="col-lg-3">
                           <h5>Community</h5>
                           <ul class="nav row flex-lg-column">
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Newsroom</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Learn about new features</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Letter from our founders</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Careers</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Investors</a></li>
                           </ul>
                     </div>

                     <div class="col-lg-3">
                           <h5>Hosting</h5>
                           <ul class="nav row flex-lg-column">
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Newsroom</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Learn about new features</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Letter from our founders</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Careers</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Investors</a></li>
                           </ul>
                     </div>

                     <div class="col-lg-3">
                           <h5>Hosting</h5>
                           <ul class="nav row flex-lg-column">
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Newsroom</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Learn about new features</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Letter from our founders</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Careers</a></li>
                              <li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6 "><a href="#" class="nav-link p-0 text-muted">Investors</a></li>
                           </ul>
                     </div>
                  </div>


               </div>
               <div class="d-flex px-4 justify-content-between py-4 mt-4 border-top">
                  <p>© 2021 Company, Inc. All rights reserved.</p>
                  <ul class="list-unstyled d-flex">
                     <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
                     <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
                     <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
                  </ul>
               </div>
         </footer>




         <!-- modalllllllsssssssss -->

         <!--password Modal -->
            <div class="modal fade" id="password" tabindex="-1" aria-labelledby="password-modal" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                     <div class="modal-header">
                     <h5 class="modal-title" id="password-modal">Change Password</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <form action="" @submit.prevent='changePassword()' method="">
                           <div class="form-input">
                              <label for="prev-password" class="form-label">Current Password</label>
                              <input type="password" v-model= 'currentpassword' class="form-control" id="prev-password">
                           </div>
                           <div class="form-input">
                              <label for="new-password" class="form-label">New Password</label>
                              <input type="password" v-model= 'confirmPassword' class="form-control" id="new-password">
                           </div>
                           <div class="form-input">
                              <label for="repeat-password" class="form-label">Confirm Password</label>
                              <input type="password" v-model= 'password' class="form-control" id="repeat-password">
                           </div>
                           <div class="submit-btn" data-bs-dismiss="password">
                              <button>Update password</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         

         

         </div>
      </div>
      
		<script src="../../assets/js/jquery-3.6.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script src="../../assets/js/jquery-ui.min.js"></script>
		<script src="../../assets/js/custom.js"></script>

      
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script src="https://unpkg.com/vue@3"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="../js/toasteur.min.js"></script>
		<script src="../../vuecode/user.js" ></script>
	</body>
</html>
