<template>
  <div id="app">
    <VisitingCard id='visitingCard'></VisitingCard>
    <Form></Form>
    <el-button>结束预约</el-button>
    <el-button>发起新预约</el-button>
  </div>
</template>

<script>
  import Form from './components/Form'
  import VisitingCard from './components/VisitingCard'
  import Select from './components/Select'
export default {
  name: 'App',
  components: {
    Form,
    Select,
    VisitingCard
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
#visitingCard{
  margin: 0 auto;
}
</style>
