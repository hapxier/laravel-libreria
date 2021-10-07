<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Autores
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#crear">
                            <i class="far fa-plus-square"></i>
                        </button>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="autor in arrayAutores" :key="autor.id">
                                    <td v-text="autor.nombre"></td>
                                    <td v-text="autor.correo"></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar" @click=" editarModal(autor)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm" @click="eliminarAutor(autor.id)" >
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
                                <h5 class="modal-title" id="exampleModalLabel">Registrar autor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="limpiarModal()">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Nombre:</label>
                                        <div class="col-md-8">
                                            <input type="text" v-model="nombre" placeholder="Nombre..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Correo:</label>
                                        <div class="col-md-8">
                                            <input type="email" class="form-control" v-model="correo" placeholder="Correo@...">
                                        </div>
                                    </div>
                                    <!-- Errores -->
                                    <div v-show="errorAutor" class="form-group row">
                                        <div class="col-12 text-danger text-center">
                                            <div v-for="error in arrayErrorAutor" :key="error" v-text="error"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="limpiarModal()">Cerrar</button>
                                <button type="submit" class="btn btn-primary" @click="crearAutor()" >Guardar</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal editar-->
                    <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar autor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="limpiarModal()">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Nombre:</label>
                                        <div class="col-md-8">
                                            <input type="text" v-model="nombre" placeholder="Nombre..." class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Correo:</label>
                                        <div class="col-md-8">
                                            <input type="email" class="form-control" v-model="correo" placeholder="Correo@...">
                                        </div>
                                    </div>
                                    <!-- Errores -->
                                    <div v-show="errorAutor" class="form-group row">
                                        <div class="col-12 text-danger center">
                                            <div v-for="error in arrayErrorAutor" :key="error" v-text="error"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="limpiarModal()">Cerrar</button>
                                <button type="submit" class="btn btn-primary" @click="editarAutor()" >Guardar</button>
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
            return {
                id_autor: 0,
                nombre: '',
                correo: '',
                arrayAutores: [],
                errorAutor: 0,
                arrayErrorAutor: []
            }
        },
        methods: {
            listarAutores(){
                let me = this;
                axios.get('api/autores')
                .then(function (response) {
                    // handle success
                    me.arrayAutores = response.data;
                    // console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            },
            validarDatos(){
                this.errorAutor = 0;
                this.arrayErrorAutor = [];

                if (!this.nombre) {
                    this.arrayErrorAutor.push('Nombre requerido!');
                }
                if (!this.correo) {
                    this.arrayErrorAutor.push('Correo requerido!');
                }

                if (this.arrayErrorAutor.length) {
                    this.errorAutor = 1;
                }

                return this.errorAutor;
            },
            limpiarModal(){
                this.nombre = '';
                this.correo = '';
                this.id_autor = 0;
                this.errorAutor = 0;
                this.arrayErrorAutor = [];

            },
            crearAutor(){
                if (this.validarDatos()) {
                    return;
                }
                let me = this;
                axios.post('/api/autores',{
                    'nombre': this.nombre,
                    'correo': this.correo,
                }).then(function (response) {
                    me.limpiarModal();
                    $('#crear').modal('hide');
                    me.listarAutores();
                }).catch(function (error) {
                    console.log(error);
                });
                
            },
            editarAutor(){
                if (this.validarDatos()) {
                    return;
                }

                let me = this;
                axios.put('/api/autores/'+this.id_autor,{
                    'nombre': this.nombre,
                    'correo': this.correo,
                }).then(function (response) {
                    me.limpiarModal();
                    $('#editar').modal('hide');
                    me.listarAutores();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            editarModal(data = []){
                this.id_autor = data['id'];
                this.nombre = data['nombre'];
                this.correo = data['correo'];
            },
            eliminarAutor(id){
                Swal.fire({
                title: 'Eliminar el autor?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'NO',
                confirmButtonText: 'SI'
                }).then((result) => {
                if (result.isConfirmed) {
                    let me = this;
                    axios.delete('/api/autores/'+id).then(function (response) {
                        me.listarAutores();
                        me.limpiarModal();
                    }).catch(function (error) {
                        console.log(error);
                    }).then(function () {
                        
                    });

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
            this.listarAutores();
        }
    }
</script>
