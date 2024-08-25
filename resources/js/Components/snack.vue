<template>
    <v-snackbar
        vertical
        v-model="showSnackBar"
    >
        <h1>{{ str }}</h1>

        <template v-slot:actions>
            <v-btn
                color="indigo"
                variant="text"
                @click="showSnackBar = false"
            >
                Close
            </v-btn>
        </template>
    </v-snackbar>

</template>

<script setup>
import {computed, ref, watch} from "vue";

let props = defineProps({
    snackbar: {},
});
let str = ref('')

let showSnackBar = ref(false)
let emits = defineEmits(['clear'])

watch(() => props.snackbar, (newOne) => {
    // showSnackBar.value = true
    str.value = newOne;
    showSnackBar.value= true

    setTimeout(() => {
        str.value = newOne;
        showSnackBar.value= false;
        emits('clear');

    }, 3000);
});

</script>

<style scoped>

</style>
