<style>
/* Toggle A */
input:checked ~ .dot {
  transform: translateX(100%);
  background-color: #20c736;
}
</style>

<template>
  <form
    @submit.prevent="submit"
    class="bg-gradient-to-r from-gray-200 via-gray-200 to-gray-200 p-2 border-2 rounded-lg"
  >
    <h6
      class="mt-2 mb-4 text-lg font-medium text-center leading-6 text-black uppercase"
    >
      Editar Perfil Personal
    </h6>

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
            @click="changeStatusProfile()"
          />
          <!-- line -->
          <div class="w-16 h-4 bg-gray-300 rounded-full shadow-inner" />
          <!-- dot  -->
          <!--  1 = Activa, 2 = Fallecida, 3 = Retirada -->
          <!-- Activa -->
          <div
            v-if="this.profile.status == 3"
            class="absolute w-9 h-6 rounded-full shadow -left-1 -top-1 transition"
            style="transform: translateX(100%); background-color: #204de0"
          />
          <!-- Retirada -->
          <div
            v-if="this.profile.status == 1"
            class="absolute w-9 h-6 rounded-full shadow -left-1 -top-1 transition"
            style="transform: translateX(50%); background-color: #5dc720"
          />
          <!-- Fallecida -->
          <div
            v-if="this.profile.status == 2"
            class="absolute w-9 h-6 bg-red-500 rounded-full shadow -left-1 -top-1 transition"
          />
          <!--  -->
          <div
            v-if="this.profile.status == 4"
            class="absolute w-9 h-6 rounded-full shadow -left-1 -top-1 transition"
            style="transform: translateX(100%); background-color: #e0c320"
          />
        </div>
      </label>
    </div>
    <!-- label -->

    <div class="flex items-center justify-center">
      <small class="ml-3 text-gray-700 font-medium"
        >Fallecida / Activo / Retirada / Enviada a Otras Provincias
      </small>
    </div>
    <div class="flex items-center justify-center">
      <br /><br />
      <div v-if="profile.status == 1">(Actual: Activo)</div>
      <div v-if="profile.status == 2">
        (Actual: Fallecida)

        <div class="flex items-center justify-center">
          <div v-if="profile.date_death != null">
            <div class="flex flex-wrap">
              <div class="w-full lg:w-12/12">
                <div class="relative w-full mb-3">
                  <small class="justify-center text-red-500"
                    >Fecha de muerte de la Hermana.</small
                  >
                  <Datepicker
                    v-model="profile.date_death"
                    :format="format"
                    autoApply
                    required
                    readonly
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="profile.status == 3">
        (Actual: Retirada)
        <div class="flex items-center justify-center">
          <div v-if="profile.date_exit != null">
            <div class="flex flex-wrap">
              <div class="w-full lg:w-12/12">
                <div class="relative w-full mb-3">
                  <small class="justify-center text-red-500"
                    >Fecha de retiro de la Hermana.</small
                  >
                  <Datepicker
                    v-model="profile.date_exit"
                    :format="format"
                    autoApply
                    required
                    readonly
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="profile.status == 4">
        (Actual: Enviada a Otras Provincias)
        <div class="flex items-center justify-center">
          <div v-if="profile.date_other_country != null">
            <div class="flex flex-wrap">
              <div class="w-full lg:w-12/12">
                <div class="relative w-full mb-3">
                  <small class="justify-center text-red-500"
                    >Fecha de envío a otro país.</small
                  >
                  <Datepicker
                    v-model="profile.date_other_country"
                    :format="format"
                    autoApply
                    required
                    readonly
                  />
                </div>
              </div>
              <div class="w-full lg:w-12/12">
                <label
                  class="block text-sm font-medium text-black"
                  htmlfor="grid-password"
                >
                  Observaciones
                </label>
                <input
                  type="text"
                  minLength="10"
                  maxlength="10"
                  pattern="^\d{10}$"
                  title="Ingrese un número de celular con un formato válido, máximo 10 digitos."
                  placeholder="0997643146"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  v-model="profile.place_other_country"
                  readonly
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr
      class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-300 hover:border-gray-300"
    />
    <div class="flex flex-wrap">
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
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
            v-show="!validateIdentityCard || form.identity_card == ''"
          >
            Ingresar cédula o RUC válido
          </p>
          <small>Formato: Cédula Ecuatoriana</small>

          <input
            type="text"
            minLength="10"
            maxlength="13"
            placeholder="0102211274 ó 0102211274001"
            pattern="[+-]?\d+(?:[.,]\d+)?"
            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
            v-model="profile.identity_card"
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label class="block text-sm font-medium text-black">
            Carnet IESS
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.iess_card">
            {{ $page.props.errors.iess_card }}
          </p>
          <small>Formato: Carnet IESS</small>

          <input
            type="text"
            minLength="1"
            maxlength="30"
            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
            v-model="profile.iess_card"
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label class="block text-sm font-medium text-black">
            Licencia de Conducir
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.driver_license"
          >
            {{ $page.props.errors.driver_license }}
          </p>
          <small>Formato: Licencia de Conducir</small>

          <input
            type="text"
            minLength="1"
            maxlength="50"
            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
            v-model="profile.driver_license"
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
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
          <small>Formato: Necesario</small>
          <Datepicker
            autoApply
            v-model="profile.date_birth"
            :format="format"
            required
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
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
          <small>Formato: Necesario</small>
          <Datepicker
            autoApply
            v-model="profile.date_vocation"
            :format="format"
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
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
          <small>Formato: Opcional</small>
          <Datepicker
            v-model="profile.date_vocation"
            :format="format"
            autoApply
            readonly
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label class="block text-sm font-medium text-black">
            Fecha de Envío
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.date_send">
            {{ $page.props.errors.date_send }}
          </p>
          <small>Formato: Opcional</small>
          <Datepicker autoApply v-model="profile.date_send" :format="format" />
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <label class="block text-sm font-medium text-black">
          Fecha de Votos
        </label>
        <p class="text-red-400 text-sm" v-show="$page.props.errors.date_vote">
          {{ $page.props.errors.date_vote }}
        </p>
        <small>Formato: Opcional</small>
        <Datepicker autoApply v-model="profile.date_vote" :format="format" />
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-black"
            htmlfor="grid-password"
          >
            Celular
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.cellphone">
            {{ $page.props.errors.cellphone }}
          </p>
          <small>Formato: 0997643146</small>
          <input
            type="text"
            minLength="10"
            maxlength="10"
            pattern="^\d{10}$"
            title="Ingrese un número de celular con un formato válido, máximo 10 digitos."
            placeholder="0997643146"
            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
            v-model="profile.cellphone"
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label
            class="block text-sm font-medium text-black"
            htmlfor="grid-password"
          >
            Teléfono Convencional
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.phone">
            {{ $page.props.errors.phone }}
          </p>
          <small>Formato: 022400111</small>

          <input
            type="text"
            minLength="9"
            maxlength="9"
            pattern="^\d{9}$"
            title="Ingrese un número de telf. con un formato válido, máximo 9 digitos."
            placeholder="022400111"
            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
            v-model="profile.phone"
          />
        </div>
      </div>

      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3">
          <label class="block text-sm font-medium text-black">
            Fecha de Jubilación
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.date_retirement"
          >
            {{ $page.props.errors.date_retirement }}
          </p>
          <small>Formato: Opcional</small>
          <Datepicker
            autoApply
            v-model="profile.date_retirement"
            :format="format"
          />
        </div>
      </div>
      <div class="w-full lg:w-4/12 px-4">
        <div class="relative w-full mb-3"></div>
      </div>
      <br />
      <!-- Address Bt -->
      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-300 hover:border-gray-300"
      />
      <template v-if="profile.origin">
        <div class="w-full lg:w-full px-4">
          <div>
            <label for="address" class="block text-sm font-medium text-black">
              Observaciones Lugar de Nacimiento:
            </label>
            <p
              class="text-red-400 text-sm"
              v-show="$page.props.errors['origin.address']"
            >
              {{ $page.props.errors["origin.address"] }}
            </p>
            <small>Formato: Ingrese la dirección máximo 100 caracteres.</small>
            <div class="mb-1">
              <textarea
                id="origin"
                name="origin"
                rows="1"
                class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 mb-2 block w-full sm:text-sm border border-gray-300 rounded-md"
                v-model="profile.origin['address']"
                placeholder="Agregar la dirección actual.."
                :maxlength="100"
              />
            </div>
          </div>
        </div>
        <div class="w-full lg:w-2/5 px-4 mb-2">
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
        <div class="w-full lg:w-3/5 px-4 mb-2">
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
        <div class="w-full lg:w-12/12 px-4 mb-2">
          <div class="relative w-full">
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
      </template>

      <!-- Address Information -->
      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-300 hover:border-gray-300"
      />

      <div class="w-full lg:w-full px-4">
        <div>
          <label for="address" class="block text-sm font-medium text-black">
            Dirección Actual:
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors['address.address']"
          >
            {{ $page.props.errors["address.address"] }}
          </p>
          <small>Formato: Ingrese la dirección máximo 100 caracteres.</small>
          <div class="mb-1">
            <textarea
              id="address"
              name="address"
              rows="1"
              class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 mb-2 block w-full sm:text-sm border border-gray-300 rounded-md"
              v-model="profile.address['address']"
              placeholder="Agregar la dirección actual.."
              :maxlength="100"
            />
          </div>
        </div>
      </div>
      <div class="w-full lg:w-2/5 px-4 mb-2">
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
            <p class="text-red-400 text-sm" v-show="isInvalidProvince">
              Obligatorio
            </p>
          </div>
        </div>
      </div>
      <div class="w-full lg:w-3/5 px-4 mb-2">
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
      <div class="w-full lg:w-12/12 px-4 mb-2">
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
      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-300 hover:border-gray-300"
      />
      <div class="w-full lg:w-6/12 px-4 mb-2">
        <label
          class="block text-sm font-medium text-black"
          htmlfor="grid-password"
        >
          Libros:
        </label>
        <small>Formato: Seleccionar un Libro.</small>
        <multiselect
          :searchable="true"
          v-model="selectFourBook.selectedBook"
          :options="selectFourBook.options"
          :multiple="true"
          :taggable="true"
          label="name"
          track-by="name"
          placeholder="Buscar Libro"
        >
        </multiselect>
        <p class="text-red-400 text-sm" v-show="isInvalidParish">Opcional</p>
      </div>

      <div class="w-full lg:w-6/12 px-4 mb-2">
        <div>
          <label for="address" class="block text-sm font-medium text-black">
            Páginas:
          </label>
          <p class="text-red-400 text-sm" v-show="$page.props.errors.page">
            {{ $page.props.errors.page }}
          </p>
          <small>Formato: Ingrese las páginas correctamente.</small>
          <div class="mb-1">
            <input
              id="page"
              name="page"
              rows="1"
              class="shadow-sm py-2 px-2 focus:ring-blue-500 focus:border-blue-500 mt-1 mb-2 block w-full sm:text-sm border border-gray-300 rounded-md"
              v-model="profile.page"
              placeholder="Agregar la página"
              :maxlength="100"
            />
          </div>
        </div>
      </div>
      <hr
        class="w-full mt-1 mb-3 ml-4 mr-4 border-b-1 border-gray-300 hover:border-gray-300"
      />
      <!-- Observations -->
      <div class="w-full lg:w-full px-4">
        <div>
          <label for="about" class="block text-sm font-medium text-black">
            Observaciones generales:
          </label>
          <p
            class="text-red-400 text-sm"
            v-show="$page.props.errors.observation"
          >
            {{ $page.props.errors.observation }}
          </p>
          <small
            >Formato: Por favor ingresar las observaciones que usted crea
            pertinente relacionadas al perfil de la Hermana, deberán ser máximo
            4000 caracteres.</small
          >
          <div class="mt-1 bg-white">
            <quill-editor
              v-model:content="profile.observation"
              ref="qleditor1"
              contentType="html"
              theme="snow"
              :toolbar="toolbarOptions"
            ></quill-editor>
          </div>
        </div>
        <div class="mr-9 ml-9 mt-2 text-center">
          <p class="text-sm text-black">
            Fecha creación del perfil:
            {{ this.formatShowDate(profile.created_at) }}
          </p>
          <p class="text-sm text-black">
            Fecha actualización del perfil:
            {{ this.formatShowDate(profile.updated_at) }}
          </p>
        </div>
      </div>
    </div>

    <jet-button type="submit" class="ml-4 mt-4 btn btn-primary"
      >Actualizar Perfil</jet-button
    >
  </form>

  <!-- Community Status Modal -->
  <jet-dialog-modal :show="displayingStatus" @close="displayingStatus = false">
    <template #title>
      <h2 class="text-slate-600">Cambiar el estado del Perfil</h2>
      <div class="mt-2 flex items-center justify-center">
        <span
          class="mx-2 px-1 inline-flex text-sm leading-5 font-semibold rounded-sm bg-gray-100 text-gray-800"
          >&nbsp;Seleccionar:
        </span>

        <span
          v-show="profile.status != 1"
          class="hover:cursor-pointer mx-2 px-1 inline-flex text-xs leading-5 font-semibold rounded-sm bg-green-200 text-green-800"
          @click="changeOperation(1)"
          >&nbsp;Vigente</span
        >
        <span
          v-show="profile.status != 2"
          class="hover:cursor-pointer px-1 inline-flex text-xs leading-5 font-semibold rounded-sm bg-red-200 text-red-800"
          @click="changeOperation(2)"
          >&nbsp;Fallecimiento</span
        >

        <span
          v-show="profile.status != 3"
          class="hover:cursor-pointer mx-2 px-1 inline-flex text-xs leading-5 font-semibold rounded-sm bg-blue-200 text-blue-800"
          @click="changeOperation(3)"
          >&nbsp;Salida</span
        >
        <span
          v-show="profile.status != 4"
          class="hover:cursor-pointer mx-2 px-1 inline-flex text-xs leading-5 font-semibold rounded-sm bg-yellow-200 text-yellow-800"
          @click="changeOperation(4)"
          >&nbsp;Envío a otros Países</span
        >
      </div>
    </template>

    <template #content>
      <div v-if="liveOperationChange == 1">
        Guarde los cambios para habilitar otra vez el perfil de la Hermana en la
        compañía.

        <div class="flex flex-wrap">
          <div class="w-full lg:w-12/12 px-4">
            <div class="relative w-full mt-3">
              <small
                >Observaciones: Tenga en cuenta que una vez que haya guardado
                los presentes cambios la fecha de fallecimiento y la fecha de
                salida de la compañía quedarán eliminadas. Por lo tanto la
                Hermana queda habilitada por completo en la compañía.</small
              >
            </div>
          </div>
        </div>
      </div>

      <div v-if="liveOperationChange == 2">
        Ingrese la fecha en la que la Hermana falleció.

        <div class="flex flex-wrap">
          <div class="w-full lg:w-8/12 px-4">
            <div class="relative w-full mt-3">
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.dateDeathProfile"
              >
                {{ $page.props.errors.dateDeathProfile }}
              </p>
              <small>Formato: Ingresar la fecha de muerte de la Hermana.</small>
              <Datepicker
                v-model="updatedStatusProfileForm.dateDeathProfile"
                :format="format"
                autoApply
                required
              />
            </div>
          </div>
        </div>
      </div>

      <div v-if="liveOperationChange == 3">
        Ingrese la fecha en la que la Hermana salió de la compañía.

        <div class="flex flex-wrap">
          <div class="w-full lg:w-8/12 px-4">
            <div class="relative w-full mt-3">
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.dateExitProfile"
              >
                {{ $page.props.errors.dateExitProfile }}
              </p>
              <small
                >Formato: Ingresar la fecha de finalización de actividades de la
                Hermana.</small
              >
              <Datepicker
                v-model="updatedStatusProfileForm.dateExitProfile"
                :format="format"
                autoApply
                required
              />
            </div>
          </div>
        </div>
      </div>

      <div v-if="liveOperationChange == 4">
        Ingrese la fecha en la que la Hermana fue a otra Compañía.

        <div class="flex flex-wrap">
          <div class="w-full lg:w-8/12 px-4">
            <div class="relative w-full mt-3">
              <p
                class="text-red-400 text-sm"
                v-show="$page.props.errors.dateOtherCountryProfile"
              >
                {{ $page.props.errors.dateOtherCountryProfile }}
              </p>
              <small
                >Formato: Ingresar la fecha de envío a otra Provincia.</small
              >
              <Datepicker
                v-model="updatedStatusProfileForm.dateOtherCountryProfile"
                :format="format"
                autoApply
                required
              />
            </div>
          </div>
          <div class="w-full lg:w-12/12">
            <label
              class="block text-sm font-medium text-black"
              htmlfor="grid-password"
            >
              Observaciones
            </label>
            <input
              type="text"
              title="Ingrese observaciones."
              class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
              v-model="updatedStatusProfileForm.place_other_country"
            />
          </div>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="displayingStatus = false">
        Cerrar
      </jet-secondary-button>

      <jet-button
        class="ml-3"
        @click="storeStatusProfile"
        v-show="liveOperationChange != null"
      >
        Guardar
      </jet-button>
    </template>
  </jet-dialog-modal>
</template>

<script>
import Datepicker from "vue3-date-time-picker";
import { useForm } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button";
import moment from "moment";
import "vue3-date-time-picker/dist/main.css";
import { mapState, mapMutations, mapGetters } from "vuex";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
  components: {
    Datepicker,
    JetButton,
    moment,
    JetDialogModal,
    JetSecondaryButton,
  },

  props: {
    daughter_custom: Object,
    errors: [],
    slug: null,
  },

  mounted() {
    this.getBooks().then((response) => {
      this.selectFourBook.options = response.BooksResponse;
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

    let arrayBooks = [];

    for (let book in this.profile.profile_books) {
      arrayBooks.push(this.profile.profile_books[book].book);
    }

    this.selectFourBook.selectedBook = arrayBooks;
  },

  computed: {
    ...mapState("daughter", ["profile"]),
    ...mapState("address", ["allProvinces"]),
    ...mapState({
      message: (state) => state.obj.message,
    }),

    isInvalidProvince() {
      //   console.log("ee", this.selectOne.selectedProvince);
      return (
        this.selectOne.selectedProvince == undefined ||
        this.selectOne.selectedProvince == null
      );
    },
    isInvalidCanton() {
      //   console.log("ee canton", this.selectTwo.selectedCanton);
      return (
        this.selectTwo.selectedCanton == undefined ||
        this.selectTwo.selectedCanton == null
      );
    },
    isInvalidParish() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.selectThree.selectedParish == undefined ||
        this.selectThree.selectedParish == null
      );
    },
    // Validate ID Card`
    validateIdentityCard() {
      return true;
    },
  },

  watch: {
    "selectOne.selectedProvince": function () {
      if (this.selectOne.selectedProvince === null) {
        this.selectTwo.selectedCanton = null;
        this.selectThree.selectedParish = null;
        this.selectTwo.options = [];
        this.selectThree.options = [];
        // Clean data Form
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
        // Clean data Form
        this.form.canton_id = null;
        this.form.parish_id = null;
        this.form.political_division_id = null;
      }
    },
    "selectThree.selectedParish": function () {
      if (this.selectThree.selectedParish === null) {
        // Clean data Form
        this.form.parish_id = null;
        this.form.political_division_id = null;
      }
    },
    //
    "selectOneBt.selectedProvince": function () {
      if (this.selectOneBt.selectedProvince === null) {
        this.selectTwoBt.selectedCanton = null;
        this.selectThreeBt.selectedParish = null;
        this.selectTwoBt.options = [];
        this.selectThreeBt.options = [];
        // Clean data Form
        this.form.province_id_bt = null;
        this.form.canton_id_bt = null;
        this.form.parish_id_bt = null;
        this.form.political_division_id_bt = null;
      }
    },
    "selectTwoBt.selectedCanton": function () {
      if (this.selectTwoBt.selectedCanton === null) {
        this.selectThreeBt.selectedParish = null;
        this.selectThreeBt.options = [];
        // Clean data Form
        this.form.canton_id_bt = null;
        this.form.parish_id_bt = null;
        this.form.political_division_id_bt = null;
      }
    },
    "selectThreeBt.selectedParish": function () {
      if (this.selectThreeBt.selectedParish === null) {
        // Clean data Form
        this.form.parish_id_bt = null;
        this.form.political_division_id_bt = null;
      }
    },
    "selectFourBook.selectedBook": function () {
      if (this.selectFourBook.selectedBook === null) {
        this.form.profile_books = null;
      }
    },
    "profile.observation": function () {
      var limit = 4000;
      const quill = this.$refs.qleditor1;

      if (quill.getHTML().length <= limit) {
        this.data_intput_one = quill.getHTML();
      } else {
        quill.setHTML(this.data_intput_one);
      }
    },
  },

  setup() {
    const formatSet = "YYYY-MM-DD";
    let date = new Date(0);
    var format = (date) => {
      // console.log("smoke ", date);
      return moment(date).format(formatSet);
    };
    const form = useForm({
      province_id: null,
      canton_id: null,
      parish_id: null,
      political_division_id: null,
    });
    return {
      date,
      format,
      form,
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

      example1: {
        value: "Robin",
        options: ["Batman", "Robin", "Joker"],
      },
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
      selectFourBook: {
        selectedBook: undefined,
        value: 0,
        options: [],
        loading: false,
        multiSelectBook: null,
        vSelectBook: null,
      },
      displayingStatus: false,
      liveOperationChange: null,
      updatedStatusProfileForm: this.$inertia.form({
        dateDeathProfile: null,
        dateExitProfile: null,
        dateOtherCountryProfile: null,
        place_other_country: null,
        operation: null,
      }),
    };
  },

  methods: {
    changeStatusProfile() {
      this.displayingStatus = true;
    },
    changeOperation(value) {
      this.updatedStatusProfileForm.reset();
      this.liveOperationChange = value;
    },
    storeStatusProfile() {
      this.updatedStatusProfileForm.operation = this.liveOperationChange;
      if (this.updatedStatusProfileForm.dateDeathProfile != null) {
        this.updatedStatusProfileForm.dateDeathProfile = this.formatDate(
          this.updatedStatusProfileForm.dateDeathProfile
        );
      }

      if (this.updatedStatusProfileForm.dateExitProfile != null) {
        this.updatedStatusProfileForm.dateExitProfile = this.formatDate(
          this.updatedStatusProfileForm.dateExitProfile
        );
      }

      if (this.updatedStatusProfileForm.dateOtherCountryProfile != null) {
        this.updatedStatusProfileForm.dateOtherCountryProfile = this.formatDate(
          this.updatedStatusProfileForm.dateOtherCountryProfile
        );
      }

      this.updatedStatusProfileForm.put(
        this.route("secretary.daughters-profile.status.update", {
          profile_id: this.profile.id,
        }),
        {
          onSuccess: () => {
            this.displayingStatus = false;
            this.liveOperationChange = null;
            this.updatedStatusProfileForm.reset();
            this.$inertia.get(
              this.route("secretary.daughters.edit", {
                slug: this.slug,
              }),
              {
                preserveScroll: true,
              }
            );
          },
        }
      );
    },

    async status() {
      let response = await axios.get(
        this.route("secretary.address.actual-address", {
          actual_parish: this.profile.address["political_division_id"],
        })
      );
      return response.data;
    },

    async status_bt() {
      if (this.profile.origin["political_division_id"]) {
        let response = await axios.get(
          this.route("secretary.address.actual-address-bt", {
            actual_ubication: this.profile.origin["political_division_id"],
          })
        );
        return response.data;
      }
    },

    async status_bt() {
      if (this.profile.origin["political_division_id"]) {
        let response = await axios.get(
          this.route("secretary.address.actual-address-bt", {
            actual_ubication: this.profile.origin["political_division_id"],
          })
        );
        return response.data;
      }
    },

    async getBooks() {
      let response = await axios.get(this.route("secretary.books.index"));
      return response.data;
    },

    onSearchProvincesChange(term) {},

    onSelectedProvince(province) {
      //   console.log("input data selecter " + province.id);
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
          this.route("secretary.address.cantons", {
            province_id: province.id,
          })
        )
        .then((res) => {
          //   console.log(res.data);
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
          this.route("secretary.address.parishes", {
            canton_id: canton.id,
          })
        )
        .then((res) => {
          this.selectThree.options = res.data;
        });
    },

    onSearchParishChange(term) {},

    onSearchBookChange(term) {},

    onSelectedParish(parish) {
      this.profile.address["political_division_id"] = parish.id;
    },

    onSearchProvincesChangeBt(term) {},

    onSelectedProvinceBt(province) {
      this.form.province_id_bt = province.id;
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
    },

    localData() {
      //   console.log("TIPS " + this.profileDaughter());
    },
    updateMessage(e) {
      this.$store.commit("updateMessage", e.target.value);
    },
    ...mapMutations("daughter", ["updateProfile"]),
    ...mapGetters("daughter", ["profileDaughter"]),

    /*
     * Send Data to Update Data
     */
    submit() {
      this.profile.date_birth = this.formatDate(this.profile.date_birth);
      this.profile.date_vocation = this.formatDate(this.profile.date_vocation);
      this.profile.date_admission = this.formatDate(
        this.profile.date_admission
      );

      this.profile.date_send = this.formatDate(this.profile.date_send);
      this.profile.date_vote = this.formatDate(this.profile.date_vote);
      this.profile.date_death = this.formatDate(this.profile.date_death);

      this.profile.date_retirement = this.formatDate(
        this.profile.date_retirement
      );

      //

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

      if (dataaddresbt) {
        this.profile.origin["political_division_id"] = dataaddresbt;
      }

      this.profile.profile_books = JSON.parse(
        JSON.stringify(this.selectFourBook.selectedBook)
      );

      if (
        this.isInvalidProvince == false &&
        this.isInvalidCanton == false &&
        this.isInvalidParish == false &&
        this.validateIdentityCard == true
      ) {
        Inertia.put(
          route("secretary.daughters-profile.update", {
            profile_custom_id: this.profile.user_id,
          }),
          this.profile,
          {
            preserveScroll: true,
          }
        );
      }
    },

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
    inAscOrder(arr) {
      return arr.every(function (_, i) {
        return i == 0 || arr[i] >= arr[i - 1];
      });
    },
  },

  unmounted() {
    this.$page.props.flash = null;
  },
};
</script>
