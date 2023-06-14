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
                <main class="main">
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Liste des Enseignants</h1>
                        <ol class="breadcrumb mb-4">

                            <li class="breadcrumb-item"> <router-link :to="platform"><a href="#">Dashboard</a>
                                </router-link></li>
                            <li class="breadcrumb-item active">Liste des Enseignants</li>
                        </ol>
                    
                    </div>
                    <div class="card mb-4">
                        <div class="cardTable">
                            <font-awesome-icon icon="fa-solid fa-list" /> Enseignants:
                        </div>
                        <div class="card-body">
                            <div class="row">
                               
                                <form class="input-group">
                                    <div class="d-flex align-items-center">
                                        <router-link :to="AjouterEnseignant">
                                            <button type="button" class="btn" id="addEtab">
                                                <font-awesome-icon icon="fas fa-plus" />
                                            </button>
                                        </router-link>
                                        <h6 class="ms-2">Ajouter un enseignant ?</h6>
                                    </div>
                                </form>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Modifier</th>
                                                <th>Supprimer</th>
                                                <th> Nom </th>
                                                <th>Prénom</th>
                                                <th>Email</th>
                                                <th>Date de naissance</th>
                                                <th>Etablissement </th>
                                                <th>Grade</th>


                                            </tr>
                                        </thead>

                                        <tbody>
                                            <template v-for="item in tableEnseign">

                                                <tr>

                                                    <td> 
                                                            <button type="button" class="btn" id="updateEnseign" @click="update(item.id_enseign)">
                                                                <font-awesome-icon icon="fa-solid fa-pen-to-square" />
                                                            </button>
                                                    </td>

                                                    <td> <button type="button" class="btn" id="deleteEnseign"
                                                            @click="deleteEnseignant(item.id_enseign)">
                                                            <font-awesome-icon icon="fa-solid fa-user-minus" /> </button>
                                                    </td>
                                                    <td> {{ item.nom }}</td>
                                                    <td>{{ item.prenom }}</td>
                                                    <td>{{ item.email }}</td>
                                                    <td>{{ item.date_nais }}</td>
                                                    <td>{{ item.etablissement_nom }}</td>
                                                    <td>{{ item.grade }}</td>



                                                </tr>
                                            </template>


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
            tableEnseign: [],
            AjouterEnseignant: '/AjouterEnseignant',
            listeEnseignants: '/ListeEnseignants',
            UpdateEnseignant: '/UpdateEnseignant',
            // id_enseign: '',

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
        }
    },


    mounted() {
        this.getEnseign();
        this.statut();
    },
    created() {
        this.id_enseign = this.$route.params.id_enseign;
    },

    methods: {
        update(userid){
            this.$router.push(`/UpdateEnseignant/${userid}/update`);
        },
        deleteEnseignant(id) {
            const authToken = this.$store.getters.getData.data.token.plainTextToken;
            axios.delete(`http://localhost:8000/api/destroy_Enseignant/${id}`, {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            })
                .then(response => {
                    // Gérer la réponse de suppression réussie
                    console.log(response.data.message);
                    // Actualiser la liste des enseignants après la suppression
                    this.loadEnseignants();
                })
                .catch(error => {
                    // Gérer les erreurs de suppression
                    console.error(error.response.data);
                });
        },
        loadEnseignants() {
            // Charger la liste des enseignants depuis l'API
            // et mettre à jour la variable tableEnseign
        },
        getEnseign() {
            const authToken = this.$store.getters.getData.data.token.plainTextToken;
            // Make the API request
            axios.get('http://localhost:8000/api/show_enseignants', {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            }).then(response => {
                console.log(response.data);
                this.tableEnseign = response.data;
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

        updateEnseignant(id_enseign) {
            // Create an object containing the new information of the teacher
            const updatedEnseignant = {
                nom: 'nom',
                prenom: 'prénom',
                email: 'nouveau@email',
                date_nais: 'date_nais',
                id_etab: 'etablissement',
                id_grade: 'id_grade',
                // ... Add other properties to update if necessary
            };

            // Perform a POST request to your API with the new teacher information
            axios.post(`http://localhost:8000/api/update_enseignant/${id_enseign}`, updatedEnseignant)
                .then(response => {
                    // Handle the API response after a successful update
                    console.log(response.data);
                    // Perform necessary actions after a successful update
                })
                .catch(error => {
                    // Handle errors when updating the teacher
                    console.error(error);
                    // Perform necessary actions in case of an error
                });
        }

    }





}

</script>

<style></style>