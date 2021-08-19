<template>
    <div class="card">
        <h5 class="card-header d-flex flex-row bg-primary text-light justify-content-center align-items-center">
            <div class="col-md-1">
                <img :src="receptorAvatar" alt="" class="img-fluid rounded-circle"/>
            </div>
            <a class="col-md" :href="receptorProfile">
                {{ receptor.name }}
            </a>
        </h5>
        <div class="card-body">
            <chat-messages :messages="messages"></chat-messages>
        </div>
        <div class="card-footer">
            <chat-form
                v-on:messagesent="addMessage"
                :user="user"
                ></chat-form>
        </div>
    </div>
</template>
<script charset="utf-8">
export default {
    props: ['user', 'fetch', 'send', 'receptor', 'receptorAvatar', 'receptorProfile', 'receptorAvatar'],

    data() {
        return {
            messages: []
        }
    },

    created() {
        this.fetchMessages();
        Echo.private(this.conversation)
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            });
    },

    methods: {
        fetchMessages() {
            let action = this.fetch;
            axios.get(action).then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);
            let action = this.send;

            axios.post(action, message).then(response => {
                console.log(response.data);
            });
        }
    }
}
</script>
