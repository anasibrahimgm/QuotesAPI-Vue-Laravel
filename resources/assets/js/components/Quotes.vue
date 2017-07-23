<template>
  <div>
    <app-quote
          v-for="quote in quotes"
          v-bind:qt="quote"
          @quoteDeleted="onQuoteDeleted($event)">
    </app-quote>
  </div>
</template>

<script>
import axios from 'axios';
import Quote from './Quote.vue';

export default {
  components: {
    'app-quote': Quote,
  },

  data() {
    return {
      quotes: [],
    }
  },

  methods: {
    onQuoteDeleted(id) {
      const position  = this.quotes.findIndex(
        (element) => {
          return element.id == id;
        }
      );
      this.quotes.splice(position, 1);
    }
  },

  created() {
    axios.get("http://vue.app/api/quotes")
    .then(
      response => {
        this.quotes = response.data.quotes;
      }
    )
    .catch(
      error => console.log(error)
    );
  },
}
</script>

<style scoped>
</style>
