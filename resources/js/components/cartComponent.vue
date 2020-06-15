<template>
    <div class="row">

        <div class="col-sm-8 content-box" >
            <div class="row my-cart-box">
                <div class="col-sm-11"><span class="my-cart">My Cart</span> <span class="num-items">({{cart_count}})</span></div>
                <div class="col-sm-11">
                    <div v-for="cart in cartsD" class="row box-product"  v-bind:key="carts.id">
                        <div class="col-sm-2">
                            <img :src="'/images/products/'+cart.product.mainImage" @click="productGo(cart.product.id)" class="img-product"  height="117px" width="86px">
                        </div>
                        <div class="col-sm-6 details-product-box">
                            <div class="row">
                                <div class="col-sm-12 name-of-product">
                                </div>
                                <div class="col-sm-12 short-description">
                                    {{cart.product.title}} (Quantity  {{cart.count}})
                                </div>
                                <div class="col-sm-12 time-expect">
                                    {{cart.created_at}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">

                            <div class="row price-box">

                                <div class="col-sm-5">
                                    <div class="row col">
                                        <div class="col-sm-2 nis-word">NIS</div>
                                        <div class="col-sm-4 nis-price">{{cart.product.price}}</div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <form class="row form-group" >
                                        <button @click.prevent="deleteFromCart(cart.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
                            <span class="nis-result">NIS</span>
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
                <div id="paypal-button"></div>
                <br><br>
                <button @click.prevent="checkout()" class="col-sm-12 btn btn-checkout" style="border-radius: 25px">
                    Checkout now by Cash
                </button>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "cart",
        props:['carts'],
        data(){
            return {
                cartsD:[],
                cart_count:0,
                totalPrice:0,

            }
        },
        created(){
            this.cartsD=this.carts;
            this.cart_count=this.cartsD.length;
        },
        watch:{
            cartsD:function () {
                this.cart_count=this.cartsD.length;
            },
            total:function(){
                var sum =0;
                for (var order in this.ordersD) {
                    sum= sum+ (order.count * order.product.price);
                }
                this.totalPrice =sum;
            }
        },
        methods:{
            productGo(id){
                window.location.href='/product/'+id;
            },
            checkout(){
                axios.post('checkout')
                    .then(res => {
                        this.cartsD =res.data;
                        if (res.data == 'error'){
                            this.makeToast(
                                'danger',
                                'An error occurred, process did not complete',
                                'Error');
                        }
                        else {
                            this.makeToast(
                                'success',
                                'The product added to cart',
                                'Add successfully');
                        }
                    })
                    .catch(err => {
                        console.log(err)
                        this.makeToast(
                            'danger',
                            'An error occurred, process did not complete',
                            'Error');
                    });
            },
            deleteFromCart(id){
                axios.delete('deleteFromCart/'+id)
                    .then(res => {
                        this.cartsD =res.data;
                            this.makeToast(
                                'success',
                                'The product deleted from cart',
                                'Delete successfully');


                    })
                    .catch(err => {
                        this.makeToast(
                            'danger',
                            'An error occurred, process did not complete',
                            'Error');
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

</style>
