<template>
  <div>
    <v-select :options="options" v-model="selected" @input="select"></v-select>
    <input :name="name" type="hidden" :value="real"/>
  </div>
</template>
<script>
import vSelect from 'vue-select';
export default {
  components: {
    'v-select': vSelect
  },
  props: ['data', 'name', 'label', 'value'],
  data() {
    return {
      selected: null,
      real: null
    }
  },
  computed: {
    options: function() {
      let label = this.label;
      let value = this.value;
      return this.data.map( item => {
        return {label: item[label], value: item[value]};
      });
    }
  },
  methods: {
    select: function() {
      this.real = this.selected.value;
    }
  }
}
</script>
