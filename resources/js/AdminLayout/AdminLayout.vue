<template>
    <v-app id="inspire">
        <v-navigation-drawer
            image="https://cdn.vuetifyjs.com/images/backgrounds/bg-2.jpg"
            v-model="drawer"
            theme="dark"
        >
            <v-list nav>
                <v-list-item prepend-icon="mdi-email" title="Inbox" value="users">
                </v-list-item>
                <v-list-item prepend-icon="mdi-account-supervisor-circle" title="Supervisors" value="supervisors"><span v-inertia-link="'foo'">reddddddddd</span></v-list-item>

                <v-list-item prepend-icon="mdi-clock-start" title="Clock-in" value="clockin" @click="navigateTo('foo')">Words</v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-app-bar-title>Application</v-app-bar-title>
        </v-app-bar>

        <v-main>
            <slot></slot>
        </v-main>

        <v-footer
            class="bg-indigo-lighten-1 text-center d-flex flex-column"
        >
            <div>
                <v-btn
                    v-for="icon in icons"
                    :key="icon"
                    class="mx-4"
                    :icon="icon"
                    variant="text"
                ></v-btn>
            </div>

            <div class="pt-0">
                Phasellus feugiat arcu sapien, et iaculis ipsum elementum sit amet. Mauris cursus commodo interdum. Praesent ut risus eget metus luctus accumsan id ultrices nunc. Sed at orci sed massa consectetur dignissim a sit amet dui. Duis commodo vitae velit et faucibus. Morbi vehicula lacinia malesuada. Nulla placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin. Vestibulum eu ipsum vel diam elementum tempor vel ut orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
            </div>

            <v-divider></v-divider>

            <div>
                {{ new Date().getFullYear() }} — <strong>Vuetify</strong>
            </div>
        </v-footer>
    </v-app>
</template>

<script setup>
    import { ref } from 'vue'
    import { router } from '@inertiajs/vue3';

    const navigateTo = (routeName) => {
        router.visit(route(routeName));
    }

    const drawer = ref(null)
    const icons = ref([
        'mdi-facebook',
        'mdi-twitter',
        'mdi-linkedin',
        'mdi-instagram',
    ])
</script>
