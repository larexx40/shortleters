const validatePhoneNumber = (input) => {
    const regExp = /^[0-9,+]+$/
    const phone = String(input);
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

const days_difference = (day1, day2) => {
    var day1 = new Date(day1);
    var day2 = new Date(day2);

    var differnce_in_time = day2.getTime() - day1.getTime();
    var days_difference = differnce_in_time / (1000 * 3600 * 24);
    
    return days_difference;
}

function WordCount(str) {
    return str.split(' ')
           .filter(function(n) { return n != '' })
           .length;
}

const generatePassword = () => {
    var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var passwordLength = 12;
    var password = "";

    for (var i = 0; i <= passwordLength; i++) {
        var randomNumber = Math.floor(Math.random() * chars.length);
        password += chars.substring(randomNumber, randomNumber +1);
    }

    return password;
}

const urlPath = window.location.pathname.split("/");
const length = urlPath.length;
const webPage = urlPath[length -1];

let admin = Vue.createApp({
    data(){
        return{
            //lanre data @S
            class_active_type: null,
            sms: null,
            payment: null,
            buildingTypes: null,
            subTypesByBuildingid: null,
            buildingSubtypes: null,
            buildingType_details: null,
            spaceTypes: null,
            spaceType_details: null,
            highlights: null,
            highlight_detail: null,
            guestSafeties: null,
            guestSafty_details: null,
            scenicViews: null,
            additionalCharges: null,
            cancelationPolicies: null,
            systemSettings: null,
            houseRules: null,
            bookings: null,
            booking: null,
            features: null,
            unfeatures: null,
            transactionType: null,
            iosversion: null,
            androidversion: null,
            webversion: null,
            activesmssystem: null,
            activemailsystem: null,
            min_apart_photo: null,
            max_apart_highlights: null,
            discount_perc: null,
            discount_guest: null,
            readMoreUrl: null,
            itemid: null,
            name: null,
            image: null,
            icon: null,
            description: null,
            itemDetails: null,
            adminName: null,
            adminEmail: null,
            //lanre data @E 
            length: null,
            superAdmin: null,
            blog_details: null,
            arrayIndex: null,
            addresses: null,
            minsToRead: null,
            blogContent: null,
            blogHeadline: null,
            apiName: null,
            secretKey: null,
            apiKey: null,
            apiWallet: null,
            apiMerchant: null,
            apiAccno: null,
            apiUsername: null,
            apiPassword: null,
            sendFrom: null,
            emailFrom: null,
            sendType: null,
            apiToken: null,
            routing: null,
            smsChannel: null,
            smsType: null,
            monifys: null,
            monify_details: null,
            kudis: null,
            kudi_details: null,
            payStacks: null,
            payStack_details: null,
            sendGrids: null,
            sendGrid_details: null,
            termiApis: null,
            termiApi_details: null,
            smartSolutions: null,
            smartSolution_details: null,
            getAdmin_details:null,
            admin_details: null,
            admin_initials: null,
            currentPage: null,
            totalData: null,
            totalPage: null,
            sort: null,
            search: null,
            per_page: null,
            blogs: null,
            blogCount: null,
            admins:null,
            baseUrl:'http://localhost/shortleters/',
            authToken: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE2NjM3NjEwNzUsImlzcyI6IkxPRyIsIm5iZiI6MTY2Mzc2MTA3NSwiZXhwIjoxNjYzODM0ODc1LCJ1c2VydG9rZW4iOiJDTkdVYWRtaW4ifQ.Z5GhV715cQoluQJUZTsq1uzKnc5Wi6bxK5ovkKJz7oZYMjCKo9Wnr5kjWEusx0-b9itu_UjMWAPivbX2DMpKhg',
            email: null,
            ref_link: null,
            admin_details: null,
            logistics_initials: null,
            currentPassword: null,
            newPassword: null,
            newPassword1: null,
            username: null,
            firstname: null,
            lastname: null,
            fullname: null,
            phoneno: null,
            state: null,
            price: null,
            longitude: null,
            latitude: null,
            loading: false,
            success: null,
            error: null,
            // korede data
            class_active: false,
            kor_page: 1,
            kor_total_page: null,
            kor_total_data: null,
            kor_per_page: 8,
            kor_sort: null,
            kor_search: null,
            complains: null,
            complain: null,
            kor_file: null,
            all_amenities: null,
            amenities_name: null,
            amenities_icon: null,
            all_sub_amenities : null,
            sub_amenity: null,
            amenity_id: null,
            amenity_name: null,
            amenity_icon: null,
            all_host_type: null,
            hosts: null,
            host_type_name: null,
            all_sub_building_types: null,
            sub_building_type: null,
            building_type_id: null,
            sub_building_type_name: null,
            sub_building_type_description: null,
            amenity: null,
            all_facilities: null,
            facility: null,
            facilty_name: null,
            facility_description: null,
            all_apart_charges: null,
            all_apartments: null,
            apartment_charges: null,
            apartment_details: null,
            apartment_facilities: null,
            apartment_images: null,
            apartment_img: null,
            apartment: null,
            apartments_and_images: null,
            apartment_transactions: null,
            agent_apartments: null,
            agent_bookings: null,
            agent_transactions: null,
            apartment_rules: null,
            // currency
            all_currencies: null,
            currency: null,
            currency_name: null,
            currency_symbol: null,
            // bookings
            apartment_details: null,
            first_name: null,
            last_name: null,
            gender: null,
            gender_options: ["Male", "Female"],
            transactions: null,
            transaction: null,
            phone: null,
            email: null,
            apartment_booked: null,
            apartment_price: null,
            address: null,
            occupation_or_work: null,
            preferred_check_in: null,
            prefferred_check_out: null,
            total_payment: null,
            no_of_people: null,
            min_people: null,
            max_people: null,
            payment_status: null,
            identification_type: null,
            identification_img: null,
            customer_note: "",
            booking_details: null,
            user_booking: null,
            users: null,
            user: null,
            user_details: null,
            user_orders: null,
            user_order: null,
            user_notifications: null,
            user_notification: null,
            user_complains: null,
            user_complain: null,
            user_activities: null,
            user_activity: null,
            user_addresses: null,
            user_address: null,
            user_transactions: null,
            user_transaction: null,
            all_transactions: null,
            transaction: null,
            
        }
    },
    async created() {
        // this.getToken();

        if(webPage == 'admin-details.php'){
            let adminid = (localStorage.getItem("adminid")) ? localStorage.getItem("adminid"): null;
            if(adminid){
                await this.getAdminByid(adminid)
            }else{
                window.location.href = 'admins.php'
            }
            
        }
        if(webPage =='monify.php'){
            await this.getAllMonify()
        }
        if(webPage =='paystack.php'){
            await this.getAllPaystack()
        }
        if(webPage =='kudi.php' ){
            await this.getAllKudi();
        }
        if(webPage =='smartsolution.php'){
            await this.getAllSmartSolution();
        }
        if(webPage =='sendgrid.php'){
            await this.getAllSendGrid()
        }
        if(webPage == 'termiapi.php'){
            await this.getTermiApi();
        }
        if(webPage == 'addresses.php'){
            await this.getAllAddresses();
        }
        if(webPage == 'buildingType.php'){
            await this.getAllBuildingType();
        }
        if(webPage == 'guestSafety.php'){
            await this.getAllGuestSafety();
        }
        if(webPage == 'spaceType.php'){
            await this.getAllSpaceType();
        }
        if(webPage == 'highlights.php'){
            await this.getAllHighlight();
        }
        if(webPage == 'scenic_view.php'){
            await this.getAllScenicView();
        }
        if(webPage == 'additional_charges.php'){
            await this.getAllAdditionalCharge();
        }
        if(webPage == 'cancelation_policy.php'){
            await this.getAllCancelationPolicy();
        }
        if(webPage == 'subBuilding_by_buildingTypeid.php'){
            let buildingTypeid = (localStorage.getItem("buildingTypeid")) ? localStorage.getItem("buildingTypeid"): null;
            if(!buildingTypeid){
                window.location.href="./buildingType.php";
            }
            await this.getAllSubBuildingTypeByBuildingTypeid(buildingTypeid,1);
        }
        if(webPage == 'system_settings.php'){
            await this.getSystemSettings();
        }
        if(webPage == 'house_rule.php'){
            await this.getAllHouseRules();
        }
        if (webPage === "index.php"){
            await this.getAllBookings();
            await this.getAllApartments(3,3);
            await this.getLatestUsers();
        }
        if(webPage == 'bookings.php'){
            await this.getAllBookings();
        }
        if(webPage == 'invoice-details.php'){
            let bookingid = (localStorage.getItem("bookingid")) ? localStorage.getItem("bookingid"): null;
            if(!bookingid){
                window.location.href="./bookings.php";
            }
            await this.getBookingByid(bookingid);
        }
        if(webPage == 'receipt.php'){
            let bookingid = (localStorage.getItem("bookingid")) ? localStorage.getItem("bookingid"): null;
            if(!bookingid){
                window.location.href="./bookings.php";
            }
            await this.getBookingByid(bookingid);
        }
        if(webPage == 'admins.php'){
            await this.getAllAdmin()
        }
        if(webPage == 'features.php'){
            await this.getAllFeature()
            await this.getAllUnfeatureApartment();
        }
    },
    methods: {
        async changeGender(){
            console.log("here");
            console.log(this.gender);
        },
        //LanreWaju Method
        //buildingtype
        async getAllBuildingType(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}/api/buildingType/getBuildingType.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                        // // window.location.href="./login.php"
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
        
        async getBuildingTypeByid(id){
            //console.log("monifyid", id);
            const url = `${this.baseUrl}api/buildingType/getBuildingTypeByid.php?`;
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
                    this.buildingType_details= response.data.data;
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addBuildingType(){
            console.log('name', this.name);
            console.log('uploadImage', this.uploadImage);
            if(this.name == null || this.uploadImage== null ){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('name', this.name );
            data.append('image', this.uploadImage );

            const url = `${this.baseUrl}/api/buildingType/addBuildingType.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    this.name = null;
                    this.uploadImage= null;
                    await this.getAllBuildingType();
                    new Toasteur().success(response.data.text);
                    
                }
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally {
                this.loading = false;
            }

        },
        async deleteBuildingType(id){
            const url = `${this.baseUrl}/api/buildingType/deleteBuildingType.php?`;
            if(id == null ){
                new Toasteur().error("Undefined")
            }

            let data = new FormData();
            data.append('buildingTypeid', id );
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
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    this.getAllBuildingType();
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
                       // // window.location.href="./login.php"
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
        async changeBuildingTypeStatus(id, status){
            console.log("id", id);
            console.log("status", status);
            const url = `${this.baseUrl}/api/buildingType/changeBuildingTypeStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('buildingTypeid', id);
                data.append('status', status);
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllBuildingType();      
                    }else{
                        this.getAllBuildingType();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateBuildingType(){
            if(this.itemDetails.buildingTypeid == null || this.itemDetails.name== null || this.uploadImage == null ){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('buildingTypeid', this.itemDetails.buildingTypeid );
                data.append('image', this.uploadImage);
                data.append('name', this.itemDetails.name );

                const url = `${this.baseUrl}/api/buildingType/updateBuilding.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        this.itemDetails = null;
                        this.uploadImage = null;
                        await this.getAllBuildingType();
                        new Toasteur().success(response.data.text);
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

        },
        //Space type
        async getAllSpaceType(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/spaceType/getSpaceType.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                        // // window.location.href="./login.php"
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
        async getSpaceTypeByid(id){
            //console.log("monifyid", id);
            const url = `${this.baseUrl}api/spaceType/getSpaceType.iByid.php?spaceTypeid=${id}`;
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
                    this.spaceType_details= response.data.data;
                    //console.log(response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addSpaceType(){
            if(this.name == null ){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('name', this.name );

            const url = `${this.baseUrl}api/spaceType/addSpaceType.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllSpaceType();
                    new Toasteur().success(response.data.text);
                    
                }
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally {
                this.loading = false;
            }

        },
        async deleteSpaceType(id){
            const url = `${this.baseUrl}api/spaceType/deleteSpaceType.php`;
            if(id == null ){
                new Toasteur().error("Undefine")
            }

            let data = new FormData();
            data.append('spaceTypeid', id );
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
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    this.getAllSpaceType();
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
                       // // window.location.href="./login.php"
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
        async changeSpaceTypeStatus(id, status){
            const url = `${this.baseUrl}api/spaceType/changeSpaceTypeStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('spaceTypeid', id);
                data.append('status', status);
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllSpaceType();      
                    }else{
                        this.getAllSpaceType();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateSpaceType(){
            if(this.itemDetails.name == null || this.itemDetails.spaceTypeid == null ){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('spaceTypeid', this.itemDetails.spaceTypeid );
                data.append('name', this.itemDetails.name );


                const url = `${this.baseUrl}api/spaceType/updateSpaceType.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getAllSpaceType();
                        new Toasteur().success(response.data.text);
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

        },
        //Highlights
        async getAllHighlight(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/highlights/getHighlights.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                        // // window.location.href="./login.php"
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
        async getHighlightByid(id){
            //console.log("monifyid", id);
            const url = `${this.baseUrl}api/highlights/getHighlightByid.php?highlightid=${id}`;
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
                    this.highlight_detail= response.data.data;
                    //console.log(response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addHighlight(){
            if(this.name == null || this.icon== null ){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('name', this.name );
            data.append('icon', this.icon );

            const url = `${this.baseUrl}api/highlights/addHighlights.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllHighlight();
                    Swal.fire(response.data.text);
                    
                }
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally {
                this.loading = false;
            }

        },
        async deleteHighlight(id){
            console.log("id", id);
            const url = `${this.baseUrl}api/highlights/deleteHighlight.php?`;
            if(id == null ){
                new Toasteur().error("Kindly fill all fields")
            }
            let data = new FormData();
            data.append('highlightid', id );

            //highlightid
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
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    this.getAllHighlight();
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
                       // // window.location.href="./login.php"
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
        async changeHighlightStatus(id,status){
            const url = `${this.baseUrl}api/highlights/changeHighlightStatus.php`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('status', status);
                data.append('highlightid', id);
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllHighlight();      
                    }else{
                        this.getAllHighlight();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateHighlight(){
            if(this.itemDetails.name == null || this.itemDetails.highlightid == null || this.itemDetails.icon == null){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('highlightid', this.itemDetails.highlightid );
                data.append('name', this.itemDetails.name );
                data.append('icon', this.itemDetails.icon );


                const url = `${this.baseUrl}api/highlights/updateHighlight.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        new Toasteur().success(response.data.text);
                        await this.getAllHighlight();
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

        },
        //guest safety
        async getAllGuestSafety(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/guestSafety/getGuestSafety.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                    this.guestSafeties = response.data.data.guestSafeties;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                }else{
                    this.guestSafeties = null;
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
                        // // window.location.href="./login.php"
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
        async getGuestSafetyByid(id){
            //console.log("monifyid", id);
            const url = `${this.baseUrl}api/guestSafety/getGuestSafetyByid.php?guestSafetyid=${id}`;
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
                    this.guestSafty_details= response.data.data;
                    //console.log(response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addGuestSafety(){
            if(this.name == null || this.description== null || this.icon== null) {
                new Toasteur().error("Kindly fill all fields")
            }else{
                let data = new FormData();
                data.append('description', this.description );
                data.append('name', this.name );
                data.append('icon', this.icon );

                const url = `${this.baseUrl}api/guestSafety/addGuestSafety.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getAllGuestSafety();
                        new Toasteur().success(response.data.text);
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

            

        },
        async deleteGuestSafety(id){
            const url = `${this.baseUrl}api/guestSafety/deleteGuestSafety.php?`;
            if(id == null ){
                new Toasteur().error("Undefined")
            }else{
                let data = new FormData();
                data.append('guestSafetyid', id );
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
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.getAllGuestSafety();
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
                        // // window.location.href="./login.php"
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
            }
        },
        async changeGuestSafetyStatus(id, status){
            const url = `${this.baseUrl}api/guestSafety/changeGuestSafetyStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('guestSafetyid', id);
                data.append('status', status);
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllGuestSafety();      
                    }else{
                        this.getAllGuestSafety();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateGuestSafety(){
            if(this.itemDetails.name == null || this.itemDetails.description== null || this.itemDetails.icon== null){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('guestSafetyid', this.itemDetails.guestSafetyid );
                data.append('description', this.itemDetails.description );
                data.append('name', this.itemDetails.name );
                data.append('icon', this.itemDetails.icon );


                const url = `${this.baseUrl}api/guestSafety/updateGuestSafety.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        new Toasteur().success(response.data.text);
                        await this.getAllGuestSafety();
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

        },

        //Scenic view
        async getAllScenicView(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/scenicView/getScenicView.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                    this.scenicViews = response.data.data.scenicView;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                }else{
                    this.scenicViews = null;
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
                        // // window.location.href="./login.php"
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
        async getScenicViewByid(id){
            //console.log("monifyid", id);
            const url = `${this.baseUrl}api/guestSafety/getGuestSafetyByid.php?guestSafetyid=${id}`;
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
                    this.scienicView_details= response.data.data;
                    //console.log(response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addScenicView(){
            if(this.name == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('name', this.name );

            const url = `${this.baseUrl}api/scenicView/addScenicView.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllScenicView();
                    new Toasteur().success(response.data.text);
                    
                }
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally {
                this.loading = false;
            }

        },
        async deleteScenicView(id){
            const url = `${this.baseUrl}api/scenicView/deleteScenicView.php?`;
            if(id == null ){
                new Toasteur().error("Undefined")
            }

            let data = new FormData();
            data.append('scenicViewid', id );
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
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    this.getAllScenicView();
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
                       // // window.location.href="./login.php"
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
        async changeScenicViewStatus(id, status){
            const url = `${this.baseUrl}api/scenicView/changescenicViewStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('scenicViewid', id);
                data.append('status', status);
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllScenicView();      
                    }else{
                        this.getAllScenicView();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateScenicView(){
            if(this.itemDetails.name == null){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('scenicViewid', this.itemDetails.scenicViewid );
                data.append('name', this.itemDetails.name );

                const url = `${this.baseUrl}api/scenicView/updateScenicView.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        new Toasteur().success(response.data.text);
                        await this.getAllGuestSafety();
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

        },

        //additional charges
        async getAllAdditionalCharge(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/additionalCharge/getAdditionalCharge.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                    this.additionalCharges = response.data.data.additionalCharges;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                }else{
                    this.additionalCharges = null;
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
                        // // window.location.href="./login.php"
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
        async getAdditionalChargeByid(id){
            //console.log("monifyid", id);
            const url = `${this.baseUrl}api/additionalCharge/getAdditionalChargeByid.php?guestSafetyid=${id}`;
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
                    this.additionalCharges_details= response.data.data;
                    //console.log(response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addAdditionalCharge(){
            if(this.name == null || this.description == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('name', this.name );
            data.append('description', this.description );

            const url = `${this.baseUrl}api/additionalCharge/addAdditionalCharge.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllAdditionalCharge();
                    new Toasteur().success(response.data.text);
                    
                }
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally {
                this.loading = false;
            }

        },
        async deleteAdditionalCharge(id){
            const url = `${this.baseUrl}api/additionalCharge/deleteAdditionalCharge.php?`;
            if(id == null ){
                new Toasteur().error("Undefined")
            }

            let data = new FormData();
            data.append('additionalChargeid', id );
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
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    this.getAllAdditionalCharge();
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
                       // // window.location.href="./login.php"
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
        async changeAdditionalChargeStatus(id, status){
            const url = `${this.baseUrl}api/additionalCharge/changeAdditionalChargeStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('additionalChargeid', id);
                data.append('status', status);
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllAdditionalCharge();      
                    }else{
                        this.getAllAdditionalCharge();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateAdditionalCharge(){
            if(this.itemDetails.name == null || this.itemDetails.description == null){
                console.log("details not null");
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('additionalChargeid', this.itemDetails.additionalChargeid );
                data.append('name', this.itemDetails.name );
                data.append('description', this.itemDetails.description );

                const url = `${this.baseUrl}api/additionalCharge/updateAdditionalCharges.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        new Toasteur().success(response.data.text);
                        await this.getAllAdditionalCharge();
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

        },
        
        //cancelation policy
        async getAllCancelationPolicy(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/cancelationPolicy/getAllCancelationPolicy.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                    this.cancelationPolicies = response.data.data.cancelationPolicies;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                }else{
                    this.cancelationPolicies = null;
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
                        // // window.location.href="./login.php"
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
        async addCancelationPolicy(){
            if(this.name == null || this.description == null || this.readMoreUrl == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('name', this.name );
            data.append('readMoreUrl', this.readMoreUrl );
            data.append('description', this.description );

            const url = `${this.baseUrl}api/cancelationPolicy/addCancelationPolicy.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllCancelationPolicy();
                    new Toasteur().success(response.data.text);
                    
                }
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally {
                this.loading = false;
            }

        },
        async deleteCancelationPolicy(id){
            const url = `${this.baseUrl}api/cancelationPolicy/deleteCancelationPolicy.php?`;
            if(id == null ){
                new Toasteur().error("Undefined")
            }

            let data = new FormData();
            data.append('policyid', id );
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
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    this.getAllCancelationPolicy();
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
                       // // window.location.href="./login.php"
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
        async changeCancelationPolicyStatus(id, status){
            const url = `${this.baseUrl}api/cancelationPolicy/changeCancelationPolicyStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('policyid', id);
                data.append('status', status);
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllCancelationPolicy();      
                    }else{
                        this.getAllCancelationPolicy();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateCancelationPolicy(){
            if(this.itemDetails.name == null || this.itemDetails.description == null || this.itemDetails.readMoreUrl ==null){
                console.log("details not null");
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('policyid', this.itemDetails.policyid );
                data.append('name', this.itemDetails.name );
                data.append('readMoreUrl', this.itemDetails.readMoreUrl );
                data.append('description', this.itemDetails.description );

                const url = `${this.baseUrl}api/cancelationPolicy/updateCancelationPolicy.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        new Toasteur().success(response.data.text);
                        await this.getAllCancelationPolicy();
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

        },
        //system settings
        async getSystemSettings(load=1){
            const url = `${this.baseUrl}api/systemSettings/getSystemSettings.php?`;
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
                    this.systemSettings = response.data.data;
                }else{
                    this.systemSettings = null;
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
                        // // window.location.href="./login.php"
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
       
        async updateSystemSettings(){
            console.log(this.systemSettings);
            if(this.systemSettings.name == null||this.systemSettings.iosversion == null||this.systemSettings.androidversion == null||this.systemSettings.webversion == null||
                this.systemSettings.activeSmsCode == null||this.systemSettings.activeEmailCode == null|| this.systemSettings.activePaymentCode == null || 
                this.systemSettings.minApartmentPhotos == null||this.systemSettings.maxApartmentHighlights == null||
                this.systemSettings.chargePercentage == null || this.systemSettings.discountPercentage == null||this.systemSettings.discount_guest == null){
                new Toasteur().error("Kindly fill all fields")
            }else{
                if(isNaN(this.systemSettings.minApartmentPhotos)){
                    new Toasteur().error("pass in valid minimun photo")  
                }
                if(isNaN(this.systemSettings.maxApartmentHighlights)){
                    new Toasteur().error("pass in valid maximum Highlighs")  
                }
                let data = new FormData();
                data.append('systemSettingsid', this.systemSettings.systemSettingsid );
                data.append('name', this.systemSettings.name );
                data.append('iosversion', this.systemSettings.iosversion );
                data.append('androidversion', this.systemSettings.androidversion );
                data.append('webversion', this.systemSettings.webversion );
                data.append('activesmssystem', this.systemSettings.activeSmsCode );
                data.append('activemailsystem', this.systemSettings.activeEmailCode );
                data.append('activepaymentsystem', this.systemSettings.activePaymentCode );
                data.append('min_apart_photo', this.systemSettings.minApartmentPhotos );
                data.append('max_apart_highlights', this.systemSettings.maxApartmentHighlights );
                data.append('charge_perc', this.systemSettings.chargePercentage );
                data.append('discount_perc', this.systemSettings.discountPercentage );
                data.append('discount_guest', this.systemSettings.discount_guest );

                const url = `${this.baseUrl}api/systemSettings/updateSystemSettings.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        new Toasteur().success(response.data.text);
                        window.location.href='system_settings.php'
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

        },

        async getAllAddresses(){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/deliveryAddress/getAllAddress.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
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
                    this.addresses = response.data.data.deliveryAddress;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                }else{
                    this.addresses = null;
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

        //subBuilding by building type
        async getAllSubBuildingTypeByBuildingTypeid(id, load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/sub_building_type/getSubByBuildingid.php?buildingTypeid=${id}&noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            
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
        async addSubTypeByBuildingid(){
            if (!this.subTypesByBuildingid.buildingTypeid || !this.sub_building_type_name || !this.sub_building_type_description){
                this.error = "Insert all Fields"
                new Toasteur().error(this.error);
                return;
            }else{
                const data = new FormData();
                data.append("building_type_id", this.subTypesByBuildingid.buildingTypeid);
                data.append("name", this.sub_building_type_name);
                data.append("description", this.sub_building_type_description);
                
                const url = `${this.baseUrl}api/sub_building_type/add_sub_building_type.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.sub_building_type_name = null;
                        this.sub_building_type_description = null;
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        const buildingid = this.subTypesByBuildingid.buildingTypeid;
                        await this.getAllSubBuildingTypeByBuildingTypeid(buildingid, 1);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
            }
            
        },
        async deleteSubTypeByBuildingid(id){
            const url = `${this.baseUrl}api/sub_building_type/delete_sub_building.php?`;
            if(id == null ){
                new Toasteur().error("Undefined")
            }

            let data = new FormData();
            data.append("sub_type_id", id);
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
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    const buildingid = this.subTypesByBuildingid.buildingTypeid;
                    await this.getAllSubBuildingTypeByBuildingTypeid(buildingid, 1);
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
                       // // window.location.href="./login.php"
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
        async changeSubTypeByBuildingidStatus(id, status){
            const url = `${this.baseUrl}api/sub_building_type/change_status.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('sub_type_id', id);
                data.append('status', status);
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        const buildingid = this.subTypesByBuildingid.buildingTypeid;
                        await this.getAllSubBuildingTypeByBuildingTypeid(buildingid, 1);      
                    }else{
                        const buildingid = this.subTypesByBuildingid.buildingTypeid;
                        await this.getAllSubBuildingTypeByBuildingTypeid(buildingid, 1);
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateSubTypeByBuildingid(){
            if(this.itemDetails.name == null || this.itemDetails.description == null){
                console.log("details not null");
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('sub_type_id', this.itemDetails.sub_type_id );
                data.append('name', this.itemDetails.name );
                data.append('building_type_id', this.subTypesByBuildingid.buildingTypeid );
                data.append('description', this.itemDetails.description );

                const url = `${this.baseUrl}api/sub_building_type/update_sub_building_type.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        new Toasteur().success(response.data.text);
                        const buildingid = this.subTypesByBuildingid.buildingTypeid;
                        await this.getAllSubBuildingTypeByBuildingTypeid(buildingid, 1); 
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

        },
        //house rule
        async getAllHouseRules(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/houseRule/getAllHouseRule.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                    this.houseRules = response.data.data.houseRules;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                }else{
                    this.houseRules = null;
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
                        // // window.location.href="./login.php"
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
        async addHouseRule(){
            if(this.name == null || this.description == null || this.readMoreUrl == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('name', this.name );
            data.append('readMoreUrl', this.readMoreUrl );
            data.append('description', this.description );

            const url = `${this.baseUrl}api/houseRule/addHouseRUle.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllHouseRules();
                    new Toasteur().success(response.data.text);
                    
                }
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally {
                this.loading = false;
            }

        },
        async deleteHouseRule(id){
            const url = `${this.baseUrl}api/houseRule/deleteHouseRule.php?`;
            if(id == null ){
                new Toasteur().error("Undefined")
            }

            let data = new FormData();
            data.append('house_rule_id', id );
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
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    this.getAllHouseRules();
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
                       // // window.location.href="./login.php"
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
        async changeHouseRuleStatus(id, status){
            const url = `${this.baseUrl}api/houseRule/changeHouseRuleStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('house_rule_id', id);
                data.append('status', status);
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllHouseRules();      
                    }else{
                        this.getAllHouseRules();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateHouseRule(){
            if(this.itemDetails.name == null || this.itemDetails.description == null || this.itemDetails.readMoreUrl ==null){
                console.log("details not null");
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('house_rule_id', this.itemDetails.houseRuleid );
                data.append('name', this.itemDetails.name );
                data.append('readMoreUrl', this.itemDetails.readMoreUrl );
                data.append('description', this.itemDetails.description );

                const url = `${this.baseUrl}api/cancelationPolicy/updateCancelationPolicy.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        new Toasteur().success(response.data.text);
                        await this.getAllHouseRules();
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

        },
        //booking methods
        async getAllBookings(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/bookings/getAllBookings.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                    this.bookings = response.data.data.bookings;
                    
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                }else{
                    this.bookings = null;
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
                        // // window.location.href="./login.php"
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

        async getBookingByid(id){
            
            const url = `${this.baseUrl}api/bookings/getBookingByid.php?booking_id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    this.booking = response.data.data;
                    let day1= new Date(this.booking.preferred_check_in);
                    let day2= new Date(this.booking.prefferred_check_out)
                    var timeDifference = day2.getTime() - day1.getTime();
                    var noOfDays = timeDifference / (1000 * 3600 * 24);
                    noOfDays = (noOfDays) ? noOfDays : 1;
                    this.booking.noOfDays = noOfDays;
                    
                }else{
                    this.booking = null;
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
                        // // window.location.href="./login.php"
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
        
        async getBookingByUserid(id){

            let user_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";

            if ( user_id === ""){
                window.location.href = "./customers.php"
                return
            }
            
            const url = `${this.baseUrl}api/bookings/getBookingByid.php?booking_id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    this.user_booking = response.data.data;
                    
                }else{
                    this.user_booking = null;
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
                        // // window.location.href="./login.php"
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
        
        async changePaymentStatus(id, status){
            const url = `${this.baseUrl}api/bookings/change_payment_status.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('booking_id', id);
                data.append('status', status);
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllBookings();      
                    }else{
                        this.getAllBookings();
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
                            // // window.location.href="./login.php"
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

            }
            
        },

        async updateHouseRule(){
            if(this.itemDetails.name == null || this.itemDetails.description == null || this.itemDetails.readMoreUrl ==null){
                console.log("details not null");
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('house_rule_id', this.itemDetails.houseRuleid );
                data.append('name', this.itemDetails.name );
                data.append('readMoreUrl', this.itemDetails.readMoreUrl );
                data.append('description', this.itemDetails.description );

                const url = `${this.baseUrl}api/cancelationPolicy/updateCancelationPolicy.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        new Toasteur().success(response.data.text);
                        await this.getAllHouseRules();
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

        },
        //admin
        async adminLogin(){
            const email = this.email;
            const password = this.password
            if(email == null || password == null){
                this.error = "Kindly Enter all Fields"
                new Toasteur().error(this.error);;
            }

            let data = new FormData();
            data.append('email', this.email);
            data.append('password', this.password);

            const url = `${this.baseUrl}/api/admin/adminLogin`;

            const options = {
                method: "POST",
                data: data,
                url
            }


            try {
                const response = await axios(options);
                Swal.fire(response.data.text);
                if(response.data.status){
                    this.adminid = response.data.data.id;
                    this.name = response.data.data.name;
                    this.username = response.data.data.username;
                    this.email = response.data.data.email;
                    this.authToken = response.data.data.authToken;
                    this.superAdmin = response.data.data.superAdmin;
                    this.status = response.data.data.status;

                    window.localStorage.setItem("authToken", response.data.data.authToken);
                    //redirect to index
                    window.location.href = "../index.html"
                }
                //console.log(response.data);

            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // // window.location.href="./login.php"
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
        },
        async addAdmin(){
            if(this.email == null || this.username == null || this.name == null ||this.password == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('email', this.email );
            data.append('username', this.username );
            data.append('password', this.password );
            data.append('name', this.name );

            const url = `${this.baseUrl}api/admin/addAdmin.php`;

            const options = {
                method: "POST",
                data: data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.data.status){
                    Swal.fire(response.data.text);
                }
            }catch (error) {
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
                        // // window.location.href="./login.php"
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
        async getAdminDetails(){
            const url = `${this.baseUrl}api/admin/getAdminDetails.php`;
            const options = {
                method: "GET",
                headers: { 
                    "Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }

            try {
                this.admin_details = null;
                this.loading = true;
                let response = await axios(options)
                if ( response.data.status ){
                    this.admin_details = response.data.data;
                    this.superAdmin = response.data.data.superadmin;
                    const strings = this.admin_details.name.split(" ");
                    const initials = `${strings[0].charAt(0)} ${strings[1].charAt(0)}`;
                    this.admin_initials = initials.toUpperCase();
                }
                
            } catch (error) {
                if (error.response){
                    if (error.response.status === 400){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 401){
                        this.error = error.response.data.error.text
                        // new Toasteur().error(this.error);
                        // window.location.href = "./login.php"
                    }
                    if (error.response.status === 405){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 500){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                }else{
                    this.error = error.message || "Error processing request"
                    new Toasteur().error(this.error);;
                    //console.log("error", this.error);
                }
            }finally {
                this.loading = false;
            }
        },
        async deleteAdmin(id){
            let data = new FormData();
            data.append('id', id );

            const url = `${this.baseUrl}api/admin/deleteAdmin.php`;

            const options = {
                method: "POST",
                data: data,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    Swal.fire(response.data.text)
                }    
            } catch (error) {
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
        },
        async changeAdminPassword(){

            if(!this.newPassword || !this.newPassword1 || !this.currentPassword){
                new Toasteur().error("Input all fields")
            }

            if(this.newPassword !== this.newPassword1){
                new Toasteur().error("Password not the same")
            }else{
                const data = new FormData();
                data.append('currentPassword', this.currentPassword);
                data.append('newPassword', this.newPassword);

                const url = `${this.baseUrl}api/admin/changePassword.php`;
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
                    this.loading = true;
                    let response = await axios(options)
                    if ( response.data.status ){
                        new Toasteur().success('Password Changed');
                    }
                    
                } catch (error) {
                    if (error.response){
                        if (error.response.status === 400){
                            this.error = error.response.data.error.text
                            new Toasteur().error(this.error);;
                        }
                        if (error.response.status === 405){
                            this.error = error.response.data.error.text
                            new Toasteur().error(this.error);;
                        }
                        if (error.response.status === 500){
                            this.error = error.response.data.error.text
                            new Toasteur().error(this.error);;
                        }
                    }else{
                        this.error = error.message || "Error processing request"
                        new Toasteur().error(this.error);;
                    }
                }finally {
                    this.loading = false;
                }
            }

            
        },
        async changeAdminStatus(id, status){
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('id', id);
                data.append('status', status);
            
                const url = `${this.baseUrl}api/admin/changeAdminStatus.php`;
                const options = {
                    method: "POST",
                    data,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.getAllAdmin();
                        new Toasteur().success(response.data.text)
                    }     
                } catch (error) {
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }

            }
        },
        async getAllAdmin(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/admin/getAllAdmin.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            //console.log('URL', url);
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
                    this.admins = response.data.data.admins;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("APIadmins", response.data.data.admins);
                }else{
                    this.admins = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
                }         
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally{
                this.loading = false;
            }
        },
        async getAdminByid(adminid){
            //console.log("adminid",adminid);
            const url = `${this.baseUrl}api/admin/getAdminbyid.php?id=${adminid}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }

            try {
                this.getAdmin_details = null;
                this.loading = true;
                let response = await axios(options)
                if ( response.data.status ){
                    //console.log('getAdmin_details', response.data.data);
                    this.getAdmin_details = response.data.data;
                    const strings = this.getAdmin_details.name.split(" ");
                    const initials = `${strings[0].charAt(0)} ${strings[1].charAt(0)}`;
                    this.getAdmin_details.initials = initials.toUpperCase();
                    //console.log("initials", this.getAdmin_details.initials);
                }
                
            } catch (error) {
                if (error.response){
                    if (error.response.status === 400){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 405){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 500){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                }else{
                    this.error = error.message || "Error processing request"
                    new Toasteur().error(this.error);;
                    //console.log("error", this.error);
                }
            }finally {
                this.loading = false;
            }
        },
        async updateAdmin(){
            if(this.admin_details.name == null ||this.admin_details.username == null ){
                new Toasteur().error("Kindly fill all fields")
            }else{
                let data = new FormData();
                data.append('name', this.admin_details.name );
                data.append('username', this.admin_details.username );

                const url = `${this.baseUrl}api/admin/updateAdmin.php`;

                const options = {
                    method: "POST",
                    data,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        Swal.fire(response.data.text)
                        this.getAdminDetails();
                    }
                            
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
                    return
                }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
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
                }finally{

                }
            }
            
        },

        //transactions
        async getAllTransactions(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}&sortType=${this.transactionType}` : "";  
            // let type = (this.transactionType) ? `&sortType=${this.transactionType}`: ''; 
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/transactions/getAllTransactions.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios(options);
                if(response.data.status){
                    this.transactions = response.data.data.transactions;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("APIadmins", response.data.data.admins);
                }else{
                    this.transactions = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
                }         
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally{
                this.loading = false;
            }
        },
        async getTransactionByid(id){
            //console.log("adminid",adminid);
            const url = `${this.baseUrl}api/transactions/getTransactionByid.php?transactionid=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }

            try {
                this.loading = true;
                this.transaction = null;
                this.loading = true;
                let response = await axios(options)
                if ( response.data.status ){
                    this.transaction = response.data.data;
                }
                
            } catch (error) {
                if (error.response){
                    if (error.response.status === 400){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);
                    }
                    if (error.response.status === 405){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 500){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                }else{
                    this.error = error.message || "Error processing request"
                    new Toasteur().error(this.error);;
                    //console.log("error", this.error);
                }
            }finally {
                this.loading = false;
            }
        },
        async getTransactionByid(adminid){
            //console.log("adminid",adminid);
            const url = `${this.baseUrl}api/transactions/getTransactionByid.php?id=${adminid}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }

            try {
                this.getAdmin_details = null;
                this.loading = true;
                let response = await axios(options)
                if ( response.data.status ){
                    //console.log('getAdmin_details', response.data.data);
                    this.getAdmin_details = response.data.data;
                    const strings = this.getAdmin_details.name.split(" ");
                    const initials = `${strings[0].charAt(0)} ${strings[1].charAt(0)}`;
                    this.getAdmin_details.initials = initials.toUpperCase();
                    //console.log("initials", this.getAdmin_details.initials);
                }
                
            } catch (error) {
                if (error.response){
                    if (error.response.status === 400){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 405){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 500){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                }else{
                    this.error = error.message || "Error processing request"
                    new Toasteur().error(this.error);;
                    //console.log("error", this.error);
                }
            }finally {
                this.loading = false;
            }
        },
        
        async changeTransactionStatus(id, status){
            const url = `${this.baseUrl}api/transactions/changeTransactionStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('transactionid', id);
                data.append('status', status);
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
                    if(response.data.status){
                        new Toasteur().success(response.data.text);
                        await this.getAllTransactions(4);     
                    }else{
                        await this.getAllTransactions(4);
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
                            // // window.location.href="./login.php"
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

            }
            
        },

        //feature
        async getAllFeature(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/apartments/getApartmentByFeature.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            //console.log('URL', url);
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
                    this.features = response.data.data.features;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("APIadmins", response.data.data.admins);
                }else{
                    this.features = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
                }         
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally{
                this.loading = false;
            }
        },
        async getAllUnfeatureApartment(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 10;
            const url = `${this.baseUrl}api/apartments/getApartmentByFeature.php?noPerPage=${noPerPage}&status=0&page=${page}${search}`;
            //console.log('URL', url);
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
                    this.unfeatures = response.data.data.features;
                }else{
                    this.unfeatures = null;
                }         
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally{
                this.loading = false;
            }
        },
        async changeApartmentFeature(id, status){
            const url = `${this.baseUrl}api/apartments/changeApartmentFeature.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('apartment_id', id);
                data.append('feature', status);
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllFeature();
                        this.getAllUnfeatureApartment();      
                    }else{
                        this.getAllFeature();
                        this.getAllUnfeatureApartment();
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
                            // // window.location.href="./login.php"
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

            }
            
        },

        //...blog
        // async getAllBlog(load = 1){
        //     let search = (this.search)? `&search=${this.search}`: '';
        //     let sort = (this.sort != null) ? `&sort=1&sortDays=${this.sortDays}&sortDraft=${this.sortDraft}` : "";  
        //     let page = ( this.currentPage )? this.currentPage : 1;
        //     let noPerPage = ( this.per_page ) ? this.per_page : 4;

        //     const url = `${this.baseUrl}api/blog/getBlog.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
        //     //console.log("getBlogUrl",url);
        //     const options = {
        //         method: "GET",
        //         headers: { 
        //             //"Content-type": "application/json",
        //             "Authorization": `Bearer ${this.authToken}`
        //         },
        //         url
        //     }
        //     try {
        //         if(load == 1){
        //             this.loading = true;
        //         }
        //         this.blogs = null;
        //         let response = await axios(options)
        //         if ( response.data.status ){
        //             //console.log('blogs', response.data.data.blogs);
        //             this.currentPage =response.data.data.page;
        //             this.totalData =response.data.data.total_data;
        //             this.totalPage =response.data.data.totalPage;  
        //             this.blogs = response.data.data.blogs;
        //             this.blogCount = response.data.data.total_data;
        //         }else{
        //             this.blogs= null;
        //             if(webPage == 'location.php'){
        //                 this.currentPage = 0
        //                 this.totalData =0
        //                 this.totalPage =0;
        //             }   
        //         }
                
        //     } catch (error) {
        //         if (error.response){
        //             if (error.response.status === 400){
        //                 this.error = error.response.data.error.text
        //                 new Toasteur().error(this.error);;
        //                 //console.log("error", this.error);
        //             }
        //             if (error.response.status === 405){
        //                 this.error = error.response.data.error.text
        //                 new Toasteur().error(this.error);;
        //                 //console.log("error", this.error);
        //             }
        //             if (error.response.status === 500){
        //                 this.error = error.response.data.error.text
        //                 new Toasteur().error(this.error);;
        //                 //console.log("error", this.error);
        //             }
        //         }else{
        //             this.error = error.message || "Error processing request"
        //             new Toasteur().error(this.error);;
        //             //console.log("error", this.error);
        //         }
        //     }finally {
        //         this.loading = false;
        //     }
        // },
        // async blogImage(event){
        //     this.blogImage = event.target.files[0];
        // },
        // async addBlog(){
        //     //console.log("Headline",this.blogHeadline);
        //     //console.log("content", this.blogContent);
        //     //console.log("minto read", this.minsToRead);
        //     //console.log('blogImage', this.blogImage );
        //     if(this.blogHeadline == null || this.blogContent == null || this.minsToRead == null || this.blogImage == null){
        //         new Toasteur().error("Kindly fill all fields")
        //     }else{
        //         let data = new FormData();
        //         // blogImage, blogHeadline, howManyMinRead, blogContent, 
        //         data.append('blogHeadline', this.blogHeadline );
        //         data.append('howManyMinRead', this.minsToRead );
        //         data.append('blogContent', this.blogContent );
        //         data.append('blogImage', this.blogImage );

        //         const url = `${this.baseUrl}api/blog/addBlog.php`;
        //         //console.log("URL", url);
                
        //         const options = {
        //             method: "POST",
        //             data,
        //             url,
        //             headers: { 
        //                 //"Content-type": "application/json",
        //                 "Authorization": `Bearer ${this.authToken}`
        //             }
        //         }

        //         try {
        //             this.loading = true;
        //             const response = await axios(options); 
        //             if(response.data.status){
        //                 window.location.href='posts.php'
        //                 new Toasteur().success(response.data.text);
                        
        //             }
        //         } catch (error) {
        //             // //console.log(error);
        //             if (error.response){
        //                 if (error.response.status == 400){
        //                     const errorMsg = error.response.data.text;
        //                 new Toasteur().error(errorMsg);
        //                     return
        //                 }
        
        //                 if (error.response.status == 401){
        //                     const errorMsg = "User not Authorized";
        //                     new Toasteur().error(errorMsg);
        //                     // // window.location.href="./login.php"
        //                     return
        //                 }
        
        //                 if (error.response.status == 405){
        //                     const errorMsg = error.response.data.text;
        //                 new Toasteur().error(errorMsg);
        //                     return
        //                 }
        
        //                 if (error.response.status == 500){
        //                     const errorMsg = error.response.data.text;
        //                 new Toasteur().error(errorMsg);
        //                     return
        //                 }
        //             }

        //             new Toasteur().error(error.message || "Error processing request")

                    
        //         }finally {
        //             this.loading = false;
        //         }
        //     }
        // },
        // async getBlogByid(id){
        //     //console.log("blog", id);
        //     const url = `${this.baseUrl}api/blog/getBlogByid.php?id=${id}`;
        //     const options = {
        //         method: "GET",
        //         headers: { 
        //             //"Content-type": "application/json",
        //             "Authorization": `Bearer ${this.authToken}`
        //         },
        //         url
        //     }
        //     try {
        //         this.loading = true
        //         const response = await axios(options);
        //         if (response.data.status) {
        //             this.blog_details= response.data.data;
        //             //console.log(response.data.data);
        //         }else{
        //             new Toasteur().error(response.data.text);
        //         }
        //     } catch (error) {
        //         // //console.log(error);
        //         if (error.response){
        //             if (error.response.status == 400){
        //                 const errorMsg = error.response.data.text;
        //                 new Toasteur().error(errorMsg);
        //                 return
        //             }
    
        //             if (error.response.status == 401){
        //                 const errorMsg = "User not Authorized";
        //                 new Toasteur().error(errorMsg);
        //                 return
        //             }
    
        //             if (error.response.status == 405){
        //                 const errorMsg = error.response.data.text;
        //                 new Toasteur().error(errorMsg);
        //                 return
        //             }
    
        //             if (error.response.status == 500){
        //                 const errorMsg = error.response.data.text;
        //                 new Toasteur().error(errorMsg);
        //                 return
        //             }
        //         }else{
        //             new Toasteur().error(error.message || "Error processing request");
        //         }
                
        //     }finally {
        //         this.loading = false;
        //     }
        // },
        // async deleteBlog(id){
        //     const url = `${this.baseUrl}api/blog/deleteBlog.php?id=${id}`;
        //     const options = {
        //         method: "GET",
        //         headers: { 
        //             //"Content-type": "application/json",
        //             "Authorization": `Bearer ${this.authToken}`
        //         },
        //         url
        //     }
        //     try {
        //         this.loading = true;
        //         const response = await axios(options);
        //         if(response.data.status){
        //             this.getAllBlog();
        //         }    
        //     } catch (error) {
        //         // //console.log(error);
        //         if (error.response){
        //             if (error.response.status == 400){
        //                 const errorMsg = error.response.data.text;
        //                new Toasteur().error(errorMsg);
        //                 return
        //             }
    
        //             if (error.response.status == 401){
        //                 const errorMsg = "User not Authorized";
        //                new Toasteur().error(errorMsg);
        //                 return
        //             }
    
        //             if (error.response.status == 405){
        //                 const errorMsg = error.response.data.text;
        //                new Toasteur().error(errorMsg);
        //                 return
        //             }
    
        //             if (error.response.status == 500){
        //                 const errorMsg = error.response.data.text;
        //                new Toasteur().error(errorMsg);
        //                 return
        //             }
        //         }

        //         new Toasteur().error(error.message || "Error processing request")

                
        //     }finally {
        //         this.loading = false;
        //     }
        // },
        // async updateBlog(){

        // },

        //......3rd party API
        //monify
        async getAllMonify(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/thirdPartyApi/getMonifyApi.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                    this.monifys = response.data.data.monifys;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("APiMonify", response.data.data.monifys);
                }else{
                    this.monifys = null;
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
                        // // window.location.href="./login.php"
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
        async getMonifyByid(id){
            //console.log("monifyid", id);
            const url = `${this.baseUrl}api/thirdPartyApi/getMonifyApiByid.php?id=${id}`;
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
                    this.monify_details= response.data.data;
                    //console.log(response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addMonify(){
            //console.log("apidetails", this.apiWallet);
            //console.log("apidetails", this.apiMerchant);
            //console.log("apidetails", this.apiAccno);
            //console.log("apidetails", this.apiKey);
            //console.log("apidetails", this.apiName);
            //console.log("apidetails", this.secretKey);
            if(this.apiWallet == null || this.apiMerchant== null || this.apiAccno== null || this.apiKey == null ||this.apiName == null || this.secretKey == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('apiKey', this.apiKey );
            data.append('name', this.apiName );
            data.append('secreteKey', this.secretKey );
            data.append('apiMerchant', this.apiMerchant );
            data.append('apiWallet', this.apiWallet );
            data.append('apiAccno', this.secretKey );

            const url = `${this.baseUrl}api/thirdPartyApi/addMonifyApi.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllMonify();
                    Swal.fire(response.data.text);
                    
                }
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally {
                this.loading = false;
            }

        },
        async deleteMonify(id){
            const url = `${this.baseUrl}api/thirdPartyApi/deleteMonifyApi.php?id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    this.getAllMonify();
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
                       // // window.location.href="./login.php"
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
        async changeMonifyStatus(id){
            const url = `${this.baseUrl}api/thirdPartyApi/changeMonifyApiStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('id', id);;
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllMonify();      
                    }else{
                        this.getAllMonify();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateMonify(){
            if(this.monify_details.apiwallet == null || this.monify_details.apimerchant== null || this.monify_details.apiaccno== null || this.monify_details.apikey == null ||this.monify_details.name == null || this.monify_details.secretkey == null){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('id', this.monify_details.id );
                data.append('apikey', this.monify_details.apikey );
                data.append('name', this.monify_details.name );
                data.append('secretkey', this.monify_details.secretkey );
                data.append('apimerchant', this.monify_details.apimerchant );
                data.append('apiwallet', this.monify_details.apiwallet);
                data.append('apiaccno', this.monify_details.apiaccno );


                const url = `${this.baseUrl}api/thirdPartyApi/updateMonifyApi.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getAllMonify();
                        Swal.fire(response.data.text);
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

        },

        //paystack
        async getAllPaystack(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/thirdPartyApi/getPaystackApi.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                    this.payStacks = response.data.data.payStacks;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("ApiPayStacks", response.data.data.payStacks);
                }else{
                    this.payStacks = null;
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
                        // // window.location.href="./login.php"
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
        async getPayStaskByid(id){
            //console.log("paystackid", id);
            const url = `${this.baseUrl}api/thirdPartyApi/getPaystackApiByid.php?id=${id}`;
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
                    this.payStack_details= response.data.data;
                    //console.log(response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addPayStack(){
            if(this.apiKey == null || this.apiName == null || this.secretKey == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('apiKey', this.apiKey );
            data.append('name', this.apiName );
            data.append('secreteKey', this.secretKey );

            const url = `${this.baseUrl}api/thirdPartyApi/addPaystackApi.php`;
            //console.log("URL", url);
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllPaystack();
                    new Toasteur().success(response.data.text);
                    
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
                       // // window.location.href="./login.php"
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
        async deletePaystack(id){
            let data = new FormData();
            data.append('id', id );

            const url = `${this.baseUrl}api/thirdPartyApi/deletePaystackApi.php?id=${id}`;

            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    this.getAllPaystack();
                }    
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
        },
        async changePaystackStatus(id){
            const url = `${this.baseUrl}api/thirdPartyApi/changePaystackApiStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('id', id);;
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllPaystack();      
                    }else{
                        this.getAllPaystack();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updatePayStack(){
            if(this.payStack_details.apikey == null ||this.payStack_details.name == null || this.payStack_details.secretekey == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('id', this.payStack_details.id );
            data.append('apikey', this.payStack_details.apikey );
            data.append('name', this.payStack_details.name );
            data.append('secretekey', this.payStack_details.secretekey );

            const url = `${this.baseUrl}api/thirdPartyApi/updatePaystackApi.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllPaystack();
                    new Toasteur().success(response.data.text);
                    
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
                       // // window.location.href="./login.php"
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

        //Kudi api
        async getAllKudi(load =1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            let url = `${this.baseUrl}api/thirdPartyApi/getKudiApi.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            //console.log('KudiUrl', url);
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
                    this.kudis = response.data.data.kudis;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("ApiKudis", response.data.data.kudis);
                }else{
                    this.kudis = null;
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
                        // // window.location.href="./login.php"
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
        async getKudiByid(id){
            //console.log("KudiID", id);
            const url = `${this.baseUrl}api/thirdPartyApi/getKudiApiByid.php?id=${id}`;
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
                    this.kudi_details = response.data.data;
                    //console.log('DOKudi_details', this.kudi_details);
                    //console.log("DOKudi_details.name", this.kudi_details.name);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addKudi(){
            if(this.apiKey == null ||this.apiName == null || this.secretKey == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('sendFrom', this.sendFrom );
            data.append('name', this.apiName );
            data.append('username', this.apiUsername );
            data.append('password', this.apiPassword );

            const url = `${this.baseUrl}api/thirdPartyApi/addKudiApi.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllKudi();
                    new Toasteur().success(response.data.text);
                    
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
                       // // window.location.href="./login.php"
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
        async deleteKudi(id){

            const url = `${this.baseUrl}api/thirdPartyApi/deleteKudiApi.php?id=${id}`;

            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    this.getAllKudi();
                }    
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
        },
        async changeKudiStatus(id){
            const url = `${this.baseUrl}api/thirdPartyApi/changeKudiApiStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('id', id);;
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed");
                        this.getAllKudi();      
                    }else{
                        this.getAllKudi();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateKudi(){

            if(this.kudi_details.id == null || this.kudi_details.sendfrom == null || this.kudi_details.name == null || this.kudi_details.username == null || this.kudi_details.password == null ){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('id', this.kudi_details.id );
                data.append('sendFrom', this.kudi_details.sendfrom );
                data.append('name', this.kudi_details.name );
                data.append('username', this.kudi_details.username );
                data.append('password', this.kudi_details.password );

                const url = `${this.baseUrl}api/thirdPartyApi/updateKudiApi.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getAllKudi();
                        new Toasteur().success(response.data.text);
                        
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
                           // // window.location.href="./login.php"
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
            }

        },
        

        //sendgrid
        async getAllSendGrid(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/thirdPartyApi/getAllSendGrid.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            //console.log("sendgrid url", url);
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
                    this.sendGrids = response.data.data.details;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("APIsendGrids", response.data.data.details);
                }else{
                    this.sendGrids = null;
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
                        // // window.location.href="./login.php"
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
        async getSendGridByid(id){
            //console.log("snedGrid", id);
            const url = `${this.baseUrl}api/thirdPartyApi/getSendGridByID.php?id=${id}`;
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
                    this.sendGrid_details= response.data.data;
                    //console.log('DOSendGrid',this.sendGrid_details);
                    //console.log("APISendGrid", response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addSendGrid(){
            if(this.sendFrom == null || this.apiKey == null ||this.apiName == null || this.secretKey == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('sender', this.sendFrom );
            data.append('apikey', this.apiKey );
            data.append('name', this.apiName );
            data.append('secreteid', this.secretKey );

            const url = `${this.baseUrl}api/thirdPartyApi/addSendGridApi.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllSendGrid();
                    new Toasteur().success(response.data.text);
                    
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
                       // // window.location.href="./login.php"
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
        async deleteSendGrid(id){
            let data = new FormData();
            data.append('id', id );

            const url = `${this.baseUrl}api/thirdPartyApi/deleteSendGrid.php?`;

            const options = {
                method: "POST",
                data: data,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    this.getAllSendGrid();
                }    
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
        },
        async changeSendGridStatus(id){
            const url = `${this.baseUrl}api/thirdPartyApi/changeSendGridApiStatus.php?`;
            //console.log('URL', url);
            //console.log("id", id);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('api_id', id);;
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllSendGrid();      
                    }else{
                        this.getAllSendGrid();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateSendGrid(){
            if(this.sendGrid_details.id == null || this.sendGrid_details.email_from == null || this.sendGrid_details.api_key == null ||this.sendGrid_details.name == null || this.sendGrid_details.secret_id == null){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('send_grid_id', this.sendGrid_details.id );
                data.append('sender', this.sendGrid_details.email_from );
                data.append('apikey', this.sendGrid_details.api_key );
                data.append('name', this.sendGrid_details.name );
                data.append('secret_id', this.sendGrid_details.secret_id );

                const url = `${this.baseUrl}api/thirdPartyApi/updateSendGridApi.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getAllSendGrid();
                        new Toasteur().success(response.data.text);
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
                           // // window.location.href="./login.php"
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
            }

        },

        //SmartSMS
        async getAllSmartSolution(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/thirdPartyApi/getAllSmartSolutions.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                    this.smartSolutions = response.data.data.smart;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("APIsmartsms", response.data.data.smart);
                }else{
                    this.smartSolutions = null;
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
                        // // window.location.href="./login.php"
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
        async getSmartSolutionByid(id){
            //console.log("snedGrid", id);
            const url = `${this.baseUrl}api/thirdPartyApi/getSmartSolutionsById.php?smart_id=${id}`;
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
                    this.smartSolution_details= response.data.data;
                    //console.log(response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addSmartSolution(){
            if(this.sendFrom == null || this.apiToken == null ||this.apiName == null || this.sendType == null || this.routing == null){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('sender', this.sendFrom );
                data.append('apitoken', this.apiToken );
                data.append('name', this.apiName );
                data.append('sendtype', this.sendType );
                data.append('routing', this.routing );

                const url = `${this.baseUrl}api/thirdPartyApi/addSmartSolutionsApi.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getAllSmartSolution();
                        new Toasteur().success(response.data.text);
                        
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
                            // // window.location.href="./login.php"
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
            }

        },
        async deleteSmartSolution(id){
            let data = new FormData();
            data.append('id', id );

            const url = `${this.baseUrl}api/thirdPartyApi/deleteSmartSolutions.php?`;

            const options = {
                method: "POST",
                data: data,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    this.getAllSmartSolution();
                }    
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
        },
        async changeSmartSolutionStatus(id){
            const url = `${this.baseUrl}api/thirdPartyApi/setActiveSmartApiStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('smart_id', id);;
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllSmartSolution();      
                    }else{
                        this.getAllSmartSolution();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateSmartSolution(){
            //console.log("sendtype", this.smartSolution_details.sendtype);
            if(this.smartSolution_details.id ==null ||this.smartSolution_details.sendFrom == null || this.smartSolution_details.apiToken == null ||this.smartSolution_details.name == null || this.smartSolution_details.sendtype == null || this.smartSolution_details.routing == null){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('smart_id', this.smartSolution_details.id );
                data.append('sender', this.smartSolution_details.sendFrom );
                data.append('apitoken', this.smartSolution_details.apiToken );
                data.append('name', this.smartSolution_details.name );
                data.append('sendtype', this.smartSolution_details.sendtype );
                data.append('routing', this.smartSolution_details.routing );

                const url = `${this.baseUrl}api/thirdPartyApi/updateSmartSolutionsApi.php`;
                //console.log("URL", url);
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getAllSmartSolution();
                        new Toasteur().success(response.data.text);
                        
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
                           // // window.location.href="./login.php"
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
            }

        },
        //TermiApi
        async getTermiApi(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 10;
            const url = `${this.baseUrl}api/thirdPartyApi/getAllTermiTable.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                    this.termiApis = response.data.data.termi;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("TermiApi", response.data.data.termi);
                }else{
                    this.termiApis = null;
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
                        // // window.location.href="./login.php"
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
        async getTermiApiByid(id){
            //console.log("snedGrid", id);
            const url = `${this.baseUrl}api/thirdPartyApi/getTermiByid.php?termi_id=${id}`;
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
                    this.termiApi_details= response.data.data.termi;
                    //console.log(response.data.data.termi);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addTermiApi(){
            if(this.sendFrom == null || this.apiKey == null ||this.apiName == null || this.smsType == null || this.smsChannel == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('sender', this.sendFrom );
            data.append('apikey', this.apiKey );
            data.append('name', this.apiName );
            data.append('smstype', this.smsType );
            data.append('smschannel', this.smsChannel );

            const url = `${this.baseUrl}api/thirdPartyApi/addTermiApi.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getTermiApi();
                    new Toasteur().success(response.data.text);
                    
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
                       // // window.location.href="./login.php"
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
        async deleteTermiApi(id){
            let data = new FormData();
            data.append('termi_id', id );

            const url = `${this.baseUrl}api/thirdPartyApi/deleteTermiApi.php?`;

            const options = {
                method: "POST",
                data: data,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    this.getTermiApi();
                }    
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
        },
        async changeTermiStatus(id){
            const url = `${this.baseUrl}api/thirdPartyApi/setActiveTermiApiStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('termi_id', id);;
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
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getTermiApi();      
                    }else{
                        this.getTermiApi();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateTermiApi(){
            if(this.termiApi_details.sendFrom == null || this.termiApi_details.id == null ||this.termiApi_details.name == null || this.termiApi_details.smstype == null || this.termiApi_details.smschannel == null){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('termi_id', this.termiApi_details.id );
                data.append('sender', this.termiApi_details.sendFrom );
                data.append('apikey', this.termiApi_details.key );
                data.append('name', this.termiApi_details.name );
                data.append('smstype', this.termiApi_details.smstype );
                data.append('smschannel', this.termiApi_details.smschannel );

                const url = `${this.baseUrl}api/thirdPartyApi/updateTermiApi.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getTermiApi();
                        Swal.fire(response.data.text);
                        
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
                           // // window.location.href="./login.php"
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
            }

        },

        //.....utilities..............
        async getSubBuilding(id){
            window.localStorage.setItem("buildingTypeid", id);
            window.location.href='subBuilding_by_buildingTypeid.php';
            
        },
        async uploadImage(event){
            this.uploadImage = event.target.files[0];
            console.log("image", this.uploadImage);
        },
        async getToken(){
            this.loading= true
            const token = window.localStorage.getItem("authToken");
            this.authToken = token;
            //console.log("token gotten", this.authToken);
            
        },
        async nextPage(){
            this.currentPage = parseInt(this.currentPage) + 1;
            this.totalData =null;
            this.totalPage =null;
            if(webPage =='monify.php'){
                await this.getAllMonify()
            }
            if(webPage =='paystack.php'){
                await this.getAllPaystack()
            }
            if(webPage =='kudi.php' ){
                await this.getAllKudi();
            }
            if(webPage =='smartsolution.php'){
                await this.getAllSmartSolution();
            }
            if(webPage =='sendgrid.php'){
                await this.getAllSendGrid()
            }
            if(webPage == 'termiapi.php'){
                await this.getTermiApi();
            }
            if(webPage == 'addresses.php'){
                await this.getAllAddresses();
            }
            if(webPage == 'buildingType.php'){
                await this.getAllBuildingType();
            }
            if(webPage == 'guestSafety.php'){
                await this.getAllGuestSafety();
            }
            if(webPage == 'spaceType.php'){
                await this.getAllSpaceType();
            }
            if(webPage == 'highlights.php'){
                await this.getAllHighlight();
            }
            if(webPage == 'scenic_view.php'){
                await this.getAllScenicView();
            }
            if(webPage == 'additional_charges.php'){
                await this.getAllAdditionalCharge();
            }
            if(webPage == 'cancelation_policy.php'){
                await this.getAllCancelationPolicy();
            }
            if(webPage == 'subBuilding_by_buildingTypeid.php'){
                const buildingid = this.subTypesByBuildingid.buildingTypeid;
                await this.getAllSubBuildingTypeByBuildingTypeid(buildingid, 1);
            }
            if(webPage == 'house_rule.php'){
                await this.getAllHouseRules()
            }
            
            if(webPage == 'bookings.php'){
                this.getAllBookings()
            }
            if(webPage == 'transactions.php'){
                this.getAllTransactions()
            }
            if(webPage == 'features.php'){
                this.getAllFeature()
            }
        },
        async previousPage(){
            this.currentPage = parseInt(this.currentPage) - 1;
            this.totalData =null;
            this.totalPage =null;
            if(webPage =='monify.php'){
                await this.getAllMonify()
            }
            if(webPage =='paystack.php'){
                await this.getAllPaystack()
            }
            if(webPage =='kudi.php' ){
                await this.getAllKudi();
            }
            if(webPage =='smartsolution.php'){
                await this.getAllSmartSolution();
            }
            if(webPage =='sendgrid.php'){
                await this.getAllSendGrid()
            }
            if(webPage == 'termiapi.php'){
                await this.getTermiApi();
            }
            if(webPage == 'addresses.php'){
                await this.getAllAddresses();
            }
            if(webPage == 'buildingType.php'){
                await this.getAllBuildingType();
            }
            if(webPage == 'guestSafety.php'){
                await this.getAllGuestSafety();
            }
            if(webPage == 'spaceType.php'){
                await this.getAllSpaceType();
            }
            if(webPage == 'highlights.php'){
                await this.getAllHighlight();
            }
            if(webPage == 'scenic_view.php'){
                await this.getAllScenicView();
            }
            if(webPage == 'additional_charges.php'){
                await this.getAllAdditionalCharge();
            }
            if(webPage == 'cancelation_policy.php'){
                await this.getAllCancelationPolicy();
            }

            if(webPage == 'subBuilding_by_buildingTypeid.php'){
                const buildingid = this.subTypesByBuildingid.buildingTypeid;
                await this.getAllSubBuildingTypeByBuildingTypeid(buildingid, 1);
            }
            if(webPage == 'house_rule.php'){
                await this.getAllHouseRules()
            }
            if(webPage == 'bookings.php'){
                this.getAllBookings()
            }
            if(webPage == 'transactions.php'){
                this.getAllTransactions()
            }
            if(webPage == 'features.php'){
                this.getAllFeature()
            }
        },
        async tab_nextPage(item){
            let logisticid = (localStorage.getItem("logisticid")) ? localStorage.getItem("logisticid"): null;
            if(logisticid){
                if(item === 'prices'){
                    this.price_currentPage = parseInt(this.price_currentPage) + 1;
                    //console.log("clickTab currentPage", this.price_currentPage);
                    this.price_totalData =null;
                    this.price_totalPage =null;
                    await this.getLogisticPrices(logisticid)
                }
                if(item ==='locations'){
                    this.location_currentPage = parseInt(this.location_currentPage) + 1;
                    //console.log("clickTab currentPage", this.location_currentPage);
                    this.location_totalData =null;
                    this.location_totalPage =null;
                    await this.getLogisticLocations(logisticid);
                }
            }else{
                window.location.href = 'logistics.php'
            }
        },
        async tab_previousPage(item){
            let logisticid = (localStorage.getItem("logisticid")) ? localStorage.getItem("logisticid"): null;
            if(logisticid){
                if(item === 'prices'){
                    this.price_currentPage = parseInt(this.price_currentPage) - 1;
                    this.price_totalData =null;
                    this.price_totalPage =null;
                    await this.getLogisticPrices(logisticid)
                }
                if(item ==='locations'){
                    this.location_currentPage = parseInt(this.location_currentPage) - 1;
                    this.location_totalData =null;
                    this.location_totalPage =null;
                    await this.getLogisticLocations(logisticid);
                }
            }else{
                window.location.href = 'logistics.php'
            }
        },
        async setNoPerPage(no){
            this.per_page = no;
            this.class_active = true;
            if(webPage == "logistics.php"){
                await this.getAllLogistics();
            }
            if(webPage == "admins.php"){
                this.getAllAdmin();
            }
            if(webPage == 'location.php'){
                this.getLogisticLocations();
            }
            if(webPage == "orders.php"){
                await this.getAllCarts();
            }
            if(webPage == "orders.php"){
                await this.getAllCarts();
            }
            if(webPage =='monify.php'){
                await this.getAllMonify()
            }
            if(webPage =='paystack.php'){
                await this.getAllPaystack()
            }
            if(webPage =='kudi.php' ){
                await this.getAllKudi();
            }
            if(webPage =='smartsolution.php'){
                await this.getAllSmartSolution();
            }
            if(webPage =='sendgrid.php'){
                await this.getAllSendGrid()
            }
            if(webPage == 'termiapi.php'){
                await this.getTermiApi();
            }
            if(webPage == 'posts.php'){
                await this.getAllBlog();
            }
            if(webPage == 'addresses.php'){
                await this.getAllAddresses();
            }
            if(webPage == 'buildingType.php'){
                await this.getAllBuildingType();
            }
            if(webPage == 'guestSafety.php'){
                await this.getAllGuestSafety();
            }
            if(webPage == 'spaceType.php'){
                await this.getAllSpaceType();
            }
            if(webPage == 'highlights.php'){
                await this.getAllHighlight();
            }
            if(webPage == 'scenic_view.php'){
                await this.getAllScenicView();
            }
            if(webPage == 'additional_charges.php'){
                await this.getAllAdditionalCharge();
            }
            if(webPage == 'cancelation_policy.php'){
                await this.getAllCancelationPolicy();
            }
            if(webPage == 'subBuilding_by_buildingTypeid.php'){
                const buildingid = this.subTypesByBuildingid.buildingTypeid;
                await this.getAllSubBuildingTypeByBuildingTypeid(buildingid, 1);
            }
            if(webPage == 'house_rule.php'){
                this.getAllHouseRules()
            }
            if(webPage == 'bookings.php'){
                this.getAllBookings()
            }
            if(webPage == 'transactions.php'){
                this.getAllTransactions()
            }
            if(webPage == 'features.php'){
                this.getAllFeature()
            }
        },
        async noSort(){
            this.loading = true
            this.sort = null;
            this.transactionType = null,
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            this.sortDraft = null;
            this.sortDays = null;
            this.class_active = true;
            if(webPage == "logistics.php"){
                await this.getAllLogistics();
            }
            if(webPage == "admins.php"){
                this.getAllAdmin();
            }
            if(webPage == 'prices.php'){
               await this.getLogisticPrices()
            }
            if(webPage == 'location.php'){
                this.getLogisticLocations();
            }
            if(webPage == "orders.php"){
                await this.getAllCarts();
            }
            if(webPage == "orders.php"){
                await this.getAllCarts();
            }

            if(webPage =='monify.php'){
                await this.getAllMonify()
            }
            if(webPage =='paystack.php'){
                await this.getAllPaystack()
            }
            if(webPage =='kudi.php' ){
                await this.getAllKudi();
            }
            if(webPage =='smartsolution.php'){
                await this.getAllSmartSolution();
            }
            if(webPage =='sendgrid.php'){
                await this.getAllSendGrid()
            }
            if(webPage == 'termiapi.php'){
                await this.getTermiApi();
            }
            if(webPage == 'posts.php'){
                await this.getAllBlog();
            }
            if(webPage == 'addresses.php'){
                await this.getAllAddresses();
            }
            if(webPage == 'buildingType.php'){
                await this.getAllBuildingType();
            }
            if(webPage == 'guestSafety.php'){
                await this.getAllGuestSafety();
            }
            if(webPage == 'spaceType.php'){
                await this.getAllSpaceType();
            }
            if(webPage == 'highlights.php'){
                await this.getAllHighlight();
            }
            if(webPage == 'scenic_view.php'){
                await this.getAllScenicView();
            }
            if(webPage == 'additional_charges.php'){
                await this.getAllAdditionalCharge();
            }
            if(webPage == 'cancelation_policy.php'){
                await this.getAllCancelationPolicy();
            }
            if(webPage == 'subBuilding_by_buildingTypeid.php'){
                const buildingid = this.subTypesByBuildingid.buildingTypeid;
                await this.getAllSubBuildingTypeByBuildingTypeid(buildingid, 1);
            }
            if(webPage == 'house_rule.php'){
                this.getAllHouseRules()
            }
            
            if(webPage == 'bookings.php'){
                this.getAllBookings()
            }
            if(webPage == 'transactions.php'){
                this.getAllTransactions()
            }
            if(webPage == 'features.php'){
                this.getAllFeature()
            }
        }, 
        async sortByStatus(status){
            this.loading = true;
            this.sort = status;
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            this.class_active = true;
            //console.log('SortStatus', status);
            if(webPage == "logistics.php"){
                await this.getAllLogistics();
            }
            if(webPage == "admins.php"){
                this.getAllAdmin();
            }
            if(webPage == 'prices.php'){
               await this.getLogisticPrices()
            }
            if(webPage == 'location.php'){
                this.getLogisticLocations();
            }
            if(webPage == "orders.php"){
                await this.getAllCarts();
            }

            if(webPage =='monify.php'){
                await this.getAllMonify()
            }
            if(webPage =='paystack.php'){
                await this.getAllPaystack()
            }
            if(webPage =='kudi.php' ){
                await this.getAllKudi();
            }
            if(webPage =='smartsolution.php'){
                await this.getAllSmartSolution();
            }
            if(webPage =='sendgrid.php'){
                await this.getAllSendGrid()
            }
            if(webPage == 'termiapi.php'){
                await this.getTermiApi();
            }
            if(webPage == 'addresses.php'){
                await this.getAllAddresses();
            }
            if(webPage == 'buildingType.php'){
                await this.getAllBuildingType();
            }
            if(webPage == 'guestSafety.php'){
                await this.getAllGuestSafety();
            }
            if(webPage == 'spaceType.php'){
                await this.getAllSpaceType();
            }
            if(webPage == 'highlights.php'){
                await this.getAllHighlight();
            }
            if(webPage == 'scenic_view.php'){
                await this.getAllScenicView();
            }
            if(webPage == 'additional_charges.php'){
                await this.getAllAdditionalCharge();
            }
            if(webPage == 'cancelation_policy.php'){
                await this.getAllCancelationPolicy();
            }
            if(webPage == 'subBuilding_by_buildingTypeid.php'){
                const buildingid = this.subTypesByBuildingid.buildingTypeid;
                await this.getAllSubBuildingTypeByBuildingTypeid(buildingid, 1);
            }
            if(webPage == 'system_settings.php'){
                this.getSystemSettings()
            }
            if(webPage == 'house_rule.php'){
                this.getAllHouseRules()
            }
            
            if(webPage == 'bookings.php'){
                this.getAllBookings()
            }
            if(webPage == 'transactions.php'){
                this.getAllTransactions()
            }
            if(webPage == 'features.php'){
                this.getAllFeature()
            }
            
        },
        async sortByDays(days){
            this.sort =1;
            this.loading = true;
            this.sortDays = days
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            //console.log('sortByDays', days);
            if(webPage == "posts.php"){
                await this.getAllBlog();
            }
        },
        async sortByTransactionType(type){
            this.sort=1
            this.transactionType = type;
            this.loading = true;
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            
            if(webPage == 'transactions.php'){
                this.class_active_type = true;
                this.getAllTransactions()
            }
        },
        async sortByDraft(draft){
            this.sort =1;
            this.loading = true;
            this.sortDraft = draft
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            //console.log('SortByDraft', draft);
            if(webPage == "posts.php"){
                await this.getAllBlog();
            }
        },
        async sortByOrderStatus(sortStatus){
            this.sort = sortStatus;
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            //console.log('SortStatus', sortStatus);
            if(webPage == "orders.php"){
                await this.getAllCarts();
            }

        },
        async getByid(id){
            this.loading = true;
            this.location_details = null;
            this.price_details = null;
            this.order_details = null;
            if(webPage == 'orders.php'){
                this.getCartByid(id)
            }
            if(webPage == 'prices.php'){
                this.getLogisticPriceByid(id)
            }
            if(webPage == 'location.php'){
                this.getLocationByid(id)
            }

        },
        async log(){
            console.log("systemSettings", this.systemSettings);
        },
        async changeStatus(id,status){
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            if(webPage == 'orders.php'){
                await this.changeOrderStatus(id, status)
            }
            if(webPage == 'prices.php'){
                await this.changeLogisticPriceStatus(id, status)
            }
            if(webPage == 'location.php'){
                this.changeLogisticLocationStatus(id, status);
            }
        },

        async getUserid(userid){
            this.loading = false
            if(webPage =='admins.php'){
                localStorage.setItem("adminid", userid);
                window.location.href=`admin-details.php`;
            }
            if(webPage =='logistics.php'){
                localStorage.setItem("logisticid", userid);
                window.location.href=`logistics-details.php?`;
            }
        
        },
        async deleteByid(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })
            
            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                if(webPage == 'prices.php'){
                    this.deleteLogisticPrice(id)
                }
                if(webPage == 'location.php'){
                    //console.log('location id', id);
                    this.deleteLocation(id);
                }

                if(webPage =='monify.php'){
                    this.deleteMonify(id)
                }
                if(webPage =='paystack.php'){
                    this.deletePaystack(id)
                }
                if(webPage =='kudi.php' ){
                    this.deleteKudi(id);
                }
                if(webPage =='smartsolution.php'){
                    this.deleteSmartSolution(id);
                }
                if(webPage =='sendgrid.php'){
                    this.deleteSendGrid(id)
                }
                if(webPage == 'termiapi.php'){
                    this.deleteTermiApi(id);
                }
                if(webPage == 'posts.php'){
                    this.deleteBlog(id);
                }
                if(webPage == 'buildingType.php'){
                    this.deleteBuildingType(id);
                }
                if(webPage == 'guestSafety.php'){
                    this.deleteGuestSafety(id);
                }
                if(webPage == 'spaceType.php'){
                    this.deleteSpaceType(id);
                }
                if(webPage == 'highlights.php'){
                    this.deleteHighlight(id);
                }
                if(webPage == 'scenic_view.php'){
                    this.deleteScenicView(id);
                }
                if(webPage == 'additional_charges.php'){
                    this.deleteAdditionalCharge(id);
                }
                if(webPage == 'cancelation_policy.php'){
                    this.deleteCancelationPolicy(id);
                }

                if(webPage == 'subBuilding_by_buildingTypeid.php'){
                    this.deleteSubTypeByBuildingid(id);
                }
                if(webPage == 'house_rule.php'){
                    this.deleteHouseRule(id)
                }
                if(webPage == 'bookings.php'){
                    this.deleteBooking();
                }
                swalWithBootstrapButtons.fire(
                'Deleted!',
                'Record deleted succesfully.',
                'success'
                )
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Record not deleted',
                'error'
                )
            }
            })
            
        },
        async getIndex(index){
            if(webPage == 'amenities.php'){
                this.itemDetails = this.blogs[index];
            }
    
            if(webPage == 'logistics.php'){
                this.itemDetails = this.logistics[index];
            }
    
            if(webPage == "admins.php"){ 
                this.itemDetails = this.admins[index];
            }
            if(webPage == 'orders.php'){
                this.itemDetails = this.orders[index];
            }
            if(webPage == 'addresses.php'){
                this.itemDetails = this.addresses[index];
            }
            if(webPage == 'buildingType.php'){
                this.itemDetails = this.buildingTypes[index];
            }
            if(webPage == 'guestSafety.php'){
                this.itemDetails = this.guestSafeties[index];
            }
            if(webPage == 'spaceType.php'){
                this.itemDetails = this.spaceTypes[index];
            }
            if(webPage == 'highlights.php'){
                this.itemDetails = this.highlights[index];
            }
            if(webPage == 'scenic_view.php'){
                console.log("arrayIndex", index);
                this.itemDetails = this.scenicViews[index];
            }
            if(webPage == 'additional_charges.php'){
                this.itemDetails = this.additionalCharges[index];
            }
            if(webPage == 'cancelation_policy.php'){
                this.itemDetails = this.cancelationPolicies[index];
            }
            if(webPage == 'facilities.php'){
                this.facility = this.all_facilities[index];
            }
        },
        async generateUserPassword(){
            this.newPassword = generatePassword();
        },
        async setBookingid(id){
            window.localStorage.setItem("bookingid", id)
        },
        //end of LanreWaju methods

        // Korede's Functions
        async generatePass(){
            this.shop_password = generatePassword();
        },
        async setBookingId(id){
            window.localStorage.setItem("booking_id", id);
        },
        async getItemIndex(index){
            if (webPage == "amenities.php" ){
                this.amenity = this.all_amenities[index];
            }
            if (webPage == "sub_amenities.php" ){
                this.sub_amenity = this.all_sub_amenities[index];
            }
            if (webPage == "host_type.php" ){
                this.hosts = this.all_host_type[index];
            }
            if (webPage == "room-type.php" ){
                this.sub_building_type = this.all_sub_building_types[index];
            }
            if ( webPage === "all_apartments.php" ){
                this.apartment = this.all_apartments[index];
            }
            if ( webPage === "facilities.php" ){
                this.facility = this.all_facilities[index];
            }
            if ( webPage === "apartment-details.php"){
                this.apartment_img = this.apartment_images[index];
            }
            if (webPage === "currency.php"){
                this.currency = this.all_currencies[index];
            }
            if (webPage === "transactions.php"){
                this.transaction = this.transactions[index];
            }
            //console.log(this.shop_product)
        },
        // korede
        async changeImage(event){
            this.kor_file = event.target.files[0];
            //console.log(this.kor_file);
        },
        async fetchPriceAndId(){
            if ( this.booking_details ){
                this.fetchPartmentWithPrice();
                this.booking_details.apartment_price = this.apartment_details.price; 
                if (this.apartment_details){
                    console.log(this.apartment_details);
                    if ( this.booking_details.preferred_check_in && this.booking_details.prefferred_check_out ){
                        const days = days_difference(this.booking_details.preferred_check_in, this.booking_details.prefferred_check_out);
                        if (days <= 0 ){
                            this.booking_details.preferred_check_in = null;
                            this.booking_details.prefferred_check_out = null;
                            new Toasteur().error("Select correct check in and check out time");
                            return;
                        }
                        if (days >= this.apartment_details.min_stay_value && days <= this.apartment_details.max_stay_value){
                            this.booking_details.total_amount_paid = this.booking_details.apartment_price * days;
                        }else{
                            this.booking_details.preferred_check_in = null;
                            this.booking_details.prefferred_check_out = null;
                            new Toasteur().error(`min number of days is ${this.apartment_details.min_stay_value} & max no of days is ${this.apartment_details.max_stay_value}`);
                            return;
                        }
                    }
    
                }else{
                    this.booking_details.preferred_check_in = null;
                    this.booking_details.prefferred_check_out = null;
                    new Toasteur().error("Kindly Select an Apartment");
                    return;
                }
            }else{
                if (this.apartment_details){
                    console.log(`id: ${this.apartment_details.id}`);
                    console.log(`price: ${this.apartment_details.price}`);
                    this.apartment_booked = this.apartment_details.id;
                    this.apartment_price = this.apartment_details.price;
                }
    
                if (this.apartment_details){
                    if ( this.preferred_check_in && this.prefferred_check_out ){
                        const days = days_difference(this.preferred_check_in, this.prefferred_check_out)
                        if (days <= 0 ){
                            this.preferred_check_in = null;
                            this.prefferred_check_out = null;
                            new Toasteur().error("Select correct check in and check out time");
                            return;
                        }
                        if (days >= this.apartment_details.min_stay_value && days <= this.apartment_details.max_stay_value){
                            this.total_payment = this.apartment_price * days;
                        }else{
                            this.preferred_check_in = null;
                            this.prefferred_check_out = null;
                            new Toasteur().error(`min number of days is ${this.apartment_details.min_stay_value} & max no of days is ${this.apartment_details.max_stay_value}`);
                            return;
                        }
                    }
    
                }else{
                    this.preferred_check_in = null;
                    this.prefferred_check_out = null;
                    new Toasteur().error("Kindly Select an Apartment");
                    return;
                }
            }
        },
        fetchPartmentWithPrice(){
            const value = this.all_apartments.filter((e) => {
                return e.id = this.booking_details.apartment_id;
            });
            this.apartment_details = value[0];
                
        },
        async getAllAmenities( load = 1){
            console.log(this.sort);
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
    
            const url = `${this.baseUrl}api/amenities/get_all_amenities.php?per_page=${per_page}&page=${page}${search}${sort}`;
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
                    this.kor_page = response.data.data.page;
                    this.kor_total_page= response.data.data.totalPage;
                    this.kor_per_page = response.data.data.per_page;
                    this.kor_total_data = response.data.data.total_data;
                    //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                }else{
                    this.all_amenities = null;
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
        async addamenity( load = 1){
                if (!this.amenities_name ){
                    this.error = "Insert all Fields"
                    new Toasteur().error(this.error);
                    return;
                }
                const data = new FormData();
                data.append("name", this.amenities_name);
                const url = `${this.baseUrl}api/amenities/add_amenities.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllAmenities(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async changeAmenityStatus(id, status){
            const data = new FormData();
                data.append("amenity_id", id);
                data.append("status", status);
                const url = `${this.baseUrl}api/amenities/change_status.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllAmenities(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async updateAmenity(){
            if (!this.amenity.name  || !this.amenity.id){
                this.error = "Insert all Fields"
                new Toasteur().error(this.error);
                return;
            }
            const data = new FormData();
            data.append("amenity_id", this.amenity.id);
            data.append("name", this.amenity.name);
            const url = `${this.baseUrl}api/amenities/update_amenities.php`;
            const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
            }
            try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllAmenities(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async deleteAmenity(id){
            const data = new FormData();
                data.append("amenity_id", id);
                const url = `${this.baseUrl}api/amenities/delete_amenities.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllAmenities();
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async getAllFacilities( load = 1){
            console.log(this.sort);
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
    
            const url = `${this.baseUrl}api/facility/get_all_facilities.php?per_page=${per_page}&page=${page}${search}${sort}`;
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
                    this.all_facilities = response.data.data.facilities;
                    this.kor_page = response.data.data.page;
                    this.kor_total_page= response.data.data.totalPage;
                    this.kor_per_page = response.data.data.per_page;
                    this.kor_total_data = response.data.data.total_data;
                    //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                }else{
                    this.all_facilities = null;
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
        async addFacility( load = 1){
                if (!this.facilty_name  || !this.facility_description){
                    this.error = "Insert all Fields"
                    new Toasteur().error(this.error);
                    return;
                }
                const data = new FormData();
                data.append("name", this.facilty_name);
                data.append("description", this.facility_description);
                const url = `${this.baseUrl}api/facility/add_facility.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllFacilities(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async changeFacilityStatus(id, status){
            const data = new FormData();
                data.append("facility_id", id);
                data.append("status", status);
                const url = `${this.baseUrl}api/facility/change_status.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllFacilities(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async updateFacility(){
            console.log("i reach here nw");
            if (!this.facility.name || !this.facility.description  || !this.facility.id){
                this.error = "Insert all Fields"
                new Toasteur().error(this.error);
                return;
            }
            const data = new FormData();
            data.append("facility_id", this.facility.id);
            data.append("name", this.facility.name);
            data.append("description", this.facility.description);
            const url = `${this.baseUrl}api/facility/update_facility.php`;
            const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
            }
            try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllFacilities(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async deleteFacility(id){
            const data = new FormData();
                data.append("facility_id", id);
                const url = `${this.baseUrl}api/facility/delete_facility.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllFacilities(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async getAllsubAmenities( load = 1){
            console.log(this.sort);
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
    
            const url = `${this.baseUrl}api/sub_amenities/get_all_amenities.php?per_page=${per_page}&page=${page}${search}${sort}`;
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
                    this.all_sub_amenities = response.data.data.amenities;
                    this.kor_page = response.data.data.page;
                    this.kor_total_page= response.data.data.totalPage;
                    this.kor_per_page = response.data.data.per_page;
                    this.kor_total_data = response.data.data.total_data;
                    //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                }else{
                    this.all_sub_amenities = null;
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
        async addSubAmenity( load = 1){
                if (!this.amenity_id || !this.amenities_name || !this.amenities_icon ){
                    this.error = "Insert all Fields"
                    new Toasteur().error(this.error);
                    return;
                }
                const data = new FormData();
                data.append("amenity_id", this.amenity_id);
                data.append("name", this.amenities_name);
                data.append("icon", this.amenities_icon);
                const url = `${this.baseUrl}api/sub_amenities/add_amenities.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllsubAmenities(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async changeSubAmenityEssential(id, status){
            const data = new FormData();
                data.append("amenity_id", id);
                data.append("status", status);
                const url = `${this.baseUrl}api/sub_amenities/change_essential_status.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllsubAmenities(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async changeSubAmenityStatus(id, status){
            const data = new FormData();
                data.append("amenity_id", id);
                data.append("status", status);
                const url = `${this.baseUrl}api/sub_amenities/change_status.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllsubAmenities(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async updatesubAmenity(){
            if (!this.sub_amenity.name || !this.sub_amenity.icon || !this.sub_amenity.amen_id  || !this.sub_amenity.id){
                this.error = "Insert all Fields"
                new Toasteur().error(this.error);
                return;
            }
            const data = new FormData();
            data.append("sub_amenity_id", this.sub_amenity.id);
            data.append("amenity_id", this.sub_amenity.amen_id);
            data.append("name", this.sub_amenity.name);
            data.append("icon", this.sub_amenity.icon);
            const url = `${this.baseUrl}api/sub_amenities/update_amenities.php`;
            const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
            }
            try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllsubAmenities(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async deletesubAmenity(id){
            const data = new FormData();
                data.append("sub_amenity_id", id);
                const url = `${this.baseUrl}api/sub_amenities/delete_amenities.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllsubAmenities();
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async getBookingDetails(load = 1){
            let id = (window.localStorage.getItem("booking_id")) ? window.localStorage.getItem("booking_id") : null 
            
            if (id){
                const url = `${this.baseUrl}api/bookings/getBookingById.php?booking_id=${id}`;
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
                        this.booking_details = response.data.data;
                        // console.log("booking", this.booking_details);
                    }else{
                        this.booking_details = null;
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
            }else{
                window.location.href="./bookings.php";
            }
        },
        async addBooking( load = 1){
            
            if (!this.first_name || !this.last_name || !this.gender || !this.phone || !this.email || !this.apartment_booked || !this.apartment_price
                 || !this.address || !this.occupation_or_work || !this.preferred_check_in || !this.prefferred_check_out || !this.no_of_people
                 || !this.payment_status || !this.identification_type || !this.kor_file ){
                this.error = "Insert all Fields"
                new Toasteur().error(this.error);
                return;
            }

            if ( !validatePhoneNumber(this.phone) ){
                this.error = "Invalid Phone Number"
                new Toasteur().error(this.error);
                return;
            }

            const verifiedPhone = validatePhoneNumber(this.phone)
            const data = new FormData();
            data.append("first_name", this.first_name);
            data.append("last_name", this.last_name);
            data.append("gender", this.gender);
            data.append("phone", verifiedPhone);
            data.append("email", this.email);
            data.append("apartment_id", this.apartment_booked);
            data.append("apartment_price", this.apartment_price);
            data.append("address", this.address);
            data.append("occupation_or_workplace", this.occupation_or_work);
            data.append("preferred_check_in", this.preferred_check_in);
            data.append("prefferred_check_out", this.prefferred_check_out);
            data.append("total_amount_paid", this.total_payment);
            data.append("no_of_people", this.no_of_people);
            // data.append("max_people", this.max_people);
            data.append("payment_status", this.payment_status);
            data.append("identification_type", this.identification_type);
            data.append("identification_img", this.kor_file);
            data.append("customer_note", this.customer_note);
            
            const url = `${this.baseUrl}api/bookings/add_booking.php`;
            const options = {
                method: "POST",
                headers: { 
                    "Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url,
                data
            }
            try {
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    setTimeout(()=> {
                        window.location.href="./bookings.php"
                    }, 2000);
                    //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                        // // window.location.href="./login.php"
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
        async changePaymentStatus(id, status){
            const data = new FormData();
                data.append("booking_id", id);
                data.append("status", status);
                const url = `${this.baseUrl}api/bookings/change_payment_status.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllBookings(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async updateBooking(){
            let id = (window.localStorage.getItem("booking_id")) ? window.localStorage.getItem("booking_id") : null 
            
            if (id){
                console.log(this.booking_details);
                if (!this.booking_details.first_name || !this.booking_details.last_name || !this.booking_details.gender || !this.booking_details.phone || !this.booking_details.email || !this.booking_details.apartment_id || !this.booking_details.apartment_price
                    || !this.booking_details.address || !this.booking_details.occupation_or_workplace || !this.booking_details.preferred_check_in || !this.booking_details.prefferred_check_out || !this.booking_details.no_of_people || !this.booking_details.identification_type){
                   this.error = "Insert all Fields"
                   new Toasteur().error(this.error);
                   return;
                }
    
                if ( !this.booking_details.identification_img && !this.kor_file){
                    this.error = "Kindly Upload an Image"
                    new Toasteur().error(this.error);
                    return;
                }
    
               if ( !validatePhoneNumber(this.booking_details.phone) ){
                   this.error = "Invalid Phone Number"
                   new Toasteur().error(this.error);
                   return;
               }
    
               const verifiedPhone = validatePhoneNumber(this.booking_details.phone);
               const data = new FormData();
               data.append("booking_id", id);
               data.append("first_name", this.booking_details.first_name);
               data.append("last_name", this.booking_details.last_name);
               data.append("gender", this.booking_details.gender);
               data.append("phone", verifiedPhone);
               data.append("email", this.booking_details.email);
               data.append("apartment_id", this.booking_details.apartment_id);
               data.append("apartment_price", this.booking_details.apartment_price);
               data.append("address", this.booking_details.address);
               data.append("occupation_or_workplace", this.booking_details.occupation_or_workplace);
               data.append("preferred_check_in", this.booking_details.preferred_check_in);
               data.append("prefferred_check_out", this.booking_details.prefferred_check_out);
               data.append("total_amount_paid", this.booking_details.total_amount_paid);
               data.append("no_of_people", this.booking_details.no_of_people);
            //    data.append("max_people", this.booking_details.max_people);
               data.append("identification_type", this.booking_details.identification_type);
               data.append("customer_note", this.booking_details.customer_note);
               if ( this.kor_file ){
                 data.append("identification_img", this.kor_file);
               }else{
                data.append("identification_img", this.booking_details.identification_img );
               }
               const url = `${this.baseUrl}api/bookings/update_booking.php`;
               const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                        const response = await axios(options);
                        if(response.data.status){
                            this.success = response.data.text;
                            new Toasteur().success(this.success);
                            setTimeout(()=> {
                                window.location.href="./bookings.php"
                            }, 2000);
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
                                // // window.location.href="./login.php"
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

            }else{
                window.location.href="./bookings.php";
            }
        },
        async deleteBooking(id){
            const data = new FormData();
                data.append("sub_amenity_id", id);
                const url = `${this.baseUrl}api/sub_amenities/delete_amenities.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllsubAmenities();
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async getAllHosttype( load = 1){
            console.log(this.sort);
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
    
            const url = `${this.baseUrl}api/host_type/get_all_host_type.php?per_page=${per_page}&page=${page}${search}${sort}`;
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
                    this.all_host_type = response.data.data.host_types;
                    this.kor_page = response.data.data.page;
                    this.kor_total_page= response.data.data.totalPage;
                    this.kor_per_page = response.data.data.per_page;
                    this.kor_total_data = response.data.data.total_data;
                    //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                }else{
                    this.all_host_type = null;
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
        async addHostType( load = 1){
                if (!this.host_type_name){
                    this.error = "Insert all Fields"
                    new Toasteur().error(this.error);
                    return;
                }
                const data = new FormData();
                data.append("name", this.host_type_name);
                
                const url = `${this.baseUrl}api/host_type/add_host_type.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllHosttype(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async changeHostTypeStatus(id, status){
            const data = new FormData();
                data.append("host_type_id", id);
                data.append("status", status);
                const url = `${this.baseUrl}api/host_type/change_status.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllHosttype(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async updateHostType(){
            if (!this.hosts.name ||  !this.hosts.id){
                this.error = "Insert all Fields"
                new Toasteur().error(this.error);
                return;
            }
            const data = new FormData();
            data.append("host_type_id", this.hosts.id);
            data.append("name", this.hosts.name);
            
            const url = `${this.baseUrl}api/host_type/update_host_type.php`;
            const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
            }
            try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllHosttype(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async deleteHostType(id){
            const data = new FormData();
                data.append("host_type_id", id);
                const url = `${this.baseUrl}api/host_type/delete_host_type.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllHosttype(3);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async getAllbuildingSubTypes( load = 1){
            console.log(this.sort);
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
    
            const url = `${this.baseUrl}api/sub_building_type/get_all_sub_type.php?per_page=${per_page}&page=${page}${search}${sort}`;
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
                    this.all_sub_building_types = response.data.data.build_subtype;
                    this.kor_page = response.data.data.page;
                    this.kor_total_page= response.data.data.totalPage;
                    this.kor_per_page = response.data.data.per_page;
                    this.kor_total_data = response.data.data.total_data;
                    //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                }else{
                    this.all_sub_building_types = null;
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
        async addBuildingSubType(load = 1){
                if (!this.building_type_id || !this.sub_building_type_name || !this.sub_building_type_description){
                    this.error = "Insert all Fields"
                    new Toasteur().error(this.error);
                    return;
                }
                const data = new FormData();
                data.append("building_type_id", this.building_type_id);
                data.append("name", this.sub_building_type_name);
                data.append("description", this.sub_building_type_description);
                
                const url = `${this.baseUrl}api/sub_building_type/add_sub_building_type.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllbuildingSubTypes(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async changeBuildingSubType(id, status){
            const data = new FormData();
                data.append("sub_type_id", id);
                data.append("status", status);
                const url = `${this.baseUrl}api/sub_building_type/change_status.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllbuildingSubTypes(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async updateBuildingSubType(){
            if (!this.sub_building_type.name ||  !this.sub_building_type.build_type ||  !this.sub_building_type.description ){
                this.error = "Insert all Fields"
                new Toasteur().error(this.error);
                return;
            }
            const data = new FormData();
            data.append("sub_type_id", this.sub_building_type.id);
            data.append("building_type_id", this.sub_building_type.build_type);
            data.append("name", this.sub_building_type.name);
            data.append("description", this.sub_building_type.description);
            
            const url = `${this.baseUrl}api/sub_building_type/update_sub_building_type.php`;
            const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
            }
            try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllbuildingSubTypes(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async deleteBuildingSubType(id){
            const data = new FormData();
                data.append("sub_type_id", id);
                const url = `${this.baseUrl}api/sub_building_type/delete_sub_building.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllbuildingSubTypes(3);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async getAllCurrency( load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
    
            const url = `${this.baseUrl}api/listing_currency/get_all_currency.php?per_page=${per_page}&page=${page}${search}${sort}`;
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
                    this.all_currencies = response.data.data.all_currencies;
                    this.kor_page = response.data.data.page;
                    this.kor_total_page= response.data.data.totalPage;
                    this.kor_per_page = response.data.data.per_page;
                    this.kor_total_data = response.data.data.total_data;
                    //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                }else{
                    this.all_currencies = null;
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
        async addCurrency(load = 1){
                if (!this.currency_name|| !this.currency_symbol){
                    this.error = "Insert all Fields"
                    new Toasteur().error(this.error);
                    return;
                }
                const data = new FormData();
                data.append("name", this.currency_name);
                data.append("currency_symbol", this.currency_symbol);
                
                const url = `${this.baseUrl}api/listing_currency/add_currency.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllCurrency(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async changeCurrencyStatus(id, status){
            const data = new FormData();
                data.append("currency_id", id);
                data.append("status", status);
                const url = `${this.baseUrl}api/listing_currency/change_currency_status.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllCurrency(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async updateCurrency(){
            if (!this.currency.id ||  !this.currency.name ||  !this.currency.symbol ){
                this.error = "Insert all Fields"
                new Toasteur().error(this.error);
                return;
            }
            const data = new FormData();
            data.append("currency_id", this.currency.id);
            data.append("name", this.currency.name);
            data.append("currency_symbol", this.currency.symbol);
            
            const url = `${this.baseUrl}api/listing_currency/update_currency.php`;
            const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
            }
            try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllCurrency(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async deleteCurrency(id){
            const data = new FormData();
                data.append("currency_id", id);
                const url = `${this.baseUrl}api/listing_currency/delete_currency.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllCurrency(3);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async getAllApartmentCharges( load = 1){
            console.log(this.sort);
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
    
            const url = `${this.baseUrl}api/apartment_additional_charges/get_add_charge.php?per_page=${per_page}&page=${page}${search}${sort}`;
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
                    this.all_apart_charges = response.data.data.apart_add_charges;
                    this.kor_page = response.data.data.page;
                    this.kor_total_page= response.data.data.totalPage;
                    this.kor_per_page = response.data.data.per_page;
                    this.kor_total_data = response.data.data.total_data;
                    //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                }else{
                    this.all_apart_charges = null;
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
        async changeApartcharg(id, status){
            const data = new FormData();
                data.append("apart_add_id", id);
                data.append("status", status);
                const url = `${this.baseUrl}api/apartment_additional_charges/change_status.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllApartmentCharges(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async deleteAmenity(id){
            const data = new FormData();
                data.append("apart_char_id", id);
                const url = `${this.baseUrl}api/apartment_additional_charges/delete_apart_charg.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    this.loading = true;
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllApartmentCharges(7);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async getAllApartments( load = 1, pagination = 1){
            if (pagination == 1){
                let search = (this.search)? `&search=${this.search}`: '';
                let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
                let page = ( this.kor_page )? this.kor_page : 1;
                let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
        
                const url = `${this.baseUrl}api/apartments/getallApartments.php?per_page=${per_page}&page=${page}${search}${sort}`;
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
                        this.all_apartments = response.data.data.apartments;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                    }else{
                        this.all_apartments = null;
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
            }else{
                const url = `${this.baseUrl}api/apartments/getApartments.php`;
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
                        this.all_apartments = response.data.data.apartments;
                    }else{
                        this.all_apartments = null;
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
            }
            
        },
        async getApartmentById(load = 1){
            let id = (window.localStorage.getItem("apart_id")) ? window.localStorage.getItem("apart_id") : null 
            
            if (id){
                const url = `${this.baseUrl}api/apartments/getApartmentsById.php?apartment_id=${id}`;
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
                        this.apartment_details = response.data.data.apartment;
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                    }else{
                        this.apartment_details = null;
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
            }else{
                window.location.href="./all_apartments.php"
            }
        },
        async getApartmentTransactions(load = 1){
            let id = (window.localStorage.getItem("apart_id")) ? window.localStorage.getItem("apart_id") : null 
            
            if (id){
                const url = `${this.baseUrl}api/apartments/getApartmentTransactions.php?apartment_id=${id}`;
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
                        this.apartment_transactions = response.data.data.apartment_transaction;
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                    }else{
                        this.apartment_transactions = null;
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
            }else{
                window.location.href="./all_apartments.php"
            }
        },
        async getApartmentHouseRules(load = 1){
            let id = (window.localStorage.getItem("apart_id")) ? window.localStorage.getItem("apart_id") : null 
            
            if (id){
                const url = `${this.baseUrl}api/houseRule/getApartmentRule.php?apartment_id=${id}`;
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
                        this.apartment_rules = response.data.data.houseRules;
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                    }else{
                        this.apartment_rules = null;
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
            }else{
                window.location.href="./all_apartments.php"
            }
        },
        async getAllApartmentAndImages(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
    
            const url = `${this.baseUrl}api/apartments/get_apartment_images.php?per_page=${per_page}&page=${page}${search}${sort}`;
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
                    this.apartments_and_images = response.data.data.images;
                    this.kor_page = response.data.data.page;
                    this.kor_total_page= response.data.data.totalPage;
                    this.kor_per_page = response.data.data.per_page;
                    this.kor_total_data = response.data.data.total_data;
                    //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                }else{
                    this.apartments_and_images = null;
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
        async getApartmentImagesById(load = 1){
            let id = (window.localStorage.getItem("apart_id")) ? window.localStorage.getItem("apart_id") : null 
            
            if (id){
                const url = `${this.baseUrl}api/apartments/get_apartment_imagesByApartment.php?apartment_id=${id}`;
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
                        this.apartment_images = response.data.data.images;
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                    }else{
                        this.apartment_images = null;
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
            }else{
                window.location.href="./all_apartments.php"
            }
        },
        async getApartmentFacilitiesById(load = 1){
            let id = (window.localStorage.getItem("apart_id")) ? window.localStorage.getItem("apart_id") : null 
            
            if (id){
                const url = `${this.baseUrl}api/apartments/get_apartment_facilitiesByApartment.php?apartment_id=${id}`;
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
                        this.apartment_facilities = response.data.data.facilities;
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                    }else{
                        this.apartment_facilities = null;
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
            }else{
                window.location.href="./all_apartments.php"
            }
        },
        async getApartmentAdditionalChargesById(load = 1){
            let id = (window.localStorage.getItem("apart_id")) ? window.localStorage.getItem("apart_id") : null;
            console.log()
            
            if (id){
                const url = `${this.baseUrl}api/apartment_additional_charges/get_add_chargeByApartment.php?apartment_id=${id}`;
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
                        this.apartment_charges = response.data.data.apartment_charges;
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                    }else{
                        this.apartment_charges = null;
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
            }else{
                window.location.href="./all_apartments.php"
            }
        },
        async changeApartStatus(id, status){
            const data = new FormData();
                data.append("apartment_id", id);
                data.append("status", status);
                const url = `${this.baseUrl}api/apartments/deactivate_andactivate.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        "Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    url,
                    data
                }
                try {
                    const response = await axios(options);
                    if(response.data.status){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        await this.getAllApartments(6);
                        //console.log("ApiDelivery address", response.data.data.deliveryAddress);
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
                            // // window.location.href="./login.php"
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
        async setPerPage(ins){
            if ( webPage === "room-type.php"){
                this.class_active = true;
                this.kor_per_page = ins;
                await this.getAllbuildingSubTypes(4);
            }
            if ( webPage === "sub_amenities.php"){
                this.class_active = true;
                this.kor_per_page = ins;
                await this.getAllsubAmenities(4);
            }
            if ( webPage === "amenities.php"){
                this.class_active = true;
                this.kor_per_page = ins;
                await this.getAllAmenities(4);
            }
            if ( webPage === "host_type.php"){
                this.class_active = true;
                this.kor_per_page = ins;
                await this.getAllHosttype(4);
            }
            if ( webPage === "all_apartments.php" ){
                this.class_active = true;
                this.kor_per_page = ins;
                await this.getAllApartments(4);
            }
            if ( webPage === "facilities.php" ){
                this.class_active = true;
                this.kor_per_page = ins;
                await this.getAllFacilities(4);
            }
            if ( webPage === "apartment_images.php" ){
                this.class_active = true;
                this.kor_sort = value;
                await this.getAllApartmentAndImages();
            }
            if (webPage === "currency.php"){
                this.class_active = true;
                this.kor_sort = value;
                await this.getAllCurrency(3);
            }
            
        },
        async updateSort(){
            // this.sort = this.addsort;
            console.log(`${this.sort}`);
            console.log("hdhdhdhhd");
        },
            // korede
        async getAllUsers(load = 1){
            let search = (this.kor_search) ? `&search=${this.kor_search}` : ""; 
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/accounts/getAllUsers.php?page=${page}&per_page=${per_page}${search}${sort}`;

            this.kor_total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.users = response.data.data.users;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.users = null
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
                        // // window.location.href="./login.php"
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
        async getLatestUsers(load = 1){    
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/accounts/getAllUsers.php?&per_page=5`;

            this.kor_total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.users = response.data.data.users;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.users = null
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
                        // // window.location.href="./login.php"
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
        async getUser(index){
            this.user = this.users[index]
        },
        async setUserId(id){
            //console.log(id);
            window.localStorage.setItem("user_id", id);
        },
        async getUserDetails(load = 1){
            let shop_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/accounts/getAllUserById.php?user_id=${shop_id}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    this.user_details = response.data.data.user;
                    //console.log(this.user_details);
                }else{
                    this.user_details = null
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
                        // // window.location.href="./login.php"
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
        async getUserBookings(load = 1){
            let shop_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/bookings/getBookingsbyUserId.php?user_id=${shop_id}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    this.user_details = response.data.data.user;
                    //console.log(this.user_details);
                }else{
                    this.user_details = null
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
                        // // window.location.href="./login.php"
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
        async getAgentApartments(load = 1){
            let agent_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/apartments/getApartmentByAgentId.php?agent_id=${agent_id}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    this.agent_apartments = response.data.data.apartment;
                    //console.log(this.user_details);
                }else{
                    this.agent_apartment = null
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
                        // // window.location.href="./login.php"
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
        async getAgentBookings(load = 1){
            let agent_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/bookings/getBookingByAgentId.php?user_id=${agent_id}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    this.agent_bookings = response.data.data.bookings;
                    console.log(this.agent_bookings);
                }else{
                    this.agent_bookings = null
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
                        // // window.location.href="./login.php"
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
        async getAgentTransactions(load = 1){
            let agent_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/transactions/getAgentTransactions.php?userid=${agent_id}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    this.agent_transactions = response.data.data.transactions;
                    console.log(this.agent_transactions);
                }else{
                    this.agent_transactions = null
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
                        // // window.location.href="./login.php"
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
        async getUserOrders(load = 1, loadpage = 1){
            let user_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/order/getUserOrder.php?user_id=${user_id}&page=${page}&noPerPage=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.user_orders = response.data.data.orders;
                        if (loadpage == 1){
                            this.kor_page = response.data.data.page;
                            this.kor_total_page= response.data.data.totalPage;
                            this.kor_per_page = response.data.data.per_page;
                            this.kor_total_data = response.data.data.total_data;
                        }
                        
                    }
                }else{
                    this.user_orders = null
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
                        // // window.location.href="./login.php"
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
        async getOrder(index){
            this.user_order = this.user_orders[index];
        },
        async getUserNotifications(load = 1){
            let user_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/notifications/getNotificationByUserId.php?userid=${user_id}&page=${page}&per_page=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.user_notifications = response.data.data.notification;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.user_notifications = null
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
                        // // window.location.href="./login.php"
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
        async getNotification(index){
            this.user_notification = this.user_notifications[index];
        },
        async getAllUserAddress(load = 1){
            let user_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/deliveryAddress/getUserAddress.php?userid=${user_id}&page=${page}&noPerPage=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.user_addresses = response.data.data.deliveryAddress;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.user_addresses = null
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
                        // // window.location.href="./login.php"
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
        async getAddress(index){
            this.user_address = this.user_addresses[index];
        },
        async getUserTransactions(load = 1, loadpage = 1){
            let user_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/userwallettrans/getTransactionByUserId.php?userid=${user_id}&page=${page}&per_page=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.user_transactions = response.data.data.transactions;
                        if (loadpage == 1 ){
                            this.kor_page = response.data.data.page;
                            this.kor_total_page= response.data.data.totalPage;
                            this.kor_per_page = response.data.data.per_page;
                            this.kor_total_data = response.data.data.total_data;
                        }
                    }
                }else{
                    this.user_transactions = null
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
                        // // window.location.href="./login.php"
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

        async getTransaction(index){
            if ( webPage == "customer-details.php" ){
                this.user_transaction = this.user_transactions[index];
            }

            if ( webPage == "transactions.php" ){
                this.transaction = this.all_transactions[index]
            }
            
        },
        async getUserComplains(load = 1){
            let user_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/complains/getAllUserComplain.php?userid=${user_id}&user_type=4&page=${page}&per_page=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.user_complains = response.data.data.complains;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.user_complains = null
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
                        // // window.location.href="./login.php"
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
        async getUserComplain(index){
            this.user_complain = this.user_complains[index];
        },
        async getOrderAndTransaction(){
            await this.getUserOrders(2, 3);
            await this.getUserTransactions(3, 4)
        },
        async getUserActivities(load = 1){
            let user_email = (this.user_details)? this.user_details.email : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/accounts/getAllUserActivities.php?email=${user_email}&user_type=4&page=${page}&per_page=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.user_activities = response.data.data.totalSession;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.user_activities = null
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
                        // // window.location.href="./login.php"
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
        async getActivity(index){
            this.user_activity = this.user_activities[index];
        },
        async changeUserStatus(user_id, status){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append('user_id', user_id);
            data.append('status', status);

            let url = `${this.baseUrl}api/accounts/changeUserStatus.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllUsers(3);
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
                        // // window.location.href="./login.php"
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
        async deleteUser(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            

            const data = new FormData();
            data.append('userid', id);

            let url = `${this.baseUrl}api/accounts/deleteUser.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllUsers(4);
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
                        // // window.location.href="./login.php"
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
        async kor_remove_sort(){
            this.kor_sort = null;
            if ( webPage === "room-type.php"){
                await this.getAllbuildingSubTypes(4);
            }
            if ( webPage === "sub_amenities.php"){
                await this.getAllsubAmenities(4);
            }
            if ( webPage === "amenities.php"){
                await this.getAllAmenities(4);
            }
            if ( webPage === "host_type.php"){
                await this.getAllHosttype(4);
            }
            if ( webPage === "all_apartments.php" ){
                await this.getAllApartments(4);
            }
            if ( webPage === "facilities.php" ){
                await this.getAllFacilities();
            }
            if ( webPage === "apartment_images.php" ){
                await this.getAllApartmentAndImages();
            }
            if (webPage === "customers.php"){
                await this.getAllUsers(3);
            }
            if (webPage === "currency.php"){
                await this.getAllCurrency(3);
            }
        },
        async kor_add_sort(status){
            this.kor_sort = status;
            if ( webPage === "room-type.php"){
                await this.getAllbuildingSubTypes(4);
            }
            if ( webPage === "sub_amenities.php"){
                await this.getAllsubAmenities(4);
            }
            if ( webPage === "amenities.php"){
                await this.getAllAmenities(4);
            }
            if ( webPage === "host_type.php"){
                await this.getAllHosttype(4);
            }
            if ( webPage === "all_apartments.php" ){
                await this.getAllApartments(4);
            }
            if ( webPage === "facilities.php" ){
                await this.getAllFacilities();
            }
            if ( webPage === "apartment_images.php" ){
                await this.getAllApartmentAndImages();
            }
            if (webPage === "customers.php"){
                await this.getAllUsers(3);
            }
            if (webPage === "currency.php"){
                await this.getAllCurrency(3);
            }
        },
        async nav_nextPage(){
            this.kor_page = parseInt(this.kor_page) + 1;
            if ( webPage === "room-type.php"){
                await this.getAllbuildingSubTypes(4);
            }
            if ( webPage === "sub_amenities.php"){
                await this.getAllsubAmenities(4);
            }
            if ( webPage === "amenities.php"){
                await this.getAllAmenities(4);
            }
            if ( webPage === "host_type.php"){
                await this.getAllHosttype(4);
            }
            if ( webPage === "all_apartments.php" ){
                await this.getAllApartments(4);
            }
            if ( webPage === "facilities.php" ){
                await this.getAllFacilities();
            }
            if ( webPage === "apartment_images.php" ){
                await this.getAllApartmentAndImages();
            }
            if (webPage === "customers.php"){
                await this.getAllUsers();
            }
            if (webPage === "currency.php"){
                await this.getAllCurrency(3);
            }

        },
        async nav_previousPage(){
            this.kor_page = parseInt(this.kor_page) - 1;
            if ( webPage === "room-type.php"){
                await this.getAllbuildingSubTypes(4);
            }
            if ( webPage === "sub_amenities.php"){
                await this.getAllsubAmenities(4);
            }
            if ( webPage === "amenities.php"){
                await this.getAllAmenities(4);
            }
            if ( webPage === "host_type.php"){
                await this.getAllHosttype(4);
            }
            if ( webPage === "all_apartments.php" ){
                await this.getAllApartments(4);
            }
            if ( webPage === "facilities.php" ){
                await this.getAllFacilities();
            }
            if ( webPage === "apartment_images.php" ){
                await this.getAllApartmentAndImages();
            }
            if (webPage === "customers.php"){
                await this.getAllUsers();
            }
            if (webPage === "currency.php"){
                await this.getAllCurrency(3);
            }
        },
        async nav_selectPage(page){
            this.kor_page = page;
            if ( webPage === "room-type.php"){
                await this.getAllbuildingSubTypes(4);
            }
            if ( webPage === "sub_amenities.php"){
                await this.getAllsubAmenities(4);
            }
            if ( webPage === "amenities.php"){
                await this.getAllAmenities(4);
            }
            if ( webPage === "host_type.php"){
                await this.getAllHosttype(4);
            }
            if ( webPage === "all_apartments.php" ){
                await this.getAllApartments(4);
            }
            if ( webPage === "facilities.php" ){
                await this.getAllFacilities();
            }
            if ( webPage === "apartment_images.php" ){
                await this.getAllApartmentAndImages();
            }
            if (webPage === "customers.php"){
                await this.getAllUsers();
            }
            if (webPage === "currency.php"){
                await this.getAllCurrency(3);
            }
        },
        async nav_dynamic_nextPage(item){
            this.kor_page = parseInt(this.kor_page) + 1;
            
            if ( webPage === "room-type.php"){
                await this.getAllbuildingSubTypes(4);
            }
            if ( webPage === "sub_amenities.php"){
                await this.getAllsubAmenities(4);
            }
            if ( webPage === "amenities.php"){
                await this.getAllAmenities(4);
            }
            if ( webPage === "host_type.php"){
                await this.getAllHosttype(4);
            }
            if ( webPage === "all_apartments.php" ){
                await this.getAllApartments(4);
            }
            if ( webPage === "facilities.php" ){
                await this.getAllFacilities();
            }
            if ( webPage === "apartment_images.php" ){
                await this.getAllApartmentAndImages();
            }
            if (webPage === "customers.php"){
                await this.getAllUsers();
            }
            if (webPage === "currency.php"){
                await this.getAllCurrency(3);
            }
        },
        async nav_dynamic_previousPage(item){
            this.kor_page = parseInt(this.kor_page) - 1;

            if ( webPage === "room-type.php"){
                await this.getAllbuildingSubTypes(4);
            }
            if ( webPage === "sub_amenities.php"){
                await this.getAllsubAmenities(4);
            }
            if ( webPage === "amenities.php"){
                await this.getAllAmenities(4);
            }
            if ( webPage === "host_type.php"){
                await this.getAllHosttype(4);
            }
            if ( webPage === "all_apartments.php" ){
                await this.getAllApartments(4);
            }
            if ( webPage === "facilities.php" ){
                await this.getAllFacilities();
            }
            if ( webPage === "apartment_images.php" ){
                await this.getAllApartmentAndImages();
            }
            if (webPage === "customers.php"){
                await this.getAllUsers();
            }
            if (webPage === "currency.php"){
                await this.getAllCurrency(3);
            }
        },
        async nav_dynamic_selectPage(item ,page){
            this.kor_page = page;
            
            if ( webPage === "room-type.php"){
                await this.getAllbuildingSubTypes(4);
            }
            if ( webPage === "sub_amenities.php"){
                await this.getAllsubAmenities(4);
            }
            if ( webPage === "amenities.php"){
                await this.getAllAmenities(4);
            }
            if ( webPage === "host_type.php"){
                await this.getAllHosttype(4);
            }
            if ( webPage === "all_apartments.php" ){
                await this.getAllApartments(4);
            }
            if ( webPage === "facilities.php" ){
                await this.getAllFacilities();
            }
            if ( webPage === "apartment_images.php" ){
                await this.getAllApartmentAndImages();
            }
            if (webPage === "customers.php"){
                await this.getAllUsers(3);
            }
            if (webPage === "currency.php"){
                await this.getAllCurrency(3);
            }
            
        },
        getlastElemnt(item){
            const split_arr = item.split("-");
            const len = split_arr.length;
            return split_arr[len - 1]; 
        },
        async wordCount(length){
            this.length = WordCount(this.slider_desc);
            if ( this.length == length ){
                new Toasteur().error("Maximum Words Reached");
            }
        },
        async logout(){
            window.localStorage.removeItem("authToken");
            // // window.location.href="./login.php"
        }, 
        async setSort(value){
            if ( webPage === "room-type.php"){
                this.class_active = true;
                this.kor_sort = value;
                await this.getAllbuildingSubTypes(4);
            }
            if ( webPage === "sub_amenities.php"){
                this.class_active = true;
                this.kor_sort = value;
                await this.getAllsubAmenities(4);
            }
            if ( webPage === "amenities.php"){
                this.class_active = true;
                this.kor_sort = value;
                await this.getAllAmenities(4);
            }
            if ( webPage === "host_type.php"){
                this.class_active = true;
                this.kor_sort = value;
                await this.getAllHosttype(4);
            }
            if ( webPage === "all_apartments.php" ){
                this.class_active = true;
                this.kor_sort = value;
                await this.getAllApartments(4);
            }
            if ( webPage === "facilities.php" ){
                this.class_active = true;
                this.kor_sort = value;
                await this.getAllFacilities();
            }
            if ( webPage === "apartment_images.php" ){
                this.class_active = true;
                this.kor_sort = value;
                await this.getAllApartmentAndImages(5);
            }   
            if (webPage === "currency.php"){
                this.class_active = true;
                this.kor_sort = value;
                await this.getAllCurrency(3);
            } 
            
        },
        setApartId(id){
            if ( webPage == "all_apartments.php" ){
                window.localStorage.setItem("apart_id", id);
            }
            
        },
        logResponse(){
            console.log(`checking: ${this.systemSettings.activePaymentCode}`);
        }       
    },
    beforeMount(){
        this.loading = true;
    },
    async mounted(){
        //lanre mount
        // if(webPage != "subBuilding_by_buildingTypeid.php"){
        //     window.localStorage.removeItem("buildingTypeid");
        // }
        await this.getAdminDetails();
        // this.getToken();
        if ( webPage === "amenities.php" ){
            await this.getAllAmenities(4)
        }
        if ( webPage === "sub_amenities.php" ){
            await this.getAllsubAmenities(4);
            await this.getAllAmenities(4);
        }
        if ( webPage === "host_type.php" ){
            await this.getAllHosttype(4)
        }
        if ( webPage === "room-type.php" ){
            await this.getAllbuildingSubTypes(4);
            await this.getAllBuildingType(4);
        }
        if ( webPage === "all_apartments.php" ){
            await this.getAllApartments();
        }
        if ( webPage === "apartment-details.php" ){
            await this.getApartmentById();
        }
        if ( webPage === "facilities.php" ){
            await this.getAllFacilities();
        }
        if ( webPage === "apartment_images.php" ){
            await this.getAllApartmentAndImages();
        }
        if ( webPage === "booking-add.php" || webPage === "booking-edit.php"){
            await this.getAllApartments(3,3);
        }

        if ( webPage === "booking-edit.php"){
            await this.getBookingDetails();
            this.fetchPartmentWithPrice();
        }

        if (webPage !== "all_apartments.php" && webPage !== "apartment-details.php"){
            window.localStorage.removeItem("apart_id");
        }
        if (webPage === "customers.php"){
            await this.getAllUsers();
        }
        if (webPage === "customer-details.php"){
            await this.getUserDetails();
        }
        if (webPage === "currency.php"){
            await this.getAllCurrency();
        }
        if (webPage === "transactions.php"){
            await this.getAllTransactions();
        }

    }

});

admin.mount('#admin');