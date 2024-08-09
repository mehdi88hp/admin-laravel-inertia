<template>
    <AdminLayout>
        <v-card-text>
            <v-form>
                <v-text-field
                    prepend-icon="person"
                    name="login"
                    label="Login"
                    type="text"
                ></v-text-field>
                <v-text-field
                    id="password"
                    prepend-icon="lock"
                    name="password"
                    label="Password"
                    type="password"
                ></v-text-field>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" to="/">Login</v-btn>
        </v-card-actions>
    </AdminLayout>
</template>

<script>
export default {
    name: 'Login',
    props: {
        source: String,
    },
};
</script>

<style></style>
