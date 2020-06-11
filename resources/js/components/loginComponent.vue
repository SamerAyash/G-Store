<template>
    <div class="d-flex justify-content-center content-custom">
        <div class="d-flex flex-column">
            <div class="welcom-back">
                Welcome back <img :src="'/assets/img/smile.png'" class="smile-img" width="45px" height="45px">
            </div>
            <div class="sign-in-to-your-account">
                Sign in to your account
            </div>

            <form method="POST" @submit.prevent="login()">
                <div class="alert-danger text-center" style="border-radius: 5px" v-if="this.error">
                    <small style="font-weight: 500">{{this.error}}</small>
                </div>
                <div class="form-group first-input">
                    <label for="exampleInputEmail1" class="input-title" style="margin-top: 2em">Enter your Email</label>
                    <input type="email" v-model="user.email" name="email" class="form-control input-customize input-margin"  autofocus id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small v-if="this.errors.email" class="text-danger">{{this.errors.email[0]}}</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="input-title">Enter your Password</label>
                    <input type="password" v-model="user.password" name="password" class="form-control input-customize input-margin" id="exampleInputPassword1" placeholder="Enter Password">
                    <small v-if="this.errors.password" class="text-danger">{{this.errors.password[0]}}</small>
                </div>

                <button type="submit" class="btn btn-submit" style="border-radius: 5px;" >Sign In</button>
                <div class="dont-have-account">Don't have an account?
                    <router-link  :to='{name:"registerComponent"}'  class="sign-up">Sign up</router-link>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
    export default {
        name: "loginComponent",
        data(){
          return {
              errors:'',
              error:'',
              user:{
                  email:'',
                  password:'',
              }
          }
        },
        methods:{
            login(){
                axios.post('/login',this.user)
                    .then(res=> {
                        if(res.data.error){
                            this.error=res.data.error;
                        }
                        else {
                            window.location.href=res.data;
                        }
                    })
                    .catch(err=> {
                        if (err.response.status === 422){
                            this.errors = err.response.data.errors;
                        }
                    });
            }
        }
    }
</script>

<style scoped>

</style>
