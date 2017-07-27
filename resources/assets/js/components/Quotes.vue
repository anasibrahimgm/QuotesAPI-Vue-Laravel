<template>
  <div>
    <form @submit.prevent="submitted">
      <div class="form-group">
        <label for="content">Content</label>
        <input
              type="text"
              id="content"
              class="form-control"
              v-model="quoteContent"
        />
      </div>
      <button class="btn btn-primary" type="submit">Submit</button>
    </form>

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
import newQuote from './newQuote.vue';

export default {
  components: {
    'app-quote': Quote,
    'new-quote': newQuote,
  },

  data() {
    return {
      quotes: [],
      quoteContent: '',
    }
  },

  methods: {
    submitted() {
      const token = localStorage.getItem('token');
      axios.post("http://vue.app/api/quote?token=" + token, {
        content: this.quoteContent
      },
      {
          headers:{'X-Requested-With' : 'XMLHttpRequest'}
      }
      )
      .then(
        response => {
          console.log(response);
          this.quoteContent = '';
          this.quotes.push(response.data.quote);
        }
      ).catch(
        error => {
          console.log(error);
          if (error.response) {
            console.log("Error 1");
             // The request was made and the server responded with a status code
             // that falls out of the range of 2xx
             console.log(error.response.data);

             console.log("Error 2");
             console.log(error.response.status);

             console.log("Error 3");
             console.log(error.response.headers);
           } else if (error.request) {
             // The request was made but no response was received
             // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
             // http.ClientRequest in node.js
             console.log("Error 4");
             console.log(error.request);
           } else {
             // Something happened in setting up the request that triggered an Error
             console.log("Error 5");
             console.log('Error', error.message);
           }
           console.log(error.config);
        }
      );
    },

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
