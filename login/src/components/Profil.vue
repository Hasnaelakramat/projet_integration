<template>
    <div class="custom-bg-color">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Profil</h3>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="inputFirstName">Prénom :</label>
                                                    <br>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <div class="form-control" id="inputFirstName" type="text"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputLastName">Nom :</label>
                                                    <br>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <div class="form-control" id="inputLastName" type="text"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail">Email :</label>
                                                <br>
                                                <div class="form-floating mb-3 mb-md-0">

                                                    <div class="form-control" id="inputEmail" type="email"> </div>
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputEmail">Télephone : </label>
                                                <br>
                                                <div class="form-floating mb-3 mb-md-0">

                                                    <div class="form-control" id="inputEmail" type="email"> </div>
                                                </div>
                                                <h4> Changer le mot de passe : </h4>
                                                <br>
                                        
                                    
                                            </div>






                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password"
                                                            placeholder="Create a password" />
                                                        <label for="inputPassword">Ancien Mot de passe :</label>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password"
                                                            placeholder="Create a password" />
                                                        <label for="inputPassword">Nouveau Mot de passe</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm"
                                                            type="password" placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm">Confirmer le nouveau mot de
                                                            passe</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">

                                                <div class="d-grid">

                                                    <router-link :to="platform"> <a href="#"
                                                            class="btn btn-primary btn-block "
                                                            id="submit">Valider</a></router-link>

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
</template>



<script>
export default {

    data() {
        return {
            email: '',
            password: '',
            passwordError: '',
            home: '/',
            checkemail: 'checkemail',
            platform:'platform'

        }
    },

    methods: {
        ForgotPassword() {

        }




    }




}



</script>