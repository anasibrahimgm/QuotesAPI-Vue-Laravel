<template>
  <div>
    <form>
      <div class="form-group">
        <label for="name">Name</label>
        <input
              type="text"
              id="name"
              class="form-control"
              v-model="name"
              required
        />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input
              type="email"
              id="email"
              class="form-control"
              v-model="email"
              required
        />
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input
              type="password"
              id="password"
              class="form-control"
              v-model="password"
              required
        />
      </div>
      <button class="btn btn-primary" type="submit" @click.prevent="signup">SignUp</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
    }
  },

  methods: {
    signup() {
      axios.post(
        "http://vue.app/api/user",
        {
          name: this.name,
          email: this.email,
          password: this.password,
        },
        {
          headers:{'X-Requested-With' : 'XMLHttpRequest'}
        }
      )
      .then(
        response => {
          console.log(response);
        })
      .catch(
        error => {
          console.log(error);
      });
    },
  },
}
</script>

<style scoped>
</style>
