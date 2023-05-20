
import { homedir } from 'os';

<template>

  <div class="custom-bg-color">
    <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">
        <main>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                  <div class="card-header" >
                    <h3 class="text-center  my-4">Réinitialiser le mot de passe</h3>
                  </div>
                  <div class="card-body">
                    <div class="small mb-3 text-muted">Entrer votre addresse email et nous allons vous envoyer un lien
                      pour réinitialiser votre mot de passe.</div>
                    <form>
                      
                      <!-- <div class="form-floating mb-3"> -->
                        <label for="inputEmail" class="mb-2">Adresse  : </label><br>
                        <input class="form-control  mb-3" style="height: 50px;" id="inputEmail" type="email" placeholder="nom@exemple.com" autocomplete="off" v-model="email" required />

                        
                      <!-- </div> -->
                      <div class="d-flex align-items-center justify-content-between mt-4 mb-0">


                        <router-link :to="home"> <a href="#" class="small ">CONNEXION</a></router-link>

                        <router-link :to="checkemail"> <a href="#" class="btn  ">Valider</a></router-link>

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
      checkemail:'checkemail'

    }
  },

  methods: {
    ForgotPassword(){

    }




  }




}



</script>