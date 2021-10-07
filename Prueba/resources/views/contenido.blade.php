@extends('welcome')
@section('contenido')

    <template v-if="menu==0">
        <autor></autor>        
    </template>
    <template v-if="menu==1">
        <genero></genero>
    </template>
    <template v-if="menu==2">
        <tipo></tipo>
    </template>
    <template v-if="menu==3">
        <libro></libro>
    </template>
    
@endsection