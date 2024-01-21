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
    <div class="container" v-if="is_active == 1 && is_success == 0">
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
            <input class="form-check-input" type="radio" name="exampleRadios1" id="q1_1" value="1" v-model="q1">
            <label class="form-check-label" for="exampleRadios1">
              Excelente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios1" id="q1_2" value="2" v-model="q1">
            <label class="form-check-label" for="exampleRadios1">
              Bueno
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios1" id="q1_3" value="3" v-model="q1">
            <label class="form-check-label" for="exampleRadios1">
              Regular
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios1" id="q1_4" value="4" v-model="q1">
            <label class="form-check-label" for="exampleRadios1">
              Deficiente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios1" id="q1_5" value="5" v-model="q1">
            <label class="form-check-label" for="exampleRadios1">
              Negativo
            </label>
          </div>

          <p class="card-text" style="margin-top: 30px;"><hr></p>
          <h3 class="card-title"> 2 - ¿Como calificarías el ambiente de trabajo con tus jefe directo?</h3>
          <p class="card-text" style="margin-top: 50px;"><hr></p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios2" id="q2_1" value="1" v-model="q2">
            <label class="form-check-label" for="exampleRadios2">
              Excelente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios2" id="q2_2" value="2" v-model="q2">
            <label class="form-check-label" for="exampleRadios2">
              Bueno
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios2" id="q2_3" value="3" v-model="q2">
            <label class="form-check-label" for="exampleRadios2">
              Regular
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios2" id="q2_4" value="4" v-model="q2">
            <label class="form-check-label" for="exampleRadios2">
              Deficiente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios2" id="q2_5" value="5" v-model="q2">
            <label class="form-check-label" for="exampleRadios2">
              Negativo
            </label>
          </div>

          <p class="card-text" style="margin-top: 30px;"><hr></p>
          <h3 class="card-title"> 3 - ¿Qué aspectos específicos de tu ambiente laboral te hacen sentir más santisfecho/a?</h3>
          <p class="card-text" style="margin-top: 50px;"><hr></p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios3" id="q3_1" value="1" v-model="q3">
            <label class="form-check-label" for="exampleRadios3">
              Relaciones Interpersonales
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios3" id="q3_2" value="2" v-model="q3">
            <label class="form-check-label" for="exampleRadios3">
              Condiciones de Trabajo
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios3" id="q3_3" value="3" v-model="q3">
            <label class="form-check-label" for="exampleRadios3">
              Oportunidades de Desarrollo
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios3" id="q3_4" value="4" v-model="q3">
            <label class="form-check-label" for="exampleRadios3">
              Bonificación Mensual
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios3" id="q3_5" value="5" v-model="q3">
            <label class="form-check-label" for="exampleRadios3">
              Equilibrio Trabajo-Vida
            </label>
          </div>

          <p class="card-text" style="margin-top: 30px;"><hr></p>
          <h3 class="card-title"> 4 - ¿Cómo evalúas tu relación con tus compañeros de trabajo?</h3>
          <p class="card-text" style="margin-top: 50px;"><hr></p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios4" id="q4_1" value="1" v-model="q4">
            <label class="form-check-label" for="exampleRadios4">
              Excelente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios4" id="q4_2" value="2" v-model="q4">
            <label class="form-check-label" for="exampleRadios4">
              Bueno
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios4" id="q4_3" value="3" v-model="q4">
            <label class="form-check-label" for="exampleRadios4">
              Regular
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios4" id="q4_4" value="4" v-model="q4">
            <label class="form-check-label" for="exampleRadios4">
              Deficiente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios4" id="q4_5" value="5" v-model="q4">
            <label class="form-check-label" for="exampleRadios4">
              Negativo
            </label>
          </div>

          <p class="card-text" style="margin-top: 30px;"><hr></p>
          <h3 class="card-title"> 5 - ¿Cómo evalúas tu relación con jefe directo, ante conflictos en la sucursal?</h3>
          <p class="card-text" style="margin-top: 50px;"><hr></p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios5" id="q5_1" value="1" v-model="q5">
            <label class="form-check-label" for="exampleRadios5">
              Excelente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios5" id="q5_2" value="2" v-model="q5">
            <label class="form-check-label" for="exampleRadios5">
              Bueno
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios5" id="q5_3" value="3" v-model="q5">
            <label class="form-check-label" for="exampleRadios5">
              Regular
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios5" id="q5_4" value="4" v-model="q5">
            <label class="form-check-label" for="exampleRadios5">
              Deficiente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios5" id="q5_5" value="5" v-model="q5">
            <label class="form-check-label" for="exampleRadios5">
              Negativo
            </label>
          </div>

          <p class="card-text" style="margin-top: 30px;"><hr></p>
          <h3 class="card-title"> 6 - ¿Cómo evalúas el equilibrio entre tu vida laboral y personal?</h3>
          <p class="card-text" style="margin-top: 50px;"><hr></p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios6" id="q6_1" value="1" v-model="q6">
            <label class="form-check-label" for="exampleRadios6">
              Excelente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios6" id="q6_2" value="2" v-model="q6">
            <label class="form-check-label" for="exampleRadios6">
              Bueno
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios6" id="q6_3" value="3" v-model="q6">
            <label class="form-check-label" for="exampleRadios6">
              Regular
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios6" id="q6_4" value="4" v-model="q6">
            <label class="form-check-label" for="exampleRadios6">
              Deficiente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios6" id="q6_5" value="5" v-model="q6">
            <label class="form-check-label" for="exampleRadios6">
              Negativo
            </label>
          </div>

          <p class="card-text" style="margin-top: 30px;"><hr></p>
          <h3 class="card-title"> 7 - ¿Tu jornada laboral catual te permite compatibilizar con tu vida personal?</h3>
          <p class="card-text" style="margin-top: 50px;"><hr></p>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios7" id="q7_1" value="1" v-model="q7">
            <label class="form-check-label" for="exampleRadios7">
              Totalmente de acuerdo
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios7" id="q7_2" value="2" v-model="q7">
            <label class="form-check-label" for="exampleRadios7">
              De acuerdo
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios7" id="q7_3" value="3" v-model="q7">
            <label class="form-check-label" for="exampleRadios7">
              Ni de acuerdo ni en descuerdo
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios7" id="q7_4" value="4" v-model="q7">
            <label class="form-check-label" for="exampleRadios7">
              En desacuerdo
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios7" id="q7_5" value="5" v-model="q7">
            <label class="form-check-label" for="exampleRadios7">
              Totalmente en desacuerdo
            </label>
          </div>

          <p class="card-text" style="margin-top: 30px;"><hr></p>
          <h3 class="card-title"> 8 - ¿Te gustaría participar en capacitaciones de alguno de los siguientes aspectos? Enumera del más importante al menos importante, siendo (1) el más importante y (3) el menos importante.</h3>
          <p class="card-text" style="margin-top: 50px;"><hr></p>
          <h4 style="font-size: 16px;">
            - Mantención
          </h4>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions81" id="q8_1_1" value="1" v-model="q8_1">
            <label class="form-check-label" for="inlineRadio81">1</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions81" id="q8_1_2" value="2" v-model="q8_1">
            <label class="form-check-label" for="inlineRadio81">2</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions81" id="q8_1_3" value="3" v-model="q8_1">
            <label class="form-check-label" for="inlineRadio81">3</label>
          </div>
          <p class="card-text"><hr></p>
          <h4 style="font-size: 16px;">
            - Resolución de Conflictos
          </h4>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions82" id="q8_2_1" value="1" v-model="q8_2">
            <label class="form-check-label" for="inlineRadio82">1</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions82" id="q8_2_2" value="2" v-model="q8_2">
            <label class="form-check-label" for="inlineRadio82">2</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions82" id="q8_2_3" value="3" v-model="q8_2">
            <label class="form-check-label" for="inlineRadio82">3</label>
          </div>
          <p class="card-text"><hr></p>
          <h4 style="font-size: 16px;">
            - Sistema Intranet
          </h4>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions83" id="q8_3_1" value="1" v-model="q8_3">
            <label class="form-check-label" for="inlineRadio83">1</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions83" id="q8_3_2" value="2" v-model="q8_3">
            <label class="form-check-label" for="inlineRadio83">2</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions83" id="q8_3_3" value="3" v-model="q8_3">
            <label class="form-check-label" for="inlineRadio83">3</label>
          </div>
          <p class="card-text"><hr></p>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions84" id="q8_4_1" value="1" v-model="q8_4">
            <label class="form-check-label" for="inlineRadio84">No me interesa participar en capacitaciones</label>
          </div>

          <p class="card-text" style="margin-top: 30px;"><hr></p>
          <h3 class="card-title"> 9 - Proporciona cualquier comentario adicional que puedas tener sobre tu experiencia laboral y cómo podríamos mejorar en:</h3>
          <p class="card-text" style="margin-top: 5px;"><hr></p>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Recursos Humanos</label>
            <textarea class="form-control" id="q9_1" rows="3" v-model="q9_1"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Operaciones</label>
            <textarea class="form-control" id="q9_2" rows="3" v-model="q9_2"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Mantención de Equipos</label>
            <textarea class="form-control" id="q9_3" rows="3" v-model="q9_3"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Siniestros</label>
            <textarea class="form-control" id="q9_4" rows="3" v-model="q9_4"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Sistemas de Intranet</label>
            <textarea class="form-control" id="q9_5" rows="3" v-model="q9_5"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Comunicación con Casa Matriz</label>
            <textarea class="form-control" id="q9_6" rows="3" v-model="q9_6"></textarea>
          </div>

        </div>
        
        <div class="card-footer">
          <button type="button" class="btn btn-success btn-lg" @click="submit">Enviar</button>
        </div>
        
      </div>
      
    </div>
    <div class="container" v-if="is_active == 0">
      <div class="alert alert-danger" role="alert">
        <h3>
          <center>
            El enlace de la encuesta ya no se encuentra activo. Muchas gracias.
          </center>
        </h3>
      </div>
    </div>
    <div class="container" v-if="is_success == 1">
      <div class="alert alert-success" role="alert">
        <h3>
          <center>
            Muchas gracias por contestar la encuesta. Hasta pronto.
          </center>
        </h3>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      q1: null,
      q2: null,
      q3: null,
      q4: null,
      q5: null,
      q6: null,
      q7: null,
      q8_1: null,
      q8_2: null,
      q8_3: null,
      q8_4: null,
      q9_1: null,
      q9_2: null,
      q9_3: null,
      q9_4: null,
      q9_5: null,
      q9_6: null,
      formIsValid: true,
      is_active: 0,
      is_success: 0,
    };
  },
  mounted() {
    this.check();
  },
  methods: {
    async check() {
      const api_token = 'AtWYamNvDOfgDOEY6UbXgvGqDiRPR7QOt9Si1hbeMmat4g2Qfxzg7LlT5yzNz5LOozQbcA9uibaSTu4t';

      // Obtener el fragmento de la URL
      const full_url = window.location.href;

      // Remover el carácter "#" del fragmento
      const part_url = full_url.split('?');

      const user_id = part_url[1];

      try {
        const response = await axios.get(
          `https://jisparking.com/api/worker_poll/check?api_token=${api_token}&user_id=${user_id}&poll_id=1`
        );
        console.log(response.data.data);
        if (response.data.data == 1) {
          this.is_active = 1;
        } else {
          this.is_active = 0;
        }

      } catch (error) {
        console.error("Error al validar la encuesta:", error);
      }
    },
    submit() {
      // Verificar si el formulario es válido antes de enviar
      if (this.validateForm()) {
        // Lógica para enviar el formulario
        this.sendForm();
      } else {
        if (!this.q1) {
          alert("La respuesta de la pregunta N° 1 es obligatoria por favor rellenarla.");
        }

        if (!this.q2) {
          alert("La respuesta de la pregunta N° 2 es obligatoria por favor rellenarla.");
        }

        if (!this.q3) {
          alert("La respuesta de la pregunta N° 3 es obligatoria por favor rellenarla.");
        }

        if (!this.q4) {
          alert("La respuesta de la pregunta N° 4 es obligatoria por favor rellenarla.");
        }

        if (!this.q5) {
          alert("La respuesta de la pregunta N° 5 es obligatoria por favor rellenarla.");
        }

        if (!this.q6) {
          alert("La respuesta de la pregunta N° 6 es obligatoria por favor rellenarla.");
        }

        if (!this.q7) {
          alert("La respuesta de la pregunta N° 7 es obligatoria por favor rellenarla.");
        }

        if ((!this.q8_1 || !this.q8_2 || !this.q8_3) && !this.q8_4) {
          alert("La respuesta de la pregunta N° 8 es obligatoria por favor rellenarla.");
        }
      }
    },
    validateForm() {
      // Lógica para validar el formulario
      this.formIsValid = true; // Restablecer la bandera

      // Verificar cada campo, aquí puedes agregar más campos según sea necesario
      if (!this.q1 || !this.q2 || !this.q3 || !this.q4 || !this.q5 || !this.q6 || !this.q7 || ((!this.q8_1 || !this.q8_2 || !this.q8_3) && !this.q8_4)) {
        this.formIsValid = false;
      }

      return this.formIsValid;
    },
    async sendForm() {
      const api_token = 'AtWYamNvDOfgDOEY6UbXgvGqDiRPR7QOt9Si1hbeMmat4g2Qfxzg7LlT5yzNz5LOozQbcA9uibaSTu4t';

      // Obtener el fragmento de la URL
      const full_url = window.location.href;

      // Remover el carácter "#" del fragmento
      const part_url = full_url.split('?');

      const user_id = part_url[1];

      const formData = new FormData();

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 1);
      formData.append("answer", this.q1);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 2);
      formData.append("answer", this.q2);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 3);
      formData.append("answer", this.q3);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 4);
      formData.append("answer", this.q4);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 5);
      formData.append("answer", this.q5);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 6);
      formData.append("answer", this.q6);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 7);
      formData.append("answer", this.q7);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }

      if (!this.q8_4) {
        formData.append("user_id", user_id);
        formData.append("poll_id", 1);
        formData.append("question_id", 81);
        formData.append("answer", this.q8_1);

        try {
          const response = await axios.post(
            "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
            formData,
            {
              headers: {
                "Content-Type": "multipart/form-data",
              },
            }
          );
          console.log("Encuesta enviada correctamente:", response);
        } catch (error) {
          console.error("Error al guardar la encuesta:", error);
        }
      }

      if (!this.q8_4) {
        formData.append("user_id", user_id);
        formData.append("poll_id", 1);
        formData.append("question_id", 82);
        formData.append("answer", this.q8_2);

        try {
          const response = await axios.post(
            "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
            formData,
            {
              headers: {
                "Content-Type": "multipart/form-data",
              },
            }
          );
          console.log("Encuesta enviada correctamente:", response);
        } catch (error) {
          console.error("Error al guardar la encuesta:", error);
        }
      }

      if (!this.q8_4) {
        formData.append("user_id", user_id);
        formData.append("poll_id", 1);
        formData.append("question_id", 83);
        formData.append("answer", this.q8_3);

        try {
          const response = await axios.post(
            "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
            formData,
            {
              headers: {
                "Content-Type": "multipart/form-data",
              },
            }
          );
          console.log("Encuesta enviada correctamente:", response);
        } catch (error) {
          console.error("Error al guardar la encuesta:", error);
        }
      }

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 84);
      formData.append("answer", this.q8_4);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 91);
      formData.append("answer", this.q9_1);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 92);
      formData.append("answer", this.q9_2);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 93);
      formData.append("answer", this.q9_3);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 94);
      formData.append("answer", this.q9_4);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 95);
      formData.append("answer", this.q9_5);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }

      formData.append("user_id", user_id);
      formData.append("poll_id", 1);
      formData.append("question_id", 96);
      formData.append("answer", this.q9_6);

      try {
        const response = await axios.post(
          "https://jisparking.com/api/worker_poll/store?api_token=" + api_token,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );

        this.is_success = 1;
        
        console.log("Encuesta enviada correctamente:", response);
      } catch (error) {
        console.error("Error al guardar la encuesta:", error);
      }
    },
  },
};
</script>