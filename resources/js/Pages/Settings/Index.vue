<template>
    <AdminLayout>
        <v-row class="ma-5">
            <v-row>
                <v-col
                    cols="12"
                    sm="12"
                    v-for="key in Object.keys(generalSettings)"
                >
                    <v-textarea
                        :label="generalSettings[key].label"
                        auto-grow
                        variant="outlined"
                        rows="1"
                        row-height="15"
                        v-model="generalSettings[key].value"
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
    import { reactive, ref } from 'vue'
    import axios from "axios";
    import AdminLayout from "@/AdminLayout/AdminLayout.vue";

    const props = defineProps({
        appUrl: String,
        generalSettings: Object,
    })

    let generalSettings = reactive({
        ...props.generalSettings
    });
    const save = () => {
        axios.post('http://admin.last6.local/settings', {
            generalSettings,
        }).then(r => console.log(r))
    }
</script>

<style scoped>

</style>
