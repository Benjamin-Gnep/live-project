<template>
  <div id="app">
    <VisitingCard id='visitingCard'></VisitingCard>
    <Form></Form>
    <div id='additionalButton'>
      <el-button style="margin-left:95px;" id='newButton' @click.native="newAppointment">发起新预约</el-button>
      <el-button id='endButton' @click.native="endAppointment">结束预约</el-button>
    </div>
  </div>
</template>

<script>
  import Form from './components/Form'
  import VisitingCard from './components/VisitingCard'
  import Select from './components/Select'
  import Search from './components/Search'
export default {
  name: 'App',
  components: {
    Form,
    Select,
    VisitingCard,
    Search
  },
  methods: {
    newAppointment: function() {
      window.location.href = 'http://radishbear.top/ky/#/'
    },
    endAppointment: function() {
      alert('结束预约')
    }
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
