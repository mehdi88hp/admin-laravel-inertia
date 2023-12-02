<template>

<AdminLayout>
    <Link href="/foo">Foo</Link>
    <v-btn @click="">Click Me2!</v-btn>
</AdminLayout>

</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AdminLayout from "@/AdminLayout/AdminLayout.vue";
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader

</script>
