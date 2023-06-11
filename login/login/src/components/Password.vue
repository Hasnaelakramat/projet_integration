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
                    <h3 class="text-center my-4">Saisir votre adresse email</h3>
                  </div>
                  <div class="card-body">
                    <div class="mb-3 text-muted">
                      Entrer votre adresse email et nous allons vous envoyer un code confidentiel pour réinitialiser votre mot de passe.
                    </div>
                    <form >
                      <label for="inputEmail" class="mb-2" style="font-weight: bold;">Adresse E-mail:</label><br>

                      <input class="form-control mb-3" style="height: 50px;" id="inputEmail" type="email" placeholder="nom@exemple.com" v-model="email" required>

                      <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                        <router-link :to="home"><a href="#" class="small">Connexion</a></router-link>
                       <a href="#" class="btn" type='submit' style="text-decoration: none;" @click="forgotPassword">Valider</a>
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
      return this.$store.getters.getEmailData;
    },

  },

    mounted() {
        this.forgotPassword();
    },




  methods: {
    forgotPassword() {

      const authToken =this.$store.getters.getData.data.token.plainTextToken;

      axios
        .post('http://localhost:8000/api/forgot_password', { email: this.email },{
  headers: {
    Authorization: `Bearer ${authToken}`,
  },
})
        .then(response => {
          // Handle success response
          this.email = response.data;
                console.log(this.email);
          this.$store.dispatch('setEmailData', this.email);
          console.log('my email is ',this.email);

          alert('We have sent you an email with the verification code');
          this.$router.push('/checkemail')
        })
        .catch(error => {
          // Handle error
          console.error(error);
          // Display error message to the user
          alert("Une erreur s'est produite lors de l'opertation");
        });
    }
  }
};
</script>
