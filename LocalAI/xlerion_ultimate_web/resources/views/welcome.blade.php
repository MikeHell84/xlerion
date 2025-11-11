@extends('layouts.app')

@section('content')
    <div class="space-y-24 pt-10">
        <div id="inicio">@include('sections.inicio')</div>
        <div id="filosofia" class="pt-12">@include('sections.filosofia')</div>
        <div id="soluciones" class="pt-12">@include('sections.soluciones')</div>
        <div id="proyectos" class="pt-12">@include('sections.proyectos')</div>
        <div id="documentacion" class="pt-12">@include('sections.documentacion')</div>
        <div id="fundador" class="pt-12">@include('sections.fundador')</div> 
        <div id="alianzas" class="pt-12">@include('sections.alianzas')</div>
        <div id="blog" class="pt-12">@include('sections.blog')</div>
        <div id="contacto" class="pt-12">@include('sections.contacto')</div>
    </div>
@endsection