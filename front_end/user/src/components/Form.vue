<template>
  <div id="app" style="width: 500px;margin: 0 auto">
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
      <el-form-item label="姓名" prop="name">
        <el-input v-model="ruleForm.name"></el-input>
      </el-form-item>
      <el-form-item label="身份证" prop="id">
        <el-input v-model="ruleForm.id"></el-input>
      </el-form-item>
      <el-form-item label="手机号" prop="phone">
        <el-input v-model="ruleForm.phone"></el-input>
      </el-form-item>
      <el-form-item label="预约数量" prop="number">
        <el-input v-model="ruleForm.number"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="submitForm('ruleForm')">&nbsp;立即预约&nbsp;</el-button>
        <el-button @click="resetForm('ruleForm')" style="width='2000px'">&nbsp;&nbsp;&nbsp;&nbsp;重&nbsp;置&nbsp;&nbsp;&nbsp;&nbsp;</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'Form',
  data() {
    return {
      ruleForm: {
        name: '',
        id: '',
        phone: '',
        number: ''
      },
      rules: {
        name: [
          { required: true, message: '请输入姓名', trigger: 'blur' },
          { min: 1, message: '请输入名字', trigger: 'blur' }
        ],
        id: [
          { required: true, message: '请输入身份证号', trigger: 'blur' },
          { min: 1, max: 18, message: '身份证号位数不对', trigger: 'blur' }
        ],
        phone: [
           { required: true, message: '请输入手机号', trigger: 'blur' }
        ],
        number: [
           { required: true, message: '请输入预购数量', trigger: 'blur' }
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
      axios.get('api/order.php', {
          params: {
            type: this.$Type,
            name: this.ruleForm['name'],
            ID_num: this.ruleForm['id'],
            phone: this.ruleForm['phone'],
            num: this.ruleForm['number']
          }
        }).then(function(res) {
          if (res.data > 0) {
         that.$notify({
          title: '预约成功！',
          message: '您的编号为:' + res.data,
          type: 'success'
        })
          }else{
          that.$notify.error({
          title: '预约失败！',
          message: '成功原因:' + res.data,
          type: 'error'
        })
          }
          window.console.log(res.data)
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
