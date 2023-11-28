<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Listado de las Vehículos
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
      </div>
    </template>

    <div v-if="$page.props.flash != null">
      <alert
        v-if="$page.props.flash.success"
        class="alert"
        :type_alert_r="(type_alert = 'success')"
        :message="$page.props.flash.success"
      >
      </alert>
      <alert
        v-if="$page.props.flash.error"
        class="alert"
        :type_alert_r="(type_alert = 'error')"
        :message="$page.props.flash.error"
      >
      </alert>
    </div>
    <operation></operation>
    <section
      class="bg-gray-200 dark:bg-slate-800 y-1 px-4 sm:p-6 md:py-10 md:px-8 pt-2 pb-4 rounded-lg sm:m-2 lg:m-3 md:m-4"
    >
      <div
        class="max-w-4xl mx-auto grid grid-cols-1 lg:max-w-5xl lg:gap-x-20 lg:grid-cols-2"
      >
        <div
          class="relative p-3 col-start-1 row-start-1 flex flex-col-reverse rounded-lg bg-gradient-to-t from-black/75 via-black/0 sm:bg-none sm:row-start-2 sm:p-0 md:bg-none md:row-start-2 md:p-0 lg:row-start-1"
        >
          <h1
            class="mt-1 text-lg font-semibold text-black sm:text-black md:text-2xl dark:sm:text-white"
          >
            {{ communities.comm_name }}
          </h1>
          <p
            class="text-sm leading-4 font-medium text-black sm:text-black dark:sm:text-slate-400"
          >
            Información General de los vehículos.
          </p>
        </div>
        <div
          class="grid gap-4 col-start-1 col-end-3 row-start-1 sm:mb-6 sm:grid-cols-4 md:mb-6 md:grid-cols-4 lg:gap-6 lg:col-start-2 lg:row-end-6 lg:row-span-6 lg:mb-0"
        >
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_2.png"
            alt=""
            class="w-full h-60 object-cover rounded-lg sm:h-52 sm:col-span-2 md:h-52 md:col-span-2 lg:col-span-full"
            loading="lazy"
          />
        </div>
        <dl
          class="mt-4 text-xs font-medium flex items-center row-start-2 sm:mt-1 sm:row-start-3 md:mt-1 md:row-start-3 lg:row-start-2"
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
      </div>
      <div class="mt-2">
        <p class="text-black dark:text-white">
          La presente plantilla de información se relaciona a todos las
          vehículos que pertenecen a todas las comunidades u obras de la
          compañía.
        </p>
      </div>
      <div class="content-center mt-2">
        <jet-button-success
          @click="confirmationVisitCreate()"
          class="block mx-5 leading-normal"
          >¿Desea crear un nuevo vehículo?</jet-button-success
        >
      </div>
    </section>
    <section class="py-1 bg-gray">
      <div class="w-full lg:w-full">
        <div
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
        >
          <div
            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
          >
            <div class="container mx-auto ml-7">
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div
                  class="justify-center text-sm border-1 border-gray-300 rounded-sm bg-gray-100"
                >
                  <small class="justify-content-center ml-20 uppercase"
                    >Filtros de Búsqueda</small
                  >
                  <search-filter
                    v-model="params.search"
                    class="border border-blue-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    @reset="reset"
                  >
                  </search-filter>
                </div>
                <div
                  class="justify-center text-sm border-1 border-gray-300 rounded-sm p-1 bg-gray-100"
                >
                  <small class="justify-content-center ml-20 uppercase"
                    >Rangos de Años de Vehículo</small
                  >
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.dateStart"
                  >
                    {{ $page.props.errors.dateStart }}
                  </p>
                  <Datepicker
                    v-model="params.dateStart"
                    :format="format"
                    autoApply
                    required
                    :year-range="[1800, this.year]"
                  />
                  <small class="justify-content-center ml-6"
                    >Deste - Hasta</small
                  >
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.dateEnd"
                  >
                    {{ $page.props.errors.dateEnd }}
                  </p>
                  <Datepicker
                    v-model="params.dateEnd"
                    :format="format"
                    autoApply
                    required
                    :year-range="[1800, this.year]"
                  />
                </div>
                <div
                  class="justify-center text-sm border-1 border-gray-300 rounded-sm p-1 bg-gray-100"
                >
                  <small class="justify-content-center ml-20 uppercase"
                    >Exportar Listas</small
                  >
                  <div
                    class="md:text-md flex items-center justify-between p-4 w-full text-sm md:px-12 md:py-0"
                  >
                    <dropdown class="mt-1" placement="bottom-end">
                      <template #default>
                        <div
                          class="group flex items-center cursor-pointer select-none"
                        >
                          <div
                            class="mr-1 text-gray-700 group-hover:text-blue-600 focus:text-blue-600 whitespace-nowrap"
                          >
                            <span
                              class="px-1 inline-flex text-xs leading-5 font-semibold rounded-sm bg-gray-200 text-gray-800"
                              >&nbsp;Filtros</span
                            >
                          </div>
                          <icon
                            class="w-5 h-5 fill-gray-700 group-hover:fill-blue-600 focus:fill-blue-600"
                            name="cheveron-down"
                          />
                        </div>
                      </template>
                      <template #dropdown>
                        <div
                          class="mt-2 py-2 text-sm bg-white rounded shadow-xl"
                        >
                          <a
                            class="block px-6 py-2 hover:text-white hover:bg-blue-500"
                            target="_blank"
                            :href="
                              route(
                                'daughter.vehicles.communities.export.excel',
                                this.params
                              )
                            "
                            >Excel</a
                          >
                        </div>
                      </template>
                    </dropdown>
                  </div>
                </div>
              </div>
              <section class="pl-4">
                <pagination class="mt-6 mb-5" :links="visits.links" />
              </section>
              <small class="ml-6">
                Se encontraron {{ visits.total }} visitas.</small
              >
              <div class="py-2">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
                  <div
                    class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                  >
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-blue-100">
                        <tr>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Marca Vehículo / Comunidad u Obra
                          </th>
                          <th
                            scope="col"
                            class="text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Descriptores
                          </th>
                          <th
                            scope="col"
                            class="text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Año Vehículo
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Acciones
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="visit in this.visits.data" :key="visit">
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="ml-4 w-full...">
                              <span
                                class="whitespace-normal text-sm font-semibold"
                              >
                                <div v-if="visit.community != null">
                                  <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-sm bg-green-100 text-green-800"
                                  >
                                    {{ visit.community.comm_name }}
                                  </span>
                                </div>
                              </span>
                              <span
                                class="whitespace-normal text-sm font-semibold text-gray-900"
                              >
                                <p v-html="visit.brand"></p>
                              </span>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="ml-4 w-full...">
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                              >
                                Tipo: {{ visit.type }} </span
                              ><br />
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800"
                              >
                                Color: {{ visit.color }} </span
                              ><br />
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800"
                              >
                                Placa: {{ visit.plaque }}
                              </span>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span
                              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800"
                            >
                              {{ this.formatDateShow(visit.year) }}
                            </span>
                          </td>

                          <td
                            class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium"
                          >
                            <!-- Components -->
                            <div class="mx-auto flex gap-10">
                              <button @click="confirmationVisitUpdate(visit)">
                                <div class="w-auto h-auto">
                                  <div class="flex-1 h-full">
                                    <div
                                      class="flex items-center justify-center flex-1 h-full p-2 border border-green-500 text-white shadow rounded-lg hover:bg-green-50 hover:text-zinc-300"
                                    >
                                      <div class="relative">
                                        <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          class="h-5 w-5 text-green-500"
                                          viewBox="0 0 20 20"
                                          fill="currentColor"
                                        >
                                          <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                          />
                                        </svg>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </button>
                              <button @click="confirmationVisitDelete(visit)">
                                <div class="w-auto h-auto">
                                  <div class="flex-1 h-full">
                                    <div
                                      class="flex items-center justify-center flex-1 h-full p-2 border border-red-500 text-white shadow rounded-lg hover:bg-red-50 hover:text-zinc-300"
                                    >
                                      <div class="relative">
                                        <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          class="h-5 w-5 text-red-500"
                                          viewBox="0 0 20 20"
                                          fill="currentColor"
                                        >
                                          <path
                                            d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"
                                          ></path>
                                        </svg>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </button>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <section class="pl-4">
                <pagination class="mt-6 mb-5" :links="visits.links" />
              </section>
            </div>
          </div>
        </div>
      </div>
    </section>

    <jet-dialog-modal
      :max-width="'input-md'"
      :show="visitBeingCreated"
      @close="visitBeingCreated == null"
    >
      <template #title>
        Datos del nuevo Vehículo perteneciente a
        {{ communities.comm_name }}</template
      >
      <template #content>
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Marca:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.brand"
                >
                  {{ $page.props.errors.brand }}
                </p>
                <small>Formato: Marca del Vehículo.</small>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre del resumen"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.brand"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Tipo:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.type"
                >
                  {{ $page.props.errors.type }}
                </p>
                <small>Formato: Tipo de Vehículo.</small>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre del resumen"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.type"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Color:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.color"
                >
                  {{ $page.props.errors.color }}
                </p>
                <small>Formato: Color de Vehículo.</small>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre del resumen"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.color"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Placa:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.plaque"
                >
                  {{ $page.props.errors.plaque }}
                </p>
                <small>Formato: Placa de Vehículo.</small>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre del resumen"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.plaque"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Año:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.year">
                {{ $page.props.errors.year }}
              </p>
              <small>Formato: Fecha del resumen anual.</small>
              <Datepicker
                :format="format"
                autoApply
                v-model="form.year"
                :year-range="[1800, this.year]"
              />
            </div>
          </div>
        </div>
      </template>
      <template #footer>
        <jet-secondary-button @click="createActivityCancel">
          Cancelar
        </jet-secondary-button>

        <jet-button-success class="ml-3" @click="createActivity">
          Crear
        </jet-button-success>
      </template>
    </jet-dialog-modal>

    <jet-dialog-modal
      :max-width="'input-md'"
      :show="visitBeingUpdated"
      @close="visitBeingUpdated == null"
    >
      <template #title>
        Datos de Registro del Vehículo
        <span
          class="px-2 inline-flex text-base leading-5 font-semibold rounded-sm bg-blue-100 text-blue-800"
        >
          {{ visitBeingUpdated.community.comm_name }} </span
        >.
      </template>
      <template #content>
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Marca:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.brand"
                >
                  {{ $page.props.errors.brand }}
                </p>
                <small>Formato: Marca del Vehículo.</small>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre del vehículo"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="updateVisitForm.brand"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Tipo:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.type"
                >
                  {{ $page.props.errors.type }}
                </p>
                <small>Formato: Tipo de Vehículo.</small>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar el tipo de Vehículo"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="updateVisitForm.type"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Color:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.color"
                >
                  {{ $page.props.errors.color }}
                </p>
                <small>Formato: Color de Vehículo.</small>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar color del Vehículo"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="updateVisitForm.color"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Placa:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.plaque"
                >
                  {{ $page.props.errors.plaque }}
                </p>
                <small>Formato: Placa de Vehículo.</small>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar la placa del Vehículo"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="updateVisitForm.plaque"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Año:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.year">
                {{ $page.props.errors.year }}
              </p>
              <small>Formato: Año del Vehículo.</small>
              <Datepicker
                :format="format"
                autoApply
                v-model="updateVisitForm.year"
                :year-range="[1800, this.year]"
              />
            </div>
          </div>
        </div>
      </template>
      <template #footer>
        <jet-secondary-button @click="updateVisitCancel">
          Cancelar
        </jet-secondary-button>
        <jet-button-success class="ml-3" @click="updateVisit">
          Actualizar
        </jet-button-success>
      </template>
    </jet-dialog-modal>

    <jet-confirmation-modal
      :show="visitBeingDeleted"
      @close="visitBeingDeleted == null"
    >
      <template #title> Eliminar el vehículo</template>

      <template #content>
        ¿Está seguro de que desea eliminar el vehículo:
        {{ this.deleteVisitForm.brand }}?
      </template>

      <template #footer>
        <jet-secondary-button @click="visitBeingDeleted = null">
          Cancelar
        </jet-secondary-button>

        <jet-danger-button class="ml-3" @click="deleteVisit">
          Eliminar
        </jet-danger-button>
      </template>
    </jet-confirmation-modal>
  </app-layout>
</template>
<script>
import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import Operation from "@/Components/Daughter/Operation";
import { mapState, mapActions, mapGetters } from "vuex";
import JetInputError from "@/Jetstream/InputError.vue";
import SearchFilter from "@/Components/SearchFilter";
import { pickBy, throttle, mapValues } from "lodash";
import Pagination from "@/Components/Pagination";
import JetButton from "@/Jetstream/Button.vue";
import Datepicker from "vue3-date-time-picker";
import TextInput from "@/Components/TextInput";
import { Inertia } from "@inertiajs/inertia";
import JetInput from "@/Jetstream/Input.vue";
import Dropdown from "@/Components/Dropdown";
import Alert from "@/Components/Alert";
import Icon from "@/Components/Icon";
import { range } from "moment-range";
import moment from "moment";
import { ref } from "vue";

export default {
  layout: PrincipalLayout,

  props: {
    visits: Object,
    communities: Object,
    filters: Object,
  },

  setup() {
    const date = ref(new Date());
    const year = new Date().getFullYear();
    var format = (date) => {
      const format = "YYYY-MM-DD";
      return moment(date).format(format);
    };
    return {
      date,
      year,
      format,
    };
  },

  components: {
    JetButton,
    AppLayout,
    moment,
    range,
    JetDialogModal,
    JetDangerButton,
    JetInput,
    JetInputError,
    JetButtonSuccess,
    JetSecondaryButton,
    TextInput,
    Alert,
    SearchFilter,
    Datepicker,
    Icon,
    Dropdown,
    Operation,
    Pagination,
    JetConfirmationModal,
  },

  mounted() {
    this.allAppointmentLevel;
  },

  data() {
    return {
      toolbarOptions: [
        ["bold", "italic", "underline", "strike"], // toggled buttons
        ["blockquote", "code-block"],

        [{ header: 1 }, { header: 2 }], // custom button values
        [{ list: "ordered" }, { list: "bullet" }],
        [{ script: "sub" }, { script: "super" }], // superscript/subscript
        [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
        [{ direction: "rtl" }], // text direction

        [{ size: ["small", false, "large", "huge"] }], // custom dropdown
        [{ header: [1, 2, 3, 4, 5, 6, false] }],

        [{ color: [] }, { background: [] }], // dropdown with defaults from theme
        [{ font: [] }],
        [{ align: [] }],

        ["clean"], // remove formatting button
      ],

      modal_open: false,

      params: {
        search: this.filters.search,
        date: this.filters.date,
        community: this.filters.community,
        type: this.filters.type,
        status: this.filters.status,
        dateStart: this.filters.dateStart,
        dateEnd: this.filters.dateEnd,
      },

      visitBeingCreated: null,

      form: this.$inertia.form({
        brand: null,
        type: null,
        color: null,
        plaque: null,
        year: null,
        community_id: null,
      }),

      visitBeingDeleted: null,

      deleteVisitForm: this.$inertia.form({
        brand: null,
        type: null,
        color: null,
        plaque: null,
        year: null,
        community_id: null,
      }),

      visitBeingUpdated: null,

      updateVisitForm: this.$inertia.form({
        brand: null,
        type: null,
        color: null,
        plaque: null,
        year: null,
        community_id: null,
      }),

      selectCommunity: {
        selectedCommunity: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectPerfil: null,
        vSelectPerfil: null,
      },
    };
  },

  watch: {
    dataTransfer: function () {},

    "form.comm_description_visit": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;
      if (quill != null) {
        if (quill.getHTML().length <= limit) {
          this.data_intput_one = quill.getHTML();
        } else {
          quill.setHTML(this.data_intput_one);
        }
      }
    },

    "updateVisitForm.comm_description_visit": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;
      if (quill != null) {
        if (quill.getHTML().length <= limit) {
          this.data_intput_one = quill.getHTML();
        } else {
          quill.setHTML(this.data_intput_one);
        }
      }
    },

    params: {
      handler: throttle(function () {
        let params = pickBy(this.params);

        if (this.params.dateStart != null) {
          this.params.dateStart = this.formatDate(this.params.dateStart);
        }

        if (this.params.dateEnd != null) {
          this.params.dateEnd = this.formatDate(this.params.dateEnd);
        }

        this.$inertia.get(this.route("daughter.vehicles.index"), params, {
          replace: true,
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {},
        });
      }, 1),
      deep: true,
    },
  },

  computed: {
    ...mapState("work", ["work"]),

    ...mapState("work", ["allWork"]),

    isInvalidCommunity() {
      return (
        this.selectCommunity.selectedCommunity == undefined ||
        this.selectCommunity.selectedCommunity == null
      );
    },
  },

  methods: {
    onSearchCommunityChange(search) {
      var string = search;
      var length = 60;
      search = string.substring(0, length);
      if (search != null) {
        axios
          .get(
            this.route("daughter.vehicles.communities.index", {
              search: search,
            })
          )
          .then((response) => {
            this.selectCommunity.options = response.data;
          });
      }
    },

    onselectedCommunity(community) {
      this.form.community_id = community.id;
      this.selectCommunity.options = [];
    },

    customLabel(option) {
      return `${option.comm_name}`;
    },

    confirmationVisitCreate() {
      this.visitBeingCreated = this.form;
    },

    createActivity() {
      this.form.year = this.formatDate(this.form.year);

      Inertia.post(
        route("daughter.communities.vehicle.store", {
          community_id: this.communities.id,
        }),
        this.form,
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            setTimeout(() => {
              this.form.reset();
              this.visitBeingCreated = null;
              this.$refs.qleditor1.setHTML("");
              this.selectCommunity.selectedCommunity = null;
              this.selectCommunity.options = [];
            }, 0);
          },
        }
      );
    },

    createActivityCancel() {
      this.visitBeingCreated = null;
      this.selectCommunity.selectedCommunity = null;
      this.selectCommunity.options = [];
      this.form.reset();
    },

    confirmationVisitUpdate(visit) {
      this.updateVisitForm.brand = visit.brand;
      this.updateVisitForm.type = visit.type;
      this.updateVisitForm.color = visit.color;
      this.updateVisitForm.plaque = visit.plaque;
      this.updateVisitForm.year = visit.year;

      this.updateVisitForm.community_id = visit.community.id;

      this.visitBeingUpdated = visit;
    },

    updateVisit() {
      if (this.updateVisitForm.year != null) {
        this.updateVisitForm.year = this.formatDate(this.updateVisitForm.year);
      }

      this.updateVisitForm.put(
        this.route("daughter.communities.vehicle.update", {
          community_id: this.updateVisitForm.community_id,
          vehicle_id: this.visitBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            setTimeout(() => {
              this.visitBeingUpdated = null;
              this.updateVisitForm.reset();
            }, 1);
          },
        }
      );
    },

    updateVisitCancel() {
      this.visitBeingUpdated = null;
      this.updateVisitForm.reset();
    },

    confirmationVisitDelete(visit) {
      this.deleteVisitForm.brand = visit.brand;
      this.deleteVisitForm.community_id = visit.community.id;
      this.visitBeingDeleted = visit;
    },

    deleteVisit() {
      this.deleteVisitForm.delete(
        this.route("daughter.communities.vehicle.delete", {
          community_id: this.deleteVisitForm.community_id,
          vehicle_id: this.visitBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () =>
            setTimeout(() => {
              this.visitBeingDeleted = null;
              this.deleteVisitForm.reset();
            }, 0),
        }
      );
    },

    reset() {
      this.params = mapValues(this.params, () => null);
    },

    formatDate(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
      }
      return null;
    },

    formatDateShow(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD");
      }
      return "Vigente";
    },
  },
};
</script>
