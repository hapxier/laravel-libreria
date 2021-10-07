<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Libros
                        <button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#crear">
                            <i class="far fa-plus-square"></i>
                        </button>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Tipo</th>
                                    <th>Genero</th>
                                    <th>Autor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="libro in arrayLibros" :key="libro.id">
                                    <td v-text="libro.titulo"></td>
                                    <td v-text="libro.tipo"></td>
                                    <td v-text="libro.genero"></td>
                                    <td v-text="libro.nombre"></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editar" @click="editarModal(libro)">
                                            <i class="fas fa-edit"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-sm btn-danger" @click="eliminarLibro(libro.id)">
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
                                <h5 class="modal-title" id="exampleModalLabel">Registrar libro</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="limpiarModal()">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Titulo:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="Titulo..." v-model="titulo">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Tipo:</label>
                                        <div class="col-md-8">
                                            <select class="form-control" v-model="id_tipo">
                                                <option value="0">Seleccione...</option>
                                                <option v-for="tipo in arrayTipos" :key="tipo.id" :value="tipo.id" v-text="tipo.tipo"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Genero:</label>
                                        <div class="col-md-8">
                                            <select class="form-control" v-model="id_genero">
                                                <option value="0">Seleccione...</option>
                                                <option v-for="genero in arrayGeneros" :key="genero.id" :value="genero.id" v-text="genero.genero"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Autor:</label>
                                        <div class="col-md-8">
                                            <select class="form-control" v-model="id_autor">
                                                <option value="0">Seleccione...</option>
                                                <option v-for="autor in arrayAutores" :key="autor.id" :value="autor.id" v-text="autor.nombre"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Errores -->
                                    <div v-show="errorLibro" class="form-group row">
                                        <div class="col-12 text-center text-danger">
                                            <div v-for="error in arrayErrorLibro" :key="error" v-text="error"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="limpiarModal()">Cerrar</button>
                                <button type="submit" class="btn btn-primary" @click="crearLibro()">Guardar</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal editar-->
                    <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar libro</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="limpiarModal()">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Titulo:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="Titulo..." v-model="titulo">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Tipo:</label>
                                        <div class="col-md-8">
                                            <select class="form-control" v-model="id_tipo">
                                                <option value="0">Seleccione...</option>
                                                <option v-for="tipo in arrayTipos" :key="tipo.id" :value="tipo.id" v-text="tipo.tipo"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Genero:</label>
                                        <div class="col-md-8">
                                            <select class="form-control" v-model="id_genero">
                                                <option value="0">Seleccione...</option>
                                                <option v-for="genero in arrayGeneros" :key="genero.id" :value="genero.id" v-text="genero.genero"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Autor:</label>
                                        <div class="col-md-8">
                                            <select class="form-control" v-model="id_autor">
                                                <option value="0">Seleccione...</option>
                                                <option v-for="autor in arrayAutores" :key="autor.id" :value="autor.id" v-text="autor.nombre"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Errores -->
                                    <div v-show="errorLibro" class="form-group row">
                                        <div class="col-12 text-center text-danger">
                                            <div v-for="error in arrayErrorLibro" :key="error" v-text="error"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="limpiarModal()">Cerrar</button>
                                <button type="submit" class="btn btn-primary" @click="editarLibro()">Editar</button>
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
                id_libro: 0,
                id_tipo: 0,
                id_genero: 0,
                id_autor: 0,
                titulo: '',
                // tipo: '',
                // genero: '',
                // nombre: '',
                arrayLibros: [],
                errorLibro: 0,
                arrayErrorLibro: [],
                arrayTipos: [],
                arrayGeneros: [],
                arrayAutores: []
            }
        },
        methods: {
            listarLibros(){
                let me = this;
                axios.get('/api/libros').then(function (response) {
                    me.arrayLibros = response.data;
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {});
            },
            validarLibro(){
                this.errorLibro = 0;
                this.arrayErrorLibro = [];

                if(!this.titulo) this.arrayErrorLibro.push('Titulo requerido!');
                if(!this.id_tipo || this.id_tipo=="0") this.arrayErrorLibro.push('Tipo requerido!');
                if(!this.id_genero || this.id_genero=="0") this.arrayErrorLibro.push('Genero requerido!');
                if(!this.id_autor || this.id_autor=="0") this.arrayErrorLibro.push('Autor requerido!');

                if(this.arrayErrorLibro.length) this.errorLibro=1;

                return this.errorLibro;
            },
            selectTipo(){
                let me = this;
                axios.get('/api/tipos').then(function (response) {
                    me.arrayTipos = response.data;
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {});
            },
            selectGenero(){
                let me = this;
                axios.get('/api/generos').then(function (response) {
                    me.arrayGeneros = response.data;
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {});
            },
            selectAutor(){
                let me = this;
                axios.get('/api/autores').then(function (response) {
                    me.arrayAutores = response.data;
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {});
            },
            limpiarModal(){
                this.id_libro = 0;
                this.id_tipo = 0;
                this.id_genero = 0;
                this.id_autor = 0;
                this.titulo = '';
                this.errorLibro = 0;
                this.arrayErrorLibro = [];
            },
            crearLibro(){
                if(this.validarLibro()) return;
                
                let me = this;
                axios.post('/api/libros',{
                    'titulo': me.titulo,
                    'id_tipo': me.id_tipo,
                    'id_genero': me.id_genero,
                    'id_autor': me.id_autor
                }).then(function (response) {
                    me.listarLibros();
                    $('#crear').modal('hide');
                    me.limpiarModal();
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {});
            },
            editarModal(data = []){
                this.id_libro = data['id'];
                this.id_tipo = data['id_tipo'];
                this.id_genero = data['id_genero'];
                this.id_autor = data['id_autor'];
                this.titulo = data['titulo'];
            },
            editarLibro(){
                if(this.validarLibro()) return;

                let me = this;
                axios.put('/api/libros/'+me.id_libro,{
                    'id_tipo': me.id_tipo,
                    'id_genero': me.id_genero,
                    'id_autor': me.id_autor,
                    'titulo': me.titulo 
                }).then(function (response) {
                    me.listarLibros();
                    $('#editar').modal('hide');
                    me.limpiarModal();
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {});
            },
            eliminarLibro(id){
                Swal.fire({
                title: 'Eliminar el libro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'NO',
                confirmButtonText: 'SI'
                }).then((result) => {
                if (result.isConfirmed) {
                    let me = this;
                    axios.delete('/api/libros/'+id).then(function (response) {
                        me.listarLibros();
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
            this.selectTipo();
            this.selectGenero();
            this.selectAutor();
            this.listarLibros();
        }
    }
</script>
