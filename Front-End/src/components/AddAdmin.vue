<template>
    <div class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <router-link :to="platform">
                <a href="#" class="navbar-brand ps-3">HSup.UAE</a>
            </router-link>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
                <font-awesome-icon icon="fas fa-bars" />
            </button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control " type="text" placeholder="Rechercher ..." aria-label="Search for..."
                        aria-describedby="btnNavbarSearch" style="margin-top: 10px; margin-bottom: 10px;" />
                    <button class="btn " type="button" style="height: 46px; margin-top: 10px; margin-bottom: 10px;">
                        <font-awesome-icon icon=" fas fa-search" />

                    </button>
                </div>
            </form>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                        <li> <a href="#" class="dropdown-item " @click="Profil" style="text-decoration :none">Profil</a>
                        </li>

                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a href="#" class="dropdown-item " id="submit" type="submit" @click="logout"
                                style="text-decoration :none">Logout</a></li>


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

                            <router-link :to="platform"
                                v-if="isAdminUAE || isPresidentUAE || isAdminEtablissement || isRHEtablissement || isEnseignant">
                                <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon=" fas fa-tachometer-alt" /></div>
                                    Dashboard
                                </a></router-link>

                            <router-link :to="Tables" v-if="isAdminUAE || isPresidentUAE"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-school" /></div>
                                    Etablissements
                                </a></router-link>




                            <router-link :to="Interventions"
                                v-if="isAdminUAE || isPresidentUAE || isAdminEtablissement || isRHEtablissement || isEnseignant">
                                <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-chalkboard-user" />
                                    </div>
                                    Interventions
                                </a></router-link>


                            <router-link :to="ListeDesAdmines" v-if="isAdminUAE || isAdminEtablissement"> <a href="#"
                                    class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-list" />
                                    </div>
                                    Liste des Admins
                                </a></router-link>

                            <router-link :to="AddAdmin" v-if="isAdminUAE || isAdminEtablissement"> <a href="#"
                                    class="nav-link" style="text-decoration: none;">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-user-plus" /></div>
                                    Ajouter un Admin
                                </a></router-link>


                            <router-link :to="Paiement"
                                v-if="isAdminUAE || isPresidentUAE || isRHEtablissement || isEnseignant"> <a href="#"
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
                        <h1 class="mt-4">Ajouter un Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">
                                <router-link :to="platform">
                                    <a href="#">Dashboard</a>
                                </router-link>
                            </li>
                            <li class="breadcrumb-item active">Ajouter un Admin</li>
                        </ol>
                        <div class="card ">
                            <div class="card-body">
                                Veuillez saisir les informations requises !
                            </div>
                        </div>

                        <div class="costum bg-color">
                            <div id="layoutAuthentication">
                                <div id="layoutAuthentication_content">
                                    <main>
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col">
                                                    <div class="card border-0 rounded-lg ">
                                                        <div class="card-body">
                                                            <form @submit.prevent="AjouterAdmin">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating mb-3">

                                                                            <label for="inputppr"
                                                                                style="font-weight: bold;">PPR :
                                                                            </label><br><br>
                                                                            <input class="form-control"
                                                                                style="height: 50px;" id="inputppr"
                                                                                type="text" autocomplete="off" v-model="ppr"
                                                                                required />

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">

                                                                        <div class="form-floating mb-3">

                                                                            <label for="inputLastName"
                                                                                style="font-weight: bold;">Nom :
                                                                            </label><br><br>

                                                                            <input class="form-control" id="inputLastName"
                                                                                style="height: 50px;" type="text"
                                                                                autocomplete="off" v-model="nom" required />
                                                                        </div>




                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating mb-3">

                                                                            <label for="inputFirstName"
                                                                                style="font-weight: bold;">Prénom :
                                                                            </label><br><br>
                                                                            <input class="form-control" id="inputFirstName"
                                                                                style="height: 50px;" type="text"
                                                                                autocomplete="off" v-model="prenom"
                                                                                required />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-floating mb-3 ">


                                                                            <label for="inputEmail"
                                                                                style="font-weight: bold;">Adresse Email :
                                                                            </label><br><br>
                                                                            <input class="form-control" id="inputEmail"
                                                                                style="height: 50px;" type="email"
                                                                                autocomplete="off" v-model="email"
                                                                                required />


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating mb-3 ">

                                                                            <label for="inputtype"
                                                                                style="font-weight: bold;">type
                                                                            </label><br><br>

                                                                            <input class="form-control"
                                                                                style="height: 50px;" type="text"
                                                                                autocomplete="off" v-model="type"
                                                                                required />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating ">

                                                                            <label for="inputetab"
                                                                                style="font-weight: bold;">Etablissement :
                                                                            </label><br><br>
                                                                            <input class="form-control" style="height: 50px;"
                                                                            type="text" autocomplete="off" v-model="id_etab"
                                                                            required />



                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <label for="inputpwd" style="font-weight: bold;">Mot de
                                                                    passe :
                                                                </label><br><br>
                                                                <input class="form-control" style="height: 50px;"
                                                                    id="input" type="password" autocomplete="off"
                                                                    v-model="password" required />

                                                            

                                 

                                                                <div class="mt-4 mb-0">


                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between mt-4 mb-0">

                                                                        <a href="#" class="small" type="reset">Annuler</a>

                                                                        <button class="btn" id="submit" type="submit" style="text-decoration: none; background-color: #343090;">Ajouter</button>


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
                <footer class="py-3  mt-auto ">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between ">
                            <div> Copyright &copy; <strong>HSup.UAE 2023</strong> </div>
                            <div> Dévelopé par <em style="font-weight: bold;"> Guerriers</em>
                                <div>Made with 💜</div>

                            </div>
                        </div>

                    </div>
                </footer>
            </div>
        </div>
    </div>
</template>
  




<style src="@/assets/styles.css"></style>


<script >

import axios from "axios";
export default {

    data() {
        return {
            home: '/',
            checkemail: 'checkemail',
            Tables: 'Tables',
            platform: 'platform',
            Interventions: 'Interventions',
            AddAdmin: 'AddAdmin',
            Paiement: 'Paiement',
            ListeDesAdmines: 'ListeDesAdmines',
            etablissements: [],


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

            ppr: '',
            nom: '',
            prenom: '',
            password: '',
            id_etab: '',
            email: '',
            type: '',





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

    methods:
    {
        AjouterAdmin() {
            const authToken = this.$store.getters.getData.data.token.plainTextToken;
            const formData = {
                ppr: this.ppr,
                nom: this.nom,
                prenom: this.prenom,
                password: this.password,
                id_etab: this.id_etab,
                email: this.email,
                type: this.type
            };

            axios.post('http://localhost:8000/api/register_administrateur', formData, {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            })
                .then(response => {
                    console.log(response.data);
                    const responseData = response.data;
                    if (typeof responseData === 'object' && responseData.hasOwnProperty('data')) {
                        const { data } = responseData;
                        // Handle the `data` as needed
                        console.log(data);
                        alert('Admin ajouté avec succés'); // Display the success message
                        // Clear the form fields
                        this.ppr = '';
                        this.nom = '';
                        this.password = '';
                        this.prenom = '';
                        this.id_etab = '';
                        this.email = '';
                        this.type = '';
                    } else {
                        console.error('Invalid response data structure');
                        
                    }
                })
                .catch(error => {

                    if (error.response.status === 422) {
                        const errors = error.response.data.errors;
                        console.log(errors);
                    } else {
                        console.log(error);
                    }
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
        logout() {

const authToken = this.$store.getters.getData.data.token.plainTextToken;

axios.post('http://localhost:8000/api/logout', {}, {
    headers: {
        Authorization: `Bearer ${authToken}`,
    },
})
    .then(response => {
        this.logout = response.data;
        console.log(this.logout);

        // Redirect to the home page or any other desired page

        this.$router.push('/');
        alert('Déconnexion effectuée avec succès');
    })
    .catch(error => {
        // Handle any errors that occur during the request
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

    }





}

</script>