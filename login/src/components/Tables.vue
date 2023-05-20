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
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><font-awesome-icon icon=" fas fa-user fa-fw" /></a>
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




                            <router-link :to="platform"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-chalkboard-user" />
                                    </div>
                                    Interventions
                                </a></router-link>

                            <router-link :to="platform"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-user-plus" /></div>
                                    Ajouter un admin
                                </a></router-link>


                            <router-link :to="platform"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-credit-card" />
                                    </div>
                                    Paiement
                                </a></router-link>


                            <!-- <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                        data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                        aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"> <font-awesome-icon
                                                icon=" fas fa-angle-down" /></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                        data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                        data-bs-target="#pagesCollapseError" aria-expanded="false"
                                        aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><font-awesome-icon
                                                icon=" fas fa-angle-down" /></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                        data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div> -->


                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Username
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Etablissements</h1>
                        <ol class="breadcrumb mb-4">
                          
                            <li class="breadcrumb-item"> <router-link :to="platform"><a href="#">Dashboard</a>  </router-link></li>
                            <li class="breadcrumb-item active">Etablissements</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Vous trouvez ici les informations sur l'université abdelmalek essaadi !
                                
                        </div>
                    </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <font-awesome-icon icon="fa-solid fa-building-columns" /> UAE :                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nom de l'établissement</th>
                                            <th>Ville</th>
                                            <th>Téléphone</th>
                                            <th>Fax</th>
                                            <th>E-mail</th>
                                            <th>Site Web</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Faculté de Médecine et de Pharmacie</td>
                                            <td>Tanger</td>
                                            <td>(+212)539393744</td>
                                            <td>(+212)539393743</td>
                                            <td>info@ensat.ac.ma</td>
                                            <td>www.fmpt.ac.ma</td>
                                        </tr>
                                        <tr>
                                            <td>Faculté des Sciences et Techniques</td>
                                            <td>Tanger</td>
                                            <td>(+212)539393954/55</td>
                                            <td>(+212)539393953</td>
                                            <td>administration@fstt.ac.ma</td>
                                            <td>www.fstt.ac.ma</td>
                                        </tr>


                                        <tr>
                                            <td>Bradley Greer</td>
                                            <td>Software Engineer</td>
                                            <td>London</td>
                                            <td>41</td>
                                            <td>2012/10/13</td>
                                            <td>$132,000</td>
                                        </tr>
                                        <tr>
                                            <td>Dai Rios</td>
                                            <td>Personnel Lead</td>
                                            <td>Edinburgh</td>
                                            <td>35</td>
                                            <td>2012/09/26</td>
                                            <td>$217,500</td>
                                        </tr>
                                        <tr>
                                            <td>Jenette Caldwell</td>
                                            <td>Development Lead</td>
                                            <td>New York</td>
                                            <td>30</td>
                                            <td>2011/09/03</td>
                                            <td>$345,000</td>
                                        </tr>
                                    
                                        
                                    </tbody>
                                </table>
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

export default {



//     created(){
//         $(document).ready( function () {
//             $.noConflict();
//             $('#myTable').DataTable({
//                 "processing": true,
//                 "serverSide": true,
//                 "ajax": "api/student/list",
//                 "columns": [
//                     { "data": "id" },
//                     { "data": "name" },
//                     { "data": "fatherName" },
//                     { "data": "rollNo" },
//                     { "data": "class" },
//                 ]
//             });
// });


//     },

    data() {
        return {

            home: '/',
            checkemail: 'checkemail',
            Tables: 'Tables',
            platform: '/platform',
            Profil: 'Profil'

        }
    },

    methods: {
        getUsers(){
            axios.get('')
        }

    }




}
</script>

