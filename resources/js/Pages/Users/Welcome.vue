<template>
  <div>
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">Dashboard</h1>
    <p class="mb-8 leading-normal">
      Bienvenido al panel de administrador, la información. Lorem ipsum dolor sit amet
      consectetur adipisicing elit. Corporis quasi nemo vel fuga excepturi eum, sit culpa
      aut praesentium quis sequi provident labore laboriosam odit voluptates, doloremque
      nulla necessitatibus atque? Lorem ipsum dolor, sit amet consectetur adipisicing
      elit. Inventore beatae quidem in corporis itaque nisi, nihil consectetur et eum
      blanditiis temporibus praesentium vitae, ipsum sapiente voluptas assumenda deleniti
      laborum dolorum?
      <a
        class="text-blue-500 hover:text-orange-600 underline"
        href="/"
        >Inicio</a
      >
      works.
    </p>
  </div>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import Layout from "@/Components/Admin/Layout";

export default {
  components: {
    Head,
  },
  layout: Layout,
};
</script>
