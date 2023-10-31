import { computed, reactive } from 'vue'
import swal from "sweetalert2";
import CatchErrorWithSwal from "./CatchErrorWithSwal.js";

export const form = reactive({
    states: {
        disableSending: false,
        componentName: '',
        fields: [],
    },
    actions: {
        send(appUrl) {
            form.states.disableSending = true;

            axios.post(appUrl + '/com-builder', form.states).then(r => {
                swal.fire({
                    icon: 'success',
                    title: 'انجام شد',
                    html: '<span dir="rtl">' + 'کامپوننت ' + form.states.componentName + ' با موفقیت ساخته شد ' + '</span>',
                })

            }).catch(CatchErrorWithSwal).finally(() => {
                form.states.disableSending = false;
            })
        },
        remove(index) {
            form.states.fields.splice(index, 1)
        },
        addField() {
            form.states.fields.push({
                required: true,
                // migration: false,
                name: '',
                // dbType: '',
                fieldType: '',
                // dependsOnTable: '',
                // dependsOnField: '',
                // dependsOnRestriction: '',
            })
        }
    }
})
