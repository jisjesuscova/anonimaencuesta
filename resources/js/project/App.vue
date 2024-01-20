<template>
  <div>
    <div class="container" style="margin-top: 40px;">
      <div class="col-md-12">
        <center>
            <img :src="`../../logo.png`" height="50" alt="Logo Home">
        </center>
      </div>
    </div>
    <hr>
    <div class="container">
      <div class="alert alert-danger" role="alert">
        La encuesta a continuación es completamente anónima.
      </div>
      <div class="card">
        <div class="card-header" style="font-weight: bold;">
          Estimado te invitamos a participar con la finalidad de poder mejorar conjuntamente durante este 2024. Tu opinion es fundamental para mejorar.
        </div>
        <div class="card-body">
          <h3 class="card-title"> 1 - ¿Como calificarías el ambiente de trabajo con tus(s) compañeros(s) en tu sucursal?</h3>
          <p class="card-text" style="margin-top: 30px;"><hr></p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q1_1" value="1">
            <label class="form-check-label" for="exampleRadios1">
              Excelente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q1_2" value="2">
            <label class="form-check-label" for="exampleRadios1">
              Bueno
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q1_3" value="3">
            <label class="form-check-label" for="exampleRadios1">
              Regular
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q1_4" value="4">
            <label class="form-check-label" for="exampleRadios1">
              Deficiente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q1_5" value="5">
            <label class="form-check-label" for="exampleRadios1">
              Negativo
            </label>
          </div>

          <p class="card-text" style="margin-top: 30px;"><hr></p>
          <h3 class="card-title"> 2 - ¿Como calificarías el ambiente de trabajo con tus jefe directo?</h3>
          <p class="card-text" style="margin-top: 50px;"><hr></p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q2_1" value="1">
            <label class="form-check-label" for="exampleRadios1">
              Excelente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q2_2" value="2">
            <label class="form-check-label" for="exampleRadios1">
              Bueno
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q2_3" value="3">
            <label class="form-check-label" for="exampleRadios1">
              Regular
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q2_4" value="4">
            <label class="form-check-label" for="exampleRadios1">
              Deficiente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q2_5" value="5">
            <label class="form-check-label" for="exampleRadios1">
              Negativo
            </label>
          </div>

          <p class="card-text" style="margin-top: 30px;"><hr></p>
          <h3 class="card-title"> 3 - ¿Qué aspectos específicos de tu ambiente laboral te hacen sentir más santisfecho/a?</h3>
          <p class="card-text" style="margin-top: 50px;"><hr></p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q3_1" value="1">
            <label class="form-check-label" for="exampleRadios1">
              Relaciones Interpersonales
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q3_2" value="2">
            <label class="form-check-label" for="exampleRadios1">
              Condiciones de Trabajo
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q3_3" value="3">
            <label class="form-check-label" for="exampleRadios1">
              Oportunidades de Desarrollo
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q3_4" value="4">
            <label class="form-check-label" for="exampleRadios1">
              Bonificación Mensual
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q3_5" value="5">
            <label class="form-check-label" for="exampleRadios1">
              Equilibrio Trabajo-Vida
            </label>
          </div>

          <p class="card-text" style="margin-top: 30px;"><hr></p>
          <h3 class="card-title"> 4 - ¿Cómo evalúas tu relación con tus compañeros de trabajo?</h3>
          <p class="card-text" style="margin-top: 50px;"><hr></p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q4_1" value="1">
            <label class="form-check-label" for="exampleRadios1">
              Excelente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q4_2" value="2">
            <label class="form-check-label" for="exampleRadios1">
              Bueno
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q4_3" value="3">
            <label class="form-check-label" for="exampleRadios1">
              Regular
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q4_4" value="4">
            <label class="form-check-label" for="exampleRadios1">
              Deficiente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="q4_5" value="5">
            <label class="form-check-label" for="exampleRadios1">
              Negativo
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>