<template>
    <v-card class="pa-5">
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
                    @keyup="changed"
                ></v-text-field>
            </v-col>

            <v-col
                cols="12"
                sm="12"
            >
                <v-textarea
                    @keyup="changed"
                    label="content"
                    auto-grow
                    variant="outlined"
                    rows="1"
                    row-height="15"
                    v-model="form.content"
                ></v-textarea>
            </v-col>

            <v-col
                cols="12"
                sm="12"
            >
                <v-file-input
                    @change="changed"
                    accept="*"
                    chips
                    v-model="form.audio"
                    label="File audio"
                ></v-file-input>
            </v-col>

        </v-row>
    </v-card>
</template>

<script setup>
import {reactive} from "vue";

let form = reactive({
    title: '',
    content: '',
    audio: '',
});

let props = defineProps({
    section: {}
});

const changed = () => {
    emits('change', form)
}

const emits = defineEmits(['change']);
</script>

<style scoped>

</style>
