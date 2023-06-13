<template>
  <div class="custom-bg-color">
    <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">
        <main>
          <div class="container ">
            <div class="row justify-content-center">
              <div class="col">
                <div class="card border-0 rounded-lg ">
                  <div class="row justify-content-center">
                    <img style="width: 170px;" src="../assets/Profil1.png" />
                  </div>
                  <div class="card-body">
                    <form>
                      <div class="form-group">
                        <div class="row mb-3">


                          <div v-if="isRHEtablissement || isAdminEtablissement || isEnseignant" class="col">

                            <label for="inputnom" style="font-weight: bold;">Nom :</label>

                            <br>
                            <div class="non-editable-field">{{ profile.nom }}</div>
                          </div>
                          <div v-if="isRHEtablissement || isAdminEtablissement || isEnseignant" class="col">
                            <label for="inputprenom" style="font-weight: bold;">Prénom :</label>
                            <br>
                            <div class="non-editable-field">{{ profile.prenom }}</div>

                          </div>

                          <div class="col">
                            <label for="inputEmail" style="font-weight: bold;">Email:</label>

                            <br>
                            <div class="non-editable-field">{{ profile.email }}</div>
                          </div>

                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row mb-3">

                          <div v-if="isRHEtablissement || isAdminEtablissement || isEnseignant" class="col">


                            <label for="inputppr" style="font-weight: bold;">PPR :</label>
                            <br>
                            <div class="non-editable-field">{{ profile.ppr }}</div>

                          </div>

                          <div v-if="isRHEtablissement || isAdminEtablissement || isEnseignant" class="col">


                            <label for="inputetab" style="font-weight: bold;">Etablissement :</label>
                            <br>
                            <div class="non-editable-field">{{ profile.etablissement_nom }}</div>

                          </div>

                          <div v-if="isEnseignant" class="col">


                            <label for="inputgrade" style="font-weight: bold;">Grade :</label>
                            <br>
                            <div class="non-editable-field">{{ profile.grade }}</div>

                          </div>
                        </div>
                      </div>
                      <hr>


                      <h4>Changer le mot de passe :</h4>
                      <hr>

                      <div class="form-group">
                        <div class="row mb-3">
                          <div class="col">
                            <div class="form-floating mb-3 mb-md-0">
                              <input class="form-control" id="inputOldPassword" type="password"
                                placeholder="Create a password" autocomplete="off" v-model="password" />
                              <label for="inputOldPassword">Ancien mot de passe :</label>

                            </div>
                          </div>

                          <div class="col">
                            <div class="form-floating mb-3 mb-md-0">
                              <input class="form-control" id="inputNewPassword" type="password"
                                placeholder="Create a password" v-model="password" />
                              <label for="inputNewPassword">Nouveau mot de passe :</label>


                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row mb-3">
                          <div class="col">
                            <div class="form-floating mb-3 mb-md-0">
                              <input class="form-control" id="inputPasswordConfirm" type="password"
                                placeholder="Confirm password" />
                              <label for="inputPasswordConfirm">Confirmer le nouveau mot de passe</label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                        <router-link :to="platform">
                          <a href="#" class="small" id="submit">Revenir vers le tableau de bord</a>
                        </router-link>

                        <a href="#" class="btn " id="submit" type="submit" @click="updatePassword"
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
      password: '',
      passwordError: '',
      home: '/',
      checkemail: 'checkemail',
      platform: 'platform',
      profile: {
        prenom: '',
        nom: '',
        ppr: '',
        email: '',
        grade: '',
        etablissement_nom: '',
      },
      tableData: [],


      isPresidentUAE: false,
      isAdminUAE: false,
      isAdminEtablissement: false,
      isRHEtablissement: false,
      isEnseignant: false,

    }
  },

  computed: {
    data() {
      return this.$store.getters.getProfilData;
    },
    getType() {
      return this.$store.getters.getType;
    },
    getEmailDta(){
      return this.$store.getters.getEmailData;
;

    }
  },

  mounted() {
    this.fetchData();
    this.statut();

  },

  methods: {

    fetchData() {
      const authToken = this.$store.getters.getData.data.token.plainTextToken;
      // Effectuer la requête API
      axios.get('http://localhost:8000/api/profile', {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      })
        .then(response => {
          this.tableData = response.data;
          console.log('data admins', this.tableData);
          this.tableData.forEach((element) => {
            console.log('data element', element);
            console.log('data getpro : ', this.$store.getters.getProfilData.id_user);
            if (element.id_user === this.$store.getters.getProfilData.id_user) {
              this.profile.prenom = element.prenom;
              this.profile.nom = element.nom;
              this.profile.ppr = element.ppr;
              this.profile.email = element.email;
              this.profile.etablissement_nom = element.etablissement_nom;
              
              if (this.isAdminUAE || this.isPresidentUAE) {
            this.profile.email =this.$store.getters.getEmailData;
          }
            }
          });
        })
        .catch(error => {
          console.error(error);
        });
    }
    ,




    updatePassword() {
      console.log('changer le mot de passe')
      const authToken = this.$store.getters.getData.data.token.plainTextToken;
      const oldPassword = document.getElementById('inputOldPassword').value;
      const newPassword = document.getElementById('inputNewPassword').value;
      const confirmPassword = document.getElementById('inputPasswordConfirm').value;

      if (newPassword !== confirmPassword) {
        // Gérer l'erreur lorsque les mots de passe ne correspondent pas
        console.error("Les mots de passe ne correspondent pas");
        return;
      }

      axios.post('http://localhost:8000/api/update_password', {
        password: newPassword,
      }, {
        headers: {
          Authorization: `Bearer ${authToken}`,
        },
      })
        .then(response => {
          // Traiter la réponse de la mise à jour du mot de passe
          console.log("Mot de passe mis à jour avec succès");
          // Rediriger vers la page souhaitée (par exemple, le tableau de bord)
          this.$router.push('/');
        })
        .catch(error => {
          // Gérer les erreurs survenues lors de la requête
          console.error(error);
        });
    },


    statut() {
      if (this.getType === "Président de l'UAE") { this.isPresidentUAE = true; }

      else if (this.getType === "Admin de l'UAE") {
        this.isAdminUAE = true;

      } else if (this.getType == "Admin d'un établissement") {
        this.isAdminEtablissement = true;

      } else if (this.getType == "RH d'un établissement") {
        this.isRHEtablissement = true;
      }
      else if (this.getType == "Enseignant") { this.isEnseignant = true; }
    },



  }


}



</script>

<style>
.non-editable-field {
  padding: 10px;
  background-color: rgba(95, 89, 247, 0.1);
  border: 1px solid #ddd;
  border-radius: 4px;
}
</style>