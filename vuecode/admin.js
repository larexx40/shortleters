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
            buildingTypes: null,
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
            readMoreUrl: null,
            itemid: null,
            name: null,
            image: null,
            icon: null,
            description: null,
            itemDetails: null,

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
            authToken: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE2NjMyMzI4MDIsImlzcyI6IkxPRyIsIm5iZiI6MTY2MzIzMjgwMiwiZXhwIjoxNjYzMzA2NjAyLCJ1c2VydG9rZW4iOiJDTkdVYWRtaW4ifQ.9WGnXtg2lD8krebtCRLyKqiTkiLM-wkstk2CDwTK1diZ1zR_ZpVBBzFHRg9qNetrePNGvNHMJJ5Pg00iEqseMQ",
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
            all_apart_charges: null,
            all_apartments: null,
            apartment_details: null,
            apartment: null,
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
            //get adminid from localstorage
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
            await this.getAllSubBuildingTypeByBuildingTypeid(buildingTypeid);
        }
    },
    methods: {
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
        async getAllSubBuildingTypeByBuildingTypeid(id){
            //const url = `${this.baseUrl}api/guestSafety/getGuestSafetyByid.php?guestSafetyid=${id}`;
            const url = `${this.baseUrl}api/sub_building_type/getSubByBuildingid.php?buildingTypeid=${id}`;
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
                    this.addresses = response.data.data.build_subtype;
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
        async changeAdminStatus(id){
            let data = new FormData();
            data.append('id', id );

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
        },
        async noSort(){
            this.loading = true
            this.sort = null;
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
            console.log("sort", this.sort);
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
                window.location.href=`admin-details.php?`;
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
        },
        async generateUserPassword(){
            this.newPassword = generatePassword();
        },
        //end of LanreWaju methods

        // Korede's Functions
        async generatePass(){
            this.shop_password = generatePassword();
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
            //console.log(this.shop_product)
        },
        // korede
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
        async getAllApartments( load = 1){
            console.log(this.sort);
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
        },
        async updateSort(){
            // this.sort = this.addsort;
            console.log(`${this.sort}`);
            console.log("hdhdhdhhd");
        },
            // korede
        async setShopId(id){
            //console.log(id);
            window.localStorage.setItem("shop_id", id);
        },
        async getShopDetails(load = 1){
            let shop_id = (window.localStorage.getItem("shop_id"))? window.localStorage.getItem("shop_id") : "";

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/shops/getShopById.php?shop_id=${shop_id}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    this.shop_details = response.data.data.shop;
                    //console.log(this.shop_details);
                }else{
                    this.shop_details = null
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
        async getShopLocations(load = 1){
            let shop_id = (window.localStorage.getItem("shop_id"))? window.localStorage.getItem("shop_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/shops/getAllShopLocation.php?shopid=${shop_id}&page=${page}&per_page=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.shop_locations = response.data.data.Location;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.shop_locations = null
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
        async getShopLocation(index){
            this.shop_location = this.shop_locations[index];
            //console.log(this.shop_location);
        },
        async getShopProducts(load = 1){
            let shop_id = (window.localStorage.getItem("shop_id"))? window.localStorage.getItem("shop_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/product/getAllShopProducts.php?shop_id=${shop_id}&page=${page}&per_page=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.shop_products = response.data.data.products;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.shop_locations = null
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
        async getProduct(index){
            this.shop_product = this.shop_products[index];
            //console.log(this.shop_product)
        },
        async changeShopStatus(shop_id, status){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append('shop_id', shop_id);
            data.append('status', status);

            let url = `${this.baseUrl}api/shops/changeShopStatus.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllShops();
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
        async deleteShop(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            

            const data = new FormData();
            data.append('shop_id', id);

            let url = `${this.baseUrl}api/shops/deleteShop.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllSliders(7);
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
        async getAllTransactions(load = 1, loadpage = 1){
            let search = (this.kor_search) ? `&search=${this.kor_search}` : ""; 
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/userwallettrans/getAllTransaction.php?page=${page}&per_page=${per_page}${search}${sort}`;

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
        async getAllProducts(load = 1, show_page = 1){
            let type;
            let search = (this.kor_search) ? `&search=${this.kor_search}` : ""; 
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 8;

            if (this.kor_sorttype && this.kor_sort){
                type = `&sorttype=${this.kor_sorttype}`;
           } 
           if ( this.kor_sorttype && !this.kor_sort ){
               type = `&sort=1&sorttype=${this.kor_sorttype}`;
           }
           if (!this.kor_sorttype){
               type = "";
           }
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/product/getAllProducts.php?page=${page}&per_page=${per_page}${search}${sort}${type}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.all_products = response.data.data.products;
                        if (show_page == 1){
                            this.kor_page = response.data.data.page;
                            this.kor_total_page= response.data.data.totalPage;
                            this.kor_per_page = response.data.data.per_page;
                            this.kor_total_data = response.data.data.total_data;
                        }
                    }
                }else{
                    this.all_products = null
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
        async get_product(index){
            this.product = this.all_products[index];
            //console.log(this.product);
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
        async deleteProduct(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            

            const data = new FormData();
            data.append('product_id', id);

            let url = `${this.baseUrl}api/product/getAllProducts.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllProducts(4);
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
            
        },
        setApartId(id){
            if ( webPage == "all_apartments.php" ){
                window.localStorage.setItem("apart_id", id);
            }
            
        }       
    },
    beforeMount(){
        this.loading = true;
    },
    async mounted(){
        //lanre mount
        if(webPage != "subBuilding_by_buildingTypeid.php"){
            window.localStorage.removeItem("buildingTypeid");
        }
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

        if (webPage !== "all_apartments.php" || webPage !== "apartment-details.php"){
            window.localStorage.removeItem("apart_id");
        }
    }

});

admin.mount('#admin');