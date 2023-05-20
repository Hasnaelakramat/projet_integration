import { createRouter, createWebHistory } from 'vue-router'
import PlateformeView from '../views/PlateformeView.vue'
import HomeView from '../views/HomeView.vue'
import PasswordView from '../views/PasswordView.vue'
import checkemailView from '../views/checkemailView.vue'
import TablesView from '../views/TablesView.vue'
import ProfilView from '../views/ProfilView.vue'


const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/platform',
    name: 'platform',
    component:PlateformeView
  },

  {
    path: '/Password',
    name: 'Password',
    component:PasswordView
  },
  {
    path: '/checkemail',
    name: 'checkemail',
    component:checkemailView
  },
  {
    path: '/Tables',
    name: 'Tables',
    component:TablesView
  },
  {
    path: '/Profil',
    name: 'Profil',
    component: ProfilView
  },
  
  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
