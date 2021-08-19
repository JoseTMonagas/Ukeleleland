<template>
<div>
    </div>
</template>
<script>
import { required, minLength, email } from "vuelidate/lib/validators";

export default {
props: ['communes'],
    data() {
        return {
            comuna: null,
            direccion: null
        };
    },
    validations: {
        direccion: {
            required,
            minLength: minLength(12)
        },
        form: ["direccion"]
    },
    methods: {
        validate() {
            this.$v.form.$touch();
            var isValid = !this.$v.form.$invalid;
            this.$emit("on-validate", this.$data, isValid);
            return isValid;
        },
    }
};
</script>
<style></style>
