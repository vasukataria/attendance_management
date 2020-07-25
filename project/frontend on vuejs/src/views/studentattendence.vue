<template>
  <div>
    <form id="form" action="" method="" @submit.prevent="atten" enctype='multipart/form-data'>
    <md-table v-model="users" md-card>
      <md-table-toolbar>
        <h1 class="md-title">student attandence</h1>
      </md-table-toolbar>

      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
        <md-table-cell md-label="Name" md-sort-by="name">{{ item.name }}</md-table-cell>
        <md-table-cell md-label="Rollno." md-sort-by="email">{{ item.rollno }}</md-table-cell>
        <md-table-cell md-label="Attendance" md-sort-by="gender">

          <md-radio v-model="item.radio" value="a">Absent </md-radio>
          <md-radio v-model="item.radio" value="b" class="md-primary">Present</md-radio>

        </md-table-cell>

          </md-table-row>

    </md-table>
    <md-button class="md-raised md-primary">Submit</md-button>
  </form>
  </div>
</template>

<script>
  import axios from 'axios'
  //import Vue from 'vue' 
  export default {
    name: 'TableTemplate',
    work(){
      return{
      attendance_status: null,
      newMember: {attendance_status: ''},
      }
    },
    data: () => ({
     users: []
    }),
    mounted(){
    this.getAllMembers();
    },


    methods:{

      getAllMembers: function(){
      var self = this;
      axios.get('http://localhost/attendence/studentdata.php')
        .then(function(response){
          //console.log(response);
          if(response.data.error){
            self.errorMessage = response.data.message;
          }
          else{
            self.users = response.data;
          }
        });
    },
    atten:function () {
    var self = this;
    axios.post('http://localhost/attendence/attendance', this.newMember)
    .then(function(response){
        console.log(response);
        self.newMember = {attendance_status: ''};
        if(response.data.error){
            self.errorMessage = response.data.message;
        }
        else{
            self.successMessage = response.data;
            //self.getAllMembers();
        }
    });
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
