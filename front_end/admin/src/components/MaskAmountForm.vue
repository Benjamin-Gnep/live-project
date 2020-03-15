<template>
  <div id="app" style="width: 500px;margin: 0 auto">
    <el-form :model="numberValidateForm" ref="numberValidateForm" label-width="100px" class="demo-ruleForm">
    <el-form-item
        label="当前库存量"
        prop="amount"
        :rules="[
        { required: true, message: '该项不能为空'},
        { type: 'number', message: '必须为数字值'}
        ]"
    >
        <el-input type="amount" v-model.number="numberValidateForm.amount" autocomplete="off"></el-input>
    </el-form-item>
    <el-form-item>
        <el-button type="primary" @click="submitForm('numberValidateForm')">确认设置</el-button>
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
      getData: function() {
        axios.get('api/set_tatal.php', {
            params: {
              total: this.numberValidateForm['amount']
            }
          }).then(function(res) {
            _this.gridData = res.data
            window.console.log(res.data)
            return 'true'
          }).catch(function (error) {
            console.log(error)
            return 'false'
          })
      },
      submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            alert('设置成功!')
          } else {
            console.log('设置失败!!')
            return false
          }
        })
      }
    }
  }
</script>

<style scoped>
</style>
