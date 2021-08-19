<template>
    <div id="parentx">

        <vs-button @click="active=!active" color="primary" type="filled">
            <i class="fas fa-bars"></i>
        </vs-button>
        <vs-sidebar parent="body" default-index="1"  color="primary" class="sidebarx" spacer v-model="active">
            <slot></slot>
        </vs-sidebar>
    </div>
</template>
<script>
export default {
    data:()=>({
        active:false,
    })
}
</script>
<style></style>
