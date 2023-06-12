import { createRouter, createWebHistory } from 'vue-router'
import PlateformeView from '../views/PlateformeView.vue'
import HomeView from '../views/HomeView.vue'



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
  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
