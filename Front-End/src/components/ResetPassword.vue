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
                    <h3 class="my-4 text-nontransparent">Réinitialisation du mot de passe</h3>
                  </div>
                  <div class="card-body">
                    <form @submit.prevent="resetPassword">

                      <label for="inputemail" class="mb-2" style="font-weight: bold;">
                        Email :
                      </label><br>
                      <input class="form-control mb-3" style="height: 50px;" id="inputemail" type="email"
                        placeholder="Email" autocomplete="off" v-model="email" required />


                      <label for="inputCode" class="mb-2" style="font-weight: bold;">
                        Code confidentiel :
                      </label><br>
                      <input class="form-control mb-3" style="height: 50px;" id="inputCode" type="text"
                        placeholder="Code confidentiel" autocomplete="off" v-model="code" required />


                      <label for="inputPassword" class="mb-2" style="font-weight: bold;">
                        Nouveau mot de passe :
                      </label><br>
                      <form class="input-group  mb-3">
                        <input :type="fieldTypeIcon" class="form-control " style="height: 50px;" id="newPassword"
                          type="password" placeholder="*********" autocomplete="off" v-model="password" required />
                        <button class="input-group-text fixed-size-button" @click.prevent="switchField">
                          <b v-if="fieldTypeIcon == 'password'">
                            <i class="fas fa-eye"></i>
                          </b>
                          <b v-else>
                            <i class="fas fa-eye-slash"></i>
                          </b>
                        </button>
                      </form>

                      <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                        <router-link :to="home"><a href="#" class="small">Revenir vers la page de Connexion</a></router-link>

                        <a href="#" class="btn" type="submit" 
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
import axios from "axios";

export default {
  data() {
    return {
      email: "",
      code: "",
      password: "",
      fieldTypeIcon: "password",
      home:'/'
    };
  },

  methods: {
    resetPassword() {
      console.log("reset password")

      axios
        .post("http://localhost:8000/api/resetpassword", {
          email: this.email,
          token: this.code,
          password: this.password,
        })
        .then(response => {
          if (response.data.user && response.data.token) {
            // Mot de passe réinitialisé avec succès
            alert("Le mot de passe a été réinitialisé avec succès.");
            // Effectuer une action supplémentaire si nécessaire
          } else {
            alert("Code confidentiel invalide");
          }
        })
        .catch(error => {
          console.error(error);
          alert("Une erreur s'est produite lors de la réinitialisation du mot de passe.");
        });
    }
    ,


    switchField() {
      this.fieldTypeIcon = this.fieldTypeIcon === "password" ? "text" : "password";
    },
  },
};
</script>
