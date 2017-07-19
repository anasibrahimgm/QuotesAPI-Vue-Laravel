<template>
  <div id="app">
    <new-quotes></new-quotes>
  </div>
</template>

<script>
import newQuotes from './components/newQuotes.vue';

export default {
  components: {
    'new-quotes': newQuotes,
  },
  name: 'app',
  data () {
    return {
    }
  }
}
</script>

<style>

</style>
