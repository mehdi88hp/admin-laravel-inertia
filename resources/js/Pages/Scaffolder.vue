<template>
    <div class="container-fluid">
        <form class=" form-inline m-5">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail">Component Name (singular and lower case)</label>
                    <input type="email" v-model="form.states.componentName" class="form-control" id="inputEmail">
                </div>
            </div>
            <br>
            <div class="row">
                <button type="submit" class="btn btn-secondary" @click.prevent="form.actions.addField">add field</button>
            </div>

            <Row v-for="(field,index) in form.states.fields " :index="index" :key="index"></Row>

            <div class="row mt-5">
                <button v-if="form.states.fields.length"
                        type="submit"
                        class="btn btn-primary mt-3"
                        :disabled="form.states.disableSending"
                        @click.prevent="form.actions.send(appUrl)"
                >Submit
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
    import { form } from '../Components/Scaffolder/form';
    import Row from "../Components/Scaffolder/Row.vue";

    const props = defineProps({appUrl: String})
</script>
