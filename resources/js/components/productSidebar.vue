<template>
    <div class="container" style="width: 680px;max-width: 700px">
        <h5>Category: {{category.name}}/Sub Category: {{sub_category.name}}</h5>
        <hr>
        <div class="row" style="width: 680px;">
            <div class="col-2" style="width: 100px">
                <div class="row">
                    <img @click="changeImage(product.mainImage)" v-if="image != ''" :src="'/images/products/'+product.mainImage" class=" rounded d-block image">
                </div>
                <div class="row" v-for="image in images" v-bind:key="images.id">
                    <br><br>
                    <img @click="changeImage(image.name)" :src="'/images/products/'+image.name" class=" rounded d-block image">
                </div>
            </div>
            <div class="vl"></div>
            <div class="col" v-if="image != ''">
                <img :src="'/images/products/'+image" class=" rounded d-block mainImage">
            </div>
            <div class="col" style="margin-left: 70px">
                <p class="textw"><b >Title: </b>{{product.title}}</p>
                <p><b>Price: </b>{{product.price}}</p>
                <p  class="textw"><b>Brand: </b>{{product.brand}}</p>
                <p  class="textw"><b>Rate:</b>
                    <i class="fas fa-star" v-bind:class="[{'golden-star': product.rate >=1}]"></i>
                    <i class="fas fa-star" v-bind:class="[{'golden-star': product.rate >=2}]"></i>
                    <i class="fas fa-star" v-bind:class="[{'golden-star': product.rate >=3}]"></i>
                    <i class="fas fa-star" v-bind:class="[{'golden-star': product.rate >=4}]"></i>
                    <i class="fas fa-star" v-bind:class="[{'golden-star': product.rate ==5}]"></i>
                </p>
                <p><b>Amount: </b>{{product.amount}}</p>
                <p  class="textw"><b>Shop: </b>{{seller.shopName}}</p>
                <p  class="textw"><b>Seller: </b>{{seller.name}}</p>
                <p>*****************</p>
                <p class="textw"><b>Admin Name: </b>{{product.adminName}}</p>
                <p class="textw"><b>Created at: </b>{{product.created_at}}</p>
                <p class="textw"><b>Updated at: </b>{{product.updated_at}}</p>
            </div>
        </div>
        <hr>
        <div>
            <h6>
                <b>Description:</b>
            </h6>
            <p class="pW">{{product.description}}</p>
        </div>
        <div class="dt-autofill-background">
            <p><b>Specifications:</b></p>
            <section v-if="sub_category.name == 'Mobiles' || sub_category.name =='Tablets'" class="row row-cols-3">
                <div class="col">
                    <p><b>Screen size: </b>{{mobile_and_tablet.displaySize}} inch</p>
                    <p><b>Memory Ram: </b>{{mobile_and_tablet.ram}} GB</p>
                    <p><b>Rear camera: </b>{{mobile_and_tablet.rearCamera}} MB</p>
                    <p><b>Battery: </b>{{mobile_and_tablet.battery}}</p>

                </div>
                <div class="col">
                    <p><b>Storage capacity: </b>{{mobile_and_tablet.storage}} GB</p>
                    <p><b>SIM count: </b>{{mobile_and_tablet.sim}}</p>
                    <p><b>Back camera: </b>{{mobile_and_tablet.backCamera}} MB</p>
                    <p><b>Device type: </b>{{mobile_and_tablet.type}}</p>
                </div>
                <div class="col"></div>
            </section>
            <section v-if="category.name == 'Beauty & Health'" class="row row-cols-3">
                <div class="col">
                    <p><b>Size: </b>{{beauty_and_helth.size}} MI</p>
                    <p><b>Type: </b>{{beauty_and_helth.type}}</p>
                </div>
                <div class="col">
                    <p><b>For: </b>{{beauty_and_helth.for.charAt(0).toUpperCase() + beauty_and_helth.for.slice(1)}}</p>
                    <p><b>Power: </b>{{beauty_and_helth.power == null? "Don't need power":beauty_and_helth.power}}</p>
                </div>
                <div class="col"></div>
            </section>
            <section v-if="sub_category.name == 'Screens & Audio'" class="row row-cols-3">
                <div class="col">
                    <p><b>Screen size: </b>{{screen_and_audio.displaySize}} inch</p>
                </div>
                <div class="col">
                    <p><b>Type: </b>{{screen_and_audio.type}}</p>
                </div>
                <div class="col"></div>
            </section>
            <section v-if="sub_category.name == 'Computers & Laptops'" class="row row-cols-3">
                <div class="col">
                    <p><b>Screen size: </b>{{computer_and_laptop.displaySize}} inch</p>
                    <p><b>Memory Ram: </b>{{computer_and_laptop.ram}} GB</p>
                    <p><b>Processor: </b>{{computer_and_laptop.processor}}</p>
                </div>
                <div class="col">
                    <p><b>Storage capacity: </b>{{computer_and_laptop.diskSize}} GB</p>
                    <p><b>SSD: </b>{{computer_and_laptop.ssdSize}} GB</p>
                    <p><b>Device type: </b>{{computer_and_laptop.type}}</p>
                </div>
                <div class="col"></div>
            </section>
            <section v-if="sub_category.name =='Household Devices'">
                <div class="col">
                    <p><b>Type: </b>{{house_hold_device.type}}</p>
                </div>
            </section>
            <section v-if="sub_category.name =='Cameras'" class="row row-cols-3">
                <div class="col">
                    <p><b>Zoom: </b>{{camera.zoom}}</p>
                </div>
                <div class="col">
                    <p><b>Precision: </b>{{camera.precision}}</p>
                </div>
                <div class="col"></div>
            </section>
            <section v-if="sub_category.name =='Sport & Games'" class="row row-cols-3">
                <div class="col">
                    <p><b>For: </b>{{sport_and_games.for.charAt(0).toUpperCase() + sport_and_games.for.slice(1)}}</p>
                </div>
                <div class="col">
                    <p><b>Age: </b>+{{sport_and_games.age}} years</p>
                </div>
                <div class="col"></div>
            </section>
            <section v-if="category.name == 'Home'" class="row row-cols-3">
                <div class="col">
                    <p><b>Size: </b>{{home.size}}</p>
                    <p><b>Type: </b>{{home.type}}</p>
                </div>
                <div class="col">
                    <p><b>Material: </b>{{home.material}}</p>
                    <p v-if="sub_category.name == 'Furniture and Decoration'"><b>Delivery: </b>{{home.deliver === 1?'True':'False'}}</p>
                </div>
                <div class="col"></div>
            </section>
        </div>
        <hr>
        <div>
            <div class="float-left">
                <p><b>Note:</b> </p>
                <textarea v-model="note" rows="4" style="width: 600px">{{note}}</textarea>
                <p class="text-danger">If you denied the product ,Please,Write the reasons,but if you allowed it.
                    Clear the note</p>
            </div>
            <div class="float-right">
                <button class="btn btn-danger float-left m-1" @click="deleteProduct">Delete</button>
                <button v-if="product.isAccept == false" class="btn btn-danger float-left m-1" @click="updateProduct('deny')">Deny</button>
                <button v-if="product.isAccept == false" class="btn text-white float-right m-1" @click="updateProduct('allow')"
                        style="background-color: #37a000;margin-right:0px">Allow</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "productSidebar",
        props:['id'],
        data(){
            return{
                product:[],
                sub_category:[],
                category:[],
                images:[],
                seller:[],
                mobile_and_tablet:[],
                beauty_and_helth:[],
                screen_and_audio:[],
                computer_and_laptop:[],
                house_hold_device:[],
                sport_and_games:[],
                camera:[],
                home:[],
                image:'',
                note:'',
                subProduct_id:''
            }
        },
        watch: {
            id:function(){
                this.getProduct(this.$props.id);
            },
            image:function(){
            },
            product:function () {
                this.sub_category=this.product.sub_category;
                this.seller=this.product.seller;
                this.images=this.product.images;
                this.category=this.sub_category.category;
                this.image=this.product.mainImage;
                this.mobile_and_tablet=this.product.mobile_and_tablet;
                this.beauty_and_helth=this.product.beauty_and_helth;
                this.screen_and_audio=this.product.screen_and_audio;
                this.computer_and_laptop=this.product.computer_and_laptop;
                this.house_hold_device=this.product.house_hold_device;
                this.camera=this.product.camera;
                this.sport_and_games=this.product.sport_and_games;
                this.home=this.product.home;
                this.note=this.product.note;
            }
        },
        methods:{
            getProduct(id){
                axios.get('/api/admin/get-product/'+id)
                    .then(res => {
                        this.product = res.data;
                    })
                    .catch();
            },
            changeImage(image){
                this.image=image;
            },
            deleteProduct() {
                axios.post('/api/admin/outProductsD/'+this.product.id,{
                    'seller_id':this.seller.id,
                    _method:'delete'
                })
                    .then(data => {
                        this.makeToast(
                            'success',
                            'The Product deleted',
                            'Delete successfully');
                    })
                    .catch(err => {
                        this.makeToast(
                            'danger',
                            'An error occurred, process did not complete',
                            '');
                    });
            },
            updateProduct(statusP){
                axios.patch('/api/admin/outProductsU/'+this.product.id,{
                    'note':this.note,
                    'status':statusP
                })
                    .then(data => {
                        this.makeToast(
                            'success',
                            'The Product was updated',
                            'Update successfully');
                    })
                    .catch(err => {
                        this.makeToast(
                            'danger',
                            'An error occurred, process did not complete',
                            '');
                    });
            },
            makeToast(variant = null,message,title) {
                this.$bvToast.toast(message, {
                    title: title,
                    variant: variant,
                    solid: true,
                    autoHideDelay:'1500',
                })
            },
        }
    }
</script>

<style scoped>
    .textw{
        display:block;
        width:200px;
        word-wrap:break-word;
    }
    .pW{
        display:block;
        width:650px;
        word-wrap:break-word;
    }
</style>
