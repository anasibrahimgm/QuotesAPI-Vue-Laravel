<template>
  <div id="app">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <router-link to="/signup">SignUp</router-link> |
          <router-link to="/signin">SignIn</router-link>
          <br />
          <router-link to="/">Quotes</router-link> |
          <router-link to="/new-quote">New Quote</router-link>
        </div>
      </div>
      <hr />
      <div class="row">
        <div class="col-md-12">
          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'app',
  data () {
    return {
    }
  }
}
</script>

<style>
#app {
  margin: 30px;
}
</style>
