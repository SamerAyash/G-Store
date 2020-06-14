<template>
    <div class="row">

        <div class="col-sm-8 content-box" >
            <div class="row my-cart-box">
                <div class="col-sm-11"><span class="my-cart">My Cart</span> <span class="num-items">({{carts.length}})</span></div>
                <div class="col-sm-11">
                    <div v-for="cart in carts" class="row box-product"  v-bind:key="carts.id">
                        <div class="col-sm-2">
                            <img :src="'/images/products/'+cart.product.mainImage" @click="productGo(cart.product.id)" class="img-product"  height="117px" width="86px">
                        </div>
                        <div class="col-sm-6 details-product-box">
                            <div class="row">
                                <div class="col-sm-12 name-of-product">
                                </div>
                                <div class="col-sm-12 short-description">
                                    {{cart.product.title}}
                                </div>
                                <div class="col-sm-12 time-expect">
                                    {{cart.product.created_at}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">

                            <div class="row price-box">

                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-sm-2 nis-word">NIS</div>
                                        <div class="col-sm-4 nis-price">{{cart.product.price}}</div>
                                    </div>

                                </div>
                                <div class="col-sm-7">
                                    <form class="row form-group" >
                                        <label class="col-sm-6 quantity"> Quantity </label>
                                        <input type="number" min="1" :value="cart.count" class="col-sm-5 form-control" max="cart.product.amount">

                                    </form>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-sm-3">
            <div class="row order-box">
                <div class="col-sm-12">
                    <div class="row ">
                        <div class="col-sm-12 order-word">
                            Order Summary
                        </div>
                    </div>

                </div>
                <div class="col-sm-12">
                    <div class="row total-box">
                        <div class="col-sm-6 total">
                            Cost of products <span class="items">({{carts.length}} item)</span>
                        </div>
                        <div class="ml-auto price-result-box">
                            <span class="nis-result"> NIS</span>
                            <span class="price-result">1400</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row shipping-box">
                        <div class="col-sm-6 shipping">
                            SHIPPING
                        </div>
                        <div class="ml-auto price-result-box">
                            <span class="nis-result"> NIS</span>
                            <span class="price-result">20</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row shipping-box">
                        <div class="col-sm-6 shipping">
                            <hr>
                            Total
                        </div>
                        <div class="ml-auto price-result-box">
                            <hr>
                            <span class="nis-result"> NIS</span>
                            <span class="price-result">1420</span>
                        </div>
                    </div>
                </div>
                <hr class="col-sm-10 line-hr" style="margin-bottom: 1em">
                <button class="col-sm-12 btn btn-checkout">
                    CHECKOUT NOW
                </button>

            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "cart",
        props:['carts'],
        created(){
            console.log(this.carts)
        },
        methods:{
            productGo(id){
                window.location.href='/product/'+id;
            }
        }
    }
</script>

<style scoped>

</style>
