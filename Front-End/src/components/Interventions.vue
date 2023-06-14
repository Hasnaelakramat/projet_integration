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
                        <h1 class="mt-4">Interventions</h1>
                        <ol class="breadcrumb mb-4">

                            <li class="breadcrumb-item"> <router-link :to="platform"><a href="#">Dashboard</a>
                                </router-link></li>
                            <li class="breadcrumb-item active">Interventions</li>
                        </ol>
                        <div v-if="isAdminUAE || isPresidentUAE" class="card mb-4">
                            <div class="card-body">
                                Vous trouvez ici les differents établissements de l'université abdelmalek essaadi!
                                <br>
                                Veuillez selectionner un établissement pour voir les interventions qui le concernent
                            </div>
                        </div>


                        <div v-if="isAdminEtablissement || isRHEtablissement" class="card mb-4">
                            <div class="card-body">

                                <form class="input-group" v-if="isAdminEtablissement || isRHEtablissement">
                                    <div class="d-flex align-items-center">
                                        <router-link :to="AddIntervention">
                                            <button type="button" class="btn" id="AddIntervention">
                                                <font-awesome-icon icon="fas fa-plus" />
                                            </button>
                                        </router-link>
                                        <h6 class="ms-2">Ajouter une intervention ?</h6>
                                    </div>
                                </form>



                            </div>
                        </div>


                        <ul v-if="isAdminUAE || isPresidentUAE" v-for="item in etablissements">


                            <li><strong>
                                    <button class="goto" @click="details(item.id_etab)"></button>
                                    {{ item.code }},


                                    {{ item.nom }},

                                    {{ item.ville }}</strong>
                            </li>

                        </ul>

                        <div v-if="isAdminEtablissement || isRHEtablissement">
                            <router-link :to="InterventionsDetails">
                                <strong>

                                    <button class="goto">
                                        <font-awesome-icon icon="fa-solid fa-broom-ball" />
                                    </button>

                                    Voir l'ensemble des interventions de votre etablissement
                                </strong>
                            </router-link>

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
import { bottom } from '@popperjs/core';
import axios from 'axios';



export default {
    data() {
        return {
            home: "/",
            checkemail: "checkemail",
            Tables: "Tables",
            platform: "platform",
            Interventions: "Interventions",
            AddAdmin: "AddAdmin",
            Paiement: "Paiement",
            ListeDesAdmines: "ListeDesAdmines",
            listeEnseignants: "/listeEnseignants",
            InterventionsDetails: "/InterventionsDetails",
            etablissements: [],
            AddEtab: "AddEtab",
            etablissementId: "",
            AddIntervention: "/AddIntervention",
            profile: {
                firstName: "",
                lastName: "",
                email: "",
                telephone: "",
            },
            isPresidentUAE: false,
            isAdminUAE: false,
            isAdminEtablissement: false,
            isRHEtablissement: false,
            isEnseignant: false,
        };
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
        this.listeEtabs();
    },
    created() {
        this.etablissementId = this.$route.params.id;
    },
    methods: {
        details(id_etab) {
            console.log('id_etab: ' + id_etab);
            this.$router.push(`/InterventionsDetails/${id_etab}/details`);
        },
        listeEtabs() {
            const authToken = this.$store.getters.getData.data.token.plainTextToken;
            // Make the API request
            axios.get("http://localhost:8000/api/show_etablissements", {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            }).then(response => {
                console.log(response.data);
                this.etablissements = response.data;
                const router = useRouter();
                router.push({ path: "/InterventionsDetails/" + etablissementId });
            })
                .catch(error => {
                    console.error(error);
                });
        },
        Profil() {
            const authToken = this.$store.getters.getData.data.token.plainTextToken;
            console.log("token:", authToken);
            axios.get("http://localhost:8000/api/profile", {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            })
                .then(response => {
                    this.profile = response.data;
                    console.log(this.profile);
                    this.$store.dispatch("setProfilData", response.data);
                    this.$router.push("/Profil");
                })
                .catch(error => {
                    console.error(error);
                });
        },
        logout() {
            const authToken = this.$store.getters.getData.data.token.plainTextToken;
            axios.post("http://localhost:8000/api/logout", {}, {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            })
                .then(response => {
                    this.logout = response.data;
                    console.log(this.logout);
                    // Redirect to the home page or any other desired page
                    this.$router.push("/");
                    alert("Déconnexion effectuée avec succès");
                })
                .catch(error => {
                    // Handle any errors that occur during the request
                    console.error(error);
                });
        },
        statut() {
            if (this.getType === "Président de l'UAE") {
                this.isPresidentUAE = true;
            }
            else if (this.getType === "Admin de l'UAE") {
                this.isAdminUAE = true;
            }
            else if (this.getType == "Admin d'un établissement") {
                this.isAdminEtablissement = true;
            }
            else if (this.getType == "RH d'un établissement") {
                this.isRHEtablissement = true;
            }
            else if (this.getType == "Enseignant") {
                this.isEnseignant = true;
            }
        },
    },
    components: { bottom }
}

</script>