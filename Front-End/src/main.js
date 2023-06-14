import "bootstrap/dist/css/bootstrap.css"
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'
import "bootstrap/dist/js/bootstrap.min.js"
import "./assets/scripts.js"
import { createStore } from 'vuex';
import axios from 'axios';




/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import all icons */
import { fas } from '@fortawesome/free-solid-svg-icons'

/* import all icons */
import { fab } from '@fortawesome/free-brands-svg-icons'

/* add icons to the library */
library.add(fas,fab);

const store = createStore({
    state: {
      // Define your initial state here
      data: null,
      profilData: null,
      Type:null,
      email:null,
      etablissements: [] 

    },
    mutations: {
      setData(state, payload) {
        state.data = payload;
        
        if(state.data.data.token.accessToken.abilities.access_level==0){
            state.Type = "Président de l'UAE";
         } else if(state.data.data.token.accessToken.abilities.access_level==1){
              state.Type = "Admin de l'UAE";
        }else if(state.data.data.token.accessToken.abilities.access_level==2){
            state.Type = "Admin d'un établissement";
        }else if(state.data.data.token.accessToken.abilities.access_level==3){
            state.Type = "RH d'un établissement";
        }else if(state.data.data.token.accessToken.abilities.access_level==4){
          state.Type = "Enseignant";
      }
      },
      setProfilData(state,payload){
        state.profilData = payload;
      },
      setEmailData(state,payload){
state.email =payload;
      } ,
      setEtablissements(state, payload) {
        state.etablissements = payload;
      }     
    },
    actions: {
      // Define actions to commit mutations
      setData(context, payload) {
        context.commit('setData', payload);
      },
      setProfilData(context , payload){
        context.commit('setProfilData', payload);
      },
      setEmailData(context, payload){
        context.commit('setEmailData', payload);
      },
      fetchEtablissements(context) {
        axios.get('http://localhost:8000/api/add_etab')
          .then(response => {
            const etablissements = response.data; // Assuming the response contains the etablissements data
            context.commit('setEtablissements', etablissements);
          })
          .catch(error => {
            // Handle any errors that occur during the API call
            console.error(error);
          });
      }
      
    },
      
 
    getters: {
      // Define getters to access the state
      getData(state) {
        return state.data;
      },
      getProfilData(state) {
        return state.profilData;
      },
      getType(state) {
        return state.Type;
      },
      getEmailData(state) {
        return state.email;
      },
      getEtablissements(state) {
        return state.etablissements;
      },
 
    }
  });




  



createApp(App).use(router).use(store)
.component('font-awesome-icon', FontAwesomeIcon)

.mount('#app')






