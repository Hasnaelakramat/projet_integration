
import { homedir } from 'os';

<template>

  <div class="custom-bg-color">
    <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">
        <main>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col">
                <div class="card border-0 rounded-lg mt-5">
                  <div class="card-header" >
                    <h3 class="text-center  my-4">Réinitialisation du mot de passe</h3>
                  </div>
                  <div class="card-body">
                
                    <form @submit.prevent="resetPassword">
                 
                        <label for="inputPassword" class="mb-2" style="font-weight: bold;">Nouveau mot de passe: </label><br>
                        <input class="form-control  mb-3" style="height: 50px;" id="inputEmail" type="email" placeholder="*********" autocomplete="off" v-model="email" required />

                        <label for="inputPassword" class="mb-2" style="font-weight: bold;">Confirmer le mot de passe: </label><br>
                        <input class="form-control  mb-3" style="height: 50px;" id="inputEmail" type="email" placeholder="*********" autocomplete="off" v-model="email" required />



                        <router-link :to="home"> <a href="#" class="btn"   style="text-decoration: none;" >Valider</a></router-link>

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


<!-- forgotpassword -->
<!-- entrer le code de verification : input -->
  


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