<template>
  <div class="w-full shadow sm:rounded-md">
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
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <div class="my-4">
        <div class="w-full md:w-5/5 mx-auto">
          <h4
            class="
              text-lg
              font-medium
              text-center
              leading-6
              text-gray-900
              uppercase
            "
          >
            <strong>Plantilla de Nombramientos</strong>
          </h4>
        </div>
      </div>

      Nombramientos Individuales Vigentes
      <br />

      <jet-button-success
        type="submit"
        class="ml-4 mt-4 btn btn-primary"
        @click="confirmationCreateIndividualAppointmentActual"
        >Crear Nombramiento Individual
      </jet-button-success>

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="individualAppointmentActualBeingCreated"
        @close="individualAppointmentActualBeingCreated == null"
      >
        <template #title>Datos del Nuevo Nombramiento Individual</template>

        <template #content>
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
                  Fecha Inicio:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.date_appointment"
                >
                  {{ $page.props.errors.date_appointment }}
                </p>
                <small
                  >Formato: Fecha que en la que se asigna el
                  nombramiento.</small
                >
                <Datepicker
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  v-model="form.date_appointment"
                  required
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
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.description"
                >
                  {{ $page.props.errors.description }}
                </p>
                <small>Formato: Descripción del nombramiento.</small>
                <div class="bg-white">
                  <quill-editor
                    v-model:content="form.description"
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
          <jet-secondary-button
            @click="individualAppointmentActualBeingCreated = null"
          >
            Cancelar
          </jet-secondary-button>

          <jet-button-success
            class="ml-3"
            @click="createIndividualAppointmentActual"
          >
            Guardar
          </jet-button-success>
        </template>
      </jet-dialog-modal>

      <div class="py-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
          <div
            v-if="this.getAllAppointment()"
            class="
              py-2
              align-middle
              inline-block
              min-w-full
              sm:px-6
              lg:px-8
              overflow-y-auto
              h-72
            "
          >
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-blue-100">
                <tr>
                  <th></th>
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
                    Cargo
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
                    Fechas (inicio-fin)
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
                  v-for="appointment in this.listIndividualActual"
                  :key="appointment"
                >
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <svg class="svg-icon" viewBox="2 2 23 23">
                          <path
                            d="M15.94,10.179l-2.437-0.325l1.62-7.379c0.047-0.235-0.132-0.458-0.372-0.458H5.25c-0.241,0-0.42,0.223-0.373,0.458l1.634,7.376L4.06,10.179c-0.312,0.041-0.446,0.425-0.214,0.649l2.864,2.759l-0.724,3.947c-0.058,0.315,0.277,0.554,0.559,0.401l3.457-1.916l3.456,1.916c-0.419-0.238,0.56,0.439,0.56-0.401l-0.725-3.947l2.863-2.759C16.388,10.604,16.254,10.22,15.94,10.179M10.381,2.778h3.902l-1.536,6.977L12.036,9.66l-1.655-3.546V2.778z M5.717,2.778h3.903v3.335L7.965,9.66L7.268,9.753L5.717,2.778zM12.618,13.182c-0.092,0.088-0.134,0.217-0.11,0.343l0.615,3.356l-2.938-1.629c-0.057-0.03-0.122-0.048-0.184-0.048c-0.063,0-0.128,0.018-0.185,0.048l-2.938,1.629l0.616-3.356c0.022-0.126-0.019-0.255-0.11-0.343l-2.441-2.354l3.329-0.441c0.128-0.017,0.24-0.099,0.295-0.215l1.435-3.073l1.435,3.073c0.055,0.116,0.167,0.198,0.294,0.215l3.329,0.441L12.618,13.182z"
                          ></path>
                        </svg>
                      </div>
                      <div class="ml-4">
                        <div
                          class="
                            text-sm
                            font-medium
                            text-black
                            hover:text-blue-500
                          "
                        ></div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                      {{ appointment.appointment_level.name }}
                    </div>
                  </td>
                  <td
                    class="px-6 py-4 whitespace-nowrap"
                    v-if="appointment.date_end_appointment == null"
                  >
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
                      {{ this.formatDateShow(appointment.date_appointment) }} -
                      {{
                        this.formatDateShow(appointment.date_end_appointment)
                      }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap" v-else>
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
                      {{ this.formatDateShow(appointment.date_appointment) }} -
                      {{
                        this.formatDateShow(appointment.date_end_appointment)
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
                      <jet-button
                        @click="
                          confirmationIndividualAppointmentUpdate(appointment)
                        "
                        >Detalles</jet-button
                      >
                      <jet-danger-button
                        @click="confirmationAppointmentDelete(appointment)"
                        >Eliminar</jet-danger-button
                      >
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-else class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg">
            <p class="text-center text-lg">
              Por el momento no existen registros.
            </p>
          </div>
        </div>
      </div>

      Nombramientos Individuales Antiguos
      <div class="py-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
          <div
            v-if="this.getAllAppointment()"
            class="
              py-2
              align-middle
              inline-block
              min-w-full
              sm:px-6
              lg:px-8
              overflow-y-auto
              h-72
            "
          >
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-blue-100">
                <tr>
                  <th></th>
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
                    Cargo
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
                    Fechas (inicio-fin)
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
                  v-for="appointment in this.listIndividualOld"
                  :key="appointment"
                >
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <svg class="svg-icon" viewBox="2 2 23 23">
                          <path
                            d="M15.94,10.179l-2.437-0.325l1.62-7.379c0.047-0.235-0.132-0.458-0.372-0.458H5.25c-0.241,0-0.42,0.223-0.373,0.458l1.634,7.376L4.06,10.179c-0.312,0.041-0.446,0.425-0.214,0.649l2.864,2.759l-0.724,3.947c-0.058,0.315,0.277,0.554,0.559,0.401l3.457-1.916l3.456,1.916c-0.419-0.238,0.56,0.439,0.56-0.401l-0.725-3.947l2.863-2.759C16.388,10.604,16.254,10.22,15.94,10.179M10.381,2.778h3.902l-1.536,6.977L12.036,9.66l-1.655-3.546V2.778z M5.717,2.778h3.903v3.335L7.965,9.66L7.268,9.753L5.717,2.778zM12.618,13.182c-0.092,0.088-0.134,0.217-0.11,0.343l0.615,3.356l-2.938-1.629c-0.057-0.03-0.122-0.048-0.184-0.048c-0.063,0-0.128,0.018-0.185,0.048l-2.938,1.629l0.616-3.356c0.022-0.126-0.019-0.255-0.11-0.343l-2.441-2.354l3.329-0.441c0.128-0.017,0.24-0.099,0.295-0.215l1.435-3.073l1.435,3.073c0.055,0.116,0.167,0.198,0.294,0.215l3.329,0.441L12.618,13.182z"
                          ></path>
                        </svg>
                      </div>
                      <div class="ml-4">
                        <div
                          class="
                            text-sm
                            font-medium
                            text-black
                            hover:text-blue-500
                          "
                        ></div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                      {{ appointment.appointment_level.name }}
                    </div>
                  </td>
                  <td
                    class="px-6 py-4 whitespace-nowrap"
                    v-if="appointment.date_end_appointment == null"
                  >
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
                      {{ this.formatDateShow(appointment.date_appointment) }} -
                      {{
                        this.formatDateShow(appointment.date_end_appointment)
                      }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap" v-else>
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
                      {{ this.formatDateShow(appointment.date_appointment) }} -
                      {{
                        this.formatDateShow(appointment.date_end_appointment)
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
                      <jet-button
                        @click="
                          confirmationIndividualAppointmentUpdate(appointment)
                        "
                        >Detalles</jet-button
                      >
                      <jet-danger-button
                        @click="confirmationAppointmentDelete(appointment)"
                        >Eliminar</jet-danger-button
                      >
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-else class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg">
            <p class="text-center text-lg">
              Por el momento no existen registros.
            </p>
          </div>
        </div>
      </div>

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="appointmentIndividualBeingUpdated"
        @close="appointmentIndividualBeingUpdated == null"
      >
        <template #title>
          Datos de Registro del Nombramiento Individual</template
        >

        <template #content>
          <div class="flex flex-wrap">
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

            <div class="w-full lg:w-6/12 px-4">
              <div class="relative w-full mb-3">
                <label
                  class="block text-sm font-medium text-gray-700 pt-4"
                  htmlfor="grid-password"
                >
                  Fecha Inicio:
                </label>
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.date_appointment"
                >
                  {{ $page.props.errors.date_appointment }}
                </p>
                <small
                  >Formato: Fecha Inicio que en la que se asigna el
                  nombramiento.</small
                >
                <Datepicker
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  v-model="updateIndividualAppointmentForm.date_appointment"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-6/12 px-4">
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
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  v-model="updateIndividualAppointmentForm.date_end_appointment"
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
                    v-model:content="
                      updateIndividualAppointmentForm.description
                    "
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
          <jet-secondary-button @click="cancelUpdateIndividualAppointment()">
            Cancelar
          </jet-secondary-button>

          <jet-button-success class="ml-3" @click="updateIndividualAppointment">
            Actualizar
          </jet-button-success>
        </template>
      </jet-dialog-modal>

      <hr
        class="
          w-full
          mt-1
          mb-3
          ml-4
          mr-4
          border-b-1 border-gray-400
          hover:border-gray-400
        "
      />
      <!-- Actual Appointments -->

      Nombrambientos Vigentes
      <div v-if="this.lastTransfer != null">
        <jet-button-success
          type="submit"
          class="ml-4 mt-4 btn btn-primary"
          @click="confirmationCreateAppointmentActual"
          >Crear Nombramiento Actual</jet-button-success
        >
      </div>

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="appointmentActualBeingCreated"
        @close="appointmentActualBeingCreated == null"
      >
        <template #title>Datos del Nuevo Nombramiento</template>

        <template #content>
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
                <div :class="{ invalid: isInvalidCommunity }">
                  <div v-if="this.allWork != null">
                    <multiselect
                      :searchable="true"
                      placeholder="Por favor seleccionar la comunidad a la que va"
                      select-label="Seleccionar!"
                      v-model="this.form.community_id"
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
                </div>
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
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.date_appointment"
                >
                  {{ $page.props.errors.date_appointment }}
                </p>
                <small
                  >Formato: Fecha que en la que se asigna el
                  nombramiento.</small
                >
                <Datepicker
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  v-model="form.date_appointment"
                  required
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
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.description"
                >
                  {{ $page.props.errors.description }}
                </p>
                <small>Formato: Descripción del nombramiento.</small>
                <div class="bg-white">
                  <quill-editor
                    v-model:content="form.description"
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
          <jet-secondary-button @click="appointmentActualBeingCreated = null">
            Cancelar
          </jet-secondary-button>

          <jet-button-success class="ml-3" @click="createAppointmentActual">
            Guardar
          </jet-button-success>
        </template>
      </jet-dialog-modal>
      <div class="py-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
          <div
            v-if="this.getAllAppointment()"
            class="
              py-2
              align-middle
              inline-block
              min-w-full
              sm:px-6
              lg:px-8
              overflow-y-auto
              h-72
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
                    Comunidad/Obra
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
                    Cargo
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
                    Cambio
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
                    Fechas (inicio-fin)
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
                <tr v-for="appointment in this.listActual" :key="appointment">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <svg class="svg-icon" viewBox="2 2 23 23">
                          <path
                            d="M17.283,5.549h-5.26V4.335c0-0.222-0.183-0.404-0.404-0.404H8.381c-0.222,0-0.404,0.182-0.404,0.404v1.214h-5.26c-0.223,0-0.405,0.182-0.405,0.405v9.71c0,0.223,0.182,0.405,0.405,0.405h14.566c0.223,0,0.404-0.183,0.404-0.405v-9.71C17.688,5.731,17.506,5.549,17.283,5.549 M8.786,4.74h2.428v0.809H8.786V4.74z M16.879,15.26H3.122v-4.046h5.665v1.201c0,0.223,0.182,0.404,0.405,0.404h1.618c0.222,0,0.405-0.182,0.405-0.404v-1.201h5.665V15.26z M9.595,9.583h0.81v2.428h-0.81V9.583zM16.879,10.405h-5.665V9.19c0-0.222-0.183-0.405-0.405-0.405H9.191c-0.223,0-0.405,0.183-0.405,0.405v1.215H3.122V6.358h13.757V10.405z"
                          ></path>
                        </svg>
                      </div>
                      <div class="ml-4">
                        <div
                          class="
                            text-sm
                            font-medium
                            text-black
                            hover:text-blue-500
                          "
                        >
                          <div
                            v-if="
                              appointment.community.comm_level == 1 &&
                              appointment.community.comm_id == null
                            "
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
                                  15
                                )
                              }}...
                            </a>
                          </div>
                          <div
                            v-if="
                              appointment.community.comm_level == 2 &&
                              appointment.community.comm_id != null
                            "
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
                                  15
                                )
                              }}...
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                      {{ appointment.appointment_level.name }}
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      v-if="
                        appointment.transfer.transfer_date_relocated === null
                      "
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
                    >
                      {{
                        appointment.transfer.transfer_reason.substring(0, 15)
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
                    </span>
                    <span
                      v-else
                      class="
                        px-2
                        inline-flex
                        text-xs
                        leading-5
                        font-semibold
                        rounded-sm
                        bg-blue-100
                        text-blue-800
                      "
                    >
                      {{
                        appointment.transfer.transfer_reason.substring(0, 15)
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
                    </span>
                  </td>
                  <td
                    class="px-6 py-4 whitespace-nowrap"
                    v-if="appointment.date_end_appointment == null"
                  >
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
                      {{ this.formatDateShow(appointment.date_appointment) }} -
                      {{
                        this.formatDateShow(appointment.date_end_appointment)
                      }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap" v-else>
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
                      {{ this.formatDateShow(appointment.date_appointment) }} -
                      {{
                        this.formatDateShow(appointment.date_end_appointment)
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
                      <jet-button
                        @click="confirmationAppointmentUpdate(appointment)"
                        >Detalles</jet-button
                      >
                      <jet-danger-button
                        @click="confirmationAppointmentDelete(appointment)"
                        >Eliminar</jet-danger-button
                      >
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-else class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg">
            <p class="text-center text-lg">
              Por el momento no existen registros.
            </p>
          </div>
        </div>
      </div>

      Nombrambientos Antiguos
      <div class="py-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
          <div
            v-if="this.getAllAppointment()"
            class="
              py-2
              align-middle
              inline-block
              min-w-full
              sm:px-6
              lg:px-8
              overflow-y-auto
              h-72
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
                    Comunidad/Obra
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
                    Cargo
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
                    Cambio
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
                    Fechas (inicio-fin)
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
                <tr v-for="appointment in this.listOld" :key="appointment">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <svg class="svg-icon" viewBox="2 2 23 23">
                          <path
                            d="M17.283,5.549h-5.26V4.335c0-0.222-0.183-0.404-0.404-0.404H8.381c-0.222,0-0.404,0.182-0.404,0.404v1.214h-5.26c-0.223,0-0.405,0.182-0.405,0.405v9.71c0,0.223,0.182,0.405,0.405,0.405h14.566c0.223,0,0.404-0.183,0.404-0.405v-9.71C17.688,5.731,17.506,5.549,17.283,5.549 M8.786,4.74h2.428v0.809H8.786V4.74z M16.879,15.26H3.122v-4.046h5.665v1.201c0,0.223,0.182,0.404,0.405,0.404h1.618c0.222,0,0.405-0.182,0.405-0.404v-1.201h5.665V15.26z M9.595,9.583h0.81v2.428h-0.81V9.583zM16.879,10.405h-5.665V9.19c0-0.222-0.183-0.405-0.405-0.405H9.191c-0.223,0-0.405,0.183-0.405,0.405v1.215H3.122V6.358h13.757V10.405z"
                          ></path>
                        </svg>
                      </div>
                      <div class="ml-4">
                        <div
                          class="
                            text-sm
                            font-medium
                            text-black
                            hover:text-blue-500
                          "
                        >
                          <div
                            v-if="
                              appointment.community.comm_level == 1 &&
                              appointment.community.comm_id == null
                            "
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
                                  15
                                )
                              }}...
                            </a>
                          </div>
                          <div
                            v-if="
                              appointment.community.comm_level == 2 &&
                              appointment.community.comm_id != null
                            "
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
                                  15
                                )
                              }}...
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                      {{ appointment.appointment_level.name }}
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      v-if="
                        appointment.transfer.transfer_date_relocated === null
                      "
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
                    >
                      {{
                        appointment.transfer.transfer_reason.substring(0, 15)
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
                    </span>
                    <span
                      v-else
                      class="
                        px-2
                        inline-flex
                        text-xs
                        leading-5
                        font-semibold
                        rounded-sm
                        bg-blue-100
                        text-blue-800
                      "
                    >
                      {{
                        appointment.transfer.transfer_reason.substring(0, 15)
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
                    </span>
                  </td>
                  <td
                    class="px-6 py-4 whitespace-nowrap"
                    v-if="appointment.date_end_appointment == null"
                  >
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
                      {{ this.formatDateShow(appointment.date_appointment) }} -
                      {{
                        this.formatDateShow(appointment.date_end_appointment)
                      }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap" v-else>
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
                      {{ this.formatDateShow(appointment.date_appointment) }} -
                      {{
                        this.formatDateShow(appointment.date_end_appointment)
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
                      <jet-button
                        @click="confirmationAppointmentUpdate(appointment)"
                        >Detalles</jet-button
                      >
                      <jet-danger-button
                        @click="confirmationAppointmentDelete(appointment)"
                        >Eliminar</jet-danger-button
                      >
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-else class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg">
            <p class="text-center text-lg">
              Por el momento no existen registros.
            </p>
          </div>
        </div>
      </div>

      <jet-confirmation-modal
        :show="appointmentBeingDeleted"
        @close="appointmentBeingDeleted == null"
      >
        <template #title> Eliminar el Nombramiento</template>

        <template #content>
          ¿Está seguro de que desea eliminar el historial del Nombramiento?

          <div class="w-full lg:w-12/12 mt-4">
            <div class="">
              <label
                class="block text-sm font-medium text-gray-700"
                htmlfor="grid-password"
              >
                Nombramiento:
              </label>

              <div>
                <input
                  type="text"
                  minLength="10"
                  maxlength="100"
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
                  v-model="deleteAppointmentForm.name_appointment"
                  readonly
                />
              </div>
            </div>
          </div>
          <div class="w-3/3">
            <label
              class="block text-sm font-medium text-gray-700"
              htmlfor="grid-password"
            >
              Descripción:
            </label>

            <quill-editor
              v-model:content="deleteAppointmentForm.description"
              contentType="html"
              theme="snow"
              :readOnly="true"
            ></quill-editor>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="appointmentBeingDeleted = null">
            Cancelar
          </jet-secondary-button>

          <jet-danger-button class="ml-3" @click="deleteAppointment">
            Eliminar
          </jet-danger-button>
        </template>
      </jet-confirmation-modal>

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="appointmentBeingUpdated"
        @close="appointmentBeingUpdated == null"
      >
        <template #title> Datos de Registro del Nombramiento</template>

        <template #content>
          <div class="flex flex-wrap">
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
                <div :class="{ invalid: isInvalidUpdateCommunity }">
                  <div v-if="this.allWork != null">
                    <multiselect
                      :searchable="true"
                      placeholder="Por favor seleccionar la comunidad a la que va"
                      select-label="Seleccionar!"
                      v-model="selectThree.selectedCommunity"
                      :options="allWork"
                      :close-on-select="true"
                      :clear-on-select="false"
                      :max-height="200"
                      :disabled="true"
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
                  >Formato: Fecha que en la que se asigna el
                  nombramiento.</small
                >
                <Datepicker
                  :format="format"
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  v-model="updateAppointmentForm.date_appointment"
                  required
                />
              </div>
            </div>

            <div class="w-full lg:w-12/12 px-4">
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
                  :transitions="false"
                  menuClassName="dp-custom-menu"
                  v-model="updateAppointmentForm.date_end_appointment"
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
    </div>
  </div>
</template>

<script>
import Datepicker from "vue3-date-time-picker";
import { useForm } from "@inertiajs/inertia-vue3";
import JetButtonSuccess from "@/Jetstream/ButtonSuccess";
import JetButton from "@/Jetstream/Button.vue";
import JetConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import Alert from "@/Components/Alert";

import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";
import "vue3-date-time-picker/dist/main.css";
import { ref } from "vue";
import { mapState, mapActions, mapGetters } from "vuex";
import JetInputError from "@/Jetstream/InputError";

export default {
  props: {
    errors: null,
  },
  // Relashionship with another components
  components: {
    Datepicker,
    JetButtonSuccess,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
    JetDialogModal,
    JetFormSection,
    JetInput,
    JetInputError,
    moment,
    Alert,
  },
  //  Setup all data
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
      //   List data
      listActual: null,
      listOld: null,
      listIndividualActual: null,
      lastTransfer: null,
      listIndividualOld: null,
      appointmentBeingDeleted: null,
      // Create actual appointment
      individualAppointmentActualBeingCreated: null,
      // Create actual appointment
      appointmentActualBeingCreated: null,
      form: this.$inertia.form({
        description: null,
        date_appointment: null,
        date_end_appointment: null,
        appointment_level_id: null,
        transfer: null,
        community_id: null,
      }),
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
      }),
      appointmentIndividualBeingUpdated: null,
      updateIndividualAppointmentForm: this.$inertia.form({
        description: null,
        date_appointment: null,
        date_end_appointment: null,
        appointment_level_id: null,
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
    };
  },
  created() {
    axios
      .get(this.route("secretary.daughter-profile.transfer.communities.index"))
      .then((res) => {
        this.updateAllWork(res.data);
      });
  },
  mounted() {
    this.allAppointment;
    this.allAppointmentLevel;
  },
  computed: {
    ...mapState("daughter", ["profile"]),
    ...mapState("appointment", ["appointment"]),
    ...mapState("work", ["work"]),
    ...mapState("work", ["allWork"]),

    // Validate Multioption
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

    isInvalidCommunity() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.form.community_id == undefined || this.form.community_id == null
      );
    },
    isInvalidUpdateCommunity() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.selectThree.selectedCommunity == undefined ||
        this.selectThree.selectedCommunity == null
      );
    },
    allAppointment() {
      axios
        .get(
          this.route("secretary.daughter-profile.appointment.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          //   console.log("app ", res.data);
          this.lastTransfer = res.data.lastTransfer;
          this.listActual = res.data.listActual;
          this.listOld = res.data.listOld;
          this.listIndividualActual = res.data.listIndividualActual;
          this.listIndividualOld = res.data.listIndividualOld;
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
  },
  watch: {
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
          this.updatePermitForm.appointment_level_id = null;
        }
      }
    },
    "selectCategory.selectedLevelCategory": function () {
      if (this.selectCategory.selectedLevelCategory === null) {
        // Clean data Form
        this.form.appointment_level_id = null;
        if (this.permitBeingUpdated != null) {
          this.updatePermitForm.appointment_level_id = null;
        }
      }
    },
    "selectTwoUpdate.selectedLevelCategory": function () {
      if (this.selectTwoUpdate.selectedLevelCategory === null) {
        // Clean data Form
        this.form.appointment_level_id = null;
        if (this.permitBeingUpdated != null) {
          this.updatePermitForm.appointment_level_id = null;
        }
      }
    },
    "form.description": function () {
      var limit = 2000;
      const quill = this.$refs.qleditor1;
      if (quill != null) {
        if (quill.getHTML().length <= limit) {
          this.data_intput_one = quill.getHTML();
        } else {
          quill.setHTML(this.data_intput_one);
        }
      }
    },
    "updateAppointmentForm.description": function () {
      var limit = 2000;
      //   console.log("ey");
      //   const quill = this.$refs.qleditor1;
      //   if (quill != null) {
      //     if (quill.getHTML().length <= limit) {
      //       this.data_intput_one = quill.getHTML();
      //     } else {
      //       quill.setHTML(this.data_intput_one);
      //     }
      //   }
    },
  },
  methods: {
    ...mapActions("appointment", ["updateAllAppointment"]),
    ...mapGetters("appointment", ["getAllAppointment"]),
    ...mapActions("work", ["updateAllWork"]),
    ...mapGetters("work", ["getAllWork"]),

    // Appoinment Actual
    confirmationCreateAppointmentActual() {
      this.appointmentActualBeingCreated = this.form;
      this.form.community_id = this.lastTransfer.community;
    },
    // Appoinment Individual Actual
    confirmationCreateIndividualAppointmentActual() {
      this.individualAppointmentActualBeingCreated = this.form;
    },
    // Save Appoinment
    createAppointmentActual() {
      if (this.form.date_appointment != null) {
        this.form.date_appointment = this.formatDate(
          this.form.date_appointment
        );
      }
      this.form.appointment_level_id =
        this.selectCategory.selectedLevelCategory;
      this.form.transfer = this.lastTransfer;
      if (
        this.isInvalidLevel == false &&
        this.isInvalidLevelCategory == false &&
        this.isInvalidCommunity == false
      ) {
        Inertia.post(
          route("secretary.daughter-profile.appointment.store", {
            user_id: this.profile.user_id,
          }),
          this.form,
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              setTimeout(() => {
                this.updateTable();
              }, 1);

              this.form.appointment_level_id = null;
              this.form.community_id = null;
              this.form.description = null;
              this.form.date_appointment = null;

              this.selectLevel.selectedLevel = null;
              this.selectCategory.selectedLevelCategory = null;
              this.selectCategory.options = [];
              this.selectThree.selectedCommunity = null;
              this.selectThree.options = [];
              this.appointmentActualBeingCreated = null;
              this.$refs.qleditor1.setHTML("");
            },
          }
        );
      }
    },
    // Save Individual Appoinment
    createIndividualAppointmentActual() {
      if (this.form.date_appointment != null) {
        this.form.date_appointment = this.formatDate(
          this.form.date_appointment
        );
      }
      this.form.appointment_level_id =
        this.selectCategory.selectedLevelCategory;
      if (
        this.isInvalidLevel == false &&
        this.isInvalidLevelCategory == false
      ) {
        Inertia.post(
          route("secretary.daughter-profile.appointment.store", {
            user_id: this.profile.user_id,
          }),
          this.form,
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              setTimeout(() => {
                this.updateTable();
              }, 1);

              this.form.appointment_level_id = null;

              this.form.description = null;
              this.form.date_appointment = null;

              this.selectLevel.selectedLevel = null;
              this.selectCategory.selectedLevelCategory = null;
              this.selectCategory.options = [];
              this.selectThree.selectedCommunity = null;
              this.selectThree.options = [];
              this.individualAppointmentActualBeingCreated = null;
              this.$refs.qleditor1.setHTML("");
            },
          }
        );
      }
    },

    //
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

    updateTable() {
      axios
        .get(
          this.route("secretary.daughter-profile.appointment.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          //   console.log("app ", res.data);
          this.lastTransfer = res.data.lastTransfer;
          this.listActual = res.data.listActual;
          this.listOld = res.data.listOld;
          this.listIndividualActual = res.data.listIndividualActual;
          this.listIndividualOld = res.data.listIndividualOld;
          this.updateAllAppointment(res.data);
        });
    },

    // Update Individual Appointment

    confirmationIndividualAppointmentUpdate(appointment) {
      this.updateIndividualAppointmentForm.name_appointment =
        appointment.name_appointment;
      this.updateIndividualAppointmentForm.description =
        appointment.description;
      this.updateIndividualAppointmentForm.date_appointment =
        appointment.date_appointment;
      this.updateIndividualAppointmentForm.date_end_appointment =
        appointment.date_end_appointment;

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

        this.selectTwoUpdate.selectedLevelCategory = data.levelCategory;
      });

      this.appointmentIndividualBeingUpdated = appointment;
    },

    updateIndividualAppointment() {
      this.updateIndividualAppointmentForm.date_appointment = this.formatDate(
        this.updateIndividualAppointmentForm.date_appointment
      );
      if (this.updateIndividualAppointmentForm.date_end_appointment != null) {
        this.updateIndividualAppointmentForm.date_end_appointment =
          this.formatDate(
            this.updateIndividualAppointmentForm.date_end_appointment
          );
      }

      this.updateIndividualAppointmentForm.appointment_level_id =
        this.selectTwoUpdate.selectedLevelCategory;

      if (
        this.isInvalidLevelUpdate == false &&
        this.isInvalidLevelCategoryUpdate == false
      ) {
        this.updateIndividualAppointmentForm.put(
          this.route("secretary.daughter-profile.appointment.update", {
            user_id: this.profile.user_id,
            appointment_id: this.appointmentIndividualBeingUpdated.id,
          }),
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              this.appointmentIndividualBeingUpdated = null;
              setTimeout(() => {
                this.updateTable();
              }, 1);
              this.selectOneUpdate.selectedLevel = null;
              this.selectTwoUpdate.selectedLevelCategory = null;
              this.selectTwoUpdate.options = [];
              this.selectThree.selectedCommunity = null;
              this.selectThree.options = [];
              this.appointmentIndividualBeingUpdated = null;
            },
          }
        );
      }
    },

    // Update Appointment

    confirmationAppointmentUpdate(appointment) {
      this.updateAppointmentForm.name_appointment =
        appointment.name_appointment;
      this.updateAppointmentForm.description = appointment.description;
      this.updateAppointmentForm.date_appointment =
        appointment.date_appointment;
      this.updateAppointmentForm.date_end_appointment =
        appointment.date_end_appointment;

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

        axios
          .get(
            this.route(
              "secretary.daughter-profile.appointment.community.index",
              {
                community_id: appointment.community_id,
              }
            )
          )
          .then((res) => {
            // console.log("abs ", res.data);
            this.selectThree.selectedCommunity = res.data;
          });

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
    },
    cancelUpdateIndividualAppointment() {
      this.selectOneUpdate.selectedLevel = null;
      this.selectTwoUpdate.selectedLevelCategory = null;
      this.selectTwoUpdate.options = [];
      this.selectThree.selectedCommunity = null;
      this.selectThree.options = [];
      this.appointmentIndividualBeingUpdated = null;
    },
    updateAppointment() {
      this.updateAppointmentForm.date_appointment = this.formatDate(
        this.updateAppointmentForm.date_appointment
      );
      if (this.updateAppointmentForm.date_end_appointment != null) {
        this.updateAppointmentForm.date_end_appointment = this.formatDate(
          this.updateAppointmentForm.date_end_appointment
        );
      }

      this.updateAppointmentForm.appointment_level_id =
        this.selectTwoUpdate.selectedLevelCategory;
      this.updateAppointmentForm.community_id =
        this.selectThree.selectedCommunity;
      if (
        this.isInvalidLevelUpdate == false &&
        this.isInvalidLevelCategoryUpdate == false &&
        this.isInvalidUpdateCommunity == false
      ) {
        this.updateAppointmentForm.put(
          this.route("secretary.daughter-profile.appointment.update", {
            user_id: this.profile.user_id,
            appointment_id: this.appointmentBeingUpdated.id,
          }),
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              this.appointmentBeingUpdated = null;
              setTimeout(() => {
                this.updateTable();
              }, 1);
              this.selectOneUpdate.selectedLevel = null;
              this.selectTwoUpdate.selectedLevelCategory = null;
              this.selectTwoUpdate.options = [];
              this.selectThree.selectedCommunity = null;
              this.selectThree.options = [];
              this.appointmentBeingUpdated = null;
            },
          }
        );
      }
    },

    // Delete
    confirmationAppointmentDelete(appointment) {
      this.deleteAppointmentForm.name_appointment =
        appointment.appointment_level.name;
      this.deleteAppointmentForm.description = appointment.description;
      this.deleteAppointmentForm.date_appointment =
        appointment.date_appointment;
      this.deleteAppointmentForm.date_end_appointment =
        appointment.date_end_appointment;
      this.appointmentBeingDeleted = appointment;
    },

    deleteAppointment() {
      this.deleteAppointmentForm.delete(
        this.route("secretary.daughter-profile.appointment.delete", {
          user_id: this.profile.user_id,
          appointment_id: this.appointmentBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.appointmentBeingDeleted = null),
            setTimeout(() => {
              this.updateTable();
            }, 1)
          ),
        }
      );
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

    onChange(value) {
      this.value = value;
      //   console.log("aiudaaa> ", value);
      if (value.indexOf("Reset me!") !== -1) {
        // console.log("is reset");
        this.value = [];
      }
    },
    onSelect(option) {
      if (option === "Disable me!") {
        // console.log("is disable");
        this.isDisabled = true;
      }
    },
    onTouch() {
      //   console.log("is touched");
      //   console.log(this.allOffice);
      this.isTouched = true;
    },
  },
};
</script>
