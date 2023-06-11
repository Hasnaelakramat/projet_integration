<template>
  <div class="custom-bg-color ">
    <div id="layoutAuthentication bg-warning">
      <div id="layoutAuthentication_content  ">
        <main>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col">
                <div class="card  border-0 rounded-lg mt-5 ">
                  <div class="card-header" style="background-image: url(../assets/uae1.png);">
                    <h3 class="text-center font-weight-light my-4">Connexion à votre compte</h3>
                  </div>
                  <div class="card-body">
                    <form>
                      <label for="inputEmail" class="mb-2" style="font-weight: bold;">Adresse E-mail : </label><br>
                      <input class="form-control" style="height: 50px; " id="inputEmail" type="email"
                        placeholder="nom@exemple.com" autocomplete="off" v-model="email" required />
                      <span v-if="emailError" class="alert alert-danger mt-6">{{ emailError }}</span>
                      <br>
                    
                  
                      <label for="inputPassword" class="mb-2" style="font-weight: bold;">Mot de passe :</label><br>
                      <input class="form-control" style="height: 50px;" id="inputPassword" type="password"
                        placeholder="********" autocomplete="off" v-model="password" required />
                      <span v-if="passwordError" class="error-message">{{ passwordError }}</span>

                      <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                        <router-link :to="Password"> <a href="#" class="small">Mot de passe oublié?</a></router-link>

                        <a href="#" class="btn " id="submit" type="submit" @click="submitForm" style="text-decoration: none;">Se
                            Connecter</a>
                            
                      </div>
                      
                      <div v-if="loginError" class="error-message">
                          <br>
                          
                          {{ loginError }}</div>
                    </form>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </main>
        <footer class="py-4  mt-auto" >
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
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
      password: '',
      passwordError: '',
      loginError: '',
      platform: '/platform',
      Password: '/Password',
      home: '/',
      checkemail: 'checkemail'

    }
  },


  methods: {
    validateForm() {
      this.emailError = '';
      this.passwordError = '';
      this.loginError = '';

      let isValid = true;

      // Email validation
      if (!this.email) {
        this.emailError = 'Veuillez saisir votre email.';
        isValid = false;
      } else if (!/\S+@\S+\.\S+/.test(this.email)) {
        this.emailError = 'Veuillez saisir un email valide.';
        isValid = false;
      }

      // Password validation
      if (!this.password) {
        this.passwordError = 'Veuillez saisir votre mot de passe.';
        isValid = false;
      }

      return isValid;
    },
    submitForm() {
      if (this.validateForm()) {
        // Create an object with the user credentials
        // const credentials = {
        //   email: this.email,
        //   password: this.password,
        // };

        axios.get('http://localhost:8000/api/login', {
          params: {
    email: this.email,
    password: this.password
  }
} )
          .then(response => {
            

            console.log(response.data);
            this.$store.dispatch('setData', response.data);
           
            this.$router.push('/platform')

          })
          .catch(error => {
            // Handle any errors that occur during the request
            console.error(error);
            this.loginError = 'Email ou mot de passe incorrects';

          });
      }
    }
  }
};















</script>


<style>
.error-message {
  color: red;
  font-size: 16px;
}

.alert.alert-danger {
    font-size: 14px; /* Adjust the font size as per your requirement */
    padding: 10px; /* Adjust the padding as per your requirement */
width:100%;
padding-right:350px;
  }

</style>





















