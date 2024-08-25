<template>
    <AdminLayout>
        <v-row class="ma-5">
            <v-row>
                <v-col
                    cols="12"
                    sm="12"
                >
                    <v-text-field
                        label="name"
                        variant="outlined"
                        row-height="15"
                        v-model="form.title"
                    ></v-text-field>
                </v-col>

                <v-col
                    cols="12"
                    sm="12"
                >
                    <v-textarea
                        label="description"
                        auto-grow
                        variant="outlined"
                        rows="1"
                        row-height="15"
                        v-model="form.description"
                    ></v-textarea>
                </v-col>
                <v-col
                    cols="12"
                    sm="12"
                >
                    <v-autocomplete
                        label="parent"
                        auto-grow
                        variant="outlined"
                        rows="1"
                        row-height="15"
                        v-model="form.parent"
                        :items="parentItems"
                        item-text="title"
                        item-value="id"
                        :search-input.sync="searchParent"
                        @update:focused="searchParent"
                        @update:search="searchParent"
                    >
                    </v-autocomplete>


                </v-col>
                <v-col
                    cols="12"
                    sm="12"
                >
                    <v-file-input
                        accept="image/*"
                        chips
                        v-model="form.poster"
                        label="File input"
                    ></v-file-input>
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
import {reactive, ref} from 'vue'
import axios from "axios";
import AdminLayout from "@/AdminLayout/AdminLayout.vue";
import {router} from "@inertiajs/vue3";
import debounce from 'lodash.debounce'

let form = reactive({
    title: '',
    description: '',
    poster: '',
    parent: '',
});
let parentItems = ref([])

let genreParents = [
    {
        id: 0,
        value: 'please choose'
    }
];
let searchParent = debounce(($event) => {
    let term = $event;

    if ($event.target) {
        term = $event.target.value
    }
    axios.post('/genres-api/search', {term}).then(r => {
        console.log(r)
        if (r.data.length)
            parentItems.value = [...r.data]
    })
    // debounce(search, 1200)(term, this)
}, 440)
const save = () => {
    axios.post('/genres-api', {...form}, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }).then(r => {
        router.visit('/genres/' + r.data.genre_id + '/edit')
    })
}
</script>

<style scoped>

</style>
