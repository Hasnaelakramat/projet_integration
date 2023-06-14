<template>
    <div class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <router-link :to="platform"> <a href="#" class="navbar-brand ps-3 ">HSup.UAE </a></router-link>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link  order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><font-awesome-icon
                    icon=" fas fa-bars" />
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
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><font-awesome-icon icon=" fas fa-user fa-fw" /></a>
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

                            <router-link :to="listeEnseignants"
                                v-if="isAdminEtablissement || isRHEtablissement || isPresidentUAE || isAdminUAE"> <a
                                    href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-list" /></div>
                                    Listes des enseignants
                                </a></router-link>

                            <router-link :to="ListeDesAdmines" v-if="isAdminUAE || isPresidentUAE"> <a href="#"
                                    class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-list" />
                                    </div>
                                    Liste des Admins
                                </a></router-link>

                            <router-link :to="AddAdmin" v-if="isAdminUAE || isPresidentUAE"> <a href="#" class="nav-link">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-user-plus" /></div>
                                    Ajouter un Admin
                                </a></router-link>


                            <router-link :to="Paiement"
                                v-if="isAdminUAE || isPresidentUAE || isRHEtablissement || isEnseignant || isAdminEtablissement">
                                <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-credit-card" />
                                    </div>
                                    Paiement
                                </a></router-link>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer py-3  mt-auto ">
                        <div class="">Connecté en tant que :</div>
                        {{ getType }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Détails des Interventions</h1>
                        <ol class="breadcrumb mb-4">

                            <li class="breadcrumb-item"> <router-link :to="Interventions"><a href="#">Interventions</a>
                                </router-link></li>
                            <li class="breadcrumb-item active">Détails des Interventions</li>
                        </ol>
                  
                        <div class="card mb-4">
                            <div class="cardTable">
                                <font-awesome-icon icon="fa-solid fa-building-columns" /> UAE :
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" v-model="searchText"
                                            placeholder="Rechercher" />
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Intitulé Intervention</th>
                                                    <th>Nom de l'enseignant</th>
                                                    <th>Prénom de l'enseignant</th>
                                                    <th>Etablissement</th>
                                                    <th>A.U</th>
                                                    <th>Semestre</th>
                                                    <th>Date de début</th>
                                                    <th>Date de fin</th>
                                                    <th>Nombre d'heures</th>
                                                    <th>Validation de l'établissement</th>
                                                    <th>Validation de l'université</th>
                                                </tr>
                                            </thead>




                                            <tbody>
                                                <tr v-for="intervention in interventions" :key="intervention.id">

                                                    <td>{{ intervention.intitule_intervention }}</td>
                                                    <td>{{ intervention.nomEnseignant }}</td>
                                                    <td>{{ intervention.prenomEnseignant }}</td>
                                                    <td>{{ intervention.nomEtab }}</td>
                                                    <td>{{ intervention.annee_univ }}</td>
                                                    <td>{{ intervention.semestre }}</td>
                                                    <td>{{ intervention.date_debut }}</td>
                                                    <td>{{ intervention.date_fin }}</td>
                                                    <td>{{ intervention.nbr_heures }}</td>
                                                    <td>{{ intervention.visa_etab }}
                                                        <button v-if="isAdminEtablissement"
                                                            type="button" class="btn" id="valider">
                                                            <font-awesome-icon icon="fa-solid fa-check" /> </button>
                                                    </td>
                                                    <td>{{ intervention.visa_uae }}
                                                        <button v-if=" isPresidentUAE" type="button"
                                                            class="btn" id="valider">
                                                            <font-awesome-icon icon="fa-solid fa-check" /> </button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

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


<script>
import axios from 'axios';

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
            listeEnseignants:'/listeEnseignants',
            InterventionsDetails: '/InterventionsDetails',
            interventions: [],

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
            interventionId:'',

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
        this.interventionId=this.$route.params.id_etab
    },

    created() {
        this.getInterventions();

        // this.etablissementId = this.$route.params.id;


    },

    methods: {
        getInterventions() {
            const authToken = this.$store.getters.getData.data.token.plainTextToken;
            axios.get('http://localhost:8000/api/interventions', {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            })
                .then(response => {
                    this.interventions = response.data.interventions;
                })
                .catch(error => {
                    console.error(error);
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

