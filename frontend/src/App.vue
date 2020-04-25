<template>
    <v-app id="app" style="background-color: #ecf0f5;">
       <!---->
        <!-- =============================================== -->
        <navegationmenu></navegationmenu>
        <v-content>
          <v-container fluid fill-height>
            <v-slide-y-transition mode="out-in">
                <router-view></router-view>
            </v-slide-y-transition>
          </v-container>
        </v-content>

    <v-footer color="blue darken-3" class="white--text" app>
      <v-layout align-center justify-center>
        <span class="px-3">test &copy; {{ new Date().getFullYear() }}</span>
      </v-layout>
    </v-footer>
      
    </v-app>
</template>

<script>
import navegationmenu from "@/components/shared/NavegationMenu";

export default {
  components: {
    navegationmenu
  },
  data: ()=>({
    is_login: false
  }),

  created(){
    let self = this
    //self.$store.dispatch('autoLogin')
  },
  props: {
    source: String
  },

  methods:{
  },

  computed: {
    getFondo(){
        let self = this
        var  fondo = self.$store.state.base_url+'img/fondo.jpg'
        if(!self.$store.state.is_login){
          return {
            "background-image": 'url('+fondo+')'
          } 
        }
      },
  }
};
</script>