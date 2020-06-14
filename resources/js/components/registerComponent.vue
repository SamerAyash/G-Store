<template>
    <div class="container text-center" style="max-width: 700px;margin-top: -120px">
        <div class="row row-3">
            <hr class="col float-left">
            <h4 class="col" style="color: #37a000">Register as a</h4>
            <hr class="col float-right">
        </div>
        <div class="row row-3">
            <div class="col">
                <button class="nav-item nav-link notActive" @click="change(false)"
                        :class="(!this.seller)?'activeRoute':''" style="max-width: inherit">
                    Buyer
                </button>
            </div>
            <div class="col"></div>
            <div class="col">
                <button class="nav-item nav-link notActive" @click="change(true)"
                        :class="(this.seller)?'activeRoute':''">
                    Seller
                </button>
            </div>
        </div>
        <div class="container text-center">
            <h6>
                <b>I already have account.</b> <router-link :to="{name:'loginComponent'}" style="color: #37a000">Sign in</router-link>
            </h6>
        </div>
        <hr>
        <div>
            <register-form :seller="seller"></register-form>
        </div>
        <hr>
    </div>
</template>

<script>
    import registerForm from "./registerForm";
    export default {
        name: "registerComponent",
        components:{
            registerForm,
        },
        data(){
            return {
                seller:false,
            }
        },
        methods:{
            change(status){
                this.seller= status;
            }
        }
    }
</script>

<style scoped>
    .activeRoute {
    background-color: #FFD600;
    color: white !important;
    }
    .notActive{
        border: solid;
        border-color: #FFD600;
        color: #FFD600;
        border-radius: 5px;
        border-width: 2px;
        font-weight: 500 ;
        width: 100%;
        text-align: center;
    }

</style>
