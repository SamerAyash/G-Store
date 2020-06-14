<template>
    <form class="container form-group" @submit.prevent="register">
        <div class="row">
            <div class="col">
                <label for="firstName" class="text-muted">First Name</label>

                <input id="firstName" v-model="user.first_name" name="firstName" type="text" placeholder="First name" class="form-control">
                <small v-if="this.errors.first_name" class="text-danger">{{this.errors.first_name[0]}}</small>
            </div>
            <div class="col">
                <label for="lastName" class="text-muted">Last Name</label>
                <input id="lastName" v-model="user.last_name" name="lastName" type="text" placeholder="Laste name" class="form-control">
                <small v-if="this.errors.last_name" class="text-danger">{{this.errors.last_name[0]}}</small>
            </div>
            <div class="col" v-if="this.seller == true">
                <label for="shopName" class="text-muted">Shop Name</label>
                <input id="shopName" v-model="user.shop_name" name="shopName" type="text" placeholder="Shop name" class="form-control"  >
                <small v-if="this.errors.shop_name" class="text-danger">{{this.errors.shop_name[0]}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="id" class="text-muted">ID Number</label>
                <input id="id" v-model="user.id_number" name="id_number" type="number" maxlength="10" placeholder="ID Number" class="form-control">
                <small v-if="this.errors.id_number" class="text-danger">{{this.errors.id_number[0]}}</small>

            </div>
            <div class="col">
                <label for="phone" class="text-muted" style="margin-right: 60%;">Phone (059/056)</label>
                <input id="phone" v-model="user.phone" name="phone" type="number" maxlength="10" placeholder="phone number" class="form-control">
                <small v-if="this.errors.phone" class="text-danger">{{this.errors.phone[0]}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="birthday" class="text-muted" style="margin-right: 90%;">Birthday</label>
                <input id="birthday" v-model="user.birth_date"  name="birthday" type="date" placeholder="birthday" class="form-control">
                <small v-if="this.errors.birth_date" class="text-danger">{{this.errors.birth_date[0]}}</small>
            </div>
            <div class="col">
                <label for="gender" class="text-muted" style="margin-right: 90%;">Gender</label>
                <select id="gender" v-model="user.gender"   class="custom-select">
                    <option selected>Select your gender</option>
                    <option value="male">male</option>
                    <option value="female">Female</option>
                </select>
                <small v-if="this.errors.gender" class="text-danger">{{this.errors.gender[0]}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="city" class="text-muted">City</label>
                <select id="city" v-model="user.city"   class="custom-select">
                    <option selected>Select city</option>
                    <option value="gaza">Gaza</option>
                    <option value="dair al balah">Dair Al Balah</option>
                    <option value="maghazi">Maghazi</option>
                    <option value="zuwaida">Zuwaida</option>
                    <option value="nuseirat">Nuseirat</option>
                    <option value="khan younes">Khan Younes</option>
                    <option value="rafah">Rafah</option>
                </select>
                <small v-if="this.errors.city" class="text-danger">{{this.errors.city[0]}}</small>
            </div>
            <div class="col">
                <label for="area"  class="text-muted">Area</label>
                <input id="area" v-model="user.area" name="area" type="text" placeholder="Area" class="form-control">
                <small v-if="this.errors.area" class="text-danger">{{this.errors.area[0]}}</small>
            </div>
            <div class="col">
                <label for="street" class="text-muted">Street</label>
                <input id="street"v-model="user.street"  name="street" type="text" placeholder="Street" class="form-control">
                <small v-if="this.errors.street" class="text-danger">{{this.errors.street[0]}}</small>
            </div>
            <div class="col">
                <label for="building" class="text-muted" style="margin-right: 20%">Building Number</label>
                <input id="building"  v-model="user.building_number" name="building" type="number" placeholder="Building Number" class="form-control">
                <small v-if="this.errors.building_number" class="text-danger">{{this.errors.building_number[0]}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <label for="email" class="text-muted" style="margin-right: 90%;">Email</label>
                <input id="email" v-model="user.email"  name="email" type="email" placeholder="Email" class="form-control">
                <small v-if="this.errors.email" class="text-danger">{{this.errors.email[0]}}</small>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <label for="password" class="text-muted" style="margin-right: 90%;">Password</label>
                <input id="password"  v-model="user.password" name="password" type="password" placeholder="Password" class="form-control">
                <small v-if="this.errors.password" class="text-danger">{{this.errors.password[0]}}</small>
            </div>
        </div>
        <div>
            <button v-if="!seller" class="btn btn-success" style="width: 80%" type="submit">Register as a buyer</button>
            <button v-if="seller" class="btn btn-success" style="width: 80%" type="submit">Register as a seller</button>
        </div>
    </form>
</template>

<script>
    export default {
        name: "registerForm",
        props:['seller'],
        watch:{
            seller:function (val) {
                this.user.is_seller= val;
            }
        },
        data(){
            return{
                user:{
                    first_name:'',
                    last_name:'',
                    id_number:'',
                    phone:'',
                    birth_date:'',
                    gender:'',
                    email:'',
                    password:'',
                    city:'',
                    area:'',
                    street:'',
                    building_number:'',
                    shop_name:'',
                    is_seller:this.seller
                },
                errors:'',
            }
        },
        methods:{
            register(){
                axios.post('/register',this.user)
                .then(res=>{
                    window.location.href=res.data;
                })
                .catch(err=>{
                    if (err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
input{
    border-radius: 5px;
    &:focus{
         border: solid 2px #37a000;
     }
    &:focus + label {
        background: #37a000;
        color: white;
        font-size: 70%;
        padding: 1px 6px;
        z-index: 2;
        text-transform: uppercase;
    }
}
label{
    margin-right: 70%;
    font-size: 14px;
}
    button{
        margin-top: 1em;
        width: 390px;
        height: 44px;
        background-color: #37A000;
        color: white;
        font-size: 1.1em;
        font-weight: 500;
        border-radius: 5px;
        margin-bottom: 1em;
        text-align: center;
    }


</style>
