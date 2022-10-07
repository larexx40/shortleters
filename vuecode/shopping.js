const urlPath = window.location.pathname.split("/");
const length = urlPath.length;
const webPage = urlPath[length -1];

let app = Vue.createApp({
    data(){
        return {
            //lanre's data
            review: null,
            rateStar: null,
            reviewer: null,
            topProductOrdered: null,
            topProductOrderedByCategory: null,
            topCategories: null,
            categoryName: null,
            subCategories: null,
            firstCategoryid: null,
            firstCategoryName: null,
            firstCategoryProducts: null,
            topCategoryProducts: null,
            trending_products: null,
            div_loading: false,
            //end of lanre's data
            baseurl: "http://localhost/cart.ng2/",
            categories: null,
            search: null,
            cat_id: null,
            loading: null,
            kor_product_details: null,
            related_products : null,
            qty_purchased: 1,
            logistics_price: 300,
            total_with_logistics: 0,
            kor_total_page: null,
            kor_page: null,
            kor_per_page: null,
            kor_total_data: null,
            all_products: null,
            featured_products: null,
            discount_products: null,
            top_rated_products: null,
            top_categories_product: null,
            brand_images: null,
            sliders: null,
            error: null,
            cart_data: null,
            cart_total_amount: null,
            user_email: null,
            user_password: null,
            user_details: null,
            addresses: null,
            authToken: null,
        }
    },
    async created() {
        if(webPage == "home-v3.php"){
            await this.getTopCategories();
            await this.getTopProductOrdered();
        }
        if(webPage == "product-categories-7-column-full-width.php"){
            const categoryid = (window.localStorage.getItem("categoryid"))? window.localStorage.getItem("categoryid") : null;
            console.log("page categoryid", categoryid);
            await this.getSubCategoriesByCategoryid(categoryid);
            await this.getTopProductOrderedByCategoryid(categoryid);
        }
    },
    methods: {
        //lanreWaju's method
        async getTopCategories(){
            const url = `${this.baseurl}api/product/topCategories.php`;
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
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    this.topCategories=response.data.data.topCategory;
                    this.top_categories_product = response.data.data.products;  
                    this.firstCategoryid = response.data.data.firstCategoryid;
                    this.firstCategoryName = response.data.data.firstCategoryName;
                    this.getProductsByTopCategoryid(this.firstCategoryid) 
                    console.log("firstCategoryName", this.firstCategoryName);
                    console.log("firstCategoryid", this.firstCategoryid);
                    console.log("top_categories_product", this.top_categories_product);

                }else{
                    this.topCategories= null;
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
                        return
                    }
    
                    if (error.response.status == 405){
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
        async getProductByCategoryid(id){
            //console.log("blog", id);
            const url = `${this.baseurl}api/product/getProductByCategoryid.php?categoryid=${id}`;
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
                    this.categoryProducts= response.data.data.products;
                    //console.log(response.data.data);
                }else{
                    this.categoryProducts=null;
                    //maybe get all product instead;
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
                        return
                    }
    
                    if (error.response.status == 405){
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
        async getProductsByTopCategoryid(id){
            console.log("categoryid", id);
            const url = `${this.baseurl}api/product/getAllProductsByCategoryid.php?categoryid=${id}?sortstatus=1`;
            console.log("url", url);
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
                    this.topCategoryProducts= response.data.data.products;
                    //console.log(response.data.data);
                }else{
                    this.topCategoryProducts=null;
                    //maybe get all product instead;
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
                        return
                    }
    
                    if (error.response.status == 405){
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
        async getTopProductOrdered(){
            const url = `${this.baseurl}api/order/topProductOrdered.php?`;
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
                this.loading = true;
                const response = await axios(options);
                this.topProductOrdered=null
                if(response.data.status){
                    this.topProductOrdered=response.data.data.topProduct;  
                    console.log("topProductOrdered", response.data.data.topProduct);

                }else{
                    this.topProductOrdered= null;
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
                        return
                    }
    
                    if (error.response.status == 405){
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
        async getTopProductOrderedByCategoryid(id){
            console.log("categoryid", id);
            const url = `${this.baseurl}api/order/topProductOrderedByCategoryid.php?categoryid=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.div_loading = true
                this.topProductOrderedByCategory = null;
                const response = await axios(options);
                if(response.data.status){
                    this.topProductOrderedByCategory=response.data.data.topProduct;  
                    console.log("topProductOrdered", response.data.data.topProduct);

                }else{
                    this.topProductOrderedByCategory= null;
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
                        return
                    }
    
                    if (error.response.status == 405){
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
                this.div_loading = false;
            }
        },
        async getTrendingProduct(){
            //console.log("blog", id);
            const url = `${this.baseurl}api/order/topProductOrdered.php?noOfProduct=20`;
            const options = {
                method: "GET",
                headers: { 
                    "Content-type": "application/json",
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.trending_products = response.data.data.topProduct;
                }else{
                    this.trending_products=null;
                    //maybe get all product instead;
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
                        return
                    }
    
                    if (error.response.status == 405){
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
        async addReview(){
            const product_id = (window.localStorage.getItem("product_id"))? window.localStorage.getItem("product_id") : null;
            if(this.review == null ||this.rateStar == null){
                new Toasteur().error("Kindly fill all fields")
            }
            const input={
                reviewer: this.user_details.userid,
                review: this.review,
                ratestar: this.rateStar,
                productid: product_id
            }
            console.log("input", input);

            let data = new FormData();

            data.append('rateStar', this.rateStar );
            data.append('review', this.review );
            data.append('productid', product_id );

            const url = `${this.baseurl}api/review/addReview.php?`;

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
            }finally {
                this.loading = false;
            }
        },
        async getSubCategoriesByCategoryid(id){
            const url = `${this.baseurl}api/product/getSubcategoryByCategoryid.php?cat_id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    // //"Content-type": "application/json",
                    // "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.subCategories= response.data.data.subCategory;
                    this.categoryName= response.data.data.categoryName;
                    console.log("cAT_name", response.data.data.categoryName);
                    console.log("sub_cat", response.data.data.subCategory);
                }else{
                    this.subCategories=null;
                    this.categoryName = null;
                    console.log("categoryBycat failed");
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
                        return
                    }
    
                    if (error.response.status == 405){
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
        //end of lanreWaju's method
        //utilities
        async getIndex(index){
            console.log("arrayIndex", index);    
            if(webPage == 'location.php'){
                this.itemDetails = this.logisticLocations[index];
            }
        },
        async setCategoryId(id){
            console.log("categoryid",id);
            window.localStorage.setItem("categoryid", id);
        },
        //end of utilities
        async getAllCategories(){
            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/product/getAllCategoriesAndSub.php`);

                if ( response.data.status ){
                    this.categories = response.data.data.categories;
                }else{
                    this.categories = null;
                }
                
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    // if (error.response.status == 401){
                    //     this.error = "User not Authorized";
                    //     new Toasteur().error(this.error);
                    //     // window.location.href ="../login.php";
                    //     return
                    // }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }else{
                    this.error = error.message || "Error Processing Request"
                    swal(this.error);
                }
            }finally{
                this.loading = false
            }
        },
        async getAllProducts(load = 1){
            let search = (this.search) ? `&search=${this.search}` : ""; 
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 10;

            

            let url = `${this.baseurl}api/product/getShopPageProducts.php?page=${page}&per_page=${per_page}${search}`;

            this.kor_total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url);
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.all_products = response.data.data.products;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page = response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;   
                    }
                }else{
                    this.all_products = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async getFeaturedProducts(load = 1){
        
            let url = `${this.baseurl}api/product/get_all_featured_product.php`;

            this.kor_total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url);
                if ( response.data.status ){
                    this.featured_products = response.data.data.products;
                    console.log(this.featured_products);
                }else{
                    this.featured_products = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async getDiscountProducts(load = 1){
        
            let url = `${this.baseurl}api/product/get_all_discount_product.php`;

            this.kor_total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url);
                if ( response.data.status ){
                    this.discount_products = response.data.data.products;
                    console.log(this.featured_products);
                }else{
                    this.discount_products = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async getTopRatedProducts(load = 1){
        
            let url = `${this.baseurl}api/product/top_rated.php`;

            this.kor_total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url);
                if ( response.data.status ){
                    this.top_rated_products = response.data.data.products;
                }else{
                    this.top_rated_products = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async getAllBrandImages(load = 1){
        
            let url = `${this.baseurl}api/product/getAllBrandImage.php`;

            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url);
                if ( response.data.status ){
                    this.brand_images = response.data.data.brand_image;
                }else{
                    this.brand_images = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async getAllSliders(load = 1){
            let url = `${this.baseurl}api/slider/getAllShopSlider.php`;

            this.kor_total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url);
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.sliders = response.data.data.sliders;

                        // $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');
                    }
                }else{
                    this.sliders = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async setProductId(id){
            console.log(id);
            window.localStorage.setItem("product_id", id);
        },
        
        async removeProductId(){
            window.localStorage.removeItem("product_id");
        },
        async getProductDetails(load = 1){
            const product_id = (window.localStorage.getItem("product_id"))? window.localStorage.getItem("product_id") : null;

            if (!product_id){
                window.location.href="home.php";
                return;
            }
            

            let url = `${this.baseurl}api/product/getShopPageProductById.php?product_id=${product_id}`;

            this.kor_total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url);
                if ( response.data.status ){
                    this.kor_product_details = response.data.data.product;
                    if (response.data.data.product.related.length >= 1 ){
                        this.related_products = response.data.data.product.related
                    }else{
                        this.related_products = null
                    }  
                }else{
                    this.kor_product_details = null
                }
                
                this.getCart();
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async addToCart(name, product_id, price, image, qty_available){
            if (this.qty_purchased <= qty_available && this.qty_purchased >= 1){
                let total_amount = parseInt(this.qty_purchased) * price;
                var existing_cart = (window.localStorage.getItem("cart"))? JSON.parse(window.localStorage.getItem("cart")) : [];
                
                if ( existing_cart.length > 0 ){
                    const isFound = existing_cart.some(element => {
                        if (element.product_id === product_id) {
                        return true;
                        }
                    
                        return false;
                    });

                    

                    if (isFound){
                        existing_cart = existing_cart.map(element => {
                            if (element.product_id === product_id) {
                            return {...element, name: name, qty: this.qty_purchased, price: price, total_amount: total_amount , image: image, qty_available: qty_available };
                            }
                            
                            return element
                        });

                    localStorage.setItem("cart", JSON.stringify(existing_cart));

                    }else{
                        let newItem = {
                            product_id: product_id,
                            name : name,
                            qty: this.qty_purchased,
                            price: price,
                            total_amount: total_amount,
                            image: image,
                            qty_available: qty_available
                        }
                        existing_cart.push(newItem);
                        localStorage.setItem("cart", JSON.stringify(existing_cart));
                    }


                }else{
                let newItem = {
                        product_id: product_id,
                        name : name,
                        qty: this.qty_purchased,
                        price: price,
                        total_amount: total_amount,
                        image: image,
                        qty_available: qty_available
                    }
                    existing_cart.push(newItem);
                    localStorage.setItem("cart", JSON.stringify(existing_cart));
                }

                new Toasteur().success(`${name} successfully added to cart`);
                await this.getProductDetails(3);
            }
        },
        async getCart(){
            this.cart_data = (window.localStorage.getItem("cart"))? JSON.parse(window.localStorage.getItem("cart")): null;
            if (this.cart_data){
                this.cart_data = (this.cart_data.length < 1) ? null : this.cart_data;
            }

            if (this.cart_data){
                sum = 0;

                for (var i = 0; i < this.cart_data.length; i++){
                    sum+= this.cart_data[i].total_amount;
                }

                this.cart_total_amount = sum;
            }else{
                this.cart_total_amount = 0;
            }

        },
        async removeFromCart(index){
            let cart_item = this.cart_data[index];
            let name = cart_item.name;
            console.log(cart_item);
            var existing_cart = (window.localStorage.getItem("cart"))? JSON.parse(window.localStorage.getItem("cart")) : null;

            console.log(existing_cart);


            if (existing_cart.length > 0){
                let updated = existing_cart.findIndex(function(item) {
                    return item.product_id === cart_item.product_id
                });

                existing_cart.splice(updated, 1);


                localStorage.setItem("cart", JSON.stringify(existing_cart));
                new Toasteur().success(`${name} successfully removed from cart`);
                await this.getCart();
                await this.getTotalWithShipping();
            }

            
        },
        async minus_qty(index = "q"){
            if (index == "q"){
                if (webPage == "single-product-fullwidth.php"){
                    if ( this.qty_purchased > 1 ){
                        this.qty_purchased = parseInt(this.qty_purchased) - 1;
                    }
                }
            }else{
                if (this.cart_data[index].qty > 1){
                    this.cart_data[index].qty = parseInt(this.cart_data[index].qty) - 1;
                    this.cart_data[index].total_amount = parseInt(this.cart_data[index].qty) * parseInt(this.cart_data[index].price);
                    this.updateCart();
                }  
            }
        },
        async add_qty(index = "p"){
            if (index == "p"){
                if (webPage == "single-product-fullwidth.php"){
                    if ( this.qty_purchased < this.kor_product_details.qty_available ){
                        this.qty_purchased = parseInt(this.qty_purchased) + 1;
                    }
                    
                }
            }else{
                if ( this.cart_data[index].qty < this.cart_data[index].qty_available ){
                    this.cart_data[index].qty = parseInt(this.cart_data[index].qty) + 1;
                    this.cart_data[index].total_amount = parseInt(this.cart_data[index].qty) * parseInt(this.cart_data[index].price);
                    this.updateCart();
                }
                
            }
        },
        async updateCart(){
            localStorage.setItem("cart", JSON.stringify(this.cart_data));
            await this.getCart();
            await this.getTotalWithShipping();
        },
        async getTotalWithShipping(){
            if (this.cart_total_amount && this.logistics_price){
                this.total_with_logistics = parseInt(this.cart_total_amount) + parseInt(this.logistics_price)
            }
        },
        async loginUser() {
            if (!this.user_email || !this.user_password){
                this.error = "Kindly Enter all Fields"
                new Toasteur().error(this.error);
                return
            }
           

            let data = new FormData();
            data.append('email', this.user_email);
            data.append('password', this.user_password);

            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/accounts/login.php`, data, {
                    headers: { "Content-type": "application/json"}
                });

                if (response.data.status) {
                    console.log(response.data);
                    this.success = response.data.text;
                    const dataValues = response.data.data;
                    const token = dataValues.authtoken;
                    localStorage.setItem("token", token);
                    new Toasteur().success(this.success);
                    await this.getUserDetails();
                    await this.getUserAddress();
                    
                }
            } catch (error) {
               if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return;
                    }

                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return;
                    }

                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return;
                    }

               }else{
                    this.error = error.message || "Error processing request"
                    new Toasteur().error(this.error);
               }
                
                
            } finally {
                this.loading = false
            }
        },
        async getUserDetails(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }
            
            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/accounts/getdetails.php`, {headers} );
                if ( response.data.status ){
                    this.user_details = response.data.data
                    this.ref_link = `${this.baseurl}register.php?code=${this.user_details.refcode}`;
                    await this.getUserAddress();          
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }else{
                    this.error = error.message || "Error Processing Request"
                    swal(this.error);
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
        async getToken(){
            this.loading= true
            const token = window.localStorage.getItem("token");
            this.authToken = token;
            this.loading = false;
        },
        // pagination Functions
        async nextPage(){
            // Increase Current page 
            this.kor_page = parseInt(this.kor_page) + 1;
            this.kor_total_page = null
            this.kor_total_data = null
            if (webPage === "shop.php"){
                await this.getAllProducts(3);
            }
           
        },
        async previousPage(){
             // Decrease Current Page
            this.kor_page = parseInt(this.kor_page) - 1;
            this.kor_total_page = null
            this.kor_total_data = null
            if (webPage === "shop.php"){
                await this.getAllProducts(3);
            }
        },
        async selectPage(page){
            // Decrease Current Page
           this.kor_page = page;
           this.kor_total_page = null
           this.kor_total_data = null
            if (webPage === "shop.php"){
                await this.getAllProducts(3);
            }
        
        },
    },
    async beforeMount(){
        this.loading = true;
    },
    async mounted(){
        console.log("Helo");
        await this.getAllCategories();
        await this.getCart();
        await this.getTotalWithShipping();
        await this.getToken();
        
        console.log(webPage);
        if ( webPage == "index.php" || webPage == "home.php" || webPage == "home-v3.php"  ){
            await this.getAllProducts();
            await this.getAllSliders();
            await this.getFeaturedProducts(); 
            await this.getDiscountProducts();
            await this.getTopRatedProducts();
            await this.getTrendingProduct();
            await this.getAllBrandImages();
            
        }
        if ( webPage == "single-product-fullwidth.php" ){
            if (this.authToken){
                await this.getUserDetails();
                
            }
            await this.getProductDetails();
            await this.getAllBrandImages();
        }

        if ( webPage == "shop.php" ){
            await this.getAllProducts();
            await this.getAllBrandImages();
        }

        // check if the user is already logged in 
        if ( webPage == "checkout.php" ){
            if (this.authToken){
                await this.getUserDetails();
                
            }
        }
    }
})

app.mount('#page');