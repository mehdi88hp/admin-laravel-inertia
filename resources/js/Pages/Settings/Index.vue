<template>
    <AdminLayout>
        <v-row class="ma-5">
            <v-row>
                <v-col
                    cols="12"
                    sm="12"
                >
                    <v-textarea
                        label="One row"
                        auto-grow
                        variant="outlined"
                        rows="1"
                        row-height="15"
                        v-model="content"
                    ></v-textarea>
                </v-col>
                <v-col cols="12">
                    <v-btn color="indigo-darken-3"
                           @click="save">save
                    </v-btn>
                </v-col>
            </v-row>
        </v-row>
    </AdminLayout>
</template>

<script setup>
    import { ref } from 'vue'
    import axios from "axios";
    import AdminLayout from "@/AdminLayout/AdminLayout.vue";

    let content = ref('');
    const save = () => {
        // axios.post('http://admin.last6.local/words/bulk', {
        //     content: content.value,
        // }).then(r => console.log(r))
    }
</script>

<style scoped>

</style>
