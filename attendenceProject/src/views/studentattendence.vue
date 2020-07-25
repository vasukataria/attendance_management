<template>
  <div>
    <md-table v-model="users" md-card>
      <md-table-toolbar>
        <h1 class="md-title">student attandence</h1>
      </md-table-toolbar>

      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="ID" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
        <md-table-cell md-label="Name" md-sort-by="name">{{ item.name }}</md-table-cell>
        <md-table-cell md-label="Rollno." md-sort-by="email">{{ item.email }}</md-table-cell>
        <md-table-cell md-label="Attendance" md-sort-by="gender">

          <md-radio v-model="item.radio" value="a">Absent </md-radio>
          <md-radio v-model="item.radio" value="b" class="md-primary">Present</md-radio>

        </md-table-cell>

          </md-table-row>

    </md-table>
    <md-button class="md-raised md-primary">Submit</md-button>
  </div>
</template>

<script>
  export default {
    name: 'TableTemplate',
    work(){
      return{
      
      }
    },
    data: () => ({
     
      users: [
        {
          radio:"",
          id: 1,
          name: 'Shawna Dubbin',
        },

        {
          radio:"",
          id: 2,
          name: 'Odette Demageard'
        },
        {
          radio:"",
          id: 3,
          name: 'Lonnie Izkovitz',
        },
        {
          radio:"",
          id: 4,
          name: 'Thatcher Stave',
        },
        
      ]
    })
  }
</script>
