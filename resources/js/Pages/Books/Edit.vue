<template>
    <AdminLayout>
        <v-row class="ma-5">
            <v-row>
                <v-col
                    cols="12"
                    sm="12"
                >
                    <v-text-field
                        label="title"
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
                    <v-row>

                        <v-col
                            cols="6"
                            sm="6"
                        >
                            <v-file-input
                                accept="image/*"
                                chips
                                v-model="form.poster"
                                label="File input"
                            ></v-file-input>
                        </v-col>

                        <v-col cols="6" sm="6">
                            <v-img :src="posterPreview"></v-img>
                        </v-col>
                    </v-row>
                </v-col>
                <v-col cols="12">
                    <v-btn color="indigo-darken-3"
                           @click="save">store
                    </v-btn>
                </v-col>
            </v-row>
        </v-row>

        <snack :snackbar="snackMessage" @clear="snackMessage=''"></snack>
    </AdminLayout>
</template>

<script setup>
import {computed, onMounted, reactive, ref} from 'vue'
import axios from "axios";
import AdminLayout from "@/AdminLayout/AdminLayout.vue";
import Snack from "@/Components/snack.vue";
import debounce from 'lodash.debounce'

let form = ref({
    title: '',
    description: '',
    logo: '',
    parent: '',
});

let snackMessage=ref('')

let props = defineProps({
    book: {
        type: Object,
    },
    appUrl: {
        type: String,
    },
});
let parentItems = ref([])

let posterPreview = computed(() => {
    return form.value.poster ? URL.createObjectURL(form.value.poster) : form.value.logo
})

let searchParent = debounce(($event) => {
    let term = $event;

    if ($event.target) {
        term = $event.target.value
    }
    axios.post('/books-api/search', {term}).then(r => {
        if (r.data.length)
            parentItems.value = [...r.data]
    })
}, 440);
const adminLayout = ref(null)
const emits = defineEmits(['showSnackBar'])

const save = () => {
    const formData = new FormData();
    formData.append('_method', 'put');

    for (let key in form.value) {
        if (key === 'parent') {
            formData.append('parent', form.value.parent.id ?? form.value.parent);
        } else {
            formData.append(key, form.value[key]);
        }
    }

    axios.post('/books-api/' + props.book.id, formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }).then(r => {
        snackMessage.value='updated!!!'
    })
}


onMounted(() => {
    axios.get('/books-api/' + props.book.id).then(response => {
        form.value = JSON.parse(JSON.stringify({...response.data.data}))
        // form.value.parent = response.data.data.parent.id
    })
})

</script>

<style scoped>

</style>
