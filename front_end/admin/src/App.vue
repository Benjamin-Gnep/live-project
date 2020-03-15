<template>
  <div id="app">
    <h2>尊敬的管理员，您好！</h2>
    <p>请设置口罩预约的时间段：</p>
    <TimePicker/>
    <Button>
    </Button>
  </div>
</template>

<script>
import TimePicker from './components/TimePicker'
import Button from './components/Button'
  export default {
    name: 'App',
    components: {
      TimePicker,
      Button
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
