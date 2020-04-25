<template v-loading="loading">
<div>
<v-navigation-drawer
      v-model="drawer"
      :clipped="$vuetify.breakpoint.lgAndUp"
      fixed
      app
      dark
    >
      <v-list dense>
        <template>
          <v-list-tile :to="'/'">
            <v-list-tile-action>
              <v-icon>home</v-icon>
            </v-list-tile-action>
            <v-list-tile-title to="/">
               Inicio
            </v-list-tile-title>
          </v-list-tile>
        </template>
        <template v-for="item in items">
          <v-list-group 
          v-if="item.children"
          :prepend-icon="item.icon"> 
            <v-list-tile slot="activator">
              <v-list-tile-content>
                <v-list-tile-title>   
                  {{item.text}}
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <template v-for="child in item.children">
              <v-list-tile :to="child.path">
                <v-list-tile-action>
                  <v-icon>{{child.icon}}</v-icon>
                </v-list-tile-action>
                <v-list-tile-title>
                  {{child.text}}
                </v-list-tile-title>
              </v-list-tile>
            </template>
          </v-list-group>

          <v-list-tile v-else @click="">
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
              <v-list-tile-title>{{ item.text }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

        </template>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      color="blue darken-3"
      dark
      app
      fixed
      dense
    >
      <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <span class="hidden-sm-and-down" @click="$router.push(`/`)">
          <v-avatar
          :tile="false"
          size="45"
          color="grey lighten-4"
        >
          <img :src="logo" alt="avatar">
        </v-avatar>
        SISPA
        </span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <h2 class="hidden-sm-and-down">PROYECTO BASE VUETIFY</h2>
      <v-spacer></v-spacer>
      
      username

      <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
        <v-btn icon large flat slot="activator">
          <v-avatar size="30px">
            <v-btn icon>
       <v-icon>account_circle</v-icon>
      </v-btn>
          </v-avatar>
      </v-btn>
        <v-list class="pa-0">
          <v-list-tile
            v-for="(item, index) in options"
            :to="!item.href ? { name: item.name } : null"
            :href="item.href"
            @click="item.click"
            ripple="ripple"
            :disabled="item.disabled"
            :target="item.target"
            rel="noopener"
            :key="index"
          >
            <v-list-tile-action v-if="item.icon">
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-menu>
    </v-toolbar>
</div>
</template>
<script>
export default {
  name: 'navigation_menu',
  props: {
      source: String
    },
  data(){
    return {
        dialog: false,
        drawer: null,
        loading: false,
        logo: this.$store.state.global.getLogo(),
        options: [
        {
          icon: "account_circle",
          href: "",
          title: "Cambiar contraseña",
          click: this.change
        },
        {
          icon: "logout",
          href: "",
          title: "salir",
          click: this.logout
        }
      ],

      items: [{
            icon: 'settings',
            text: 'Administracion',
            name: 'Administracion',
            model: true,
            path: 'example',
            children: [
                { name: 'Ejemplo', icon: 'add', text: 'Ejemplo', path: '/example_index' },
                { name: 'Test', icon: 'add', text: 'Test', path: '/test' }
            ]
        },

    ],
    }
  },

  created(){
    let self = this
  },

  methods: {
    change(){
      let self = this
    },
    logout(){
      let self = this
    },
  },

  computed: {
  }
}
</script>