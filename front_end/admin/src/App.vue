<template>
  <div id="app">
    <h2>尊敬的管理员，您好！</h2>
    <p>您可以进行下列操作：</p>
    <el-row>
      <el-button type="primary" @click.native="appointmentTimeVisible = true">设置口罩预约时间段</el-button>
      <el-dialog :visible.sync="appointmentTimeVisible" title="设置时间段">
        <TimePicker/>
      </el-dialog>
    </el-row>
    <br/>
    <el-row>
      <el-button type="primary" @click.native="appointmentAmountVisible = true">设置用户最高预约量</el-button>
      <el-dialog :visible.sync="appointmentAmountVisible" title="设置数量">
        <AppointAmountForm>
        </AppointAmountForm>
      </el-dialog>
    </el-row>
    <br/>
    <el-row>
      <el-button type="primary" @click.native="maskAmountVisible = true">设置当前口罩库存量</el-button>
      <el-dialog :visible.sync="maskAmountVisible" title="设置数量">
        <MaskAmountForm>
        </MaskAmountForm>
      </el-dialog>
    </el-row>
    <br/>
    <el-row>
      <el-button type="primary" @click.native="exportFormVisible = true">导出中签名单至本地</el-button>
      <el-dialog :visible.sync="exportFormVisible" title="输出导出轮次">
        <ExportForm>
        </ExportForm>
      </el-dialog>
    </el-row>
  </div>
</template>

<script>
import TimePicker from './components/TimePicker'
import ExportForm from './components/ExportForm'
import MaskAmountForm from './components/MaskAmountForm'
import AppointAmountForm from './components/AppointAmountForm'

  export default {
    name: 'App',
    components: {
      TimePicker,
      ExportForm,
      AppointAmountForm,
      MaskAmountForm
    },
    data: function() {
        return {
          appointmentTimeVisible: false,
          appointmentAmountVisible: false,
          exportFormVisible: false,
          maskAmountVisible: false
        }
    },
    methods: {
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
