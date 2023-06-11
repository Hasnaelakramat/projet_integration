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
                    <input class="form-control" type="text" placeholder="Rechercher ..." aria-label="Search for..."
                        aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"> <font-awesome-icon
                            icon=" fas fa-search" />

                    </button>
                </div>
            </form>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <li> <router-link :to="Profil"> <a href="#" class="dropdown-item ">Profil </a></router-link>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li> <router-link :to="home"> <a href="#" class="dropdown-item ">Logout </a></router-link> </li>

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

                            <router-link :to="platform"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon=" fas fa-tachometer-alt" /></div>
                                    Dashboard
                                </a></router-link>

                            <router-link :to="Tables"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-school" /></div>
                                    Etablissements
                                </a></router-link>




                            <router-link :to="Interventions"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-chalkboard-user" />
                                    </div>
                                    Interventions
                                </a></router-link>

                                    
                            <router-link :to="ListeDesAdmines"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-list" />
                                    </div>
                                    ListeDesAdmins
                                </a></router-link>

                            <router-link :to="AddAdmin"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-user-plus" /></div>
                                    Ajouter un Admin
                                </a></router-link>


                            <router-link :to="Paiement"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-credit-card" />
                                    </div>
                                    Paiement
                                </a></router-link>


                            


                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main class="main">
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Listes des Administrateurs</h1>
                        <ol class="breadcrumb mb-4">

                            <li class="breadcrumb-item"> <router-link :to="platform"><a href="#">Dashboard</a>
                                </router-link></li>
                            <li class="breadcrumb-item active">Listes des Administrateurs</li>
                        </ol>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
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
                                                <th>PPR </th>
                                                <th>Nom </th>
                                                <th>Prénom</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <template v-for="item in tableData">

                                            <tr>
                                                <td>{{item.ppr}}</td>
                                                <td>{{item.nom}}</td>
                                                <td>{{ item.prenom }}</td>
                                            </tr>
                                        </template>
                                        
                                            <!-- <tr>
                                                <td>Faculté des Sciences et Techniques</td>
                                                <td>Tanger</td>
                                                <td>(+212)539393954/55</td>
                                                <td>(+212)539393953</td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td>Ecole Supérieure Roi Fahd de Traduction</td>
                                                <td>Tanger</td>
                                                <td> (+212)539942813</td>
                                                <td>(+212)539940835</td>
                                                <td></td>
                                            </tr>



                                            <tr>
                                                <td>Ecole Nationale de Commerce et de Gestion</td>
                                                <td>Tanger</td>
                                                <td>(+212)539313487/88</td>
                                                <td>(+212)539313493</td>
                                                <td></td>
                                            </tr>




                                            <tr>
                                                <td>Ecole Nationale des Sciences Appliquées</td>
                                                <td>Tanger</td>
                                                <td>(+212)539393744</td>
                                                <td>(+212)539393743</td>
                                                <td></td>
                                            </tr>



                                            <tr>
                                                <td>Faculté des Sciences et Techniques</td>
                                                <td>Tanger</td>
                                                <td>(+212)539393954/55</td>
                                                <td>(+212)539393953</td>
                                                <td></td>
                                            </tr>
 -->




                                        </tbody>
                                    </table>
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
            platform: 'platform',
            Profil: 'Profil',
            Interventions: 'Interventions',
            AddAdmin: 'AddAdmin',
            Paiement: 'Paiement',
            Interventions: 'Interventions',
            ListeDesAdmines:'ListeDesAdmines',
            tableData:[],

        }
    },

    computed: {
        // data() {
        //     return this.$store.getters.getData;
        // },
        // gettableData() {
        //   return this.$store.getters.gettableData;
        // },
        getType() {
            return this.$store.getters.getType;
        }
    },


    mounted() {
        this.fetchData();
    },

    methods: {
        fetchData() {
            const authToken = this.$store.getters.getData.data.token.plainTextToken;
            // Make the API request
            axios.get('http://localhost:8000/api/show_admin_list', {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            }).then(response => {
                console.log(response.data);
                this.tableData = response.data;
            })
                .catch(error => {
                    console.error(error);
                });
        },
    }





}

</script>

<style>
/* .main{
   background-image:url(../assets/UAE2.png);
   background-repeat: no-repeat;
   height: 170px;
   background-position: right; 
   margin-top:  10px;

} */
</style>