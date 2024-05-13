<template>
  <app-layout>
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
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Información Personal del Perfil de la Hermana
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenida Hermana: {{ $page.props.user.name }}
        {{ $page.props.user.lastname }}
      </div>
    </template>
    <div class="mt-5 md:mt-0 md:col-span-2" v-if="this.profileForm != null">
      <operation></operation>
    </div>
    <div class="my-2 md:m-2 lg:m-4 xl:m-5 md:p-2 lg:p-4 rounded-md bg-gray-50">
      <div>
        <div class=" ">
          <!-- <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium leading-6 text-gray-900">
                Hermana
              </h3>
              <div
                class="mt-5 md:mt-0 md:col-span-2"
                v-if="this.profileForm != null"
              >
                <div
                  class="ml-14 mt-4 mb-4 col-start-1 row-start-3 self-center sm:mt-0 sm:col-start-2 sm:row-start-2 sm:row-span-2 lg:mt-6 lg:col-start-1 lg:row-start-3 lg:row-end-4"
                >
                  <button @click="openDialogReport()">
                    <div class="w-auto h-auto">
                      <div class="flex-1 h-full">
                        <div
                          class="w-28 flex items-center justify-center flex-1 h-full p-2 border border-blue-800 text-white shadow rounded-lg hover:bg-blue-50 hover:text-zinc-300"
                        >
                          <div class="relative">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-5 w-5 text-blue-800"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                            >
                              <path
                                d="M17.453,12.691V7.723 M17.453,12.691V7.723 M1.719,12.691V7.723 M18.281,12.691V7.723 M12.691,12.484H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,12.484,12.691,12.484M12.691,14.555H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,14.555,12.691,14.555 M12.691,12.484H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,12.484,12.691,12.484 M12.691,14.555H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,14.555,12.691,14.555 M12.691,14.555H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,14.555,12.691,14.555M12.691,12.484H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,12.484,12.691,12.484 M7.309,13.312h5.383c0.229,0,0.414-0.187,0.414-0.414s-0.186-0.414-0.414-0.414H7.309c-0.228,0-0.414,0.187-0.414,0.414S7.081,13.312,7.309,13.312 M12.691,14.555H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,14.555,12.691,14.555 M16.625,6.066h-1.449V3.168c0-0.228-0.186-0.414-0.414-0.414H5.238c-0.228,0-0.414,0.187-0.414,0.414v2.898H3.375c-0.913,0-1.656,0.743-1.656,1.656v4.969c0,0.913,0.743,1.656,1.656,1.656h1.449v2.484c0,0.228,0.187,0.414,0.414,0.414h9.523c0.229,0,0.414-0.187,0.414-0.414v-2.484h1.449c0.912,0,1.656-0.743,1.656-1.656V7.723C18.281,6.81,17.537,6.066,16.625,6.066 M5.652,3.582h8.695v2.484H5.652V3.582zM14.348,16.418H5.652v-4.969h8.695V16.418z M17.453,12.691c0,0.458-0.371,0.828-0.828,0.828h-1.449v-2.484c0-0.228-0.186-0.414-0.414-0.414H5.238c-0.228,0-0.414,0.186-0.414,0.414v2.484H3.375c-0.458,0-0.828-0.37-0.828-0.828V7.723c0-0.458,0.371-0.828,0.828-0.828h13.25c0.457,0,0.828,0.371,0.828,0.828V12.691z M7.309,13.312h5.383c0.229,0,0.414-0.187,0.414-0.414s-0.186-0.414-0.414-0.414H7.309c-0.228,0-0.414,0.187-0.414,0.414S7.081,13.312,7.309,13.312M7.309,15.383h5.383c0.229,0,0.414-0.187,0.414-0.414s-0.186-0.414-0.414-0.414H7.309c-0.228,0-0.414,0.187-0.414,0.414S7.081,15.383,7.309,15.383 M12.691,14.555H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,14.555,12.691,14.555 M12.691,12.484H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,12.484,12.691,12.484 M12.691,12.484H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,12.484,12.691,12.484M12.691,14.555H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,14.555,12.691,14.555"
                              ></path>
                            </svg>
                          </div>
                        </div>
                      </div>
                    </div>
                  </button>
                  <small class="ml-2">Imprimir Reporte</small>
                </div>
              </div>
              <p class="mt-1 text-sm text-gray-600 text-justify">
                La información que puede visualizar se relacionan a la
                información de su usuario en el sistema general, tenga en cuenta
                que los datos deben mantener los formatos solicitados. El correo
                electrónico deberá ser único en el sistema, por lo que si
                ingresa un correo existente en el sistema no será validado. El
                corre establecido será utilizado para varias funciones entre
                ellas enviar informes, recuperación de contraseñas y demás
                operaciones.
              </p>
            </div>
          </div> -->

          <div class=" ">
            <div
              class="mt-5 md:mt-0 md:col-span-2"
              v-if="this.profileForm != null"
            >
              <div
                class="ml-14 mt-4 mb-4 col-start-1 row-start-3 self-center sm:mt-0 sm:col-start-2 sm:row-start-2 sm:row-span-2 lg:mt-6 lg:col-start-1 lg:row-start-3 lg:row-end-4"
              >
                <button @click="openDialogReport()">
                  <div class="w-auto h-auto">
                    <div class="flex-1 h-full">
                      <div
                        class="w-28 flex items-center justify-center flex-1 h-full p-2 border border-blue-800 text-white shadow rounded-lg hover:bg-blue-50 hover:text-zinc-300"
                      >
                        <div class="relative">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-blue-800"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                          >
                            <path
                              d="M17.453,12.691V7.723 M17.453,12.691V7.723 M1.719,12.691V7.723 M18.281,12.691V7.723 M12.691,12.484H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,12.484,12.691,12.484M12.691,14.555H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,14.555,12.691,14.555 M12.691,12.484H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,12.484,12.691,12.484 M12.691,14.555H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,14.555,12.691,14.555 M12.691,14.555H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,14.555,12.691,14.555M12.691,12.484H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,12.484,12.691,12.484 M7.309,13.312h5.383c0.229,0,0.414-0.187,0.414-0.414s-0.186-0.414-0.414-0.414H7.309c-0.228,0-0.414,0.187-0.414,0.414S7.081,13.312,7.309,13.312 M12.691,14.555H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,14.555,12.691,14.555 M16.625,6.066h-1.449V3.168c0-0.228-0.186-0.414-0.414-0.414H5.238c-0.228,0-0.414,0.187-0.414,0.414v2.898H3.375c-0.913,0-1.656,0.743-1.656,1.656v4.969c0,0.913,0.743,1.656,1.656,1.656h1.449v2.484c0,0.228,0.187,0.414,0.414,0.414h9.523c0.229,0,0.414-0.187,0.414-0.414v-2.484h1.449c0.912,0,1.656-0.743,1.656-1.656V7.723C18.281,6.81,17.537,6.066,16.625,6.066 M5.652,3.582h8.695v2.484H5.652V3.582zM14.348,16.418H5.652v-4.969h8.695V16.418z M17.453,12.691c0,0.458-0.371,0.828-0.828,0.828h-1.449v-2.484c0-0.228-0.186-0.414-0.414-0.414H5.238c-0.228,0-0.414,0.186-0.414,0.414v2.484H3.375c-0.458,0-0.828-0.37-0.828-0.828V7.723c0-0.458,0.371-0.828,0.828-0.828h13.25c0.457,0,0.828,0.371,0.828,0.828V12.691z M7.309,13.312h5.383c0.229,0,0.414-0.187,0.414-0.414s-0.186-0.414-0.414-0.414H7.309c-0.228,0-0.414,0.187-0.414,0.414S7.081,13.312,7.309,13.312M7.309,15.383h5.383c0.229,0,0.414-0.187,0.414-0.414s-0.186-0.414-0.414-0.414H7.309c-0.228,0-0.414,0.187-0.414,0.414S7.081,15.383,7.309,15.383 M12.691,14.555H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,14.555,12.691,14.555 M12.691,12.484H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,12.484,12.691,12.484 M12.691,12.484H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,12.484,12.691,12.484M12.691,14.555H7.309c-0.228,0-0.414,0.187-0.414,0.414s0.187,0.414,0.414,0.414h5.383c0.229,0,0.414-0.187,0.414-0.414S12.92,14.555,12.691,14.555"
                            ></path>
                          </svg>
                        </div>
                      </div>
                    </div>
                  </div>
                </button>
                <small class="ml-2">Imprimir Reporte</small>
              </div>
            </div>
            <form @submit.prevent="saveInfoUser">
              <section
                class="bg-gray-200 dark:bg-slate-800 y-1 px-4 sm:p-6 md:py-10 md:px-8 rounded-lg sm:m-2 lg:m-3 md:m-4"
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
                      Información General de la Hermana
                    </p>
                  </div>
                  <div class="grid gap-4"></div>
                  <dl
                    class="mt-4 text-xs font-medium flex items-center row-start-2 sm:mt-1 sm:row-start-3 md:mt-2.5 lg:row-start-2"
                  >
                    <dt class="sr-only">Visto</dt>
                    <dd
                      class="text-indigo-600 flex items-center dark:text-indigo-400"
                    >
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
                        >0.00
                        <span class="text-slate-400 font-normal"
                          >(0)</span
                        ></span
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
                    La presente plantilla de información se relaciona a la
                    información de su usuario y perfil. Por favor, mantenga la
                    estructura de los datos solicitados y sus respectivos
                    formatos, de no ser así la información no podrá ser
                    ingresada correctamente.
                  </p>
                </div>
              </section>

              <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="shadow overflow-hidden sm:rounded-md">
                  <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                      <div class="col-span-6 sm:col-span-3">
                        <label
                          class="block text-sm font-medium text-gray-700"
                          htmlfor="grid-password"
                        >
                          Nombre de Usuario:
                        </label>
                        <small class="font-bold">Formato: No editable</small>
                        <jet-input-error :message="errors.username" />
                        <input
                          type="text"
                          placeholder="Nombre del usuario en el Sistema"
                          class="border-0 px-3 py-3 placeholder-blueGray-300 text-black bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                          @keydown.space.prevent
                          v-model="daughterForm.username"
                          readonly
                        />
                      </div>

                      <div class="col-span-6 sm:col-span-3">
                        <label class="block text-sm font-medium text-gray-700">
                          Correo Electrónico:
                        </label>

                        <jet-input-error :message="errors.email" />
                        <small class="font-bold"
                          >Formato: Único en el sistema</small
                        >
                        <input
                          type="email"
                          placeholder="micorreo@correo.com"
                          class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                          v-model="daughterForm.email"
                          title="Ingrese el un correo electrónico válido."
                          required
                        />
                      </div>

                      <div class="col-span-6 sm:col-span-2">
                        <label
                          class="block text-sm font-medium text-gray-700"
                          htmlfor="grid-password"
                        >
                          Nombres Completos:
                        </label>
                        <jet-input-error :message="errors.name" />
                        <small class="font-bold">Formato: Andrea Laura</small>
                        <input
                          type="text"
                          placeholder="Ejm: Lucas Andres"
                          class="border-0 px-3 py-3 placeholder-blueGray-300 text-black bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                          onkeydown="return /[a-z, ]/i.test(event.key)"
                          onblur="if (this.value == '') {this.value = '';}"
                          onfocus="if (this.value == '') {this.value = '';}"
                          maxlength="100"
                          v-model="daughterForm.name"
                        />
                      </div>

                      <div class="col-span-6 sm:col-span-2">
                        <label
                          class="block text-sm font-medium text-gray-700"
                          htmlfor="grid-password"
                        >
                          Apellidos Completos:
                        </label>

                        <jet-input-error :message="errors.lastname" />
                        <small class="font-bold">Formato: López Guerra</small>
                        <input
                          type="text"
                          placeholder="Ejm: Fuentes Ramos"
                          class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                          onkeydown="return /[a-z, ]/i.test(event.key)"
                          onblur="if (this.value == '') {this.value = '';}"
                          onfocus="if (this.value == '') {this.value = '';}"
                          maxlength="100"
                          v-model="daughterForm.lastname"
                        />
                      </div>

                      <div class="col-span-6 sm:col-span-2">
                        <label
                          class="block text-sm font-medium text-gray-700"
                          htmlfor="grid-password"
                        >
                          Nombres de Comunidad:
                        </label>
                        <jet-input-error :message="errors.fullnamecomm" />
                        <small>Opcional: Sor Jenito</small>
                        <input
                          type="text"
                          placeholder="Ejm: Lucas Andres"
                          class="border-0 px-3 py-3 placeholder-blueGray-300 text-black bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                          onkeydown="return /[a-z, ]/i.test(event.key)"
                          onblur="if (this.value == '') {this.value = '';}"
                          onfocus="if (this.value == '') {this.value = '';}"
                          maxlength="100"
                          v-model="daughterForm.fullnamecomm"
                        />
                      </div>

                      <div class="col-span-7 sm:col-span-2">
                        <label
                          class="block text-sm font-medium text-gray-700"
                          htmlfor="grid-password"
                        >
                          Fotografía de la Hermana:
                        </label>
                        <jet-input-error :message="errors.file" />

                        <small class="font-bold"
                          >Formato: JPG, PNG, JPEG.</small
                        >

                        <img
                          v-if="image && !url"
                          :src="image"
                          class="rounded-lg h-60 w-40 object-cover"
                        />
                        <img
                          v-if="url"
                          :src="url"
                          class="rounded-lg h-60 w-40 object-cover"
                        />
                        <img
                          v-if="!image && !url"
                          src="https://files-hdlc-frontend.s3.amazonaws.com/logo_daughter.png"
                          class="rounded-lg h-60 w-40 object-cover"
                        />

                        <progress
                          v-if="daughterForm.progress"
                          :value="daughterForm.progress.percentage"
                          max="100"
                        >
                          {{ daughterForm.progress.percentage }}%
                        </progress>
                      </div>
                    </div>
                  </div>
                  <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <input
                      class="text-sm text-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-500 file:text-white hover:file:bg-cyan-600"
                      type="file"
                      accept="image/png, image/gif, image/jpeg"
                      @input="daughterForm.file = $event.target.files[0]"
                      @change="onFileChange"
                    />
                    <jet-button class="ml-3"> Guardar </jet-button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
          <div class="border-t border-gray-200" />
        </div>
      </div>

      <!-- PUT FORM PROFILE -->
      <div class="mt-10 sm:mt-0">
        <div class="">
          <!-- <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium leading-6 text-gray-900">
                Información del Perfil de Hermana Actualizada
              </h3>
              <p class="mt-1 text-sm text-gray-600 text-justify">
                La información del perfil se relaciona a las fechas
                personalizadas a lo largo del tiempo en la compañía, es
                necesario mantener los formatos solicitados para que la
                información sea validada correctamente. Tenga en cuenta que la
                dirección será actualizada cuando se le asigne un nuevo cambio,
                si necesita cambiarla escoga correctamente los campos
                solicitados.
              </p>
            </div>
          </div> -->
          <div class=" " v-if="this.profileForm != null">
            <form @submit.prevent="saveUserProfile">
              <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <h3 class="text-lg font-medium leading-6 text-gray-900">
                    Información del Perfil de Hermana
                  </h3>
                  <br />
                  <div
                    class="col-span-6 sm:col-span-3 my-2"
                    v-if="this.allProvinces != null"
                  >
                    <div>
                      <label
                        class="block text-sm font-medium text-gray-700"
                        htmlfor="grid-password"
                      >
                        Provincia Nacimiento:
                      </label>
                      <div>
                        <multiselect
                          :searchable="true"
                          v-model="selectOneBt.selectedProvince"
                          :options="this.allProvinces"
                          :close-on-select="true"
                          :clear-on-select="false"
                          mode="tags"
                          label="name"
                          @search-change="onSearchProvincesChangeBt"
                          @select="onSelectedProvinceBt"
                          track-by="name"
                          placeholder="Buscar provincia"
                        >
                        </multiselect>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-6 sm:col-span-2 my-2">
                    <div>
                      <label
                        class="block text-sm font-medium text-gray-700"
                        htmlfor="grid-password"
                      >
                        Cantón Nacimiento:
                      </label>
                      <div>
                        <multiselect
                          :searchable="true"
                          v-model="selectTwoBt.selectedCanton"
                          :options="selectTwoBt.options"
                          :close-on-select="true"
                          :clear-on-select="false"
                          mode="tags"
                          label="name"
                          @select="onSelectedCantonBt"
                          @search-change="onSearchCantonChangeBt"
                          track-by="name"
                          placeholder="Buscar cantón"
                        >
                        </multiselect>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-6 sm:col-span-2 my-2">
                    <div>
                      <label
                        class="block text-sm font-medium text-gray-700"
                        htmlfor="grid-password"
                      >
                        Parroquia Nacimiento:
                      </label>
                      <div>
                        <multiselect
                          :searchable="true"
                          v-model="selectThreeBt.selectedParish"
                          :options="selectThreeBt.options"
                          :close-on-select="true"
                          :clear-on-select="false"
                          label="name"
                          @select="onSelectedParishBt"
                          @search-change="onSearchParishChangeBt"
                          track-by="name"
                          placeholder="Buscar parroquia"
                        >
                        </multiselect>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-6 sm:col-span-2">
                    <div>
                      <label
                        for="address_bt"
                        class="block text-sm font-medium text-gray-700"
                      >
                        Lugar de Nacimiento Observaciones:
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.address_bt"
                      >
                        {{ $page.props.errors.address_bt }}
                      </p>
                      <small class="font-bold"
                        >Formato: Ingrese la dirección máximo 100
                        caracteres.</small
                      >
                      <div class="mb-1">
                        <textarea
                          id="address_bt"
                          name="address_bt"
                          rows="1"
                          class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 mb-2 block w-full sm:text-sm border border-gray-300 rounded-md"
                          v-model="profileForm.address_bt"
                          placeholder="Observaciones lugar de nacimiento.."
                          :maxlength="100"
                          required
                        />
                      </div>
                    </div>
                  </div>
                  <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-2">
                      <label
                        class="block text-sm font-medium text-black"
                        htmlfor="grid-password"
                      >
                        Cédula de Identidad
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.identity_card"
                      >
                        {{ $page.props.errors.identity_card }}
                      </p>
                      <p
                        class="text-red-400 text-sm"
                        v-show="
                          !validateIdentityCard ||
                          profileForm.identity_card == ''
                        "
                      >
                        Ingresar cédula o RUC válido
                      </p>
                      <small class="font-bold"
                        >Formato: Cédula Ecuatoriana</small
                      >

                      <input
                        type="text"
                        minLength="10"
                        maxlength="13"
                        placeholder="0102211274 ó 0102211274001"
                        pattern="[+-]?\d+(?:[.,]\d+)?"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="profileForm.identity_card"
                        required
                      />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                      <label class="block text-sm font-medium text-black">
                        Carnet IESS
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.iess_card"
                      >
                        {{ $page.props.errors.iess_card }}
                      </p>
                      <small class="font-bold">Formato: Carnet IESS</small>
                      <input
                        type="text"
                        minLength="1"
                        maxlength="30"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="profileForm.iess_card"
                      />
                    </div>

                    <div class="col-span-6 sm:col-span-2">
                      <label class="block text-sm font-medium text-black">
                        Licencia de Conducir
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.driver_license"
                      >
                        {{ $page.props.errors.driver_license }}
                      </p>
                      <small class="font-bold"
                        >Formato: Licencia de Conducir</small
                      >

                      <input
                        type="text"
                        minLength="1"
                        maxlength="50"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="profileForm.driver_license"
                      />
                    </div>

                    <div class="col-span-6 sm:col-span-2">
                      <label
                        class="block text-sm font-medium text-black"
                        htmlfor="grid-password"
                      >
                        Fecha de Nacimiento
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.date_birth"
                      >
                        {{ $page.props.errors.date_birth }}
                      </p>
                      <small class="font-bold">Formato: Necesario</small>
                      <Datepicker
                        autoApply
                        v-model="profileForm.date_birth"
                        :format="format"
                        required
                        :year-range="[1800, this.year]"
                      />
                    </div>

                    <div class="col-span-6 sm:col-span-2">
                      <label
                        class="block text-sm font-medium text-black"
                        htmlfor="grid-password"
                      >
                        Fecha de Vocación
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.date_vocation"
                      >
                        {{ $page.props.errors.date_vocation }}
                      </p>
                      <small class="font-bold">Formato: Necesario</small>
                      <Datepicker
                        autoApply
                        v-model="profileForm.date_vocation"
                        :format="format"
                        :year-range="[1800, this.year]"
                      />
                    </div>

                    <div class="col-span-8 sm:col-span-2">
                      <label
                        class="block text-sm font-medium text-black"
                        htmlfor="grid-password"
                      >
                        Fecha de Admisión
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.date_vocation"
                      >
                        {{ $page.props.errors.date_vocation }}
                      </p>
                      <small class="font-bold">Formato: Opcional</small>
                      <Datepicker
                        v-model="profileForm.date_vocation"
                        :format="format"
                        autoApply
                        readonly
                        :year-range="[1800, this.year]"
                      />
                    </div>

                    <div class="col-span-8 sm:col-span-2">
                      <label class="block text-sm font-medium text-black">
                        Fecha de Envío
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.date_send"
                      >
                        {{ $page.props.errors.date_send }}
                      </p>
                      <small class="font-bold">Formato: Opcional</small>
                      <Datepicker
                        autoApply
                        v-model="profileForm.date_send"
                        :format="format"
                        :year-range="[1800, this.year]"
                      />
                    </div>

                    <div class="col-span-8 sm:col-span-2">
                      <label class="block text-sm font-medium text-black">
                        Fecha de Votos
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.date_vote"
                      >
                        {{ $page.props.errors.date_vote }}
                      </p>
                      <small class="font-bold">Formato: Opcional</small>
                      <Datepicker
                        autoApply
                        v-model="profileForm.date_vote"
                        :format="format"
                        :year-range="[1800, this.year]"
                      />
                    </div>
                    <div class="col-span-8 sm:col-span-2">
                      <label
                        class="block text-sm font-medium text-black"
                        htmlfor="grid-password"
                      >
                        Celular
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.cellphone"
                      >
                        {{ $page.props.errors.cellphone }}
                      </p>
                      <small class="font-bold">Formato: 0997643146</small>
                      <input
                        type="text"
                        minLength="10"
                        maxlength="10"
                        pattern="^\d{10}$"
                        title="Ingrese un número de celular con un formato válido, máximo 10digitos."
                        placeholder="0997643146"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="profileForm.cellphone"
                        required
                      />
                    </div>
                    <div class="col-span-8 sm:col-span-2">
                      <label
                        class="block text-sm font-medium text-black"
                        htmlfor="grid-password"
                      >
                        Teléfono Convencional
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.phone"
                      >
                        {{ $page.props.errors.phone }}
                      </p>
                      <small class="font-bold">Formato: 022400111</small>

                      <input
                        type="text"
                        minLength="9"
                        maxlength="9"
                        pattern="^\d{9}$"
                        title="Ingrese un número de telf. con un formato válido, máximo 9 digitos."
                        placeholder="022400111"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="profileForm.phone"
                      />
                    </div>
                    <div
                      class="col-span-6 sm:col-span-2"
                      v-if="profileForm.date_retirement != null"
                    >
                      <label
                        class="block text-sm font-medium text-black"
                        htmlfor="grid-password"
                      >
                        Fecha de Jubilación
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.date_retirement"
                      >
                        {{ $page.props.errors.date_retirement }}
                      </p>
                      <small class="font-bold">Formato: Necesario</small>
                      <Datepicker
                        autoApply
                        v-model="profileForm.date_retirement"
                        :format="format"
                        readonly
                        :year-range="[1800, this.year]"
                      />
                    </div>

                    <div class="col-span-6 sm:col-span-6">
                      <label
                        for="address"
                        class="block text-sm font-medium text-black"
                      >
                        Dirección Actual:
                      </label>

                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.address"
                      >
                        {{ $page.props.errors.address }}
                      </p>
                      <small class="font-bold"
                        >Formato: Ingrese la dirección máximo 100
                        caracteres.</small
                      >
                      <div class="mb-1">
                        <textarea
                          id="address"
                          name="address"
                          rows="1"
                          class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 mb-2 block w-full sm:text-sm border border-gray-300 rounded-md"
                          v-model="profileForm.address"
                          placeholder="Agregar la dirección actual.."
                          :maxlength="100"
                        />
                      </div>
                    </div>
                    <div
                      class="col-span-6 sm:col-span-3"
                      v-if="this.allProvinces != null"
                    >
                      <div :class="{ invalid: isInvalidProvince }">
                        <label
                          class="block text-sm font-medium text-black"
                          htmlfor="grid-password"
                        >
                          Provincia:
                        </label>
                        <div>
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
                    <div class="col-span-6 sm:col-span-3">
                      <div :class="{ invalid: isInvalidCanton }">
                        <label
                          class="block text-sm font-medium text-black"
                          htmlfor="grid-password"
                        >
                          Cantón
                        </label>
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
                        <p
                          class="text-red-400 text-sm"
                          v-show="isInvalidCanton"
                        >
                          Obligatorio
                        </p>
                      </div>
                    </div>
                    <div class="col-span-6 sm:col-span-6">
                      <div :class="{ invalid: isInvalidParish }">
                        <label
                          class="block text-sm font-medium text-black"
                          htmlfor="grid-password"
                        >
                          Parroquia:
                        </label>
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
                        <p
                          class="text-red-400 text-sm"
                          v-show="isInvalidParish"
                        >
                          Obligatorio
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <jet-button class="ml-3"> Guardar </jet-button>
                </div>
              </div>
            </form>
          </div>
          <div v-else class="content-center mt-2">
            <jet-button-success
              @click="confirmationProfileCreate()"
              class="block mx-2 p-5 leading-normal"
              >¿Desea ingresar la información relacionada a su perfil
              personal?</jet-button-success
            >
          </div>
        </div>
      </div>

      <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
          <div class="border-t border-gray-200" />
        </div>
      </div>

      <div class="mt-10 sm:mt-0">
        <!-- <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <h3 class="text-lg font-medium leading-6 text-gray-900">
                Información Familiar
              </h3>
              <p class="mt-1 text-sm text-gray-600 text-justify">
                La información adjunta se relaciona con los datos de contacto en
                donde se hospeda la Hermana en los días que solicita permisos.
                Deberá ingresar la información con los formatos solicitados.
              </p>
            </div>
          </div>


        </div> -->

        <div
          class="mt-5 md:mt-0 md:col-span-2"
          v-if="this.infoFamilyForm != null"
        >
          <form @submit.prevent="saveProfileInfoFamily">
            <div class="shadow overflow-hidden sm:rounded-md">
              <div class="px-4 py-5 bg-white sm:p-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                  Información Familiar
                </h3>
                <br />
                <!-- Info Family -->
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mr-2">
                      Nombres Completos del Padre:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.names_father"
                    >
                      {{ $page.props.errors.names_father }}
                    </p>
                    <small class="font-bold"
                      >Formato: José Fernando García García</small
                    >
                    <div class="mt-1 rounded-md mx-2">
                      <input
                        type="text"
                        placeholder="Ejm: Fuentes Ramos"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        onkeydown="return /[a-z, ]/i.test(event.key)"
                        onblur="if (this.value == '') {this.value = '';}"
                        onfocus="if (this.value == '') {this.value = '';}"
                        maxlength="100"
                        v-model="infoFamilyForm.names_father"
                        required
                      />
                    </div>
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">
                      Nombres Completos de la Madre:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.names_mother"
                    >
                      {{ $page.props.errors.names_mother }}
                    </p>
                    <small class="font-bold"
                      >Formato: Andrea Laura González González
                    </small>
                    <div class="mt-1 rounded-md mx-2">
                      <input
                        type="text"
                        placeholder="Ejm: Fuentes Ramos"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        onkeydown="return /[a-z, ]/i.test(event.key)"
                        onblur="if (this.value == '') {this.value = '';}"
                        onfocus="if (this.value == '') {this.value = '';}"
                        maxlength="100"
                        v-model="infoFamilyForm.names_mother"
                        required
                      />
                    </div>
                  </div>

                  <div class="col-span-6 sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">
                      Número de Hermanas:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.nr_sisters"
                    >
                      {{ $page.props.errors.nr_sisters }}
                    </p>
                    <small class="font-bold">Formato: 0 - 20</small>
                    <div class="mt-1 rounded-md mx-2">
                      <input
                        type="number"
                        class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                        placeholder="Ingrese el número"
                        min="0"
                        max="20"
                        v-model="infoFamilyForm.nr_sisters"
                        required
                      />
                    </div>
                  </div>

                  <div class="col-span-8 sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">
                      Número de Hermanos:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.nr_brothers"
                    >
                      {{ $page.props.errors.nr_brothers }}
                    </p>
                    <small class="font-bold">Formato: 0 - 20</small>
                    <div class="mt-1 rounded-md mx-2">
                      <input
                        type="number"
                        class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                        placeholder="Ingrese el número"
                        min="0"
                        max="20"
                        v-model="infoFamilyForm.nr_brothers"
                        required
                      />
                    </div>
                  </div>

                  <div class="col-span-8 sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">
                      Lugar en la Familia:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.place_of_family"
                    >
                      {{ $page.props.errors.place_of_family }}
                    </p>
                    <small class="font-bold">Formato: Orden Cronológico</small>
                    <div class="mt-1 rounded-md mx-2">
                      <input
                        type="number"
                        class="focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                        placeholder="Ingrese el número"
                        min="0"
                        max="20"
                        v-model="infoFamilyForm.place_of_family"
                        required
                      />
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Info Break -->
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mr-2">
                      Nombres Completos del Familiar:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.name_family_member"
                    >
                      {{ $page.props.errors.name_family_member }}
                    </p>
                    <small class="font-bold"
                      >Formato: Andrea González López
                    </small>
                    <div class="mt-1 rounded-md mx-2">
                      <input
                        type="text"
                        placeholder="Ejm: Fuentes Ramos"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        onkeydown="return /[a-z, ]/i.test(event.key)"
                        onblur="if (this.value == '') {this.value = '';}"
                        onfocus="if (this.value == '') {this.value = '';}"
                        maxlength="100"
                        v-model="infoFamilyForm.name_family_member"
                        required
                      />
                    </div>
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">
                      Relación del Familiar con la Hermana:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.relation"
                    >
                      {{ $page.props.errors.relation }}
                    </p>
                    <small class="font-bold"
                      >Formato: Hermano, Primo, etc.
                    </small>
                    <div class="mt-1 rounded-md mx-2">
                      <input
                        type="text"
                        placeholder="Ejm: Primo, Hermano, etc"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        onkeydown="return /[a-z, ]/i.test(event.key)"
                        onblur="if (this.value == '') {this.value = '';}"
                        onfocus="if (this.value == '') {this.value = '';}"
                        maxlength="100"
                        v-model="infoFamilyForm.relation"
                        required
                      />
                    </div>
                  </div>

                  <div class="col-span-6 sm:col-span-2">
                    <label class="block text-sm font-medium text-black">
                      Celular:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.cellphone"
                    >
                      {{ $page.props.errors.cellphone }}
                    </p>
                    <small class="font-bold">Formato: 0997643146</small>
                    <div class="mx-2 mt-1">
                      <input
                        type="text"
                        minLength="10"
                        maxlength="10"
                        pattern="^\d{10}$"
                        title="Ingrese un número de celular con un formato válido, máximo 10digitos."
                        placeholder="0997643146"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="infoFamilyForm.cellphone"
                        required
                      />
                    </div>
                  </div>

                  <div class="col-span-8 sm:col-span-2">
                    <label
                      class="block text-sm font-medium text-black"
                      htmlfor="grid-password"
                    >
                      Teléfono:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.phone"
                    >
                      {{ $page.props.errors.phone }}
                    </p>
                    <small class="font-bold">Formato: 022400111</small>
                    <div class="mx-2 mt-1">
                      <input
                        type="text"
                        minLength="9"
                        maxlength="9"
                        pattern="^\d{9}$"
                        title="Ingrese un número de celular con un formato válido, máximo 9 digitos."
                        placeholder="022400111"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="infoFamilyForm.phone"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <jet-button class="ml-3"> Guardar </jet-button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
          <div class="border-t border-gray-200" />
        </div>
      </div>
    </div>
    <!-- POST Data Form-->
    <jet-dialog-modal
      :max-width="'input-md'"
      :show="profileBeingCreated"
      @close="profileBeingCreated == null"
    >
      <template #title> Datos para la Creación del Perfil</template>
      <template #content>
        <div>
          <div class="mt-5">
            <div class="shadow overflow-hidden sm:rounded-md">
              <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-2">
                    <label
                      class="block text-sm font-medium text-black"
                      htmlfor="grid-password"
                    >
                      Cédula de Identidad
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.identity_card"
                    >
                      {{ $page.props.errors.identity_card }}
                    </p>
                    <p
                      class="text-red-400 text-sm"
                      v-if="
                        !validateIdentityCardCreate ||
                        createProfileForm.identity_card == ''
                      "
                    >
                      Ingresar cédula o RUC válido
                    </p>

                    <small class="font-bold">Formato: Cédula Ecuatoriana</small>

                    <input
                      type="text"
                      minLength="10"
                      maxlength="13"
                      placeholder="0102211274 ó 0102211274001"
                      pattern="[+-]?\d+(?:[.,]\d+)?"
                      class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      v-model="createProfileForm.identity_card"
                      required
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-2">
                    <label
                      class="block text-sm font-medium text-black"
                      htmlfor="grid-password"
                    >
                      Fecha de Nacimiento
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.date_birth"
                    >
                      {{ $page.props.errors.date_birth }}
                    </p>
                    <small class="font-bold">Formato: Necesario</small>
                    <Datepicker
                      autoApply
                      v-model="createProfileForm.date_birth"
                      :format="format"
                      required
                      :year-range="[1800, this.year]"
                    />
                  </div>
                  <br />
                  <div class="col-span-6 sm:col-span-2">
                    <div>
                      <label
                        class="block text-sm font-medium text-gray-700"
                        htmlfor="grid-password"
                      >
                        Provincia Nacimiento:
                      </label>
                      <div>
                        <multiselect
                          :searchable="true"
                          v-model="selectOneBt.selectedProvince"
                          :options="this.allProvinces"
                          :close-on-select="true"
                          :clear-on-select="false"
                          mode="tags"
                          label="name"
                          @search-change="onSearchProvincesChangeBt"
                          @select="onSelectedProvinceBt"
                          track-by="name"
                          placeholder="Buscar provincia"
                        >
                        </multiselect>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-6 sm:col-span-2">
                    <div>
                      <label
                        class="block text-sm font-medium text-gray-700"
                        htmlfor="grid-password"
                      >
                        Cantón Nacimiento:
                      </label>
                      <div>
                        <multiselect
                          :searchable="true"
                          v-model="selectTwoBt.selectedCanton"
                          :options="selectTwoBt.options"
                          :close-on-select="true"
                          :clear-on-select="false"
                          mode="tags"
                          label="name"
                          @select="onSelectedCantonBt"
                          @search-change="onSearchCantonChangeBt"
                          track-by="name"
                          placeholder="Buscar cantón"
                        >
                        </multiselect>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-6 sm:col-span-2">
                    <div>
                      <label
                        class="block text-sm font-medium text-gray-700"
                        htmlfor="grid-password"
                      >
                        Parroquia Nacimiento:
                      </label>
                      <div>
                        <multiselect
                          :searchable="true"
                          v-model="selectThreeBt.selectedParish"
                          :options="selectThreeBt.options"
                          :close-on-select="true"
                          :clear-on-select="false"
                          label="name"
                          @select="onSelectedParishBt"
                          @search-change="onSearchParishChangeBt"
                          track-by="name"
                          placeholder="Buscar parroquia"
                        >
                        </multiselect>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-6 sm:col-span-2">
                    <div>
                      <label
                        for="address_bt"
                        class="block text-sm font-medium text-gray-700"
                      >
                        Lugar de Nacimiento Observaciones:
                      </label>
                      <p
                        class="text-red-400 text-sm"
                        v-show="$page.props.errors.address_bt"
                      >
                        {{ $page.props.errors.address_bt }}
                      </p>
                      <small class="font-bold"
                        >Formato: Ingrese la dirección máximo 100
                        caracteres.</small
                      >
                      <div class="mb-1">
                        <textarea
                          id="address_bt"
                          name="address_bt"
                          rows="1"
                          class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 mb-2 block w-full sm:text-sm border border-gray-300 rounded-md"
                          v-model="createProfileForm.address_bt"
                          placeholder="Agregar la dirección actual.."
                          :maxlength="100"
                          required
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-span-6 sm:col-span-2">
                    <label
                      class="block text-sm font-medium text-black"
                      htmlfor="grid-password"
                    >
                      Fecha de Vocación
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.date_vocation"
                    >
                      {{ $page.props.errors.date_vocation }}
                    </p>
                    <small class="font-bold">Formato: Necesario</small>
                    <Datepicker
                      autoApply
                      v-model="createProfileForm.date_vocation"
                      :format="format"
                      :year-range="[1800, this.year]"
                    />
                  </div>

                  <div class="col-span-8 sm:col-span-2">
                    <label
                      class="block text-sm font-medium text-black"
                      htmlfor="grid-password"
                    >
                      Fecha de Admisión
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.date_vocation"
                    >
                      {{ $page.props.errors.date_vocation }}
                    </p>
                    <small class="font-bold">Formato: Opcional</small>
                    <Datepicker
                      v-model="createProfileForm.date_vocation"
                      :format="format"
                      autoApply
                      readonly
                      :year-range="[1800, this.year]"
                    />
                  </div>

                  <div class="col-span-8 sm:col-span-2">
                    <label class="block text-sm font-medium text-black">
                      Fecha de Envío
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.date_send"
                    >
                      {{ $page.props.errors.date_send }}
                    </p>
                    <small class="font-bold">Formato: Opcional</small>
                    <Datepicker
                      autoApply
                      v-model="createProfileForm.date_send"
                      :format="format"
                      :year-range="[1800, this.year]"
                    />
                  </div>

                  <div class="col-span-8 sm:col-span-2">
                    <label class="block text-sm font-medium text-black">
                      Fecha de Votos
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.date_vote"
                    >
                      {{ $page.props.errors.date_vote }}
                    </p>
                    <small class="font-bold">Formato: Opcional</small>
                    <Datepicker
                      autoApply
                      v-model="createProfileForm.date_vote"
                      :format="format"
                      :year-range="[1800, this.year]"
                    />
                  </div>
                  <div class="col-span-8 sm:col-span-2">
                    <label
                      class="block text-sm font-medium text-black"
                      htmlfor="grid-password"
                    >
                      Celular
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.cellphone"
                    >
                      {{ $page.props.errors.cellphone }}
                    </p>
                    <small class="font-bold">Formato: 0997643146</small>
                    <input
                      type="text"
                      minLength="10"
                      maxlength="10"
                      pattern="^\d{10}$"
                      title="Ingrese un número de celular con un formato válido, máximo 10digitos."
                      placeholder="0997643146"
                      class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      v-model="createProfileForm.cellphone"
                      required
                    />
                  </div>
                  <div class="col-span-8 sm:col-span-2">
                    <label
                      class="block text-sm font-medium text-black"
                      htmlfor="grid-password"
                    >
                      Teléfono Convencional
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.phone"
                    >
                      {{ $page.props.errors.phone }}
                    </p>
                    <small class="font-bold">Formato: 022400111</small>

                    <input
                      type="text"
                      minLength="9"
                      maxlength="9"
                      pattern="^\d{9}$"
                      title="Ingrese un número de telf. con un formato válido, máximo 9 digitos."
                      placeholder="022400111"
                      class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      v-model="createProfileForm.phone"
                    />
                  </div>

                  <div class="col-span-6 sm:col-span-6">
                    <label
                      for="address"
                      class="block text-sm font-medium text-black"
                    >
                      Dirección Actual:
                    </label>

                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.address"
                    >
                      {{ $page.props.errors.address }}
                    </p>
                    <small class="font-bold"
                      >Formato: Ingrese la dirección máximo 100
                      caracteres.</small
                    >
                    <div class="mb-1">
                      <textarea
                        id="address"
                        name="address"
                        rows="1"
                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 mb-2 block w-full sm:text-sm border border-gray-300 rounded-md"
                        v-model="createProfileForm.address"
                        placeholder="Agregar la dirección actual.."
                        :maxlength="100"
                      />
                    </div>
                  </div>
                  <div
                    class="col-span-6 sm:col-span-3"
                    v-if="this.allProvinces != null"
                  >
                    <div :class="{ invalid: isInvalidProvince }">
                      <label
                        class="block text-sm font-medium text-black"
                        htmlfor="grid-password"
                      >
                        Provincia:
                      </label>
                      <div>
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
                  <div class="col-span-6 sm:col-span-3">
                    <div :class="{ invalid: isInvalidCanton }">
                      <label
                        class="block text-sm font-medium text-black"
                        htmlfor="grid-password"
                      >
                        Cantón
                      </label>
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
                      <p class="text-red-400 text-sm" v-show="isInvalidCanton">
                        Obligatorio
                      </p>
                    </div>
                  </div>
                  <div class="col-span-6 sm:col-span-6">
                    <div :class="{ invalid: isInvalidParish }">
                      <label
                        class="block text-sm font-medium text-black"
                        htmlfor="grid-password"
                      >
                        Parroquia:
                      </label>
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
                      <p class="text-red-400 text-sm" v-show="isInvalidParish">
                        Obligatorio
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="this.profileBeingCreated = null">
          Cancelar
        </jet-secondary-button>

        <jet-button-success class="ml-3" @click="createProfile">
          Crear
        </jet-button-success>
      </template>
    </jet-dialog-modal>

    <jet-dialog-modal
      :show="managingReportsFor"
      @close="managingReportsFor = null"
    >
      <template #title>
        <div class="text-md">Opciones del Reporte del Perfil de la Hermana</div>
      </template>

      <template #content>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <label class="flex items-center">
            <input
              class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"
              type="checkbox"
              :value="1"
              v-model="options"
            />
            <span class="ml-2 text-sm text-gray-600">Salud Actual</span>
          </label>
          <label class="flex items-center">
            <input
              class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"
              type="checkbox"
              :value="2"
              v-model="options"
            />
            <span class="ml-2 text-sm text-gray-600">Récord Académico</span>
          </label>
          <label class="flex items-center">
            <input
              class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50"
              type="checkbox"
              :value="3"
              v-model="options"
            />
            <span class="ml-2 text-sm text-gray-600">Sacramentos</span>
          </label>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button
          @click="
            managingReportsFor = null;
            options = [];
          "
        >
          Cerrar
        </jet-secondary-button>

        <a
          class="mx-2 bg-blue-600 text-white text-sm leading-6 font-medium py-2 px-3 rounded-lg"
          target="_blank"
          :href="
            this.route(`daughter.report.profile`, {
              options: this.options,
            })
          "
          >GUARDAR</a
        >
      </template>
    </jet-dialog-modal>
  </app-layout>
</template>

<script>
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import Operation from "@/Components/Daughter/Operation";
import SearchFilter from "@/Components/SearchFilter";
import { pickBy, throttle, mapValues } from "lodash";
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import TextInput from "@/Components/TextInput";
import Datepicker from "vue3-date-time-picker";
import Dropdown from "@/Components/Dropdown";
import { Inertia } from "@inertiajs/inertia";
import JetInput from "@/Jetstream/Input.vue";
import JetButton from "@/Jetstream/Button";
import Alert from "@/Components/Alert";
import Icon from "@/Components/Icon";
import { range } from "moment-range";
import moment from "moment";
import { ref } from "vue";

export default {
  props: {
    daughter: null,
    errors: null,
    image: null,
    address: Object,
    provinces: {
      type: Array,
    },
  },

  setup() {
    const formatSet = "YYYY-MM-DD";
    let date = new Date();
    const year = new Date().getFullYear();

    var format = (date) => {
      return moment(date).format(formatSet);
    };

    const form = useForm({
      province_id: null,
      canton_id: null,
      parish_id: null,
      political_division_id: null,
      province_id_bt: null,
      canton_id_bt: null,
      parish_id_bt: null,
      political_division_id_bt: null,
    });

    return {
      date,
      year,
      format,
      form,
    };
  },

  data() {
    return {
      daughterForm: this.$inertia.form({
        id: this.daughter.id,
        name: this.daughter.name,
        username: this.daughter.username,
        lastname: this.daughter.lastname,
        fullnamecomm: this.daughter.fullnamecomm,
        email: this.daughter.email,
        file: null,
      }),

      profileForm: null,

      infoFamilyForm: null,

      createProfileForm: null,

      profileBeingCreated: null,

      photoPreview: null,

      url: null,

      allProvinces: null,

      selectOne: {
        selectedProvince: undefined,
        value: 0,
        options: {
          type: Array,
          default: () => [],
        },
        loading: false,
        multiSelectUser: null,
        vSelectUser: null,
      },

      selectTwo: {
        selectedCanton: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectCanton: null,
        vSelectCanton: null,
      },

      selectThree: {
        selectedParish: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectParish: null,
        vSelectParish: null,
      },

      selectOneBt: {
        selectedProvince: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: {
          type: Array,
          default: () => [],
        },
        loading: false,
        multiSelectUser: null,
        vSelectUser: null,
      },

      selectTwoBt: {
        selectedCanton: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectCanton: null,
        vSelectCanton: null,
      },

      selectThreeBt: {
        selectedParish: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectParish: null,
        vSelectParish: null,
      },

      managingReportsFor: null,

      options: [],
    };
  },
  watch: {
    "selectOne.selectedProvince": function () {
      if (this.selectOne.selectedProvince === null) {
        this.selectTwo.selectedCanton = null;
        this.selectThree.selectedParish = null;
        this.selectTwo.options = [];
        this.selectThree.options = [];
        this.form.province_id = null;
        this.form.canton_id = null;
        this.form.parish_id = null;
        this.form.political_division_id = null;
      }
    },

    "selectTwo.selectedCanton": function () {
      if (this.selectTwo.selectedCanton === null) {
        this.selectThree.selectedParish = null;
        this.selectThree.options = [];
        this.form.canton_id = null;
        this.form.parish_id = null;
        this.form.political_division_id = null;
      }
    },

    "selectThree.selectedParish": function () {
      if (this.selectThree.selectedParish === null) {
        this.form.parish_id = null;
        this.form.political_division_id = null;
      }
    },

    "selectOneBt.selectedProvince": function () {
      if (this.selectOneBt.selectedProvince === null) {
        this.selectTwoBt.selectedCanton = null;
        this.selectThreeBt.selectedParish = null;
        this.selectTwoBt.options = [];
        this.selectThreeBt.options = [];
        this.form.province_id_bt = null;
        this.form.canton_id_bt = null;
        this.form.parish_id_bt = null;
        this.form.political_division_id_bt = null;
        this.profileForm.political_division_id_bt = null;
      }
    },

    "selectTwoBt.selectedCanton": function () {
      if (this.selectTwoBt.selectedCanton === null) {
        this.selectThreeBt.selectedParish = null;
        this.selectThreeBt.options = [];
        this.form.canton_id_bt = null;
        this.form.parish_id_bt = null;
        this.form.political_division_id_bt = null;
        this.profileForm.political_division_id_bt = null;
      }
    },

    "selectThreeBt.selectedParish": function () {
      if (this.selectThreeBt.selectedParish === null) {
        this.form.parish_id_bt = null;
        this.form.political_division_id_bt = null;
        this.profileForm.political_division_id_bt = null;
      }
    },
  },

  mounted() {
    this.loadInfoProfile;
    axios.get(this.route("daughter.address.province")).then((response) => {
      this.allProvinces = response.data;
    });
  },

  components: {
    Datepicker,
    AppLayout,
    moment,
    range,
    JetDialogModal,
    JetDangerButton,
    JetInput,
    JetInputError,
    JetButtonSuccess,
    JetButton,
    JetSecondaryButton,
    TextInput,
    Alert,
    SearchFilter,
    Icon,
    Dropdown,
    Operation,
    ref,
  },

  methods: {
    formatDate(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
      }
      return null;
    },

    formatShowDate(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD");
      }
      return null;
    },

    onFileChange(e) {
      const file = e.target.files[0];
      this.url = URL.createObjectURL(file);
    },

    confirmationProfileCreate() {
      this.createProfileForm = this.$inertia.form({
        identity_card: null,
        iess_card: null,
        driver_license: null,
        date_birth: null,
        date_vocation: null,
        date_send: null,
        date_vote: null,
        cellphone: null,
        phone: null,
        address: null,
        address_bt: null,
        political_division_id: null,
        political_division_id_bt: null,
      });
      this.profileBeingCreated = this.createProfileForm;
    },

    createProfile() {
      this.createProfileForm.date_birth = this.formatDate(
        this.createProfileForm.date_birth
      );

      this.createProfileForm.date_vocation = this.formatDate(
        this.createProfileForm.date_vocation
      );

      this.createProfileForm.date_send = this.formatDate(
        this.createProfileForm.date_send
      );

      this.createProfileForm.date_vote = this.formatDate(
        this.createProfileForm.date_vote
      );

      let dataaddresbt = null;

      if (
        this.form.province_id_bt !== null &&
        this.form.canton_id_bt === null &&
        this.form.parish_id_bt === null
      ) {
        dataaddresbt = this.form.province_id_bt;
      }

      if (
        this.form.province_id_bt !== null &&
        this.form.canton_id_bt !== null &&
        this.form.parish_id_bt === null
      ) {
        dataaddresbt = this.form.canton_id_bt;
      }

      if (
        this.form.province_id_bt !== null &&
        this.form.canton_id_bt !== null &&
        this.form.parish_id_bt !== null
      ) {
        dataaddresbt = this.form.parish_id_bt;
      }
      this.createProfileForm.political_division_id_bt = dataaddresbt;

      this.createProfileForm.political_division_id =
        this.form.political_division_id;

      if (
        this.isInvalidProvince == false &&
        this.isInvalidCanton == false &&
        this.isInvalidParish == false &&
        this.validateIdentityCardCreate == true
      ) {
        this.createProfileForm.post(
          route("daughter.profile.store", { id: this.daughterForm.id }),
          {
            preserveScroll: true,
            onSuccess: () => {
              setTimeout(() => {
                this.loadInfoProfile;
                this.profileBeingCreated = null;
                this.createProfileForm.reset();
              }, 1);
            },
          }
        );
      }
    },

    saveInfoUser() {
      Inertia.post(
        route(`daughter.user.update`, {
          id: this.daughterForm.id,
        }),
        {
          _method: "put",
          name: this.daughterForm.name,
          fullnamecomm: this.daughterForm.fullnamecomm,
          lastname: this.daughterForm.lastname,
          email: this.daughterForm.email,
          file: this.daughterForm.file,
        },
        {
          preserveScroll: true,
        }
      );
    },

    saveUserProfile() {
      this.profileForm.date_birth = this.formatDate(
        this.profileForm.date_birth
      );
      this.profileForm.date_vocation = this.formatDate(
        this.profileForm.date_vocation
      );
      this.profileForm.date_send = this.formatDate(this.profileForm.date_send);
      this.profileForm.date_vote = this.formatDate(this.profileForm.date_vote);
      if (
        this.isInvalidProvince == false &&
        this.isInvalidCanton == false &&
        this.isInvalidParish == false &&
        this.validateIdentityCard == true
      ) {
        Inertia.put(
          route("daughter.profile.update", {
            id: this.daughterForm.id,
          }),
          this.profileForm,
          {
            preserveScroll: true,
          }
        );
      }
    },

    saveProfileInfoFamily() {
      this.infoFamilyForm.post(
        this.route("daughter.infofamily.store", { id: this.daughterForm.id }),
        {
          preserveScroll: true,
          onSuccess: () => {
            setTimeout(() => {
              this.infoFamilyForm.reset();
            }, 1);
          },
        }
      );
    },

    async status() {
      let response = await axios.get(
        this.route("daughter.address.actual-address", {
          actual_parish: this.daughter.profile.address["political_division_id"],
        })
      );
      return response.data;
    },

    async status_bt() {
      if (this.daughter.profile.origin["political_division_id"]) {
        let response = await axios.get(
          this.route("daughter.address.actual-address-bt", {
            actual_ubication:
              this.daughter.profile.origin["political_division_id"],
          })
        );
        return response.data;
      }
    },

    onSearchProvincesChange(term) {},

    onSelectedProvince(province) {
      this.form.province_id = province.id;
      this.form.canton_id = null;
      this.form.parish_id = null;
      this.form.political_division_id = null;
      this.selectTwo.selectedCanton = undefined;
      this.selectThree.selectedParish = undefined;
      this.selectTwo.options = [];
      this.selectThree.options = [];
      axios
        .get(
          this.route("daughter.address.cantons", {
            province_id: province.id,
          })
        )
        .then((res) => {
          this.selectTwo.options = res.data;
        });
    },

    onSearchCantonChange(term) {},

    onSelectedCanton(canton) {
      this.form.canton_id = canton.id;
      this.form.parish_id = null;
      this.form.political_division_id = null;
      this.selectThree.selectedParish = undefined;
      this.selectThree.options = [];
      axios
        .get(
          this.route("daughter.address.parishes", {
            canton_id: canton.id,
          })
        )
        .then((res) => {
          this.selectThree.options = res.data;
        });
    },

    onSearchParishChange(term) {},

    onSelectedParish(parish) {
      if (this.profileForm != null) {
        this.profileForm.political_division_id = parish.id;
      }
      if (this.createProfileForm != null) {
        this.form.political_division_id = parish.id;
      }
    },

    onSearchProvincesChangeBt(term) {},

    onSelectedProvinceBt(province) {
      this.form.province_id_bt = province.id;
      this.profileForm.political_division_id_bt = province.id;
      this.form.canton_id_bt = null;
      this.form.parish_id_bt = null;
      this.form.political_division_id_bt = null;
      this.selectTwoBt.selectedCanton = undefined;
      this.selectThreeBt.selectedParish = undefined;
      this.selectTwoBt.options = [];
      this.selectThreeBt.options = [];
      axios
        .get(
          this.route("secretary.address.cantons", {
            province_id: province.id,
          })
        )
        .then((res) => {
          this.selectTwoBt.options = res.data;
        });
    },

    onSearchCantonChangeBt(term) {},

    onSelectedCantonBt(canton) {
      this.form.canton_id_bt = canton.id;
      this.profileForm.political_division_id_bt = canton.id;
      this.form.parish_id_bt = null;
      this.form.political_division_id_bt = null;
      this.selectThreeBt.selectedParish = undefined;
      this.selectThreeBt.options = [];
      axios
        .get(
          this.route("secretary.address.parishes", {
            canton_id: canton.id,
          })
        )
        .then((res) => {
          this.selectThreeBt.options = res.data;
        });
    },

    onSearchParishChangeBt(term) {},

    onSelectedParishBt(parish) {
      this.form.parish_id_bt = parish.id;
      this.form.political_division_id_bt = parish.id;
      this.profileForm.political_division_id_bt = parish.id;
    },

    openDialogReport() {
      this.managingReportsFor = "setup";
    },
  },
  computed: {
    validateIdentityCard() {
      if (this.profileForm.identity_card == null) {
        return false;
      }
      this.profileForm.identity_card = this.profileForm.identity_card + "";
      if (
        this.profileForm.identity_card.length == 10 ||
        this.profileForm.identity_card.length == 13
      ) {
        const digit = this.profileForm.identity_card.split("").map(Number);
        const coefficient = [2, 1];
        var province_code = digit[0] * 10 + digit[1];
        var verification_code = digit.slice(9, 10);
        var dec, final_value, pivote;
        dec = final_value = pivote = 0;
        if (
          province_code >= 0 &&
          (province_code <= 24 || province_code == 30)
        ) {
          if (digit.length == 13) {
            digit.splice(9, 3);
          }
          for (let index = 0; index < 9; index++) {
            index % 2 == 0
              ? (pivote = digit[index] * coefficient[0])
              : (pivote = digit[index] * coefficient[1]);
            pivote >= 10
              ? (final_value += pivote - 9)
              : (final_value += pivote);
            pivote = 0;
          }
          dec = final_value + (10 - (final_value % 10));
          dec = dec - final_value;
          return dec == 10 || dec == verification_code ? true : false;
        }
        return false;
      }
      return false;
    },

    validateIdentityCardCreate() {
      if (this.createProfileForm.identity_card == null) {
        return false;
      }
      this.createProfileForm.identity_card =
        this.createProfileForm.identity_card + "";
      if (
        this.createProfileForm.identity_card.length == 10 ||
        this.createProfileForm.identity_card.length == 13
      ) {
        const digit = this.createProfileForm.identity_card
          .split("")
          .map(Number);
        const coefficient = [2, 1];
        var province_code = digit[0] * 10 + digit[1];
        var verification_code = digit.slice(9, 10);
        var dec, final_value, pivote;
        dec = final_value = pivote = 0;

        if (
          province_code >= 0 &&
          (province_code <= 24 || province_code == 30)
        ) {
          if (digit.length == 13) {
            digit.splice(9, 3);
          }
          for (let index = 0; index < 9; index++) {
            index % 2 == 0
              ? (pivote = digit[index] * coefficient[0])
              : (pivote = digit[index] * coefficient[1]);
            pivote >= 10
              ? (final_value += pivote - 9)
              : (final_value += pivote);
            pivote = 0;
          }
          dec = final_value + (10 - (final_value % 10));
          dec = dec - final_value;
          return dec == 10 || dec == verification_code ? true : false;
        }
        return false;
      }

      return false;
    },

    isInvalidProvince() {
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

    isInvalidBt() {
      return (
        this.selectOneBt.selectedProvince == undefined ||
        this.selectOneBt.selectedProvince == null
      );
    },

    isInvalidCantonBt() {
      return (
        this.selectTwoBt.selectedCanton == undefined ||
        this.selectTwoBt.selectedCanton == null
      );
    },

    isInvalidParishBt() {
      return (
        this.selectThreeBt.selectedParish == undefined ||
        this.selectThreeBt.selectedParish == null
      );
    },

    loadInfoProfile() {
      if (this.daughter.profile != null) {
        this.profileForm = this.$inertia.form({
          id: this.daughter.profile.id,
          status: this.daughter.profile.status,
          identity_card: this.daughter.profile.identity_card,
          iess_card: this.daughter.profile.iess_card,
          driver_license: this.daughter.profile.driver_license,
          date_birth: this.daughter.profile.date_birth,
          date_vocation: this.daughter.profile.date_vocation,
          date_send: this.daughter.profile.date_send,
          date_vote: this.daughter.profile.date_vote,
          date_retirement: this.daughter.profile.date_retirement,
          cellphone: this.daughter.profile.cellphone,
          phone: this.daughter.profile.phone,
          address: this.daughter.profile.address.address,
          political_division_id:
            this.daughter.profile.address.political_division_id,
          address_bt: this.daughter.profile.origin.address,
          political_division_id_bt:
            this.daughter.profile.origin.political_division_id,
        });
        this.status().then((data) => {
          this.selectThree.options = data.parishes;
          this.selectThree.selectedParish = data.data_parish;

          this.selectTwo.options = data.cantons;
          this.selectTwo.selectedCanton = data.data_canton;

          this.selectOne.selectedProvince = data.data_province;
        });
        this.status_bt().then((data) => {
          this.selectThreeBt.options = data.parishes;
          this.selectThreeBt.selectedParish = data.data_parish;

          this.selectTwoBt.options = data.cantons;
          this.selectTwoBt.selectedCanton = data.data_canton;

          this.selectOneBt.selectedProvince = data.data_province;
        });
        this.loadInfoFamily;
      }
    },

    loadInfoFamily() {
      if (this.daughter.profile.info_family != null) {
        if (this.daughter.profile.info_family.info_family_break != null) {
          this.infoFamilyForm = this.$inertia.form({
            id: this.daughter.profile.info_family.id,
            names_father: this.daughter.profile.info_family.names_father,
            names_mother: this.daughter.profile.info_family.names_mother,
            nr_sisters: this.daughter.profile.info_family.nr_sisters,
            nr_brothers: this.daughter.profile.info_family.nr_brothers,
            place_of_family: this.daughter.profile.info_family.place_of_family,
            name_family_member:
              this.daughter.profile.info_family.info_family_break
                .name_family_member,
            relation:
              this.daughter.profile.info_family.info_family_break.relation,
            cellphone:
              this.daughter.profile.info_family.info_family_break.cellphone,
            phone: this.daughter.profile.info_family.info_family_break.phone,
          });
        } else {
          this.infoFamilyForm = this.$inertia.form({
            id: this.daughter.profile.info_family.id,
            names_father: this.daughter.profile.info_family.names_father,
            names_mother: this.daughter.profile.info_family.names_mother,
            nr_sisters: this.daughter.profile.info_family.nr_sisters,
            nr_brothers: this.daughter.profile.info_family.nr_brothers,
            place_of_family: this.daughter.profile.info_family.place_of_family,
            name_family_member: null,
            relation: null,
            cellphone: null,
            phone: null,
          });
        }
      } else {
        this.infoFamilyForm = this.$inertia.form({
          id: null,
          names_father: null,
          names_mother: null,
          nr_sisters: null,
          nr_brothers: null,
          place_of_family: null,
          name_family_member: null,
          relation: null,
          cellphone: null,
          phone: null,
        });
      }
    },
  },
};
</script>
