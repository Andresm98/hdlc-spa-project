<template>
  <div class="bg-gray-100">
    <div class="p-6 sm:px-20 bg-blue-100 border-2 border-blue-200">
      <div>
        <jet-application-logo class="block h-12 w-auto" />
      </div>

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
    <br />
    <br />
    <div class="bg-opacity-25 grid grid-cols-1 md:grid-cols-2 ">
      <div class="bg-indigo-100 p-6 border-2 border-blue-200">
        <div class="flex items-center">
          <!-- <svg
            fill="none"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            viewBox="0 0 24 24"
            class="w-8 h-8 text-black"
          >
            <path
              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
            ></path>
          </svg> -->
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

      <div
        class="bg-amber-100 p-6 border-2 border-amber-200"
      >
        <div class="flex items-center">
          <!-- <svg
            fill="none"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            viewBox="0 0 24 24"
            class="w-8 h-8 text-black-400"
          >
            <path
              d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
            ></path>
            <path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg> -->
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
