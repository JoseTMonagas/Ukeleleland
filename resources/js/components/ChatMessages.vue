<template>
    <div class="container">
        <div class="row d-flex flex-column my-2" v-for="message in messages" :key="message.id">
            <strong>{{ message.user.name }}:</strong>
            <p>{{ message.message }}</p>
        </div>
    </div>
</template>

<script>
export default {
  props: ['messages'],
  mounted () {
    console.log(this.messages);
  }
};
</script>
