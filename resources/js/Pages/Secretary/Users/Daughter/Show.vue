<template>
     <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-700 leading-tight">
                Usuarios
            </h2>
            <div class="text-sm text-blue-700 mt-3 mb-6">
                Bienvenido Usuario: {{ $page.props.user.name }}
            </div>
        </template>

        <section
            class="bg-slate-800 y-1 px-4 sm:p-6 md:py-10 md:px-8 pt-2 pb-4"
        >
            <div
                class="max-w-4xl mx-auto grid grid-cols-1 lg:max-w-5xl lg:gap-x-20 lg:grid-cols-2"
            >
                <div
                    class="relative p-3 col-start-1 row-start-1 flex flex-col-reverse rounded-lg bg-gradient-to-t from-black/75 via-black/0 sm:bg-none sm:row-start-2 sm:p-0 lg:row-start-1"
                >
                    <h1
                        class="mt-1 text-lg font-semibold text-white sm:text-slate-900 md:text-2xl dark:sm:text-white"
                    >
                        Provincia Ecuador
                    </h1>
                    <p
                        class="text-sm leading-4 font-medium text-white sm:text-slate-500 dark:sm:text-slate-400"
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
                    <dd
                        class="text-indigo-600 flex items-center dark:text-indigo-400"
                    >
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
                            >0.00
                            <span class="text-slate-400 font-normal"
                                >(0)</span
                            ></span
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
                    class="mt-4 col-start-1 row-start-3 self-center sm:mt-0 sm:col-start-2 sm:row-start-2 sm:row-span-2 lg:mt-6 lg:col-start-1 lg:row-start-3 lg:row-end-4"
                >
                    <button
                        type="button"
                        class="bg-blue-600 text-white text-sm leading-6 font-medium py-2 px-3 rounded-lg"
                    >
                    <!--
                        FIXME: Import Controllers For PDF-->
                        Plantilla PDF
                    </button>
                </div>
                <p
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

        <!-- <section>
            <menu-dropdown> </menu-dropdown>
        </section> -->
   <div  >
        <section class="py-1 bg-slate-800">
            <div class="w-full lg:w-5/6 px-4 mx-auto mt-6">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
                >
                    <div class="bg-neutral-100 hover:bg-gray-100 rounded-lg">
                            <div class="rounded-t bg-white mb-0 px-6 py-6">
                                <div class="text-center flex justify-between">
                                    <h6
                                        class="text-lg font-medium leading-6 text-gray-900"
                                    >
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
                                <div class="w-full lg:w-2/3 px-4">
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            htmlfor="grid-password"
                                        >
                                            Nombre de Usuario
                                        </label>

                                        <input
                                            type="text"
                                            placeholder="Nombre del usuario en el Sistema"
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-black bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                            @keydown.space.prevent
                                            v-model="user_custom.username"
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

                                        <input
                                            type="email"
                                            placeholder="micorreo@correo.com"
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                            value="user.email"
                                            readonly
                                        />
                                    </div>
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            htmlfor="grid-password"
                                        >
                                            Nombres Completos
                                        </label>

                                        <input
                                            type="text"
                                            placeholder="Ejm: Lucas Andres"
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-black bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                            v-model="user_custom.name"
                                            readonly
                                        />
                                    </div>
                                    <div class="relative w-full mb-3">
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            htmlfor="grid-password"
                                        >
                                            Apellidos Completos
                                        </label>

                                        <input
                                            type="text"
                                            placeholder="Ejm: Fuentes Ramos"
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                            v-model="user_custom.lastname"
                                            readonly
                                        />
                                    </div>
                                </div>
                                <div class="w-full lg:w-1/3 px-4">
                                    <div class="relative w-full mb-3">
                                        <div class="section">
                                            <img
                                                v-if="!image"
                                                src="https://files-hdlc-frontend.s3.amazonaws.com/logo_daughter.png"
                                                class="rounded-xl h-60 w-40 object-cover"
                                            />
                                            <img
                                                v-if="image"
                                                :src="image"
                                                class="rounded-xl h-60 w-40 object-cover"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr
                                class="mt-1 mb-3 ml-4 mr-4 border-b-1 border-blueGray-300 hover:border-blueGray-100"
                            />

                    </div>
                </div>
            </div>
        </section>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayoutAdmin.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination";
import PrincipalLayout from "@/Components/Admin/PrincipalLayout";

export default defineComponent({
  props: { user_custom: Object, image: String },
  layout: PrincipalLayout,
  components: {
    AppLayout,
    Link,
    Pagination,
  },
});
</script>
