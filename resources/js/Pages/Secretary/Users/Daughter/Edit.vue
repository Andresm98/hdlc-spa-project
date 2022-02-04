<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Editar Usuarios
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
        bg-slate-800
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
              text-white
              sm:text-slate-900
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
              text-white
              sm:text-slate-500
              dark:sm:text-slate-400
            "
          >
            Información General de Hermana
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
              class="mr-1 text-white dark:text-white"
              aria-hidden="true"
            >
              <path
                d="M18 11.034C18 14.897 12 19 12 19s-6-4.103-6-7.966C6 7.655 8.819 5 12 5s6 2.655 6 6.034Z"
              />
              <path d="M14 11a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
            </svg>
            <p class="text-white">Quito, Ecuador</p>
          </dd>
        </dl>
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
        </div>    <p
                    class="mt-4 text-sm leading-6 col-start-1 sm:col-span-2 lg:mt-6 lg:row-start-4 lg:col-span-1 dark:text-white"
                >
                    La presente plantiflla de información se relaciona con los
                    datos principales de la hermana a la que desea agregar al
                    sistema, por lo que deberá verificar los datos a ingresar.
                    <ul class="list-disc pl-5">
                        <li class="dark:text-white"><p class="mt-2  pt-6 text-sm  uppercase">  Nombre de usuario único en el sistema.</p></li>
                        <li class="dark:text-white"><p class="  text-sm  uppercase dark:text-white">Correo electrónico único en el sistema.</p></li>
                        <li class="dark:text-white"><p class="  text-sm  uppercase dark:text-white">Nombres Completos.</p></li>
                        <li class="dark:text-white"><p class="  text-sm  uppercase dark:text-white">Apellidos Completos.</p></li>
                    </ul>

                </p>
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
          <div class="bg-neutral-100 hover:bg-gray-100 rounded-lg">
            <form @submit.prevent="submit" class="">
              <div class="rounded-t bg-white mb-0 px-6 py-6">
                <div class="text-center flex justify-between">
                  <h6 class="text-lg font-medium leading-6 text-gray-900">
                    Tarjeta de Información General Hermana
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
              <div class="flex flex-wrap">
                <div class="w-full lg:w-2/3 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Nombre de Usuario
                    </label>
                    <jet-input-error :message="errors.username" />
                    <input
                      type="text"
                      placeholder="Nombre del usuario en el Sistema"
                      class="
                        border-0
                        px-3
                        py-3
                        placeholder-blueGray-300
                        text-black
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
                      @keydown.space.prevent
                      v-model="form.username"
                      readonly
                    />
                  </div>
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Correo Electrónico
                    </label>

                    <jet-input-error :message="errors.email" />
                    <input
                      type="email"
                      placeholder="micorreo@correo.com"
                      class="
                        border-0
                        px-3
                        py-3
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
                      v-model="form.email"
                    />
                  </div>
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Nombres Completos
                    </label>
                    <jet-input-error :message="errors.name" />
                    <input
                      type="text"
                      placeholder="Ejm: Lucas Andres"
                      class="
                        border-0
                        px-3
                        py-3
                        placeholder-blueGray-300
                        text-black
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
                      v-model="form.name"
                    />
                  </div>
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Apellidos Completos
                    </label>

                    <jet-input-error :message="errors.lastname" />
                    <input
                      type="text"
                      placeholder="Ejm: Fuentes Ramos"
                      class="
                        border-0
                        px-3
                        py-3
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
                      v-model="form.lastname"
                    />
                  </div>
                  <div class="relative w-full mb-3"></div>
                </div>
                <div class="w-full lg:w-1/3 px-4">
                  <div class="relative w-full mb-3">
                    <div class="section">
                      <jet-input-error :message="errors.file" />
                      <input
                        class="
                          block
                          w-full
                          text-sm text-blue-500
                          file:mr-4
                          file:py-2
                          file:px-4
                          file:rounded-full
                          file:border-0
                          file:text-sm
                          file:font-semibold
                          file:bg-green-500
                          file:text-white
                          hover:file:bg-green-600
                          mb-4
                        "
                        type="file"
                        accept="image/png, image/gif, image/jpeg"
                        @input="form.file = $event.target.files[0]"
                        @change="onFileChange"
                      />
                      <img
                        v-if="image && !url"
                        :src="image"
                        class="rounded-xl h-60 w-40 object-cover"
                      />
                      <img
                        v-if="url"
                        :src="url"
                        class="rounded-xl h-60 w-40 object-cover"
                      />
                      <img
                        v-if="!image && !url"
                        src="https://www.daughtersofcharity.com/wp-content/uploads/2021/05/DOC-SEAS-Logo-footer-236x300.png"
                        class="rounded-xl h-60 w-40 object-cover"
                      />
                      <progress
                        v-if="form.progress"
                        :value="form.progress.percentage"
                        max="100"
                      >
                        {{ form.progress.percentage }}%
                      </progress>
                    </div>
                  </div>
                </div>
              </div>
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

              <div
                class="mr-4 ml-4 grid grid-cols-1 md:grid-cols-2 gap-4"
              ></div>
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
            </form>
   <div v-if="profile_daughter == null" class="m-4">
              <profile-daughter></profile-daughter>
            </div>
            <div v-else class="m-4">
              <profile-daughter-edit></profile-daughter-edit>
            </div>
            <swiper
              :pagination="pagination"
              :modules="modules"
              class="mySwiper"
            >
              <swiper-slide class="pb-10 pt-10">
           <div v-if="profile_daughter == null" class="m-4">
              <profile-daughter></profile-daughter>
            </div>
            <div v-else class="m-4">
              <profile-daughter-edit></profile-daughter-edit>
            </div>

              </swiper-slide>
              <swiper-slide class="pb-10 pt-10">




                        <div
                          class="w-full shadow sm:rounded-md "
                        >
                          <div class="px-4 py-5 bg-white  sm:p-6">
                            <div class="">
                              <div class="">
                                <label
                                  for="company-website"
                                  class="
                                    block
                                    text-sm
                                    font-medium
                                    text-gray-700
                                  "
                                >
                                Enlace
                                </label>
                                <div class="mt-1 rounded-md">
                                  <span
                                    class="
                                      inline-flex
                                      items-center
                                      px-3
                                      rounded-l-md
                                      border border-r-0 border-gray-300
                                      bg-gray-50
                                      text-gray-500 text-sm
                                    "
                                  >
                                    http://
                                  </span>
                                  <input
                                    type="text"
                                    name="company-website"
                                    id="company-website"
                                    class="
                                      focus:ring-indigo-500
                                      focus:border-indigo-500
                                      flex-1
                                      block
                                      w-full
                                      rounded-none rounded-r-md
                                      sm:text-sm
                                      border-gray-300
                                    "
                                    placeholder="www.example.com"
                                  />
                                </div>
                              </div>
                            </div>

                            <div>
                              <label
                                for="about"
                                class="block text-sm font-medium text-gray-700"
                              >
                             Informacion
                              </label>
                              <div class="mt-1">
                                <textarea
                                  id="about"
                                  name="about"
                                  rows="3"
                                  class="
                                    shadow-sm
                                    focus:ring-indigo-500
                                    focus:border-indigo-500
                                    mt-1
                                    block
                                    w-full
                                    sm:text-sm
                                    border border-gray-300
                                    rounded-md
                                  "
                                  placeholder="you@example.com"
                                />
                              </div>
                              <p class="mt-2 text-sm text-gray-500">
                                Describa la info.
                              </p>
                            </div>

                            <div>
                              <label
                                class="block text-sm font-medium text-gray-700"
                              >
                                Photo
                              </label>
                              <div class="mt-1 flex items-center">
                                <span
                                  class="
                                    inline-block
                                    h-12
                                    w-12
                                    rounded-full
                                    overflow-hidden
                                    bg-gray-100
                                  "
                                >
                                  <svg
                                    class="h-full w-full text-gray-300"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                  >
                                    <path
                                      d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"
                                    />
                                  </svg>
                                </span>
                                <button
                                  type="button"
                                  class="
                                    ml-5
                                    bg-white
                                    py-2
                                    px-3
                                    border border-gray-300
                                    rounded-md
                                    shadow-sm
                                    text-sm
                                    leading-4
                                    font-medium
                                    text-gray-700
                                    hover:bg-gray-50
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-offset-2
                                    focus:ring-indigo-500
                                  "
                                >
                                  Change
                                </button>
                              </div>
                            </div>

                            <div>
                              <label
                                class="block text-sm font-medium text-gray-700"
                              >
                                Cover photo
                              </label>
                              <div
                                class="
                                  mt-1
                                  flex
                                  justify-center
                                  px-6
                                  pt-5
                                  pb-6
                                  border-2 border-gray-300 border-dashed
                                  rounded-md
                                "
                              >
                                <div class="space-y-1 text-center">
                                  <svg
                                    class="mx-auto h-12 w-12 text-gray-400"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 48 48"
                                    aria-hidden="true"
                                  >
                                    <path
                                      d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                      stroke-width="2"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                    />
                                  </svg>
                                  <div class="flex text-sm text-gray-600">
                                    <label
                                      for="file-upload"
                                      class="
                                        relative
                                        cursor-pointer
                                        bg-white
                                        rounded-md
                                        font-medium
                                        text-indigo-600
                                        hover:text-indigo-500
                                        focus-within:outline-none
                                        focus-within:ring-2
                                        focus-within:ring-offset-2
                                        focus-within:ring-indigo-500
                                      "
                                    >
                                      <span>Upload a file</span>
                                      <input
                                        id="file-upload"
                                        name="file-upload"
                                        type="file"
                                        class="sr-only"
                                      />
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                  </div>
                                  <p class="text-xs text-gray-500">
                                    PNG, JPG, GIF up to 10MB
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button
                              type="submit"
                              class="
                                inline-flex
                                justify-center
                                py-2
                                px-4
                                border border-transparent
                                shadow-sm
                                text-sm
                                font-medium
                                rounded-md
                                text-white
                                bg-indigo-600
                                hover:bg-indigo-700
                                focus:outline-none
                                focus:ring-2
                                focus:ring-offset-2
                                focus:ring-indigo-500
                              "
                            >
                              Save
                            </button>
                          </div>
                        </div>


              </swiper-slide>
              <swiper-slide class="pb-10 pt-10">
                <select
                  id="country"
                  name="country"
                  autocomplete="country-name"
                  class="
                    mt-1
                    block
                    w-full
                    py-2
                    px-3
                    border border-gray-300
                    bg-white
                    rounded-md
                    shadow-sm
                    focus:outline-none
                    focus:ring-indigo-500
                    focus:border-indigo-500
                    sm:text-sm
                  "
                >
                  <option>United States</option>
                  <option>Canada</option>
                  <option>Mexico</option>
                </select>
              </swiper-slide>
              <swiper-slide class="pb-10 pt-10">Slide 4</swiper-slide>
              <swiper-slide class="pb-10 pt-10">Slide 5</swiper-slide>
              <swiper-slide class="pb-10 pt-10">Slide 6</swiper-slide>
              <swiper-slide class="pb-10 pt-10">Slide 7</swiper-slide>
              <swiper-slide class="pb-10 pt-10">Slide 8</swiper-slide>
              <swiper-slide class="pb-10 pt-10">Slide 9</swiper-slide>
            </swiper>

          </div>
        </div>
      </div>
    </section>
  </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";

import JetCheckbox from "@/Jetstream/Checkbox";

import ProfileDaughter from "@/Pages/Secretary/Users/Daughter/Profile/Create";
import ProfileDaughterEdit from "@/Pages/Secretary/Users/Daughter/Profile/Edit";
import { mapActions, mapGetters } from "vuex";
import Alert from "@/Components/Alert";

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";
// Import Swiper styles
import "swiper/css";
import "swiper/css/pagination";
import "../../../../../css/style.css";
// import required modules
import { Pagination } from "swiper";

export default defineComponent({
  created() {
    console.log("created " + this.$el);
    this.uploadProvinces(this.provinces);
  },
  mounted() {
    console.log("mounted " + this.$el);

    if (this.profile_daughter == null) {
      this.changeUserId(this.daughter_custom.id);
    } else {
      this.changeUser(this.profile_daughter);
    }
  },
  setup() {
    return {
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
    daughter_custom: Object,
    errors: null,
    image: String,
    profile_daughter: Object,
    address: Object,
    provinces: {
      type: Array,
    },
  },
  computed: {
    ...mapGetters("daughter", ["actualCount"]),
  },
  layout: PrincipalLayout,
  components: {
    AppLayout,
    Link,

    JetInputError,
    JetInput,
    JetLabel,
    JetButton,
    JetCheckbox,
    ProfileDaughter,
    ProfileDaughterEdit,
    Alert,
    Swiper,
    SwiperSlide,
  },

  data() {
    return {
      form: useForm({
        username: this.daughter_custom.username,
        name: this.daughter_custom.name,
        lastname: this.daughter_custom.lastname,
        email: this.daughter_custom.email,
        file: null,
      }),
      photoPreview: null,
      url: null,
    };
  },

  methods: {
    onSearchProvincesChange() {},

    onSelectedProvince() {},
    //   computed: {
    //     // ejexcc() {
    //     //   this.$store.dispatch("changeUser", {
    //     //     newId: this.daughter_custom.id,
    //     //   });
    //     // },
    //   },
    ...mapActions("daughter", ["increment"]),
    ...mapActions("daughter", ["changeUser"]),
    ...mapActions("daughter", ["changeUserId"]),
    ...mapActions("address", ["uploadProvinces"]),

    onFileChange(e) {
      const file = e.target.files[0];
      this.url = URL.createObjectURL(file);
    },
    submit() {
      Inertia.post(
        route(`secretary.daughters.update`, {
          daughter_custom: this.daughter_custom,
        }),
        {
          _method: "put",
          name: this.form.name,
          lastname: this.form.lastname,
          email: this.form.email,
          file: this.form.file,
        }
      );
    },
  },
});
</script>


