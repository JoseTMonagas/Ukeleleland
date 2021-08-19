<template>
    <div>
    </div>
</template>
<script>
import {
    required,
    minLength,
    maxLength,
    email
} from "vuelidate/lib/validators";

	// Valida el rut con su cadena completa "XXXXXXXX-X"
	 function validaRut (rutCompleto) {
		if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
			return false;
		var tmp 	= rutCompleto.split('-');
		var digv	= tmp[1]; 
		var rut 	= tmp[0];
		if ( digv == 'K' ) digv = 'k' ;
		return (dv(rut) == digv );
	}

	function dv(T){
		var M=0,S=1;
		for(;T;T=Math.floor(T/10))
			S=(S+T%10*(9-M++%6))%11;
		return S?S-1:'k';
	}

export default {
    data() {
        return {
            nombre: null,
            apellido: null,
            email: null,
            telefono: null,
            rut: null
        };
    },
    validations: {
        nombre: {
            required,
            minLength: minLength(3)
        },
        apellido: {
            required,
            minLength: minLength(3)
        },
        email: {
            required,
            email
        },
        telefono: {
            required,
            minLength: minLength(8),
            maxLength: maxLength(20)
        },
        rut: {
            required,
            validaRut
        },
        form: ["nombre", "apellido", "email", "telefono", "rut"]
    },
    methods: {
        validate() {
            this.$v.form.$touch();
            var isValid = !this.$v.form.$invalid;
            this.$emit("on-validate", this.$data, isValid);
            return isValid;
        }
    }
};
</script>
<style></style>
