<template>
  <div id="app">
    <Form></Form>
    <Select></Select>
  </div>
</template>

<script>
  import Form from './components/Form'
  import Select from './components/Select'
  export default {
    name: 'App',
    components: {
      Form,
      Select
    }
  }
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
