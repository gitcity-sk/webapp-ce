<template>
  <simple-mde v-model="message"></simple-mde>
</template>

<script>
 import SimpleMde from '../vue/shared-components/SimpleMde' // import our neww component

  export default {
    // other component options...
    data() {
      return { message: 'Hello World!!' }
    },
    components: { SimpleMde },
  }
</script>