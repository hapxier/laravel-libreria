<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tipo de obra
                        <button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#crear">
                            <i class="far fa-plus-square"></i>
                        </button>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Descripcion</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="tipo in arrayTipos" :key="tipo.id">
                                    <td v-text="tipo.tipo"></td>
                                    <td v-text="tipo.descripcion"></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editar" @click="editarModal(tipo)">
                                            <i class="fas fa-edit"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-sm btn-danger" @click="eliminarTipo(tipo.id)">
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
                                <h5 class="modal-title" id="exampleModalLabel">Registrar tipo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="limpiarModal()">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Tipo:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="Tipo..." v-model="tipo">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Descripción:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="Descripcion..." v-model="descripcion">
                                        </div>
                                    </div>
                                    <!-- Errores -->
                                    <div v-show="errorTipo" class="form-group row">
                                        <div class="col-12 text-center text-danger">
                                            <div v-for="error in arrayErrorTipo" :key="error" v-text="error"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="limpiarModal()">Cerrar</button>
                                <button type="submit" class="btn btn-primary" @click="crearTipo()">Guardar</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal editar-->
                    <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar tipo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="limpiarModal()">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Tipo:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="Tipo..." v-model="tipo">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label">Descripción:</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="Descripcion..." v-model="descripcion">
                                        </div>
                                    </div>
                                    <!-- Errores -->
                                    <div v-show="errorTipo" class="form-group row">
                                        <div class="col-12 text-center text-danger">
                                            <div v-for="error in arrayErrorTipo" :key="error" v-text="error"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="limpiarModal()">Cerrar</button>
                                <button type="submit" class="btn btn-primary" @click="editarTipo()">Editar</button>
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
                id_tipo: 0,
                tipo: '',
                descripcion: '',
                arrayTipos: [],
                errorTipo: 0,
                arrayErrorTipo: []
            }
        },
        methods: {
            listarTipos(){
                let me = this;
                axios.get('/api/tipos').then(function (response) {
                    me.arrayTipos = response.data;
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {});
            },
            validarTipo(){
                this.errorTipo = 0;
                this.arrayErrorTipo = [];

                if(!this.tipo) this.arrayErrorTipo.push('Tipo requerido!');
                if(this.arrayErrorTipo.length) this.errorTipo=1;

                return this.errorTipo;
            },
            limpiarModal(){
                this.id_tipo = 0;
                this.tipo = '';
                this.descripcion = '';
                this.errorTipo = 0;
                this.arrayErrorTipo = [];

            },
            crearTipo(){
                if(this.validarTipo()) return;
                
                let me = this;
                axios.post('/api/tipos',{
                    'tipo': me.tipo,
                    'descripcion': me.descripcion 
                }).then(function (response) {
                    me.listarTipos();
                    $('#crear').modal('hide');
                    me.limpiarModal();
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {});
            },
            editarModal(data = []){
                this.id_tipo = data['id'];
                this.tipo = data['tipo'];
                this.descripcion = data['descripcion'];
            },
            editarTipo(){
                if(this.validarTipo()) return;
                let me = this;
                axios.put('/api/tipos/'+me.id_tipo,{
                    'tipo': me.tipo,
                    'descripcion': me.descripcion 
                }).then(function (response) {
                    me.listarTipos();
                    $('#editar').modal('hide');
                    me.limpiarModal();
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {});
            },
            eliminarTipo(id){
                Swal.fire({
                title: 'Eliminar el tipo?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'NO',
                confirmButtonText: 'SI'
                }).then((result) => {
                if (result.isConfirmed) {
                    let me = this;
                    axios.delete('/api/tipos/'+id).then(function (response) {
                        me.listarTipos();
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
            this.listarTipos();
        }
    }
</script>
