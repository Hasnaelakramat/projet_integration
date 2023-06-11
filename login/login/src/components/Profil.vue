<template>
    <div class="custom-bg-color">
      <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
          <main>
            <div class="container my-4">
              <div class="row justify-content-center">
                <div class="col">
                  <div class="card border-0 rounded-lg mt-5">
                    <div class="row justify-content-center">
                      <img style="width: 170px;" src="../assets/Profil1.png" />
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="form-group">
                          <div class="row mb-3">


                            <div class="col">
                           
                           <label for="inputLastName"  style="font-weight: bold;">Nom :</label>
                       
                           <br>
                         <div class="non-editable-field">{{ profile.lastName }}</div>
                         </div>
                            <div class="col">
                              <label for="inputFirstName"  style="font-weight: bold;" >Prénom :</label>
                           <br>
                              <div class="non-editable-field">{{ profile.firstName }}</div>

                            </div>
                          
                          </div>
                        </div>
  
                        <div class="form-group">
                          <div class="row mb-3">
                            <div class="col">
                              <label for="inputEmail"  style="font-weight: bold;">Email:</label>
                      
                              <br>
                            <div class="non-editable-field">{{ profile.email }}</div>
                            </div>
                            <div class="col">
                           
                      
                              <label for="inputTelephone"  style="font-weight: bold;">PPR :</label>
                              <br>
                            <div class="non-editable-field">{{ profile.ppr }}</div>

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
                                <input class="form-control" id="inputPassword" type="password" placeholder="Create a password" autocomplete="off" />
                                <label for="inputPassword">Ancien Mot de passe :</label>
                                
                              </div>
                            </div>
  
                            <div class="col">
                              <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" id="inputPassword" type="password" placeholder="Create a password" />
                                <label for="inputPassword">Nouveau mot de passe :</label>

                           
                              </div>
                            </div>
                          </div>
                        </div>
  
                        <div class="form-group">
                          <div class="row mb-3">
                            <div class="col">
                              <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="Confirm password" />
                                <label for="inputPasswordConfirm">Confirmer le nouveau mot de passe</label>
                              </div>
                            </div>
                          </div>
                        </div>
  
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                            <router-link :to="platform">
                              <a href="#" class="small" id="submit">Revenir vers le tableau de bord</a>
                            </router-link>

                            <a href="#" class="btn " id="submit" type="submit" @click="" style="text-decoration: none;">Valider</a>

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
            password: '',
            passwordError: '',
            home: '/',
            checkemail: 'checkemail',
            platform: 'platform',
            profile: {
                firstName: '',
                lastName: '',
                ppr: '' ,
                email:'',
            },
            tableData:[],

        }
    },
    
    computed: {
    data() {
      return this.$store.getters.getProfilData;
    },
    getType() {
            return this.$store.getters.getType;
        }
},

    mounted() {
        this.fetchData();
    },

    methods: {
        fetchData() {
            const authToken = this.$store.getters.getData.data.token.plainTextToken;
            // Make the API request
            axios.get('http://localhost:8000/api/show_admin_list', {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            }).then(response => {
                this.tableData = response.data;
                console.log('data admins',this.tableData);
                this.tableData.forEach((element)=>{
                    console.log('data element',element);
                    console.log('data getpro : ',this.$store.getters.getProfilData.id_user)
                    if(element.id_user===this.$store.getters.getProfilData.id_user){
                        this.profile.firstName=element.prenom
                        this.profile.lastName=element.nom
                        this.profile.ppr=element.ppr
                        this.profile.email=this.$store.getters.getProfilData.email
                    }
                })

            })
                .catch(error => {
                    console.error(error);
                });
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