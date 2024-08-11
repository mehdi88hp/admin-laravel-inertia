<template>
    <AdminLayout>
        <v-card
            class="mx-auto"
            max-width="344"
            title="Login Form"
        >
            <v-container>
                <v-text-field
                    v-model="form.email"
                    color="primary"
                    label="Email"
                    variant="underlined"
                ></v-text-field>

                <v-text-field
                    v-model="form.password"
                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                    :rules="[rules.required, rules.min]"
                    :type="show1 ? 'text' : 'password'"
                    hint="At least 8 characters"
                    label="Normal with hint text"
                    name="input-10-1"
                    variant="underlined"
                    counter
                    @click:append="show1 = !show1"
                ></v-text-field>

                <!--                <v-checkbox-->
                <!--                    v-model="terms"-->
                <!--                    color="secondary"-->
                <!--                    label="I agree to site terms and conditions"-->
                <!--                ></v-checkbox>-->
            </v-container>

            <v-divider></v-divider>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn color="success" @click="save">
                    Login

                    <v-icon icon="mdi-chevron-right" end></v-icon>
                </v-btn>
            </v-card-actions>
        </v-card>

        <v-snackbar
            v-model="snackbar"
            vertical
        >
            <div class="text-subtitle-1 pb-2">Great!</div>

            <p>you loginned successfully, you are going to redirect to dashboard page...</p>

            <template v-slot:actions>
                <v-btn
                    color="indigo"
                    variant="text"
                    @click="snackbar = false"
                >
                    Close
                </v-btn>
            </template>
        </v-snackbar>
    </AdminLayout>
</template>

<script>
import axios from "axios";
import {router} from "@inertiajs/vue3";

export default {
    name: 'Register',
    data() {
        return {
            snackbar: false,
            form: {
                email: '',
                password: '',
            },
            show1: false,
            rules: {
                required: value => !!value || 'Required.',
                min: v => v.length >= 8 || 'Min 8 characters',
                emailMatch: () => (`The email and password you entered don't match`),
            },
        }
    },
    methods: {
        save() {
            return axios.post(this.appUrl + '/auth/login', {...this.form}).then(r => {
                this.snackbar = true;

                setTimeout(()=>{
                    router.visit('/dashboard')
                },1000)
            })
        }
    },
    props: {
        source: String,
        appUrl: String,
    },
    mounted() {
    }
};
</script>

<style></style>
