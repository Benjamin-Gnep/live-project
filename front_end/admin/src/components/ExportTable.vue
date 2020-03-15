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
    <el-dialog title="该轮中签名单" :visible.sync="tableVisible">
      <el-table :data="gridData">
        <el-table-column property="id" label="编号" width="150"></el-table-column>
        <el-table-column property="name" label="姓名" width="200"></el-table-column>
        <el-table-column property="phone" label="电话"></el-table-column>
      </el-table>
    </el-dialog>
  </div>
</template>

<script>
  import axios from 'axios'
    export default {
    name: 'AmountForm',
    data() {
      return {
        gridData: [],
        numberValidateForm: {
          amount: ''
        },
        tableVisible: false
      }
    },
    methods: {
      getData: function() {
        var _this = this
        axios.get('api/Export_win.php', {
            params: {
              time: this.numberValidateForm['amount']
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
        this.getData()
        this.$refs[formName].validate((valid) => {
          if (valid) {
            alert('导出成功!正在生成表格')
            this.creatForm()
          } else {
            console.log('error!!')
            return false
          }
        })
      },
      creatForm: function() {
        this.tableVisible = true
      }
    }
  }
</script>

<style scoped>
</style>
