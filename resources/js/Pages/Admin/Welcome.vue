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
                class="
                  rounded-tl-3xl
                  bg-gradient-to-r
                  from-blue-900
                  to-gray-800
                  p-4
                  shadow
                  text-2xl text-white
                "
              >
                <h1 class="font-bold pl-2">
                  Datos Generales del Panel Administrador
                </h1>
              </div>
            </div>

            <div class="flex flex-wrap cursor-pointer">
              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <a href="/system/admin/users/all">
                  <div
                    class="
                      bg-gradient-to-b
                      from-green-200
                      to-green-100
                      border-b-4 border-green-600
                      rounded-lg
                      shadow-xl
                      p-5
                    "
                  >
                    <div class="flex flex-row items-center">
                      <div class="flex-shrink pr-4">
                        <div class="rounded-full p-5 bg-green-600">
                          <i class="fa fa-wallet fa-2x fa-inverse"></i>
                        </div>
                      </div>
                      <div class="flex-1 text-right md:text-center">
                        <h2 class="font-bold uppercase text-gray-600">
                          Número Total de Usuarios
                        </h2>
                        <p class="font-bold text-3xl">
                          {{ users }}
                          <span class="text-green-500"
                            ><i class="fas fa-caret-up"></i
                          ></span>
                        </p>
                      </div>
                    </div>
                  </div>
                </a>
                <!--/Metric Card-->
              </div>
              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <a :href="route('admin.roles.index')">
                  <div
                    class="
                      bg-gradient-to-b
                      from-pink-200
                      to-pink-100
                      border-b-4 border-pink-500
                      rounded-lg
                      shadow-xl
                      p-5
                    "
                  >
                    <div class="flex flex-row items-center">
                      <div class="flex-shrink pr-4">
                        <div class="rounded-full p-5 bg-pink-600">
                          <i class="fas fa-users fa-2x fa-inverse"></i>
                        </div>
                      </div>
                      <div class="flex-1 text-right md:text-center">
                        <h2 class="font-bold uppercase text-gray-600">
                          Número Total de Roles
                        </h2>
                        <p class="font-bold text-3xl">
                          {{ roles }}
                          <span class="text-pink-500"
                            ><i class="fas fa-exchange-alt"></i
                          ></span>
                        </p>
                      </div>
                    </div>
                  </div>
                </a>
                <!--/Metric Card-->
              </div>
              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <a :href="route('admin.roles.index')">
                  <div
                    class="
                      bg-gradient-to-b
                      from-yellow-200
                      to-yellow-100
                      border-b-4 border-yellow-600
                      rounded-lg
                      shadow-xl
                      p-5
                    "
                  >
                    <div class="flex flex-row items-center">
                      <div class="flex-shrink pr-4">
                        <div class="rounded-full p-5 bg-yellow-600">
                          <i class="fas fa-user-plus fa-2x fa-inverse"></i>
                        </div>
                      </div>
                      <div class="flex-1 text-right md:text-center">
                        <h2 class="font-bold uppercase text-gray-600">
                          Número Total de Permisos del Sistema
                        </h2>
                        <p class="font-bold text-3xl">
                          {{ permissions }}
                          <span class="text-yellow-600"
                            ><i class="fas fa-caret-up"></i
                          ></span>
                        </p>
                      </div>
                    </div>
                  </div>
                </a>
                <!--/Metric Card-->
              </div>
              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <a :href="route('admin.pastoral.index')">
                  <div
                    class="
                      bg-gradient-to-b
                      from-blue-200
                      to-blue-100
                      border-b-4 border-blue-500
                      rounded-lg
                      shadow-xl
                      p-5
                    "
                  >
                    <div class="flex flex-row items-center">
                      <div class="flex-shrink pr-4">
                        <div class="rounded-full p-5 bg-blue-600">
                          <i class="fas fa-server fa-2x fa-inverse"></i>
                        </div>
                      </div>
                      <div class="flex-1 text-right md:text-center">
                        <h2 class="font-bold uppercase text-gray-600">
                          Pastorales
                        </h2>
                        <p class="font-bold text-3xl">{{ pastorals }}</p>
                      </div>
                    </div>
                  </div>
                </a>
                <!--/Metric Card-->
              </div>
              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <a :href="route('admin.appointmentlevel.index')">
                  <div
                    class="
                      bg-gradient-to-b
                      from-indigo-200
                      to-indigo-100
                      border-b-4 border-indigo-500
                      rounded-lg
                      shadow-xl
                      p-5
                    "
                  >
                    <div class="flex flex-row items-center">
                      <div class="flex-shrink pr-4">
                        <div class="rounded-full p-5 bg-indigo-600">
                          <i class="fas fa-tasks fa-2x fa-inverse"></i>
                        </div>
                      </div>
                      <div class="flex-1 text-right md:text-center">
                        <h2 class="font-bold uppercase text-gray-600">
                          Niveles de Nombramientos
                        </h2>
                        <p class="font-bold text-3xl">{{ appointments }}</p>
                      </div>
                    </div>
                  </div>
                </a>

                <!--/Metric Card-->
              </div>
              <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                <!--Metric Card-->
                <a :href="route('admin.zone.index')">
                  <div
                    class="
                      bg-gradient-to-b
                      from-red-200
                      to-red-100
                      border-b-4 border-red-500
                      rounded-lg
                      shadow-xl
                      p-5
                    "
                  >
                    <div class="flex flex-row items-center">
                      <div class="flex-shrink pr-4">
                        <div class="rounded-full p-5 bg-red-600">
                          <i class="fas fa-inbox fa-2x fa-inverse"></i>
                        </div>
                      </div>
                      <div class="flex-1 text-right md:text-center">
                        <h2 class="font-bold uppercase text-gray-600">Zonas</h2>
                        <p class="font-bold text-3xl">
                          {{ zones }}
                          <span class="text-red-500"
                            ><i class="fas fa-caret-up"></i
                          ></span>
                        </p>
                      </div>
                    </div></div
                ></a>

                <!--/Metric Card-->
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayoutAdmin.vue";
import { Head } from "@inertiajs/inertia-vue3";
import PrincipalLayout from "@/Components/Admin/PrincipalLayout";

export default defineComponent({
  layout: PrincipalLayout,

  props: {
    users: Number,
    roles: Number,
    pastorals: Number,
    permissions: Number,
    appointments: Number,
    zones: Number,
  },

  components: {
    Head,
    AppLayout,
  },
});
</script>
