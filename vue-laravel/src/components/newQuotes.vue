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
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      quoteContent: '',
    }
  },

  methods: {
    submitted() {
      axios.post("http://vue.app/api/quote", {
        content: this.quoteContent
      })
      .then(
        (response) => console.log(response)
      ).catch(
        (error) => console.log(error)
      );
    },
  },
}
</script>

<style scoped>
</style>
