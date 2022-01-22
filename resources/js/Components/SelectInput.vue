<template>
    <div class="col-span-6 sm:col-span-3">
        <label
            v-if="label"
            class="form-label block text-sm font-medium text-gray-700"
            :for="id"
            >{{ label }}:</label
        >
        <select
            :id="id"
            ref="input"
            v-model="selected"
            v-bind="{ ...$attrs, class: null }"
            name="country"
            autocomplete="country-name"
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:blue-indigo-500 sm:text-sm"
            :class="{ error: error }"
        >
            <slot />
        </select>
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<script>
import { v4 as uuid } from "uuid";

export default {
    inheritAttrs: false,
    props: {
        id: {
            type: String,
            default() {
                return `select-input-${uuid()}`;
            },
        },
        error: String,
        label: String,
        modelValue: [String, Number, Boolean],
    },
    emits: ["update:modelValue"],
    data() {
        return {
            selected: this.modelValue,
        };
    },
    watch: {
        selected(selected) {
            console.log(selected);
            this.$emit("update:modelValue", selected);
        },
    },
    methods: {
        focus() {
            this.$refs.input.focus();
        },
        select() {
            this.$refs.input.select();
        },
    },
};
</script>
