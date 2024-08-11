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
import { useForm } from '@inertiajs/vue3'

export default defineComponent({
    props: {
        user: Object,
    },
    setup() {
        const form = useForm({})

        const logout = () => {
            form.post(route('logout'))
        }

        return { logout }
    },
})
</script>
