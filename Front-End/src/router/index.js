import { createRouter, createWebHistory } from 'vue-router'
import PlateformeView from '../views/PlateformeView.vue'
import HomeView from '../views/HomeView.vue'
import PasswordView from '../views/PasswordView.vue'
import checkemailView from '../views/checkemailView.vue'
import TablesView from '../views/TablesView.vue'
import ProfilView from '../views/ProfilView.vue'
import InterventionsView from '../views/InterventionsView.vue'
import AddAdminView from '../views/AddAdminView.vue'
import PaiementView from '../views/PaiementView.vue'
import InterventionsDetailsView from '../views/InterventionsDetailsView.vue'
import ListeDesAdminesView from '../views/ListeDesAdminesView.vue'
import AddEtabView from '../views/AddEtabView.vue'
import ResetPasswordView from '../views/ResetPasswordView.vue'
import AjouterEnseignantView from '../views/AjouterEnseignantView.vue'
import listeEnseignantsView from '../views/listeEnseignantsView.vue'
import UpdateEnseignantView from '../views/UpdateEnseignantView.vue'
import AddInterventionView from '../views/AddInterventionView.vue'















const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/platform',
    name: 'platform',
    component:PlateformeView,
    props: true,
    meta: {
      auth: true
  }
    
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
  {
    path: '/Interventions',
    name: 'Interventions',
    component: InterventionsView
  },


  ,
  {
    path: '/AddAdmin',
    name: 'AddAdmin',
    component: AddAdminView
  },

  {
    path: '/Paiement',
    name: 'Paiement',
    component:PaiementView
  },
  
  {
    path: '/InterventionsDetails/:id_etab/details',
    name: 'InterventionsDetails',
    component:InterventionsDetailsView,
    props:true,
  },

  {
    path: '/ListeDesAdmines',
    name: 'ListeDesAdmines',
    component: ListeDesAdminesView
  },

  {
    path: '/AddEtab',
    name: 'AddEtab',
    component: AddEtabView
  },
  
  {
    path: '/ResetPassword',
    name: 'ResetPassword',
    component: ResetPasswordView
  },
  
  {
    path: '/listeEnseignants',
    name: 'listeEnseignants',
    component:listeEnseignantsView
  },

    {
    path: '/AjouterEnseignant',
    name: 'AjouterEnseignant',
    component:AjouterEnseignantView
  },

  {
    path: '/UpdateEnseignant/:userid/update',
    name: 'UpdateEnseignant',
    component:UpdateEnseignantView,
    props:true,
  },

  {
    path: '/AddIntervention',
    name: 'AddIntervention',
    component:AddInterventionView
  },

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
