<template>
    <AdminLayout>
        <v-data-table-server
            v-model:items-per-page="itemsPerPage"
            :headers="headers"
            :items="serverItems"
            :items-length="totalItems"
            :loading="loading"
            :search="search"
            item-value="name"
            @update:options="loadItems"
        >
            <template v-slot:item.actions="{ item }">
                <v-icon
                    class="me-2"
                    size="small"
                    @click="editItem(item)"
                >
                    mdi-pencil
                </v-icon>

                <v-icon
                    size="small"
                    @click="showDeleteDialog=true"
                >
                    mdi-delete
                </v-icon>

                <v-dialog
                    v-model="showDeleteDialog"
                    max-width="400"
                    persistent
                >
<!--                    <template v-slot:activator="{ props: activatorProps }">-->
<!--                        <v-btn v-bind="activatorProps">-->
<!--                            Open Dialog-->
<!--                        </v-btn>-->
<!--                    </template>-->

                    <v-card
                        prepend-icon="mdi-map-marker"
                        text="You are going to delete this book"
                        title="Are You Sure?"
                    >
                        <template v-slot:actions>
                            <v-spacer></v-spacer>

                            <v-btn @click="showDeleteDialog = false">
                                Disagree
                            </v-btn>

                            <v-btn @click="destroy(item)">
                                Agree
                            </v-btn>
                        </template>
                    </v-card>
                </v-dialog>
            </template>

            <template v-slot:no-data>
                <v-btn
                    color="primary"
                >
                    Reset
                </v-btn>
            </template>


        </v-data-table-server>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/AdminLayout/AdminLayout.vue";
import {computed, ref} from "vue";
import axios from "axios";
import {router} from "@inertiajs/vue3";


const itemsPerPage = ref(5);
const headers = ref([
    {
        title: 'title',
        align: 'start',
        sortable: false,
        key: 'title',
    },
    {title: 'Description', key: 'description', align: 'end'},
    // {title: 'Logo', key: 'logo', align: 'end'},
    {title: 'Actions', key: 'actions', sortable: false},
]);

const showDeleteDialog = ref(false);
const search = ref('');
const serverItems = ref([]);
const loading = ref(true);
const totalItems = ref(0);

const editItem = function (item) {
    router.visit('/books/' + item.id + '/edit')
}

// const imageify = (src)=>URL.createObjectURL(src);

const destroy=(item)=>{
    showDeleteDialog.value=false
    axios.delete('/books-api/'+item.id).then(response => {
        // serverItems.value = response.data.data
        // totalItems.value = response.data.meta.total
        loadItems({page:1,itemsPerPage:50,sortBy:'title'})
    }).finally(() => {
        loading.value = false
    })
    alert('destroyed')
}
const loadItems = function ({page, itemsPerPage, sortBy}) {
    loading.value = true

    axios.get('/books-api').then(response => {
        serverItems.value = response.data.data
        totalItems.value = response.data.meta.total
    }).finally(() => {
        loading.value = false
    })

}

</script>

<style scoped>

</style>
