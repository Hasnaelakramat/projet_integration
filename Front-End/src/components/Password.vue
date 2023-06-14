<template>
  <div class="custom-bg-color">
    <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">
        <main>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col">
                <div class="card border-0 rounded-lg mt-5">
                  <div class="card-header">
                    <h3 class=" my-4 text-nontransparent">Mot de passe oublié ?</h3>
                  </div>
                  <div class="card-body">
                    <div class="mb-3 text-muted">
                      Entrer votre adresse email et nous allons vous envoyer un code confidentiel pour réinitialiser votre
                      mot de passe.
                    </div>
                    <form>
                      <label for="inputEmail" class="mb-2" style="font-weight: bold;">Adresse E-mail:</label><br>
                      <input class="form-control mb-3" style="height: 50px;" id="inputEmail" type="email"
                        placeholder="nom@exemple.com" v-model="email" required>
                      <span v-if="emailError" class="error-message">{{ emailError }}</span>
                      <br>


                      <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                        <router-link :to="home"><a href="#" class="small">Connexion</a></router-link>

                        <a href="#" class="btn" type="submit" @click="forgotPassword"
                          style="text-decoration: none;">Valider</a>
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
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      home: '/',
      checkemail: '/checkemail'
    };
  },


  computed: {
    data() {
      return this.$store.getters.getData;

    },


  },





  methods: {
    validateForm() {
      this.emailError = '';
      let isValid = true;

      // Validation de l'email
      if (!this.email) {
        this.emailError = 'Veuillez saisir votre email .';
        isValid = false;
      } else if (!/\S+@\S+\.\S+/.test(this.email)) {
        this.emailError = 'Veuillez saisir un email valide.';
        isValid = false;
      }

      return isValid;
    },
    forgotPassword() {
      if (this.validateForm()) {
        axios
          .post('http://localhost:8000/api/forgot_password', { email: this.email })
          .then(response => {
            console.log(response.data);
            this.$router.push('/checkemail');
          })
          .catch(error => {
            console.error(error);
            alert("Aucun utilisateur avec cet email ! Veuillez saisir un email valide");
          });
      } else {
        alert("Veuillez corriger les erreurs dans le formulaire avant de soumettre.");
      }
    },



  }

};
</script>

<style>
.error-message {
  color: red;
  font-size: 16px;
}
</style>