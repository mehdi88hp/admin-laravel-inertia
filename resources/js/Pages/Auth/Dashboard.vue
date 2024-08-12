<template>
    <v-container>
        <v-row>
            <v-col>
                <h1>Welcome to your Dashboard</h1>
                <p>Hello, {{ user.name }}!</p>
                <p>Your email is: {{ user.email }}</p>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-btn color="primary" @click="logout">Logout</v-btn>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { defineComponent } from 'vue'
import {router, useForm} from '@inertiajs/vue3'
import axios from "axios";

export default defineComponent({
    props: {
        user: Object,
        appUrl: String,
    },
    setup(props) {
        const form = useForm({})

        function logout(){
            axios.post(props.appUrl + '/auth/logout').then(r => {
                router.visit('/auth/login')
            })
        }

        return { logout }
    },
})
</script>
