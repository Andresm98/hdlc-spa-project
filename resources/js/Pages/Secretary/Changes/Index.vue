<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Listado de los Cambios
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
      class="
        bg-gray-200
        dark:bg-slate-800
        y-1
        px-4
        sm:p-6
        md:py-10 md:px-8
        pt-2
        pb-4
        rounded-lg
        sm:m-2
        lg:m-3
        md:m-4
      "
    >
      <div
        class="
          max-w-4xl
          mx-auto
          grid grid-cols-1
          lg:max-w-5xl lg:gap-x-20 lg:grid-cols-2
        "
      >
        <div
          class="
            relative
            p-3
            col-start-1
            row-start-1
            flex flex-col-reverse
            rounded-lg
            bg-gradient-to-t
            from-black/75
            via-black/0
            sm:bg-none sm:row-start-2 sm:p-0
            md:bg-none md:row-start-2 md:p-0
            lg:row-start-1
          "
        >
          <h1
            class="
              mt-1
              text-lg
              font-semibold
              text-black
              sm:text-black
              md:text-2xl
              dark:sm:text-white
            "
          >
            Provincia Ecuador
          </h1>
          <p
            class="
              text-sm
              leading-4
              font-medium
              text-black
              sm:text-black
              dark:sm:text-slate-400
            "
          >
            Información General de los cambios realizados en la Compañía
          </p>
        </div>
        <div
          class="
            grid
            gap-4
            col-start-1 col-end-3
            row-start-1
            sm:mb-6 sm:grid-cols-4
            md:mb-6 md:grid-cols-4
            lg:gap-6 lg:col-start-2 lg:row-end-6 lg:row-span-6 lg:mb-0
          "
        >
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_2.png"
            alt=""
            class="
              w-full
              h-60
              object-cover
              rounded-lg
              sm:h-52 sm:col-span-2
              md:h-52 md:col-span-2
              lg:col-span-full
            "
            loading="lazy"
          />
        </div>
        <dl
          class="
            mt-4
            text-xs
            font-medium
            flex
            items-center
            row-start-2
            sm:mt-1 sm:row-start-3
            md:mt-1 md:row-start-3
            lg:row-start-2
          "
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
        <p>
          La presente plantilla de información se relaciona a todos los cambios
          que se realizan en la compañía.
        </p>
      </div>
      <div class="content-center mt-2">
        <jet-button-success
          @click="confirmationTransferCreate()"
          class="block mx-5 leading-normal"
          >¿Desea crear un nuevo cambio?</jet-button-success
        >
      </div>
    </section>

    <section class="py-1 bg-gray">
      <div class="w-full lg:w-full">
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
          <div
            class="
              shadow
              overflow-hidden
              border-b border-gray-200
              sm:rounded-lg
            "
          >
            <!-- Container Filters -->
            <div class="container mx-auto ml-7">
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div
                  class="
                    justify-center
                    text-sm
                    border-1 border-gray-300
                    rounded-sm
                    bg-gray-100
                  "
                >
                  <small class="justify-content-center ml-20 uppercase"
                    >Filtros de Búsqueda</small
                  >

                  <search-filter
                    v-model="params.search"
                    class="
                      border border-blue-300
                      rounded-md
                      shadow-sm
                      focus:outline-none
                      focus:ring-indigo-500
                      focus:border-indigo-500
                      sm:text-sm
                    "
                    @reset="reset"
                  >
                    <!-- <v-date-picker v-model="params.date" is-required :format="format">
              <template v-slot="{ inputValue, inputEvents }">
                <input
                  class="bg-white border px-2 py-1 rounded"
                  :value="inputValue"
                  v-on="inputEvents"
                />
              </template>
            </v-date-picker> -->

                    <small class="block text-gray-700 mt-2">Estado:</small>

                    <select
                      v-model="params.status"
                      class="
                        mt-1
                        block
                        w-full
                        px-3
                        border border-gray-300
                        bg-white
                        rounded-md
                        shadow-sm
                        focus:outline-none
                        focus:ring-blue-500
                        focus:border-blue-500
                        sm:text-sm
                      "
                    >
                      <option :value="null">Todos</option>
                      <option value="1">Vigentes</option>
                      <option value="2">Pasados</option>
                    </select>
                  </search-filter>
                </div>

                <div
                  class="
                    justify-center
                    text-sm
                    border-1 border-gray-300
                    rounded-sm
                    p-1
                    bg-gray-100
                  "
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
                  />
                </div>

                <div
                  class="
                    justify-center
                    text-sm
                    border-1 border-gray-300
                    rounded-sm
                    p-1
                    bg-gray-100
                  "
                >
                  <small class="justify-content-center ml-20 uppercase"
                    >Exportar Listas</small
                  >
                  <div
                    class="
                      md:text-md
                      flex
                      items-center
                      justify-between
                      p-4
                      w-full
                      text-sm
                      md:px-12 md:py-0
                    "
                  >
                    <dropdown class="mt-1" placement="bottom-end">
                      <template #default>
                        <div
                          class="
                            group
                            flex
                            items-center
                            cursor-pointer
                            select-none
                          "
                        >
                          <div
                            class="
                              mr-1
                              text-gray-700
                              group-hover:text-blue-600
                              focus:text-blue-600
                              whitespace-nowrap
                            "
                          >
                            <span
                              class="
                                px-1
                                inline-flex
                                text-xs
                                leading-5
                                font-semibold
                                rounded-sm
                                bg-gray-200
                                text-gray-800
                              "
                              >&nbsp;Filtros</span
                            >
                          </div>
                          <icon
                            class="
                              w-5
                              h-5
                              fill-gray-700
                              group-hover:fill-blue-600
                              focus:fill-blue-600
                            "
                            name="cheveron-down"
                          />
                        </div>
                      </template>
                      <template #dropdown>
                        <div
                          class="mt-2 py-2 text-sm bg-white rounded shadow-xl"
                        >
                          <a
                            class="
                              block
                              px-6
                              py-2
                              hover:text-white hover:bg-blue-500
                            "
                            target="_blank"
                            :href="
                              route('secretary.transfers.pdf', this.params)
                            "
                            >PDF</a
                          >
                          <a
                            class="
                              block
                              px-6
                              py-2
                              hover:text-white hover:bg-blue-500
                            "
                            target="_blank"
                            :href="
                              route(
                                'secretary.transfers.export.excel',
                                this.params
                              )
                            "
                            >Excel</a
                          >
                          <a
                            class="
                              block
                              px-6
                              py-2
                              hover:text-white hover:bg-blue-500
                            "
                            target="_blank"
                            :href="
                              route(
                                'secretary.transfers.export.csv',
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
                <pagination class="mt-6 mb-5" :links="transfers.links" />
              </section>
              <small class="ml-6">
                Se encontraron {{ transfers.total }} cambios.</small
              >
              <div class="py-2">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
                  <div
                    class="
                      py-2
                      align-middle
                      inline-block
                      min-w-full
                      sm:px-6
                      lg:px-8
                    "
                  >
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-blue-100">
                        <tr>
                          <th
                            scope="col"
                            class="
                              pl-4
                              text-left text-xs
                              font-medium
                              text-black
                              uppercase
                              tracking-wider
                            "
                          >
                            Nombres y Apellidos
                          </th>
                          <th
                            scope="col"
                            class="
                              px-6
                              py-3
                              text-left text-xs
                              font-medium
                              text-black
                              uppercase
                              tracking-wider
                            "
                          >
                            Comunidad y Observaciones
                          </th>
                          <th
                            scope="col"
                            class="
                              text-left text-xs
                              font-medium
                              text-black
                              uppercase
                              tracking-wider
                            "
                          >
                            FECHAS (Inicio - Cierre)
                          </th>
                          <th
                            scope="col"
                            class="
                              px-6
                              py-3
                              text-left text-xs
                              font-medium
                              text-black
                              uppercase
                              tracking-wider
                            "
                          >
                            Acciones
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        <tr
                          v-for="transfer in this.transfers.data"
                          :key="transfer"
                        >
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div
                                class="
                                  flex-shrink-0
                                  h-10
                                  w-10
                                  hover:cursor-pointer
                                "
                              >
                                <a
                                  :href="
                                    route('secretary.daughters.edit', {
                                      slug: transfer.profile.user.slug,
                                    })
                                  "
                                >
                                  <img
                                    class="h-10 w-10 rounded-full"
                                    :src="
                                      transfer.profile.user.profile_photo_url
                                    "
                                    alt=""
                                  />
                                </a>
                              </div>
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{ transfer.profile.user.name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                  {{ transfer.profile.user.lastname }}
                                </div>
                                <span
                                  v-if="transfer.status == 0"
                                  class="
                                    px-2
                                    inline-flex
                                    text-xs
                                    leading-5
                                    font-semibold
                                    rounded-sm
                                    bg-rose-100
                                    text-rose-800
                                  "
                                >
                                  Cerrado
                                </span>
                                <span
                                  v-if="transfer.status == 1"
                                  class="
                                    px-2
                                    inline-flex
                                    text-xs
                                    leading-5
                                    font-semibold
                                    rounded-sm
                                    bg-lime-100
                                    text-lime-800
                                  "
                                >
                                  Abierto
                                </span>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-6/8 ...">
                              <span
                                class="
                                  px-2
                                  inline-flex
                                  text-xs
                                  leading-5
                                  font-semibold
                                  rounded-full
                                  bg-cyan-100
                                  text-cyan-800
                                "
                              >
                                {{ transfer.community.comm_name }}
                              </span>
                            </div>
                            <div class="w-6/8 ...">
                              <span
                                class="
                                  px-2
                                  inline-flex
                                  text-xs
                                  leading-5
                                  font-semibold
                                  rounded-full
                                  bg-green-100
                                  text-green-800
                                "
                              >
                                <p
                                  v-html="
                                    transfer.transfer_observation.substring(
                                      0,
                                      30
                                    )
                                  "
                                ></p>
                              </span>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span
                              class="
                                px-2
                                inline-flex
                                text-xs
                                leading-5
                                font-semibold
                                rounded-full
                                bg-cyan-100
                                text-cyan-800
                              "
                            >
                              {{
                                this.formatDateShow(
                                  transfer.transfer_date_adission
                                )
                              }}
                              -
                              {{
                                this.formatDateShow(
                                  transfer.transfer_date_relocated
                                )
                              }}
                            </span>
                          </td>
                          <td
                            class="
                              px-3
                              py-4
                              whitespace-nowrap
                              text-right text-sm
                              font-medium
                            "
                          >
                            <!-- Components -->

                            <div class="mx-auto flex gap-10">
                              <button
                                @click="confirmationTransferUpdate(transfer)"
                              >
                                <div class="w-auto h-auto">
                                  <div class="flex-1 h-full">
                                    <div
                                      class="
                                        flex
                                        items-center
                                        justify-center
                                        flex-1
                                        h-full
                                        p-2
                                        border border-green-500
                                        text-white
                                        shadow
                                        rounded-lg
                                        hover:bg-green-50 hover:text-zinc-300
                                      "
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
                                @click="confirmationTransferDelete(transfer)"
                              >
                                <div class="w-auto h-auto">
                                  <div class="flex-1 h-full">
                                    <div
                                      class="
                                        flex
                                        items-center
                                        justify-center
                                        flex-1
                                        h-full
                                        p-2
                                        border border-red-500
                                        text-white
                                        shadow
                                        rounded-lg
                                        hover:bg-red-50 hover:text-zinc-300
                                      "
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
                <pagination class="mt-6 mb-5" :links="transfers.links" />
              </section>
            </div>
          </div>
        </div>
      </div>
    </section>
  </app-layout>

  <!-- Post Data Form -->
  <jet-dialog-modal
    :max-width="'input-md'"
    :show="transferBeingCreated"
    @close="transferBeingCreated == null"
  >
    <template #title> Datos del Nuevo Cambio</template>

    <template #content>
      <div
        v-if="Object.keys($page.props.errors).length !== 0"
        class="px-4 py-4 bg-gray-100 rounded-sm"
      >
        <p>Por favor revise los errores que se muestran a continuación:</p>
        <div v-for="error in $page.props.errors" :key="error">
          <p class="text-red-500 text-sm">{{ error }}</p>
        </div>
      </div>
      <!-- label -->
      <div class="flex items-center justify-center">
        <small class="ml-3 text-gray-700 font-medium"
          >¿El cambio se encuentra activo? ¿No / Si?</small
        >
      </div>
      <br />
      <!-- Toggle A -->
      <div class="flex items-center justify-center w-full my-4">
        <label for="toogleA" class="flex items-center cursor-pointer">
          <!-- toggle -->
          <div class="relative">
            <!-- input -->
            <input
              id="toogleA"
              type="checkbox"
              class="sr-only"
              :value="this.statustransfer"
              @click="changeStatusTransfer()"
            />
            <!-- line -->
            <div class="w-10 h-4 bg-gray-200 rounded-full shadow-inner" />
            <!-- dot -->
            <div
              v-if="this.statustransfer == 1"
              class="
                absolute
                w-6
                h-6
                rounded-full
                shadow
                -left-1
                -top-1
                transition
              "
              style="transform: translateX(100%); background-color: #204de0"
            />
            <div
              v-if="this.statustransfer == 0"
              class="
                absolute
                w-6
                h-6
                bg-red-400
                rounded-full
                shadow
                -left-1
                -top-1
                transition
              "
            />
          </div>
        </label>
      </div>
      <form @submit.prevent="submit">
        <div class="flex flex-wrap" v-if="navigationOp == 1">
          <div class="w-full md:w-5/5 mx-auto">
            <h4
              class="
                text-lg
                font-medium
                text-center
                leading-6
                text-gray-900
                uppercase
                my-2
              "
            >
              <strong>Datos del Cambio</strong>
            </h4>
          </div>
          <div class="w-full lg:w-12/12 px-4 mb-2">
            <div class="relative w-full">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Hermana:
              </label>
              <div :class="{ invalid: isInvalidPerfil }">
                <multiselect
                  :searchable="true"
                  v-model="selectFour.selectedPerfil"
                  :options="selectFour.options"
                  :close-on-select="true"
                  :clear-on-select="false"
                  :custom-label="customLabel"
                  @select="onSelectedPerfil"
                  @search-change="onSearchPerfilChange"
                  track-by="name"
                  placeholder="Buscar hermana"
                >
                </multiselect>
                <p class="text-sm text-red-400" v-show="isInvalidPerfil">
                  Obligatorio
                </p>
              </div>
            </div>
          </div>
          <div class="w-full lg:w-12/12 px-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Motivo:
              </label>

              <small>Formato: Ingresar el motivo del cambio.</small>
              <div>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar motivo del cambio"
                  class="
                    border-0
                    px-3
                    my-2
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
                  v-model="form.transfer.transfer_reason"
                  required
                />
              </div>
            </div>
          </div>

          <div class="w-full lg:w-full px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Observaciones:
              </label>

              <small
                >Formato: Ingresar las observaciones pertinentes, 3000
                caracteres max.</small
              >
              <div class="bg-white">
                <quill-editor
                  ref="qleditor1"
                  contentType="html"
                  theme="snow"
                  :toolbar="toolbarOptions"
                  placeholder="Ingresar los datos solicitados..."
                  v-model:content="form.transfer.transfer_observation"
                ></quill-editor>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Comunidad u Obra:
                </label>
                <small
                  >Formato: Seleccionar la comunidad u obra a la que se cambia
                  la hermana.</small
                >
                <div :class="{ invalid: isInvalidCommunity }">
                  <div v-if="this.allWork != null">
                    <multiselect
                      :searchable="true"
                      placeholder="Por favor seleccionar la comunidad a la que va"
                      select-label="Seleccionar!"
                      v-model="this.selectOne.selectedCommunity"
                      :options="this.allWork"
                      :close-on-select="true"
                      :clear-on-select="false"
                      :max-height="200"
                      :disabled="isDisabled"
                      @select="onSelect"
                      mode="tags"
                      label="comm_name"
                    ></multiselect>
                    <p class="text-sm text-red-400" v-show="isInvalidCommunity">
                      Obligatorio
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Fecha Inicio:
              </label>

              <small>Formato: Fecha de inicio de actividades.</small>
              <Datepicker
                v-model="form.transfer.transfer_date_adission"
                :format="format"
                autoApply
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4" v-if="this.statustransfer == 0">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Fecha Culminación:
              </label>

              <small>Formato: Fecha de cierre de actividades (opcional).</small>
              <Datepicker
                v-model="form.transfer.transfer_date_relocated"
                :format="format"
                autoApply
              />
            </div>
          </div>
        </div>
        <div class="flex flex-wrap" v-if="navigationOp == 2">
          <div class="w-full md:w-5/5 mx-auto">
            <h4
              class="
                text-lg
                font-medium
                text-center
                leading-6
                text-gray-900
                uppercase
                my-2
              "
            >
              <strong>Nombramientos asignados al Cambio</strong>
            </h4>
          </div>
          <div class="flex flex-wrap">
            <div class="w-full lg:w-6/12 px-4">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Nivel:
                </label>

                <small>Formato: Seleccionar el nivel del permiso.</small>
                <div :class="{ invalid: isInvalidLevel }">
                  <multiselect
                    :searchable="true"
                    v-model="selectLevel.selectedLevel"
                    :options="selectLevel.options"
                    placeholder="Buscar Categoría"
                    label="name"
                    track-by="name"
                    :multiple="true"
                    :taggable="true"
                  >
                  </multiselect>
                  <p class="text-sm text-red-400" v-show="isInvalidLevel">
                    Obligatorio
                  </p>
                </div>
              </div>
            </div>
            <div class="w-full lg:w-6/12 px-4">
              <div class="">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Título:
                </label>
                <small>Formato: Seleccionar el nombramiento específico.</small>
                <div :class="{ invalid: isInvalidLevelCategory }">
                  <multiselect
                    :searchable="true"
                    v-model="selectCategory.selectedLevelCategory"
                    :options="selectCategory.options"
                    placeholder="Buscar Categoría"
                    label="name"
                    track-by="name"
                    :multiple="true"
                    :taggable="true"
                  >
                  </multiselect>
                  <p
                    class="text-sm text-red-400"
                    v-show="isInvalidLevelCategory"
                  >
                    Obligatorio
                  </p>
                </div>
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700 pt-4"
                  htmlfor="grid-password"
                >
                  Comunidad:
                </label>
                <small
                  >Formato: Seleccionar la comunidad u obra en la que cumplirá
                  sus funciones.</small
                >
                <!-- <div :class="{ invalid: isInvalidCommunityTwo }"> -->
                <div v-if="this.allWork != null">
                  <multiselect
                    :searchable="true"
                    placeholder="Por favor seleccionar la comunidad a la que va"
                    select-label="Seleccionar!"
                    v-model="this.selectOne.selectedCommunity"
                    :options="this.allWork"
                    :close-on-select="true"
                    :clear-on-select="false"
                    :max-height="200"
                    :disabled="true"
                    @select="onSelect"
                    mode="tags"
                    label="comm_name"
                  ></multiselect>
                  <p class="text-sm text-red-400" v-show="isInvalidCommunity">
                    Obligatorio
                  </p>
                </div>
                <!-- </div> -->
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700 pt-4"
                  htmlfor="grid-password"
                >
                  Fecha Inicio:
                </label>

                <small
                  >Formato: Fecha que en la que se asigna el
                  nombramiento.</small
                >
                <Datepicker
                  :format="format"
                  autoApply
                  v-model="form.appointment.date_appointment"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4" v-if="this.statustransfer == 0">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700 pt-4"
                  htmlfor="grid-password"
                >
                  Fecha Culminación:
                </label>

                <small
                  >Formato: Fecha que en la que finalizó el nombramiento
                  (opcional).</small
                >
                <Datepicker
                  :format="format"
                  autoApply
                  v-model="form.appointment.date_end_appointment"
                />
              </div>
            </div>

            <div class="w-full lg:w-full px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700"
                  htmlfor="grid-password"
                >
                  Descripción:
                </label>

                <small>Formato: Descripción del nombramiento.</small>
                <div class="bg-white">
                  <quill-editor
                    v-model:content="form.appointment.description"
                    ref="qleditor1"
                    contentType="html"
                    theme="snow"
                    :toolbar="toolbarOptions"
                    placeholder="Ingresar los datos solicitados..."
                  ></quill-editor>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </template>

    <template #footer>
      <jet-secondary-button @click="cancelCreation()">
        Cancelar
      </jet-secondary-button>

      <jet-button class="ml-3" @click="navigation(1)" v-if="navigationOp == 1">
        Siguiente
      </jet-button>

      <jet-button class="ml-3" @click="navigation(2)" v-if="navigationOp == 2">
        Anterior
      </jet-button>

      <jet-button-success class="ml-3" @click="submit" v-if="navigationOp == 2">
        Guardar
      </jet-button-success>
    </template>
  </jet-dialog-modal>

  <jet-dialog-modal
    :max-width="'input-md'"
    :show="transferBeingUpdated"
    @close="transferBeingUpdated == null"
  >
    <template #title>
      Datos de Registro del Cambio de la hermana
      <span
        class="
          px-2
          inline-flex
          text-base
          leading-5
          font-semibold
          rounded-sm
          bg-blue-100
          text-blue-800
        "
      >
        {{ transferBeingUpdated.profile.user.name }}
        {{ transferBeingUpdated.profile.user.lastname }} </span
      >.
    </template>

    <template #content>
      <div
        v-if="Object.keys($page.props.errors).length !== 0"
        class="px-4 py-4 bg-gray-100 rounded-sm"
      >
        <p>Por favor revise los errores que se muestran a continuación:</p>
        <div v-for="error in $page.props.errors" :key="error">
          <p class="text-red-500 text-sm">{{ error }}</p>
        </div>
      </div>
      <!-- label -->
      <div class="flex items-center justify-center">
        <small class="ml-3 text-gray-700 font-medium"
          >¿El cambio se encuentra activo? ¿No / Si?</small
        >
      </div>
      <br />
      <!-- Toggle A -->
      <div class="flex items-center justify-center w-full my-4">
        <label for="toogleA" class="flex items-center cursor-pointer">
          <!-- toggle -->
          <div class="relative">
            <!-- input -->
            <input
              id="toogleA"
              type="checkbox"
              class="sr-only"
              :value="this.statustransfer"
              @click="changeStatusTransfer()"
            />
            <!-- line -->
            <div class="w-10 h-4 bg-gray-200 rounded-full shadow-inner" />
            <!-- dot -->
            <div
              v-if="this.statustransfer == 1"
              class="
                absolute
                w-6
                h-6
                rounded-full
                shadow
                -left-1
                -top-1
                transition
              "
              style="transform: translateX(100%); background-color: #204de0"
            />
            <div
              v-if="this.statustransfer == 0"
              class="
                absolute
                w-6
                h-6
                bg-red-400
                rounded-full
                shadow
                -left-1
                -top-1
                transition
              "
            />
          </div>
        </label>
      </div>
      <div class="flex flex-wrap" v-if="navigationOp == 1">
        <div class="w-full md:w-5/5 mx-auto">
          <h4
            class="
              text-lg
              font-medium
              text-center
              leading-6
              text-gray-900
              uppercase
              my-2
            "
          >
            <strong>Datos del Cambio</strong>
          </h4>
        </div>
        <div class="w-full lg:w-12/12 px-4">
          <div class="">
            <label
              class="block text-sm font-medium text-gray-700"
              htmlfor="grid-password"
            >
              Motivo:
            </label>
            <p
              class="text-red-400 text-sm"
              v-show="$page.props.errors.transfer_reason"
            >
              {{ $page.props.errors.transfer_reason }}
            </p>
            <small>Formato: Ingresar el motivo del cambio.</small>
            <div>
              <input
                type="text"
                minLength="10"
                maxlength="100"
                placeholder="Ingresar motivo del cambio"
                class="
                  border-0
                  px-3
                  my-2
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
                v-model="updateTransferForm.transfer_reason"
                required
              />
            </div>
          </div>
        </div>

        <div class="w-full lg:w-12/12 px-4">
          <div class="relative w-full mb-3">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Comunidad u Obra:
              </label>
              <small
                >Formato: Seleccionar la comunidad u obra a la que se cambia la
                hermana.</small
              >
              <div :class="{ invalid: isInvalidUpdateCommunity }">
                <div v-if="this.allWork != null">
                  <multiselect
                    :searchable="true"
                    placeholder="Por favor seleccionar la comunidad de destino"
                    select-label="Seleccionar!"
                    v-model="this.selectOne.selectedCommunity"
                    :options="this.allWork"
                    :close-on-select="true"
                    :clear-on-select="false"
                    :max-height="200"
                    :disabled="isDisabled"
                    @select="onSelect"
                    mode="tags"
                    label="comm_name"
                  ></multiselect>
                  <p
                    class="text-sm text-red-400"
                    v-show="isInvalidUpdateCommunity"
                  >
                    Obligatorio
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full lg:w-full px-4">
          <div class="relative w-full mb-3">
            <label
              class="block text-sm font-medium text-gray-700"
              htmlfor="grid-password"
            >
              Observaciones:
            </label>
            <p
              class="text-red-400 text-sm"
              v-show="$page.props.errors.transfer_observation"
            >
              {{ $page.props.errors.transfer_observation }}
            </p>
            <small>Formato: Ingresar las observaciones pertinentes.</small>
            <div class="bg-white">
              <quill-editor
                ref="qleditor1"
                contentType="html"
                theme="snow"
                :toolbar="toolbarOptions"
                placeholder="Ingresar loss datos solicitados, puede ingresar 3000 caracteres como máximo..."
                v-model:content="updateTransferForm.transfer_observation"
              ></quill-editor>
            </div>
          </div>
        </div>

        <div class="w-full lg:w-6/12 px-4">
          <div class="relative w-full mb-3">
            <label
              class="block text-sm font-medium text-gray-700"
              htmlfor="grid-password"
            >
              Fecha Inicio:
            </label>
            <p
              class="text-red-400 text-sm"
              v-show="$page.props.errors.transfer_date_adission"
            >
              {{ $page.props.errors.transfer_date_adission }}
            </p>
            <small>Formato: Fecha de inicio de actividades.</small>
            <Datepicker
              v-model="updateTransferForm.transfer_date_adission"
              :format="format"
              required
              autoApply
            />
          </div>
        </div>

        <div class="w-full lg:w-6/12 px-4" v-if="this.statustransfer == 0">
          <div class="relative w-full mb-3">
            <label
              class="block text-sm font-medium text-gray-700"
              htmlfor="grid-password"
            >
              Fecha Relocalización:
            </label>
            <small>Opcional: Fecha de inicio de actividades.</small>
            <Datepicker
              v-model="updateTransferForm.transfer_date_relocated"
              :format="format"
              autoApply
            />
          </div>
        </div>

        <!-- Information Address -->
      </div>
      <div class="flex flex-wrap" v-if="navigationOp == 2">
        <div class="w-full bg-white rounded-lg shadow-lg lg:w-3/3">
          <ul
            class="divide-y-2 divide-gray-400"
            v-if="Object.keys(this.allAppointmentsTransfer).length !== 0"
          >
            <div v-for="data in this.allAppointmentsTransfer" :key="data">
              <li
                class="
                  flex
                  justify-between
                  p-3
                  hover:rounded-lg hover:text-white
                  tab
                  w-full
                  overflow-hidden
                  border-t
                "
                :class="
                  data.date_end_appointment != null
                    ? 'hover:bg-red-500'
                    : 'hover:bg-emerald-600'
                "
              >
                {{ data.appointment_level.name }}
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="w-6 h-6 hover:cursor-pointer"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 8l4 4m0 0l-4 4m4-4H3"
                  />
                </svg>
              </li>
              <div class="tab w-full overflow-hidden border-t">
                <div
                  class="
                    w-full
                    tab-content
                    overflow-hidden
                    border-l-2
                    bg-gray-100
                    leading-normal
                  "
                  :class="
                    data.date_end_appointment != null
                      ? 'border-red-500'
                      : 'border-emerald-500'
                  "
                >
                  <div class="p-5 overflow-y-auto h-40">
                    Comunidad:
                    {{ data.community.comm_name }}
                    <br />
                    Fecha del Nombramiento:
                    {{ formatDateShow(data.date_appointment) }}
                    <br />
                    <div v-if="data.date_end_appointment != null">
                      Fecha de Culminación:
                      {{ formatDateShow(data.date_end_appointment) }}
                    </div>

                    <quill-editor
                      class="mt-2"
                      contentType="html"
                      theme="snow"
                      toolbar="minimal"
                      v-model:content="data.description"
                      :readOnly="true"
                    ></quill-editor>
                  </div>
                </div>
              </div>
            </div>
          </ul>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="cancelUpdate()">
        Cancelar
      </jet-secondary-button>
      <a
        target="_blank"
        :href="
          route('secretary.daughter-profile.transfer.pdf', {
            user_id: this.transferBeingUpdated.profile.user_id,
            transfer_id: this.transferBeingUpdated.id,
          })
        "
      >
        <jet-button class="ml-3">Imprimir</jet-button></a
      >
      <jet-button class="ml-3" @click="navigation(1)" v-if="navigationOp == 1">
        Siguiente
      </jet-button>

      <jet-button class="ml-3" @click="navigation(2)" v-if="navigationOp == 2">
        Anterior
      </jet-button>

      <jet-button-success
        class="ml-3"
        @click="updateTransfer"
        v-if="navigationOp == 2"
      >
        Actualizar
      </jet-button-success>
    </template>
  </jet-dialog-modal>

  <jet-confirmation-modal
    :show="transferBeingDeleted"
    @close="transferBeingDeleted == null"
  >
    <template #title> Eliminar el historial del Cambio</template>

    <template #content>
      ¿Está seguro de que desea eliminar el cambio?
      <div class="w-full lg:w-12/12 px-4">
        <div class="">
          <label
            class="block text-sm font-medium text-gray-700"
            htmlfor="grid-password"
          >
            Motivo:
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.transfer_reason"
          >
            {{ $page.props.errors.transfer_reason }}
          </p>
          <small>Motivo del cambio.</small>
          <div>
            <input
              type="text"
              minLength="10"
              maxlength="100"
              placeholder="Ingresar motivo del cambio"
              class="
                border-0
                px-3
                my-2
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
              v-model="deleteTransferForm.transfer_reason"
              readonly
              required
            />
          </div>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="transferBeingDeleted = null">
        Cancelar
      </jet-secondary-button>

      <jet-danger-button class="ml-3" @click="deleteTransfer">
        Eliminar
      </jet-danger-button>
    </template>
  </jet-confirmation-modal>
</template>
<script>
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import { pickBy, throttle, mapValues } from "lodash";
import moment from "moment";
import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";
import { range } from "moment-range";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import Datepicker from "vue3-date-time-picker";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import Pagination from "@/Components/Pagination";
import Icon from "@/Components/Icon";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetButton from "@/Jetstream/Button.vue";

import TextInput from "@/Components/TextInput";
import { ref } from "vue";
import Alert from "@/Components/Alert";
import SearchFilter from "@/Components/SearchFilter";
import Operation from "@/Components/Secretary/Daughter/Operation";
import { Inertia } from "@inertiajs/inertia";
import { mapState, mapActions, mapGetters } from "vuex";
import Dropdown from "@/Components/Dropdown";

export default {
  layout: PrincipalLayout,
  props: {
    transfers: Object,
    allProvinces: Object,
    filters: Object,
  },
  setup() {
    const date = ref(new Date());
    var format = (date) => {
      const format = "YYYY-MM-DD";
      return moment(date).format(format);
    };

    return {
      date,
      format,
    };
  },
  components: {
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
    JetButton,
    SearchFilter,
    Datepicker,
    Icon,
    Dropdown,
    Operation,
    Pagination,
    JetConfirmationModal,
  },
  mounted() {
    // this.allAppointment;
    this.allAppointmentLevel;
    this.allCommunities;
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
      params: {
        search: this.filters.search,
        date: this.filters.date,
        type: this.filters.type,
        status: this.filters.status,
        dateStart: this.filters.dateStart,
        dateEnd: this.filters.dateEnd,
      },
      navigationOp: 1,
      selectOne: {
        selectedCommunity: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: {
          type: Array,
          default: () => [],
        },
        loading: false,
        multiSelectCommunity: null,
        vSelectCommunity: null,
      },
      selectTwo: {
        selectedOffice: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: {
          type: Array,
          default: () => [],
        },
        loading: false,
        multiSelectOffice: null,
        vSelectOffice: null,
      },
      isDisabled: false,
      isTouched: false,
      value: null,
      options: [
        "Bautismo",
        "Penitencia",
        "Eucaristia",
        "Confirmación",
        "Orden Sacerdotal",
        "Matrimonio",
        "Unión de Enfermos",
      ],
      statustransfer: 0,
      form: null,
      transferBeingCreated: null,
      transferBeingDeleted: null,
      deleteTransferForm: this.$inertia.form({
        transfer_date_adission: null,
        transfer_date_relocated: null,
        transfer_reason: null,
        transfer_observation: null,
        profile_id: null,
        community_id: null,
        office_id: null,
      }),
      transferBeingUpdated: null,
      updateTransferForm: this.$inertia.form({
        transfer_date_adission: null,
        transfer_date_relocated: null,
        transfer_reason: null,
        transfer_observation: null,
        profile_id: null,
        community_id: null,
        office_id: null,
        status: null,
      }),
      selectFour: {
        selectedPerfil: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectPerfil: null,
        vSelectPerfil: null,
      },
      appointmentBeingDeleted: null,

      deleteAppointmentForm: this.$inertia.form({
        description: null,
        date_appointment: null,
        date_end_appointment: null,
        appointment_level_id: null,
        community_id: null,
      }),
      appointmentBeingUpdated: null,
      updateAppointmentForm: this.$inertia.form({
        description: null,
        date_appointment: null,
        date_end_appointment: null,
        appointment_level_id: null,
        community_id: null,
        status: null,
      }),

      //   Selects

      selectLevel: {
        selectedLevel: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: [],
        loading: false,
        multiSelectLevel: null,
        vSelectLevel: null,
      },
      selectCategory: {
        selectedLevelCategory: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: [],
        loading: false,
        multiSelectLevelCategory: null,
        vSelectLevelCategory: null,
      },
      selectThree: {
        selectedCommunity: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: [],
        loading: false,
        multiSelectCommunity: null,
        vSelectCommunity: null,
      },
      selectOneUpdate: {
        selectedLevel: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: [],
        loading: false,
        multiSelectLevel: null,
        vSelectLevel: null,
      },
      selectTwoUpdate: {
        selectedLevelCategory: undefined,
        value: 0,
        isDisabled: false,
        isTouched: false,
        options: [],
        loading: false,
        multiSelectLevelCategory: null,
        vSelectLevelCategory: null,
      },

      isDisabled: false,
      isTouched: false,
      value: null,
      allAppointmentsTransfer: null,
    };
  },
  watch: {
    params: {
      handler: throttle(function () {
        let params = pickBy(this.params);
        if (this.params.dateStart != null) {
          this.params.dateStart = this.formatDate(this.params.dateStart);
        }
        if (this.params.dateEnd != null) {
          this.params.dateEnd = this.formatDate(this.params.dateEnd);
        }
        this.$inertia.get(this.route("secretary.transfers.index"), params, {
          replace: true,
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            // console.log("Success");
          },
        });
      }, 1),
      deep: true,
    },
    "selectLevel.selectedLevel": function () {
      this.selectCategory.options = [];
      for (var level in this.selectLevel.selectedLevel) {
        axios
          .get(
            this.route("secretary.appointment.levels.index", {
              id: this.selectLevel.selectedLevel[level].id,
              status: 2,
            })
          )
          .then((res) => {
            for (var index in res.data) {
              this.selectCategory.options.push(res.data[index]);
            }
          });
      }
      if (this.isInvalidLevel) {
        this.selectCategory.options = [];
        this.selectCategory.selectedLevelCategory = [];
      }
    },

    "selectOneUpdate.selectedLevel": function () {
      if (this.selectOneUpdate.selectedLevel === null) {
        this.selectTwoUpdate.selectedLevelCategory = null;
        this.selectTwoUpdate.options = [];
        // Clean data Form
        this.form.appointment_level_id = null;

        if (this.permitBeingUpdated != null) {
          this.updatePermitForm.political_division_id = null;
        }
      }
    },
    "selectCategory.selectedLevelCategory": function () {
      if (this.selectCategory.selectedLevelCategory === null) {
        // Clean data Form
        this.form.appointment_level_id = null;
        if (this.permitBeingUpdated != null) {
          this.updatePermitForm.political_division_id = null;
        }
      }
    },
    "selectTwoUpdate.selectedLevelCategory": function () {
      if (this.selectTwoUpdate.selectedLevelCategory === null) {
        // Clean data Form
        this.form.appointment_level_id = null;
        if (this.permitBeingUpdated != null) {
          this.updatePermitForm.political_division_id = null;
        }
      }
    },
    "form.transfer.transfer_observation": function () {
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
    "updateTransferForm.transfer_observation": function () {
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
  },
  computed: {
    ...mapState("work", ["work"]),
    ...mapState("work", ["allWork"]),
    // Validate Multioption
    // Validate Multioption
    allCommunities() {
      axios
        .get(
          this.route("secretary.daughter-profile.transfer.communities.index")
        )
        .then((res) => {
          //   console.log("works ", res.data);
          this.updateAllWork(res.data);
        });
    },
    allAppointment() {
      axios
        .get(
          this.route("secretary.daughter-profile.appointment.index", {
            user_id: 130,
          })
        )
        .then((res) => {
          //   console.log("app", res.data);
          this.updateAllAppointment(res.data);
        });
    },
    allAppointmentLevel() {
      axios
        .get(
          this.route("secretary.appointment.levels.index", {
            id: 0,
            status: 1,
          })
        )
        .then((res) => {
          this.selectLevel.options = res.data;
          this.selectOneUpdate.options = res.data;
        });
    },
    isInvalidOffice() {
      return this.form.office_id == undefined || this.form.office_id == null;
    },
    isInvalidUpdateOffice() {
      return (
        this.selectTwo.selectedOffice == undefined ||
        this.selectTwo.selectedOffice == null
      );
    },
    isInvalidCommunity() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.selectOne.selectedCommunity == undefined ||
        this.selectOne.selectedCommunity == null
      );
    },

    isInvalidLevel() {
      return (
        this.selectLevel.selectedLevel == undefined ||
        Object.keys(this.selectLevel.selectedLevel).length === 0
      );
    },
    isInvalidLevelCategory() {
      return (
        this.selectCategory.selectedLevelCategory == undefined ||
        Object.keys(this.selectCategory.selectedLevelCategory).length === 0
      );
    },

    // Validate Multioption
    isInvalidLevelUpdate() {
      //   console.log("ee", this.selectOne.selectedProvince);
      return (
        this.selectOneUpdate.selectedLevel == undefined ||
        this.selectOneUpdate.selectedLevel == null
      );
    },
    isInvalidLevelCategoryUpdate() {
      //   console.log("ee canton", this.selectTwo.selectedCanton);
      return (
        this.selectTwoUpdate.selectedLevelCategory == undefined ||
        this.selectTwoUpdate.selectedLevelCategory == null
      );
    },

    isInvalidUpdateCommunity() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.selectOne.selectedCommunity == undefined ||
        this.selectOne.selectedCommunity == null
      );
    },
    isInvalidPerfil() {
      //   console.log("ee Parish", this.selectFour.selectedPerfil);
      return (
        this.selectFour.selectedPerfil == undefined ||
        this.selectFour.selectedPerfil == null
      );
    },
  },
  methods: {
    ...mapActions("work", ["updateAllWork"]),
    ...mapGetters("work", ["getAllWork"]),
    navigation(op) {
      if (op == 1) {
        this.navigationOp = 2;
      } else {
        this.navigationOp = 1;
      }
    },
    // Create Data

    cancelCreation() {
      this.transferBeingCreated = null;
      this.navigationOp = 1;
      this.statustransfer = 0;
      this.selectLevel.selectedLevel = null;
      this.selectFour.selectedPerfil = null;
      this.selectCategory.selectedLevelCategory = null;
    },
    cancelUpdate() {
      this.transferBeingUpdated = null;
      this.navigationOp = 1;
      this.statustransfer = 0;
      this.selectOne.selectedCommunity = null;
    },
    confirmationTransferCreate() {
      this.form = this.$inertia.form({
        transfer: {
          transfer_date_adission: null,
          transfer_date_relocated: null,
          transfer_reason: null,
          transfer_observation: null,
          profile_id: null,
          community_id: null,
          office_id: null,
          status: null,
        },
        appointment: {
          description: null,
          date_appointment: null,
          date_end_appointment: null,
          appointment_level_id: null,
          community_id: null,
          status: null,
        },
      });
      this.transferBeingCreated = this.form;
    },
    onSearchLevelChange() {},
    onSelectedLevel(level) {
      this.form.appointment_level_id = null;

      this.selectTwoUpdate.selectedLevelCategory = undefined;

      this.selectTwoUpdate.options = [];
      axios
        .get(
          this.route("secretary.appointment.levels.index", {
            id: level.id,
            status: 2,
          })
        )
        .then((res) => {
          this.selectTwoUpdate.options = res.data;
        });
    },

    onSearchLevelCategoryChange() {},
    onSelectedCategoryLevel(category) {
      this.form.appointment_level_id = category.id;

      if (this.appointmentBeingUpdated != null) {
        this.updateAppointmentForm.appointment_level_id = category.id;
      }
    },
    submit() {
      if (
        this.isInvalidCommunity == false &&
        this.isInvalidLevel == false &&
        this.isInvalidLevelCategory == false &&
        this.isInvalidPerfil == false
      ) {
        //   console.log("data send", this.form);
        if (this.selectOne.selectedCommunity != null) {
          this.form.transfer.community_id = this.selectOne.selectedCommunity.id;
        }

        if (this.form.transfer.transfer_date_adission) {
          this.form.transfer.transfer_date_adission = this.formatDate(
            this.form.transfer.transfer_date_adission
          );
        }
        if (this.form.transfer.transfer_date_relocated) {
          this.form.transfer.transfer_date_relocated = this.formatDate(
            this.form.transfer.transfer_date_relocated
          );
        }
        //

        if (this.form.appointment.date_appointment != null) {
          this.form.appointment.date_appointment = this.formatDate(
            this.form.appointment.date_appointment
          );
        }
        if (this.form.appointment.date_end_appointment != null) {
          this.form.appointment.date_end_appointment = this.formatDate(
            this.form.appointment.date_end_appointment
          );
        }
        this.form.appointment.appointment_level_id =
          this.selectCategory.selectedLevelCategory;
        this.form.transfer.status = this.statustransfer;
        this.form.appointment.status = this.statustransfer;

        Inertia.post(
          route("secretary.daughter-profile.transfer.store", {
            user_id: this.form.transfer.profile_id,
          }),
          this.form,
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              setTimeout(() => {
                this.form.transfer.transfer_date_adission = null;
                this.form.transfer.transfer_date_relocated = null;
                this.form.transfer.transfer_reason = null;
                this.form.transfer.transfer_observation = null;
                this.form.transfer.community_id = null;
                this.form.transfer.office_id = null;
                this.form.transfer.profile_id = null;
                //
                this.form.appointment.appointment_level_id = null;
                this.form.appointment.description = null;
                this.form.appointment.date_appointment = null;

                this.selectOne.selectedCommunity = null;
                this.selectLevel.selectedLevel = null;
                this.selectCategory.selectedLevelCategory = null;
                this.selectCategory.options = [];
                this.selectThree.selectedCommunity = null;
                this.selectThree.options = [];
                this.transferBeingCreated = null;
                this.navigationOp = 1;
                this.statustransfer = 0;
                this.$refs.qleditor1.setHTML("");
              }, 1);
            },
          }
        );
      }
    },

    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },

    formatDateShow(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD");
      }
      return "Vigente";
    },
    changeStatusTransfer() {
      if (this.statustransfer == 1) {
        this.statustransfer = 0;
      } else {
        this.statustransfer = 1;
      }
    },
    confirmationTransferUpdate(transfer) {
      this.updateTransferForm.transfer_date_adission =
        transfer.transfer_date_adission;
      this.updateTransferForm.transfer_date_relocated =
        transfer.transfer_date_relocated;
      this.updateTransferForm.transfer_reason = transfer.transfer_reason;
      this.updateTransferForm.transfer_observation =
        transfer.transfer_observation;
      this.updateTransferForm.profile_id = transfer.profile_id;
      this.updateTransferForm.community_id = transfer.community_id;
      this.updateTransferForm.office_id = transfer.office_id;
      this.statustransfer = transfer.status;

      this.status(transfer).then((data) => {
        this.selectOne.selectedCommunity = data.community;
        this.selectTwo.selectedOffice = data.office;
      });

      axios
        .get(
          this.route("secretary.daughter-profile.transfer.appointments.index", {
            transfer_id: transfer.id,
          })
        )
        .then((response) => {
          this.allAppointmentsTransfer = response.data;
        });

      this.transferBeingUpdated = transfer;
    },
    async status(transfer) {
      let response = await axios.get(
        this.route("secretary.daughter-profile.transfer-data.index", {
          transfer_id: transfer.id,
        })
      );
      return response.data;
    },
    updateTransfer() {
      if (this.updateTransferForm.transfer_date_adission != null) {
        this.updateTransferForm.transfer_date_adission = this.formatDate(
          this.updateTransferForm.transfer_date_adission
        );
      }
      if (this.updateTransferForm.transfer_date_relocated != null) {
        this.updateTransferForm.transfer_date_relocated = this.formatDate(
          this.updateTransferForm.transfer_date_relocated
        );
      }

      this.updateTransferForm.community_id = this.selectOne.selectedCommunity;
      this.updateTransferForm.office_id = this.selectTwo.selectedOffice;
      this.updateTransferForm.status = this.statustransfer;

      if (this.isInvalidUpdateCommunity == false) {
        this.updateTransferForm.put(
          this.route("secretary.daughter-profile.transfer.update", {
            user_id: this.transferBeingUpdated.profile.user_id,
            transfer_id: this.transferBeingUpdated.id,
          }),
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              this.transferBeingUpdated = null;
              setTimeout(() => {
                this.navigationOp = 1;
                this.statustransfer = 0;
              }, 1);
            },
          }
        );
      }
    },
    // Delete
    confirmationTransferDelete(transfer) {
      this.deleteTransferForm.transfer_reason = transfer.transfer_reason;
      this.transferBeingDeleted = transfer;
    },
    deleteTransfer() {
      this.deleteTransferForm.delete(
        this.route("secretary.daughter-profile.transfer.delete", {
          user_id: this.transferBeingDeleted.profile.user_id,
          transfer_id: this.transferBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () =>
            setTimeout(() => {
              this.transferBeingDeleted = null;
            }, 1),
        }
      );
    },

    reset() {
      this.params = mapValues(this.params, () => null);
    },
    onSelect(option) {
      if (option === "Disable me!") {
        // console.log("is disable");
        this.isDisabled = true;
      }
    },

    onSearchPerfilChange(search) {
      var string = search;
      var length = 60;
      search = string.substring(0, length);
      if (search != null) {
        axios
          .get(
            this.route("secretary.permissions.daughters.index", {
              search: search,
            })
          )
          .then((response) => {
            this.selectFour.options = response.data;
          });
      }
    },
    onSelectedPerfil(perfil) {
      this.form.transfer.profile_id = perfil.profile.user_id;
      this.selectFour.options = [];
    },

    customLabel(option) {
      return `${option.name} ${option.lastname} (${option.fullnamecomm})`;
    },
  },
};
</script>
