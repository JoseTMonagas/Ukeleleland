<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Escribe tu mensaje aqui" v-model="newMessage" @keyup.enter="sendMessage">

        <span class="input-group-append">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                Enviar
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            }
        }    
    }
</script>
