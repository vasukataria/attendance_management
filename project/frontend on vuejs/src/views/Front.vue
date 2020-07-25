<template>
    <div>
        <div id="img" :style="{'background-image': 'url(' + require('../assets/img/images1.jpg')+')'}">
        <div class="container" id="abc">
        <img src="../assets/img/download.png">
        <H1>Online Attendence Register</H1> 
        </div>
        <div id="store">
        <li v-if="user" class="btn"><router-link to="/logout">logout</router-link></li>
        <li v-else class="btn">
        <router-link to="/signup">SignUp</router-link>
        </li>
        <br>
        <br>
        <li v-if="user" class="btn"><router-link to="/user">User</router-link></li>
        <li v-else class="btn"><router-link to="/login">LogIn</router-link></li>
        
        </div>
        
        </div>
        <FrontFooter />
    </div>
</template>
<script>
    import FrontFooter from '../components/FrontFooter'
    export default{
        name: 'front',
        components:{
        FrontFooter
    },
        data (){
            return{

            }
        },

        created () { 
       this.user= localStorage.getItem('token') || false;
    },
    }
    </script>
<style  scoped>
#abc{
    display: flex;
    margin-left: 200px;
}
h1{
    margin-top: 52px;
    font-weight: 300;
    font-size: 36px;
    color: #8c8c8c;
}
.btn{
    margin-right: 200px;
}
#store{

    padding-left: 500px;
    padding-bottom: 488px;
}
#img{
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
 
}

.btn[data-v-5b1367df] {
    margin-right: 200px;
}
.btn {
    margin: .375rem;
    color: inherit;
    text-transform: uppercase;
    word-wrap: break-word;
    white-space: normal;
    cursor: pointer;
    border: 0;
    border-radius: .125rem;
    -webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
    -webkit-transition: color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,-webkit-box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,-webkit-box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out,-webkit-box-shadow 0.15s ease-in-out;
    padding: .84rem 2.14rem;
    font-size: .81rem;
}
.btn {
    margin: .375rem;
    color: inherit;
    text-transform: uppercase;
    word-wrap: break-word;
    white-space: normal;
    cursor: pointer;
    border: 0;
    border-radius: .125rem;
    -webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
    -webkit-transition: color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,-webkit-box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,-webkit-box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out,-webkit-box-shadow 0.15s ease-in-out;
    padding: .84rem 2.14rem;
    font-size: .81rem;
}

</style>
