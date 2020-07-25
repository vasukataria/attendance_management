import Vue from 'vue'
import VueRouter from 'vue-router'
import login from '../views/login.vue'
import signup from '../views/signup.vue'
import user from '../views/user.vue'
//import practice from '../views/practice.vue'
import studentdata from '../views/studentdata.vue'
import addstudent from '../views/addstudent.vue'
import studentattendence from '../views/studentattendence.vue'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/signup',
    name: 'signup',
    component: signup
  },
  {
    path: '/user',
    name: 'user',
    component: user,
  },
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
  {
    path: '/login',
    name: 'login',
    component: login
  },

 
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
