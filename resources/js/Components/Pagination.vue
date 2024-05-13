<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                    v-html="link.label" />
                <Link v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-blue-50 hover:text-gray focus:border-blue-500 focus:text-blue-500"
                    :class="{ 'bg-blue-500 text-white hover:bg-blue-700' : link.active }" :href="link.url" v-html="link.label" ></Link>
            </template>
        </div>
    </div>
</template>

<script>

    import {Link} from "@inertiajs/inertia-vue3";

    export default {
        props: {
            links: Array
        },
        components: {
            Link,
        }
    }

</script>
