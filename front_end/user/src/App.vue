<template>
  <div id="app">
    <Search></Search>
  </div>
</template>

<script>
  import Form from './components/Form'
  import AdminForm from './components/AdminForm'
  import VisitingCard from './components/VisitingCard'
  import Select from './components/Select'
  import Search from './components/Search'
  import axios from 'axios'
export default {
  name: 'App',
  components: {
    Form,
    Select,
    VisitingCard,
    Search,
    AdminForm
  },
  methods: {
    newAppointment: function() {
      axios.get('api/newAppointment.php', {
          params: {
          }
        }).then(function(res) {
         alert('开始新一轮预约！')
        }).catch(function (error) {
          window.console.log(error)
        })
    },
    endAppointment: function() {
     axios.get('api/draw.php', {
          params: {
          }
        }).then(function(res) {
         alert('已结束本轮预约！')
        }).catch(function (error) {
          window.console.log(error)
        })
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
