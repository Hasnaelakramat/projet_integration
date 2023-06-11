<template>
    <div class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <router-link :to="platform">
                <a href="#" class="navbar-brand ps-3">Nom du site web</a>
            </router-link>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
                <font-awesome-icon icon="fas fa-bars" />
            </button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control " type="text" placeholder="Rechercher ..." aria-label="Search for..."
                        aria-describedby="btnNavbarSearch" style="margin-top: 10px;" />
                    <button class="btn " type="button" style="height: 46px; margin-top: 10px;"> <font-awesome-icon
                            icon=" fas fa-search" />

                    </button>
                </div>
            </form>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                        <li> <a href="#" class="dropdown-item " @click="Profil"  style="text-decoration :none" >Profil</a></li>

                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a href="#" class="dropdown-item " id="submit" type="submit" @click="logout" style="text-decoration :none">Logout</a></li>


                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <br>

                            <router-link :to="platform" v-if="isAdminUAE || isPresidentUAE || isAdminEtablissement || isRHEtablissement || isEnseignant" > <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon=" fas fa-tachometer-alt" /></div>
                                    Dashboard
                                </a></router-link>

                            <router-link :to="Tables" v-if="isAdminUAE || isPresidentUAE" > <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-school" /></div>
                                    Etablissements
                                </a></router-link>




                            <router-link :to="Interventions" v-if="isAdminUAE || isPresidentUAE || isAdminEtablissement || isRHEtablissement || isEnseignant"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-chalkboard-user" />
                                    </div>
                                    Interventions
                                </a></router-link>


                            <router-link :to="ListeDesAdmines" v-if="isAdminUAE || isAdminEtablissement" > <a href="#"
                                    class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-list" />
                                    </div>
                                    Liste des Admins
                                </a></router-link>

                            <router-link :to="AddAdmin" v-if="isAdminUAE || isAdminEtablissement"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-user-plus" /></div>
                                    Ajouter un Admin
                                </a></router-link>


                            <router-link :to="Paiement" v-if="isAdminUAE || isPresidentUAE || isRHEtablissement || isEnseignant"> <a href="#"
                                    class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-credit-card" />
                                    </div>
                                    Paiement
                                </a></router-link>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="">Connecté en tant que :</div>
                        {{ getType }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Ajouter un établissement</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">
                                <router-link :to="platform">
                                    <a href="#">Dashboard</a>
                                </router-link>
                            </li>
                            <li class="breadcrumb-item active">Ajouter un établissement</li>
                        </ol>
                        <div class="costum bg-color">
                            <div id="layoutAuthentication">
                                <div id="layoutAuthentication_content">
                                    <main>
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col">
                                                    <div class="card border-0 rounded-lg ">
                                                        <div class="card-body">
                                                            <form @submit.prevent="AjouterEtab">
                                                                <div class="row ">
                                                                    <div class="col">
                                                                        <div class="form-floating">

                                                                            <label for="inputCode"
                                                                                style="font-weight: bold;">Code :
                                                                            </label><br><br>
                                                                            <input class="form-control"
                                                                                style="height: 50px;" id="inputCode"
                                                                                type="text" placeholder="XXXXXXXXX"
                                                                                autocomplete="off" v-model="code"
                                                                                required />


                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-floating">

                                                                            <label for="inputNom"
                                                                                style="font-weight: bold;">Nom de
                                                                                l'établissement :
                                                                            </label><br><br>
                                                                            <input class="form-control"
                                                                                style="height: 50px;" id="inputNom"
                                                                                type="text" autocomplete="off" v-model="nom"
                                                                                required />



                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row ">
                                                                    <div class="col">
                                                                        <div class="form-floating">



                                                                            <label for="inputTelephone"
                                                                                style="font-weight: bold;">Téléphone :
                                                                            </label><br><br>
                                                                            <input class="form-control"
                                                                                style="height: 50px;" id="inputTelephone"
                                                                                type="text" autocomplete="off"
                                                                                v-model="telephone" required />






                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-floating">



                                                                            <label for="inputFaxe"
                                                                                style="font-weight: bold;">Fax :
                                                                            </label><br><br>
                                                                            <input class="form-control"
                                                                                style="height: 50px;" id="inputFaxe"
                                                                                type="text" autocomplete="off"
                                                                                v-model="faxe" required />



                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row ">
                                                                    <div class="col">
                                                                        <div class="form-floating">



                                                                            <label for="inputVille"
                                                                                style="font-weight: bold;">Ville :
                                                                            </label><br><br>
                                                                            <input class="form-control"
                                                                                style="height: 50px;" id="inputVille"
                                                                                type="text" autocomplete="off"
                                                                                v-model="ville" required />



                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-floating">


                                                                            <label for="inputNbrEnseignants"
                                                                                style="font-weight: bold;">Nombre
                                                                                d'enseignants :
                                                                            </label><br><br>
                                                                            <input class="form-control"
                                                                                style="height: 50px;"
                                                                                id="inputNbrEnseignants" type="text"
                                                                                autocomplete="off" v-model="nbr_enseignants"
                                                                                required />


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-4 mb-0">

                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between mt-4 mb-0">


                                                                        <a href="#" class="small" type="reset">Annuler</a>

                                                                        <button class="btn" id="submit" type="submit"
                                                                            style="text-decoration: none; background-color: #;">
                                                                            Ajouter
                                                                        </button>


                                                                       

                                                                    </div>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </main>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>




<style src="@/assets/styles.css"></style>


<script >
import axios from 'axios';


export default {

    data() {
        return {
            home: '/',
            checkemail: 'checkemail',
            Tables: 'Tables',
            platform: '/platform',
            AddAdmin: 'AddAdmin',
            Paiement: 'Paiement',
            ListeDesAdmines:'listeDesAdmines',
            Interventions: 'Interventions',
            etablissements: [],
            AddEtab: 'AddEtab',

            profile: {
                firstName: '',
                lastName: '',
                email: '',
                telephone: '',
            },
            isPresidentUAE: false,
            isAdminUAE: false,
            isAdminEtablissement: false,
            isRHEtablissement: false,
            isEnseignant: false,

            code: '', // Add code data property
            nom: '', // Add nom data property
            telephone: '', // Add telephone data property
            faxe: '', // Add faxe data property
            ville: '', // Add ville data property
            nbr_enseignants: '', // Add nbr_enseignants data property
        }
    },
   
    computed: {
        data() {
            return this.$store.getters.getData;
        },
        getType() {
            return this.$store.getters.getType;
        },
      
    },

    mounted() {
        this.statut();

    },

    methods: {
        AjouterEtab() {
  const authToken = this.$store.getters.getData.data.token.plainTextToken;
  const formData = {
    code: this.code,
    nom: this.nom,
    telephone: this.telephone,
    faxe: this.faxe,
    ville: this.ville,
    nbr_enseignants: this.nbr_enseignants
  };

  axios.post('http://localhost:8000/api/add_etab', formData, {
      headers: {
          Authorization: `Bearer ${authToken}`,
      },
  })
  .then(response => {
      console.log(response.data);
      const responseData = response.data;
      // Check if response data is an object and has a `data` property
      if (typeof responseData === 'object' && responseData.hasOwnProperty('data')) {
          const { data } = responseData;
          // Handle the `data` as needed
          console.log(data);
          // Display the response message or perform additional actions
          alert(data.message); // Display the success message
          // Clear the form fields
          this.code = '';
          this.nom = '';
          this.telephone = '';
          this.faxe = '';
          this.ville = '';
          this.nbr_enseignants = '';
      } else {
          console.error('Invalid response data structure');
      }
  })
  .catch(error => {
      console.error(error);
      // Handle the error response or show an error message
      if (error.response && error.response.data && error.response.data.message) {
          alert(error.response.data.message); // Display the error message
      } else {
          alert('An error occurred. Please try again.'); // Display a generic error message
      }
  });
},

Profil() {
            const authToken = this.$store.getters.getData.data.token.plainTextToken;
            console.log('token:', authToken)
            axios.get('http://localhost:8000/api/profile', {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            })
                .then(response => {
                    this.profile = response.data;
                    console.log(this.profile);
                    this.$store.dispatch('setProfilData', response.data);

                    this.$router.push('/Profil')

                })
                .catch(error => {
                    console.error(error);
                });


        },

        statut() {
            if (this.getType === "Président de l'UAE") { this.isPresidentUAE = true; }

            else if (this.getType === "Admin de l'UAE") {
                this.isAdminUAE = true;

            } else if (this.getType == "Admin d'un établissement") {
                this.isAdminEtablissement = true;

            } else if (this.getType == "RH d'un établissement") {
                this.isRHEtablissement = true;
            }
            else if (this.getType == "Enseignant") { this.isEnseignant = true; }
        },

  },





}

</script>