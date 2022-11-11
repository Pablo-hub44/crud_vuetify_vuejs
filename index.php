<!DOCTYPE html>
<html lang="en">
<head> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Telefonos</title>
  <!--cosas necesarias para vuetify-->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
  <!--google icons-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
    <!--font awesome-->
    <script src="https://kit.fontawesome.com/69ea92256c.js" crossorigin="anonymous"></script>
        
  <!--sweetalert 2-->
  <!--<link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">-->
</head>
<body>
<!--front-end es la parte que se ve del proyecto veautify--->
<!--back-end es la parte realizada con php, vue.js-->
  
<v-app id="app"><!--este es el conponente principal, solo se usa dentro de la aplicacion una ves / contenedor principal-->
        <v-data-table :headers="headers" :items="moviles" :search="search" sort-by="id" class="elevation-3">
            <template v-slot:top>
                <v-system-bar color="indigo darken-2"></v-system-bar>
                <v-toolbar flat color="indigo">

                <template v-slot:extension>
                    <v-btn
                    fab
                    color="cyan accent-2"
                    small
                    left
                    absolute
                    @click="dialog = !dialog"
                    >
                    <v-icon>mdi-plus</v-icon>
                    </v-btn>
                </template> 
                    
                    <v-toolbar-title class="white--text">Registro de celulares</v-toolbar-tittle>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>

                    <!--modal de dialogo para Nuevo y Edicion-->
                    <v-dialog v-model="dialog" max-width="500px"><!--este tipo modal-->
                        <template v-slot:activator="{on}"></template>
                        <v-card>
                            <!--para la edicion-->
                            <v-card-title class="cyan white-text">
                                <span class="headline">{{formTitle}}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <!--el id no se modifica ya que es autoincremental en la base de datos-->
                                        <!--<v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editado.id" label="id"></v-text-field>
                                        </v-col>-->
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editado.marca" label="Marca"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editado.modelo" label="Modelo"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field v-model="editado.stock" type="number" step="1" min="0" label="Stock"></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue-grey" class="ma-2 white--text" @click="cancelar">Cancelar</v-btn>
                                <v-btn color="teal accent-4" class="ma-2 white--text" @click="guardar">Guardar</v-btn>
                            </v-card-actions>

                        </v-card>
                    </v-dialog>
                 </v-toolbar>
                <!--barra de busqueda-->
                <v-col cols="12" sm="12">
                    <v-text-field v-model="search" append-icon="search" label="Buscar" single-line hide-details> </v-text-field>
                </v-col>
 </template>

            <template v-slot:item.accion="{item}"><!--establece en que columna van los botones de editar y borrar, en este caso "accion"-->
            <!--(item) toma toda la fila seleccionada-->
            <v-btn class="mr-2" fab dark small color="cyan" @click="editar(item)">
                <v-icon dark>mdi-pencil</v-icon>
            </v-btn>
            <v-btn class="mr-2" fab dark small color="error" @click="borrar(item)">
                <v-icon dark>mdi-delete</v-icon>
            </v-btn>
            </template>
        </v-data-table>

            <!--template para el snackbar-->
          <template> <!--snackbar-->
            <div class="text-center ma-2">
            <v-snackbar v-model="snackbar">
                {{textSnack}}
                <v-btn color="info" text @click="snacbar = false">Cerrar</v-btn>
            </v-snackbar>
            </div>
         </template>
      
    </v-app>
  

    <!--<div class="container"> asi es en bootstrap
        <div class="row">
                <div class="col-xs-6">
                </div>
        </div>
    </div>

    <v-container>  asi es en vuetify
        <v-row>
            <v-col></v-col>
        </v-row>
    </v-container>-->



  <!--vuetify-->
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>

  <!--Axios v0.21.1-->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <!--sweet alert 2-->
  <!--<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>-->

    <!--codigo js propio-->
  <script src="codigo_vue.js"></script>
 
 
</body>
</html>

