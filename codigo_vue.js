var url = "bd/crud.php";

new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    data:() => ({
        search:'', //para el cuadro de busqueda de datatables
        snackbar: false, //para el mensaje del snackbar
        textSnack:'text del snackbar',//texto que se ve en el snackbar
        dialog: false, //para que la ventana de dialogo o modal no aparezxa automaticamente
        //definimos los headers de la datatables
        headers:[
            {
                text:'ID',
                align:'left',
                sorteable:'false',
                value:'id',
            },
            {text:'MARCA', value:'marca'},
            {text:'MODELO', value:'modelo'},
            {text:'STOCK/CANTIDAD', value:'stock'},
            {text:'ACCIONES', value:'accion', sorteable:false},
        ],
        moviles:[], //definimos el arreglo moviles
        editedIndex:-1, //usado para saber si el boton presiono nuevo o modificacion 
        editado:{
            id:'',
            marca:'',
            modelo:'',
            stock:'',
        },
        defaultItem:{
            id:'',
            marca:'',
            modelo:'',
            stock:'',
        },
    }),

    computed:{
        formTitle(){
            // operadores condicionales if else-- "condicion ? expr1 :(o) expr2"
            // si cumple la <condicion> es true, por lo tanto devuelve <expr1>, de lo contrario devuelve <expr2>
            // lo mismo que if(cond)then()else()
            return this.editedIndex === -1 ? 'Nuevo registro' : 'Editar Registro'
        },
    },
    watch:{
        dialog(val){
            val || this.cancelar()
        },
    },
    created(){
        this.listarMoviles()
    },
    methods:{
        //procedimiento listar
        listarMoviles:function(){
            axios.post(url,{opcion:4}).then(response => {
                this.moviles = response.data;
            });
        },
        //procedimiento Crear
        nuevoMovil:function(){
            axios.post(url,{opcion:1, marca:this.marca, modelo:this.modelo, stock:this.stock}).then(response => {
                this.listarMoviles();
            });
            this.marca= "";
            this.modelo= "";
            this.stock= 0;
        },
        //procedmiento editar
        editarMovil:function(id, marca, modelo, stock){
            axios.post(url,{opcion:2,id:id , marca:marca, modelo:modelo, stock:stock}).then(response => {
                this.listarMoviles();
            });
        },
        //procedimiento borrar
        borrarMovil:function(id){
            axios.post(url,{opcion:3, id:id}).then(response => {
                this.listarMoviles();
            });
        },

        editar(item){
            this.editedIndex = this.moviles.indexOf(item)
            this.editado = Object.assign({},item)
            this.dialog = true
            //console.log()
        },
        borrar(item){
            const index = this.moviles.indexOf(item)
            consoles.log(this.moviles[index].id)//capturo el id de la fila seleccionada
            var r = confirm("¿Estas seguro de eliminar el registro?");
            if(r == true){
                this.borrarMovil(this.moviles[index].id)
                this.snackbar = true
                this.textSnack = 'Se elimino el registro.'
            }else{
                this.snackbar = true
                this.textSnack = 'Operacion cancelada.'
            }
        },
        cancelar(){
            this.dialog = false
            this.editado = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
        },
        guardar(){
            if(this.editedIndex > -1){
                //en el caso de actualizacion de un registro / guardar en caso de edicion
                this.id = this.editado.id
                this.marca = this.editado.marca
                this.modelo = this.editado.modelo
                this.stock = this.editado.stock

                this.snackbar = true
                this.textSnack = '¡Actualizacion Exitosa!'
                this.editarMovil(this.id, this.marca, this.modelo, this.stock)
            }else{
                //en el caso de nuevo registro / guarda el registro en caso de Nuevo
                if(this.editado.marca == "" || this.editado.modelo == "" || this.editado.stock == 0){
                    this.snackbar = true
                    this.textSnack = 'Datos incompletos.'   
                }else{
                this.marca = this.editado.marca
                this.modelo = this.editado.modelo
                this.stock = this.editado.stock

                this.snackbar = true
                this.textSnack = 'Registro exitoso'
                this.nuevoMovil()
            }
        }
        this.cancelar()
    },
  }
});