<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Listado de Hermanas
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
      </div>
    </template>
    <section class="py-1 bg-gray">
      <div class="w-full lg:w-full">
        <div
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
        >
          <div
            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
          >
            <div v-if="$page.props.flash != null">
              <alert
                v-if="$page.props.flash.success"
                class="alert"
                :type_alert_r="(type_alert = 'success')"
                :message="$page.props.flash.success"
              >
              </alert>
            </div>
            <div v-if="$page.props.flash != null">
              <alert
                v-if="$page.props.flash.error"
                class="alert"
                :type_alert_r="(type_alert = 'error')"
                :message="$page.props.flash.error"
              >
              </alert>
            </div>
            <operation></operation>
            <br />
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
                    <small class="block text-gray-700">Estado:</small>
                    <select
                      v-model="params.status"
                      class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    >
                      <option :value="null">Todos</option>
                      <option value="1">Activas</option>
                      <option value="2">Fallecidas</option>
                      <option value="3">Retiradas</option>
                      <option value="4">Jubiladas</option>
                      <option value="5">Otros Países</option>
                      <option value="6">Datos Incompletos</option>
                    </select>

                    <div v-if="params.status == 1">
                      <small class="block text-gray-700 mt-2">Tipo:</small>
                      <select
                        v-model="params.typeActive"
                        class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                      >
                        <option :value="null">Todos</option>
                        <option value="1">Hermanas Seminario</option>
                        <option value="2">Hermanas Jóvenes</option>
                        <option value="3">Hermanas con Votos</option>
                        <option value="4">Hermanas con Voz Pasiva</option>
                      </select>
                    </div>
                    <hr />
                    <small class="block text-gray-700 mt-2"
                      >Por Provincia:</small
                    >
                    <select
                      v-model="params.perProvince"
                      class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    >
                      <option :value="null">Todas</option>
                      <option
                        v-for="province in provinces"
                        :key="province"
                        :value="province.id"
                      >
                        {{ province.name }}
                      </option>
                    </select>

                    <small class="block text-gray-700 mt-2">Por página:</small>
                    <select
                      v-model="params.perPage"
                      class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    >
                      <option value="5">5</option>
                      <option value="10">10</option>
                      <option :value="null">15</option>
                      <option value="20">20</option>
                    </select>

                    <small class="block text-gray-700 mt-2">Libros:</small>
                    <select
                      v-model="params.book"
                      class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    >
                      <option :value="null">Todos</option>
                      <option
                        v-for="book in books"
                        :key="book"
                        :value="book.id"
                      >
                        {{ book.name }}
                      </option>
                    </select>

                    <div>
                      <small class="block text-gray-700 mt-2">Pastoral:</small>

                      <select
                        v-model="params.pastoral"
                        class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                      >
                        <option :value="null">Todas</option>
                        <option
                          v-for="pastoral in pastorals"
                          :key="pastoral"
                          :value="pastoral.id"
                        >
                          {{ pastoral.name }}
                        </option>
                      </select>
                    </div>
                  </search-filter>
                </div>

                <div
                  v-if="params.status != null"
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
                    :year-range="[1800, this.year]"
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
                    :year-range="[1800, this.year]"
                    v-model="params.dateEnd"
                    :format="format"
                    autoApply
                    required
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
                                'secretary.daughters.report.all',
                                this.params
                              )
                            "
                            >PDF</a
                          >
                          <a
                            class="block px-6 py-2 hover:text-white hover:bg-blue-500"
                            target="_blank"
                            :href="
                              this.route(
                                'secretary.daughters.export.excel',
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

                <div
                  class="justify-center text-sm border-1 border-gray-300 rounded-sm p-1 bg-gray-100"
                >
                  <small class="justify-content-center ml-20 uppercase"
                    >Reportes Personalizados</small
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
                                'secretary.daughters.report.vocation',
                                this.params
                              )
                            "
                            >Por Años de Vocación</a
                          >
                        </div>
                      </template>
                    </dropdown>
                  </div>
                </div>
              </div>
            </div>
            <!-- End container Filters -->

            <section class="pl-4">
              <pagination class="mt-6 mb-5" :links="daughters_list.links" />
            </section>
            <small class="ml-6">
              Se encontraron {{ daughters_list.total }} Hermanas.</small
            >
            <div class="py-2">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div
                    class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                  >
                    <table
                      v-if="daughters_list.data.length > 0"
                      class="min-w-full divide-y divide-gray-200"
                    >
                      <thead class="bg-blue-100">
                        <tr>
                          <th
                            scope="col"
                            class="text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            <span
                              class="inline-flex px-6 py-3 w-full justify-between"
                              @click="sort('lastname')"
                              >Nombre y Apellido

                              <svg
                                v-if="
                                  params.field === 'lastname' &&
                                  params.direction === 'asc'
                                "
                                class="h-6 w-6"
                                viewBox="0 0 20 20"
                              >
                                <path
                                  d="M13.889,11.611c-0.17,0.17-0.443,0.17-0.612,0l-3.189-3.187l-3.363,3.36c-0.171,0.171-0.441,0.171-0.612,0c-0.172-0.169-0.172-0.443,0-0.611l3.667-3.669c0.17-0.17,0.445-0.172,0.614,0l3.496,3.493C14.058,11.167,14.061,11.443,13.889,11.611 M18.25,10c0,4.558-3.693,8.25-8.25,8.25c-4.557,0-8.25-3.692-8.25-8.25c0-4.557,3.693-8.25,8.25-8.25C14.557,1.75,18.25,5.443,18.25,10 M17.383,10c0-4.07-3.312-7.382-7.383-7.382S2.618,5.93,2.618,10S5.93,17.381,10,17.381S17.383,14.07,17.383,10"
                                ></path>
                              </svg>
                              <svg
                                v-if="
                                  params.field === 'lastname' &&
                                  params.direction === 'desc'
                                "
                                class="h-6 w-6"
                                viewBox="0 0 20 20"
                              >
                                <path
                                  d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"
                                ></path>
                              </svg>
                            </span>
                          </th>
                          <th
                            scope="col"
                            class="text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            <span
                              class="inline-flex px-6 py-3 w-full justify-between"
                              @click="sort('email')"
                              >Correo
                              <svg
                                v-if="
                                  params.field === 'email' &&
                                  params.direction === 'asc'
                                "
                                class="h-6 w-6"
                                viewBox="0 0 20 20"
                              >
                                <path
                                  d="M13.889,11.611c-0.17,0.17-0.443,0.17-0.612,0l-3.189-3.187l-3.363,3.36c-0.171,0.171-0.441,0.171-0.612,0c-0.172-0.169-0.172-0.443,0-0.611l3.667-3.669c0.17-0.17,0.445-0.172,0.614,0l3.496,3.493C14.058,11.167,14.061,11.443,13.889,11.611 M18.25,10c0,4.558-3.693,8.25-8.25,8.25c-4.557,0-8.25-3.692-8.25-8.25c0-4.557,3.693-8.25,8.25-8.25C14.557,1.75,18.25,5.443,18.25,10 M17.383,10c0-4.07-3.312-7.382-7.383-7.382S2.618,5.93,2.618,10S5.93,17.381,10,17.381S17.383,14.07,17.383,10"
                                ></path>
                              </svg>
                              <svg
                                v-if="
                                  params.field === 'email' &&
                                  params.direction === 'desc'
                                "
                                class="h-6 w-6"
                                viewBox="0 0 20 20"
                              >
                                <path
                                  d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"
                                ></path>
                              </svg>
                            </span>
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Estado
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Operaciones
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        <tr
                          v-for="user_custom in daughters_list.data"
                          :key="user_custom.id"
                        >
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="flex-shrink-0 h-10 w-10">
                                <img
                                  class="h-10 w-10 rounded-full"
                                  :src="user_custom.profile_photo_url"
                                  alt=""
                                />
                              </div>
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{ user_custom.name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                  {{ user_custom.lastname }}
                                </div>
                                <div v-if="user_custom.profile != null">
                                  <div
                                    v-for="appointent in user_custom.profile
                                      .appointments"
                                    :key="appointent"
                                  >
                                    <span
                                      v-if="
                                        appointent.date_end_appointment === null
                                      "
                                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800"
                                    >
                                      {{ appointent.appointment_level.name }}
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                              {{ user_custom.email }}
                            </div>
                            <!-- <div class="text-sm text-gray-500">Ecuador</div> -->
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div v-if="user_custom.profile != null">
                              <div v-if="user_custom.profile.status == 1">
                                <span
                                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                >
                                  Activa desde
                                  {{
                                    formatDateShow(
                                      user_custom.profile.date_admission
                                    )
                                  }}
                                </span>
                              </div>
                              <div v-if="user_custom.profile.status == 2">
                                <span
                                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                                >
                                  Fallecida en
                                  {{
                                    formatDateShow(
                                      user_custom.profile.date_death
                                    )
                                  }}
                                </span>
                              </div>
                              <div v-if="user_custom.profile.status == 3">
                                <span
                                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
                                >
                                  Retirada en
                                  {{
                                    formatDateShow(
                                      user_custom.profile.date_exit
                                    )
                                  }}
                                </span>
                              </div>
                              <div v-if="user_custom.profile.status == 4">
                                <span
                                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800"
                                >
                                  Salida a otros países
                                  {{
                                    formatDateShow(
                                      user_custom.profile.date_other_country
                                    )
                                  }}
                                </span>
                              </div>
                              <div v-if="user_custom.profile.status == 5">
                                <span
                                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800"
                                >
                                  Información Insuficiente.
                                </span>
                              </div>
                              <div
                                v-if="
                                  user_custom.profile.date_retirement != null
                                "
                              >
                                <span
                                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"
                                >
                                  Jubilada en
                                  {{
                                    formatDateShow(
                                      user_custom.profile.date_retirement
                                    )
                                  }}
                                </span>
                              </div>
                            </div>
                            <div v-else>
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800"
                              >
                                Pendiente
                              </span>
                            </div>
                          </td>
                          <td
                            class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium"
                          >
                            <!-- Components -->

                            <div class="mx-auto flex gap-10">
                              <!-- Update User -->
                              <Link
                                :href="
                                  route('secretary.daughters.edit', {
                                    slug: user_custom.slug,
                                  })
                                "
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
                              </Link>

                              <!-- Print User -->
                              <button @click="openDialogReport(user_custom)">
                                <div class="w-auto h-auto">
                                  <div class="flex-1 h-full">
                                    <div
                                      class="flex items-center justify-center flex-1 h-full p-2 border border-blue-800 text-white shadow rounded-lg hover:bg-blue-50 hover:text-zinc-300"
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
                              <!-- Delete User -->
                              <button
                                @click="
                                  modal_open = true;
                                  selected_user = user_custom;
                                "
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
                              <!-- Delete Account Confirmation Modal -->
                              <div></div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div
                      v-else
                      class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg"
                    >
                      <p class="text-center text-lg">
                        No existen datos que coincidan con su búsqueda
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <section>
              <pagination
                class="mt-2 mb-6 pl-4 align-center"
                :links="daughters_list.links"
              />
            </section>
          </div>
        </div>
      </div>
    </section>
    <jet-dialog-modal :show="modal_open">
      <template v-slot:title> Eliminar </template>

      <template v-slot:content>
        <p class="text-lg text-black">
          ¿Está seguro/a de que desea eliminar la cuenta de
          {{ selected_user.name }}
          ?
        </p>
        Una vez la cuenta es eliminada, todos sus recursos y los datos se
        eliminarán de forma permanente. Por favor verifique nuevamente su acción
        pues es irreversible.
      </template>
      <template v-slot:footer>
        <jet-secondary-button @click="closeModal()">
          Cancelar
        </jet-secondary-button>
        <jet-danger-button class="ml-3" @click="deleteUser()">
          Eliminar Hermana
        </jet-danger-button>
      </template>
    </jet-dialog-modal>

    <jet-dialog-modal
      :show="managingReportsFor"
      @close="managingReportsFor = null"
    >
      <template #title
        >Opciones del Reporte de la Hermana: {{ managingReportsFor.user.name }}
        {{ managingReportsFor.user.lastname }}.
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
            this.route(`secretary.daughters.report.profile`, {
              user_id: managingReportsFor.user.id,
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


import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import { pickBy, throttle, mapValues } from "lodash";
import Pagination from "@/Components/Pagination";
import { Link } from "@inertiajs/inertia-vue3";
import "sweetalert2/dist/sweetalert2.min.css";
import { Inertia } from "@inertiajs/inertia";
import Icon from "@/Components/Icon";
import moment from "moment";

import Operation from "@/Components/Secretary/Daughter/Operation";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import SearchFilter from "@/Components/SearchFilter";
import TextInput from "@/Components/TextInput";
import Datepicker from "vue3-date-time-picker";
import Dropdown from "@/Components/Dropdown";
import JetInput from "@/Jetstream/Input.vue";
import Alert from "@/Components/Alert";
import { defineComponent } from "vue";
import { mapActions } from "vuex";
import { ref } from "vue";

export default defineComponent({
  layout: PrincipalLayout,

  props: {
    daughters_list: Object,
    pastorals: Object,
    books: Object,
    user_custom: Object,
    filters: Object,
    provinces: {
      type: Array,
    },
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
      pagination: {
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="' + className + '">' + (index + 1) + "</span>";
        },
      },
      modules: [Pagination],
    };
  },

  components: {
    Link,
    AppLayout,
    Pagination,
    JetDangerButton,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetSecondaryButton,
    TextInput,
    Alert,
    Datepicker,
    moment,
    SearchFilter,
    Operation,
    Icon,
    Dropdown,
  },

  data() {
    return {
      modal_open: false,
      selected_user: Object,
      type_alert: null,
      params: {
        search: this.filters.search,
        field: this.filters.field,
        direction: this.filters.direction,
        status: this.filters.status,
        pastoral: this.filters.pastoral,
        dateStart: this.filters.dateStart,
        dateEnd: this.filters.dateEnd,
        perPage: this.filters.perPage,
        perProvince: this.filters.perProvince,
        typeActive: this.filters.typeActive,
        book: this.filters.book,
      },
      managingReportsFor: null,
      options: [],
    };
  },

  methods: {
    sort(field) {
      this.params.field = field;
      this.params.direction = this.params.direction === "asc" ? "desc" : "asc";
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
      return null;
    },

    deleteUser: function () {
      Inertia.delete(
        route("secretary.user.destroy", { slug: this.selected_user.slug })
      );
      this.modal_open = false;
    },

    closeModal() {
      this.modal_open = false;
    },

    reset() {
      this.params = mapValues(this.params, () => null);
    },

    dataParams() {
      return this.params;
    },

    openDialogReport(user) {
      this.managingReportsFor = this.$inertia.form({
        user: user,
      });
    },
  },

  watch: {
    params: {
      handler: throttle(function () {
        if (this.params.status === null || this.params.status != 1) {
          this.params.typeActive = null;
        }
        if (this.params.dateStart != null) {
          this.params.dateStart = this.formatDate(this.params.dateStart);
        }
        if (this.params.dateEnd != null) {
          this.params.dateEnd = this.formatDate(this.params.dateEnd);
        }
        let params = pickBy(this.params);
        this.$inertia.get(this.route("secretary.daughters.index"), params, {
          replace: true,
          preserveScroll: true,
          preserveState: true,
        });
      }, 150),
      deep: true,
    },
  },
});
</script>
