<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Dashboard
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
      </div>
    </template>

    <main>
      <div class="flex flex-col md:flex-row">
        <section>

          <div
            id="main"
            class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5"
          >
            <div class="bg-gray-800 pt-3">
              <div
                class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white"
              >
                <h1 class="font-bold pl-2">
                  Datos Generales Gestión Secretaría
                </h1>
              </div>
            </div>
            <h1 class="m-6 font-bold uppercase">Datos Secretaría</h1>
            <div class="flex flex-wrap">
              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div
                  class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5"
                >
                  <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                      <div class="rounded-full p-5 bg-pink-600">
                        <i class="fas fa-users fa-2x fa-inverse"></i>
                      </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                      <h2 class="font-bold uppercase text-gray-600">
                        Número Total de Hermanas Activas
                      </h2>
                      <p class="font-bold text-3xl">
                        {{ acdaughters }}
                        <span class="text-pink-500"
                          ><i class="fas fa-exchange-alt"></i
                        ></span>
                      </p>
                    </div>
                  </div>
                </div>
                <!--/Metric Card-->
              </div>
              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div
                  class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5"
                >
                  <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                      <div class="rounded-full p-5 bg-green-600">
                        <i class="fa fa-wallet fa-2x fa-inverse"></i>
                      </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                      <h2 class="font-bold uppercase text-gray-600">
                        Número Total de Comunidades Abiertas
                      </h2>
                      <p class="font-bold text-3xl">
                        {{ communities }}
                        <span class="text-green-500"
                          ><i class="fas fa-caret-up"></i
                        ></span>
                      </p>
                    </div>
                  </div>
                </div>
                <!--/Metric Card-->
              </div>
              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div
                  class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-400 rounded-lg shadow-xl p-5"
                >
                  <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                      <div class="rounded-full p-5 bg-green-400">
                        <i class="fa fa-wallet fa-2x fa-inverse"></i>
                      </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                      <h2 class="font-bold uppercase text-gray-600">
                        Número Total de Comunidades Cerradas
                      </h2>
                      <p class="font-bold text-3xl">
                        {{ communitiesClosure }}
                        <span class="text-green-500"
                          ><i class="fas fa-caret-up"></i
                        ></span>
                      </p>
                    </div>
                  </div>
                </div>
                <!--/Metric Card-->
              </div>
              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div
                  class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5"
                >
                  <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                      <div class="rounded-full p-5 bg-pink-600">
                        <i class="fas fa-users fa-2x fa-inverse"></i>
                      </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                      <h2 class="font-bold uppercase text-gray-600">
                        Número Total de Obras Abiertas
                      </h2>
                      <p class="font-bold text-3xl">
                        {{ works }}
                        <span class="text-pink-500"
                          ><i class="fas fa-exchange-alt"></i
                        ></span>
                      </p>
                    </div>
                  </div>
                </div>
                <!--/Metric Card-->
              </div>
              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div
                  class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-400 rounded-lg shadow-xl p-5"
                >
                  <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                      <div class="rounded-full p-5 bg-pink-400">
                        <i class="fas fa-users fa-2x fa-inverse"></i>
                      </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                      <h2 class="font-bold uppercase text-gray-600">
                        Número Total de Obras Cerradas
                      </h2>
                      <p class="font-bold text-3xl">
                        {{ worksClosure }}
                        <span class="text-pink-500"
                          ><i class="fas fa-exchange-alt"></i
                        ></span>
                      </p>
                    </div>
                  </div>
                </div>
                <!--/Metric Card-->
              </div>
              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div
                  class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5"
                >
                  <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                      <div class="rounded-full p-5 bg-yellow-600">
                        <i class="fas fa-user-plus fa-2x fa-inverse"></i>
                      </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                      <h2 class="font-bold uppercase text-gray-600">
                        Número Total de Pastorales
                      </h2>
                      <p class="font-bold text-3xl">
                        {{ pastorals }}
                        <span class="text-yellow-600"
                          ><i class="fas fa-caret-up"></i
                        ></span>
                      </p>
                    </div>
                  </div>
                </div>
                <!--/Metric Card-->
              </div>

              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div
                  class="bg-gradient-to-b from-indigo-200 to-indigo-100 border-b-4 border-indigo-500 rounded-lg shadow-xl p-5"
                >
                  <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                      <div class="rounded-full p-5 bg-indigo-600">
                        <i class="fas fa-tasks fa-2x fa-inverse"></i>
                      </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                      <h2 class="font-bold uppercase text-gray-600">
                        Permisos Vigentes
                      </h2>
                      <p class="font-bold text-3xl">{{ activepermits }}</p>
                    </div>
                  </div>
                </div>
                <!--/Metric Card-->
              </div>
              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <div
                  class="bg-gradient-to-b from-red-200 to-red-100 border-b-4 border-red-500 rounded-lg shadow-xl p-5"
                >
                  <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                      <div class="rounded-full p-5 bg-red-600">
                        <i class="fas fa-inbox fa-2x fa-inverse"></i>
                      </div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                      <h2 class="font-bold uppercase text-gray-600">
                        Cambios Activos
                      </h2>
                      <p class="font-bold text-3xl">
                        {{ activechanges }}
                        <span class="text-red-500"
                          ><i class="fas fa-caret-up"></i
                        ></span>
                      </p>
                    </div>
                  </div>
                </div>
                <!--/Metric Card-->
              </div>
            </div>
          </div>


          <!--

                Block Hermanas
                Block Hermanas
                Block Hermanas
                Block Hermanas

            -->


          <hr class="mx-4" />
        </section>
      </div>
    </main>
  </app-layout>
</template>

<script>
import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    communities: Number,
    communitiesClosure: Number,
    works: Number,
    worksClosure: Number,
    pastorals: Number,
    daughters: Number,
    acdaughters: Number,
    dthdaughters: Number,
    rtrdaughters: Number,
    activepermits: Number,
    activechanges: Number,
  },

  data() {
    return {};
  },

  components: {
    AppLayout,
    Head,
  },

  setup() {},

  layout: PrincipalLayout,
});
</script>
