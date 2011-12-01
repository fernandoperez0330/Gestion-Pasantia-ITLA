<div>
    <h2><img src="resources/sugerencias.jpg" width="25" />&nbsp;Buzon de sugerencias</h2>
    <p>Si tiene alguna duda, inquietud o sugerencia con relaci&oacute;n al proyecto, las puede dejar a traves de este formulario y con gusto le serviremos</p>
    <form action="ajax.suggestion.php" name="frmsuggestion" id="frmsuggestion" method="post">
    <h4>Nombre</h4>
    <div>
        <input type="text" name="nombre" id="nombre" />        
    </div>
     <h4>Correo</h4>
    <div>
        <input type="text" name="correo" id="correo" />        
    </div>
      <h4>Sugerencia</h4>
    <div>
        <textarea name="sugerencia" id="sugerencia" rows="5" cols="40"></textarea>   
    </div>
      <br/>
      <div>
          <input type="submit" name="enviar" id="enviar" value="Enviar Sugerencia" title="Enviar sugerencias"/>
          <span class="ajaxloader">&nbsp;</span>
      </div>
</form>
</div>