<form action="inc/create/procesaformulario.php" method="POST">

  <div class="controlformulario">
    <label for="nombre">Nombre de la película</label>
    <input type="text" name="nombre" id="nombre">
  </div>

  <div class="controlformulario">
    <label for="director">Director</label>
    <input type="text" name="director" id="director">
  </div>

  <div class="controlformulario">
    <label for="fecha_estreno">Fecha de estreno</label>
    <input type="date" name="fecha_estreno" id="fecha_estreno">
  </div>

  <div class="controlformulario">
    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" id="descripcion"></textarea>
  </div>

  <div class="controlformulario">
    <label for="id_categoria">Categoría (ID)</label>
    <input type="number" name="id_categoria" id="id_categoria">
  </div>

  <input type="submit">

</form>