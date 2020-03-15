<template>
  <div id="app">
        <el-time-picker
            is-range
            v-model="valueOfTimeSelector"
            range-separator="至"
            start-placeholder="开始时间"
            end-placeholder="结束时间"
            placeholder="选择时间范围">
        </el-time-picker>
        <br/><br/>
        <p>
          <span slot="footer" class="dialog-footer">
            <el-button @click="appointmentTimeVisible = false">取 消</el-button>
            <el-button type="primary" @click="appointmentTimeVisible = false;confirm()">确认设置</el-button>
          </span>
        </p>
  </div>
</template>

<script>
import axios from 'axios'
    export default {
        data() {
            return {
                valueOfTimeSelector: [new Date(2020, 3, 15, 0, 0), new Date(2020, 3, 15, 23, 59)]
            }
        },
        methods: {
          getData: function() {
            axios.get('api/order.php', {
                params: {
                  time: this.valueOfTimeSelector
                }
              }).then(function(res) {
                window.console.log(res.data)
                return 'true'
              }).catch(function (error) {
                console.log(error)
                return 'false'
              })
          },
          confirm: function() {
          }
        }

    }
</script>

<style scoped>

</style>
