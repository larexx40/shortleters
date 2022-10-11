// Utilities or Functions
const urlPath = window.location.pathname.split("/");
const length = urlPath.length;
const page = urlPath[length -1];

// get current Date
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();

if (dd < 10) {
   dd = '0' + dd;
}

if (mm < 10) {
   mm = '0' + mm;
}
    
today = yyyy + '-' + mm + '-' + dd;

// add days to date
function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);

    // get Format 
    let dd = result.getDate();
    let mm = result.getMonth() + 1;
    let yyy = result.getFullYear();

    if (dd < 10) {
        dd = '0' + dd;
     }
     
     if (mm < 10) {
        mm = '0' + mm;
     }
         
     let result_format = yyyy + '-' + mm + '-' + dd;

    return result_format;
}

min_checkout = addDays(today, 1);

// check if a day is available
function dateCheck(from,to,check) {

    var fDate,lDate,cDate;
    fDate = Date.parse(from);
    lDate = Date.parse(to);
    cDate = Date.parse(check);

    if((cDate <= lDate && cDate >= fDate)) {
        return true;
    }
    return false;
}

// check the difference between two dates
const days_difference = (day1, day2) => {
    var day1 = new Date(day1);
    var day2 = new Date(day2);

    var differnce_in_time = day2.getTime() - day1.getTime();
    var days_difference = differnce_in_time / (1000 * 3600 * 24);
    
    return days_difference;
}

let userApp = Vue.createApp({
    data(){
        return{
            // Lanre data
            // carts: [],
            // orders:[],
            // refNo: null,
            // trackid: null,
            // track_id: null,
            // order_status: null,
            // total_weight: null,
            // total_paid: null,
            // cartIndex: '',
            // orderIndex: '',
            // addresses:[],
            // address_details: null,
            // address: null,
            // addressno: null,
            // lga: null,
            // zipcode: null,
            // username: null,
            // firstname: null,
            // lastname: null,
            // fullname: null,
            // phoneno: null,
            // state: null,
            // resetToken: '',
            // userpubkey: '',
            // country: null,
            // // End Lanre Data
            // // Korede Data

            // // End Korede
            // userDetails: null,
            // user_address: null,
            // shipping_address: "",
            // ref_link: null,
            // defaultAddress: null,
            // notifications: null,
            // weight: null,
            // price: null,
            // logistics: null,
            // selectedLogistics: "",
            // locations: null,
            // selectedLocation: "",
            // username: null,
            // total_wallet_balance: null,
            // activities: null,
            // complains: null,
            // each_complain: null,
            // complain: null,
            // currentpassword: null,
            // wallets: null,
            // Shortleters Data

            //lanre data @S
            userDetails: null,
            buildingTypes: null,
            subTypesByBuildingid: null,
            spaceTypes: null,
            all_amenities: null,
            highlights: null,
            //@E lanre data
            // @S korede data
            currentDate: today,
            min_checkout: min_checkout,
            apartments: null,
            apartment_details: null,
            apartment_category: null,
            selected_check_in: null,
            selected_check_out: null,
            bookings: null,
            available: null,
            active: true,
            transactions: null,
            // @E korede data
            password: null,
            confirmpassword: null,
            currentpassword: null,
            authToken: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE2NjU0NTU2MTksImlzcyI6IkxPRyIsIm5iZiI6MTY2NTQ1NTYxOSwiZXhwIjoxNjY1NTI5NDE5LCJ1c2VydG9rZW4iOiJDTkdrTG1zNVF2N3dUdU1zWEhmbmNrYkg4UG1LcnRmc004cjBDazdsdXNlcnN1c2VyIn0.CQYK3IWh2sfaHXOMhFvEF-vAJILnpLYltJDa4BdO7S88e6Z6UO6m3sXpu1bDcPQg2QkVhB4Qrsh6TM3zkmxHpQ',
            confirmPassword: null,
            loading: false,
            search: null,
            sort: null,
            page: null,
            total_page: null,
            currentPage: 1,
            totalData: null,
            totalPage: null,
            per_page: 6,
            error: null,
            baseurl: "http://localhost/shortleters/"
        }
    },
    async created() {
        // this.getToken()

        //check page
        if(page =='property-type-group.php'){
            await this.getAllBuildingType()
        }
        if(page =='property-type.php'){
            let buildingTypeid = (localStorage.getItem("buildingTypeid")) ? localStorage.getItem("buildingTypeid"): null;
            if(!buildingTypeid){
                window.location.href="./property-type-group.php";
            }
            await this.getAllSubBuildingTypeByBuildingTypeid(buildingTypeid,1);
        }
        if(page =='privacy-type.php'){
            await this.getAllSpaceType()
        }
        if(page =='amenities.php'){
            await this.getAllAmenities()
        }
        if(page =='description.php'){
            await this.getAllHighlight()
        }

    },
    methods: {
        //lanre method
        
        async getUserDetails(){
            const url = `${this.baseurl}api/accounts/getdetails.php?`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
           
            
            try {
                this.loading = true
                const response = await axios(options);
                if ( response.data.status ){
                    this.userDetails = response.data.data
                    this.ref_link = `${this.baseurl}register.php?code=${this.userDetails.refcode}`;

                    // if (location === "index.php"){
                    //     this.getUserAddress();
                    //     this.getUserTotalBalance();
                    //     this.getDefaultAddress();
                    //     this.getAllLogistics();
                            
                    // }

                    if (location === "activities.php"){
                        this.getAllActivity();
                    }

                    if (location === "complain.php"){
                        this.getAllComplain();
                    }


                    if (location === "notifications.php"){
                        this.getAllUserNotification();
                    } 
                    
                    if (location === "wallet.php"){
                        await this.getAllTransactions();
                        await this.getAllWallets();
                    }

                    if (location === 'address.php'){
                        await this.getUserAddress();
                    }
                    
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        // window.location.href ="../login.php";
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }else{
                    this.error = error.message || "Error Processing Request"
                    new Toasteur().error(this.error);
                }    
                
            } finally {
                this.loading = false;
            }
        },
        async updateUserInfo() {
            console.log(this.userDetails);
            console.log(this.authToken);

            const data = new FormData();
            data.append('firstname', this.userDetails.Firstname);
            data.append('lastname', this.userDetails.Lastname);
            data.append('phoneno', this.userDetails.phone);
            data.append('dob', this.userDetails.dob);
            data.append('sex', this.userDetails.sex);
            data.append('state', this.userDetails.State);
            data.append('country', this.userDetails.Country);
            
            const url = `${this.baseurl}api/accounts/updateuserinfo.php`;
            const options = {
                method: "POST",
                headers: { 
                    "Authorization": `Bearer ${this.authToken}`
                },
                data,
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
            
                if ( response.data.status ){
                    new Toasteur().success(response.data.text);
                    window.location.reload();
                }          
           } catch (error) {
               if (error.response.status == 400){
                   this.error = error.response.data.text;
                   new Toasteur().error(this.error);
                   return
               }

               if (error.response.status == 401){
                   this.error = "User not Authorized";
                   new Toasteur().error(this.error);
                   return
               }

               if (error.response.status == 405){
                   this.error = error.response.data.text;
                   new Toasteur().error(this.error);
                   return
               }

               if (error.response.status == 500){
                   this.error = error.response.data.text;
                   new Toasteur().error(this.error);
                   return
               }

               this.error = error.message || "Error Processing Request"
               new Toasteur().error(this.error);
               
           } finally {
               this.loading = false;
           }
        },
        
        //change user password
        async changePassword(){
            if (!this.currentpassword || !this.password || !this.confirmPassword){
                new Toasteur().error("Kindly Insert all Fields");
                return;
            }
            if (this.password !== this.confirmPassword){
                new Toasteur().error("Password Does not Match");
                return
            }


            const data = new FormData();
            data.append('currentpassword', this.currentpassword);
            data.append('newpassword', this.password);

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
            }
            
            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/accounts/changepass.php`, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success)
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }
                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }
        },

        //onboarding
        async getAllBuildingType(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseurl}/api/buildingType/getBuildingType.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios(options);
                if(response.data.status){
                    this.buildingTypes = response.data.data.buildingTypes;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                }else{
                    this.buildingTypes = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
                }     
            } catch (error) {
                // //console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        window.location.href="./login.php"
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
                }

                new Toasteur().error(error.message || "Error processing request")

                
            }finally {
                this.loading = false;
            }
        },
        async getAllSubBuildingTypeByBuildingTypeid(id, load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseurl}api/sub_building_type/getSubByBuildingid.php?buildingTypeid=${id}&noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            
            // const url = `${this.baseUrl}api/sub_building_type/getSubByBuildingid.php?buildingTypeid=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    "Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios(options);
                if(response.data.status){
                    this.subTypesByBuildingid = response.data.data;
                    this.buildingSubtypes = response.data.data.buildingSubtypes;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                }else{
                    this.subTypesByBuildingid = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
                }     
            } catch (error) {
                // //console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // window.location.href="/login.php"
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
                }
    
                new Toasteur().error(error.message || "Error processing request")
    
                
            }finally {
                this.loading = false;
            }
        },
        async getAllSpaceType(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseurl}api/spaceType/getSpaceType.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios(options);
                if(response.data.status){
                    this.spaceTypes = response.data.data.spaceTypes;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("APiMonify", response.data.data.monifys);
                }else{
                    this.spaceTypes = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
                }     
            } catch (error) {
                // //console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        window.location.href="./login.php"
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
                }

                new Toasteur().error(error.message || "Error processing request")

                
            }finally {
                this.loading = false;
            }
        },
        async getAllAmenities( load = 1){
            console.log(this.sort);
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
    
            const url = `${this.baseurl}api/amenities/get_all_amenities.php?per_page=${per_page}&page=${page}${search}${sort}`;
            const options = {
                method: "GET",
                headers: { 
                    "Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    this.all_amenities = response.data.data.amenities;
                    this.kor_per_page = response.data.data.per_page;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                }else{
                    this.all_amenities = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
                }
            } catch (error) {
                // //console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // window.location.href="/login.php"
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
                }
    
                new Toasteur().error(error.message || "Error processing request")
    
                
            }finally {
                this.loading = false;
            }
        },
        async getAllHighlight(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseurl}api/highlights/getHighlights.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios(options);
                if(response.data.status){
                    this.highlights = response.data.data.highlights;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                }else{
                    this.highlights = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
                }     
            } catch (error) {
                // //console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        window.location.href="./login.php"
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
                }

                new Toasteur().error(error.message || "Error processing request")

                
            }finally {
                this.loading = false;
            }
        },
        //end of lanre's method
        
        async nextPage(){
            this.currentPage = parseInt(this.currentPage) + 1;
            this.totalData =null;
            this.total_page =null;
            if(page == 'orders.php' || page == 'shipment.php'){
                this.getUserCarts()
            }
            if(page == 'address.php'){
                this.getUserAddress()
            }

        },
        async previousPage(){
            this.currentPage = parseInt(this.currentPage) - 1;
            this.totalData =null;
            this.total_page =null;
            if(page == 'orders.php' || page == 'shipment.php'){
                this.getUserCarts()
            }
            if(page == 'address.php'){
                this.getUserAddress()
            }

        },  
        async sortByOrderStatus(sortStatus){
            this.sort = sortStatus;
            this.currentPage =null;
            this.totalData =null;
            this.total_page =null;
            console.log('SortStatus', sortStatus);
            this.getUserCarts()

        },
        
        async getAddressByid(id){
            console.log("addressid", id);
            const url = `${this.baseurl}api/deliveryAddress/getAddressByid.php?id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.address_details = response.data.data;
                    console.log(response.data.data);
                }
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
                }else{
                    swal(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }

        },
        async addDeliveryAddress(){
            this.addresses= null
            this.currentPage = null
            this.totalData =null
            this.total_page =null

            let inputs = {
                name: this.fullname,
                phone: this.phoneno,
                lga: this.lga,
                state: this.state,
                zipcode: this.zipcode,
                addressno: this.addressno,
                address: this.address,
                country: this.country,
            }
            console.log('inputs', inputs);
            if ( !this.fullname || !this.phoneno || !this.lga || !this.state
                || !this.country || !this.address || !this.addressno || !this.zipcode ){
                this.error = "Insert all Fields";
                new Toasteur().error(this.error);
                return
            }
            //validate phone 

            const data = new FormData();
            data.append('name', this.fullname);
            data.append('phone', this.phoneno);
            data.append('lga', this.lga);
            data.append('state', this.state);
            data.append('country', this.country);
            data.append('address', this.address);
            data.append('addressno', this.addressno);
            data.append('zipcode', this.zipcode);

            const url = `${this.baseurl}api/deliveryAddress/addDeliveryAddress.php`;
            const options = {
                method: "POST",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                data,
                url
            }

            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    swal("Delivery address added")
                    this.getUserAddress();
                    console.log(response.data.text);
                }else{
                    swal(response.data.text)
                }
                
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        swal(errorMsg);
                        return
                    }

                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }

                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
                }else{
                    swal(error.message || "Error processing request");
                } 
            }finally {
                this.loading = false;
            }

        },
        async deleteDeliveryAddress(id){
            console.log("addressid", id);
            const url = `${this.baseurl}api/deliveryAddress/deleteDeliveryAddress.php?id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    swal("Address deleted");
                    this.getUserAddress();
                }else{
                    this.getUserAddress();
                }
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
                }else{
                    swal(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
       
        async updateAddress(){
            if ( !this.address_details.id || !this.address_details.fullname || !this.address_details.phoneno || !this.address_details.lga || !this.address_details.state
                || !this.address_details.country || !this.address_details.address || !this.address_details.addressno || !this.address_details.zipcode ){

                this.error = "Insert all Fields";
                new Toasteur().error(this.error);
                return
            }
            
            const data = new FormData();
            data.append('id', this.address_details.id);
            data.append('name', this.address_details.fullname);
            data.append('phone', this.address_details.phoneno);
            data.append('lga', this.address_details.lga);
            data.append('state', this.address_details.state);
            data.append('country', this.address_details.country);
            data.append('address', this.address_details.address);
            data.append('addressno', this.address_details.addressno);
            data.append('zipcode', this.address_details.zipcode);
            
            const url = `${this.baseurl}api/deliveryAddress/updateDeliveryAddress.php`;
            const options = {
                method: "POST",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                data,
                url
            }

            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    swal("Address updated")
                    this.getUserAddress();
                    console.log("getAddonUpdate", this.addresses);
                    console.log(response.data.text);
                }
                
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        swal(errorMsg);
                        return
                    }

                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }

                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
                }else{
                    swal(error.message || "Error processing request");
                } 
            }finally {
                this.loading = false;
            }

        },
        // Lanre Methods End
        async logout() {
            try {
                this.loading = true;
                // delete token from storage
                localStorage.removeItem("token");
                window.location.href ="../login.php";
                
            } catch (error) {
                this.error = error.message || "Error processing request";
                new Toasteur().error(this.error);
            }finally{
                this.loading = false
            }
        },
        // Korede Shortleters
        changeMinCheckOut(){
            this.min_checkout = addDays(this.selected_check_in, 1) ;
        },
        async getAllBookedDates(load = 1){
            const apart_id = window.localStorage.getItem("apart_id");
            if ( !apart_id ){
                window.location.href="./index.php";
                return;
            }
            const headers = {
                // "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseurl}api/bookings/getApartmentBookedDates.php?apartment_id=${apart_id}`;

            this.total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    this.bookings = response.data.data;
                }else{
                    this.bookings = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async checkAvailability(){
            if ( !this.selected_check_in || !this.selected_check_out ){
                this.error = "Kindly Select a Check in and Check Out date"
                new Toasteur().error(this.error);
                return;
            }

            let no_of_days = days_difference(this.selected_check_in, this.selected_check_out)

            if ( no_of_days < this.apartment_details.min_stay ){
                this.error = `Minimum Night is ${this.apartment_details.min_stay}`
                new Toasteur().error(this.error);
                return;
            }

            if ( no_of_days > this.apartment_details.max_stay ){
                this.error = `Maximum Night is ${this.apartment_details.min_stay}`
                new Toasteur().error(this.error);
                return;
            }

            if ( this.bookings ){
                let availability;
                for( var i=0; i < this.bookings.length; i++ ){
                    availability = dateCheck(this.bookings[i].preferred_check_in, this.bookings[i].preferred_check_in, this.selected_check_in)

                    if ( !availability && ( this.bookings[i].paid_code  > 0 ) ){
                        this.error = `Apartment not available for this period`
                        new Toasteur().error(this.error);
                        return;
                    }
                }

                this.available = true;
            }
        },
        async getAllApartments(load = 1){
            let search = (this.search) ? `&search=${this.search}` : ""; 
            let sort = (this.sort !== null) ? `&sort=1&sortstatus=${this.sort}` : "";
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;

            if (this.sorttype && this.sort){
                 type = `&sorttype=${this.sorttype}`;
            } 
            if ( this.sorttype && !this.sor ){
                type = `&sort=1&sorttype=${this.sorttype}`;
            }
            if (!this.sorttype){
                type = "";
            }
            
            const headers = {
                // "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseurl}api/apartments/user_get_all_apartments.php?page=${page}&per_page=${per_page}`;

            this.total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.apartments = response.data.data.apartments;
                        this.currentPage = response.data.data.page;
                        this.total_page = response.data.data.totalPage;
                        this.per_page = response.data.data.per_page;
                        this.totalData = response.data.data.total_data;   
                    }
                }else{
                    this.apartments = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }
        }, 
        async getApartmentDetails(load = 1){
            const apart_id = window.localStorage.getItem("apart_id");
            if ( !apart_id ){
                window.location.href="./index.php";
                return;
            }
            const headers = {
                // "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseurl}api/apartments/getApartmentsById.php?apartment_id=${apart_id}`;

            this.total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    this.apartment_details = response.data.data.apartment;
                    console.log(this.apartment_details);
                }else{
                    this.apartment_details = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        percentage(rate) {
            rate = parseInt(rate);
            return (100 * rate) / 5;
        }, 
        async getAllCategory(load = 1){
            // let search = (this.search) ? `&search=${this.search}` : ""; 
            // let sort = (this.sort !== null) ? `&sort=1&sortstatus=${this.sort}` : "";
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;

            // if (this.sorttype && this.sort){
            //      type = `&sorttype=${this.sorttype}`;
            // } 
            // if ( this.sorttype && !this.sor ){
            //     type = `&sort=1&sorttype=${this.sorttype}`;
            // }
            // if (!this.sorttype){
            //     type = "";
            // }
            
            const headers = {
                // "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseurl}api/apartments/categories/getAllApartmentCategory.php?page=${page}&per_page=${per_page}`;

            this.total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.apartment_category = response.data.data.apartmentCategories;
                        this.currentPage = response.data.data.page;
                        this.total_page = response.data.data.totalPage;
                        this.per_page = response.data.data.per_page;
                        this.totalData = response.data.data.total_data;   
                    }
                }else{
                    this.apartment_category = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async getApartmentsInaCategory(cat_id){
            if ( page === "index.php" || page === "" ){
                console.log(cat_id);
                await this.getApartmentByCategory(cat_id, 5);
            }else{
                window.localStorage.setItem("cat_id", cat_id);
                window.location.href = "./index.php"
            }
        },
        async getApartmentByCategory( category_id ,load = 1){
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;
            
            const headers = {
                // "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseurl}api/apartments/categories/getAllApartmentByCategoryid.php?category_id=${category_id}&page=${page}&per_page=${per_page}`;

            this.total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.apartments = response.data.data.apartments;
                        this.currentPage = response.data.data.page;
                        this.total_page = response.data.data.totalPage;
                        this.per_page = response.data.data.per_page;
                        this.totalData = response.data.data.total_data;   
                    }
                }else{
                    this.apartments = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async setApartmentId(id){
            window.localStorage.setItem("apart_id", id)
        }, 
        async fetchLocation(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/logistics/getActiveLocationById.php?logistic_id=${this.selectedLogistics}`,  {headers});
                if ( response.data.status ){
                    this.locations = response.data.data.locations;
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                }
                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }


        },
        async calculatePrice(load = 1) {
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            if (this.selectedLocation && this.selectedLogistics && this.weight && this.weight > 0){
                try {
                    if (load == 1){
                        this.loading = true;
                    }
                    if (!this.weight){
                        this.error = "Kindly Enter weight Value";
                        new Toasteur().error(this.error);
                        return;
                    }
                    const url = `${this.baseurl}api/logistics/getShipmentPrice.php?logistic_id=${this.selectedLogistics}&loc_id=${this.selectedLocation}&weight=${this.weight}`;
                    const response = await axios.get(url,  {headers});
                    if ( response.data.status ){
                        this.price = response.data.data.price;
                    }
                } catch (error) {
                    if (error.response){
                        if (error.response.status == 400){
                            this.error = error.response.data.text;
                            new Toasteur().error(this.error);
                            return
                        }
        
                        if (error.response.status == 401){
                            this.error = "User not Authorized";
                            new Toasteur().error(this.error);
                            return
                        }
        
                        if (error.response.status == 405){
                            this.error = error.response.data.text;
                            new Toasteur().error(this.error);
                            return
                        }
        
                        if (error.response.status == 500){
                            this.error = error.response.data.text;
                            new Toasteur().error(this.error);
                            return
                        }
        
                    }
                    this.error = error.message || "Error Processing Request"
                    new Toasteur().error(this.error);
                    
                }finally{
                    this.loading = false;
                }
            }
            
        },
        
       
        async getAllAddress(){

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            
            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/accounts/getAllUserAddress.php`, {headers} );
                if ( response.data.status ){
                    if (response.data.data.length > 0){
                        this.user_address = response.data.data;
                    }  
                }          
            } catch (error) {
                if (error.response.status == 400){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 401){
                    this.error = "User not Authorized";
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 405){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 500){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }

        },
        async setDefaultAddress(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let data = new FormData();
            data.append('id', id);
            

            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/deliveryAddress/setDefaultAddress.php`, data, {headers});

                if (response.data.status) {
                    this.success = response.data.text;
                    new Toasteur().success(this.success)
                }
            } catch (error) {
                if (error.response.status == 400){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 401){
                    this.error = "User not Authorized";
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 405){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 500){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
            } finally {
                this.loading = false
            }
        },
        async deleteAddress(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let data = new FormData();
            data.append('id', id);
            

            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/accounts/deleteAddress.php`, data, {headers});

                if (response.data.status) {
                    this.success = response.data.text;
                    new Toasteur().success(this.success)
                }
            } catch (error) {
                if (error.response.status == 400){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 401){
                    this.error = "User not Authorized";
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 405){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 500){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
            } finally {
                this.loading = false
            }
        },
        async getDefaultAddress(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/accounts/getDefaultAddress.php`, {headers} );
                if ( response.data.status ){
                    this.defaultAddress = response.data.data;
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }else{
                    this.error = error.message || "Error Processing Request"
                    new Toasteur().error(this.error);
                }
    
            } finally {
                this.loading = false;
            }
        },
        async getUserTotalBalance(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }
            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/userwalletaddress/getUserTotalWalletBalance.php`, {headers} );
                if ( response.data.status ){
                    this.total_wallet_balance = response.data.data.totalBalance;
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }else{
                    this.error = error.message || "Error Processing Request"
                    new Toasteur().error(this.error);
                }
    
            } finally {
                this.loading = false;
            }
        },
        async getUserAddress(){
            let search = (this.search)? `&search=${this.search}`: ''; 
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 3;
            const url = `${this.baseurl}api/deliveryAddress/getUserAddress.php?noPerPage=${noPerPage}&page=${page}${search}`;
            console.log('URL', url);
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if(response.data.status){
                    this.addresses=response.data.data.deliveryAddress;
                    this.currentPage =response.data.data.page
                    this.totalData =response.data.data.total_data
                    this.total_page =response.data.data.totalPage                    
                }else{
                    this.addresses= null
                    this.currentPage = null
                    this.totalData =null
                    this.total_page =null;
                }     
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
                }

                swal(error.message || "Error processing request")
            }finally {
                this.loading = false;
            }
        },

        getToken(){
            this.loading= true
            const token = window.localStorage.getItem("token");
            this.authToken = token;
        },
        async getAllUserNotification(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;

            this.total_page = null;
            
            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/notifications/getNotificationByUserId.php?page=${page}&per_page=${per_page}`, {headers} );
                if ( response.data.status ){
                    this.notifications = response.data.data.notification;
                    this.currentPage = response.data.data.page;
                    this.total_page = response.data.data.totalPage;
                    this.per_page = response.data.data.per_page;
                    this.totalData = response.data.data.total_data; 
                }else{
                    this.notifications = null;
                }          
            } catch (error) {
                if (error.response.status == 400){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 401){
                    this.error = "User not Authorized";
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 405){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 500){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async addNotification(text, type, product, order,status){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }
            
            const data = new FormData();
            data.append('notificationtext', text);
            data.append('notificationtype', type);
            data.append('productid', product);
            data.append('orderrefid', order);
            data.append('notificationstatus', status);

            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/notifications/getNotificationByUserId.php`, {headers} );
                if ( response.data.status ){
                    return
                }
            } catch (error) {
                if (error.response.status == 400){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 401){
                    this.error = "User not Authorized";
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 405){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 500){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
            } finally {
                this.loading = false;
            }
        },
        async getAllActivity() {
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;

            this.total_page = null;

            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/accounts/getAllUserActivities.php?per_page=${per_page}&page=${page}`, {headers} );
                if ( response.data.status ){
                    this.activities = response.data.data.totalSession; 
                    this.currentPage = response.data.data.page;
                    this.total_page = response.data.data.totalPage;
                    this.totalData = response.data.data.total_data;
                }   
                console.log(this.total_page);       
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        this.activities = null;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }
                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }

        },
        async makeComplain() {
            if (!this.complain){
                this.error = "Kindly Enter a complain"
                new Toasteur().error(this.error);
            }

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append('complaint', this.complain);

            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/complains/addComplain.php`, data ,{headers} );
                if ( response.data.status ){ 
                    this.success = response.data.text;
                    new Toasteur().success(this.success)
                    this.getAllComplain();
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async getAllComplain() {
            let sort = (this.sort) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseurl}api/complains/getAllUserComplain.php?page=${page}&per_page=${per_page}${sort}`

            this.total_page = null
            try {
                this.loading = true
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.complains = response.data.data.complains;
                        this.currentPage = response.data.data.page;
                        this.total_page = response.data.data.totalPage;
                        this.per_page = response.data.data.per_page;
                        this.totalData = response.data.data.total_data;   
                    }
                }else{
                    this.complains = null
                }          
            } catch (error) {
                if (error.response.status == 400){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 401){
                    this.error = "User not Authorized";
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 405){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                if (error.response.status == 500){
                    this.error = error.response.data.text;
                    new Toasteur().error(this.error);
                    return
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async getComplain(index){
            this.each_complain = this.complains[index];
        },
        async removeSort() {
            this.sort = null;
            this.getAllComplain();
        },
        async setPending() {
            this.sort = 0;
            this.getAllComplain();
        },
        async setActive() {
            this.sort = 1;
            this.getAllComplain();
        },
        async increasePage(){
            // Get window current location
            const path = window.location.pathname.split("/");
            const length = path.length;
            const location = path[length -1];
            // 
            // Increase Current page 
            this.currentPage = parseInt(this.currentPage) + 1;
            this.total_page = null
            this.loading = true;
            this.totalData = null
            if (location === "activities.php"){
                await this.getAllActivity();
            }

            if (location === "complain.php"){
                await this.getAllComplain();
            }
        },
        async decreasePage(){
             // Get window current location
             const path = window.location.pathname.split("/");
             const length = path.length;
             const location = path[length -1];
             // Decrease Current Page
            this.currentPage = parseInt(this.currentPage) - 1;
            this.total_page = null
            this.loading = true;
            this.totalData = null
            if (location === "activities.php"){
                await this.getAllActivity();
            }

            if (location === "complain.php"){
                await this.getAllComplain();
            }
        },
        async getAllTransactions(){
            let search = (this.search) ? `&search=${this.search}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseurl}api/userwallettrans/getTransactionByUserId.php?page=${page}&per_page=${per_page}${search}`;

            this.total_page = null
            try {
                this.loading = true
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.transactions = response.data.data.transactions;
                        this.currentPage = response.data.data.page;
                        this.total_page = response.data.data.totalPage;
                        this.per_page = response.data.data.per_page;
                        this.totalData = response.data.data.total_data;   
                    }
                }else{
                    this.transactions = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async getAllWallets(){ 
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseurl}api/userwalletaddress/getWalletByUserid.php?page=${page}&per_page=${per_page}`;

            this.total_page = null
            try {
                this.loading = true
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.wallets = response.data.data.wallets;
                        this.currentPage = response.data.data.page;
                        this.total_page = response.data.data.totalPage;
                        this.per_page = response.data.data.per_page;
                        this.totalData = response.data.data.total_data;   
                    }
                }else{
                    this.wallets = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        copyText(){
            this.$refs.myinput.focus();
            document.execCommand('copy');
            new Toasteur().success("Link Copied");
            
        }
    },
    async mounted(){
        // this.getToken();
        await this.getUserDetails();
        // this.getDefaultAddress();
        await this.getAllCategory();
        if ( page === "index.php" || page === "" ){
            await this.getAllApartments();
            let cat_id = window.localStorage.getItem("cat_id");
            if ( cat_id ){
                await this.getApartmentByCategory(cat_id, 4);
                window.localStorage.removeItem("cat_id");
            }
        }
        if ( page === "rooms.php" ){
            await this.getApartmentDetails();
            await this.getAllBookedDates();
            console.log(this.bookings);
        }
        
    }
});

userApp.mount("#user");


const validatePhoneNumber = (input) => {
    const regExp = /^[0-9,+]+$/
    const phone = input;
    const validate = phone.match(regExp);
    var number;
    var bool;
    if (validate){
        const test = phone.includes("+234");
        const secondTest = (test) ? phone.includes("+2340") : false;
        
        (test && secondTest) ? number = phone.replace("+2340", "0") : "";
        (test && !secondTest) ? number = phone.replace("+234", "0"): ""  
        
        const thirdTest = (!test && !secondTest)? phone.includes("234") : false;
        const fourthTest = (thirdTest) ? phone.includes("2340") : false;

        (thirdTest && fourthTest) ? number = phone.replace("2340", "0"):  "";
        (thirdTest && !fourthTest) ? number = phone.replace("234", "0"):  "";


       
        if (!number){
            const finalTest = phone.startsWith("0")
            if (finalTest){
                (phone.length < 11 || phone.length > 11) ? number = false : number = phone; 
                return number
            }else{
                bool = false
                return bool
            }
        }else{
            (number.length < 11 || number.length > 11) ? number = false : number = number;
            return number 
        } 

    } else {  
        bool = false
        return bool;
    }
}