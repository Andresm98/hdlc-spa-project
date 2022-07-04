<template>
  <div class="w-full shadow sm:rounded-md">
    <div class="px-4 py-5 m-2 border-2 rounded-lg bg-gray-200 sm:p-6">
      <h6
        class="
          mt-2
          mb-2
          text-lg
          font-medium
          text-center
          leading-6
          text-gray-900
          uppercase
        "
      >
        Plantilla de Cambios
      </h6>

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

      <div class="p-4 bg-white border-2 rounded-lg my-2">
        <p>
          En la siguiente ficha usted puede visualizar la plantilla de
          nombramientos, para ingresar nombramientos tenga en cuenta que todos
          se reflejan a nivel de Compañía, para ello existen tres principales
          categorías (Nivel de Provincia, Nivel de Comunidad Local y Nivel de
          Obras).
        </p>

        <div class="content-center mt-2">
          <jet-button-success
            @click="confirmationTransferCreate()"
            class="block mx-2 p-5 leading-normal"
            >¿Desea crear un nuevo cambio?</jet-button-success
          >
        </div>
      </div>

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

      <!-- Table -->

      <div class="py-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
          <div
            v-if="this.getAllTransfer()"
            class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
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
                  <!-- <th
                    scope="col"
                    class="text-left text-xs font-medium text-black uppercase tracking-wider"
                  >
                    Cargo
                  </th> -->
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
                <tr v-for="transfer in this.getAllTransfer()" :key="transfer">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <svg class="svg-icon" viewBox="1 1 18 18">
                          <path
                            d="M10,1.529c-4.679,0-8.471,3.792-8.471,8.471c0,4.68,3.792,8.471,8.471,8.471c4.68,0,8.471-3.791,8.471-8.471C18.471,5.321,14.68,1.529,10,1.529 M10,17.579c-4.18,0-7.579-3.399-7.579-7.579S5.82,2.421,10,2.421S17.579,5.82,17.579,10S14.18,17.579,10,17.579 M14.348,10c0,0.245-0.201,0.446-0.446,0.446h-5c-0.246,0-0.446-0.201-0.446-0.446s0.2-0.446,0.446-0.446h5C14.146,9.554,14.348,9.755,14.348,10 M14.348,12.675c0,0.245-0.201,0.446-0.446,0.446h-5c-0.246,0-0.446-0.201-0.446-0.446s0.2-0.445,0.446-0.445h5C14.146,12.229,14.348,12.43,14.348,12.675 M7.394,10c0,0.245-0.2,0.446-0.446,0.446H6.099c-0.245,0-0.446-0.201-0.446-0.446s0.201-0.446,0.446-0.446h0.849C7.194,9.554,7.394,9.755,7.394,10 M7.394,12.675c0,0.245-0.2,0.446-0.446,0.446H6.099c-0.245,0-0.446-0.201-0.446-0.446s0.201-0.445,0.446-0.445h0.849C7.194,12.229,7.394,12.43,7.394,12.675 M14.348,7.325c0,0.246-0.201,0.446-0.446,0.446h-5c-0.246,0-0.446-0.2-0.446-0.446c0-0.245,0.2-0.446,0.446-0.446h5C14.146,6.879,14.348,7.08,14.348,7.325 M7.394,7.325c0,0.246-0.2,0.446-0.446,0.446H6.099c-0.245,0-0.446-0.2-0.446-0.446c0-0.245,0.201-0.446,0.446-0.446h0.849C7.194,6.879,7.394,7.08,7.394,7.325"
                          ></path>
                        </svg>
                      </div>
                      <div class="ml-4 sm:w-8/8 md:w-8/8 lg:w-6/8 ...">
                        <div
                          class="
                            whitespace-normal
                            text-sm
                            font-semibold
                            text-gray-900
                            hover:text-blue-500
                          "
                        >
                          <div
                            v-if="
                              transfer.community.comm_level == 1 &&
                              transfer.community.comm_id == null
                            "
                          >
                            <a
                              :href="
                                route('secretary.communities.edit', {
                                  slug: transfer.community.comm_slug,
                                })
                              "
                              target="_blank"
                            >
                              {{ transfer.community.comm_name }}.
                            </a>
                          </div>
                          <div
                            v-if="
                              transfer.community.comm_level == 2 &&
                              transfer.community.comm_id != null
                            "
                          >
                            <a
                              :href="
                                route('secretary.works.edit', {
                                  slug: transfer.community.comm_slug,
                                })
                              "
                              target="_blank"
                            >
                              {{ transfer.community.comm_name }}.
                            </a>
                          </div>
                        </div>
                        <span
                          v-if="transfer.status == 1"
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
                          Activo
                        </span>
                        <span
                          v-if="transfer.status == 0"
                          class="
                            px-2
                            inline-flex
                            text-xs
                            leading-5
                            font-semibold
                            rounded-full
                            bg-red-100
                            text-red-800
                          "
                        >
                          Historial
                        </span>
                      </div>
                    </div>
                  </td>

                  <td
                    class="px-6 py-4 whitespace-nowrap"
                    v-if="transfer.transfer_date_relocated == null"
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
                      {{ this.formatDateShow(transfer.transfer_date_adission) }}
                      -
                      {{
                        this.formatDateShow(transfer.transfer_date_relocated)
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
                      {{ this.formatDateShow(transfer.transfer_date_adission) }}
                      -
                      {{
                        this.formatDateShow(transfer.transfer_date_relocated)
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
                      <jet-button @click="confirmationTransferUpdate(transfer)"
                        >Detalles</jet-button
                      >
                      <jet-danger-button
                        @click="confirmationTransferDelete(transfer)"
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
                      >Formato: Seleccionar la comunidad u obra a la que se
                      cambia la hermana.</small
                    >
                    <div :class="{ invalid: isInvalidCommunity }">
                      <div v-if="this.allWork != null">
                        <multiselect
                          :searchable="true"
                          placeholder="Por favor seleccionar la comunidad a la que va"
                          select-label="Seleccionar!"
                          v-model="this.form.transfer.community_id"
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
                          v-show="isInvalidCommunity"
                        >
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

              <div
                class="w-full lg:w-6/12 px-4"
                v-if="this.statustransfer == 0"
              >
                <div class="relative w-full mb-3">
                  <label
                    class="block text-sm font-medium text-gray-700"
                    htmlfor="grid-password"
                  >
                    Fecha Culminación:
                  </label>

                  <small
                    >Formato: Fecha de cierre de actividades (opcional).</small
                  >
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
                    <small
                      >Formato: Seleccionar el nombramiento específico.</small
                    >
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
                      >Formato: Seleccionar la comunidad u obra en la que
                      cumplirá sus funciones.</small
                    >
                    <!-- <div :class="{ invalid: isInvalidCommunityTwo }"> -->
                    <div v-if="this.allWork != null">
                      <multiselect
                        :searchable="true"
                        placeholder="Por favor seleccionar la comunidad a la que va"
                        select-label="Seleccionar!"
                        v-model="this.form.transfer.community_id"
                        :options="this.allWork"
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
                        v-show="isInvalidCommunity"
                      >
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

                <div
                  class="w-full lg:w-6/12 px-4"
                  v-if="this.statustransfer == 0"
                >
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

          <jet-button
            class="ml-3"
            @click="navigation(1)"
            v-if="navigationOp == 1"
          >
            Siguiente
          </jet-button>

          <jet-button
            class="ml-3"
            @click="navigation(2)"
            v-if="navigationOp == 2"
          >
            Anterior
          </jet-button>

          <jet-button-success
            class="ml-3"
            @click="submit"
            v-if="navigationOp == 2"
          >
            Guardar
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

      <jet-dialog-modal
        :max-width="'input-md'"
        :show="transferBeingUpdated"
        @close="transferBeingUpdated == null"
      >
        <template #title> Datos de Registro del Cambio</template>

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
                    >Formato: Seleccionar la comunidad u obra a la que se cambia
                    la hermana.</small
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
                user_id: this.profile.user_id,
                transfer_id: this.transferBeingUpdated.id,
              })
            "
          >
            <jet-button class="ml-3">Imprimir</jet-button></a
          >
          <jet-button
            class="ml-3"
            @click="navigation(1)"
            v-if="navigationOp == 1"
          >
            Siguiente
          </jet-button>

          <jet-button
            class="ml-3"
            @click="navigation(2)"
            v-if="navigationOp == 2"
          >
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

import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";
import "vue3-date-time-picker/dist/main.css";
import { ref } from "vue";
import { mapState, mapMutations, mapGetters, mapActions } from "vuex";
import JetInputError from "@/Jetstream/InputError";
import Alert from "@/Components/Alert";

export default {
  props: {
    errors: {
      transfer: {
        transfer_reason: null,
      },
    },
  },
  created() {
    axios.get(this.route("secretary.offices.index")).then((res) => {
      this.updateAllOffice(res.data);
    });

    axios
      .get(this.route("secretary.daughter-profile.transfer.communities.index"))
      .then((res) => {
        // console.log(res.data);
        this.updateAllWork(res.data);
      });
  },
  mounted() {
    this.allTransfer;
    this.allAppointment;
    this.allAppointmentLevel;
  },
  computed: {
    isInvalid() {
      //   console.log("inva ", this.isTouched, "\n\nopp> ");
      return this.value == null;
    },
    ...mapState("daughter", ["profile"]),
    ...mapState("transfer", ["transfer"]),
    ...mapState("transfer", ["allOffice"]),
    ...mapState("work", ["work"]),
    ...mapState("work", ["allWork"]),

    //
    ...mapState("daughter", ["profile"]),
    ...mapState("appointment", ["appointment"]),

    allTransfer() {
      axios
        .get(
          this.route("secretary.daughter-profile.transfer.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          //   console.log("computed ", res.data);
          this.updateAllTransfer(res.data);
        });
    },

    allAppointment() {
      axios
        .get(
          this.route("secretary.daughter-profile.appointment.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
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
        this.form.transfer.community_id == undefined ||
        this.form.transfer.community_id == null
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
  },
  // Relashionship with another components
  components: {
    Alert,
    Datepicker,
    JetButtonSuccess,
    JetButton,
    JetConfirmationModal,
    JetDangerButton,
    JetSecondaryButton,
    JetInputError,
    JetInput,
    JetDialogModal,
    JetFormSection,
    moment,
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
  methods: {
    ...mapActions("appointment", ["updateAllAppointment"]),
    ...mapGetters("appointment", ["getAllAppointment"]),
    ...mapActions("transfer", ["updateAllTransfer"]),
    ...mapActions("transfer", ["updateAllOffice"]),
    ...mapActions("transfer", ["getAllOffice"]),
    ...mapGetters("transfer", ["getAllTransfer"]),
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
      this.selectCategory.selectedLevelCategory = null;
    },
    cancelUpdate() {
      this.transferBeingUpdated = null;
      this.navigationOp = 1;
      this.statustransfer = 0;
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
      //   console.log("data send", this.form);
      this.form.transfer.community_id = this.form.transfer.community_id.id;

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
      //   if (this.isInvalidCommunity == false && this.isInvalidOffice == false) {
      if (
        this.isInvalidCommunity == false &&
        this.isInvalidLevel == false &&
        this.isInvalidLevelCategory == false
      ) {
        Inertia.post(
          route("secretary.daughter-profile.transfer.store", {
            user_id: this.profile.user_id,
          }),
          this.form,
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              setTimeout(() => {
                this.updateTable();
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
            user_id: this.profile.user_id,
            transfer_id: this.transferBeingUpdated.id,
          }),
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              this.transferBeingUpdated = null;
              setTimeout(() => {
                this.updateTable();
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
          user_id: this.profile.user_id,
          transfer_id: this.transferBeingDeleted.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => (
            (this.transferBeingDeleted = null),
            setTimeout(() => {
              this.updateTable();
            }, 1)
          ),
        }
      );
    },

    //

    updateTable() {
      axios
        .get(
          this.route("secretary.daughter-profile.transfer.index", {
            user_id: this.profile.user_id,
          })
        )
        .then((res) => {
          this.updateAllTransfer(res.data);
        });
    },

    showAlert() {
      // Use sweetalert2
      this.$swal("Hello Vue world!!!");
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
