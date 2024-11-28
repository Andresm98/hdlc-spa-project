<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Listado de los Resumenes Anuales
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
      class="bg-sky-100 dark:bg-slate-800 y-1 px-4 sm:p-6 md:py-10 md:px-8 pt-2 pb-4 rounded-lg sm:m-2 lg:m-3 md:m-4"
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
            Información General de los resumenes de las comunidades u obras.
          </p>
        </div>
        <div
          class="grid gap-4 col-start-1 col-end-3 row-start-1 sm:mb-6 sm:grid-cols-4 md:mb-6 md:grid-cols-4 lg:gap-6 lg:col-start-2 lg:row-end-6 lg:row-span-6 lg:mb-0"
        ></div>
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
          La presente plantilla de información se relaciona a todos los
          resumenes anuales de su Comunidad u Obra.
        </p>
      </div>
      <div class="content-center mt-2">
        <jet-button-success
          @click="confirmationResumenCreate()"
          class="block mx-5 leading-normal"
          >¿Desea crear un nuevo resumen?</jet-button-success
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
                                'daughter.resumes.communities.export.excel',
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
                                'daughter.resumes.communities.export.csv',
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
                <pagination class="mt-6 mb-5" :links="resumes.links" />
              </section>
              <small class="ml-6">
                Se encontraron {{ resumes.total }} resumenes.</small
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
                            Nombre / Comunidad u Obra
                          </th>
                          <th
                            scope="col"
                            class="text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Fecha Resumen
                          </th>
                          <th
                            scope="col"
                            class="text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Anexos
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
                        <tr v-for="resume in this.resumes.data" :key="resume">
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div
                                class="flex-shrink-0 h-10 w-10"
                                v-if="resume.community.comm_level === 1"
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
                                v-if="resume.community.comm_level === 2"
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
                                  class="whitespace-normal text-sm font-semibold"
                                >
                                  <div v-if="resume.community != null">
                                    <span
                                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-sm bg-green-100 text-green-800"
                                    >
                                      {{ resume.community.comm_name }}
                                    </span>
                                  </div>
                                </span>
                                <div
                                  class="mt-2 text-sm font-medium text-gray-900"
                                >
                                  {{
                                    resume.comm_name_resume.substring(0, 60)
                                  }}..
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span
                              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800"
                            >
                              {{ this.formatDateShow(resume.comm_date_resume) }}
                            </span>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="ml-4 w-full...">
                              <span
                                class="whitespace-normal text-sm font-semibold text-gray-900"
                              >
                                {{
                                  resume.comm_annexed_resume.substring(0, 30)
                                }}..
                              </span>
                            </div>
                          </td>
                          <td
                            class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium"
                          >
                            <!-- Components -->

                            <div class="mx-auto flex gap-10">
                              <button @click="confirmationResumeUpdate(resume)">
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
                              <button @click="confirmationResumeDelete(resume)">
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
                <pagination class="mt-6 mb-5" :links="resumes.links" />
              </section>
            </div>
          </div>
        </div>
      </div>
    </section>

    <jet-dialog-modal
      :max-width="'input-md'"
      :show="resumeBeingCreated"
      @close="resumeBeingCreated == null"
    >
      <template #title>
        Datos del Nuevo Resumen perteneciente a
        {{ communities.comm_name }}</template
      >

      <template #content>
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Nombre Resumen
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.comm_name_resume"
                >
                  {{ $page.props.errors.comm_name_resume }}
                </p>
                <small>Formato: Nombre del resumen anual.</small>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre del resumen"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="form.comm_name_resume"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Fecha
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_date_resume"
              >
                {{ $page.props.errors.comm_date_resume }}
              </p>
              <small>Formato: Fecha del resumen anual.</small>
              <Datepicker
                :format="format"
                autoApply
                v-model="form.comm_date_resume"
                required
                :year-range="[1800, this.year]"
              />
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                En caso de tener un anexo que dependa de esta Comunidad, indicar
                dirección
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_annexed_resume"
              >
                {{ $page.props.errors.comm_annexed_resume }}
              </p>
              <small
                >Formato: Si existe algún enlace o anexo, adjuntarlo en el
                presente campo.</small
              >
              <input
                minLength="10"
                maxlength="400"
                type="text"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                name="anexed"
                placeholder="Ingresar el anexo del resumen"
                v-model="form.comm_annexed_resume"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Observaciones
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_observation_resume"
              >
                {{ $page.props.errors.comm_observation_resume }}
              </p>
              <small
                >Formato: Observaciones (obras abiertas o cerradas) -
                Dificultades particulares que se han presentado durante este
                año,etc. max 3000 caracteres.</small
              >
              <div class="bg-white">
                <quill-editor
                  ref="qleditor1"
                  contentType="html"
                  theme="snow"
                  :toolbar="toolbarOptions"
                  v-model:content="form.comm_observation_resume"
                  placeholder="Ingresar los datos solicitados..."
                ></quill-editor>
              </div>
            </div>
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="createResumeCancel">
          Cancelar
        </jet-secondary-button>

        <jet-button-success class="ml-3" @click="createResume">
          Crear
        </jet-button-success>
      </template>
    </jet-dialog-modal>

    <jet-dialog-modal
      :max-width="'input-md'"
      :show="resumeBeingUpdated"
      @close="resumeBeingUpdated == null"
    >
      <template #title>
        Datos de Registro del Resumen Anual
        <span
          class="px-2 inline-flex text-base leading-5 font-semibold rounded-sm bg-blue-100 text-blue-800"
        >
          {{ resumeBeingUpdated.community.comm_name }}
          Año ({{
            this.formatDateShow(resumeBeingUpdated.comm_date_resume)
          }})</span
        >.
      </template>

      <template #content>
        <div class="flex flex-wrap" v-if="navigationOp == 1">
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Nombre:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.comm_name_resume"
                >
                  {{ $page.props.errors.comm_name_resume }}
                </p>
                <small>Formato: Nombre del resumen anual.</small>
                <input
                  type="text"
                  minLength="1"
                  maxlength="200"
                  placeholder="Ingresar nombre del resumen"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="updateResumeForm.comm_name_resume"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Fecha:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_date_resume"
              >
                {{ $page.props.errors.comm_date_resume }}
              </p>
              <small>Formato: Fecha del resumen anual.</small>
              <Datepicker
                v-model="updateResumeForm.comm_date_resume"
                :year-range="[1800, this.year]"
                :format="format"
                autoApply
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                En caso de tener un anexo que dependa de esta Comunidad, indicar
                dirección:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_annexed_resume"
              >
                {{ $page.props.errors.comm_annexed_resume }}
              </p>
              <small
                >Formato: Si existe algún enlace o anexo, adjuntarlo en el
                presente campo.</small
              >
              <input
                minLength="10"
                maxlength="400"
                type="text"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                name="anexed"
                placeholder="Ingresar el anexo del resumen"
                v-model="updateResumeForm.comm_annexed_resume"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Observaciones:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.comm_observation_resume"
              >
                {{ $page.props.errors.comm_observation_resume }}
              </p>
              <small
                >Formato: Observaciones (obras abiertas o cerradas) -
                Dificultades particulares que se han presentado durante este
                año,etc. , max 3000 caracteres.</small
              >
              <div class="bg-white">
                <quill-editor
                  ref="qleditor1"
                  contentType="html"
                  theme="snow"
                  :toolbar="toolbarOptions"
                  v-model:content="updateResumeForm.comm_observation_resume"
                  placeholder="Ingresar los datos solicitados, puede ingresar 3000 caracteres como máximo..."
                ></quill-editor>
              </div>
            </div>
          </div>

          <!-- Information Address -->
        </div>
        <div v-if="navigationOp == 2">
          <div v-if="operationCrud == 1">
            <div
              class="bg-white rounded-lg px-6 py-8 ring-1 ring-slate-900/5 shadow-xl"
            >
              <form @submit.prevent="submit">
                <div class="flex flex-wrap">
                  <div class="w-full lg:w-12/12 px-4">
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
                        <input
                          type="text"
                          minLength="5"
                          maxlength="100"
                          placeholder="Ingresar nombre actividad"
                          class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                          v-model="formActivity.comm_name_activity"
                          required
                        />
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
                      <input
                        type="number"
                        name="nr_daughters"
                        placeholder="Número de Hermanas"
                        class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                        min="0"
                        max="1000"
                        v-model="formActivity.comm_nr_daughters"
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
                      <input
                        type="number"
                        class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                        min="0"
                        max="10000"
                        name="nr_beneficiaries"
                        placeholder="Número de Beneficiarios"
                        v-model="formActivity.comm_nr_beneficiaries"
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
                      <input
                        type="number"
                        class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                        min="0"
                        max="10000"
                        name="nr_collaborators"
                        v-model="formActivity.comm_nr_collaborators"
                        placeholder="Número de Colaboradores"
                        required
                      />
                    </div>
                  </div>
                </div>
                <jet-button type="submit" class="ml-4 mb-2 btn btn-primary"
                  >Crear Actividad</jet-button
                >
              </form>
            </div>
          </div>

          <div v-if="operationCrud == 2">
            <div
              class="bg-white rounded-lg px-6 py-8 ring-1 ring-slate-900/5 shadow-xl"
            >
              <form @submit.prevent="submitUpdate">
                <div class="flex flex-wrap">
                  <div class="w-full lg:w-12/12 px-4">
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
                      <input
                        type="number"
                        class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                        min="0"
                        max="10000"
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
                      <input
                        type="number"
                        class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                        min="0"
                        max="10000"
                        name="nr_collaborators"
                        v-model="updateActivityForm.comm_nr_collaborators"
                        placeholder="Número de Colaboradores"
                        required
                      />
                    </div>
                  </div>
                </div>
                <jet-button-success
                  type="submit"
                  class="ml-4 mb-2 btn btn-primary"
                  >Editar Actividad</jet-button-success
                >
              </form>
            </div>
          </div>

          <hr />
          <div class="py-2">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
              <div
                v-if="this.getAllActivity != null"
                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
              >
                <div className="overflow-y-auto h-96">
                  <div className="relative px-4">
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-blue-100">
                        <tr>
                          <th
                            scope="col"
                            class="pl-4 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Nombre
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Hermanas - Beneficiarios - Colaboradores
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
                          v-for="activity in this.getAllActivity"
                          :key="activity"
                        >
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{
                                    activity.comm_name_activity.substring(
                                      0,
                                      25
                                    )
                                  }}..
                                </div>
                              </div>
                            </div>
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
                              <jet-button
                                @click="confirmationActivityUpdate(activity)"
                                >Editar</jet-button
                              >
                              <jet-danger-button
                                @click="confirmationActivityDelete(activity)"
                                >Eliminar</jet-danger-button
                              >
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div v-else class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg">
                <p class="text-center text-lg">
                  Por el momento no existen registros.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div v-if="navigationOp == 3">
          <div
            class="bg-white rounded-lg px-6 py-8 ring-1 ring-slate-900/5 shadow-xl"
          >
            <form @submit.prevent="submitUpdateStaff">
              <div class="flex flex-wrap">
                <div class="w-full lg:w-12/12 px-4">
                  <div class="relative w-full mb-3">
                    <div class="">
                      <label class="block text-sm font-medium text-gray-700">
                        Oficio de la Hermana
                        {{ this.updateStaffForm.lastname }}:
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.office"
                      >
                        {{ $page.props.errors.office }}
                      </p>
                      <input
                        type="text"
                        minLength="1"
                        maxlength="100"
                        placeholder="Ingresar oficio"
                        class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="updateStaffForm.office"
                        required
                      />
                    </div>
                  </div>
                </div>
                <div class="w-full lg:w-12/12 px-4">
                  <div class="relative w-full mb-3">
                    <div class="">
                      <label class="block text-sm font-medium text-gray-700">
                        Mes de Retiro:
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.retirement"
                      >
                        {{ $page.props.errors.retirement }}
                      </p>
                      <input
                        type="text"
                        minLength="1"
                        maxlength="100"
                        placeholder="Ingresar mes retiro"
                        class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="updateStaffForm.retirement"
                        required
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div v-if="this.staffBeingUpdated != null">
                <jet-button-success
                  type="submit"
                  class="ml-4 mb-2 btn btn-primary"
                >
                  Guardar Registro
                </jet-button-success>
              </div>
            </form>
          </div>
          <!--  -->
          <br />
          <jet-secondary-button
            class="ml-3"
            @click="this.refreshStaff(this.resumeBeingUpdated)"
          >
            Refrescar Listado Hermanas
          </jet-secondary-button>
          <div class="py-2">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
              <div
                v-if="this.groupedStaff != null"
                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
              >
                <div className="overflow-y-auto h-96">
                  <div
                    className="relative px-4"
                    v-for="group in groupedStaff"
                    :key="group.community"
                  >
                    <h4>{{ group.community }} ({{ group.count }} miembros)</h4>
                    <!-- Nombre de la comunidad y el conteo -->

                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-blue-100">
                        <tr>
                          <th
                            scope="col"
                            class="pl-4 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Apellidos
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Nombre Comunidad
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Fecha de Nacimiento
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Fecha de Vocación
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Oficio
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Fecha de llegada y salida
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Mes Retiro
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
                        <tr v-for="staff in group.records" :key="staff.id">
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{ staff.lastname }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{ staff.fullnamecomm }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{ staff.datebirth }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{ staff.datevocation }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{ staff.office }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{ staff.dateinsert }}
                                </div>
                                <div
                                  v-if="staff.transferdaterelocated != ''"
                                  class="text-sm font-medium text-gray-900"
                                >
                                  {{ staff.transferdaterelocated }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{ staff.retirement }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td
                            class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium"
                          >
                            <!-- Components -->

                            <div class="mx-auto flex gap-10">
                              <jet-button
                                @click="confirmationStaffUpdate(staff)"
                                >Editar</jet-button
                              >
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div v-else class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg">
                <p class="text-center text-lg">
                  Por el momento no existen registros.
                </p>
              </div>
            </div>
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="updateResumeCancel">
          Cancelar
        </jet-secondary-button>
        <jet-warning-button class="ml-3" @click="navigation(3)">
          Listado Hermanas
        </jet-warning-button>
        <jet-button
          class="ml-3"
          @click="navigation(1)"
          v-if="navigationOp == 1 || navigationOp == 3"
        >
          Siguiente
        </jet-button>
        <jet-button
          class="ml-3"
          @click="navigation(2)"
          v-if="navigationOp == 2 || navigationOp == 3"
        >
          Anterior
        </jet-button>
        <jet-secondary-button class="ml-3" @click="downloadResume">
          Imprimir
        </jet-secondary-button>
        <jet-button-success class="ml-3" @click="updateResume">
          Actualizar
        </jet-button-success>
      </template>
    </jet-dialog-modal>

    <jet-confirmation-modal
      :show="resumeBeingDeleted"
      @close="resumeBeingDeleted == null"
    >
      <template #title> Eliminar el Resumen</template>

      <template #content>
        ¿Está seguro de que desea eliminar el resumen:
        {{ this.deleteResumeForm.comm_name_resume }}?
      </template>

      <template #footer>
        <jet-secondary-button @click="resumeBeingDeleted = null">
          Cancelar
        </jet-secondary-button>

        <jet-danger-button class="ml-3" @click="deleteResume">
          Eliminar
        </jet-danger-button>
      </template>
    </jet-confirmation-modal>

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
import JetWarningButton from "@/Jetstream/WarningButton.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import Operation from "@/Components/Daughter/Operation";
import { mapState, mapActions, mapGetters } from "vuex";
import JetInputError from "@/Jetstream/InputError.vue";
import { pickBy, throttle, mapValues } from "lodash";
import SearchFilter from "@/Components/SearchFilter";
import JetButton from "@/Jetstream/Button.vue";
import Datepicker from "vue3-date-time-picker";
import Pagination from "@/Components/Pagination";
import { useForm } from "@inertiajs/inertia-vue3";
import TextInput from "@/Components/TextInput";
import JetInput from "@/Jetstream/Input.vue";
import { Inertia } from "@inertiajs/inertia";
import Dropdown from "@/Components/Dropdown";
import Alert from "@/Components/Alert";
import Icon from "@/Components/Icon";
import { range } from "moment-range";
import moment from "moment";
import { ref } from "vue";

export default {
  layout: PrincipalLayout,

  props: {
    resumes: Object,
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

    const formActivity = useForm({
      comm_name_activity: null,
      comm_description_activity: null,
      comm_date_activity: null,
      comm_nr_daughters: null,
      comm_nr_beneficiaries: null,
      comm_nr_collaborators: null,
      id_comm: null,
    });

    const formStaff = useForm({
      office: null,
      retirement: null,
      transfer_id: null,
      resume_id: null,
    });

    return {
      date,
      year,
      format,
      formActivity,
      formStaff,
    };
  },

  components: {
    JetButton,
    AppLayout,
    moment,
    range,
    JetDialogModal,
    JetDangerButton,
    JetWarningButton,
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

      navigationOp: 1,

      operationCrud: 1,

      params: {
        search: this.filters.search,
        date: this.filters.date,
        community: this.filters.community,
        type: this.filters.type,
        status: this.filters.status,
        dateStart: this.filters.dateStart,
        dateEnd: this.filters.dateEnd,
      },

      resumeBeingCreated: null,

      form: this.$inertia.form({
        comm_name_resume: null,
        comm_annexed_resume: null,
        comm_observation_resume: null,
        comm_date_resume: null,
        community_id: null,
      }),

      resumeBeingDeleted: null,

      deleteResumeForm: this.$inertia.form({
        comm_name_resume: null,
        comm_annexed_resume: null,
        comm_observation_resume: null,
        comm_date_resume: null,
        community_id: null,
      }),

      resumeBeingUpdated: null,

      updateResumeForm: this.$inertia.form({
        comm_name_resume: null,
        comm_annexed_resume: null,
        comm_observation_resume: null,
        comm_date_resume: null,
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

      activityBeingDeleted: null,

      deleteActivityForm: this.$inertia.form({
        comm_name_activity: null,
        comm_description_activity: null,
        comm_date_activity: null,
        comm_nr_daughters: null,
        comm_nr_beneficiaries: null,
        comm_nr_collaborators: null,
      }),

      activityBeingUpdated: null,

      updateActivityForm: this.$inertia.form({
        comm_name_activity: null,
        comm_description_activity: null,
        comm_date_activity: null,
        comm_nr_daughters: null,
        comm_nr_beneficiaries: null,
        comm_nr_collaborators: null,
      }),

      getAllActivity: null,

      //

      staffBeingUpdated: null,

      updateStaffForm: this.$inertia.form({
        office: null,
        lastname: null,
        retirement: null,
        id: null,
      }),

      groupedStaff: null,
    };
  },

  watch: {
    dataTransfer: function () {},
    "form.comm_observation_resume": function () {
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

    "updateResumeForm.comm_observation_resume": function () {
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
        this.$inertia.get(this.route("daughter.resumes.index"), params, {
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
    navigation(op) {
      if (op == 1) {
        this.navigationOp = 2;
      } else if (op == 2) {
        this.navigationOp = 1;
      } else if (op == 3) {
        this.navigationOp = 3;
      }
    },

    onSearchCommunityChange(search) {
      var string = search;
      var length = 60;
      search = string.substring(0, length);
      if (search != null) {
        axios
          .get(
            this.route("daughter.resumes.communities.index", {
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

    confirmationResumenCreate() {
      this.resumeBeingCreated = this.form;
    },

    createResume() {
      this.form.comm_date_resume = this.formatDate(this.form.comm_date_resume);
      Inertia.post(
        route("daughter.communities.resume.store", {
          community_id: this.communities.id,
        }),
        this.form,
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            setTimeout(() => {
              this.resumeBeingCreated = null;
              this.form.reset();
              this.$refs.qleditor1.setHTML("");
              this.selectCommunity.selectedCommunity = null;
              this.selectCommunity.options = [];
              let resume = this.$page.props.flash.message;
              this.confirmationResumeUpdate(resume);
            }, 0);
          },
        }
      );
    },

    createResumeCancel() {
      this.navigationOp = 1;
      this.resumeBeingCreated = null;
      this.selectCommunity.selectedCommunity = null;
      this.selectCommunity.options = [];

      this.updateStaffForm.office = null;
      this.updateStaffForm.lastname = null;
      this.updateStaffForm.retirement = null;
      this.updateStaffForm.id = null;

      this.staffBeingUpdated = null;

      this.form.reset();
    },

    confirmationResumeUpdate(resume) {
      this.updateResumeForm.comm_name_resume = resume.comm_name_resume;
      this.updateResumeForm.comm_observation_resume =
        resume.comm_observation_resume;
      this.updateResumeForm.comm_date_resume = resume.comm_date_resume;
      this.updateResumeForm.comm_annexed_resume = resume.comm_annexed_resume;
      this.updateResumeForm.community_id = resume.community.id;
      this.resumeBeingUpdated = resume;
      this.updateTable();
      this.updateTableStaff();
    },

    updateResume() {
      if (this.updateResumeForm.comm_date_resume != null) {
        this.updateResumeForm.comm_date_resume = this.formatDate(
          this.updateResumeForm.comm_date_resume
        );
      }

      this.updateResumeForm.put(
        this.route("daughter.communities.resume.update", {
          community_id: this.updateResumeForm.community_id,
          resume_id: this.resumeBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            setTimeout(() => {
              this.resumeBeingUpdated = null;
            }, 0);
          },
        }
      );
    },

    updateResumeCancel() {
      this.resumeBeingUpdated = null;
      this.updateResumeForm.reset();

      //

      this.formActivity.comm_name_activity = null;
      this.formActivity.comm_description_activity = null;
      this.formActivity.comm_date_activity = null;
      this.formActivity.comm_nr_daughters = null;
      this.formActivity.comm_nr_beneficiaries = null;
      this.formActivity.comm_nr_collaborators = null;

      this.updateActivityForm.comm_name_activity = null;
      this.updateActivityForm.comm_nr_daughters = null;
      this.updateActivityForm.comm_nr_beneficiaries = null;
      this.updateActivityForm.comm_nr_collaborators = null;

      this.navigation(2);
    },

    confirmationResumeDelete(resume) {
      this.deleteResumeForm.comm_name_resume = resume.comm_name_resume;

      this.deleteResumeForm.comm_observation_resume =
        resume.comm_observation_resume;

      this.deleteResumeForm.comm_date_resume = resume.comm_date_resume;

      this.deleteResumeForm.community_id = resume.community.id;

      this.resumeBeingDeleted = resume;
    },

    deleteResume() {
      this.deleteResumeForm.delete(
        this.route("daughter.communities.resume.delete", {
          community_id: this.deleteResumeForm.community_id,
          resume_id: this.resumeBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () =>
            setTimeout(() => {
              this.resumeBeingDeleted = null;
              this.deleteResumeForm.reset();
            }, 2),
        }
      );
    },

    // Activities

    submit() {
      this.formActivity.id_comm = this.resumeBeingUpdated.community.id;
      Inertia.post(
        route("daughter.communities.activity.store", {
          resume_id: this.resumeBeingUpdated.id,
        }),
        this.formActivity,
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            setTimeout(() => {
              this.updateTable();
            }, 10);
            this.formActivity.comm_name_activity = null;
            this.formActivity.comm_description_activity = null;
            this.formActivity.comm_date_activity = null;
            this.formActivity.comm_nr_daughters = null;
            this.formActivity.comm_nr_beneficiaries = null;
            this.formActivity.comm_nr_collaborators = null;
            this.operationCrud = 1;
          },
        }
      );
    },

    confirmationActivityUpdate(activity) {
      this.updateActivityForm.comm_name_activity = activity.comm_name_activity;
      this.updateActivityForm.comm_nr_daughters = activity.comm_nr_daughters;
      this.updateActivityForm.comm_nr_beneficiaries =
        activity.comm_nr_beneficiaries;
      this.updateActivityForm.comm_nr_collaborators =
        activity.comm_nr_collaborators;

      this.operationCrud = 2;

      this.activityBeingUpdated = activity;
    },

    submitUpdate() {
      Inertia.put(
        route("daughter.communities.activity.update", {
          resume_id: this.resumeBeingUpdated.id,
          activity_id: this.activityBeingUpdated.id,
        }),
        this.updateActivityForm,
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            setTimeout(() => {
              this.updateTable();
            }, 10);
            this.updateActivityForm.comm_name_activity = null;
            this.updateActivityForm.comm_nr_daughters = null;
            this.updateActivityForm.comm_nr_beneficiaries = null;
            this.updateActivityForm.comm_nr_collaborators = null;
            this.operationCrud = 1;
          },
        }
      );
    },

    confirmationActivityDelete(activity) {
      this.deleteActivityForm.comm_name_activity = activity.comm_name_activity;
      this.deleteActivityForm.comm_description_activity =
        activity.comm_description_activity;
      this.deleteActivityForm.comm_date_activity = activity.comm_date_activity;
      this.activityBeingDeleted = activity;
    },

    deleteActivity() {
      this.deleteActivityForm.delete(
        this.route("daughter.communities.activity.delete", {
          resume_id: this.resumeBeingUpdated.id,
          activity_id: this.activityBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.activityBeingDeleted = null),
            setTimeout(() => {
              this.updateTable();

              this.operationCrud = 1;
            }, 2)
          ),
        }
      );
    },

    updateTable() {
      axios
        .get(
          this.route("daughter.communities.activity.resume.index", {
            resume_id: this.resumeBeingUpdated.id,
          })
        )
        .then((res) => {
          this.getAllActivity = res.data;
        });
    },

    // Staff

    updateTableStaff() {
      axios
        .get(
          this.route("daughter.communities.staff.resume.index", {
            resume_id: this.resumeBeingUpdated.id,
            option: 2,
          })
        )
        .then((res) => {
          console.log(res.data);

          // Convertir el objeto agrupado en un array para facilitar la iteración en el template
          this.groupedStaff = Object.values(res.data);
        });
    },

    confirmationStaffUpdate(staff) {
      this.updateStaffForm.office = staff.office;
      this.updateStaffForm.lastname = staff.lastname;
      this.updateStaffForm.retirement = staff.retirement;
      this.updateStaffForm.id = staff.id;

      this.staffBeingUpdated = staff;
    },

    submitUpdateStaff() {
      Inertia.put(
        route("daughter.communities.staff.resume.update", {
          staff_id: this.updateStaffForm.id,
        }),
        this.updateStaffForm,
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            setTimeout(() => {
              this.updateTableStaff();
            }, 10);
            this.updateStaffForm.office = null;
            this.updateStaffForm.lastname = null;
            this.updateStaffForm.retirement = null;
            this.updateStaffForm.id = null;

            this.staffBeingUpdated = null;
          },
        }
      );
    },

    refreshStaff(staff) {
      console.log(staff);
      Inertia.put(
        route("daughter.communities.staff.resume.refreshlist", {}),
        staff,
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            setTimeout(() => {
              this.updateTableStaff();
            }, 10);
          },
        }
      );
    },

    /// Print

    downloadResume() {
      window.open(
        route(
          "daughter.communities.resumeone.pdf",
          {
            resume_id: this.resumeBeingUpdated.id,
          },
          "one"
        )
      );

      window.open(
        route("daughter.communities.resumetwo.pdf", {
          resume_id: this.resumeBeingUpdated.id,
        }),
        "two"
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
