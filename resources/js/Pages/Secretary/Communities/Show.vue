<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Editar Comunidades
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
      </div>
    </template>
    <alert
      v-if="$page.props.flash.success"
      class="alert"
      :type_alert_r="(type_alert = 'success')"
      :message="$page.props.flash.success"
    >
    </alert>
    <section
      class="bg-gray-200 dark:bg-slate-800 y-1 px-4 sm:p-6 md:py-10 md:px-8 pt-2 pb-4 rounded-lg m-1"
    >
      <div
        class="max-w-4xl mx-auto grid grid-cols-1 lg:max-w-5xl lg:gap-x-20 lg:grid-cols-2"
      >
        <div
          class="relative p-3 col-start-1 row-start-1 flex flex-col-reverse rounded-lg bg-gradient-to-t from-black/75 via-black/0 sm:bg-none sm:row-start-2 sm:p-0 lg:row-start-1"
        >
          <h1
            class="mt-1 text-lg font-semibold text-black sm:text-black md:text-2xl dark:sm:text-white"
          >
            Provincia Ecuador
          </h1>
          <p
            class="text-sm leading-4 font-medium text-black sm:text-black dark:sm:text-slate-400"
          >
            Información General de la Comunidad
          </p>
        </div>
        <div
          class="grid gap-4 col-start-1 col-end-3 row-start-1 sm:mb-6 sm:grid-cols-4 lg:gap-6 lg:col-start-2 lg:row-end-6 lg:row-span-6 lg:mb-0"
        >
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_2.png"
            alt=""
            class="w-full h-60 object-cover rounded-lg sm:h-52 sm:col-span-2 lg:col-span-full"
            loading="lazy"
          />
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_3.png"
            alt=""
            class="hidden w-full h-52 object-cover rounded-lg sm:block sm:col-span-2 md:col-span-1 lg:row-start-2 lg:col-span-2 lg:h-32"
            loading="lazy"
          />
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_1.png"
            alt=""
            class="hidden w-full h-52 object-cover rounded-lg md:block lg:row-start-2 lg:col-span-2 lg:h-32"
            loading="lazy"
          />
        </div>
        <dl
          class="mt-4 text-xs font-medium flex items-center row-start-2 sm:mt-1 sm:row-start-3 md:mt-2.5 lg:row-start-2"
        >
          <dt class="sr-only">Visto</dt>
          <dd class="text-indigo-600 flex items-center dark:text-indigo-400">
            <svg
              width="24"
              height="24"
              fill="none"
              aria-hidden="true"
              class="mr-1 stroke-current dark:stroke-blue-100"
            >
              <path
                d="m12 5 2 5h5l-4 4 2.103 5L12 16l-5.103 3L9 14l-4-4h5l2-5Z"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <span
              >0.00 <span class="text-slate-400 font-normal">(0)</span></span
            >
          </dd>
          <dt class="sr-only">Ubicación por defecto - Ecuador</dt>
          <dd class="flex items-center">
            <svg
              width="2"
              height="2"
              aria-hidden="true"
              fill="currentColor"
              class="mx-3 text-white"
            >
              <circle cx="1" cy="1" r="1" />
            </svg>
            <svg
              width="24"
              height="24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="mr-1 text-black dark:text-white"
              aria-hidden="true"
            >
              <path
                d="M18 11.034C18 14.897 12 19 12 19s-6-4.103-6-7.966C6 7.655 8.819 5 12 5s6 2.655 6 6.034Z"
              />
              <path d="M14 11a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
            </svg>
            <p class="text-black dark:text-white">Quito, Ecuador</p>
          </dd>
        </dl>
        <div
          class="mt-4 col-start-1 row-start-3 self-center sm:mt-0 sm:col-start-2 sm:row-start-2 sm:row-span-2 lg:mt-6 lg:col-start-1 lg:row-start-3 lg:row-end-4"
        >
          <button
            type="button"
            class="bg-blue-600 text-white text-sm leading-6 font-medium py-2 px-3 rounded-lg"
          >
            <!--
                        FIXME: Import Controllers For PDF-->
            Plantilla PDF
          </button>
          <div
            class="mt-4 text-sm leading-6 col-start-1 sm:col-span-2 lg:mt-6 lg:row-start-4 lg:col-span-1 text-black dark:text-white"
          >
            <p>
              La presente plantiflla de información se relaciona con los datos
              principales de la comunidad a la que desea modificar al sistema,
              por lo que deberá verificar los datos a ingresar.
            </p>
            <ul class="list-disc pl-5">
              <li class="dark:text-white">
                <p class="mt-2 pt-6 text-sm uppercase">
                  Nombre de comunidad único en el sistema.
                </p>
              </li>
              <li class="dark:text-white">
                <p class="text-sm uppercase dark:text-white">
                  Correo electrónico único en el sistema.
                </p>
              </li>
              <li class="dark:text-white">
                <p class="text-sm uppercase dark:text-white">
                  Números de contacto.
                </p>
              </li>
              <li class="dark:text-white">
                <p class="text-sm uppercase dark:text-white">
                  Fechas de fundación de la obra y comunidad.
                </p>
              </li>
              <li class="dark:text-white">
                <p class="text-sm uppercase dark:text-white">
                  Número de colaboradores.
                </p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="py-1 bg-slate-800 rounded-lg m-1">
      <div class="w-full lg:w-5/6 px-4 mx-auto mt-6">
        <div
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
        >
          <div class="bg-neutral-100 hover:bg-gray-100 rounded-lg">
            <form @submit.prevent="submit" class="">
              <div class="rounded-t bg-white mb-0 px-6 py-6">
                <div class="text-center flex justify-between">
                  <h6 class="text-lg font-medium leading-6 text-gray-900">
                    Tarjeta de Información General de la Comunidad
                  </h6>
                  <button
                    class="bg-blue-500 hover:bg-blue-700 text-white active:bg-blue-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                    type="submit"
                  >
                    Guardar Tarjeta
                  </button>
                </div>
              </div>
              <hr />
              <h6
                class="mt-2 text-lg font-medium text-center leading-6 text-gray-900"
              >
                Información General
              </h6>
              <div class="flex flex-wrap">
                <div class="w-full lg:w-3/3 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Nombre de Comunidad:
                    </label>
                    <jet-input-error :message="errors.comm_name" />
                    <input
                      type="text"
                      placeholder="Nombre de la comunidad en el Sistema"
                      class="border-0 px-3 placeholder-blueGray-300 text-black bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      @keydown.space.prevent
                      v-model="form.comm_name"
                    />
                  </div>
                </div>
              </div>

              <div class="flex flex-wrap">
                <div class="w-full lg:w-6/12 px-4">
                  <label
                    class="block text-sm font-medium text-gray-700"
                    htmlfor="grid-password"
                  >
                    Correo Electrónico:
                  </label>

                  <jet-input-error :message="errors.comm_email" />
                  <input
                    type="email"
                    placeholder="micorreo@correo.com"
                    class="border-0 px-3 mb-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="form.comm_email"
                  />
                </div>
                <div class="w-full lg:w-6/12 px-4">
                  <label
                    class="block text-sm font-medium text-gray-700"
                    htmlfor="grid-password"
                  >
                    Número de RUC:
                  </label>
                  <p
                    class="text-red-400 text-sm"
                    v-show="
                      !validateIdentityCard ||
                      this.form.comm_identity_card == ''
                    "
                  >
                    Ingresar RUC válido
                  </p>
                  <jet-input-error :message="errors.comm_identity_card" />
                  <input
                    type="text"
                    minLength="10"
                    maxlength="13"
                    placeholder="0102211274 ó 0102211274001"
                    pattern="[+-]?\d+(?:[.,]\d+)?"
                    class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    v-model="form.comm_identity_card"
                    required
                  />
                </div>
              </div>
              <div class="flex flex-wrap">
                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Fecha de Fundación:
                    </label>

                    <jet-input-error :message="errors.date_fndt_comm" />
                    <Datepicker
                      v-model="form.date_fndt_comm"
                      :format="format"
                      autoApply
                      required
                      :year-range="[1800, this.year]"
                    />
                  </div>
                </div>

                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Fecha de la Obra:
                    </label>

                    <jet-input-error :message="errors.date_fndt_work" />
                    <Datepicker
                      v-model="form.date_fndt_work"
                      :format="format"
                      autoApply
                      :year-range="[1800, this.year]"
                    />
                  </div>
                </div>

                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Celular:
                    </label>

                    <jet-input-error :message="errors.comm_cellphone" />
                    <input
                      minLength="10"
                      maxlength="20"
                      pattern="[0-9]+"
                      placeholder="123-4567-890"
                      type="text"
                      class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      v-model="form.comm_cellphone"
                    />
                  </div>
                </div>

                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Teléfono
                    </label>

                    <jet-input-error :message="errors.comm_phone" />
                    <input
                      minLength="8"
                      maxlength="20"
                      pattern="[0-9]+"
                      placeholder="123-4567-890"
                      type="text"
                      class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      v-model="form.comm_phone"
                    />
                  </div>
                </div>

                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Número de Colaboradores
                    </label>

                    <jet-input-error :message="errors.rn_collaborators" />
                    <input
                      minLength="0"
                      maxlength="2000"
                      pattern="[0-9]+"
                      placeholder="Nro. de Colaboradores"
                      type="number"
                      class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      v-model="form.rn_collaborators"
                      required
                    />
                  </div>
                </div>

                <!-- Information Address -->
                <hr
                  class="mt-1 mb-3 ml-4 mr-4 border-b-1 border-blueGray-300 hover:border-blueGray-100"
                />
                <div class="w-full lg:w-full px-4">
                  <div>
                    <label
                      for="address"
                      class="block text-sm font-medium text-gray-700"
                    >
                      Dirección Actual
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.address"
                    >
                      {{ $page.props.errors.address }}
                    </p>
                    <div class="mb-1">
                      <textarea
                        id="address"
                        name="address"
                        rows="1"
                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 mb-2 block w-full sm:text-sm border border-gray-300 rounded-md"
                        v-model="form.address"
                        placeholder="Agregar la dirección actual.."
                        :maxlength="100"
                        required
                      />
                    </div>
                  </div>
                </div>

                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Provincia
                    </label>
                    <div :class="{ invalid: isInvalidProvince }">
                      <multiselect
                        :searchable="true"
                        v-model="selectOne.selectedProvince"
                        :options="this.allProvinces"
                        :close-on-select="true"
                        :clear-on-select="false"
                        mode="tags"
                        label="name"
                        @search-change="onSearchProvincesChange"
                        @select="onSelectedProvince"
                        track-by="name"
                        placeholder="Buscar provincia"
                      >
                      </multiselect>
                      <p
                        class="text-red-400 text-sm"
                        v-show="isInvalidProvince"
                      >
                        Obligatorio
                      </p>
                    </div>
                  </div>
                </div>
                <div class="w-full lg:w-8/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Cantón
                    </label>
                    <div :class="{ invalid: isInvalidCanton }">
                      <multiselect
                        :searchable="true"
                        v-model="selectTwo.selectedCanton"
                        :options="selectTwo.options"
                        :close-on-select="true"
                        :clear-on-select="false"
                        mode="tags"
                        label="name"
                        @select="onSelectedCanton"
                        @search-change="onSearchCantonChange"
                        track-by="name"
                        placeholder="Buscar cantón"
                      >
                      </multiselect>
                      <p class="text-sm text-red-400" v-show="isInvalidCanton">
                        Obligatorio
                      </p>
                    </div>
                  </div>
                </div>

                <div class="w-full lg:w-12/12 px-4 mb-2">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Parroquia
                    </label>
                    <div :class="{ invalid: isInvalidParish }">
                      <multiselect
                        :searchable="true"
                        v-model="selectThree.selectedParish"
                        :options="selectThree.options"
                        :close-on-select="true"
                        :clear-on-select="false"
                        label="name"
                        @select="onSelectedParish"
                        @search-change="onSearchParishChange"
                        track-by="name"
                        placeholder="Buscar parroquia"
                      >
                      </multiselect>
                      <p class="text-sm text-red-400" v-show="isInvalidParish">
                        Obligatorio
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <hr
              class="mt-1 mb-3 ml-4 mr-4 border-b-1 border-blueGray-300 hover:border-blueGray-100"
            />
          </div>
        </div>
      </div>
    </section>
  </app-layout>
</template>
<script>

import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import { mapState, mapActions, mapGetters } from "vuex";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import JetInputError from "@/Jetstream/InputError";
import Datepicker from "vue3-date-time-picker";
import JetCheckbox from "@/Jetstream/Checkbox";
import { Inertia } from "@inertiajs/inertia";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import Alert from "@/Components/Alert";
import { defineComponent } from "vue";
import moment from "moment";
import { ref } from "vue";

export default {
  setup() {
    const year = new Date().getFullYear();

    return {
      year,
    };
  },
};
</script>
