import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)



import Dashboard from '../components/Dashboard.vue';
import Profile from '../components/Profile.vue';
import User from '../components/User.vue';
const routes = [
  {path: '/profile' , component: Profile},
  {path: '/dashboard' , component: Dashboard},
  {path: '/user' , component: User},
]


const router = new VueRouter({
  routes ,
  hashbang :false,
  mode : 'history',
  cache: false
 
})

export default router