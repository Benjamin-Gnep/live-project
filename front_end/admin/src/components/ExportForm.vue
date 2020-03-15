<template>
  <div id="app" style="width: 500px;margin: 0 auto">
    <el-form :model="numberValidateForm" ref="numberValidateForm" label-width="100px" class="demo-ruleForm">
    <el-form-item
        label="导出轮次"
        prop="amount"
        :rules="[
        { required: true, message: '该项不能为空'},
        { type: 'number', message: '必须为数字值'}
        ]"
    >
        <el-input type="amount" v-model.number="numberValidateForm.amount" autocomplete="off"></el-input>
    </el-form-item>
    <el-form-item>
        <el-button type="primary" @click="submitForm('numberValidateForm')">确认导出</el-button>
    </el-form-item>
    </el-form>
  </div>
</template>

<script>
  import axios from 'axios'
    export default {
    name: 'AmountForm',
    data() {
      return {
        numberValidateForm: {
          amount: ''
        }
      }
    },
    methods: {
      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            alert('导出成功!')
          } else {
            console.log('导出失败!!')
            return false
          }
        })
      },
      getData: function() {
        axios.get('api/Export_win.php', {
            params: {
              time: this.numberValidateForm['amount']
            }
          }).then(function(res) {
            window.console.log(res.data)
            return 'true'
          }).catch(function (error) {
            console.log(error)
            return 'false'
          })
      }
    }
  }
</script>

<style scoped>
</style>
