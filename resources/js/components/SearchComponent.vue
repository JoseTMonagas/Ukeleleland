<template>
    <div>
        <v-select :options="communes" v-model="search"></v-select>
        <input type="hidden" v-model="data" name="search"/>
    </div>
</template>
<script>
import VueSelect from 'vue-select';
export default {
    components: {
        'v-select': VueSelect,
    },
    props: ['communes'],
    computed: {
        data: function(){
            return this.search.value;
        }
    },
    data() {
        return {
            search: '',
        }
    }

}
</script>
