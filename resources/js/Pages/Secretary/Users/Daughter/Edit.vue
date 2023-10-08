<template @scroll="handleScroll">
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-700 leading-tight">
        Editar Hermanas
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
    <!-- <alert
      v-if="$page.props.flash.success"
      class="alert"
      :type_alert_r="(type_alert = 'success')"
      :message="$page.props.flash.success"
    >
    </alert> -->
    <operation></operation>
    <br />

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
            Provincia Ecuador
          </h1>
          <p
            class="text-sm leading-4 font-medium text-black sm:text-black dark:sm:text-slate-400"
          >
            Información General de Hermana
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
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_3.png"
            alt=""
            class="hidden w-full h-52 object-cover rounded-lg sm:block sm:col-span-2 md:col-span-1 lg:row-start-2 lg:col-span-2 lg:h-32"
            loading="lazy"
          />
          <img
            src="https://files-hdlc-frontend.s3.amazonaws.com/spa-hdlc-app/icon_secretary_1.png"
            alt=""
            class="hidden w-full h-52 object-cover rounded-lg md:block lg:row-start-2 lg:col-span-2 lg:h-32"
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
          <button
            class="bg-blue-500 pt-2 pb-2 px-4 ml-4 mr-4 rounded-md cursor-pointer text-md hover:bg-blue-600 text-white"
            @click="openDialogReport()"
          >
            Imprimir Reporte
          </button>
        </div>

        <div
          class="mt-4 text-sm leading-6 col-start-1 sm:col-span-2 lg:mt-6 lg:row-start-4 lg:col-span-1 text-black dark:text-white"
        >
          <p>
            La presente plantiflla de información se relaciona con los datos
            principales de la Hermana a la que desea agregar al sistema, por lo
            que deberá verificar los datos a ingresar.
          </p>

          <ul class="list-disc pl-5">
            <li class="dark:text-white">
              <p class="mt-2 pt-6 text-sm uppercase">
                Nombre de usuario único en el sistema.
              </p>
            </li>
            <li class="dark:text-white">
              <p class="text-sm uppercase dark:text-white">
                Correo electrónico debe ser único en el sistema.
              </p>
            </li>
            <li class="dark:text-white">
              <p class="text-sm uppercase dark:text-white">
                Nombres Completos.
              </p>
            </li>
            <li class="dark:text-white">
              <p class="text-sm uppercase dark:text-white">
                Apellidos Completos.
              </p>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <section class="py-1 bg-slate-800 rounded-lg m-1">
      <div class="w-full lg:w-5/6 px-4 mx-auto mt-6">
        <div
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
        >
          <div class="bg-neutral-100 hover:bg-gray-100 rounded-lg">
            <form @submit.prevent="submit" class="">
              <div class="rounded-t bg-white mb-0 px-6 py-6">
                <div class="text-center flex justify-between">
                  <h6 class="text-lg font-medium leading-6 text-gray-900">
                    Tarjeta de Información General Hermana
                  </h6>
                  <button
                    class="bg-blue-500 hover:bg-blue-700 text-white active:bg-blue-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                    type="submit"
                  >
                    Guardar Tarjeta
                  </button>
                </div>
              </div>
              <hr />
              <h6
                class="mt-2 text-lg font-medium text-center leading-6 text-gray-900"
              >
                Información General
              </h6>
              <div class="flex flex-wrap">
                <div class="w-full lg:w-10/12 px-4">
                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Nombre de Usuario:
                    </label>
                    <small>Formato: No editable</small>
                    <jet-input-error :message="errors.username" />
                    <input
                      type="text"
                      placeholder="Nombre del usuario en el Sistema"
                      class="border-0 px-3 py-3 placeholder-blueGray-300 text-black bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
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
                      Correo Electrónico:
                    </label>

                    <jet-input-error :message="errors.email" />
                    <small>Formato: Único en el sistema</small>
                    <input
                      type="email"
                      placeholder="micorreo@correo.com"
                      class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      v-model="form.email"
                      title="Ingrese el un correo electrónico válido."
                      required
                    />
                  </div>
                  <div class="relative w-full mb-3">
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
                      v-model="form.fullnamecomm"
                    />
                  </div>

                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Nombres Completos:
                    </label>
                    <jet-input-error :message="errors.name" />
                    <small>Formato: Andrea Fransheska</small>
                    <input
                      type="text"
                      placeholder="Ejm: Lucas Andres"
                      class="border-0 px-3 py-3 placeholder-blueGray-300 text-black bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      onkeydown="return /[a-z, ]/i.test(event.key)"
                      onblur="if (this.value == '') {this.value = '';}"
                      onfocus="if (this.value == '') {this.value = '';}"
                      maxlength="100"
                      v-model="form.name"
                    />
                  </div>

                  <div class="relative w-full mb-3">
                    <label
                      class="block text-sm font-medium text-gray-700"
                      htmlfor="grid-password"
                    >
                      Apellidos Completos:
                    </label>

                    <jet-input-error :message="errors.lastname" />
                    <small>Formato: López Guerra</small>
                    <input
                      type="text"
                      placeholder="Ejm: Fuentes Ramos"
                      class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                      onkeydown="return /[a-z, ]/i.test(event.key)"
                      onblur="if (this.value == '') {this.value = '';}"
                      onfocus="if (this.value == '') {this.value = '';}"
                      maxlength="100"
                      v-model="form.lastname"
                    />
                  </div>
                </div>

                <div class="w-full lg:w-2/12 px-4">
                  <div class="relative w-full mb-3">
                    <div class="section">
                      <jet-input-error :message="errors.file" />
                      <input
                        class="block w-full text-sm text-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 mb-4"
                        type="file"
                        accept="image/png, image/gif, image/jpeg"
                        @input="form.file = $event.target.files[0]"
                        @change="onFileChange"
                      />

                      <section
                        class="hero container max-w-screen-lg mx-auto pb-10"
                      >
                        <img
                          v-if="image && !url"
                          :src="image"
                          class="rounded-xl h-60 w-40 object-cover mx-auto"
                        />
                        <img
                          v-if="url"
                          :src="url"
                          class="rounded-xl h-60 w-40 object-cover mx-auto"
                        />
                        <img
                          v-if="!image && !url"
                          src="https://files-hdlc-frontend.s3.amazonaws.com/logo_daughter.png"
                          class="rounded-xl h-60 w-40 object-cover mx-auto"
                        />
                      </section>

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
              <div v-if="profile_daughter != null">
                <div
                  v-if="
                    profile_daughter.date_death == null &&
                    profile_daughter.date_exit == null &&
                    profile_daughter.status == 1
                  "
                >
                  <span
                    class="ml-4 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800"
                  >
                    {{ ageProfile() }} Años
                  </span>
                </div>
              </div>

              <hr
                class="mt-1 mb-3 ml-4 mr-4 border-b-1 border-blueGray-300 hover:border-blueGray-100"
              />

              <div
                class="mr-4 ml-4 grid grid-cols-1 md:grid-cols-2 gap-4"
              ></div>
            </form>

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
                <small
                  >Por favor tenga en cuenta que las opciones de acuerdo a todas
                  las Hermanas se habilitarán siempre y cuando que la
                  información del perfil sean editadas y creadas
                  correctamente.</small
                >
              </div>
            </div>
            <div v-if="selectMenu.selectedElement == 'Perfil'">
              <div v-if="profile_daughter == null" class="m-4">
                <profile-daughter></profile-daughter>
              </div>
              <div v-if="profile_daughter != null" class="m-4">
                <profile-daughter-edit
                  :slug="daughter_custom.slug"
                ></profile-daughter-edit>
              </div>
            </div>
            <div
              v-if="
                selectMenu.selectedElement == 'Información Familiar' &&
                profile_daughter != null
              "
            >
              <info-family></info-family>
            </div>
            <div
              v-if="
                selectMenu.selectedElement == 'Salud Actual' &&
                profile_daughter != null
              "
            >
              <health></health>
            </div>
            <div
              v-if="
                selectMenu.selectedElement == 'Récord Académico' &&
                profile_daughter != null
              "
            >
              <academic-training></academic-training>
            </div>
            <div
              v-if="
                selectMenu.selectedElement == 'Permisos' &&
                profile_daughter != null
              "
            >
              <permit></permit>
            </div>
            <div
              v-if="
                selectMenu.selectedElement == 'Nombramientos' &&
                profile_daughter != null
              "
            >
              <appointment></appointment>
            </div>
            <div
              v-if="
                selectMenu.selectedElement == 'Sacramentos' &&
                profile_daughter != null
              "
            >
              <sacrament></sacrament>
            </div>
            <div
              v-if="
                selectMenu.selectedElement == 'Cambios' &&
                profile_daughter != null
              "
            >
              <changes></changes>
            </div>
            <div
              v-if="
                selectMenu.selectedElement == 'Documentos' &&
                profile_daughter != null
              "
            >
              <files></files>
            </div>
          </div>
        </div>
      </div>
    </section>

    <jet-dialog-modal
      :show="managingReportsFor"
      @close="managingReportsFor = null"
    >
      <template #title>Opciones del Reporte de la Hermana </template>

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
              user_id: this.daughter_custom.id,
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
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayoutSecretary.vue";
import { useForm, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import JetInputError from "@/Jetstream/InputError";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import PrincipalLayout from "@/Components/Secretary/PrincipalLayout";
import JetCheckbox from "@/Jetstream/Checkbox";
import Alert from "@/Components/Alert";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import { mapActions, mapGetters } from "vuex";

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";
// Import Swiper styles
import "swiper/css";
import "swiper/css/pagination";
import "../../../../../css/style.css";
// import required modules
import { Pagination } from "swiper";

// Import Components
import ProfileDaughter from "@/Pages/Secretary/Users/Daughter/Profile/Create";
import ProfileDaughterEdit from "@/Pages/Secretary/Users/Daughter/Profile/Edit";
import Health from "@/Pages/Secretary/Users/Daughter/Health/Index";
import AcademicTraining from "@/Pages/Secretary/Users/Daughter/AcademicTraining/Index";
import Permit from "@/Pages/Secretary/Users/Daughter/Permit/Index";
import Appointment from "@/Pages/Secretary/Users/Daughter/Appointment/Index";
import InfoFamily from "@/Pages/Secretary/Users/Daughter/InfoFamily/Index";
import Sacrament from "@/Pages/Secretary/Users/Daughter/Sacrament/Index";
import Changes from "@/Pages/Secretary/Users/Daughter/Change/Index";
import Files from "@/Pages/Secretary/Users/Daughter/Files/Index";
import Operation from "@/Components/Secretary/Daughter/Operation";
import moment from "moment";

export default defineComponent({
  created() {
    // console.log("created " + this.$el);
    this.uploadProvinces(this.provinces);
  },

  beforeMount() {
    if (this.profile_daughter == null) {
      this.changeUserId(this.daughter_custom.id);
    } else {
      this.selectMenu.options = [
        "Perfil",
        "Información Familiar",
        "Salud Actual",
        "Récord Académico",
        "Sacramentos",
        "Permisos",
        "Cambios",
        "Nombramientos",
        "Documentos",
      ];

      this.changeUser(this.profile_daughter);
    }
  },
  watch: {
    profile_daughter: function () {
      if (this.profile_daughter != null) {
        this.selectMenu.options = [
          "Perfil",
          "Información Familiar",
          "Salud Actual",
          "Récord Académico",
          "Sacramentos",
          "Permisos",
          "Cambios",
          "Nombramientos",
          "Documentos",
        ];
      }
    },
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
    isInvalid() {
      return this.value == null;
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
    ProfileDaughter,
    ProfileDaughterEdit,
    Health,
    AcademicTraining,
    Permit,
    Appointment,
    Changes,
    Files,
    InfoFamily,
    Sacrament,
    Alert,
    AppLayout,
    Operation,
    JetDialogModal,
    moment,
    JetSecondaryButton,
  },

  data() {
    return {
      isDisabled: false,
      isTouched: false,
      isExistProfile: false,
      selectMenu: {
        selectedElement: "Perfil",
        isDisabled: false,
        isTouched: false,
        options: ["Perfil"],
        loading: false,
        multiSelectUser: null,
        vSelectUser: null,
      },
      //
      form: useForm({
        username: this.daughter_custom.username,
        name: this.daughter_custom.name,
        fullnamecomm: this.daughter_custom.fullnamecomm,
        lastname: this.daughter_custom.lastname,
        email: this.daughter_custom.email,
        file: null,
      }),
      photoPreview: null,
      url: null,
      managingReportsFor: null,
      options: [],
    };
  },

  methods: {
    handleScroll() {
    },
    onSearchProvincesChange() {},

    onSelectedProvince() {},

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
          fullnamecomm: this.form.fullnamecomm,
          lastname: this.form.lastname,
          email: this.form.email,
          file: this.form.file,
        },
        {
          preserveScroll: true,
        }
      );
    },
    printReport() {
      Inertia.get(
        route(`secretary.daughters.report.profile`, {
          user_id: this.daughter_custom.id,
        }),
        {
          preserveScroll: true,
        }
      );
    },
    onChange(value) {
      this.value = value;
      if (value.indexOf("Reset me!") !== -1) {

        this.value = [];
      }
    },
    onSelect(option) {
      if (option === "Disable me!") {
        this.isDisabled = true;
      }
    },
    onTouch() {
      this.isTouched = true;
    },
    //
    openDialogReport() {
      this.managingReportsFor = this.$inertia.form({});
    },
    formatShowDate(value) {
      if (value != null) {
        return moment(new Date(value)).format("YYYY-MM-DD");
      }
      return null;
    },
    ageProfile() {
      if (this.profile_daughter != null) {
        let age = this.formatShowDate(this.profile_daughter.date_birth);
        return moment().diff(moment(age, "YYYY-MM-DD"), "years");
      }
    },
  },
});
</script>
