<template>
<div id="body">
  <div id="container">
    <button><router-link to="/">login</router-link></button>    
    <form id="form" method="post" role="signupForm" class="signupForm" @submit="userForm" action="" enctype='multipart/form-data'>
        <h2 id="h2">Create Account</h2>
        <br>
        <div id="form-signin">
            <label for="username">name</label>
            <input type="text" placeholder="Enter student name" id="name" name="name" v-model="name" />
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div id="form-signin">
            <label for="rollno">rollno.</label>
            <input type="rollno" placeholder="Enter student roll no" id="rollno" name="rollno" v-model="rollno" />
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div id="form-signin">
            <label for="gender">Gender</label>
            <input type="gender" placeholder="Gender" id="gender" name="gender"  v-model="gender" />
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div id="form-signin">
            <label for="username">Password check</label>
            <input type="password" placeholder="Password two" id="password2"/>
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>
</div>

</template>

<script>
  import Vue from 'vue'
  import { validationMixin } from 'vuelidate'
  import {
    required,
    email,
    minLength,
    maxLength
  } from 'vuelidate/lib/validators'

  export default {
    name: 'FormValidation',
    mixins: [validationMixin],
    data: () => ({
      form: {
        name: null,
        rollno: null,
        gender: null,
        age: null,
        email: null,
        
      },
      userSaved: false,
      sending: false,
      lastUser: null
    }),
    validations: {
      form: {
        name: {
          required,
          minLength: minLength(5)
        },
         rollno: {
          required,
          minLength: minLength(5)
        },
        age: {
          required,
          maxLength: maxLength(3)
        },
        gender: {
          required
        },
        email: {
          required,
          email
        },
      }
    },
    methods: {
      getValidationClass (fieldName) {
        const field = this.$v.form[fieldName]

        if (field) {
          return {
            'md-invalid': field.$invalid && field.$dirty
          }
        }
      },
      clearForm () {
        this.$v.$reset()
        this.form.name = null
        this.form.rollno =null
        this.form.age = null
        this.form.gender = null
        this.form.email = null
        
      },
      saveUser () {
        this.sending = true

        // Instead of this timeout, here you can call your API

      },
      validateUser:function() {
        if(this.uName && this.email && this.pass) {
        fetch("http://localhost/officetask/database/user.php",{
            method: "POST", 
            body: JSON.stringify({
                      uName : this.uName,
                      email : this.email,
                      pass : this.pass,
                    }),
          }).then(request => { 
            console.log(request);
            request.text().then((message) => {
                if(request.status === 400){
                    Vue.$toast.open(message);

                    this.userValidation()
                } else if (request.status === 200){
                this.signupSuccessful()
                }else{
                    this.signupFailed()
                } 
            })
                 
        })
      .catch(() => {  
      this.signupFailed()
    })
    }
        this.$v.$touch()

        if (!this.$v.$invalid) {
          this.saveUser()
        }
      },
signupSuccessful(){
     this.error = false
     this.$router.replace('/login')

},
signupFailed(){
    this.error='Login failed!'
},
userValidation(){
    this.error=''
}
    }
  }
</script>

<style lang="scss" scoped>
  .md-progress-bar {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
  }
  #body {
  background-color: white;
  font-family: 'Open Sans', sans-serif;
  /*display: flex; */
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  margin: 0;
}
.md-layout {
    /* display: flex; */
   
}
</style>
