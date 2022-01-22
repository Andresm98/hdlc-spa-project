<template>
    <form @submit.prevent="submit">
        <h6
            class="mt-2 mb-4 text-lg font-medium text-center leading-6 text-gray-900"
        >
            Perfil Personal
        </h6>
        <div class="flex flex-wrap">
            <div class="w-full lg:w-4/12 px-4">
                <div class="relative w-full mb-3">
                    <label
                        class="block text-sm font-medium text-gray-700"
                        htmlfor="grid-password"
                    >
                        Cédula de Identidad
                    </label>
                    <input
                        type="text"
                        minLength="10"
                        maxlength="13"
                        placeholder="0102211274 ó 0102211274001"
                        pattern="[+-]?\d+(?:[.,]\d+)?"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="form.identity_card"
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
                        Fecha de Nacimiento
                    </label>
                    <Datepicker
                        class="border-0 py-0.5 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="form.date_birth"
                        :format="format"
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
                        Fecha de Vocación
                    </label>
                    <Datepicker
                        class="border-0 py-0.5 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="form.date_vocation"
                        :format="format"
                    />
                </div>
            </div>

            <div class="w-full lg:w-4/12 px-4">
                <div class="relative w-full mb-3">
                    <label
                        class="block text-sm font-medium text-gray-700"
                        htmlfor="grid-password"
                    >
                        Fecha de Admisión
                    </label>
                    <Datepicker
                        class="border-0 py-0.5 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="form.date_admission"
                        :format="format"
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
                        Celular
                    </label>
                    <input
                        type="text"
                        minLength="10"
                        maxlength="20"
                        pattern="[0-9]+"
                        placeholder="123-4567-890"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="form.cellphone"
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
                        Teléfono Convencional
                    </label>
                    <input
                        type="text"
                        minLength="10"
                        maxlength="20"
                        pattern="[0-9]+"
                        placeholder="123-4567-890"
                        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                        v-model="form.phone"
                        required
                    />
                </div>
            </div>

            <div class="w-full lg:w-full px-4">
                <div>
                    <label
                        for="about"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Observaciones generales
                    </label>
                    <div class="mt-1">
                        <textarea
                            id="observation"
                            name="observation"
                            rows="3"
                            class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                            placeholder="Agregar las observaciones generales..."
                            v-model="form.observation"
                        />
                    </div>
                </div>
            </div>
        </div>

        <jet-button type="submit" class="ml-4 mt-4 btn btn-primary"
            >Aceptar</jet-button
        >
    </form>
</template>

<script>
import Datepicker from "vue3-date-time-picker";
import { useForm } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button";
import moment from "moment";

import "vue3-date-time-picker/dist/main.css";
import { ref } from "vue";

export default {
    components: { Datepicker, JetButton, moment },
    props: { identity_card: String },
    setup() {
        const date = ref(new Date());
        var current = "";
        var format = (date) => {
            var dat, dat2;
            const year = date.getFullYear();
            const month = date.getMonth() + 1;
            const day = date.getDate();
            dat = month;
            dat2 = day;
            if (month < 10) {
                dat = "0" + month;
            }
            if (day < 10) {
                dat2 = "0" + day;
            }
            current = `${year}-${dat}-${dat2}`;
            return `${year}-${dat}-${dat2}`;
        };

        const form = useForm({
            date_birth: null,
            identity_card: null,
            date_vocation: null,
            date_admission: null,
            cellphone: null,
            phone: null,
            observation: null,
        });

        function submit() {
            form.date_birth = format_date(form.date_birth);
            form.date_vocation = format_date(form.date_vocation);
            form.date_admission = format_date(form.date_admission);
            form.post(route("secretary.create.profile"));
        }

        function format_date(value) {
            return moment(new Date(value)).format("YYYY-MM-DD");
        }

        return {
            date,
            format,
            form,
            submit,
        };
    },

    methods: {
        format_date(value) {
            return moment(new Date(value)).format("YYYY-MM-DD");
        },
        createProfile() {
            if (this.validateIdentityCard(this.form.identity_card)) {
                form.post(route("secretary.create.profile"));
            } else {
                alert("DNI No funciona");
            }
        },

        validateIdentityCard(identity_card) {
            identity_card = identity_card + "";
            console.log(typeof identity_card + "" + identity_card);

            try {
                if (identity_card.length == 10 || identity_card.length == 13) {
                    const digit = identity_card.split("").map(Number);
                    console.log(digit);
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
                        return dec == 10 || dec == verification_code
                            ? true
                            : false;
                    }

                    return false;
                }
            } catch (error) {
                console.log(error);
            }
        },

        inAscOrder(arr) {
            return arr.every(function (_, i) {
                return i == 0 || arr[i] >= arr[i - 1];
            });
        },
    },
};
</script>
