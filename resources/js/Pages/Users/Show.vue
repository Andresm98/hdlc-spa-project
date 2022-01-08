<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Usuarios
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
      </div>
    </template>
    <!-- component -->

    <section class="py-1 bg-blueGray-50">
      <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
        <div
          class="
            relative
            flex flex-col
            min-w-0
            break-words
            w-full
            mb-6
            shadow-lg
            rounded-lg
            bg-blueGray-100
            border-0
          "
        >
          <div class="rounded-t bg-white mb-0 px-6 py-6">
            <div class="text-center flex justify-between">
              <h6 class="text-blueGray-700 text-xl font-bold">Tarjeta de Hermana</h6>
              <button
                class="
                  bg-pink-500
                  text-white
                  active:bg-pink-600
                  font-bold
                  uppercase
                  text-xs
                  px-4
                  py-2
                  rounded
                  shadow
                  hover:shadow-md
                  outline-none
                  focus:outline-none
                  mr-1
                  ease-linear
                  transition-all
                  duration-150
                "
                type="button"
              >
                Configuraciones
              </button>
            </div>
          </div>
          <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
            <form>
              <h6
                class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase"
              >
                Información de la Hermana
              </h6>
              <div class="flex flex-wrap">
                <div class="w-full lg:w-6/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="
                        block
                        uppercase
                        text-blueGray-600 text-xs
                        font-bold
                        mb-2
                      "
                      htmlfor="grid-password"
                    >
                      Nombre de Usuario
                    </label>
                    <input
                      type="text"
                      class="
                        border-0
                        px-3
                        py-3
                        placeholder-blueGray-300
                        text-blueGray-600
                        bg-white
                        rounded
                        text-sm
                        shadow
                        focus:outline-none focus:ring
                        w-full
                        ease-linear
                        transition-all
                        duration-150
                      "
                      :value="userCustom.name"
                    />
                  </div>
                </div>
                <div class="w-full lg:w-6/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="
                        block
                        uppercase
                        text-blueGray-600 text-xs
                        font-bold
                        mb-2
                      "
                      htmlfor="grid-password"
                    >
                      Correo electrónico
                    </label>
                    <input
                      type="email"
                      class="
                        border-0
                        px-3
                        py-3
                        placeholder-blueGray-300
                        text-blueGray-600
                        bg-white
                        rounded
                        text-sm
                        shadow
                        focus:outline-none focus:ring
                        w-full
                        ease-linear
                        transition-all
                        duration-150
                      "
                      :value="userCustom.email"
                    />
                  </div>
                </div>
                <div class="w-full lg:w-6/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="
                        block
                        uppercase
                        text-blueGray-600 text-xs
                        font-bold
                        mb-2
                      "
                      htmlfor="grid-password"
                    >
                      First Name
                    </label>
                    <input
                      type="text"
                      class="
                        border-0
                        px-3
                        py-3
                        placeholder-blueGray-300
                        text-blueGray-600
                        bg-white
                        rounded
                        text-sm
                        shadow
                        focus:outline-none focus:ring
                        w-full
                        ease-linear
                        transition-all
                        duration-150
                      "
                      value="Lucky"
                    />
                  </div>
                </div>
                <div class="w-full lg:w-6/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="
                        block
                        uppercase
                        text-blueGray-600 text-xs
                        font-bold
                        mb-2
                      "
                      htmlfor="grid-password"
                    >
                      Last Name
                    </label>
                    <input
                      type="text"
                      class="
                        border-0
                        px-3
                        py-3
                        placeholder-blueGray-300
                        text-blueGray-600
                        bg-white
                        rounded
                        text-sm
                        shadow
                        focus:outline-none focus:ring
                        w-full
                        ease-linear
                        transition-all
                        duration-150
                      "
                      value="Jesse"
                    />
                  </div>
                </div>
              </div>

              <hr class="mt-6 border-b-1 border-blueGray-300" />

              <h6
                class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase"
              >
                Contact Information
              </h6>
              <div class="flex flex-wrap">
                <div class="w-full lg:w-12/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="
                        block
                        uppercase
                        text-blueGray-600 text-xs
                        font-bold
                        mb-2
                      "
                      htmlfor="grid-password"
                    >
                      Address
                    </label>
                    <input
                      type="text"
                      class="
                        border-0
                        px-3
                        py-3
                        placeholder-blueGray-300
                        text-blueGray-600
                        bg-white
                        rounded
                        text-sm
                        shadow
                        focus:outline-none focus:ring
                        w-full
                        ease-linear
                        transition-all
                        duration-150
                      "
                      value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09"
                    />
                  </div>
                </div>
                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="
                        block
                        uppercase
                        text-blueGray-600 text-xs
                        font-bold
                        mb-2
                      "
                      htmlfor="grid-password"
                    >
                      City
                    </label>
                    <input
                      type="email"
                      class="
                        border-0
                        px-3
                        py-3
                        placeholder-blueGray-300
                        text-blueGray-600
                        bg-white
                        rounded
                        text-sm
                        shadow
                        focus:outline-none focus:ring
                        w-full
                        ease-linear
                        transition-all
                        duration-150
                      "
                      value="New York"
                    />
                  </div>
                </div>
                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="
                        block
                        uppercase
                        text-blueGray-600 text-xs
                        font-bold
                        mb-2
                      "
                      htmlfor="grid-password"
                    >
                      Country
                    </label>
                    <input
                      type="text"
                      class="
                        border-0
                        px-3
                        py-3
                        placeholder-blueGray-300
                        text-blueGray-600
                        bg-white
                        rounded
                        text-sm
                        shadow
                        focus:outline-none focus:ring
                        w-full
                        ease-linear
                        transition-all
                        duration-150
                      "
                      value="United States"
                    />
                  </div>
                </div>
                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="
                        block
                        uppercase
                        text-blueGray-600 text-xs
                        font-bold
                        mb-2
                      "
                      htmlfor="grid-password"
                    >
                      Postal Code
                    </label>
                    <input
                      type="text"
                      class="
                        border-0
                        px-3
                        py-3
                        placeholder-blueGray-300
                        text-blueGray-600
                        bg-white
                        rounded
                        text-sm
                        shadow
                        focus:outline-none focus:ring
                        w-full
                        ease-linear
                        transition-all
                        duration-150
                      "
                      value="Postal Code"
                    />
                  </div>
                </div>
              </div>

              <hr class="mt-6 border-b-1 border-blueGray-300" />


            </form>
          </div>
        </div>

      </div>
    </section>
  </app-layout>
</template>




<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination";

export default defineComponent({
  props: [ "userCustom"],

  components: {
    AppLayout,
    Link,
    Pagination,
  },

  data() {
    return {
      form: this.$inertia.form(),
    };
  },
});
</script>
