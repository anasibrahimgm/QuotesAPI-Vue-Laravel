<template>
  <div>
    <div class="alert alert-success" role="alert" v-show="loginSuccessMsg">
      <strong>Well done!</strong> {{ loginSuccessMsg }}
    </div>

    <form>
      <div class="alert alert-warning" role="alert" v-show="loginError">
        <strong>Warning!</strong> {{ loginError }}
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
      <button class="btn btn-primary" type="submit" @click.prevent="signin">SignIn</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      loginError: '',
      loginSuccessMsg: '',
    }
  },

  methods: {
    signin() {
      axios.post(
        "http://vue.app/api/user/signin",
        {
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
          const token = response.data.token;
          //const base64Url=token.split('.')[1];
          //const base64 = base64Url.replace('-', '+').replace('_', '/');
          //console.log(JSON.parse(window.atob(base64)));

          localStorage.setItem('token', token);

          this.email = '';
          this.password = '';
          this.loginError = '';

          this.loginSuccessMsg = "Successful Login";
        })
      .catch(
        error => {
          console.log(error);
          if (error.response) {
            console.log("Error 1");
             // The request was made and the server responded with a status code
             // that falls out of the range of 2xx
             console.log(error.response.data);
             console.log(error.response.data.error);
             this.loginError = error.response.data.error;

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
  },
}
</script>

<style scoped>
</style>
