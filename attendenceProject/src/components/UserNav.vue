<template>
 <div>
    <md-app>
      <md-app-toolbar class="md-primary">
        <md-button class="md-icon-button" @click="toggleMenu" v-if="!menuVisible">
          <md-icon>menu</md-icon>
        </md-button>
        <span class="md-title"><router-link to="/adminhomepage" style="color: white;">User</router-link></span>
        <div class="md-toolbar-section-end">
        <md-button><router-link to="/logout" style="color: white;">Logout</router-link></md-button>
      </div>
      </md-app-toolbar>      
      <md-app-drawer :md-active.sync="menuVisible" md-persistent="full">

        <md-toolbar class="md-transparent" md-elevation="0">
          <span>Power to you</span>

          <div class="md-toolbar-section-end">
            <md-button class="md-icon-button md-dense" @click="toggleMenu">
              <md-icon>keyboard_arrow_left</md-icon>
            </md-button>
          </div>
        </md-toolbar>
        <md-list>
           <md-list-item>
           
          <span class="md-list-item-text"><router-link to="/studentdata">Student data</router-link></span>
          </md-list-item>

          <md-list-item>
           
          <span class="md-list-item-text"><router-link to="/addstudent">Add student</router-link></span>
          </md-list-item>

          <md-list-item>
          <span class="md-list-item-text"><router-link to="/AdminPortfolio">Attendence</router-link>
          </span>
          </md-list-item>

        </md-list>
      </md-app-drawer>   
       <md-app-content>
        <router-view />
       </md-app-content>
    </md-app>
       
  
  </div>
</template>

<script>
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'
  export default {
    name: 'Adminheader',
    data: () => ({
      menuVisible: false
    }),
    methods: {
      toggleMenu () {
        this.menuVisible = !this.menuVisible
      }
    }
  }
</script>

<style lang="scss" scoped>
  .md-app {
    min-height: 700px;
  }
  .md-drawer {
    width: 300px;
    max-width: calc(100vw - 125px);
  }
  .md-toolbar.md-theme-default.md-primary{
    background-color: #2dc997;
  }
  
</style>
