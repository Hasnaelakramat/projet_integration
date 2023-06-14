<template>
    <div class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <router-link :to="platform"> <a href="#" class="navbar-brand ps-3 ">HSup.UAE</a></router-link>
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
                                v-if=" isPresidentUAE || isAdminUAE || isEnseignant ">
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
                <main class="main">
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Paiement</h1>
                        <ol class="breadcrumb mb-4">

                            <li class="breadcrumb-item"> <router-link :to="platform"><a href="#">Dashboard</a>
                                </router-link></li>
                            <li class="breadcrumb-item active">Paiement</li>
                        </ol>
                    
                    </div>
                    <div class="card mb-4">
                        <div class="cardTable">
                            <font-awesome-icon icon="fa-solid fa-money-check" /> Table des paiements :
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" v-model="searchText" placeholder="Rechercher" />
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>nom</th>
                                                <th>prenom</th>
                                                <th>Etablissement</th>
                                                <th>Annéé universitaire</th>
                                                <th>Semestre</th>
                                                <th>Volume Horaire</th>
                                                <th>Taux Horaire</th>
                                                <th>Brut</th>
                                                <th>Impôts sur le revenu</th>
                                                <th>Net</th>
                                              

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <template v-for="item in tablePaiement" :key="item.id">

                                                <tr>

                                                    <td>{{ item.nom }}</td>
                                                    <td>{{ item.prenom }}</td>
                                                    <td>{{ item.etablissement }}</td>
                                                    <td>{{ item.annee_univ }}</td>
                                                    <td>{{ item.semestre }}</td>
                                                    <td>{{ item.vh }}</td>
                                                    <td>{{ item.taux_H }}</td>
                                                    <td>{{ item.brut }}</td>
                                                    <td>{{ item.ir }}</td>
                                                    <td>{{ item.net }}</td>
                                              

                                                </tr>
                                            </template>

                                           




                                        </tbody>
                                    </table>
                                    <table> 
                                        <thead>
                                            <tr>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
            tableData:[],
            AjouterEnseignant:'/AjouterEnseignant',
            listeEnseignants:'/ListeEnseignants',
            tablePaiement: [],

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
    created() {
        this.getPaiement()
    },

    methods:
    {
        getPaiement() {
            const authToken = this.$store.getters.getData.data.token.plainTextToken;
            axios.get('http://localhost:8000/api/show_paiement', {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            })
                .then(response => {
                    this.tablePaiement = response.data;
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

<style></style>