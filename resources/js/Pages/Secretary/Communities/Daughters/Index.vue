<template>
  <div class="py-2">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 p-4">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <table
          v-if="this.daughters_list != null"
          class="min-w-full divide-y divide-gray-200"
        >
          <thead class="bg-blue-100">
            <tr>
              <th
                scope="col"
                class="
                  pl-4
                  text-left text-xs
                  font-medium
                  text-black
                  uppercase
                  tracking-wider
                "
              >
                Nombre
              </th>
              <th
                scope="col"
                class="
                  text-left text-xs
                  font-medium
                  text-black
                  uppercase
                  tracking-wider
                "
              >
                Cargo
              </th>
              <th
                scope="col"
                class="
                  px-6
                  py-3
                  text-left text-xs
                  font-medium
                  text-black
                  uppercase
                  tracking-wider
                "
              >
                Estado
              </th>
              <th
                scope="col"
                class="
                  px-6
                  py-3
                  text-left text-xs
                  font-medium
                  text-black
                  uppercase
                  tracking-wider
                "
              >
                Acciones
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr
              v-for="user_custom in daughters_list.data"
              :key="user_custom.id"
            >
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <div v-if="daughters_list.data.length > 0">
                      <img
                        class="h-10 w-10 rounded-full"
                        src="https://cdn-icons-png.flaticon.com/512/1912/1912354.png"
                        alt=""
                      />
                    </div>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      {{ user_custom.name }}
                    </div>
                    <div class="text-sm text-gray-500">
                      {{ user_custom.lastname }}
                    </div>
                    <span
                      v-if="
                        user_custom.comm_name && user_custom.comm_level == 1
                      "
                      class="
                        px-2
                        inline-flex
                        text-xs
                        leading-5
                        font-semibold
                        rounded-full
                        bg-cyan-100
                        text-cyan-800
                      "
                    >
                      {{ user_custom.comm_name }}
                    </span>
                    <div v-if="user_custom.comm_slug">
                      <a
                        :href="
                          route('secretary.works.edit', {
                            slug: user_custom.comm_slug,
                          })
                        "
                      >
                        <span
                          v-if="
                            user_custom.comm_name && user_custom.comm_level == 2
                          "
                          class="
                            px-2
                            inline-flex
                            text-xs
                            leading-5
                            font-semibold
                            rounded-full
                            bg-lime-100
                            text-lime-800
                          "
                        >
                          {{ user_custom.comm_name }}
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span
                  class="
                    px-2
                    inline-flex
                    text-sm
                    leading-5
                    font-semibold
                    rounded-sm
                    bg-blue-100
                    text-blue-700
                  "
                >
                  {{ user_custom.name_appoinment }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span
                  class="
                    px-2
                    inline-flex
                    text-xs
                    leading-5
                    font-semibold
                    rounded-full
                    bg-green-100
                    text-green-800
                  "
                >
                  Activo
                </span>
              </td>
              <td
                class="
                  px-3
                  py-4
                  whitespace-nowrap
                  text-right text-sm
                  font-medium
                "
              >
                <div class="mx-auto flex gap-10">
                  <Link
                    :href="
                      route('secretary.daughters.edit', {
                        slug: user_custom.slug,
                      })
                    "
                  >
                    <div class="w-auto h-auto">
                      <div class="flex-1 h-full">
                        <div
                          class="
                            flex
                            items-center
                            justify-center
                            flex-1
                            h-full
                            p-2
                            border border-green-500
                            text-white
                            shadow
                            rounded-lg
                            hover:bg-green-50 hover:text-zinc-300
                          "
                        >
                          <div class="relative">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-5 w-5 text-green-500"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                            >
                              <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                              />
                            </svg>
                          </div>
                        </div>
                      </div>
                    </div>
                  </Link>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <div v-else class="bg-gray-200 pt-8 pb-8 pl-4 pr-4 rounded-lg">
          <p class="text-center text-lg">
            Por el momento la comunidad u obra seleccionada no tiene hermanas.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapGetters, mapActions } from "vuex";
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination";

export default {
  mounted() {
    this.allDaughters;
  },
  components: { Link, Pagination },
  data() {
    return {
      daughters_list: null,
    };
  },
  computed: {
    ...mapState("community", ["community"]),
    allDaughters() {
      //   console.log("into", this.community.id);
      axios
        .get(
          this.route("secretary.communities.daughters.index", {
            community_id: this.community.id,
          })
        )
        .then((res) => {
          if (res.data.length > 0) {
            // console.log("console ", res.data);
            this.daughters_list = res;
          }
        });
    },
  },
  setup() {},
};
</script>
