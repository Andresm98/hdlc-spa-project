<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Listado de los Nombramientos
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
      </div>
    </template>
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
            Información General de los nombramientos realizados en la Compañía
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
        <p class="text-black dark:text-white">
          La presente plantiflla de información se relaciona a todos los
          nombramientos que se realizan en la compañía a nivel de provincia y
          comunidades, por lo tanto deberá tener una noción clara de todos los
          rangos y estructura organizacional a nivel de nombramientos.
        </p>
      </div>
      <div class="grid lg:gap-3 lg:grid-cols-3 mg:gap-2 md:grid-cols-2 text-black dark:text-white">
        <div>
          <!-- Province -->
          <ul class="list-disc pl-5 pt-2">
            <li><strong>Nivel Provincial</strong></li>
            <li>Visitadora provincial (1).</li>
            <li>Asistenta provincial (1).</li>
            <li>Consejeras Provinciales (4).</li>
            <li>Secretaria Provincial (1).</li>
            <li>Ecónoma Provincial (1).</li>
          </ul>
        </div>
        <div>
          <!--  Local Community -->
          <ul class="list-disc pl-5 pt-2">
            <li><strong>Nivel Comunidad Local</strong></li>
            <li>Hermana Sirviente (1).</li>
            <li>Asistente Local (1).</li>
            <li>Secretaria Local (1).</li>
            <li>Ecónoma Local (1).</li>
            <li>Hermanas Compañeras.</li>
            <li>Hermana Seminario.</li>
          </ul>
        </div>
        <div>
          <!-- Work -->
          <ul class="list-disc pl-5 pt-2">
            <li><strong>Nivel de Obras</strong></li>
            <li>Representante Legal (1).</li>
            <li>Rector/a (1).</li>
            <li>Director/a (1).</li>
          </ul>
        </div>
      </div>
    </section>
    <br />

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

                    <small class="block text-gray-700 mt-2">Tipo :</small>

                    <select
                      v-model="params.type"
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
                      <option
                        v-for="category in categories"
                        :key="category"
                        :value="category.id"
                      >
                        {{ category.name }}
                      </option>
                    </select>
                    <div v-if="params.type != null">
                      <small class="block text-gray-700 mt-2">Niveles:</small>

                      <select
                        v-model="params.level"
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
                        <option
                          v-for="level in levels"
                          :key="level"
                          :value="level.id"
                        >
                          {{ level.name }}
                        </option>
                      </select>
                    </div>

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
                              route('secretary.appoinments.pdf', this.params)
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
                                'secretary.appoinments.export.excel',
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
                                'secretary.appoinments.export.csv',
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
            </div>

            <!-- Table -->
            <section class="pl-4">
              <pagination class="mt-6 mb-5" :links="appointments.links" />
            </section>
            <small class="ml-6">
              Se encontraron {{ appointments.total }} nombramientos.</small
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
                          Nombre Hermana
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
                          Nombramiento
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
                          Fechas (Inicio-Culminación)
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
                          Comunidad y Tranferencia
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
                        v-for="appointment in this.appointments.data"
                        :key="appointment"
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
                                    slug: appointment.profile.user.slug,
                                  })
                                "
                              >
                                <img
                                  class="h-10 w-10 rounded-full"
                                  :src="
                                    appointment.profile.user.profile_photo_url
                                  "
                                  alt=""
                                />
                              </a>
                            </div>
                            <div class="ml-4">
                              <div class="text-sm font-medium text-gray-900">
                                {{ appointment.profile.user.name }}
                              </div>
                              <div class="text-sm text-gray-500">
                                {{ appointment.profile.user.lastname }}
                              </div>
                              <span
                                v-if="appointment.status == 1"
                                class="
                                  px-2
                                  inline-flex
                                  text-xs
                                  leading-5
                                  font-semibold
                                  rounded-sm
                                  bg-green-100
                                  text-green-800
                                "
                                >Activo</span
                              >
                              <span
                                v-if="appointment.status == 0"
                                class="
                                  px-2
                                  inline-flex
                                  text-xs
                                  leading-5
                                  font-semibold
                                  rounded-sm
                                  bg-red-100
                                  text-red-800
                                "
                                >Antiguo</span
                              >
                            </div>
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <span
                            v-if="
                              appointment.appointment_level
                                .appointment_levelc_id == 1
                            "
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
                            {{ appointment.appointment_level.name }}
                          </span>
                          <span
                            v-if="
                              appointment.appointment_level
                                .appointment_levelc_id == 2
                            "
                            class="
                              px-2
                              inline-flex
                              text-xs
                              leading-5
                              font-semibold
                              rounded-full
                              bg-pink-100
                              text-pink-800
                            "
                          >
                            {{ appointment.appointment_level.name }}
                          </span>
                          <span
                            v-if="
                              appointment.appointment_level
                                .appointment_levelc_id == 3
                            "
                            class="
                              px-2
                              inline-flex
                              text-xs
                              leading-5
                              font-semibold
                              rounded-full
                              bg-yellow-100
                              text-yellow-800
                            "
                          >
                            {{ appointment.appointment_level.name }}
                          </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <span
                            v-if="appointment.date_end_appointment != null"
                            class="
                              px-2
                              inline-flex
                              text-xs
                              leading-5
                              font-semibold
                              rounded-full
                              bg-blue-100
                              text-blue-800
                            "
                          >
                            {{
                              this.formatDateShow(appointment.date_appointment)
                            }}
                            -
                            {{
                              this.formatDateShow(
                                appointment.date_end_appointment
                              )
                            }}
                          </span>
                          <span
                            v-else
                            class="
                              px-2
                              inline-flex
                              text-xs
                              leading-5
                              font-semibold
                              rounded-full
                              bg-teal-100
                              text-teal-800
                            "
                          >
                            {{
                              this.formatDateShow(appointment.date_appointment)
                            }}
                            -
                            {{
                              this.formatDateShow(
                                appointment.date_end_appointment
                              )
                            }}
                          </span>
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
                              bg-blue-100
                              text-blue-800
                            "
                          >
                            <div v-if="appointment.community != null">
                              <div
                                class="mx-auto flex gap-10"
                                v-if="appointment.community.comm_level == 1"
                              >
                                <a
                                  :href="
                                    route('secretary.communities.edit', {
                                      slug: appointment.community.comm_slug,
                                    })
                                  "
                                  target="_blank"
                                >
                                  {{
                                    appointment.community.comm_name.substring(
                                      0,
                                      25
                                    )
                                  }}...
                                </a>
                              </div>

                              <div
                                class="mx-auto flex gap-10"
                                v-if="appointment.community.comm_level == 2"
                              >
                                <div
                                  v-if="appointment.community.comm_id != null"
                                >
                                  <a
                                    :href="
                                      route('secretary.works.edit', {
                                        slug: appointment.community.comm_slug,
                                      })
                                    "
                                    target="_blank"
                                  >
                                    {{
                                      appointment.community.comm_name.substring(
                                        0,
                                        25
                                      )
                                    }}...
                                  </a>
                                </div>

                                <div v-else>
                                  <a
                                    :href="
                                      route('secretary.worksindividual.edit', {
                                        slug: appointment.community.comm_slug,
                                      })
                                    "
                                    target="_blank"
                                  >
                                    {{
                                      appointment.community.comm_name.substring(
                                        0,
                                        25
                                      )
                                    }}...
                                  </a>
                                </div>
                              </div>
                            </div>
                          </span>
                          <br />
                          <span
                            class="
                              px-2
                              inline-flex
                              text-xs
                              leading-5
                              font-semibold
                              rounded-sm
                              bg-cyan-100
                              text-cyan-800
                              hover:cursor-pointer
                            "
                          >
                            <div v-if="appointment.transfer != null">
                              {{
                                appointment.transfer.transfer_reason.substring(
                                  0,
                                  15
                                )
                              }}
                              <br />
                              {{
                                this.formatDateShow(
                                  appointment.transfer.transfer_date_adission
                                )
                              }}<br />
                              {{
                                this.formatDateShow(
                                  appointment.transfer.transfer_date_relocated
                                )
                              }}
                            </div>
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
                              @click="
                                confirmationAppointmentUpdate(appointment)
                              "
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
                              @click="
                                modal_open = true;
                                selected_appointment = appointment;
                              "
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
              <pagination class="mt-6 mb-5" :links="appointments.links" />
            </section>
          </div>
        </div>
      </div>
    </section>
    <jet-dialog-modal :show="modal_open">
      <template v-slot:title> Eliminar </template>
      <template v-slot:content>
        <p class="text-lg text-black">
          ¿Está seguro/a de que desea eliminar el nombramiento?
        </p>
        Una vez el nombramiento es eliminado se perderá permanentemente de los
        registros, por lo tanto tenga cuidado. Si desea cerrar un nombramiento
        será suficiente con dar por concluido con una fecha de culminación.
      </template>
      <template v-slot:footer>
        <jet-secondary-button @click="closeModal()">
          Cancelar
        </jet-secondary-button>
        <jet-danger-button class="ml-3" @click="deleteAppointment()">
          Eliminar
        </jet-danger-button>
      </template>
    </jet-dialog-modal>

    <jet-dialog-modal
      :max-width="'input-md'"
      :show="appointmentBeingUpdated"
      @close="appointmentBeingUpdated == null"
    >
      <template #title>
        Datos de Registro del Nombramiento
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
          {{ appointmentBeingUpdated.profile.user.name }}
          {{ appointmentBeingUpdated.profile.user.lastname }} </span
        >.
      </template>

      <template #content>
        <div class="flex flex-wrap">
          <div class="w-full">
            <!-- label -->
            <div class="flex items-center justify-center">
              <small class="ml-3 text-gray-700 font-medium">
                ¿El nombramiento se encuentra activo? ¿No / Si?</small
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
                    :value="this.statusappointment"
                    @click="changeStatusAppointment()"
                  />
                  <!-- line -->
                  <div class="w-10 h-4 bg-gray-200 rounded-full shadow-inner" />
                  <!-- dot -->
                  <div
                    v-if="this.statusappointment == 1"
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
                    style="
                      transform: translateX(100%);
                      background-color: #204de0;
                    "
                  />
                  <div
                    v-if="this.statusappointment == 0"
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
          </div>
          <div class="w-full lg:w-6/12 px-4">
            <label
              class="block text-sm font-medium text-gray-700"
              htmlfor="grid-password"
            >
              Nivel:
            </label>
            <small>Formato: Seleccionar el nivel del permiso.</small>
            <div :class="{ invalid: isInvalidLevelUpdate }">
              <multiselect
                :searchable="true"
                v-model="selectOneUpdate.selectedLevel"
                :options="selectOneUpdate.options"
                :close-on-select="true"
                :clear-on-select="false"
                mode="tags"
                label="name"
                @search-change="onSearchLevelChange"
                @select="onSelectedLevel"
                track-by="name"
                placeholder="Buscar Nivel"
              >
              </multiselect>
              <p class="text-sm text-red-400" v-show="isInvalidLevelUpdate">
                Obligatorio
              </p>
            </div>
          </div>
          <div class="w-full lg:w-6/12 px-4">
            <label
              class="block text-sm font-medium text-gray-700"
              htmlfor="grid-password"
            >
              Título:
            </label>
            <small>Formato: Seleccionar el nombramiento específico.</small>
            <div :class="{ invalid: isInvalidLevelCategoryUpdate }">
              <multiselect
                :searchable="true"
                v-model="selectTwoUpdate.selectedLevelCategory"
                :options="selectTwoUpdate.options"
                :close-on-select="true"
                :clear-on-select="false"
                mode="tags"
                label="name"
                @search-change="onSearchLevelCategoryChange"
                @select="onSelectedCategoryLevel"
                track-by="name"
                placeholder="Buscar Categoría"
              >
              </multiselect>
              <p
                class="text-sm text-red-400"
                v-show="isInvalidLevelCategoryUpdate"
              >
                Obligatorio
              </p>
            </div>
          </div>

          <div
            class="w-full lg:w-6/12 px-4"
            v-if="appointmentBeingUpdated.community != null"
          >
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700 pt-4"
                htmlfor="grid-password"
              >
                Comunidad:
              </label>
              <small
                >Formato: Seleccionar la comunidad u obra en la que cumplirá sus
                funciones.</small
              >
              <div :class="{ invalid: isInvalidUpdateCommunity }">
                <div>
                  <multiselect
                    :searchable="true"
                    placeholder="Por favor seleccionar la comunidad a la que va"
                    select-label="Seleccionar!"
                    v-model="selectThree.selectedCommunity"
                    :options="[]"
                    :close-on-select="true"
                    :clear-on-select="false"
                    :max-height="200"
                    :disabled="true"
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

          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700 pt-4"
                htmlfor="grid-password"
              >
                Fecha:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.date_appointment"
              >
                {{ $page.props.errors.date_appointment }}
              </p>
              <small
                >Formato: Fecha que en la que se asigna el nombramiento.</small
              >
              <Datepicker
                :format="format"
                v-model="updateAppointmentForm.date_appointment"
                required
                autoApply
              />
            </div>
          </div>

          <div class="w-full lg:w-6/12 px-4" v-if="this.statusappointment == 0">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700 pt-4"
                htmlfor="grid-password"
              >
                Fecha Fin:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.date_end_appointment"
              >
                {{ $page.props.errors.date_end_appointment }}
              </p>
              <small
                >Formato: Fecha que en la que culmina el nombramiento.</small
              >
              <Datepicker
                :format="format"
                v-model="updateAppointmentForm.date_end_appointment"
                autoApply
              />
            </div>
          </div>
          <!-- Description -->

          <div class="w-full lg:w-full px-4">
            <div class="relative w-full mb-3">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Descripción:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.description"
              >
                {{ $page.props.errors.description }}
              </p>
              <small>Formato: Descripción del nombramiento.</small>
              <div class="bg-white">
                <quill-editor
                  v-model:content="updateAppointmentForm.description"
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
      </template>

      <template #footer>
        <jet-secondary-button @click="cancelUpdateAppointment()">
          Cancelar
        </jet-secondary-button>

        <jet-button-success class="ml-3" @click="updateAppointment">
          Actualizar
        </jet-button-success>
      </template>
    </jet-dialog-modal>
  </app-layout>
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
    appointments: Object,
    levels: Object,
    categories: Object,
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
    SearchFilter,
    Datepicker,
    Icon,
    Dropdown,
    Operation,
    Pagination,
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
      statusappointment: 0,
      params: {
        search: this.filters.search,
        date: this.filters.date,
        type: this.filters.type,
        level: this.filters.level,
        status: this.filters.status,
        dateStart: this.filters.dateStart,
        dateEnd: this.filters.dateEnd,
      },
      appointmentBeingUpdated: null,
      updateAppointmentForm: this.$inertia.form({
        description: null,
        date_appointment: null,
        date_end_appointment: null,
        appointment_level_id: null,
        community_id: null,
        status: null,
      }),
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
    };
  },
  watch: {
    dataTransfer: function () {
      //   console.log("log ");
    },
    "selectOneUpdate.selectedLevel": function () {
      if (this.selectOneUpdate.selectedLevel === null) {
        this.selectTwoUpdate.selectedLevelCategory = null;
        this.selectTwoUpdate.options = [];
        this.updateAppointmentForm.appointment_level_id = null;
      }
    },
    "selectTwoUpdate.selectedLevelCategory": function () {
      if (this.selectTwoUpdate.selectedLevelCategory === null) {
        // Clean data Form
        this.updateAppointmentForm.appointment_level_id = null;
      }
    },
    "updateAppointmentForm.description": function () {
      var limit = 2000;
      //   console.log("ey");
      const quill = this.$refs.qleditor1;
      if (quill != null) {
        if (quill.getHTML().length <= limit) {
          this.data_intput_one = quill.getHTML();
        } else {
          quill.setHTML(this.data_intput_one);
        }
      }
    },
    "params.type": function () {
      this.params.level = null;
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
        this.$inertia.get(this.route("secretary.appoinments.index"), params, {
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
  },
  computed: {
    ...mapState("work", ["work"]),
    ...mapState("work", ["allWork"]),
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
        this.selectThree.selectedCommunity == undefined ||
        this.selectThree.selectedCommunity == null
      );
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
          this.selectOneUpdate.options = res.data;
        });
    },
  },
  methods: {
    onSearchLevelChange() {},
    onSelectedLevel(level) {
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
      this.updateAppointmentForm.appointment_level_id = category.id;
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
    closeModal() {
      this.modal_open = false;
    },
    deleteAppointment: function () {
      Inertia.delete(
        route("secretary.appoinments.delete", {
          appoinment_id: this.selected_appointment.id,
        })
      );
      this.modal_open = false;
    },
    confirmationAppointmentUpdate(appointment) {
      this.updateAppointmentForm.name_appointment =
        appointment.name_appointment;
      this.updateAppointmentForm.description = appointment.description;
      this.updateAppointmentForm.date_appointment =
        appointment.date_appointment;
      this.updateAppointmentForm.date_end_appointment =
        appointment.date_end_appointment;

      this.statusappointment = appointment.status;
      this.status(appointment).then((data) => {
        this.selectOneUpdate.selectedLevel = data.level;
        axios
          .get(
            this.route("secretary.appointment.levels.index", {
              id: data.level.id,
              status: 2,
            })
          )
          .then((res) => {
            this.selectTwoUpdate.options = res.data;
          });

        if (appointment.community != null) {
          axios
            .get(
              this.route(
                "secretary.daughter-profile.appointment.community.index",
                {
                  community_id: appointment.community.id,
                }
              )
            )
            .then((res) => {
              // console.log("abs ", res.data);
              this.selectThree.selectedCommunity = res.data;
            });
        }

        this.selectTwoUpdate.selectedLevelCategory = data.levelCategory;
      });

      this.appointmentBeingUpdated = appointment;
    },
    async status(appointment) {
      let response = await axios.get(
        this.route("secretary.appointment-data.index", {
          appointment_level_id: appointment.appointment_level_id,
        })
      );
      return response.data;
    },
    cancelUpdateAppointment() {
      this.selectOneUpdate.selectedLevel = null;
      this.selectTwoUpdate.selectedLevelCategory = null;
      this.selectTwoUpdate.options = [];
      this.selectThree.selectedCommunity = null;
      this.selectThree.options = [];
      this.appointmentBeingUpdated = null;
      this.statusappointment = 0;
    },
    updateAppointment() {
      if (this.updateAppointmentForm.date_appointment != null) {
        this.updateAppointmentForm.date_appointment = this.formatDate(
          this.updateAppointmentForm.date_appointment
        );
      }
      if (this.updateAppointmentForm.date_end_appointment != null) {
        this.updateAppointmentForm.date_end_appointment = this.formatDate(
          this.updateAppointmentForm.date_end_appointment
        );
      }

      this.updateAppointmentForm.appointment_level_id =
        this.selectTwoUpdate.selectedLevelCategory;
      this.updateAppointmentForm.community_id =
        this.selectThree.selectedCommunity;

      this.updateAppointmentForm.status = this.statusappointment;
      if (
        this.isInvalidLevelUpdate == false &&
        this.isInvalidLevelCategoryUpdate == false
      ) {
        this.updateAppointmentForm.put(
          this.route("secretary.daughter-profile.appointment.update", {
            user_id: this.appointmentBeingUpdated.profile.user_id,
            appointment_id: this.appointmentBeingUpdated.id,
          }),
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              this.appointmentBeingUpdated = null;
              setTimeout(() => {}, 1);
              this.selectOneUpdate.selectedLevel = null;
              this.selectTwoUpdate.selectedLevelCategory = null;
              this.selectTwoUpdate.options = [];
              this.selectThree.selectedCommunity = null;
              this.selectThree.options = [];
              this.appointmentBeingUpdated = null;
              this.statusappointment = 0;
            },
          }
        );
      }
    },
    changeStatusAppointment() {
      if (this.statusappointment == 1) {
        this.statusappointment = 0;
      } else {
        this.statusappointment = 1;
      }
    },
  },
};
</script>
