<template></template>
<script>
import Icon from "@/Components/Icon";
import "sweetalert2/dist/sweetalert2.min.css";
import Button from "./Button.vue";

export default {
    props: ["message", "type_alert_r"],

    created: function () {
        console.log("mess:" + this.message + "\n type: " + this.type_alert_r);
        Toast.fire({
            icon: this.type_alert_r,
            title: this.message,
        });
    },
};
</script>
