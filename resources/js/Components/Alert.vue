<template></template>
<script>
export default {
  props: ["message", "type_alert_r"],

  created: function () {
    window.Toast = this.$swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", this.$swal.stopTimer);
        toast.addEventListener("mouseleave", this.$swal.resumeTimer);
      },
    });
    Toast.fire({
      icon: this.type_alert_r,
      title: this.message,
    });
  },
};
</script>
