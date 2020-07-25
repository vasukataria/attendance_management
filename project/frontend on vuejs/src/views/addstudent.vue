<template>
<div id="body">
  <div id="container">    
    <form id="form" method="post" role="signupForm" class="signupForm" @submit.prevent="userForm" action="" enctype='multipart/form-data'>
        <h2 id="h2">Add student data</h2>
        <br>
        <div id="form-signin">
            <label for="name">name</label>
            <input type="text" placeholder="Enter student name" id="name" name="name" v-model="name" />
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div id="form-signin">
            <label for="rollno">rollno.</label>
            <input type="number" placeholder="Enter student roll no" id="rollno" name="rollno" v-model="rollno" />
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>

        <div id="form-signin">
            <label for="gender">Gender -M/F</label>
            <input type="text" placeholder="Enter Gender of student" id="gender" name="gender" v-model="gender" />
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
       
        <div id="form-signin">
            <label for="age">Age</label>
            <input type="number" placeholder="age" id="age" name="age" v-model="age"/>
            <i id="fas fa-check-circle"></i>
            <i id="fas fa-exclamation-circle"></i>
            <small>Error message</small>
        </div>
        <div id="form-signin">
            <label for="email">Email</label>
            <input type="email" placeholder="info@example.com" id="email" name="email" v-model="email" />
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
export default {
  name: 'Signup',
  data(){
    return{
      name: null,
      email: null,
      age: null,
      gender: null,
      rollno:null

    }
  },
  
mounted(){
   this.userForm();  
const form = document.getElementById('form');
const name = document.getElementById('name');
const email = document.getElementById('email');
const age = document.getElementById('age');
const gender = document.getElementById('gender');
const rollno = document.getElementById('rollno');

form.addEventListener('submit', e => {
    e.preventDefault();
    checkInputs();
});

function checkInputs() {
    const nameValue = name.value.trim();
    const emailValue = email.value.trim();
    const ageValue = age.value.trim();
    const genderValue = gender.value.trim();
    const rollnoValue = rollno.value.trim();
    
    if(nameValue === '') {
        setErrorFor(name, 'name cannot be blank');
    } else {
        setSuccessFor(name);
    }
    
    if(emailValue === '') {
        setErrorFor(email, 'Email cannot be blank');
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Not a valid email');
    } else {
        setSuccessFor(email);
    }
    
    if(ageValue === '') {
        setErrorFor(age, 'age cannot be blank');
    } else {
        setSuccessFor(age);
    }
     if(genderValue === '') {
        setErrorFor(gender, 'gender cannot be blank');
    } else {
        setSuccessFor(gender);
    }
     if(rollnoValue === '') {
        setErrorFor(rollno, 'age cannot be blank');
    } else {
        setSuccessFor(rollno);
    }

}

function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    formControl.className = 'form-signin error';
    small.innerText = message;
}

function setSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-signin success';
}
    
function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);}//eslint-disable-line      
      },
methods:{
  userForm:function () {
    if (this.name && this.email && this.rollno && this.gender && this.age) {
        fetch("http://localhost/attendence/studentdata.php?crud=create",
        {
            method: "POST", 
            body: JSON.stringify({
                      name : this.name,
                      email : this.email,
                      rollno  : this.rollno,
                      gender : this.gender,
                      age : this.age
                    }),
          }).then(request => { 
            //console.log(request);
            request.text().then((message) => {
                if(request.status === 409){
                    Vue.$toast.open(message);

                    this.userValidation()
                } else if (request.status === 200){
                  console.log(request);
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
},
signupSuccessful(){
     this.error = false
     //this.$router.replace('/login')

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