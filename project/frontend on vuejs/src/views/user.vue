<template>
<div>
 <UserNav />
 
 <FrontFooter />
</div>
</template>
<script>
import UserNav from "@/components/UserNav.vue"
import FrontFooter from '../components/FrontFooter'
   export default{
       name: "user",
       components:{
           UserNav,
           FrontFooter
       }
   } 
</script>