import Vue from 'vue'
import VueRouter from 'vue-router'
import login from '../views/login.vue'
import signup from '../views/signup.vue'
import user from '../views/user.vue'
import logout from '../views/logout.vue'
import studentdata from '../views/studentdata.vue'
import addstudent from '../views/addstudent.vue'
import studentattendence from '../views/studentattendence.vue'
import Front from '../views/Front.vue'

Vue.use(VueRouter)

  const routes = [
   {
    path: '/logout',
    name: 'logout',
    component: logout
  },
  {
    path: '/login',
    name: 'login',
    component: login
  },
  {
    path: '/',
    name: 'front',
    component: Front
  },
  {
    path: '/signup',
    name: 'signup',
    component: signup
  },
  {
    path: '/user',
    name: 'user',
    component: user,
    beforeEnter(to,from,next ){
      if(localStorage.getItem('token')){
        next();
      }
      else{
        next('/login');
      }
    },
    children:[
  {
    path: '/studentdata',
    name: 'studentdata',
    component: studentdata
  },
  {
    path: '/addstudent',
    name: 'FormValidation',
    component: addstudent
  },
  {
    path: '/studentattendence',
    name: 'studentattendence',
    component: studentattendence
  },
  ]
},
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
