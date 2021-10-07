<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Generos literarios
                        <button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#crear">
                            <i class="far fa-plus-square"></i>
                        </button>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Genero</th>
                                    <th>Descripcion</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="genero in arrayGeneros" :key="genero.id">
                                    <td v-text="genero.genero"></td>
                                    <td v-text="genero.descripcion"></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editar" @click="editarModal(genero)">
                                            <i class="fas fa-edit"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-sm btn-danger" @click="eliminarGenero(genero.id)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Crear-->
                    <div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registrar genero</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="limpiarModal()">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Genero:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="Genero..." v-model="genero">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Descripción:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="Descripcion..." v-model="descripcion">
                                        </div>
                                    </div>
                                    <!-- Errores -->
                                    <div v-show="errorGenero" class="form-group row">
                                        <div class="col-12 text-center text-danger">
                                            <div v-for="error in arrayErrorGenero" :key="error" v-text="error"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="limpiarModal()">Cerrar</button>
                                <button type="submit" class="btn btn-primary" @click="crearGenero()">Guardar</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal editar-->
                    <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar genero</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="limpiarModal()">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Genero:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="Genero..." v-model="genero">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Descripción:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="Descripcion..." v-model="descripcion">
                                        </div>
                                    </div>
                                    <!-- Errores -->
                                    <div v-show="errorGenero" class="form-group row">
                                        <div class="col-12 text-center text-danger">
                                            <div v-for="error in arrayErrorGenero" :key="error" v-text="error"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="limpiarModal()">Cerrar</button>
                                <button type="submit" class="btn btn-primary" @click="editarGenero()">Editar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                id_genero: 0,
                genero: '',
                descripcion: '',
                arrayGeneros: [],
                errorGenero: 0,
                arrayErrorGenero: []
            }
        },
        methods: {
            listarGeneros(){
                let me = this;
                axios.get('/api/generos').then(function (response) {
                    me.arrayGeneros = response.data;
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {});
            },
            validarGenero(){
                this.errorGenero = 0;
                this.arrayErrorGenero = [];

                if(!this.genero) this.arrayErrorGenero.push('Genero requerido!');
                // if(!this.descripcion) this.arrayErrorGenero.push('Descripcion requerida!');
                if(this.arrayErrorGenero.length) this.errorGenero=1;


                return this.errorGenero;
            },
            limpiarModal(){
                this.id_genero = 0;
                this.genero = '';
                this.descripcion = '';
                this.errorGenero = 0;
                this.arrayErrorGenero = [];

            },
            crearGenero(){
                if(this.validarGenero()) return;
                let me = this;
                axios.post('/api/generos',{
                    'genero': me.genero,
                    'descripcion': me.descripcion 
                }).then(function (response) {
                    me.listarGeneros();
                    $('#crear').modal('hide');
                    me.limpiarModal();
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {});
            },
            editarModal(data = []){
                this.id_genero = data['id'];
                this.genero = data['genero'];
                this.descripcion = data['descripcion'];
            },
            editarGenero(){
                if(this.validarGenero()) return;
                let me = this;
                axios.put('/api/generos/'+me.id_genero,{
                    'genero': me.genero,
                    'descripcion': me.descripcion 
                }).then(function (response) {
                    me.listarGeneros();
                    $('#editar').modal('hide');
                    me.limpiarModal();
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {});
            },
            eliminarGenero(id){
                Swal.fire({
                title: 'Eliminar el genero?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'NO',
                confirmButtonText: 'SI'
                }).then((result) => {
                if (result.isConfirmed) {
                    let me = this;
                    axios.delete('/api/generos/'+id).then(function (response) {
                        me.listarGeneros();
                        me.limpiarModal();
                    }).catch(function (error) {
                        console.log(error);
                    }).then(function () {});
                    Swal.fire(
                    'Eliminado!',
                    '',
                    'success'
                    )
                }
                });
            }
        },
        mounted() {
            // console.log('Component mounted.')
            this.listarGeneros();
        }
    }
</script>
