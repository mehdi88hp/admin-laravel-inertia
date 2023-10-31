<template>
    <div class="form-row row mt-4">
        <div class="form-group w10">
            <label>field name</label>
            <input v-model="form.states.fields[index].name" type="text" class="form-control" placeholder="e.g tour_requests">
        </div>

        <!--        <div class="form-group col-md-1">-->
        <!--            <label>db type</label>-->
        <!--            <select class="form-control" v-model="form.states.fields[index].dbType">-->
        <!--                <option value="integer">integer</option>-->
        <!--                <option value="tiny_integer">tiny integer</option>-->
        <!--                <option value="small_integer">small integer</option>-->
        <!--                <option value="big_integer">big integer</option>-->
        <!--                <option value="text">text</option>-->
        <!--                <option value="long_text">long text</option>-->
        <!--            </select>-->
        <!--        </div>-->

        <div class="form-group col-md-1">
            <label>field type</label>
            <select class="form-control" v-model="form.states.fields[index].fieldType">
                <option value="text" selected="selected">text</option>
                <option value="id">id</option>
                <option value="select">select</option>
                <option value="remote_select">remote select</option>
            </select>
        </div>

        <!--        <div class="form-group w10">-->
        <!--            <label>depends on table</label>-->
        <!--            <input v-model="form.states.fields[index].dependsOnTable" type="text" class="form-control">-->
        <!--        </div>-->

        <!--        <div class="form-group col-md-1">-->
        <!--            <label>depends on field</label>-->
        <!--            <input v-model="form.states.fields[index].dependsOnField" type="text" class="form-control">-->
        <!--        </div>-->

        <!--        <div class="form-group col-md-1">-->
        <!--            <label>restriction type</label>-->
        <!--            <input v-model="form.states.fields[index].dependsOnRestriction" type="text" class="form-control">-->
        <!--        </div>-->

        <div class="w5">
            <div class="form-check">
                <label>required</label>
                <input type="checkbox" class="form-check input" v-model="form.states.fields[index].required">
            </div>
        </div>

        <!--        <div class="col-md-1">-->
        <!--            <div class="form-check">-->
        <!--                <label>migration?</label>-->
        <!--                <input type="checkbox" class="form-check input" v-model="form.states.fields[index].migration">-->
        <!--            </div>-->
        <!--        </div>-->

        <div class="form-group col-md-1">
            <button type="submit" class="btn btn-danger mt-3" @click.prevent="form.actions.remove(index)">Remove</button>
        </div>
    </div>
</template>

<script setup>
    import { form } from './form';

    const props = defineProps({
        index: Number,
    });
</script>

<style>
    .w5 {
        flex: 0 0 auto;
        width: 5%;
    }

    .w10 {
        flex: 0 0 auto;
        width: 10%;
    }

    .w15 {
        flex: 0 0 auto;
        width: 15%;
    }

    .w20 {
        flex: 0 0 auto;
        width: 20%;
    }
</style>
