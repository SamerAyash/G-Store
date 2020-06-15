<template>
<div class="container">
    <br><br>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product image</th>
            <th scope="col">Buyer code</th>
            <th scope="col">Status</th>
            <th scope="col">Payment type</th>
            <th scope="col">Costs</th>
            <th scope="col">Quantity</th>
            <th scope="col">Paid price</th>
            <th scope="col">Created at</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(order,index) in ordersD">
            <th scope="row">{{index+1}}</th>
            <td><img :src="'/images/products/'+order.product.mainImage" @click="productGo(order.product.id)" class="img-product"  height="90px" width="60px"></td>
            <td>{{order.buyer_code}}</td>
            <td>{{order.status}}</td>
            <td>{{order.payment_type}}</td>
            <td>{{order.costs}}</td>
            <td>{{order.quantity}}</td>
            <td>{{order.paid_price}}</td>
            <td>{{order.created_at}}</td>
            <td @click.prevent="deleteOrder(order.id)" class="btn btn-danger"><i class="fas fa-trash"></i></td>
        </tr>
        </tbody>
    </table>
</div>
</template>

<script>
    export default {
        name: "OrderComponent",
        props:['orders'],
        data(){
            return {
                ordersD:[],
            }
        },
        created(){
            this.ordersD=this.orders;
        },
        methods:{
            productGo(id){
                window.location.href='/product/'+id;
            },
            deleteOrder(id){
                axios.delete('deleteOrder/'+id)
                    .then(res => {
                        this.ordersD =res.data;
                        this.makeToast(
                            'success',
                            'The product deleted from order list',
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
                });
        }
        }
    }
</script>

<style scoped>

</style>
