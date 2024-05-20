<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Listado de los Actividades
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
      class="bg-blue-100 dark:bg-slate-800 y-1 px-4 sm:p-6 md:py-10 md:px-8 pt-2 pb-4 rounded-lg sm:m-2 lg:m-3 md:m-4"
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
            class="text-lg leading-4 font-medium text-black sm:text-black dark:sm:text-slate-400"
          >
            Información General de las actividades realizadas en las comunidades
            u obras.
          </p>
        </div>
        <div
          class="grid gap-4 col-start-1 col-end-3 row-start-1 sm:mb-6 sm:grid-cols-4 md:mb-6 md:grid-cols-4 lg:gap-6 lg:col-start-2 lg:row-end-6 lg:row-span-6 lg:mb-0"
        >

        </div>
        <dl
          class="mt-4 text-xs font-medium flex items-center row-start-2 sm:mt-1 sm:row-start-3 md:mt-1 md:row-start-3 lg:row-start-2"
        >
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
          La presente plantilla de información se relaciona a todas las
          actividades que se realizan en su comunidad u obra
          .
        </p>
      </div>
      <div class="content-center mt-2">
        <jet-button-success
          @click="confirmationActivityCreate()"
          class="block mx-5 leading-normal"
          >¿Desea crear una nueva actividad?</jet-button-success
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
            <!-- Container Filters -->
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
                    >Rangos de Fechas</small
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
                                'daughter.activities.communities.export.excel',
                                this.params
                              )
                            "
                            >Excel</a
                          >
                          <a
                            class="block px-6 py-2 hover:text-white hover:bg-blue-500"
                            target="_blank"
                            :href="
                              route(
                                'daughter.activities.communities.export.csv',
                                this.params
                              )
                            "
                            >CSV</a
                          >
                        </div>
                      </template>
                    </dropdown>
                  </div>
                </div>
              </div>
              <!-- Table -->
              <section class="pl-4">
                <pagination class="mt-6 mb-5" :links="activities.links" />
              </section>
              <small class="ml-6">
                Se encontraron {{ activities.total }} actividades.</small
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
                            Razón / Comunidad u Obra
                          </th>
                          <th
                            scope="col"
                            class="text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Fecha Actividad
                          </th>
                          <th
                            scope="col"
                            class="text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Nro. Hermanas, Beneficiarios y Colaboradores
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
                        <tr
                          v-for="activity in this.activities.data"
                          :key="activity"
                        >
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div
                                class="flex-shrink-0 h-10 w-10"
                                v-if="activity.community.comm_level === 1"
                              >
                                <svg
                                  class="svg-icon border-2 rounded-full"
                                  viewBox="-2.5 -1 25 25"
                                >
                                  <path
                                    d="M18.121,9.88l-7.832-7.836c-0.155-0.158-0.428-0.155-0.584,0L1.842,9.913c-0.262,0.263-0.073,0.705,0.292,0.705h2.069v7.042c0,0.227,0.187,0.414,0.414,0.414h3.725c0.228,0,0.414-0.188,0.414-0.414v-3.313h2.483v3.313c0,0.227,0.187,0.414,0.413,0.414h3.726c0.229,0,0.414-0.188,0.414-0.414v-7.042h2.068h0.004C18.331,10.617,18.389,10.146,18.121,9.88 M14.963,17.245h-2.896v-3.313c0-0.229-0.186-0.415-0.414-0.415H8.342c-0.228,0-0.414,0.187-0.414,0.415v3.313H5.032v-6.628h9.931V17.245z M3.133,9.79l6.864-6.868l6.867,6.868H3.133z"
                                  ></path>
                                </svg>
                              </div>
                              <div
                                class="flex-shrink-0 h-10 w-10"
                                v-if="activity.community.comm_level === 2"
                              >
                                <svg
                                  class="svg-icon border-2 rounded-full"
                                  viewBox="-2.5 -1 25 25"
                                >
                                  <path
                                    d="M17.283,5.549h-5.26V4.335c0-0.222-0.183-0.404-0.404-0.404H8.381c-0.222,0-0.404,0.182-0.404,0.404v1.214h-5.26c-0.223,0-0.405,0.182-0.405,0.405v9.71c0,0.223,0.182,0.405,0.405,0.405h14.566c0.223,0,0.404-0.183,0.404-0.405v-9.71C17.688,5.731,17.506,5.549,17.283,5.549 M8.786,4.74h2.428v0.809H8.786V4.74z M16.879,15.26H3.122v-4.046h5.665v1.201c0,0.223,0.182,0.404,0.405,0.404h1.618c0.222,0,0.405-0.182,0.405-0.404v-1.201h5.665V15.26z M9.595,9.583h0.81v2.428h-0.81V9.583zM16.879,10.405h-5.665V9.19c0-0.222-0.183-0.405-0.405-0.405H9.191c-0.223,0-0.405,0.183-0.405,0.405v1.215H3.122V6.358h13.757V10.405z"
                                  ></path>
                                </svg>
                              </div>
                              <div class="ml-4 w-6/8 ...">
                                <span
                                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-sm bg-emerald-100 text-emerald-800"
                                >
                                  <div v-if="activity.community != null">
                                    {{ activity.community.comm_name }}
                                  </div>
                                </span>
                                <div
                                  class="mt-2 text-sm font-medium text-gray-900"
                                >
                                  {{
                                    activity.comm_name_activity.substring(
                                      0,
                                      60
                                    )
                                  }}..
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span
                              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800"
                            >
                              {{
                                this.formatDateShow(activity.comm_date_activity)
                              }}
                            </span>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span
                              class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 mr-2"
                            >
                              {{ activity.comm_nr_daughters }}
                            </span>
                            <span
                              class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 mr-2"
                            >
                              {{ activity.comm_nr_beneficiaries }}
                            </span>
                            <span
                              class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 mr-2"
                            >
                              {{ activity.comm_nr_collaborators }}
                            </span>
                          </td>

                          <td
                            class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium"
                          >
                            <!-- Components -->

                            <div class="mx-auto flex gap-10">
                              <button
                                @click="confirmationActivityUpdate(activity)"
                              >
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
                              <button
                                @click="confirmationActivityDelete(activity)"
                              >
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
                <pagination class="mt-6 mb-5" :links="activities.links" />
              </section>
            </div>
          </div>
        </div>
      </div>
    </section>

    <jet-dialog-modal
      :max-width="'input-md'"
      :show="activityBeingCreated"
      @close="activityBeingCreated == null"
    >
      <template #title>
        Datos de la Nueva Actividad perteneciente a {{ communities.comm_name }}
      </template>

      <template #content>
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Nombre:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.comm_name_activity"
                >
                  {{ $page.props.errors.comm_name_activity }}
                </p>
                <small>Formato: Nombre de la Actividad.</small>
                <input
                  type="text"
                  minLength="5"
                  maxlength="100"
                  placeholder="Ingresar nombre actividad"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.comm_name_activity"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Fecha de Actividad:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_date_activity"
              >
                {{ $page.props.errors.comm_date_activity }}
              </p>
              <small>Formato: Fecha en la que se realiza la actividad.</small>
              <Datepicker
                :format="format"
                autoApply
                v-model="form.comm_date_activity"
                required
                :year-range="[1800, this.year]"
              />
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Descripción:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_description_activity"
              >
                {{ $page.props.errors.comm_description_activity }}
              </p>
              <small
                >Formato: Ingresar la descripción de la actividad que se
                realiza.</small
              >
              <div class="bg-white">
                <quill-editor
                  ref="qleditor1"
                  contentType="html"
                  theme="snow"
                  :toolbar="toolbarOptions"
                  v-model:content="form.comm_description_activity"
                  placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                ></quill-editor>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-4/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="nr_daughters"
              >
                Nro. de Hermanas:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_nr_daughters"
              >
                {{ $page.props.errors.comm_nr_daughters }}
              </p>
              <small>Formato: Número de hermanas.</small>
              <input
                type="number"
                name="nr_daughters"
                placeholder="Número de Hermanas"
                class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                min="0"
                max="1000"
                v-model="form.comm_nr_daughters"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-4/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="nr_beneficiaries"
              >
                Nro. de Beneficiarios:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_nr_beneficiaries"
              >
                {{ $page.props.errors.comm_nr_beneficiaries }}
              </p>
              <small>Formato: Número de beneficiarios.</small>
              <input
                type="number"
                class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                min="0"
                max="1000"
                name="nr_beneficiaries"
                placeholder="Número de Beneficiarios"
                v-model="form.comm_nr_beneficiaries"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-4/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="nr_collaborators"
              >
                Nro. de Colaboradores:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_nr_collaborators"
              >
                {{ $page.props.errors.comm_nr_collaborators }}
              </p>
              <small>Formato: Número de colaboradores.</small>
              <input
                type="number"
                class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                min="0"
                max="1000"
                name="nr_collaborators"
                v-model="form.comm_nr_collaborators"
                placeholder="Número de Colaboradores"
                required
              />
            </div>
          </div>
          <!-- Information Address -->
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
      :show="activityBeingUpdated"
      @close="activityBeingUpdated == null"
    >
      <template #title>
        Datos de Registro de la Actividad
        <span
          class="px-2 inline-flex text-base leading-5 font-semibold rounded-sm bg-blue-100 text-blue-800"
        >
          {{ activityBeingUpdated.community.comm_name }} </span
        >.
      </template>

      <template #content>
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Nombre:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.comm_name_activity"
                >
                  {{ $page.props.errors.comm_name_activity }}
                </p>
                <small>Formato: Nombre de la Actividad.</small>
                <input
                  type="text"
                  minLength="5"
                  maxlength="100"
                  placeholder="Ingresar nombre actividad"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="updateActivityForm.comm_name_activity"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Fecha de Actividad:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_date_activity"
              >
                {{ $page.props.errors.comm_date_activity }}
              </p>
              <small>Formato: Fecha en la que se realiza la actividad.</small>
              <Datepicker
                :format="format"
                autoApply
                v-model="updateActivityForm.comm_date_activity"
                required
                :year-range="[1800, this.year]"
              />
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Descripción:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_description_activity"
              >
                {{ $page.props.errors.comm_description_activity }}
              </p>
              <small
                >Formato: Ingresar la descripción de la actividad que se
                realiza.</small
              >
              <div class="bg-white">
                <quill-editor
                  ref="qleditor1"
                  contentType="html"
                  theme="snow"
                  :toolbar="toolbarOptions"
                  v-model:content="updateActivityForm.comm_description_activity"
                  placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                ></quill-editor>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-4/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="nr_daughters"
              >
                Nro. de Hermanas:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_nr_daughters"
              >
                {{ $page.props.errors.comm_nr_daughters }}
              </p>
              <small>Formato: Número de hermanas.</small>
              <input
                type="number"
                name="nr_daughters"
                placeholder="Número de Hermanas"
                class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                min="0"
                max="1000"
                v-model="updateActivityForm.comm_nr_daughters"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-4/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="nr_beneficiaries"
              >
                Nro. de Beneficiarios:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_nr_beneficiaries"
              >
                {{ $page.props.errors.comm_nr_beneficiaries }}
              </p>
              <small>Formato: Número de beneficiarios.</small>
              <input
                type="number"
                class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                min="0"
                max="1000"
                name="nr_beneficiaries"
                placeholder="Número de Beneficiarios"
                v-model="updateActivityForm.comm_nr_beneficiaries"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-4/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="nr_collaborators"
              >
                Nro. de Colaboradores:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_nr_collaborators"
              >
                {{ $page.props.errors.comm_nr_collaborators }}
              </p>
              <small>Formato: Número de colaboradores.</small>
              <input
                type="number"
                class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                min="0"
                max="1000"
                name="nr_collaborators"
                v-model="updateActivityForm.comm_nr_collaborators"
                placeholder="Número de Colaboradores"
                required
              />
            </div>
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="updateActivityCancel">
          Cancelar
        </jet-secondary-button>
        <jet-button-success class="ml-3" @click="updateActivity">
          Actualizar
        </jet-button-success>
      </template>
    </jet-dialog-modal>

    <jet-confirmation-modal
      :show="activityBeingDeleted"
      @close="activityBeingDeleted == null"
    >
      <template #title> Eliminar la Actividad</template>

      <template #content>
        ¿Está seguro de que desea eliminar el historial de la actividad:
        {{ this.deleteActivityForm.comm_name_activity }}?
      </template>

      <template #footer>
        <jet-secondary-button @click="activityBeingDeleted = null">
          Cancelar
        </jet-secondary-button>

        <jet-danger-button class="ml-3" @click="deleteActivity">
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
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import { mapState, mapActions, mapGetters } from "vuex";
import Operation from "@/Components/Daughter/Operation";
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
    activities: Object,
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

      activityBeingCreated: null,

      form: this.$inertia.form({
        comm_name_activity: null,
        comm_description_activity: null,
        comm_date_activity: null,
        comm_nr_daughters: null,
        comm_nr_beneficiaries: null,
        comm_nr_collaborators: null,
        community_id: null,
      }),

      activityBeingUpdated: null,

      updateActivityForm: this.$inertia.form({
        community_id: null,
        comm_name_activity: null,
        comm_description_activity: null,
        comm_date_activity: null,
        comm_nr_daughters: null,
        comm_nr_beneficiaries: null,
        comm_nr_collaborators: null,
      }),

      activityBeingDeleted: null,

      deleteActivityForm: this.$inertia.form({
        comm_name_activity: null,
        comm_description_activity: null,
        comm_date_activity: null,
        comm_nr_daughters: null,
        comm_nr_beneficiaries: null,
        comm_nr_collaborators: null,
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
    dataTransfer: function () {
    },

    "form.comm_description_activity": function () {
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

    "updateActivityForm.comm_description_activity": function () {
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

        this.$inertia.get(this.route("daughter.activities.index"), params, {
          replace: true,
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
          },
        });
      }, 1),
      deep: true,
    },
  },
  computed: {
    ...mapState("work", ["work"]),

    ...mapState("work", ["allWork"]),

    isInvalid() {
      return (
        this.selectOne.selectedProvince == undefined ||
        this.selectOne.selectedProvince == null
      );
    },

    isInvalidCanton() {
      return (
        this.selectTwo.selectedCanton == undefined ||
        this.selectTwo.selectedCanton == null
      );
    },

    isInvalidParish() {
      return (
        this.selectThree.selectedParish == undefined ||
        this.selectThree.selectedParish == null
      );
    },

    isInvalidCommunity() {
      return (
        this.selectCommunity.selectedCommunity == undefined ||
        this.selectCommunity.selectedCommunity == null
      );
    },
  },
  methods: {
    async status() {
      let response = await axios.get(
        this.route("secretary.address.actual-address", {
          actual_parish: this.updateActivityForm.political_division_id,
        })
      );
      return response.data;
    },

    onSearchProvincesChange(term) {
    },

    onSelectedProvince(province) {
      if (this.activityBeingUpdated != null) {
        this.updateActivityForm.political_division_id = null;
      }

      axios
        .get(
          this.route("secretary.address.cantons", {
            province_id: province.id,
          })
        )
        .then((res) => {
          //   console.log(res.data);
          this.selectTwo.options = res.data;
        });
    },

    onSearchCommunityChange(search) {
      var string = search;

      var length = 60;

      search = string.substring(0, length);

      if (search != null) {
        axios
          .get(
            this.route("daughter.activities.communities.index", {
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

    confirmationActivityCreate() {
      this.activityBeingCreated = this.form;
    },

    createActivity() {
      this.form.comm_date_activity = this.formatDate(
        this.form.comm_date_activity
      );

      Inertia.post(
        route("daughter.communities.activity.store", {
          community_id: this.communities.id,
        }),
        this.form,
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            setTimeout(() => {
              this.form.reset();
              this.$refs.qleditor1.setHTML("");
              this.activityBeingCreated = null;
              this.selectCommunity.selectedCommunity = null;
              this.selectCommunity.options = [];
            }, 0);
          },
        }
      );
    },

    createActivityCancel() {
      this.activityBeingCreated = null;

      this.selectCommunity.selectedCommunity = null;

      this.selectCommunity.options = [];

      this.form.reset();
    },

    confirmationActivityUpdate(activity) {
      this.updateActivityForm.comm_name_activity = activity.comm_name_activity;

      this.updateActivityForm.comm_description_activity =
        activity.comm_description_activity;

      this.updateActivityForm.comm_date_activity = activity.comm_date_activity;

      this.updateActivityForm.comm_nr_daughters = activity.comm_nr_daughters;

      this.updateActivityForm.comm_nr_beneficiaries =
        activity.comm_nr_beneficiaries;

      this.updateActivityForm.comm_nr_collaborators =
        activity.comm_nr_collaborators;

      this.updateActivityForm.community_id = activity.community.id;

      this.activityBeingUpdated = activity;
    },

    updateActivity() {
      if (this.updateActivityForm.comm_date_activity != null) {
        this.updateActivityForm.comm_date_activity = this.formatDate(
          this.updateActivityForm.comm_date_activity
        );
      }

      this.updateActivityForm.put(
        this.route("daughter.communities.activity.update", {
          community_id: this.updateActivityForm.community_id,
          activity_id: this.activityBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            setTimeout(() => {
              this.activityBeingUpdated = null;
            }, 0);
          },
        }
      );
    },

    updateActivityCancel() {
      this.activityBeingUpdated = null;
      this.updateActivityForm.reset();
    },

    confirmationActivityDelete(activity) {
      this.deleteActivityForm.comm_name_activity = activity.comm_name_activity;

      this.deleteActivityForm.comm_description_activity =
        activity.comm_description_activity;

      this.deleteActivityForm.comm_date_activity = activity.comm_date_activity;

      this.deleteActivityForm.community_id = activity.community.id;

      this.activityBeingDeleted = activity;
    },

    deleteActivity() {
      this.deleteActivityForm.delete(
        this.route("daughter.communities.activity.delete", {
          community_id: this.deleteActivityForm.community_id,
          activity_id: this.activityBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () =>
            setTimeout(() => {
              this.activityBeingDeleted = null;
              this.deleteActivityForm.reset();
            }, 2),
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
