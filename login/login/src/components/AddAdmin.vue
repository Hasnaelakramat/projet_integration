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
                    <input class="form-control" type="text" placeholder="Rechercher ..." aria-label="Search for..."
                        aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button">
                        <font-awesome-icon icon="fas fa-search" />
                    </button>
                </div>
            </form>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <router-link :to="Profil">
                                <a href="#" class="dropdown-item">Profil</a>
                            </router-link>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <router-link :to="home">
                                <a href="#" class="dropdown-item">Logout</a>
                            </router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <br />

                            <router-link :to="platform">
                                <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon">
                                        <font-awesome-icon icon="fas fa-tachometer-alt" />
                                    </div>
                                    Dashboard
                                </a>
                            </router-link>

                            <router-link :to="Tables">
                                <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon">
                                        <font-awesome-icon icon="fa-solid fa-school" />
                                    </div>
                                    Etablissements
                                </a>
                            </router-link>

                            <router-link :to="Interventions">
                                <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon">
                                        <font-awesome-icon icon="fa-solid fa-chalkboard-user" />
                                    </div>
                                    Interventions
                                </a>
                            </router-link>

                            <router-link :to="AddAdmin">
                                <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon">
                                        <font-awesome-icon icon="fa-solid fa-user-plus" />
                                    </div>
                                    Ajouter un admin
                                </a>
                            </router-link>

                            <router-link :to="Paiement">
                                <a href="#" class="nav-link ">
                                    <div class="sb-nav-link-icon">
                                        <font-awesome-icon icon="fa-solid fa-credit-card" />
                                    </div>
                                    Paiement
                                </a>
                            </router-link>


                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ username }}
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

                        <div class="costum bg-color">
                            <div id="layoutAuthentication">
                                <div id="layoutAuthentication_content">
                                    <main>
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col">
                                                    <div class="card border-0 rounded-lg ">
                                                        <div class="card-body">
                                                            <form>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating mb-3">

                                                                            <label for="inputppr"
                                                                                style="font-weight: bold;">PPR :
                                                                            </label><br><br>
                                                                            <input class="form-control"
                                                                                style="height: 50px;" id="inputppr"
                                                                                type="text" autocomplete="off"
                                                                                v-model="ppr" required />




                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating ">


                                                                                <label for="inputLastName"
                                                                                style="font-weight: bold;">Nom :
                                                                            </label><br><br>
                                                                            
                                                                            <input class="form-control" id="inputLastName"
                                                                                style="height: 50px;"
                                                                                type="text" autocomplete="off"
                                                                                v-model="nom" required />

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating">

                                                                              <label for="inputFirstName" style="font-weight: bold;">Prénom :
                                                                            </label><br><br>
                                                                            <input class="form-control" id="inputFirstName"
                                                                                style="height: 50px;"
                                                                                type="text" autocomplete="off"
                                                                                v-model="prenom" required />

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating ">

                                                                            <label for="inputetab" style="font-weight: bold;">Etablissement :
                                                                            </label><br><br>
                                                                            <input class="form-control" id="inputetab"
                                                                                style="height: 50px;"
                                                                                type="text" autocomplete="off"
                                                                                v-model="etab" required />

                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-floating ">


                                                                    <label for="inputEmail" style="font-weight: bold;">Adresse Email :
                                                                            </label><br><br>
                                                                            <input class="form-control" id="inputEmail"
                                                                                style="height: 50px;"
                                                                                type="email" autocomplete="off"
                                                                                v-model="email" required />

                                                                  
                                                                </div>
                                                                <div class="">
                                                                    <label for="typeAdmin" style="font-weight: bold;">Veuillez choisir le type de
                                                                        l'admin :</label><br><br>
                                                                    <select name="typeAdmin" id="typeAdmin"
                                                                        class="form-select">
                                                                        <option value="">--Veuillez choisir--</option>
                                                                        <option value="Directeur">Directeur d'un
                                                                            établissement</option>
                                                                        <option value="RH">RH d'un établissement</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mt-4 mb-0">


                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between mt-4 mb-0">

                                                                        <a href="#"
                                                                                class="small" type="reset">Annuler</a>

                                                                        <a href="#" class="btn " id="submit" type="submit"
                                                                            @click="AjouterAdmin()"
                                                                            style="text-decoration: none;">
                                                                            Ajouter</a>

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
            Paiement: 'Paiement'

        }
    },

    methods:
    {

    }





}

</script>