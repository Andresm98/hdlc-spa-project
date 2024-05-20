<template>
  <div class="flex flex-wrap p-6 sm:px-20 bg-blue-100 border-2 border-blue-200">
    <div class="lg:w-2/5">
      <jet-application-logo class="h-48 pt-9" />
    </div>
    <div class="lg:w-3/5 mx-auto">
      <div class="mt-8 text-2xl">
        Bienvenido al Sistema de Secretaría Hijas de la Caridad San Vicente de
        Paúl
      </div>

      <div class="mt-6 text-black">
        El sistema de gestión documental de secretaría de la Compañía de las
        Hijas de la Caridad pone a disposición la información relacionada a las
        hermanas, comunidades, pastolares, zonas y otro tipo de información
        sensible. Por favor, manipule con cuidado las credenciales que le sean
        asignadas ya que dependiendo del rol que se le asigne.
      </div>
    </div>
  </div>
  <div class="bg-gray-100">
    <br />
    <br />
    <div class="bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
      <div class="bg-white p-6 border-2 border-blue-200">
        <div class="flex items-center">
          <img
            class="h-10 max-w-full"
            src="https://cdn.britannica.com/83/78183-004-345353F4/Stack-books.jpg"
          />
          <div class="ml-4 text-lg text-black-600 leading-7 font-semibold">
            <a href="#">Documentación</a>
          </div>
        </div>

        <div class="ml-12">
          <div class="mt-2 text-sm text-black text-justify">
            La Compañía pone a su disposición la documentación necesaria para
            dar uso al sistema, por favor solicite la información a secretaría.
            La documentación será puntual y dependiendo de las requerimientos
            deberá solicitar ayuda a los encargados del sistema.
          </div>

          <a href="#">
            <div
              class="mt-3 flex items-center text-sm font-semibold text-indigo-700"
            >
              <div>Revise la documentación</div>

              <div class="ml-1 text-indigo-500">
                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                  <path
                    fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="bg-white p-6 border-2 border-amber-200">
        <div class="flex items-center">
          <img
            class="h-10 max-w-full"
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4zOjf7MVh-H-6dJYS5_Caq0uhA8KhZHpZc-H4QLV63R9K0Is7afYYXqiSaNgQP_q9JRs&usqp=CAU"
          />
          <div class="ml-4 text-lg text-black leading-7 font-semibold">
            <a :href="route('profile.show')">Perfiles Personalizados</a>
          </div>
        </div>

        <div class="ml-12">
          <div class="mt-2 text-sm text-black text-justify">
            El sistema registra automáticamente un perfil único para cada
            usuario por lo que si es necesario puede cambiar su fotografía,
            contraseña, correo y otros datos que son necesarios para que el
            sistema registre correctamente su información.
          </div>

          <a :href="route('profile.show')">
            <div
              class="mt-3 flex items-center text-sm font-semibold text-indigo-700"
            >
              <div>Revise su perfil inicial</div>

              <div class="ml-1 text-indigo-500">
                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                  <path
                    fill-rule="evenodd"
                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";

export default defineComponent({
  components: {
    JetApplicationLogo,
  },
});
</script>
