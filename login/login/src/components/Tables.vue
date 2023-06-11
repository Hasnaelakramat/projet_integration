<template>
    <div class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <router-link :to="platform"> <a href="#" class="navbar-brand ps-3 ">Nom du site web </a></router-link>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link  order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><font-awesome-icon
                    icon=" fas fa-bars" />
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
            <!-- Navbar-->
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
                        <h1 class="mt-4">Etablissements</h1>
                        <ol class="breadcrumb mb-4">

                            <li class="breadcrumb-item"> <router-link :to="platform"><a href="#">Dashboard</a>
                                </router-link></li>
                            <li class="breadcrumb-item active">Etablissements</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Vous trouvez ici les informations sur les établissements de l'université abdelmalek essaadi
                                !
                                <hr>
                                <div>
                                    <h6> Ajouter un établissement ?</h6>
                                    <router-link :to="AddEtab"><button type="button" class="btn " id="addEtab">
                                            <font-awesome-icon icon=" fas fa-plus" />
                                        </button></router-link>
                                </div>


                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
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
                                                    <th>Code</th>
                                                    <th>Nom de l'établissement</th>
                                                    <th>Téléphone</th>
                                                    <th>Fax</th>
                                                    <th>Ville</th>
                                                    <th>Nombre d'enseignants</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template v-for="item in etablissements">
                                                    <tr>
                                                        <td>{{ item.code }}</td>
                                                        <td>{{ item.nom }}</td>
                                                        <td>{{ item.telephone }}</td>
                                                        <td>{{ item.faxe }}</td>
                                                        <td>{{ item.ville }}</td>
                                                        <td>{{ item.nbr_enseignants }}</td>
                                                    </tr>

                                                </template>






                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </main>

            </div>
        </div>
    </div>
</template>






<script>
import axios from 'axios';
// import { mapGetters, mapActions } from 'vuex';


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
            searchText: '',
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
        };
    },




    computed: {
        // ...mapGetters(['getEtablissements']),
        // etablissements() {
        //   return this.getEtablissements;
        // },
        data() {
            return this.$store.getters.getData;
        },
        getType() {
            return this.$store.getters.getType;
        }
    },

    //   created() {
    //     this.fetchEtablissements(); // Dispatch the action to fetch the etablissements data
    //   },



    mounted() {
        this.listeEtabs();
        this.statut();
    },

    methods: {
        // ...mapActions(['fetchEtablissements']),

        listeEtabs() {
            const authToken = this.$store.getters.getData.data.token.plainTextToken;
            // Make the API request
            axios.get('http://localhost:8000/api/show_etablissements', {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            }).then(response => {
                console.log(response.data);
                this.etablissements = response.data;
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



