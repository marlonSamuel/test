<template>
  <v-layout align-start v-loading="loading">
    <v-flex>
      <v-toolbar flat color="white">
        <v-toolbar-title>Ciclos</v-toolbar-title>
        <v-divider class="mx-2" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-text-field v-model="search" append-icon="search" label="Buscar" single-line hide-details></v-text-field>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="800px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark small class="mb-2" v-on="on">
              <v-icon>add</v-icon>Nuevo
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{setTitle}}</span>
            </v-card-title>

            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12 sm12 md12>
                    <v-text-field
                      v-model="form.nombre"
                      label="Nombre"
                      v-validate="'required'"
                      type="text"
                      data-vv-name="nombre"
                      :error-messages="errors.collect('nombre')"
                    ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm4 md4>
                        <v-select v-model="form.genero"
                        :items="generos" label="Genero">
                        </v-select>
                    </v-flex>
                    <v-flex xs12 sm4 md4>
        
                    <v-text-field
                      v-model="form.email"
                      label="Email"
                      v-validate="'required|email'"
                      type="text"
                      data-vv-name="email"
                      :error-messages="errors.collect('email')"
                    ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm4 md4>
                    <v-text-field type="date"
                          class="text-xs-center" v-model="form.fecha_nac"></v-text-field>
                    </v-flex>
                  
                </v-layout>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="red darken-1" flat @click="close">Volver</v-btn>
              <v-btn color="blue darken-1" flat @click="createOrEdit">Guardar</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
      <v-data-table :headers="headers" :items="items" :search="search" class="elevation-1">
        <template v-slot:items="props">
          <td class="text-xs-left">{{ props.item.nombre }}</td>
          <td class="text-xs-left">{{ props.item.genero }}</td>
          <td class="text-xs-left">{{ props.item.email }}</td>
          <td class="text-xs-left">{{ props.item.fecha_nac }}</td>
          <td class="text-xs-left">
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                  <v-icon v-on="on" color="warning" fab dark @click="edit(props.item)">edit</v-icon>
              </template>
              <span>Editar</span>
            </v-tooltip>
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                  <v-icon v-on="on" color="error" fab dark @click="destroy(props.item)">delete</v-icon>
              </template>
              <span>Eliminar</span>
            </v-tooltip>
          </td>
        </template>
        <template v-slot:no-data>
          <v-btn color="primary" @click="getAll">Reset</v-btn>
        </template>
      </v-data-table>
    </v-flex>
  </v-layout>
</template>
<script>
export default {
    name:"test",
    data(){
        return {
            loading: false,
            dialog: false,
            search: "",
            loading: false,
            items: [],
            headers: [
                { text: "Nombre", value: "nombre" },
                { text: "Fecha nacimiento", value: "fecha_nac", sortable: false },
                { text: "Email", value: "email", sortable: false },
                { text: "Género", value: "genero", sortable: false }
            ],
            pagination: {
                sortBy: "id"
            },

            form:{
                id: null,
                nombre: '',
                fecha_nac: '',
                genero: 'M',
                email: ''
            },

            generos: [{text:'Masculino',value:'M'},
                      {text: 'Femenino',value:'F'}]
        }
    },

    created(){
        let self = this
        self.getAll()
    },

    methods:{
        getAll(){
            let self = this
            self.loading = true
            self.$store.state.services.testService
            .getAll()
            .then(r=>{
                self.loading = false
                self.items = r.data
            }).catch(e=>{

            })
        },

        create(){
            let self = this
            var data = self.form
            self.loading = true
            self.$store.state.services.testService
            .create(data)
            .then(r=>{
                self.loading = false
                if(r.response){
                    self.$toastr.error(r.response.data.error,"error")
                    return
                }
                self.$toastr.success("Registro agregado con éxito","éxito")
                self.getAll()
                self.close()
            }).catch(e=>{

            })
        },

        update() {
        let self = this
        self.loading = true
        let data = self.form
        self.$store.state.services.testService
            .update(data)
            .then(r => {
                self.loading = false
                if (r.response) {
                    this.$toastr.error(r.response.data.error, "error")
                    return
                }
                self.getAll();
                this.$toastr.success("registro actualizado con éxito", "éxito")
                self.close()
            })
            .catch(e => {
                self.loading = false
            });
        },

        destroy(data) {
        let self = this;
        self
            .$confirm("Seguro que desea eliminar test" + data.nombre + "?")
            .then(res => {
            self.loading = true;
            self.$store.state.services.testService
                .destroy(data)
                .then(r => {
                self.loading = false;
                if (r.response) {
                    this.$toastr.error(r.response.data.error, "error");
                    return;
                }
                self.getAll();
                this.$toastr.success("registro eliminado con exito", "exito");
                self.close();
                })
                .catch(r => {});
            })
            .catch(cancel => {});
        },

            //limpiar data de formulario
        clearData() {
        let self = this;

        Object.keys(self.form).forEach(function(key, index) {
            if (typeof self.form[key] === "string") self.form[key] = '';
            else if (typeof self.form[key] === "boolean") self.form[key] = true;
            else if (typeof self.form[key] === "number") self.form[key] = true;
        });

        self.$validator.reset();
        },

        //editar registro
        edit(data) {
            let self = this;
            this.dialog = true;
            self.mapData(data);
        },

        //mapear datos a formulario
        mapData(data) {
            let self = this
            self.form.id = data.id
            self.form.nombre = data.nombre
            self.form.fecha_nac = data.fecha_nac
            self.form.email = data.email
            self.form.genero = data.genero
        },

        //funcion, validar si se guarda o actualiza
        createOrEdit() {
            let self = this
            this.$validator.validateAll().then(result => {
                if (result) {
                if (self.form.id > 0 && self.form.id !== null) {
                    self.update();
                } else {
                    self.create();
                }
                }
            });

        },

        close() {
            let self = this
            self.dialog = false
            self.clearData()
        }
    },
    computed: {
        setTitle() {
            let self = this;
            return self.form.id !== null ? self.form.ciclo : "Nuevo Registro"
        }
    }
}
</script>