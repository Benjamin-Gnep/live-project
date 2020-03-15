<template>
  <div id="app" style="width: 500px;margin: 50px auto">
      <p style="margin-left: 0px;width:150px;font-weight:900;">便捷操作入口:</p>
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
      <el-form-item label="口罩总量" prop="num">
        <el-input v-model="ruleForm.num"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="submitForm('ruleForm')">&nbsp;设置总数&nbsp;</el-button>
        <el-button @click="resetForm('ruleForm')" style="width='2000px'">&nbsp;&nbsp;&nbsp;&nbsp;重&nbsp;置&nbsp;&nbsp;&nbsp;&nbsp;</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'AdminForm',
  data() {
    return {
      ruleForm: {
        num: ''
      },
      rules: {
        num: [
          { required: true, message: '请输入口罩总数', trigger: 'blur' }
        ]
      }
    }
  },
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.getData()
        } else {
          console.log('error submit!!')
          return false
        }
      })
    },
    resetForm(formName) {
      this.$refs[formName].resetFields()
    },
    getData: function() {
      var that = this
      axios.get('api/setTotal.php', {
          params: {
              total: this.ruleForm.num
          }
        }).then(function(res) {
         that.$notify({
          title: '成功！',
          message: '设置口罩总数为' + that.ruleForm.num,
          type: 'success'
        })
        }).catch(function (error) {
          that.$notify.error({
          title: '错误',
          message: 'php未响应'
        })
          console.log(error)
        })
    }
  }
  }
</script>

<style scoped>

</style>
