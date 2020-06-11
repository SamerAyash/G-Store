<template>
    <div>
    <div class="row">
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-12"><div class="category-above" >
                    <a :href="this.homeRoute"  >Home</a>
                    <a href="#"> > {{this.product.sub_category.category.name}}</a>
                    <a href="#"> > {{this.product.sub_category.name}}</a>
                    <hr style="margin: 0px;width: 450px">
                    </div></div>

                <div class="col-md-2 col-2" style="">
                    <img  class=" img-mini" @click="changeImage(product.mainImage)" :src="'/images/products/'+this.product.mainImage" width="35px" height="45px">
                    <img  v-for="image in this.product.images" class="img-mini" @click="changeImage(image.name)" :src="'/images/products/'+image.name" width="35px" height="45px">
                </div>
                <div class="col-md-10 col-8 ">
                    <img id="showImage" width="397px" height="541px" :src="'/images/products/'+this.image" :data-zoom-image="'/images/products/'+this.image" class="main-image">
                </div>
            </div>
        </div>
        <div class="col-md-3 box-detail" style="margin-top: 60px">
            <div class="row marka-name">
                <div class="col-md-12 col-12">Brand: {{this.product.brand}}</div>
            </div>
            <div class="row name-product"><div class="col-md-12"><h5>{{this.product.title}}</h5></div></div>
            <div class="row  detail-any">
                <div class="col-md-12"></div>
            </div>
            <div class="row name-product"><div class="price col-md-3 col-2">Price:</div>
                <div v-if="!this.product.offer" class="col-md-8 col-8 price-content">
                    NIS {{this.product.price}}
                </div>
                <div v-if="this.product.offer" class="col-md-8 col-8 price-content">
                    <span>NIS {{(this.product.price - this.product.price*this.product.offer.discount/100).toFixed(2)}} <p style="color: #37a000;font-size:14px">{{this.product.offer.discount}}% offer for {{this.product.offer.duration}} days</p></span>
                </div>
            </div>
            <div class="row marka-name">
                <div class="col-md-12 col-12">Number of buyers: {{this.product.ratingCount}}</div>
            </div>
            <div class="row marka-name">
                <div class="col-md-12 col-12">Rate:
                    <i class="fas fa-star" style="color: gray" v-bind:class="[{'golden-star': this.product.rate >=1}]"></i>
                    <i class="fas fa-star "style="color: gray"v-bind:class="[{'golden-star': this.product.rate >=2}]"></i>
                    <i class="fas fa-star"style="color: gray" v-bind:class="[{'golden-star': this.product.rate >=3}]"></i>
                    <i class="fas fa-star"style="color: gray" v-bind:class="[{'golden-star': this.product.rate >=4}]"></i>
                    <i class="fas fa-star"style="color: gray" v-bind:class="[{'golden-star': this.product.rate ==5}]"></i>
                </div>
            </div>
            <div class="dt-autofill-background" style="margin-top: 10px;margin-bottom: -10px">
                <div class="row marka-name">
                    <div class="col-md-12 col-12">Specification: </div>
                </div>
                <section v-if="this.product.sub_category.name == 'Mobiles' || this.product.sub_category.name =='Tablets'" class="row row-cols-2">
                    <div class="col">
                        <p>Screen size: {{this.product.mobile_and_tablet.displaySize}} inch</p>
                        <p>Memory Ram: {{this.product.mobile_and_tablet.ram}} GB</p>
                        <p>Rear camera: {{this.product.mobile_and_tablet.rearCamera}} MB</p>
                        <p>Battery: {{this.product.mobile_and_tablet.battery}}</p>

                    </div>
                    <div class="col">
                        <p>Storage capacity: {{this.product.mobile_and_tablet.storage}} GB</p>
                        <p>SIM count: {{this.product.mobile_and_tablet.sim}}</p>
                        <p>Back camera: {{this.product.mobile_and_tablet.backCamera}} MB</p>
                        <p>Device type: {{this.product.mobile_and_tablet.type}}</p>
                    </div>
                </section>
                <section v-if="this.product.sub_category.category.name == 'Beauty & Health'" class="row row-cols-2">
                    <div class="col">
                        <p>Size: {{this.product.beauty_and_helth.size}} MI</p>
                        <p>Type: {{this.product.beauty_and_helth.type}}</p>
                    </div>
                    <div class="col">
                        <p>For: {{this.product.beauty_and_helth.for.charAt(0).toUpperCase() + this.product.beauty_and_helth.for.slice(1)}}</p>
                        <p>Power: {{this.product.beauty_and_helth.power == null? "Don't need power":this.product.beauty_and_helth.power}}</p>
                    </div>
                </section>
                <section v-if="this.product.sub_category.name == 'Screens & Audio'" class="row row-cols-2">
                    <div class="col">
                        <p>Screen size: {{this.product.screen_and_audio.displaySize}} inch</p>
                    </div>
                    <div class="col">
                        <p>Type: {{this.product.screen_and_audio.type}}</p>
                    </div>
                </section>
                <section v-if="this.product.sub_category.name == 'Computers & Laptops'" class="row row-cols-2">
                    <div class="col">
                        <p>Screen size: {{this.product.computer_and_laptop.displaySize}} inch</p>
                        <p>Memory Ram: {{this.product.computer_and_laptop.ram}} GB</p>
                        <p>Processor: {{this.product.computer_and_laptop.processor}}</p>
                    </div>
                    <div class="col">
                        <p>Storage capacity: {{this.product.computer_and_laptop.diskSize}} GB</p>
                        <p>SSD: {{this.product.computer_and_laptop.ssdSize}} GB</p>
                        <p>Device type: {{this.product.computer_and_laptop.type}}</p>
                    </div>
                </section>
                <section v-if="this.product.sub_category.name =='Household Devices'">
                    <div class="col">
                        <p>Type: {{this.product.house_hold_device.type}}</p>
                    </div>
                </section>
                <section v-if="this.product.sub_category.name =='Cameras'" class="row row-cols-2">
                    <div class="col">
                        <p>Zoom: {{this.product.camera.zoom}}</p>
                    </div>
                    <div class="col">
                        <p>Precision: {{this.product.camera.precision}}</p>
                    </div>
                </section>
                <section v-if="this.product.sub_category.name =='Sport & Games'" class="row row-cols-2">
                    <div class="col">
                        <p>For: {{this.product.sport_and_games.for.charAt(0).toUpperCase() + this.product.sport_and_games.for.slice(1)}}</p>
                    </div>
                    <div class="col">
                        <p>Age: +{{this.product.sport_and_games.age}} years</p>
                    </div>
                </section>
                <section v-if="this.product.sub_category.category.name == 'Home'" class="row row-cols-2">
                    <div class="col">
                        <p>Size: {{this.product.home.size}}</p>
                        <p>Type: {{this.product.home.type}}</p>
                    </div>
                    <div class="col">
                        <p>Material: {{this.product.home.material}}</p>
                        <p v-if="this.product.sub_category.name == 'Furniture and Decoration'">Delivery: {{this.product.home.deliver === 1?'True':'False'}}</p>
                    </div>
                </section>
            </div>
            <hr class="row line-hr">
            <div class="row form-submit">
                <form class="col-md-12">
                    <div class="row">
                        <div class="d-flex flex-column col-md-3 col-3"><div class="quant">Quantity</div>
                            <input v-if="this.product.amount > 0" class="form-control" type="number" min="1" :max="this.product.amount"  value="1"></div>
                        <button class="btn btn-to-cart col-md-9 col-6">ADD TO CART</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="offset-1"></div>
        <div class="col-md-3 box-right">
            <div class="row return-box">
                <div class="col-md-1 col-1"><img :src="'/assets/img/return.png'" width="19px" height="19px">
                </div> <div class="col-md-10 col-10 return-word">Enjoy hassle free returns with this offer.</div></div>
            <div class="row seller-box">
                <div class="col-md-1 col-1">
                    <img :src="'/assets/img/seller.png'" width="19px" height="19px">
                </div>
                <div class="col-md-10 col-10 return-word">
                    <div class="row">
                        <div class="col-md-6 col-4">Sold by:</div>
                        <div class="col-md-6 seller-name col-8">{{this.product.seller.shopName}}</div>
                    </div></div>


            </div>
            <div class="row seller-box">
                <div class="col-md-1 col-1">
                    <img :src="'/assets/img/marker.png'" width="19px" height="19px">
                </div>
                <div class="col-md-10 col-10 return-word">
                    <div class="row">
                        <div class="col-md-6 col-4">Seller location:</div>
                        <span class="col-md-6 seller-name col-8">
                            {{this.product.seller.address.city}} / {{this.product.seller.address.area}} / {{this.product.seller.address.street}} {{this.product.seller.address.buildingNumber}}
                        </span>
                    </div></div>


            </div>
            <div class="row"><hr class="hr-under col-md-10"></div>
            <div class="row highlights-box"><div class="col-md-12 highlights">Highlights :</div></div>

            <ul class="row details-ul highlights-box">
                <li class="col-md-12 details-word">details</li>
                <li class="col-md-12 details-word">details</li>
                <li class="col-md-12 details-word">details</li>
                <li class="col-md-12 details-word">details</li>
                <li class="col-md-12 details-word">details</li>
                <li class="col-md-12 details-word">details</li>

            </ul>
            <div class="row specification highlights-box"><div class="col-md-12"></div></div>

        </div>
    </div>
        <hr style="margin-left: 5%;margin-right: 5%;">
    <div style="margin: 50px">
        <h5>Description: </h5>
        <div class="col">
            {{this.product.description}}
        </div>
    </div>
        <hr style="margin-left: 5%;margin-right: 5%;">
 </div>
</template>

<script>
    export default {
        name: "productComponent",
        props:{
            product:{
                type:Object,
                required:true,
            },
            homeRoute:{
                required: true
            }
        },
        data(){
            return{
                image:'',
            }
        },
        created() {
            this.changeImage(this.product.mainImage)
        },
        methods:{
            changeImage(image){
                this.image= image;
            }
        }
    }
</script>

<style scoped>
a:hover{
    color: #37a000 !important;
}
</style>
