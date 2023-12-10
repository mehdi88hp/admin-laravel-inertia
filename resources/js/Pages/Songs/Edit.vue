<template>
    <AdminLayout>
        <v-row class="ma-5">
            <v-row>
                <v-col
                    cols="12"
                    sm="12"
                >
                    <v-textarea
                        label="name"
                        auto-grow
                        variant="outlined"
                        rows="1"
                        row-height="15"
                        v-model="name"
                    ></v-textarea>
                </v-col>
                <v-col cols="12">
                    <v-btn color="indigo-darken-3"
                           @click="save">store
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
    import { router } from "@inertiajs/vue3";

    let name = ref('');

    const props = defineProps({
        songId: Number | String
    });

    const save = () => {
        axios.put('http://admin.last6.local/songs/' + props.songId, {
            content: name.value,
        }).then(r => {
            console.log(r, 'rrrrrrr')
            // router.visit('/songs/' + r.song_id + '/edit')

        })
    }
</script>

<style scoped>

</style>
