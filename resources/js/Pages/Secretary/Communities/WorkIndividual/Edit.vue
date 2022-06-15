<template @scroll="handleScroll">
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Editar Obra
      </h2>
      <div class="text-sm text-blue-700 mt-3 mb-6">
        Bienvenido Usuario: {{ $page.props.user.name }}
      </div>
    </template>
    <alert
      v-if="$page.props.flash.success"
      class="alert"
      :type_alert_r="(type_alert = 'success')"
      :message="$page.props.flash.success"
    >
    </alert>
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
        m-1
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
            Información General de la Obra
          </p>
        </div>
        <div
          class="
            grid
            gap-4
            col-start-1 col-end-3
            row-start-1
            sm:mb-6 sm:grid-cols-4
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
              lg:col-span-full
            "
            loading="lazy"
          />
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_3.png"
            alt=""
            class="
              hidden
              w-full
              h-52
              object-cover
              rounded-lg
              sm:block sm:col-span-2
              md:col-span-1
              lg:row-start-2 lg:col-span-2 lg:h-32
            "
            loading="lazy"
          />
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_1.png"
            alt=""
            class="
              hidden
              w-full
              h-52
              object-cover
              rounded-lg
              md:block
              lg:row-start-2 lg:col-span-2 lg:h-32
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
            md:mt-2.5
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
        {{ $page.props.errors }}vggg
        <div
          class="
            mt-4
            col-start-1
            row-start-3
            self-center
            sm:mt-0 sm:col-start-2 sm:row-start-2 sm:row-span-2
            lg:mt-6 lg:col-start-1 lg:row-start-3 lg:row-end-4
          "
        >
          <button
            type="button"
            class="
              bg-blue-600
              text-white text-sm
              leading-6
              font-medium
              py-2
              px-3
              rounded-lg
            "
          >
            <!--
                        FIXME: Import Controllers For PDF-->
            Plantilla PDF
          </button>
          <div
            class="
              mt-4
              text-sm
              leading-6
              col-start-1
              sm:col-span-2
              lg:mt-6 lg:row-start-4 lg:col-span-1
              text-black
              dark:text-white
            "
          >
            <p>
              La presente plantiflla de información se relaciona con los datos
              principales de la obra a la que desea modificar al sistema, por lo
              que deberá verificar los datos a ingresar.
            </p>
            <ul class="list-disc pl-5">
              <li class="dark:text-white">
                <p class="mt-2 pt-6 text-sm uppercase">
                  Nombre de la obra único en el sistema.
                </p>
              </li>
              <li class="dark:text-white">
                <p class="text-sm uppercase dark:text-white">
                  Correo electrónico único en el sistema.
                </p>
              </li>
              <li class="dark:text-white">
                <p class="text-sm uppercase dark:text-white">
                  Números de contacto.
                </p>
              </li>
              <li class="dark:text-white">
                <p class="text-sm uppercase dark:text-white">
                  Fechas de fundación de la obra.
                </p>
              </li>
              <li class="dark:text-white">
                <p class="text-sm uppercase dark:text-white">
                  Número de colaboradores.
                </p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="py-1 bg-slate-800 rounded-lg m-1">
      <div class="w-full lg:w-5/6 px-4 mx-auto mt-6">
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
          <div class="bg-gray-100 hover:bg-slate-100 rounded-lg">
            <form @submit.prevent="submit" class="">
              <div class="rounded-t bg-white mb-0 px-6 py-6">
                <div class="text-center flex justify-between">
                  <h6 class="text-sm font-medium leading-6 text-gray-900">
                    Tarjeta de Información General de la Obra.
                  </h6>

                  <button
                    class="
                      bg-blue-500
                      hover:bg-blue-700
                      text-white
                      active:bg-blue-600
                      font-bold
                      uppercase
                      text-xs
                      px-4
                      py-2
                      rounded
                      shadow
                      hover:shadow-md
                      outline-none
                      focus:outline-none
                      mr-1
                      ease-linear
                      transition-all
                      duration-150
                    "
                    type="submit"
                  >
                    Guardar Tarjeta
                  </button>
                </div>
              </div>
              <hr />
              <h6
                class="
                  mt-2
                  text-lg
                  font-medium
                  text-center
                  leading-6
                  text-gray-900
                "
              >
                Información General
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
                      :value="this.community_custom.comm_level"
                      @click="changeStatusCommunity()"
                    />
                    <!-- line -->
                    <div
                      class="w-10 h-4 bg-gray-200 rounded-full shadow-inner"
                    />
                    <!-- dot -->
                    <div
                      v-if="this.community_custom.comm_status == 1"
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
                      v-else
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
              <!-- label -->
              <div class="flex items-center justify-center">
                <small class="ml-3 text-gray-700 font-medium"
                  >¿La obra se encuentra activa? ¿No / Si?</small
                >
              </div>

              <div class="flex items-center justify-center">
                <div v-if="this.community_custom.date_close != null">
                  <div class="flex flex-wrap">
                    <div class="w-full lg:w-12/12">
                      <div class="relative w-full mb-3">
                        <jet-input-error :message="errors.date_close" />
                        <small class="justify-center text-red-500"
                          >Fecha de cierre de la obra.</small
                        >
                        <Datepicker
                          v-model="this.community_custom.date_close"
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
              <!-- End toogle -->

              <div class="flex flex-wrap">
                <div class="w-full lg:w-3/3 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Nombre de Obra:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.comm_name"
                    >
                      {{ $page.props.errors.comm_name }}
                    </p>
                    <small>Formato: Ingresar nombre de la comunidad.</small>
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <input
                        type="text"
                        name="company-website"
                        id="company-website"
                        class="
                          focus:ring-blue-500 focus:border-blue-500
                          flex-1
                          block
                          w-full
                          rounded-none rounded-l-md
                          sm:text-sm
                          border-gray-300
                        "
                        placeholder="www.example.com"
                        v-model="this.nameComplete"
                      />
                      <span
                        class="
                          inline-flex
                          items-center
                          px-3
                          rounded-r-md
                          border border-r-0 border-gray-300
                          bg-gray-50
                          text-gray-500 text-sm
                        "
                      >
                        {{ this.postfix }}
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="flex flex-wrap">
                <div class="w-full lg:w-4/12 px-4">
                  <label
                    class="block text-sm font-medium text-gray-700"
                    htmlfor="grid-password"
                  >
                    Correo Electrónico:
                  </label>
                  <p
                    class="text-red-400 text-sm"
                    v-show="$page.props.errors.comm_email"
                  >
                    {{ $page.props.errors.comm_email }}
                  </p>
                  <small
                    >Formato: Ingresar correo electrónico de contacto.</small
                  >

                  <input
                    type="email"
                    placeholder="micorreo@correo.com"
                    class="
                      border-0
                      px-3
                      mb-3
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
                    v-model="form.comm_email"
                  />
                </div>
                <div class="w-full lg:w-4/12 px-4">
                  <label
                    class="block text-sm font-medium text-gray-700"
                    htmlfor="grid-password"
                  >
                    Número de RUC:
                  </label>
                  <p
                    class="text-red-400 text-sm"
                    v-show="
                      !validateIdentityCard ||
                      this.form.comm_identity_card == ''
                    "
                  >
                    Ingresar RUC válido
                  </p>
                  <small>Formato: Ingresar RUC Formato Ecuador. </small>

                  <input
                    type="text"
                    minLength="10"
                    maxlength="13"
                    placeholder="0102211274 ó 0102211274001"
                    pattern="[+-]?\d+(?:[.,]\d+)?"
                    class="
                      border-0
                      px-3
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
                    v-model="form.comm_identity_card"
                    @keydown.space.prevent
                    required
                  />
                </div>
                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Zona:
                    </label>
                    <small
                      >Opcional: Seleccionar una zona a la que pertenezca la
                      comunidad.</small
                    >
                    <div v-if="this.allZone != null">
                      <multiselect
                        :searchable="true"
                        v-model="this.selectFive.selectedZone"
                        :options="this.allZone"
                        :close-on-select="true"
                        :clear-on-select="false"
                        mode="tags"
                        label="name"
                        @search-change="onSearchZonesChange"
                        @select="onSelectedZone"
                        track-by="name"
                        placeholder="Buscar zona"
                      >
                      </multiselect>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex flex-wrap">
                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Fecha de Fundación:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.date_fndt_comm"
                    >
                      {{ $page.props.errors.date_fndt_comm }}
                    </p>
                    <small
                      >Formato: Ingresar la fecha de fundación de la
                      comunidad.</small
                    >
                    <Datepicker
                      v-model="form.date_fndt_comm"
                      :format="format"
                      autoApply
                      required
                    />
                  </div>
                </div>

                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Fecha de la Obra:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.date_fndt_work"
                    >
                      {{ $page.props.errors.date_fndt_work }}
                    </p>
                    <small>Formato: Ingresar la fecha de la obra.</small>

                    <Datepicker
                      v-model="form.date_fndt_work"
                      :format="format"
                      autoApply
                    />
                  </div>
                </div>

                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Celular:
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.comm_cellphone"
                    >
                      {{ $page.props.errors.comm_cellphone }}
                    </p>
                    <small>Formato: Ingresar un número de celular.</small>

                    <input
                      minLength="10"
                      maxlength="20"
                      pattern="[0-9]+"
                      placeholder="123-4567-890"
                      type="text"
                      class="
                        border-0
                        px-3
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
                      v-model="form.comm_cellphone"
                      @keydown.space.prevent
                    />
                  </div>
                </div>

                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Teléfono
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.comm_phone"
                    >
                      {{ $page.props.errors.comm_phone }}
                    </p>
                    <small>Formato: Ingresar un número de teléfono.</small>

                    <input
                      minLength="8"
                      maxlength="20"
                      pattern="[0-9]+"
                      placeholder="123-4567-890"
                      type="text"
                      class="
                        border-0
                        px-3
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
                      v-model="form.comm_phone"
                      @keydown.space.prevent
                    />
                  </div>
                </div>

                <div class="w-full lg:w-3/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Nro. de Colaboradores
                    </label>

                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.rn_collaborators"
                    >
                      {{ $page.props.errors.rn_collaborators }}
                    </p>
                    <small>Formato: Número de colaboradores, max 1000.</small>

                    <input
                      minLength="0"
                      maxlength="1000"
                      pattern="[0-9]+"
                      placeholder="Nro. de Colaboradores"
                      type="number"
                      class="
                        border-0
                        px-3
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
                      v-model="form.rn_collaborators"
                      required
                    />
                  </div>
                </div>

                <div class="w-full lg:w-5/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Pastoral
                    </label>
                    <small
                      >Formato: Seleccionar la pastoral a la que pertenece la
                      comunidad.</small
                    >
                    <div
                      :class="{ invalid: isInvalidPastoral }"
                      v-if="this.allPastoral != null"
                    >
                      <multiselect
                        :searchable="true"
                        v-model="this.selectFour.selectedPastoral"
                        :options="this.allPastoral"
                        :close-on-select="true"
                        :clear-on-select="false"
                        mode="tags"
                        label="name"
                        @search-change="onSearchPastoralsChange"
                        @select="onSelectedPastoral"
                        track-by="name"
                        placeholder="Buscar pastoral"
                      >
                      </multiselect>
                      <p
                        class="text-red-400 text-sm"
                        v-show="isInvalidPastoral"
                      >
                        Obligatorio
                      </p>
                    </div>
                  </div>
                </div>
                <!-- Information Address -->
                <hr
                  class="
                    mt-1
                    mb-3
                    ml-4
                    mr-4
                    border-b-1 border-blueGray-300
                    hover:border-blueGray-100
                  "
                />
                <div class="w-full lg:w-full px-4">
                  <div>
                    <label
                      for="address"
                      class="block text-sm font-medium text-gray-700"
                    >
                      Dirección Actual
                    </label>
                    <p
                      class="text-red-400 text-sm"
                      v-show="$page.props.errors.address"
                    >
                      {{ $page.props.errors.address }}
                    </p>
                    <small
                      >Formato: Dirección actual en la que se encuentra la
                      comunidad.</small
                    >
                    <div class="mb-1">
                      <textarea
                        id="address"
                        name="address"
                        rows="1"
                        class="
                          shadow-sm
                          focus:ring-blue-500 focus:border-blue-500
                          mt-1
                          mb-2
                          block
                          w-full
                          sm:text-sm
                          border border-gray-300
                          rounded-md
                        "
                        v-model="form.address"
                        placeholder="Agregar la dirección actual.."
                        :maxlength="100"
                        required
                      />
                    </div>
                  </div>
                </div>

                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Provincia
                    </label>
                    <div :class="{ invalid: isInvalidProvince }">
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
                <div class="w-full lg:w-8/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Cantón
                    </label>
                    <div :class="{ invalid: isInvalidCanton }">
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
                      <p class="text-sm text-red-400" v-show="isInvalidCanton">
                        Obligatorio
                      </p>
                    </div>
                  </div>
                </div>

                <div class="w-full lg:w-12/12 px-4 mb-2">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Parroquia
                    </label>
                    <div :class="{ invalid: isInvalidParish }">
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
                      <p class="text-sm text-red-400" v-show="isInvalidParish">
                        Obligatorio
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <hr
              class="
                mt-1
                mb-3
                ml-4
                mr-4
                border-b-1 border-blueGray-300
                hover:border-blueGray-100
              "
            />
            <div class="mx-6 my-2 w-9/12">
              <h2 class="text-center text-lg">Menú de Operaciones</h2>
              <div>
                <multiselect
                  placeholder="Seleccionar"
                  select-label="Si desea presione ENTER para seleccionar elementos"
                  v-model="selectMenu.selectedElement"
                  :options="selectMenu.options"
                  :max-height="250"
                  :searchable="true"
                ></multiselect>
              </div>
            </div>
            <!-- Options -->
            <div v-if="selectMenu.selectedElement == 'Actividades'">
              <activities></activities>
            </div>
            <div v-if="selectMenu.selectedElement == 'Resumen Anual'">
              <resumes></resumes>
            </div>
            <div v-if="selectMenu.selectedElement == 'Visitas'">
              <visits></visits>
            </div>
            <div v-if="selectMenu.selectedElement == 'Inventario'">
              <inventories></inventories>
            </div>
            <div v-if="selectMenu.selectedElement == 'Hermanas'">
              <daughters></daughters>
            </div>
            <div v-if="selectMenu.selectedElement == 'Documentos'">
              <files></files>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Community Status Modal -->
    <jet-dialog-modal
      :show="displayingStatus"
      @close="displayingStatus = false"
    >
      <template #title
        ><h2 class="text-slate-600">
          Cambiar el estado de la comunidad
        </h2></template
      >

      <template #content>
        <div>
          Ingrese la fecha en la que la comunidad u obra se cerró.

          <div class="flex flex-wrap">
            <div class="w-full lg:w-8/12 px-4">
              <div class="relative w-full mt-3">
                <p
                  class="text-red-400 text-sm"
                  v-show="$page.props.errors.dateCloseCommunity"
                >
                  {{ $page.props.errors.dateCloseCommunity }}
                </p>
                <small
                  >Formato: Ingresar la fecha de cierre de la comunidad.</small
                >
                <Datepicker
                  v-model="updatedStatusPastoralForm.dateCloseCommunity"
                  :format="format"
                  autoApply
                  required
                />
              </div>
            </div>
          </div>
        </div>
      </template>

      <template #footer>
        <jet-secondary-button @click="displayingStatus = false">
          Cerrar
        </jet-secondary-button>

        <jet-button class="ml-3" @click="storeStatusCommunity">
          Guardar
        </jet-button>
      </template>
    </jet-dialog-modal>
  </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetButton from "@/Jetstream/Button";
import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";
import JetCheckbox from "@/Jetstream/Checkbox";
import Alert from "@/Components/Alert";
import { ref } from "vue";
import Datepicker from "vue3-date-time-picker";
import moment from "moment";
import { mapState, mapActions, mapGetters } from "vuex";

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";
// Import Swiper styles
import "swiper/css";
import "swiper/css/pagination";
import "../../../../../css/style.css";
// import required modules
import { Pagination } from "swiper";

// Import Custom Components
import Activities from "@/Pages/Secretary/Communities/Activities/Index";
import Resumes from "@/Pages/Secretary/Communities/Resumes/Index";
import Visits from "@/Pages/Secretary/Communities/Visits/Index";
import Inventories from "@/Pages/Secretary/Communities/Inventories/Index";
import Daughters from "@/Pages/Secretary/Communities/Daughters/Index";
import Files from "@/Pages/Secretary/Communities/Files/Index";

export default defineComponent({
  created() {
    // console.log("created " + this.$el);
    this.uploadProvinces(this.provinces);

    // Method fetch

    fetch(this.route("secretary.pastoral.index"))
      .then(async (response) => {
        const isJson = response.headers
          .get("content-type")
          ?.includes("application/json");
        const data = isJson && (await response.json());
        if (!response.ok) {
          const error = (data && data.message) || response.status;
          return Promise.reject(error);
        }
        this.allPastoral = data;
      })
      .catch((error) => {
        element.parentElement.innerHTML = `Error: ${error}`;
        console.error("There was an error!", error);
      });

    // Method fetch Zones

    fetch(this.route("secretary.zone.index"))
      .then(async (response) => {
        const isJson = response.headers
          .get("content-type")
          ?.includes("application/json");
        const data = isJson && (await response.json());
        if (!response.ok) {
          const error = (data && data.message) || response.status;
          return Promise.reject(error);
        }
        this.allZone = data;
      })
      .catch((error) => {
        element.parentElement.innerHTML = `Error: ${error} `;
        console.log("There was an error", error);
      });
  },

  beforeMount() {
    // console.log("mounted " + this.$el);
    // if (this.profile_daughter == null) {
    //   this.changeUserId(this.community_custom.id);
    // } else {
    //   this.changeUser(this.profile_daughter);
    // }
  },
  mounted() {
    if (this.community_custom.address != null) {
      this.status().then((data) => {
        //   console.log(data);
        this.selectThree.options = data.parishes;
        this.selectThree.selectedParish = data.data_parish;

        this.selectTwo.options = data.cantons;
        this.selectTwo.selectedCanton = data.data_canton;

        this.selectOne.selectedProvince = data.data_province;
      });
    }
    this.changeCommunity(this.community_custom);
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
      pagination: {
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="' + className + '">' + (index + 1) + "</span>";
        },
      },
      modules: [Pagination],
    };
  },
  props: {
    community_custom: Object,
    errors: null,
    image: String,
    address: Object,
    provinces: {
      type: Array,
    },
    prefix: null,
    postfix: null,
  },
  computed: {
    ...mapGetters("daughter", ["actualCount"]),
    ...mapState("address", ["allProvinces"]),
    ...mapState("community", ["community"]),

    // Validate Multioption
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
    isInvalidPastoral() {
      //   console.log("ee Parish", this.selectThree.selectedParish);
      return (
        this.selectFour.selectedPastoral == undefined ||
        this.selectFour.selectedPastoral == null
      );
    },

    // Validate ID Card`
    validateIdentityCard() {
      this.form.comm_identity_card = this.form.comm_identity_card + "";
      if (this.form.comm_identity_card == null) {
        return false;
      }
      if (
        this.form.comm_identity_card.length == 10 ||
        this.form.comm_identity_card.length == 13
      ) {
        const digit = this.form.comm_identity_card.split("").map(Number);
        //   console.log(digit);
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
  },
  layout: PrincipalLayout,
  components: {
    Link,
    Swiper,
    SwiperSlide,
    JetInputError,
    JetInput,
    JetLabel,
    JetButton,
    JetCheckbox,
    JetDialogModal,
    JetSecondaryButton,
    Activities,
    Resumes,
    Visits,
    Inventories,
    Daughters,
    Files,
    Datepicker,
    moment,
    Alert,
    AppLayout,
  },

  data() {
    return {
      nameComplete: this.prefix,
      isDisabled: false,
      isTouched: false,
      selectMenu: {
        selectedElement: null,
        isDisabled: false,
        isTouched: false,
        options: [
          "Actividades",
          "Resumen Anual",
          "Visitas",
          "Inventario",
          "Hermanas",
          "Documentos",
        ],
        loading: false,
        multiSelectUser: null,
        vSelectUser: null,
      },
      //
      form: useForm({
        comm_identity_card: this.community_custom.comm_identity_card,
        comm_name: this.community_custom.comm_name,
        comm_cellphone: this.community_custom.comm_cellphone,
        comm_phone: this.community_custom.comm_phone,
        comm_email: this.community_custom.comm_email,
        date_fndt_comm: this.community_custom.date_fndt_comm,
        date_fndt_work: this.community_custom.date_fndt_work,
        rn_collaborators: this.community_custom.rn_collaborators,
        address: null,
        province_id: null,
        canton_id: null,
        parish_id: null,
        political_division_id: null,
        pastoral_id: null,
        zone_id: null,
        file: null,
      }),
      photoPreview: null,
      url: null,
      //Provinces
      selectOne: {
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
      selectFour: {
        selectedPastoral: this.community_custom.pastoral,
        value: 0,
        options: [],
        loading: false,
        multiSelectPastoral: null,
        vSelectPastoral: null,
      },
      selectFive: {
        selectedZone: this.community_custom.zone,
        value: 0,
        options: [],
        loading: false,
        multiSelectZone: null,
        vSelectZone: null,
      },
      allPastoral: null,
      allZone: null,
      displayingStatus: false,
      updatedStatusPastoralForm: this.$inertia.form({
        dateCloseCommunity: null,
      }),
    };
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
  },
  methods: {
    changeStatusCommunity() {
      if (
        this.community_custom.date_close == null &&
        this.community_custom.comm_status == 1
      ) {
        this.displayingStatus = true;
      } else {
        this.displayingStatus = false;
        Inertia.put(
          this.route("secretary.worksindividual.status.update", {
            work_id: this.community_custom.id,
          }),
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              this.displayingStatus = false;
            },
          }
        );
      }
    },

    storeStatusCommunity() {
      if (this.updatedStatusPastoralForm.dateCloseCommunity != null) {
        this.updatedStatusPastoralForm.dateCloseCommunity = this.formatDate(
          this.updatedStatusPastoralForm.dateCloseCommunity
        );
      }

      this.updatedStatusPastoralForm.put(
        this.route("secretary.worksindividual.status.update", {
          work_id: this.community_custom.id,
        }),
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: () => {
            this.displayingStatus = false;
            this.updatedStatusPastoralForm.reset();
          },
        }
      );
    },

    handleScroll() {
      console.log(window.scrollY);
      console.log("numme");
    },
    async status() {
      this.form.address = this.community_custom.address["address"];
      this.form.political_division_id =
        this.community_custom.address["political_division_id"];
      let response = await axios.get(
        this.route("secretary.address.actual-address", {
          actual_parish: this.community_custom.address["political_division_id"],
        })
      );
      return response.data;
    },
    ...mapActions("community", ["changeCommunity"]),

    onSearchPastoralsChange() {},
    onSelectedPastoral(pastoral) {
      this.form.pastoral_id = pastoral.id;
    },
    onSearchZonesChange() {},
    onSelectedZone(zone) {
      this.form.zone_id = zone.id;
    },
    onSearchProvincesChange(term) {
      //   console.log("input data search " + term);
    },

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

    onSearchCantonChange(term) {
      //   console.log(term);
    },

    onSelectedCanton(canton) {
      //   console.log("input data selecter " + canton.id);
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
          //   console.log(res.data);
          this.selectThree.options = res.data;
        });
    },

    onSearchParishChange(term) {
      //   console.log(term);
    },

    onSelectedParish(parish) {
      this.form.parish_id = parish.id;
      this.form.political_division_id = parish.id;
      //   console.log("input parish data selecter " + this.form.parish_id);
    },

    // ...mapActions("daughter", ["increment"]),

    // ...mapActions("daughter", ["changeUser"]),

    // ...mapActions("daughter", ["changeUserId"]),

    ...mapActions("address", ["uploadProvinces"]),

    onFileChange(e) {
      const file = e.target.files[0];
      this.url = URL.createObjectURL(file);
    },
    formatDate(value) {
      return moment(new Date(value)).format("YYYY-MM-DD 00:00:00");
    },
    submit() {
      this.form.date_fndt_comm = this.formatDate(this.form.date_fndt_comm);
      if (this.form.date_fndt_work != null) {
        this.form.date_fndt_work = this.formatDate(this.form.date_fndt_work);
      }
      if (
        this.isInvalidProvince == false &&
        this.isInvalidCanton == false &&
        this.isInvalidPastoral == false &&
        this.isInvalidParish == false &&
        this.validateIdentityCard == true
      ) {
        this.form.comm_name = this.nameComplete + "" + this.postfix;
        this.form.pastoral_id = this.selectFour.selectedPastoral.id;
        if (this.selectFive.selectedZone != null) {
          this.form.zone_id = this.selectFive.selectedZone.id;
        }
        this.form.put(
          route("secretary.worksindividual.update", {
            work_id: this.community_custom.id,
          }),
          {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
              setTimeout(() => {
                this.form.reset();
              }, 1000);
            },
          }
        );
      }
    },

    onChange(value) {
      this.value = value;
      console.log("aiudaaa> ", value);
      if (value.indexOf("Reset me!") !== -1) {
        console.log("is reset");
        this.value = [];
      }
    },
    onSelect(option) {
      if (option === "Disable me!") {
        console.log("is disable");
        this.isDisabled = true;
      }
    },
    onTouch() {
      console.log("is touched");
      this.isTouched = true;
    },
  },
});
</script>
