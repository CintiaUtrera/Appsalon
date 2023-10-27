<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<div id="app">
    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p text-center>Elige tus servicios a continuación</p>
    <div id="servicios" class="listado-servicios">

    </div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Cita</h2>
        <p text-center>Coloca tus datos y fecha de tu cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" placeholder="Tu Nombre" />
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input id="fecha" type="date" />
            </div>
            <div class="campo">
                <label for="Hora">Hora</label>
                <input id="Hora" type="time" />
            </div>
        </form>
    </div>

    <div id="paso-3" class="seccion">
        <h2>Resumen</h2>
        <p text-center>Verifica que la información sea correcta</p>
    </div>
</div>