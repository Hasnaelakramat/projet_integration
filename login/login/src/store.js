// // store.js

// import { createStore } from 'vuex';

// const store = createStore({
//   state: {
//     etablissements: [] // Initialize the etablissements array
//   },
//   mutations: {
//     setEtablissements(state, payload) {
//       state.etablissements = payload;
//     }
//   },
//   actions: {
//     async fetchEtablissements(context) {
//       try {
//         const response = await axios.get('http://localhost:8000/api/add_etab');
//         const etablissements = response.data; // Assuming the response contains the etablissements data
//         context.commit('setEtablissements', etablissements);
//       } catch (error) {
//         // Handle any errors that occur during the API call
//         console.error(error);
//       }
//     }
//   },
//   getters: {
//     getEtablissements(state) {
//       return state.etablissements;
//     }
//   }
// });

// export default store;
