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
                        label="genre"
                        auto-grow
                        variant="outlined"
                        rows="1"
                        row-height="15"
                        v-model="form.genre"
                        :items="genreItems"
                        item-text="title"
                        item-value="id"
                        :search-input.sync="searchGenre"
                        @update:focused="searchGenre"
                        @update:search="searchGenre"
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
                <hr>
                <BookSections v-for="(section,i) in form.sections" :key="i" :section="section" @change="bookSectionChange($event,i)"></BookSections>

                <v-col cols="12">
                    <v-btn color="indigo-darken-3"
                           @click="addSection">add section
                    </v-btn>
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
import BookSections from "@/Components/Books/BookSections.vue";
import {router} from "@inertiajs/vue3";
import debounce from 'lodash.debounce'

let form = reactive({
    title: '',
    description: '',
    poster: '',
    genre: '',
    sections: [],
});
let genreItems = ref([])

let searchGenre = debounce(($event) => {
    let term = $event;

    if ($event.target) {
        term = $event.target.value
    }
    axios.post('/genres-api/search', {term}).then(r => {
        // console.log(r)
        if (r.data.length)
            genreItems.value = [...r.data]
    })
}, 440)

const addSection = () => {
    form.sections.push({
        id: 0,
        title: '',
        content: '',
    })
};

const bookSectionChange=($event,i)=>{
    console.log($event)
    form.sections[i] = {...$event}
}

const save = () => {
    axios.post('/books-api', {...form}, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }).then(r => {
        router.visit('/books/' + r.data.book_id + '/edit')
    })
}
</script>

<style scoped>

</style>
