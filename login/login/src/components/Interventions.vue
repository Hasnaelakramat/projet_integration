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
                            <router-link :to="AddAdmin"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-user-plus" /></div>
                                    Ajouter un admin
                                </a></router-link>


                            <router-link :to="Paiement"> <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon"> <font-awesome-icon icon="fa-solid fa-credit-card" />
                                    </div>
                                    Paiement
                                </a></router-link>


                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
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
                            </div>


                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Interventions</h1>
                        <ol class="breadcrumb mb-4">
                          
                          <li class="breadcrumb-item"> <router-link :to="platform"><a href="#">Dashboard</a>  </router-link></li>
                          <li class="breadcrumb-item active">Interventions</li>
                      </ol>
                       

                        <div> Tanger
                            <ul>

                                <router-link :to="InterventionsDetails"> <a href="#" >
                                    
                                    <li>Faculté de Médecine et de Pharmacie</li>
                                </a></router-link>
                                <li>Faculté des Sciences et Techniques</li>
                                <li> Ecole Supérieure Roi Fahd de Traduction</li>
                                <li>Ecole Nationale des Sciences Appliquées</li>
                                <li>Ecole Nationale de Commerce et de Gestion</li>
                                <li>Faculté des Sciences Juridiques, Economiques et Sociales</li>
                            </ul>
                        </div>

                        <div>Tétouan
                            <ul>
                                <li>Faculté des Sciences</li>
                                <li>Ecoles Nationales des Sciences Appliquées</li>
                                <li>Faculté des Sciences Juridiques, Economiques et Sociales</li>
                                <li>Ecole Normale Supérieure</li>
                                <li>Faculté des Lettres et des Sciences Humaines</li>
                                <li>Faculté Oussoul Eddine</li>
                            </ul>
                    


                        </div>

                        <div>Larache
                            <ul>
                                <li>Faculté Polydisciplinaire</li>
                            
                            </ul>
                        </div>

                        
                        <div>Al Hoceima

                            <ul>
                                <li>Faculté des Sciences et Techniques</li>
                                <li>Ecole Nationale des Sciences Appliquées</li>
                            
                            </ul>
                        </div>


                       
                   
                   
 </div>
           
            </main>

        </div>
    </div>




</div></template>




<style src="@/assets/styles.css"></style>


<script >


export default {

    data() {
        return {
            home: '/',
            checkemail: 'checkemail',
            Tables: 'Tables',
            platform: 'platform',
            Profil: 'Profil',
            Interventions: 'Interventions',
            AddAdmin:'AddAdmin',
            Paiement:'Paiement',
            InterventionsDetails:'InterventionsDetails'

        }
    },

    methods:
    {

    }





}

</script>