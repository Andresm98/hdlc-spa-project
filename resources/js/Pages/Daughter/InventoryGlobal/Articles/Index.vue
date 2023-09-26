<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Editar articulos de la Sección
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenida Hermana: {{ $page.props.user.name }}
      </div>
    </template>
    <operation></operation>
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
            {{ dataInventoryCommunity.community.comm_name }}
          </h1>
          <p
            class="text-sm leading-4 font-medium text-black sm:text-black dark:sm:text-slate-400"
          >
            {{ dataInventoryCommunity.inventory.name }} <br /><br />
            {{ section.name }}
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
          <div
            class="mt-4 text-sm leading-6 col-start-1 sm:col-span-2 lg:mt-6 lg:row-start-4 lg:col-span-1 text-black dark:text-white"
          ></div>
        </div>
      </div>
    </section>

    <section class="py-1 bg-gray-100 rounded-lg">
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

            <button
              @click="confirmCreateArticle()"
              class="pt-1 pb-1 pl-4 pr-4 m-4 bg-blue-500 border-2 border-blue-500 text-white text-sm rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300"
            >
              Crear Artículos
            </button>
            <!-- Container Filters -->
            <div class="container mx-auto pl-4">
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
                      <option value="1">Malo</option>
                      <option value="2">Regular</option>
                      <option value="3">Bueno</option>
                      <option value="4">Muy bueno</option>
                      <option value="5">Excelente</option>
                    </select>

                    <small class="block text-gray-700 mt-2">Material:</small>
                    <select
                      v-model="params.material"
                      class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    >
                      <option :value="null">Todos</option>
                      <option value="1">Madera</option>
                      <option value="2">Tela</option>
                      <option value="3">Plastico</option>
                      <option value="4">Metal</option>
                      <option value="5">Yeso</option>
                    </select>
                  </search-filter>
                </div>
                <div
                  class="justify-center text-sm border-1 border-gray-300 rounded-sm p-1 bg-gray-100"
                >
                  <small class="justify-content-center ml-20 uppercase"
                    >Fecha de Ingreso</small
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
                                'daughter.communities.articles.export.excel',
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
                                'daughter.communities.articles.export.csv',
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
            <!-- End container Filters -->
            <section class="pl-4">
              <pagination class="mt-6 mb-5" :links="listArticles.links" />
            </section>
            <small class="ml-6">
              Se encontraron {{ listArticles.total }} artículos.</small
            >
            <div class="py-2">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div
                    class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                  >
                    <table
                      v-if="listArticles.data.length > 0"
                      class="min-w-full divide-y divide-gray-200 rounded-lg"
                    >
                      <thead class="bg-blue-100">
                        <tr>
                          <th
                            scope="col"
                            class="text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            <span
                              class="inline-flex px-6 py-3 w-full justify-between"
                              @click="sort('name')"
                              >Nombre

                              <svg
                                v-if="
                                  params.field === 'name' &&
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
                                  params.field === 'name' &&
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
                              >Color
                            </span>
                          </th>
                          <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider"
                          >
                            Precio
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
                            Material
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
                          v-for="article_custom in listArticles.data"
                          :key="article_custom.id"
                        >
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                              <div class="flex-shrink-0 h-10 w-10">
                                <svg class="svg-icon" viewBox="-2.5 -1 25 25">
                                  <path
                                    d="M14.68,12.621c-0.9,0-1.702,0.43-2.216,1.09l-4.549-2.637c0.284-0.691,0.284-1.457,0-2.146l4.549-2.638c0.514,0.661,1.315,1.09,2.216,1.09c1.549,0,2.809-1.26,2.809-2.808c0-1.548-1.26-2.809-2.809-2.809c-1.548,0-2.808,1.26-2.808,2.809c0,0.38,0.076,0.741,0.214,1.073l-4.55,2.638c-0.515-0.661-1.316-1.09-2.217-1.09c-1.548,0-2.808,1.26-2.808,2.809s1.26,2.808,2.808,2.808c0.9,0,1.702-0.43,2.217-1.09l4.55,2.637c-0.138,0.332-0.214,0.693-0.214,1.074c0,1.549,1.26,2.809,2.808,2.809c1.549,0,2.809-1.26,2.809-2.809S16.229,12.621,14.68,12.621M14.68,2.512c1.136,0,2.06,0.923,2.06,2.06S15.815,6.63,14.68,6.63s-2.059-0.923-2.059-2.059S13.544,2.512,14.68,2.512M5.319,12.061c-1.136,0-2.06-0.924-2.06-2.06s0.923-2.059,2.06-2.059c1.135,0,2.06,0.923,2.06,2.059S6.454,12.061,5.319,12.061M14.68,17.488c-1.136,0-2.059-0.922-2.059-2.059s0.923-2.061,2.059-2.061s2.06,0.924,2.06,2.061S15.815,17.488,14.68,17.488"
                                  ></path>
                                </svg>
                              </div>
                              <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                  {{ article_custom.name }}
                                </div>
                                <span
                                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-sm bg-cyan-100 text-cyan-800"
                                >
                                  {{
                                    this.formatDateShow(
                                      article_custom.created_at
                                    )
                                  }}
                                </span>
                              </div>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                              {{ article_custom.color }}
                            </div>
                            <!-- <div class="text-sm text-gray-500">Ecuador</div> -->
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                              {{ article_custom.price }}
                            </div>
                            <!-- <div class="text-sm text-gray-500">Ecuador</div> -->
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div v-if="article_custom.status == 1">
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                              >
                                Malo
                              </span>
                            </div>
                            <div v-if="article_custom.status == 2">
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800"
                              >
                                Regular
                              </span>
                            </div>
                            <div v-if="article_custom.status == 3">
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
                              >
                                Bueno
                              </span>
                            </div>
                            <div v-if="article_custom.status == 4">
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                              >
                                Muy Bueno
                              </span>
                            </div>
                            <div v-if="article_custom.status == 5">
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"
                              >
                                Excelente
                              </span>
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div v-if="article_custom.material == 1">
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                              >
                                Madera
                              </span>
                            </div>
                            <div v-if="article_custom.material == 2">
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800"
                              >
                                Tela
                              </span>
                            </div>
                            <div v-if="article_custom.material == 3">
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
                              >
                                Plástico
                              </span>
                            </div>
                            <div v-if="article_custom.material == 4">
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                              >
                                Metal
                              </span>
                            </div>
                            <div v-if="article_custom.material == 5">
                              <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"
                              >
                                Yeso
                              </span>
                            </div>
                          </td>
                          <td
                            class="px-3 py-4 whitespace-nowrap text-right text-sm font-medium"
                          >
                            <!-- Components -->

                            <div class="mx-auto flex gap-10">
                              <!-- Update  Article -->

                              <button
                                @click="confirmUpdateArticle(article_custom)"
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

                              <!-- Delete  Article-->
                              <button
                                @click="
                                  modal_open = true;
                                  selected_article = article_custom;
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
                :links="listArticles.links"
              />
            </section>
          </div>
        </div>
      </div>
    </section>
    <!-- Create Form -->
    <jet-dialog-modal
      :max-width="'input-md'"
      :show="articleBeingCreated"
      @close="articleBeingCreated == null"
    >
      <template #title> Datos del nuevo artículo</template>

      <template #content>
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-2">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Nombre:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.name"
                >
                  {{ $page.props.errors.name }}
                </p>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="createArticleForm.name"
                  required
                />
              </div>
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-2">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Material:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.material"
              >
                {{ $page.props.errors.material }}
              </p>
              <select
                v-model="createArticleForm.material"
                id="material"
                name="material"
                autocomplete="article-material"
                class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              >
                <option value="1">Madera</option>
                <option value="2">Tela</option>
                <option value="3">Plástico</option>
                <option value="4">Metal</option>
                <option value="5">Yeso</option>
              </select>
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-2">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Estado:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.status"
              >
                {{ $page.props.errors.status }}
              </p>
              <select
                v-model="createArticleForm.status"
                id="material"
                name="material"
                autocomplete="article-material"
                class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              >
                <option value="1">Malo</option>
                <option value="2">Regular</option>
                <option value="3">Bueno</option>
                <option value="4">Muy Bueno</option>
                <option value="5">Excelente</option>
              </select>
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-2">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Marca:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.brand">
                {{ $page.props.errors.brand }}
              </p>
              <input
                type="text"
                minLength="10"
                maxlength="100"
                placeholder="Ingresar marca"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="createArticleForm.brand"
                required
              />
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-2">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Color
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.color">
                {{ $page.props.errors.color }}
              </p>
              <input
                type="text"
                minLength="10"
                maxlength="50"
                placeholder="Ingresar color"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="createArticleForm.color"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-3/12 px-2">
            <div class="relative w-full px-2">
              <label class="block text-sm font-medium text-gray-700">
                Precio
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.price">
                {{ $page.props.errors.price }}
              </p>
              <input
                type="numberd"
                minLength="10"
                maxlength="100"
                placeholder="Ingresar precio"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="createArticleForm.price"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-3/12">
            <div class="relative w-full px-2">
              <label class="block text-sm font-medium text-gray-700">
                Medidas (alto x ancho)
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.size">
                {{ $page.props.errors.size }}
              </p>
              <input
                type="text"
                minLength="10"
                maxlength="100"
                placeholder="Ingresar medidas"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="createArticleForm.size"
                required
              />
            </div>
          </div>

          <div class="w-full">
            <div class="relative w-full px-2">
              <label class="block text-sm font-medium text-gray-700">
                Descripción
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.description"
              >
                {{ $page.props.errors.description }}
              </p>
              <textarea
                v-model="this.createArticleForm.description"
                id="about"
                name="about"
                rows="14"
                minLength="1"
                maxlength="2000"
                class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                placeholder="Ingresar descripción"
              />
            </div>
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="this.articleBeingCreated = null">
          Cancelar
        </jet-secondary-button>

        <jet-button-success class="ml-3" @click="createArticle">
          Crear
        </jet-button-success>
      </template>
    </jet-dialog-modal>

    <!-- Update Form -->

    <jet-dialog-modal
      :max-width="'input-md'"
      :show="articleBeingUpdated"
      @close="articleBeingUpdated == null"
    >
      <template #title> Datos de la Artículo</template>

      <template #content>
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-2">
            <div class="relative w-full mb-3">
              <div class="">
                <label class="block text-sm font-medium text-gray-700">
                  Nombre:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.name"
                >
                  {{ $page.props.errors.name }}
                </p>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
                  placeholder="Ingresar nombre"
                  class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="updateArticleForm.name"
                  required
                />
              </div>
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-2">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Material:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.material"
              >
                {{ $page.props.errors.material }}
              </p>
              <select
                v-model="updateArticleForm.material"
                id="material"
                name="material"
                autocomplete="article-material"
                class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              >
                <option value="1">Madera</option>
                <option value="2">Tela</option>
                <option value="3">Plástico</option>
                <option value="4">Metal</option>
                <option value="5">Yeso</option>
              </select>
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-2">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Estado:
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.status"
              >
                {{ $page.props.errors.status }}
              </p>
              <select
                v-model="updateArticleForm.status"
                id="material"
                name="material"
                autocomplete="article-material"
                class="mt-1 block w-full px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
              >
                <option value="1">Malo</option>
                <option value="2">Regular</option>
                <option value="3">Bueno</option>
                <option value="4">Muy Bueno</option>
                <option value="5">Excelente</option>
              </select>
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-2">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Marca:
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.brand">
                {{ $page.props.errors.brand }}
              </p>
              <input
                type="text"
                minLength="10"
                maxlength="100"
                placeholder="Ingresar marca"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="updateArticleForm.brand"
                required
              />
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-2">
            <div class="relative w-full mb-3">
              <label class="block text-sm font-medium text-gray-700">
                Color
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.color">
                {{ $page.props.errors.color }}
              </p>
              <input
                type="text"
                minLength="1"
                maxlength="50"
                placeholder="Ingresar color"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="updateArticleForm.color"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-3/12 px-2">
            <div class="relative w-full px-2">
              <label class="block text-sm font-medium text-gray-700">
                Precio
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.price">
                {{ $page.props.errors.price }}
              </p>
              <input
                type="numberd"
                minLength="10"
                maxlength="100"
                placeholder="Ingresar precio"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="updateArticleForm.price"
                required
              />
            </div>
          </div>

          <div class="w-full lg:w-3/12">
            <div class="relative w-full px-2">
              <label class="block text-sm font-medium text-gray-700">
                Medidas (alto x ancho)
              </label>
              <p class="text-red-400 text-sm" v-show="$page.props.errors.size">
                {{ $page.props.errors.size }}
              </p>
              <input
                type="text"
                minLength="10"
                maxlength="100"
                placeholder="Ingresar medidas"
                class="border-0 px-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                v-model="updateArticleForm.size"
                required
              />
            </div>
          </div>

          <div class="w-full">
            <div class="relative w-full px-2">
              <label class="block text-sm font-medium text-gray-700">
                Descripción
              </label>
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.description"
              >
                {{ $page.props.errors.description }}
              </p>
              <textarea
                v-model="updateArticleForm.description"
                id="about"
                name="about"
                rows="14"
                minLength="1"
                maxlength="2000"
                class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                placeholder="Ingresar descripción"
              />
            </div>
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="this.articleBeingUpdated = null">
          Cancelar
        </jet-secondary-button>

        <jet-button-success class="ml-3" @click="updateArticle">
          Actualizar
        </jet-button-success>
      </template>
    </jet-dialog-modal>
    <!-- Delete Form -->
    <jet-dialog-modal :show="modal_open">
      <template v-slot:title> Eliminar </template>

      <template v-slot:content>
        <p class="text-lg text-black">
          ¿Está seguro/a de que desea eliminar el artículo
          {{ this.selected_article.name }}?
        </p>
      </template>
      <template v-slot:footer>
        <jet-secondary-button @click="closeModal()">
          Cancelar
        </jet-secondary-button>
        <jet-danger-button class="ml-3" @click="deleteArticle()">
          Eliminar
        </jet-danger-button>
      </template>
    </jet-dialog-modal>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";

import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";

import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination";
import { Inertia } from "@inertiajs/inertia";
import "sweetalert2/dist/sweetalert2.min.css";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import SearchFilter from "@/Components/SearchFilter";
import Operation from "@/Components/Daughter/Operation";
import Icon from "@/Components/Icon";
import TextInput from "@/Components/TextInput";
import Alert from "@/Components/Alert";
import { mapActions } from "vuex";
import { ref } from "vue";
import Dropdown from "@/Components/Dropdown";
import moment from "moment";
import Datepicker from "vue3-date-time-picker";
import { pickBy, throttle, mapValues } from "lodash";

import $ from "jquery";
export default defineComponent({
  layout: PrincipalLayout,
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
  props: {
    listArticles: Object,
    section_slug: String,
    article_custom: Object,
    filters: Object,
    dataInventoryCommunity: Object,
    section: Object,
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
    SearchFilter,
    TextInput,
    Alert,
    JetButtonSuccess,
    Datepicker,
    Icon,
    Dropdown,
    moment,
    Operation,
  },
  data() {
    return {
      modal_open: false,
      selected_article: Object,
      type_alert: null,
      params: {
        search: this.filters.search,
        status: this.filters.status,
        material: this.filters.material,
        field: this.filters.field,
        direction: this.filters.direction,
        dateStart: this.filters.dateStart,
        dateEnd: this.filters.dateEnd,
        perPage: this.filters.perPage,
        sectionSlug: this.section_slug,
      },

      //  Create

      articleBeingCreated: null,
      createArticleForm: null,

      //   Update

      articleBeingUpdated: null,
      updateArticleForm: this.$inertia.form({
        name: null,
        description: null,
        color: null,
        price: null,
        material: null,
        status: null,
        size: null,
        brand: null,
      }),
    };
  },
  methods: {
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
    // jquery

    printJquery() {
      $("<iframe>", { name: "myiframe", class: "printFrame" })
        .appendTo("body")
        .contents()
        .find("body").append(`
                  <style>
                  table, th, td {border: 1px solid black;border-collapse: collapse;}

                  th, td {padding: 5px;text-align: left;}

                  .imgCenter {display: block;margin-left: auto;margin-right: auto;width: 40%;}

                  .centerText { text-align: center}
                  .rightText { text-align: right}
                  .boldText {font-weight: bold;}
                  </style>

          <img class="imgCenter" src='https://rawgit.com/DavidRamos015/Vue-Print-PDF/d98156662c2d9e8798a7d9858970eead7c7926d1/public/logonav.png' height="120px" width="160px" />
          <h4 class="centerText">Auto Consulta</h4>
          <h3 class="centerText boldText">Consulta de Gestión</h3>
          <table style="width:100%" >
            <tr>
              <th class="centerText">Descripción</th>
              <th class="centerText">Valor</th>
            </tr>
            <tr>
              <td>No. Orden</td>
              <td class="centerText">372707</td>
            </tr>
            <tr>
              <td>Fecha de la Orden</td>
              <td class="centerText" >28/09/2018</td>
            </tr>
            <tr>
              <td>Estado de la Orden</td>
              <td class="centerText boldText">FINALIZADA</td>
            </tr>
            <tr>
              <td>Tipo de Orden</td>
              <td class="centerText">RECONEXIONES MANUALES AGUA</td>
            </tr>
          </table>

        `);

      window.frames["myiframe"].focus();
      window.frames["myiframe"].print();

      setTimeout(() => {
        $(".printFrame").remove();
      }, 1000);
    },

    sort(field) {
      this.params.field = field;
      this.params.direction = this.params.direction === "asc" ? "desc" : "asc";
    },
    // Post

    confirmCreateArticle() {
      this.createArticleForm = this.$inertia.form({
        name: null,
        description: null,
        color: null,
        price: null,
        material: null,
        status: null,
        size: null,
        brand: null,
      });
      this.articleBeingCreated = this.createArticleForm;
    },
    createArticle() {
      this.createArticleForm.post(
        this.route("daughter.communities.articles.store", {
          section_slug: this.section_slug,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.articleBeingCreated = null;
          },
        }
      );
    },
    // Put

    confirmUpdateArticle(article_custom) {
      this.updateArticleForm.name = article_custom.name;
      this.updateArticleForm.description = article_custom.description;
      this.updateArticleForm.color = article_custom.color;
      this.updateArticleForm.price = article_custom.price;
      this.updateArticleForm.material = article_custom.material;
      this.updateArticleForm.status = article_custom.status;
      this.updateArticleForm.size = article_custom.size;
      this.updateArticleForm.brand = article_custom.brand;

      this.articleBeingUpdated = article_custom;
    },

    updateArticle() {
      this.updateArticleForm.put(
        this.route("daughter.communities.articles.update", {
          section_slug: this.section_slug,
          article_id: this.articleBeingUpdated.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.articleBeingUpdated = null;
            setTimeout(() => {}, 2);
          },
        }
      );
    },

    // Delete

    deleteArticle: function () {
      Inertia.delete(
        this.route("daughter.communities.articles.delete", {
          article_id: this.selected_article.id,
        }),
        {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            // console.log("deleted");
          },
        }
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
  },
  watch: {
    params: {
      handler: throttle(function () {
        if (this.params.dateStart != null) {
          this.params.dateStart = this.formatDate(this.params.dateStart);
        }
        if (this.params.dateEnd != null) {
          this.params.dateEnd = this.formatDate(this.params.dateEnd);
        }
        let params = pickBy(this.params);
        this.$inertia.get(
          this.route("daughter.communities.articles.index", {
            section_slug: this.section_slug,
          }),
          params,
          {
            replace: true,
            preserveScroll: true,
            preserveState: true,
          }
        );
      }, 150),
      deep: true,
    },
  },
});
</script>
