<template>
  <div id="Search" style="width: 500px;margin: 0 auto" ref='box'>
    <el-input
      placeholder="请输入预约编号"
      v-model="input"
      clearable>
    </el-input>
    <div id='buttons' style="width:200px;margin-top: -40px;margin-left: 500px;">
    <el-button type="primary" @click="submitForm('ruleForm')">确定</el-button>
    <el-button @click="resetForm('ruleForm')">重置</el-button>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'Search',
  data() {
    return {
       input: ''
    }
  },
  methods: {
      submitForm: function() {
          this.getData()
      },
      resetForm: function() {
          this.input = ''
      },
      getData: function() {
          axios.get('api/win.php', {
          params: {
            id: this.input
          }
        }).then(function(res) {
            window.console.log(res.data)
            if (res.data === '未中签') {
            }
        })
      }
  }
}
</script>

<style scoped>
</style>
