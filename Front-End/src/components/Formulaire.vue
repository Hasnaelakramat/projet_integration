<template>
  <div class="custom-bg-color ">
    <div id="layoutAuthentication ">
      <div id="layoutAuthentication_content  ">
        <main>
          <div class="container ">
            <div class="row justify-content-center">
              <div class="col">
                <div class="card  border-0 rounded-lg mt-5 ">
                  <div class="card-header" >
                    <h3 class=" my-4 text-nontransparent">Bienvenue dans <em style="font-weight: bold;"> HSup.UAE</em></h3>
                  </div>
                  <div class="card-body">
                    <div class="mb-3 text-muted">
                   Veuillez saisir votre adresse e-mail et mot de passe pour vous connecter !
                    </div>
                    <form>
                      <label for="inputEmail" class="mb-2" style="font-weight: bold;">Adresse E-mail : </label><br>
                      <input class="form-control" style="height: 50px; " id="inputEmail" type="email"
                        placeholder="nom@exemple.com" autocomplete="off" v-model="email" required />
                      <span v-if="emailError" class="error-message">{{ emailError }}</span>
                      <br>
                    
                  
                      <label for="inputPassword" class="mb-0" style="font-weight: bold;">Mot de passe :</label><br>
                      <form  class="input-group">
                      <input :type="fieldTypeIcon" class="form-control " style="height: 50px;" id="inputPassword" type="password"
                        placeholder="********" autocomplete="off" v-model="password" required />
                        <button class="input-group-text fixed-size-button" @click.prevent="switchField" >
                          <span v-if="fieldTypeIcon ==  'password'">
                            <i   class="fas fa-eye" ></i>
                          </span>
                          <span v-else>
                            <i   class="fas fa-eye-slash"  ></i>
                          </span>
                        </button>
                      </form>
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
      password: '',
      passwordError: '',
      loginError: '',
      platform: '/platform',
      Password: '/Password',
      home: '/',
      checkemail: 'checkemail',
      fieldType: 'password',
      fieldTypeIcon :'password'

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
    },
    switchField(){
      this.fieldTypeIcon = this.fieldTypeIcon === "password" ? "text" : "password";
    },
  }
};






</script>


<style>
.error-message {
  color: red;
  font-size: 16px;
}



.container {
  padding: 0;
  margin: 0 auto;
  background-color: rgba(0, 0, 0, 0) !important;
  box-shadow: none !important;



}

footer{
  /* background-color: #6592fd !important; */
  color: white !important;
  background-image: url(../assets/FOOTER.png);
    background-repeat: no-repeat;
  background-size: cover;
}




</style>























